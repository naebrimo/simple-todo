<div class="card mb-3">
    <div class="card-body">
        <div class="row form-group">
            <div class="col-3">
                <strong class="text-capitalize">name</strong>
            </div>
            <div class="col-9">
                <p class="text-left">
                    {{ $user->name }}
                </p>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-3">
                <strong class="text-capitalize">email</strong>
            </div>
            <div class="col-9">
                <p class="text-left">
                    {{ $user->email }}
                </p>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-3">
                <strong class="text-capitalize">username</strong>
            </div>
            <div class="col-9">
                <p class="text-left">
                    {{ $user->username }}
                </p>
            </div>
        </div>
    </div>
</div>
