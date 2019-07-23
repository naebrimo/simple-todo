<div class="card-body">
    <div class="row form-group">
        <div class="col-3">
            <label class="text-capitalize float-left" for="dateInput"><strong>date</strong></label>
            <small class="text-capitalize text-danger float-right">required</small>
        </div>
        <div class="col-4">
            @if(isset($todo) && isset($todo->updated_at))
                <input id="titleInput" class="form-control" name="date" type="date" value="{{ $todo->updated_at->format('Y-m-d') }}" placeholder="Your date here ..." maxlength="30" required autofocus>
            @else
                <input id="titleInput" class="form-control" name="date" type="date" value="{{ old('date') }}" placeholder="Your date here ..." maxlength="30" required autofocus>
            @endif
        </div>
        <div class="col-5">
            @error('date')
                <small class="text-danger text-left">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="row form-group">
        <div class="col-3">
            <label class="text-capitalize float-left" for="titleInput"><strong>title</strong></label>
            <small class="text-capitalize text-danger float-right">required</small>
        </div>
        <div class="col-4">
            @if(isset($todo) && isset($todo->title))
                <input id="titleInput" class="form-control" name="title" type="text" value="{{ $todo->title }}" placeholder="Your title here ..." maxlength="99" required>
            @else
                <input id="titleInput" class="form-control" name="title" type="text" value="{{ old('title') }}" placeholder="Your title here ..." maxlength="99" required>
            @endif
        </div>
        <div class="col-5">
            @error('title')
                <small class="text-danger text-left">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="row form-group">
        <div class="col-3">
            <label class="text-capitalize float-left" for="descriptionInput"><strong>description</strong></label>
            <small class="text-capitalize text-danger float-right">required</small>
        </div>
        <div class="col-9">
            @if(isset($todo) && isset($todo->description))
                <textarea id="descriptionInput" class="form-control" name="description" placeholder="Your description here ..." maxlength="99" cols="30" rows="5" required>{{ $todo->description }}</textarea>
            @else
                <textarea id="descriptionInput" class="form-control" name="description" placeholder="Your description here ..." maxlength="99" cols="30" rows="5" required>{{  old('description') }}</textarea>
            @endif
        </div>
        <div class="col-9 offset-3">
            @error('description')
                <small class="text-danger text-center">{{ $message }}</small>
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
