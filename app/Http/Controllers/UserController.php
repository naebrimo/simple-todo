<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $rowsPerPage = 5;
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('active', TRUE)
        ->orderby('updated_at', 'asc')
        ->paginate($this->rowsPerPage);

        return view('users/index',[
            'users' => $users
        ]);
    }
    /**
     * Display a listing of the resource upon search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if($request->q == '') return redirect(route('user.index'));
        $request->validate(['q' => 'string|max:100']);

        $users = User::where('active', TRUE)
        ->where(function($query) use($request){
            $query->where('name', 'like', '%'.$request->q.'%')
                ->orWhere('email', 'like', '%'.$request->q.'%')
                ->orWhere('username', 'like', '%'.$request->q.'%');
        })
        ->paginate($this->rowsPerPage);

        return view('users/index',[
            'users' => $users,
            'search' => $request->q
        ]);
    }
    /**
     * Display a listing of the resource upon sort.
     *
     * @return \Illuminate\Http\Response
     */
    public function sort(Request $request)
    {
        if(isset($request->date) && in_array(strtolower($request->date), array('asc','desc')))
        {
            $users = User::where('active', TRUE)
            ->orderby('updated_at', $request->date)
            ->paginate($this->rowsPerPage);
            $sort['date'] = ($request->date == 'asc') ? 'desc' : 'asc';
        }
        elseif(isset($request->name) && in_array(strtolower($request->name), array('asc','desc')))
        {
            $users = User::where('active', TRUE)
            ->orderby('name', $request->name)
            ->paginate($this->rowsPerPage);
            $sort['name'] = ($request->name == 'asc') ? 'desc' : 'asc';
        }
        elseif(isset($request->email) && in_array(strtolower($request->email), array('asc','desc')))
        {
            $users = User::where('active', TRUE)
            ->orderby('email', $request->email)
            ->paginate($this->rowsPerPage);
            $sort['email'] = ($request->email == 'asc') ? 'desc' : 'asc';
        }
        elseif(isset($request->username) && in_array(strtolower($request->username), array('asc','desc')))
        {
            $users = User::where('active', TRUE)
            ->orderby('username', $request->username)
            ->paginate($this->rowsPerPage);
            $sort['username'] = ($request->username == 'asc') ? 'desc' : 'asc';
        }

        return view('users/index',[
            'users' => $users,
            'sort' => $sort
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request, $id = null)
    {
        if($request->isMethod('post'))
        {
            $user = (object) $this->validateInputs($request);
            $user->action = 'create';
        }
        elseif($request->isMethod('patch'))
        {
            $user = (object) $this->validateInputs($request);
            $user->id = $id;
            $user->action = 'update';
        }
        elseif($request->isMethod('delete'))
        {
            $user = User::where('id', $id)
            ->where('active', TRUE)
            ->first();
            if(!is_null($user)) $user->action = 'destroy';
        }

        if(isset($user))
        {
            session()->flash('user', $user);
            session()->regenerate();

            return view('users/confirm',[
                'user' => $user
            ]);
        }
        return $this->redirectToIndexPage();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users/create');
    }
    /**
     * Display the complete notification page.
     *
     * @return \Illuminate\Http\Response
     */
    public function complete()
    {
        if(session()->has('action'))
        {
            return view('users/complete');
        }
        return $this->redirectToIndexPage();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->showOrEdit('show', $id);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->showOrEdit('edit', $id);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $this->getSessionFromConfirmPage($request);
        return $this->createOrUpdate($request, $user);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->getSessionFromConfirmPage($request, $id);
        return $this->createOrUpdate($request, $user);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = $this->getSessionFromConfirmPage($request, $id);
        return $this->createOrUpdate($request, $user);
    }

    private function validateInputs($request)
    {
        return $request->validate([
            'name' => 'required|min:3|max:99',
            'email' => 'required|email|unique:users|min:3|max:99',
            'username' => 'required|unique:users|min:3|max:99',
            'password' => 'required|confirmed|min:3',
        ]);
    }

    private function defaultParameters($request)
    {
        return [
            'name' => strtolower($request->name),
            'email' => strtolower($request->email),
            'username' => strtolower($request->username),
            'password' => bcrypt($request->password),
            'active' => TRUE,
        ];
    }

    private function redirectToCompletePage()
    {
        session()->forget('user');
        session()->reflash();
        session()->regenerate();

        return redirect(route('user.complete'));
    }

    private function redirectToIndexPage()
    {
        if(session()->has('action'))
        {
            session()->forget('action');
        }

        if(session()->has('user'))
        {
            session()->forget('user');
        }

        session()->regenerate();
        return redirect(route('user.index'));
    }

    private function getSessionFromConfirmPage($request, $id = null)
    {
        if(session()->has('user'))
        {
            if($request->isMethod('post') ||
                $request->isMethod('patch') ||
                $request->isMethod('delete'))
            {
                $user = session()->get('user');

                if($request->isMethod('patch') || $request->isMethod('delete'))
                {
                    if(!is_null($id) && $id != $user->id)
                    {
                        return $this->redirectToIndexPage();
                    }
                }
                session()->flash('action', $user->action);
                unset($user->action);
                return $user;
            }
        }
        return $this->redirectToIndexPage();
    }

    private function createOrUpdate($request, $user)
    {
        if($request->isMethod('patch'))
        {
            $flag = User::where('id', $user->id)->update($this->defaultParameters($user));
        }
        elseif($request->isMethod('delete'))
        {
            if(Auth::guard('user')->check() && Auth::guard('user')->user()->id == $user->id)
            {
                Auth::guard('user')->logout();
            }
            $flag = User::where('id', $user->id)->update(['active' => FALSE]);
        }
        elseif($request->isMethod('post'))
        {
            $flag = User::create($this->defaultParameters($user));
        }
        return ($flag) ? $this->redirectToCompletePage() : $this->redirectToIndexPage();
    }

    private function showOrEdit($method, $id)
    {
        if($method == 'show' || $method == 'edit')
        {
            $user = User::where('id', $id)
            ->where('active', TRUE)
            ->first();
            if(!is_null($user))
            {
                return view('users/'.$method,[
                    'user' => $user
                ]);
            }
        }
        return $this->redirectToIndexPage();
    }
}
