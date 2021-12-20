@extends('layouts.app', ['activePage' => 'Edit project stage', 'titlePage' => __('Update  stage')])

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
            <div class="row">
                <a href="{{'/portal/incubatee-edit-user-project/'.$stage->project->id}}"> <button type="submit" id="save-organisation" class="btn btn-primary">{{ __('Back') }}</button></a>

                <div class="col-md-12">
                    <form id="edit-role" method="post" action="{{ route('update-stage',$stage->id) }}" class="form-horizontal" >
                        @csrf
                        @method('put')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit stage') }}</h4>
                            </div>
                            <input value="{{$stage->id}}" id="role_id" hidden>
                            <div class="card-body ">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('TRL') }}</label>
                                        <div class="col col-sm-7">
                                            <div class="row">
                                                <div class="col col-sm-7">
                                                    <select name="project_stage_id" id="project_stage_id" class="browser-default custom-select">
                                                        <option value="{{isset($stage->project_stage_id) ? $stage->project_stage_id : null}}">{{isset($stage->projectStages->project_stage) ? $stage->projectStages->project_stage : 'Please select stage'}}</option>
                                                        @foreach($project_stage as $project)
                                                            <option value="{{$project->id}}">{{$project->project_stage}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Start date') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <input name="start_date" value="{{$stage->start_date}}" type="date" id="start_date" class="form-control"
                                                       placeholder="Start date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('End date') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <input name="end_date" value="{{$stage->end_date}}"  type="date" id="end_date" class="form-control"
                                                       placeholder="End date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">{{ __('Stage description') }}</label>
                                            <div class="col">
                                                <textarea rows = "5" cols = "90" name = "stage_description" id="stage_description" value="{{$stage->stage_description}}" >{{$stage->stage_description}}</textarea><br>
                                            </div>
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
