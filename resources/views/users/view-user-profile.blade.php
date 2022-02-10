@extends('layouts.app', ['activePage' => 'Profile', 'titlePage' => __('View Profile')])

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

            <div class="col-md-8">
                <a href="{{route('viewAllUsers')}}"> <button type="submit" id="save-organisation" class="btn btn-primary">{{ __('Back') }}</button></a>

                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title "><strong>Full Profile</strong></h4>
                    </div>
                    <div class="card-body">
                        <h4><b>Personal info</b></h4>
                        <div class="form-group">
                            <p><b>Name  </b><span style="margin-left: 4em">: {{$user->name}}</span></p>
                            <p><b>Surname  </b><span style="margin-left: 3em">: {{$user->surname}}</span></p>
                            <p><b>Email  </b><span style="margin-left: 4em">: {{$user->email}}</span></p>
                            <p><b>Contact number  </b><span style="margin-left: 4em">: {{$user->contact_number}}</span></p>
                            <p><b>Address </b><span style="margin-left: 4em">: {{$user->address}}</span></p>
                            <p><b>Job title </b><span style="margin-left: 4em">: {{$user->job_title}}</span></p>
                            <p><b>Personal profile </b><span style="margin-left: 4em">: {{$user->personal_profile}}</span></p>
                            <p><b>Organisation Name </b><span style="margin-left: 4em">: {{$user->organisation->organisation_name}}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
