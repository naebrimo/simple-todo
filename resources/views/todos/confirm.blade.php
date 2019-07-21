@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="row mb-3">
                <div class="col-8 offset-2">
                    <h3 class="text-capitalize">create to do (confirmation screen)</h3>
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
                                {{ session()->get('request')['date'] }}
                            </p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-3">
                            <strong class="text-capitalize">title</strong>
                        </div>
                        <div class="col-9">
                            <p class="text-left">
                                {{ session()->get('request')['title'] }}
                            </p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-3">
                            <strong class="text-capitalize">description</strong>
                        </div>
                        <div class="col-9">
                            <p class="text-left">
                                {{ session()->get('request')['description'] }}
                            </p>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-secondary text-capitalize" href="{{ route('todo.create') }}">back</a>
                            <form action="{{ route('todo.store') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-primary text-capitalize">create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
