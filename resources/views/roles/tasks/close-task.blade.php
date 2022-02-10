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
            <input value="{{$task->id}}" id="task-id-input" hidden>
            <div class="row" style="margin-left: 1em">
                <a href="{{'/portal/view-tasks/'.$taskStage->id}}">
                    <button type="submit" id="save-organisation" class="btn btn-primary">{{ __('Back') }}</button>
                </a>
            </div>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-10">
                        <form id="edit-role" method="post" action="{{ route('close-task', $task->id) }}"
                              class="form-horizontal">
                            @csrf
                            @method('put')
                            <div class="card ">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">{{ __('Close task') }}</h4>
                                    <p class="card-category">{{ __('Close task') }}</p>
                                </div>


                                <div class="card-body ">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">{{ __('Closing report') }}</label>
                                            <div class="col">
                                                <textarea rows = "5" cols = "110" name = "closing_report" id="closing_report">{{$task->closing_report}}</textarea><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Date closed') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <input name="date_closed" type="date" id="date_closed" value="{{$task->date_closed}}"
                                                       class="form-control"
                                                       placeholder="Date closed">
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
