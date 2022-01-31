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
        <a href="{{ url()->previous() }}">
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
                        @if($user->roles[0]->name == config('constants.ADMINISTRATOR'))
                        <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                            href="{{route('edit-call', $call->id)}}" title="Create new call"><i
                                class="large material-icons">add</i> Edit this call
                        </a>

                        <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                            href="{{route('delete-call', $call->id)}}" title="Create new call"><i
                                class="large material-icons">add</i> Delete call
                        </a>
                        @endif

                        @if($user->roles[0]->name == config('constants.ADMINISTRATOR'))
                                                    <a type="button" class="btn btn-primary" data-toggle="tooltip"
                                                        data-placement="bottom" href="{{route('show-call', $call->id)}}"
                                                        title="View this call">View
                                                    </a>

                                                    <button type="button" class="btn btn-primary" onclick="signUp(this)"
                                                        data-callid="{{$call->id}}">Sign up</button>
                                                    @endif

                        <div class="container">
                            <p><b>Organisation </b><span style="margin-left: 4em">: {{$call->description}}</span></p>
                            {{-- <p><b>Call Type  </b><span style="margin-left: 3em">: {{$user->surname}}</span></p>
                            <p><b>Description </b><span style="margin-left: 4em">: {{$user->email}}</span></p>
                            <p><b>Closing Date </b><span style="margin-left: 4em">: {{$user->contact_number}}</span></p>
                            <p><b>Start timr </b><span style="margin-left: 4em">: {{$user->address}}</span></p>
                            <p><b>End time </b><span style="margin-left: 4em">: {{$user->job_title}}</span></p>
                            <p><b>Personal profile </b><span style="margin-left: 4em">:
                                    {{$user->personal_profile}}</span></p>
                            <p><b>Organisation Name </b><span style="margin-left: 4em">:
                                    {{$user->organisation->organisation_name}}</span></p>--}}
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Sign ups for this call') }}</h4>
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
                                            {{--@foreach($call->callSignUp as $signUp)
                                        <tr>
                                            <td>{{$user->title}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->surname}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" id="{{$user->id}}"
                                                    onclick="editUser(this)">Edit</button>

                                                <button type="button" class="btn btn-primary" id="{{$user->id}}"
                                                    onclick="view(this)">View</button>
                                                <button type="button" class="btn btn-danger" id="{{$user->id}}"
                                                    onclick="deleteUser(this)">Delete</button>
                                            </td>
                                            </tr>
                                            @endforeach--}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endsection