@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            @if(session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row mb-3">
                <div class="col-2">
                    <a href="{{ route('todo.index') }}" id="" class="btn btn-outline-secondary text-capitalize float-left">back to todo list</a>
                </div>
                <div class="col-8">
                    <h3 class="text-capitalize">show todo</h3>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-3">
                            <strong class="text-capitalize">date</strong>
                        </div>
                        <div class="col-9">
                            <p class="text-left">
                                {{ $todo->updated_at->format('Y-m-d') }}
                            </p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-3">
                            <strong class="text-capitalize">title</strong>
                        </div>
                        <div class="col-9">
                            <p class="text-left">
                                {{ $todo->title }}
                            </p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-3">
                            <strong class="text-capitalize">description</strong>
                        </div>
                        <div class="col-9">
                            <p class="text-left">
                                {{ $todo->description }}
                            </p>
                        </div>
                    </div>
                    @if(Auth::user()->id == $todo->user_id)
                        <hr />
                        <div class="row">
                            <div class="col-12">
                                <a class="btn btn-primary text-capitalize" href="{{ route('todo.edit', $todo->id ) }}">edit</a>
                                <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" enctype="multipart/form-data" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger text-capitalize">delete</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
