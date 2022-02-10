@extends('layouts.app', ['activePage' => 'Graduate stage', 'titlePage' => __('Graduate stage')])

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
        <div class="row" style="margin-left: 1em">
            <a href="{{'/portal/incubatee-edit-user-project/'.$stage->project->id}}">
                <button type="submit" id="save-organisation" class="btn btn-primary">{{ __('Back') }}</button>
            </a>
            @if($stage->stageClosed == 'Yes')
            <p style="margin-left: 1em">Stage is graduated</p>
                @else
                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseGraduation" role="button"
                       aria-expanded="false" aria-controls="collapseRoleCreate">
                        Create graduation stage
                    </a>
                </p>
            @endif

        </div>
        <div class="row collapse" id="collapseGraduation">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <form id="edit-role" method="post"
                              action="{{ route('assign-graduation-stage-to-project',$stage->id) }}"
                              class="form-horizontal">
                            @csrf
                            @method('put')
                            <input value="{{$stage->id}}" id="project_id" hidden>
                            <div class="card ">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">{{ __('Graduation Stage') }}</h4>
                                    <p class="card-category">{{ __('Create Graduation Stage') }}</p>
                                </div>
                                <div class="card-body ">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">{{ __('Previous stage') }}</label>
                                            <div class="col">
                                                <input name="project_stage" type="text" disabled value="{{$stage->projectStages->project_stage}}" id="project_stage" class="form-control" placeholder="Previous stage">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">{{ __('Next stage') }}</label>
                                            <div class="col">
                                                <select  name="next_stage_name" id="next_stage_name"
                                                         class="browser-default custom-select">
                                                    <option>Choose project stage</option>
                                                    @foreach($projectStages as $project_stages)
                                                        <option
                                                            value="{{$project_stages->project_stage}}">{{$project_stages->project_stage}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">{{ __('Progress summary') }}</label>
                                            <div class="col">
                                                <input name="progress_summary" type="text" id="progress_summary" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">{{ __('Graduation date') }}</label>
                                            <div class="col">
                                                <input name="graduation_date" type="date" id="graduation_date" class="form-control" placeholder="Graduation date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">{{ __('Next stage') }}</label>
                                            <div class="col">
                                                <select  name="project_stage_id" id="project_stage_id"
                                                         class="browser-default custom-select">
                                                    <option>Next stage</option>
                                                    @foreach($projectStages as $project_stages)
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
                                                <input name="start_date" type="date" id="start_date" class="form-control" placeholder="Start date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">{{ __('End date') }}</label>
                                            <div class="col">
                                                <input name="end_date" type="date" id="end_date" class="form-control" placeholder="End date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">{{ __('Stage Description') }}</label>
                                            <div class="col">
                                                <textarea rows = "5" cols = "80" name = "stage_description" id="stage_description"></textarea><br>
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
                        <h4 class="card-title ">Graduation stages</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="roles-table" style="width: 100%!important">
                                <thead class=" text-primary">
                                <th>Project</th>
                                <th>Previous stage</th>
                                <th>Next Stage</th>
                                <th>Progress Summary</th>
                                <th>Graduation date</th>
                                </thead>
                                <tbody>
                                @foreach($graduation_stage as $graduation_stage_arrays)
                                    <tr>
                                        <td>{{$graduation_stage_arrays->project_name}}</td>
                                        <td>{{$graduation_stage_arrays->previous_stage}}</td>
                                        <td>{{$graduation_stage_arrays->next_stage_name}}</td>
                                        <td>{{$graduation_stage_arrays->progress_summary}}</td>
                                        <td>{{$graduation_stage_arrays->graduation_date}}</td>
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
    
@endsection
