@extends('layouts.app', ['activePage' => 'View task', 'titlePage' => __('View Task')])

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
        <input value="{{$stage->id}}" id="task-id-input" hidden>

            <div class="row" style="margin-left: 1em">
                <a href="{{'/portal/incubatee-edit-user-project/'.$stage->project->id}}"> <button type="submit" id="save-organisation" class="btn btn-primary">{{ __('Back') }}</button></a>
                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseTask" role="button"
                       aria-expanded="false" aria-controls="collapseRoleCreate">
                        Add task to this stage
                    </a>
                </p>
        </div>
        <div class="row collapse" id="collapseTask">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <form id="edit-role" method="post"
                              action="{{ route('assign-task-to-project-stage',$stage->id) }}"
                              class="form-horizontal">
                            @csrf
                            @method('put')
                            <div class="card ">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">{{ __('Add task to this stage') }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                                            <div class="col">
                                                <input name="title" type="text" id="title"  class="form-control"
                                                       >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                                            <div class="col">
                                                <textarea rows = "5" cols = "80" name = "description" id="description"></textarea><br>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">{{ __('Date') }}</label>
                                            <div class="col">
                                                <input name="last_updated_date" type="date" id="last_updated_date"  class="form-control"
                                                      >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">{{ __('Facilitator') }}</label>
                                            <div class="col" style="overflow-y: scroll; height:100px;">
                                                @foreach($users as $user)
                                                <p>
                                                    <label>
                                                        <input type="checkbox" name="user_id[]" value="{{$user->id}}"> <label>{{$user->name}}  {{$user->surname}}</label>
                                                    </label>
                                                </p>
                                                @endforeach
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

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Project stage task</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="roles-table" style="width: 100%!important">
                                <thead class=" text-primary">
                                <th>Project</th>
                                <th>Stage</th>
                                <th>Task Title</th>
                                <th>Description</th>
                                <th>Last updated date</th>
                                <th>Facilitator</th>
                                <th>Replied</th>
                                <th>Closed/Open</th>
                                <th>Closing report</th>
                                <th>Date closed</th>
                                <th></th>
                                </thead>
                                <tbody>
                                @foreach($task_array_two  as $task_arrays)
                                    <tr>
                                        <td>{{$task_arrays->project_name}}</td>
                                        <td>{{$task_arrays->project_stage}}</td>
                                        <td>{{$task_arrays->title}}</td>
                                        <td>{{$task_arrays->description}}</td>
                                        <td>{{$task_arrays->last_updated_date}}</td>
                                        <td>{{$task_arrays->name}} {{$task_arrays->surname}}</td>
                                        <td>{{$task_arrays->is_replied}}</td>
                                        <td>{{$task_arrays->isClosed}}</td>
                                        <td>{{$task_arrays->closing_report}}</td>
                                        <td>{{$task_arrays->date_closed}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" id="{{$task_arrays->id}}"
                                                    onclick="viewReply(this)">View reply
                                            </button>
                                            <button type="button"  class="btn btn-primary" id="{{$task_arrays->id}}"
                                                    onclick="closeTask(this)">Close Task
                                            </button>
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

    @push('custom-scripts')
        <script>

            function viewReply(obj) {
                let task_id = obj.id;
                window.location.href = '/portal/view-task-reply/' + task_id;
            }

            function closeTask(obj) {
                let task_id = obj.id;
                window.location.href = '/portal/edit-close-task/' + task_id;
            }

        </script>

    @endpush

@endsection
