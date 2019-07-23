<div class="card mb-3">
    <div class="card-body">
        <div class="row form-group">
            <div class="col-3">
                <strong class="text-capitalize">date</strong>
            </div>
            <div class="col-9">
                <p class="text-left">
                    {{ isset($todo->date) ? $todo->date : $todo->updated_at->format('Y.m.d') }}
                </p>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-3">
                <strong class="text-capitalize">title</strong>
            </div>
            <div class="col-9">
                <p class="text-left">
                    {{ $todo->title }}
                </p>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-3">
                <strong class="text-capitalize">description</strong>
            </div>
            <div class="col-9">
                <p class="text-left">
                    {{ $todo->description }}
                </p>
            </div>
        </div>
    </div>
</div>
