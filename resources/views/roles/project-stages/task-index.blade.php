@extends('layouts.app', ['activePage' => 'projects', 'titlePage' => __('Project stage task')])

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
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">View Resource Requests</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="roles-table" style="width: 100%!important">
                                    <thead class=" text-primary">
                                    <th>Project</th>
                                    <th>Stage</th>
                                    <th>Task</th>
                                    {{--<th>Description</th>--}}
                                    <th>Last updated date</th>
                                    {{--<th>Facilitator</th>
                                    <th>isClosed</th>
                                    <th>isDone</th>--}}
                                    <tH>Replied</tH>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    @foreach($task_array as $task_arrays)
                                        <tr>
                                            <td>{{$task_arrays->project_name}}</td>
                                            <td>{{$task_arrays->project_stage}}</td>
                                            <td>{{$task_arrays->title}}</td>
                                            {{--<td>{{$task_arrays->description}}</td>--}}
                                            <td>{{$task_arrays->last_updated_date}}</td>
                                           {{-- <td>{{$task_arrays->name}} {{$task_arrays->surname}}</td>--}}
                                           {{-- <td>{{$task_arrays->isClosed}}</td>
                                            <td>{{$task_arrays->isDone}}</td>--}}
                                            <td>{{$task_arrays->is_replied}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" id="{{$task_arrays->id}}" onclick="addTaskReply(this)">View</button>
                                            </td>
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


    @push('custom-scripts')
        <script>
            function addTaskReply(obj) {
                let task_id = obj.id;
                window.location.href = '/portal/add-task-replies/' + task_id;
            }
        </script>

    @endpush

@endsection

