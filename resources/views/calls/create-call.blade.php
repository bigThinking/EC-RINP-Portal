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
        <a href="{{ old('redirect_to', URL::previous())}}">
            <button style="margin-left: 2em" type="submit" id="save-organisation"
                class="btn btn-primary">{{ __('Back') }}</button>
        </a>
        <div class="row">
            <div class="col-md-12">
                <form id="add-role" method="post"
                    action="{{$editing ? route('update-call', $call->id) : route('save-call')}}" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    @if($editing)
                    @method('put')
                    @else
                    @method('post')
                    @endif
                    {!! Form::hidden('redirect_to', old('redirect_to', URL::previous())) !!}
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{$editing ?  __('Edit Call') : __('Create A New Call') }}</h4>
                        </div>
                        <div class="card-body ">
                            <label>Title</label>
                            <input name="title" type="text" id="title" class="form-control" value="{{ $editing ? old('title', $call->title) : '' }}"></input>
                            @if ($errors->has('title'))
                                <div id="title-error" class="error text-danger pl-3" for="title"
                                    style="display: block;">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </div>
                            @endif

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Call Type</label>
                                        <select name="call_type" id="call_type" class="browser-default custom-select">
                                        @if(!$editing)
                                        <option value="" selected disabled>Please select a call type</option>
                                        @endif
                                        @foreach($call_types as $type)
                                            <option value="{{$type->call_type}}" {{ ($editing && $type->call_type == $call->call_type) ? 'selected' : ''}} >{{$type->call_type}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label>Applications close at:</label>
                                        <input name="closing_date" type="date" id="closing_date"
                                            class="form-control" placeholder="Closing Date" value="{{ $editing ? old('closing_date', $call->closing_date) : ''}}" />
                                    </div>
                                </div>
                            </div>

                            <div>
                            <label>Description</label>
                            <textarea class="form-control" rows="5" cols="110" name="description"
                                id="description">{{ $editing ? old('description', $call->description) : ''}}</textarea>
                                @if ($errors->has('description'))
                                <div id="description-error" class="error text-danger pl-3" for="description"
                                    style="display: block;">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </div>
                                @endif
                            </div>

                            <div style="padding: top 15px;">
                            <label>Image</label>
                            <input type="file" id="image" name="image" class="form-control" placeholder="Call Image" accept="image/*">
                            @if ($errors->has('image'))
                                <div id="image-error" class="error text-danger pl-3" for="image"
                                    style="display: block;">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </div>
                                @endif
                            </div>

                            <div name="event_time" id="event_time" class="form-group" style="display:{{ ($editing && $call->call_type == 'Event') ? '' : 'none;'}}">
                                <div class="row">
                                    <div class="col">
                                        <label>Event starts at:</label>
                                        <input name="start_time" type="datetime-local" id="start" class="form-control"
                                            placeholder="Start date" value="{{ $editing ? old('start_time', $call->start_time) : ''}}">
                                    </div>
                                    <div class="col">
                                        <label>Event ends at</label>
                                        <input name="end_time" type="datetime-local" id="end" class="form-control"
                                            placeholder="End date " value="{{ $editing ? old('end_time', $call->end_time) : ''}}">
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

@push('custom-scripts')
<script>
$(document).ready(function () {
                $("#call_type").change(function () {
                    var inputVal = $(this).val();
                    if(inputVal != "Event")
                    $("#event_time").hide();
                    else
                    $("#event_time").show();
                });
            });

</script>
@endpush
@endsection