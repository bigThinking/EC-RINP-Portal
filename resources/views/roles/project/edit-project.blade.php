@extends('layouts.app', ['activePage' => 'Edit project', 'titlePage' => __('Update project')])

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
                <div class="col-md-12">
                    <form id="edit-role" method="post" action="{{ route('update-user-project',$user->id) }}" class="form-horizontal" >
                        @csrf
                        @method('put')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit project') }}</h4>
                            </div>
                            <div class="card-body ">

                                <div class="form-group">
                                    <div class="row">
                                        <input value="{{$user->id}}" id="role_id" hidden>
                                        <label class="col-sm-2 col-form-label">{{ __('Project name') }}</label>
                                        <div class="col">
                                            <input name="project_name" type="text" id="project_name" value="{{$user->project->project_name}}" class="form-control"
                                                   placeholder="Project Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                                        <div class="col">
                                            <textarea rows = "5" cols = "110" name = "description" id="description" value="{{$user->project->description}}" placeholder="Description">{{$user->project->description}}</textarea><br>
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
