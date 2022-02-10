@extends('layouts.app', ['activePage' => 'add-event', 'titlePage' => __('Add Event')])

@section('content')

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
 <a href="/portal/get-events">
                    <button style="margin-left: 2em" type="submit" id="save-organisation"
                            class="btn btn-primary">{{ __('Back') }}</button>
                </a>
            <div class="row">
                <div class="col-md-12">
                    <form id="add-role" method="post" action="{{url('store-event')}}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Add Event') }}</h4>
                                <p class="card-category">{{ __('Enter Event Information') }}</p>
                            </div>
                            <div class="card-body ">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input name="title" type="text" id="title" class="form-control"
                                                   placeholder="Event title">
                                        </div>
                                        <div class="col">
                                            <label>All day</label>
                                            <select name="all_day" id="type" class="browser-default custom-select">
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
                                            <input name="start_time" type="time" id="start_time" class="form-control"
                                                   placeholder="Start time">
                                        </div>
                                        <div class="col">
                                            <label>Event end time</label>
                                            <input name="end_time" type="time" id="end_time" class="form-control"
                                                   placeholder="End time ">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label>Event start date</label>
                                            <input name="start" type="date" id="start" class="form-control"
                                                   placeholder="Start date">
                                        </div>
                                        <div class="col">
                                            <label>Event end date</label>
                                            <input name="end" type="date" id="end" class="form-control"
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
@endsection

