    <div class="row">
        <div class="col-12">
            @if(isset($user->action))
                @if($user->action == 'create')
                    <a class="btn btn-secondary text-capitalize" href="{{ route('user.create') }}">back</a>
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary text-capitalize">create</button>
                    </form>
                @elseif($user->action == 'update')
                    <a class="btn btn-secondary text-capitalize" href="{{ route('user.edit', $user->id) }}">back</a>
                    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-primary text-capitalize">update</button>
                    </form>
                @elseif($user->action == 'destroy')
                    <a class="btn btn-secondary text-capitalize" href="{{ route('user.show', $user->id) }}">back</a>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" enctype="multipart/form-data" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger text-capitalize">confirm delete</button>
                    </form>
                @endif
            @else
                <a class="btn btn-primary text-capitalize" href="{{ route('user.edit', $user->id) }}">edit</a>
                <form action="{{ route('user.confirm', $user->id) }}" method="POST" enctype="multipart/form-data" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger text-capitalize">delete</button>
                </form>
            @endif
        </div>
    </div>

