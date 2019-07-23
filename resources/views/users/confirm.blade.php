@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="row mb-3">
                    <div class="col-8 offset-2">
                        @if(isset($user->action))
                            @if($user->action == 'create')
                                <h3 class="text-capitalize">Do you want to add this to list?</h3>
                            @elseif($user->action == 'update')
                                <h3 class="text-capitalize">Do you want to update this from list?</h3>
                            @elseif($user->action == 'destroy')
                                <h3 class="text-capitalize">Do you really want to delete this from list?</h3>
                            @endif
                        @else
                            <h3 class="text-capitalize">Confirmation Page</h3>
                        @endif
                    </div>
                </div>
                @include('users/includes/card')
                @include('users/includes/btngrp')
            </div>
        </div>
    </div>
@endsection
