@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            @error('search')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @enderror
            @if(session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row mb-3">
                <div class="col-6 col-md-6 offset-md-3">
                    <a class="btn btn-link text-dark" href="{{ route('user.index') }}">
                        <h3 class="text-capitalize">user list</h3>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <form class="form-group m-0" action="{{ route('user.search') }}" method="GET">
                        <input class="form-control" type="search" name="q" id="userSearch" value="{{ (isset($search)) ? $search : old('q') }}" placeholder="Search ..." @if(isset($search)) autofocus @endif>
                    </form>
                </div>
            </div>
            <div class="col-12 text-center table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-capitalize" colspan="20%">
                                <form action="{{ route('user.sort') }}" method="GET">
                                    <input type="hidden" name="date" value="{{ (isset($sort['date'])) ? $sort['date'] : 'asc' }}">
                                    <button type="submit" class="btn btn-link text-dark text-capitalize"><strong>date</strong></button>
                                </form>
                            </th>
                            <th class="text-capitalize" colspan="20%">
                                <form action="{{ route('user.sort') }}" method="GET">
                                    <input type="hidden" name="name" value="{{ (isset($sort['name'])) ? $sort['name'] : 'asc' }}">
                                    <button type="submit" class="btn btn-link text-dark text-capitalize"><strong>name</strong></button>
                                </form>
                            </th>
                            <th class="text-capitalize" colspan="25%">
                                <form action="{{ route('user.sort') }}" method="GET">
                                    <input type="hidden" name="email" value="{{ (isset($sort['email'])) ? $sort['username'] : 'asc' }}">
                                    <button type="submit" class="btn btn-link text-dark text-capitalize"><strong>email</strong></button>
                                </form>
                            </th>
                            <th class="text-capitalize" colspan="25%">
                                <form action="{{ route('user.sort') }}" method="GET">
                                    <input type="hidden" name="username" value="{{ (isset($sort['username'])) ? $sort['username'] : 'asc' }}">
                                    <button type="submit" class="btn btn-link text-dark text-capitalize"><strong>username</strong></button>
                                </form>
                            </th>
                            <th colspan="10%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($users) > 0)
                            @foreach($users as $user)
                                <tr>
                                    <td colspan="20%">{{ $user->updated_at->format('Y.m.d') }}</td>
                                    <td class="text-truncate" colspan="20%">
                                        {{ $user->name }}
                                    </td>
                                    <td class="text-truncate" colspan="25%">
                                        {{ $user->email }}
                                    </td>
                                    <td class="text-truncate" colspan="25%">
                                        {{ $user->username }}
                                    </td>
                                    <td colspan="10%">
                                        <div class="btn-group">
                                            <a href="{{ route('user.show', $user->id ) }}" class="btn btn-link btn-sm text-capitalize">show</a>
                                            <a href="{{ route('user.edit', $user->id ) }}" class="btn btn-link btn-sm text-capitalize">edit</a>
                                            <form action="{{ route('user.confirm', $user->id) }}" method="POST" enctype="multipart/form-data" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-link btn-sm text-capitalize">delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-capitalize text-center text-danger" colspan="100%">no data found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-12 text-center mt-3">
                {{ $users->links() }}
            </div>
            <div class="col-12 text-center">
                <hr />
                <a class="btn btn-primary text-capitalize" href="{{ route('user.create') }}">create user</a>
            </div>
        </div>
    </div>
</div>
@endsection
