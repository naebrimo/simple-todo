    <div class="row">
        <div class="col-12">
            @if(isset($todo->action))
                @if($todo->action == 'create')
                    <a class="btn btn-secondary text-capitalize" href="{{ route('todo.create') }}">back</a>
                    <form action="{{ route('todo.store') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary text-capitalize">create</button>
                    </form>
                @elseif($todo->action == 'update')
                    <a class="btn btn-secondary text-capitalize" href="{{ route('todo.edit', $todo->id) }}">back</a>
                    <form action="{{ route('todo.update', $todo->id) }}" method="POST" enctype="multipart/form-data" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-primary text-capitalize">update</button>
                    </form>
                @elseif($todo->action == 'destroy')
                    <a class="btn btn-secondary text-capitalize" href="{{ route('todo.show', $todo->id) }}">back</a>
                    <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" enctype="multipart/form-data" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger text-capitalize">confirm delete</button>
                    </form>
                @endif
            @else
                <a class="btn btn-primary text-capitalize" href="{{ route('todo.edit', $todo->id) }}">edit</a>
                <form action="{{ route('todo.confirm', $todo->id) }}" method="POST" enctype="multipart/form-data" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger text-capitalize">delete</button>
                </form>
            @endif
        </div>
    </div>

