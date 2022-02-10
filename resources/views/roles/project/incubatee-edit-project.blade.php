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
        {{-- Project--}}
        <div class="container-fluid">
            <div class="row">
                <a href="/portal/project-index">
                    <button style="margin-left: 2em" type="submit" id="save-organisation"
                            class="btn btn-primary">{{ __('Back') }}</button>
                </a>
                <div class="col-md-12">
                    <form id="edit-role" method="post" action="{{ route('close-project',$project->id) }}"
                          class="form-horizontal">
                        @csrf
                        @method('put')
                        @if($project->project_closed !=null)
                            <p>This project is CLOSED</p>
                        @else
                            <p></p>
                        @endif
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('View project') }}</h4>
                            </div>
                            <div class="card-body ">

                                <div class="form-group">
                                    <div class="row">
                                        <input value="{{$project->id}}" id="role_id" hidden>
                                        <label class="col-sm-2 col-form-label">{{ __('Project name') }} :</label>
                                        <div class="col">
                                            <p>{{$project->project_name}}</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Description') }} :</label>
                                        <div class="col">
                                            <p rows="5" cols="140" name="description" id="description"
                                               disabled>{{$project->description}}</p><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <p>
                                        <button  type="submit" id="is-closed"
                                                 class="btn btn-primary">{{ __('Close Project') }}</button>
                                    </p>

                                    <p>
                                        <a class="btn btn-primary" style="margin-left: 1em" data-toggle="collapse"
                                           href="#collapseStage" role="button"
                                           aria-expanded="false" aria-controls="collapseRoleCreate">
                                            Create Project stage
                                        </a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{--Create project stage--}}
            <div class="row collapse" id="collapseStage">
                <div class="row">
                    <div class="col-md-8">
                        <form id="edit-role" method="post" action="{{ route('assign-stage-to-project',$project->id) }}"
                              class="form-horizontal">
                            @csrf
                            @method('put')
                            <div class="card ">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">{{ __('Create Project Stage') }}</h4>
                                </div>
                                <input value="{{$project->id}}" id="project_id" hidden>
                                <div class="row">
                                    <div class="card-body ">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">{{ __('Project stage') }}</label>
                                                <div class="col">
                                                    <select name="project_stage_id" id="project_stage_id"
                                                            class="browser-default custom-select">
                                                        <option>Choose project stage</option>
                                                        @foreach($project_stage as $project_stages)
                                                            <option
                                                                value="{{$project_stages->id}}">{{$project_stages->project_stage}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">{{ __('Start date') }}</label>
                                                <div class="col">
                                                    <input name="start_date" type="date" id="start_date"
                                                           class="form-control"
                                                           placeholder="Start date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">{{ __('End date') }}</label>
                                                <div class="col">
                                                    <input name="end_date" type="date" id="end_date"
                                                           class="form-control"
                                                           placeholder="End date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                                                <div class="col">
                                                    <textarea class="form-control" rows="5" cols="50" name="stage_description"
                                                              id="stage_description"
                                                             ></textarea><br>
                                                </div>
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

        {{--Project stages--}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Projects Stages</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="roles-table" style="width: 100%!important">
                                <thead class=" text-primary">
                                <th>Stage</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Stage description</th>
                                <th>Stage closed</th>
                                <th>Actions</th>
                                </thead>
                                <tbody>
                                @foreach($project_array as $projects)
                                    <tr>
                                        <td>{{$projects->project_stage}}</td>
                                        <th>{{$projects->start_date}}</th>
                                        <th>{{$projects->end_date}}</th>
                                        <th>{{$projects->stage_description}}</th>
                                        <th>{{$projects->stageClosed}}</th>
                                        <td>
                                            <button type="button" class="btn btn-primary" id="{{$projects->id}}"
                                                    onclick="editProjectStage(this)">Edit
                                            </button>
                                            <button type="button" class="btn btn-primary" id="{{$projects->id}}"
                                                    onclick="viewTask(this)">View Task
                                            </button>
                                             @if($projects->stageClosed == 'Yes')

                                            @else
                                                <button type="button" class="btn btn-primary" id="{{$projects->id}}"
                                                        onclick="graduate(this)">Graduate
                                                </button>
                                            @endif
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
            function editProjectStage(obj) {
                let stage_id = obj.id;
                window.location.href = '/portal/edit-stages/' + stage_id;
            }

            function viewTask(obj) {
                let stage_id = obj.id;
                window.location.href = '/portal/view-tasks/' + stage_id;
            }

            function graduate(obj) {
                let stage_id = obj.id;
                window.location.href = '/portal/graduate-stage/' + stage_id;
            }

        </script>
    @endpush

@endsection
