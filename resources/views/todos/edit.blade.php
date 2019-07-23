@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="row mb-3">
                <div class="col-2">
                    <a href="{{ route('todo.show', $todo->id) }}" id="" class="btn btn-outline-secondary text-capitalize float-left">back to show todo</a>
                </div>
                <div class="col-8">
                    <h3 class="text-capitalize">edit todo</h3>
                </div>
            </div>
            <form action="{{ route('todo.confirm', $todo->id) }}" method="POST" enctype="multipart/form-data" id="todoForm" class="card">
                @csrf
                @method('PATCH')
                @include('todos/includes/form-controls')
            </form>
        </div>
    </div>
</div>
@endsection
