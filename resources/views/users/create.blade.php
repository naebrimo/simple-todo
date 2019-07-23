@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="row mb-3">
                <div class="col-3">
                    <a href="{{ route('user.index') }}" id="" class="btn btn-outline-secondary text-capitalize float-left">back to user list</a>
                </div>
                <div class="col-6">
                    <h3 class="text-capitalize">create user</h3>
                </div>
            </div>
            <form action="{{ route('user.confirm') }}" method="POST" enctype="multipart/form-data" id="userForm" class="card">
                @csrf
                @include('users/includes/form-controls')
            </form>
        </div>
    </div>
</div>
@endsection
