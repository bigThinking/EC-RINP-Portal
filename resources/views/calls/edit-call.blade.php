@extends('layouts.app', ['activePage' => 'edut_call', 'titlePage' => __('Update call')])

@section('content')
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
    </head>

    <div class="content">
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
        <div class="container-fluid">
 <a href="/portal/get-events">
                    <button style="margin-left: 2em" type="submit" id="save-organisation"
                            class="btn btn-primary">{{ __('Back') }}</button>
                </a>
            <div class="row">
                <div class="col-md-12">
                    <form id="edit-role" method="post" action="{{ route('update-event',$event->id) }}" class="form-horizontal" >
                        @csrf
                        @method('put')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit event') }}</h4>
                                <p class="card-category">{{ __('Update Event Information Here') }}</p>
                            </div>
                            <div class="card-body ">
                                <input value="{{$event->id}}" id="role_id" hidden>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input name="title" type="text" id="title" value="{{$event->title}}" class="form-control"
                                                   placeholder="Event title">
                                        </div>
                                        <div class="col">
                                            <label>Event type</label>
                                            <select name="all_day" id="all_day" class="browser-default custom-select">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label>Event start time</label>
                                            <input name="start_time" type="time" id="start_time" value="{{$event->start_time}}" class="form-control"
                                                   placeholder="Start time">
                                        </div>
                                        <div class="col">
                                            <label>Event end time</label>
                                            <input name="end_time" type="time" id="end_time" value="{{$event->end_time}}" class="form-control"
                                                   placeholder="End time ">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label>Event start date</label>
                                            <input name="start" type="date" id="start" value="{{$event->start}}" class="form-control"
                                                   placeholder="Start date">
                                        </div>
                                        <div class="col">
                                            <label>Event end date</label>
                                            <input name="end" type="date" id="end" value="{{$event->end}}" class="form-control"
                                                   placeholder="End date ">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label>Event type</label>
                                            <select name="type" id="type" class="browser-default custom-select">
                                                <option value="Public">Public</option>
                                                <option value="Private">Private</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" id="save-organisation" class="btn btn-primary">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <style>
        body{
            background-color: white;
        }
        .card .card-header-primary .card-icon, .card .card-header-primary .card-text, .card .card-header-primary:not(.card-header-icon):not(.card-header-text), .card.bg-primary, .card.card-rotate.bg-primary .front, .card.card-rotate.bg-primary .back {
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
