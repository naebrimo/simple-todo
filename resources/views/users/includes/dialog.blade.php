<div class="card">
    <div class="card-body">
        <div class="jumbotron m-0">
            <div class="container">
                @if(session()->has('action'))
                    @if(session()->get('action') == 'create')
                        <h3 class="text-capitalize">successfully created user</h3>
                    @elseif(session()->get('action') == 'update')
                        <h3 class="text-capitalize">successfully update user</h3>
                    @elseif(session()->get('action') == 'destroy')
                        <h3 class="text-capitalize">successfully deleted user</h3>
                    @endif
                @else
                    <h3 class="text-capitalize">I am not sure why you were here.</h3>
                @endif
                <a href="{{ route('user.index') }}" id="" class="btn btn-primary text-capitalize mt-4">user list</a>
            </div>
        </div>
    </div>
</div>



