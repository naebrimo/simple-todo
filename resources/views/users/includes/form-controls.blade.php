<div class="card-body">
    <div class="row form-group">
        <div class="col-4">
            <label class="text-capitalize float-left" for="nameInput"><strong>name</strong></label>
            <small class="text-capitalize text-danger float-right">required</small>
        </div>
        <div class="col-5">
            @if(isset($user) && isset($user->name))
                <input id="nameInput" class="form-control" name="name" type="text" value="{{ $user->name }}" placeholder="User name here ..." maxlength="99" required autofocus>
            @else
                <input id="nameInput" class="form-control" name="name" type="text" value="{{ old('name') }}" placeholder="User name here ..." maxlength="99" required autofocus>
            @endif
        </div>
        <div class="col-3">
            @error('name')
                <small class="text-danger text-left">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="row form-group">
        <div class="col-4">
            <label class="text-capitalize float-left" for="emailInput"><strong>email</strong></label>
            <small class="text-capitalize text-danger float-right">required</small>
        </div>
        <div class="col-5">
            @if(isset($user) && isset($user->email))
                <input id="emailInput" class="form-control" name="email" type="email" value="{{ $user->email }}" placeholder="User email here ..." maxlength="99" required>
            @else
                <input id="emailInput" class="form-control" name="email" type="email" value="{{ old('email') }}" placeholder="User email here ..." maxlength="99" required>
            @endif
        </div>
        <div class="col-3">
            @error('email')
                <small class="text-danger text-left">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="row form-group">
        <div class="col-4">
            <label class="text-capitalize float-left" for="usernameInput"><strong>username</strong></label>
            <small class="text-capitalize text-danger float-right">required</small>
        </div>
        <div class="col-5">
            @if(isset($user) && isset($user->username))
                <input id="usernameInput" class="form-control" name="username" type="text" value="{{ $user->username }}" placeholder="Username here ..." maxlength="99" required>
            @else
                <input id="usernameInput" class="form-control" name="username" type="text" value="{{ old('username') }}" placeholder="Username here ..." maxlength="99" required>
            @endif
        </div>
        <div class="col-3">
            @error('username')
                <small class="text-danger text-left">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="row form-group">
        <div class="col-4">
            <label class="text-capitalize float-left" for="passwordInput"><strong>password</strong></label>
            <small class="text-capitalize text-danger float-right">required</small>
        </div>
        <div class="col-5">
            @if(isset($user) && isset($user->password))
                <input id="passwordInput" class="form-control" name="password" type="password" value="" placeholder="User password here ..." maxlength="99" required>
            @else
                <input id="passwordInput" class="form-control" name="password" type="password" value="" placeholder="User password here ..." maxlength="99" required>
            @endif
        </div>
        <div class="col-3">
            @error('password')
                <small class="text-danger text-left">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="row form-group">
        <div class="col-4">
            <label class="text-capitalize float-left" for="passwordConfirmInput"><strong>confirm password</strong></label>
            <small class="text-capitalize text-danger float-right">required</small>
        </div>
        <div class="col-5">
            @if(isset($user) && isset($user->password_confirmation))
                <input id="passwordConfirmInput" class="form-control" name="password_confirmation" type="password" value="" placeholder="Re-enter your password here ..." maxlength="99" required>
            @else
                <input id="passwordConfirmInput" class="form-control" name="password_confirmation" type="password" value="" placeholder="Re-enter your password here ..." maxlength="99" required>
            @endif
        </div>
        <div class="col-3">
            @error('password_confirmation')
                <small class="text-danger text-left">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-12">
            <button class="btn btn-secondary text-capitalize" type="reset">clear</button>
            <button class="btn btn-primary text-capitalize" type="submit">next</button>
        </div>
    </div>
</div>
