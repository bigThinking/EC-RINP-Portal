@extends('layouts.app', ['activePage' => 'View task reply', 'titlePage' => __('View Task reply')])

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
        <input value="{{$task->id}}" id="project_id" hidden>
            <div class="row" style="margin-left: 1em">
                <a href="{{'/portal/view-tasks/'.$taskStage->id}}">
                    <button type="submit" id="save-organisation" class="btn btn-primary">{{ __('Back') }}</button>
                </a>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Task replies</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="roles-table" style="width: 100%!important">
                                    <thead class=" text-primary">
                                    <th>Facilitator</th>
                                    <th>Email</th>
                                    <th>Reply Message</th>
                                    </thead>
                                    <tbody>
                                    @foreach($task_array  as $task_arrays)
                                        <tr>
                                            <th>{{$task_arrays->name}} {{$task_arrays->surname}}</th>
                                            <td>{{$task_arrays->email}}</td>
                                            <td>{{$task_arrays->reply}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
