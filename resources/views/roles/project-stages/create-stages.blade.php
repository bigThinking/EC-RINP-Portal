@extends('layouts.app', ['activePage' => 'add-project', 'titlePage' => __('Add  Stages')])

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
            <div class="row">
                <div class="col-md-12">
                    <form id="add-role" method="post" action="{{url('store-stage')}}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Add Stage') }}</h4>
                                <p class="card-category">{{ __('Enter Stage Information') }}</p>
                            </div>
                            <div class="card-body ">

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('TRL') }}</label>
                                        <div class="col col-sm-7">
                                            <div class="row">
                                                <div class="col col-sm-7">
                                                    <select name="project_stage_id" id="project_stage_id" class="browser-default custom-select">
                                                        @foreach($project_stages as $project)
                                                            <option value="{{$project->id}}" {{$project->id==$project->project_stage?'selected':''}}>{{$project->project_stage}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Start date') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group{{ $errors->has('start_date') ? ' has-danger' : '' }}">
                                                <input name="start_date" type="date" id="start_date" class="form-control"
                                                       placeholder="Start date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('End date') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group{{ $errors->has('end_date') ? ' has-danger' : '' }}">
                                                <input name="end_date" type="date" id="end_date" class="form-control"
                                                       placeholder="End date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Stage description') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group{{ $errors->has('stage_description') ? ' has-danger' : '' }}">
                                                <input name="stage_description" type="text" id="stage_description" class="form-control"
                                                       placeholder="Stage description">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" id="save-stage" class="btn btn-primary">{{ __('Save') }}</button>
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

