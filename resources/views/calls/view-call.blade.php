@extends('layouts.app', ['activePage' => 'view_call', 'titlePage' => __('View call')])

@section('content')

<?php
    $user = \Illuminate\Support\Facades\Auth::user();
 ?>

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
        <a href="{{ route('view-calls') }}">
            <button style="margin-left: 2em" type="submit" id="save-organisation"
                class="btn btn-primary">{{ __('Back') }}</button>
        </a>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{$call->title}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-end">
                            @if($user->organisation_id == $call->organisation_id && ($user->roles[0]->name ==
                            config('constants.ADMINISTRATOR') || $user->roles[0]->name == config('constants.INCUBATOR')
                            || $user->roles[0]->name == config('constants.FACILITATOR')))
                            <div class="col">
                                <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                    href="{{route('edit-call', $call->id)}}">Edit this call
                                </a>

                                <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                    href="{{route('delete-call', $call->id)}}">Delete call
                                </a>
                            </div>
                            @endif

                            @if($user->roles[0]->name == config('constants.INNOVATOR') && $showApply == True)
                            <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                    href="{{route('call-signup', $call->id)}}">Apply
                            </a>
                            {{--<button id="apply" type="button" class="btn btn-primary" onclick="signUp(this)"
                                data-callid="{{$call->id}}">Apply</button>--}}
                            @endif
                        </div>

                        <div class="container pt-5">
                            <div class="row justify-content-start">
                                <div class="col-sm-3">
                                    <h4>Organisation </h4>
                                </div>
                                <div class="col-sm-9">
                                    <p>{{$call->organisation->organisation_name}}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                <h4>Description</h4>
                                </div>
                                <div class="col-sm-9">
                                    <p>{{$call->description}}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                <h4>Application closing date</h4>
                                </div>
                                <div class="col-sm-9">
                                   <p>{{$call->closing_date}}</p>
                                </div>
                            </div>

                            @if($call->call_type == 'Event')
                            <div class="row">
                                <div class="col-sm-3">
                                <h4>Event start time</h4>
                                </div>
                                <div class="col-sm-9">
                                   <p>{{$call->start_time}}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                <h4>Event ending</h4>
                                </div>
                                <div class="col-sm-9">
                                   <p>{{$call->end_time}}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>


                @if(($user->organisation_id == $call->organisation_id &&  $user->roles[0]->name == config('constants.FACILITATOR')) || ($user->roles[0]->name ==
                            config('constants.ADMINISTRATOR') || $user->roles[0]->name == config('constants.INCUBATOR')))
                <div class="row">
                    <div class="col-md-12">

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Applicants for this call') }}</h4>
                            </div>
                            <div class="card-body ">
                                <div class="table-responsive">
                                    <table class="table" id="signup-table" style="width: 100%!important">
                                        <thead class=" text-primary">
                                            <th>Organisation</th>
                                            <th>User</th>
                                            <th>Sign up Date</th>
                                            <th>Actions</th>
                                        </thead>
                                        <tbody>
                                            @foreach($call->callSignUp as $signUp)
                                        <tr>
                                            <td>{{$signUp->organisation->organisation_name}}</td>
                                            <td>{{ $signUp->user->name.' '.$signUp->user->surname }}</td>
                                            <td>{{$signUp->created_at}}</td>
                                            <td>
                                            <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                                href="{{route('edit-signup-report', $signUp->id)}}">Edit report
                                             </a>                                         
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
                @endif
            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
<script>
function signUp(obj) {
    var plainUrl = "{{route('call-signup', ':id')}}";
    var tempUrl = plainUrl.replace(":id", $("#"+obj.id).data("callid"));
    $.get({
        url: tempUrl,
        success: function(response) {
            console.log(response);
            var modal = $(this);
            var data = JSON.parse(response);
        }
    })
}
</script>
@endpush

@endsection