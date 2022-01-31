@extends('layouts.app', ['activePage' => 'create_call', 'titlePage' => __('Create a new call')])

@section('content')
<?php
    $editing = Route::currentRouteName() == 'edit-call';
 ?>
<div class="content">
    <div class="container-fluid">
        @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
        @endif
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <a href="{{ url()->previous() }}">
            <button style="margin-left: 2em" type="submit" id="save-organisation"
                class="btn btn-primary">{{ __('Back') }}</button>
        </a>
        <div class="row">
            <div class="col-md-12">
                <form id="add-role" method="post"
                    action="{{$editing ? route('update-call', $call->id) : route('save-call')}}" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{$editing ?  __('Edit Call') : __('Create A New Call') }}</h4>
                        </div>
                        <div class="card-body ">
                            <label>Title</label>
                            <input name="title" type="text" id="title" class="form-control">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Call Type</label>
                                        <select name="call_type" id="type" class="browser-default custom-select">
                                        @foreach($call_types as $type)
                                            <option value="{{$type->call_type}}">{{$type->call_type}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label>Sign ups close at:</label>
                                        <input name="closing_date" type="datetime-local" id="closing_date"
                                            class="form-control" placeholder="Closing Date" />
                                    </div>
                                </div>
                            </div>

                            <label>Description</label>
                            <textarea class="form-control" rows="5" cols="110" name="description"
                                id="description"></textarea>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Event starts at:</label>
                                        <input name="start_time" type="datetime-local" id="start" class="form-control"
                                            placeholder="Start date">
                                    </div>
                                    <div class="col">
                                        <label>Event ends at</label>
                                        <input name="end_time" type="datetime-local" id="end" class="form-control"
                                            placeholder="End date ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" id="save-organisation"
                                class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<style>
body {
    background-color: white;
}

.card .card-header-primary .card-icon,
.card .card-header-primary .card-text,
.card .card-header-primary:not(.card-header-icon):not(.card-header-text),
.card.bg-primary,
.card.card-rotate.bg-primary .front,
.card.card-rotate.bg-primary .back {
    background: linear-gradient(60deg, #1E73BE, #1E73BE);
}

.btn.btn-primary {
    background-color: #1E73BE;
}

.text-primary {
    color: #1E73BE !important;
}

.btn.btn-primary:hover {
    background-color: #1E73BE;
}
</style>

@endsection