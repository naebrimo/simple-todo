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
        $users = User::where('active', 1)
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
        if($request->q == '') return redirect(route('todo.index'));
        $request->validate(['q' => 'string|max:100']);

        $users = User::where('active', 1)
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
            $todo = (object) $this->validateInputs($request);
            $todo->action = 'create';
        }
        elseif($request->isMethod('patch'))
        {
            $todo = (object) $this->validateInputs($request);
            $todo->id = $id;
            $todo->action = 'update';
        }
        elseif($request->isMethod('delete'))
        {
            $todo = Todo::where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->where('active', 1)
            ->first();
            if(!is_null($todo)) $todo->action = 'destroy';
        }

        if(isset($todo))
        {
            session()->flash('todo', $todo);
            session()->regenerate();

            return view('todos/confirm',[
                'todo' => $todo
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
        return view('todos/create');
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
            return view('todos/complete');
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
        $todo = $this->getSessionFromConfirmPage($request);
        return $this->createOrUpdate($request, $todo);
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
        $todo = $this->getSessionFromConfirmPage($request, $id);
        return $this->createOrUpdate($request, $todo);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $todo = $this->getSessionFromConfirmPage($request, $id);
        return $this->createOrUpdate($request, $todo);
    }

    private function validateInputs($request)
    {
        return $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'title' => 'required|min:2|max:99',
            'description' => 'required|min:2|max:99',
        ]);
    }

    private function defaultParameters($request)
    {
        return [
            'title' => $request->title,
            'description' => $request->description,
            'updated_at' => $request->date,
            'active' => TRUE,
        ];
    }

    private function redirectToCompletePage()
    {
        session()->forget('todo');
        session()->reflash();
        session()->regenerate();

        return redirect(route('todo.complete'));
    }

    private function redirectToIndexPage()
    {
        if(session()->has('action'))
        {
            session()->forget('action');
        }

        if(session()->has('todo'))
        {
            session()->forget('todo');
        }

        session()->regenerate();
        return redirect(route('todo.index'));
    }

    private function getSessionFromConfirmPage($request, $id = null)
    {


        if(session()->has('todo'))
        {
            if($request->isMethod('post') ||
                $request->isMethod('patch') ||
                $request->isMethod('delete'))
            {
                $todo = session()->get('todo');

                if($request->isMethod('patch') || $request->isMethod('delete'))
                {
                    if(!is_null($id) && $id != $todo->id)
                    {
                        return $this->redirectToIndexPage();
                    }
                }
                session()->flash('action', $todo->action);
                unset($todo->action);
                return $todo;
            }
        }
        return $this->redirectToIndexPage();
    }

    private function createOrUpdate($request, $todo)
    {
        $user = User::where('id', Auth::user()->id)->first();
        if($request->isMethod('patch'))
        {
            $flag = $user->todos()->where('id', $todo->id)->update($this->defaultParameters($todo));
        }
        elseif($request->isMethod('delete'))
        {
            $flag = $user->todos()->where('id', $todo->id)->update(['active' => FALSE]);
        }
        elseif($request->isMethod('post'))
        {
            $flag = $user->todos()->create($this->defaultParameters($todo));
        }
        return ($flag) ? $this->redirectToCompletePage() : $this->redirectToIndexPage();
    }

    private function showOrEdit($method, $id)
    {
        if($method == 'show' || $method == 'edit')
        {
            $todo = Todo::where('id', $id)
            ->where('active', 1)
            ->first();

            if($method == 'edit' && $todo->user_id  != Auth::user()->id)
            {
                return $this->redirectToIndexPage();
            }
            if(!is_null($todo))
            {
                return view('todos/'.$method,[
                    'todo' => $todo
                ]);
            }
        }
        return $this->redirectToIndexPage();
    }
}
