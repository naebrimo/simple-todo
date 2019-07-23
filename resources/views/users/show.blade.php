@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="row mb-3">
                <div class="col-3">
                    <a href="{{ route('todo.index') }}" id="" class="btn btn-outline-secondary text-capitalize float-left">back to todo list</a>
                </div>
                <div class="col-6">
                    <h3 class="text-capitalize">show todo</h3>
                </div>
            </div>
            @include('todos/includes/card')
            @if($todo->user_id == Auth::user()->id)
                @include('todos/includes/btngrp')
            @endif
        </div>
    </div>
</div>
@endsection
