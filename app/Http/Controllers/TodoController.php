<?php

namespace App\Http\Controllers;

use App\Todo;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::where('active', 1)->orderby('updated_at', 'asc')->paginate(5);

        return view('todos/index',[
            'todos' => $todos
        ]);
    }
    /**
     * Display a listing of the resource upon search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:3|max:100',
        ]);

        $todos = Todo::where('active', 1)
        ->where('title', 'like', '%'.$request->q.'%')
        //->orwhere('description', 'like', '%'.$request->q.'%')
        ->paginate(5);

        return view('todos/index',[
            'todos' => $todos,
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
        $sort = $request->validate([
            'date' => 'string',
            'title' => 'string',
            'description' => 'string',
        ]);

        if(isset($sort['title']) && in_array($sort['title'], array('asc', 'desc')))
        {
            $todos = Todo::orderby('title', $sort['title'])
            ->where('active', TRUE)
            ->paginate(5);
            $sort['title'] = ($sort['title'] == 'asc') ? 'desc' : 'asc';
        }
        elseif(isset($sort['description']) && in_array($sort['description'], array('asc', 'desc')))
        {
            $todos = Todo::orderby('description', $sort['description'])
            ->where('active', TRUE)
            ->paginate(5);
            $sort['description'] = ($sort['description'] == 'asc') ? 'desc' : 'asc';
        }
        elseif(isset($sort['date']) && in_array($sort['date'], array('asc', 'desc')))
        {
            $todos = Todo::orderby('updated_at', isset($sort['date']) ? $sort['date'] : 'asc')
            ->where('active', TRUE)
            ->paginate(5);
            $sort['date'] = ($sort['date'] == 'asc') ? 'desc' : 'asc';
        }
        else
        {
            $todos = Todo::where('active', 1)
            ->orderby('updated_at', 'asc')
            ->paginate(5);
            $sort['date'] = 'asc';
        }

        return view('todos/index',[
            'todos' => $todos,
            'sort' => $sort
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(session()->has('request'))
        {
            $request = (object) session()->get('request');
            session()->forget('request');
            return view('todos/create',[
                'request' => $request
            ]);
        }
        return view('todos/create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        $formData = $this->validateInputs($request);
        if($formData)
        {
            session()->flash('request', $formData);
            session()->regenerate();

            return view('todos/confirm');
        }
        return redirect(route('todo.create'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if(session()->has('request'))
        {
            $request = (object) session()->get('request');

            $user = User::where('id', Auth::user()->id)->first();
            $isComplete = $user->todos()->create($this->todoParameters($request));

            session()->forget('request');
            session()->flash('isComplete', $isComplete);
            session()->regenerate();

            return redirect(route('todo.complete'));
        }
        return redirect(route('todo.index'));
    }
    /**
     * Display the complete notification page.
     *
     * @return \Illuminate\Http\Response
     */
    public function complete()
    {
        if(session()->has('isComplete'))
        {
            return view('todos/complete');
        }
        return redirect(route('todo.index'));

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!is_null($id))
        {
            $todo = Todo::where('id', $id)->where('active', 1)->first();
            if(!is_null($todo))
            {
                return view('todos/show',[
                    'todo' => $todo
                ]);
            }
            return redirect(route('todo.index'));
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::where('id', $id)->where('active', 1)->first();
        if(!is_null($todo) && $todo->user_id == Auth::user()->id)
        {
            return view('todos/create',[
                'todo' => $todo
            ]);
        }
        return redirect(route('todo.index'));

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
        $this->validateInputs($request);

        $user = User::where('id', Auth::user()->id)->first();

        $isUpdated = $user->todos()->where('id', $id)->update($this->todoParameters($request));

        if($isUpdated)
        {
            session()->flash('message', 'To do list has been updated.');
        }

        return redirect(route('todo.show', $id));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::where('id', $id)->first();

        if(!is_null($todo) && $todo->user_id == Auth::user()->id)
        {
            $todo->active = FALSE;
            $isDeleted = $todo->save();

            if($isDeleted)
            {
                session()->flash('message', 'To do list has been deleted.');
            }

        }
        return redirect(route('todo.index'));
    }

    private function validateInputs($request)
    {
        return $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:3|max:100',
        ]);
    }

    private function todoParameters($request)
    {
        return [
            'title' => $request->title,
            'description' => $request->description,
            'updated_at' => $request->date,
            'active' => TRUE,
        ];
    }
}
