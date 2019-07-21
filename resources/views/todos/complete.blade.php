@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="row mb-3">
                <div class="col-8 offset-2">
                    <h3 class="text-capitalize">create to do (complete screen)</h3>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="jumbotron">
                        <div class="container">
                            <h3 class="text-capitalize">Successfully created todo</h3>
                            <a href="{{ route('todo.index') }}" id="" class="btn btn-primary text-capitalize mt-4">todo list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
