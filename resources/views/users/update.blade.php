@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="row mb-3">
                <div class="col-2">
                    <a href="{{ route('todo.index') }}" id="" class="btn btn-outline-secondary text-capitalize float-left">back to todo list</a>
                </div>
                <div class="col-8">
                    @if(isset($todo))
                        <h3 class="text-capitalize">edit todo</h3>
                    @else
                        <h3 class="text-capitalize">create todo</h3>
                    @endif
                </div>
            </div>
            @if(isset($todo))
                <form action="{{ route('todo.update', $todo->id) }}" method="POST" enctype="multipart/form-data" id="todoForm" class="card">
                @method('PATCH')
            @else
                <form action="{{ route('todo.confirm') }}" method="POST" enctype="multipart/form-data" id="todoForm" class="card">
            @endif
                @csrf
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-3">
                            <label class="text-capitalize float-left" for="dateInput"><strong>date</strong></label>
                            <small class="text-capitalize text-danger float-right">required</small>
                        </div>
                        <div class="col-4">
                            @if(isset($request->date))
                                <input id="titleInput" class="form-control" name="date" type="date" value="{{ $request->date }}" placeholder="Your date here ..." maxlength="30" required autofocus>
                            @else
                                <input id="titleInput" class="form-control" name="date" type="date" value="{{ isset($todo) ? $todo->updated_at->format('Y-m-d') : old('date') }}" placeholder="Your date here ..." maxlength="30" required autofocus>
                            @endif
                        </div>
                        <div class="col-5">
                            @error('date')
                                <small class="text-danger text-left">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-3">
                            <label class="text-capitalize float-left" for="titleInput"><strong>title</strong></label>
                            <small class="text-capitalize text-danger float-right">required</small>
                        </div>
                        <div class="col-4">
                            @if(isset($request->title))
                                <input id="titleInput" class="form-control" name="title" type="text" value="{{ $request->title }}" placeholder="Your title here ..." maxlength="100" required>
                            @else
                                <input id="titleInput" class="form-control" name="title" type="text" value="{{ isset($todo) ? $todo->title : old('title') }}" placeholder="Your title here ..." maxlength="100" required>
                            @endif
                        </div>
                        <div class="col-5">
                            @error('title')
                                <small class="text-danger text-left">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-3">
                            <label class="text-capitalize float-left" for="descriptionInput"><strong>description</strong></label>
                            <small class="text-capitalize text-danger float-right">required</small>
                        </div>
                        <div class="col-9">
                            @if(isset($request->description))
                                <textarea id="descriptionInput" class="form-control" name="description" placeholder="Your description here ..." maxlength="100" cols="30" rows="5" required>{{ $request->description }}</textarea>
                            @else
                                <textarea id="descriptionInput" class="form-control" name="description" placeholder="Your description here ..." maxlength="100" cols="30" rows="5" required>{{ isset($todo) ? $todo->description : old('description') }}</textarea>
                            @endif
                        </div>
                        <div class="col-9 offset-3">
                            @error('description')
                                <small class="text-danger text-center">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-secondary text-capitalize" type="reset">clear</button>
                            <button class="btn btn-primary text-capitalize" type="submit">next</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
