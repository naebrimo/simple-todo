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
                    <a class="btn btn-link text-dark" href="{{ route('todo.index') }}">
                        <h3 class="text-capitalize">todo list</h3>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <form class="form-group m-0" action="{{ route('todo.search') }}" method="GET">
                        <input class="form-control" type="search" name="q" id="todoSearch" value="{{ (isset($search)) ? $search : old('q') }}" placeholder="Search ..." @if(isset($search)) autofocus @endif>
                    </form>
                </div>
            </div>
            <div class="col-12 text-center table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-capitalize" colspan="20%">
                                <form action="{{ route('todo.sort') }}" method="GET">
                                    <input type="hidden" name="date" value="{{ (isset($sort['date'])) ? $sort['date'] : 'asc' }}">
                                    <button type="submit" class="btn btn-link text-dark text-capitalize"><strong>date</strong></button>
                                </form>
                            </th>
                            <th class="text-capitalize" colspan="20%">
                                <form action="{{ route('todo.sort') }}" method="GET">
                                    <input type="hidden" name="title" value="{{ (isset($sort['title'])) ? $sort['title'] : 'asc' }}">
                                    <button type="submit" class="btn btn-link text-dark text-capitalize"><strong>title</strong></button>
                                </form>
                            </th>
                            <th class="text-capitalize" colspan="50%">
                                <form action="{{ route('todo.sort') }}" method="GET">
                                    <input type="hidden" name="description" value="{{ (isset($sort['description'])) ? $sort['description'] : 'asc' }}">
                                    <button type="submit" class="btn btn-link text-dark text-capitalize"><strong>description</strong></button>
                                </form>
                            </th>
                            <th colspan="10%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($todos) > 0)
                            @foreach($todos as $todo)
                                <tr>
                                    <td colspan="20%">{{ $todo->updated_at->format('Y.m.d') }}</td>
                                    <td class="text-truncate" colspan="20%">
                                        <p title="{{ $todo->title }}" class="d-inline-block text-truncate" style="max-width: 125px;">
                                            {{ $todo->title }}
                                        </p>
                                    </td>
                                    <td class="text-truncate" colspan="50%">
                                        <p title="{{ $todo->description }}" class="d-inline-block text-truncate" style="max-width: 125px;">
                                            {{ $todo->description }}
                                        </p>
                                    </td>
                                    <td colspan="10%">
                                        <div class="btn-group">
                                            <a href="{{ route('todo.show', $todo->id ) }}" class="btn btn-link btn-sm text-capitalize">show</a>
                                            @if(Auth::user()->id == $todo->user_id)
                                                <a href="{{ route('todo.edit', $todo->id ) }}" class="btn btn-link btn-sm text-capitalize">edit</a>
                                                <form action="{{ route('todo.confirm', $todo->id) }}" method="POST" enctype="multipart/form-data" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-link btn-sm text-capitalize">delete</button>
                                                </form>
                                            @endif
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
                {{ $todos->links() }}
            </div>
            <div class="col-12 text-center">
                <hr />
                <a class="btn btn-primary text-capitalize" href="{{ route('todo.create') }}">create todo</a>
            </div>
        </div>
    </div>
</div>
@endsection
