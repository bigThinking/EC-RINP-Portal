@extends('layouts.app', ['activePage' => 'Full Profile', 'titlePage' => __('View Profile')])

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
                    <a href="{{route(user-index)}}"> <button type="submit" id="save-organisation" class="btn btn-primary">{{ __('Back') }}</button></a>

                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title "><strong>User full info</strong></h4>
                        </div>
                        <div class="card-body">
                            @if($user->is_approved ==null)
                                <p style="color: red"><strong>User is not approved yet</strong></p>
                                @else
                                <p><strong>Approved : </strong>{{$user->is_approved}}</p>
                                @endif
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">{{ __('Name') }}</label>
                                        <div class="col-sm-7">
                                            <input name="name" type="text" value="{{$user->name}}" disabled
                                                   id="name" class="form-control"
                                                   placeholder="Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">{{ __('Surname') }}</label>
                                        <div class="col-sm-7">
                                            <input name="name" type="text" value="{{$user->surname}}" disabled
                                                   id="name" class="form-control"
                                                   placeholder="Surname">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">{{ __('Email') }}</label>
                                        <div class="col-sm-7">
                                            <input name="name" type="text" value="{{$user->email}}" disabled
                                                   id="name" class="form-control"
                                                   placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">{{ __('Title') }}</label>
                                        <div class="col-sm-7">
                                            <input name="name" type="text" value="{{$user->title}}" disabled
                                                   id="name" class="form-control"
                                                   placeholder="Title">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">{{ __('Contact number') }}</label>
                                        <div class="col-sm-7">
                                            <input name="name" type="text" value="{{$user->contact_number}}" disabled
                                                   id="name" class="form-control"
                                                   placeholder="Contact number">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">{{ __('Address') }}</label>
                                        <div class="col-sm-7">
                                            <input name="name" type="text" value="{{$user->address}}" disabled
                                                   id="name" class="form-control"
                                                   placeholder="Address">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">{{ __('Job title') }}</label>
                                        <div class="col-sm-7">
                                            <input name="name" type="text" value="{{$user->job_title}}" disabled
                                                   id="name" class="form-control"
                                                   placeholder="Job title">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">{{ __('Organisation Name') }}</label>
                                        <div class="col-sm-7">
                                            <input name="name" type="text" value="{{$user->organisation->organisation_name}}" disabled
                                                   id="name" class="form-control"
                                                   placeholder="Organisation name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">{{ __('Are you an innovator') }}</label>
                                        <div class="col-sm-7">
                                            <input name="name" type="text" value="{{$user->is_innovator}}" disabled
                                                   id="name" class="form-control"
                                                   placeholder="Innovator">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">{{ __('Highest qualification') }}</label>
                                        <div class="col-sm-7">
                                            <input name="name" type="text" value="{{$user->personal_profile}}" disabled
                                                   id="name" class="form-control"
                                                   placeholder="Highest qualification">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">{{ __('Race') }}</label>
                                        <div class="col-sm-7">
                                            <input name="name" type="text" value="{{$user->race}}" disabled
                                                   id="name" class="form-control"
                                                   placeholder="Race">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">{{ __('Gender') }}</label>
                                        <div class="col-sm-7">
                                            <input name="name" type="text" value="{{$user->gender}}" disabled
                                                   id="name" class="form-control"
                                                   placeholder="Gender">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">{{ __('Disable') }}</label>
                                        <div class="col-sm-7">
                                            <input name="name" type="text" value="{{$user->disability}}" disabled
                                                   id="name" class="form-control"
                                                   placeholder="Disable">
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
  @endsection
