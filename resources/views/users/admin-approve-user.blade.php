@extends('layouts.app', ['activePage' => 'Approve user', 'titlePage' => __('Admin approve user')])

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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?= FULL_PATH ?>/user-index"> <button type="submit" id="save-organisation" class="btn btn-primary">{{ __('Back') }}</button></a>

                    <form id="edit-role" method="post" action="{{ route('user-approved', $user->id) }}" class="form-horizontal" >
                        @csrf
                        @method('put')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Approve user') }}</h4>
                                <p class="card-category">{{ __('Approve user') }}</p>
                            </div>
                            <input value="{{$user->id}}" id="user_id" hidden>
                            <div class="card-body ">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <input name="name" type="text" id="name" value="{{$user->name}}" class="form-control"
                                                   placeholder="First Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Surname') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
                                            <input name="surname" type="text" id="surname" value="{{$user->surname}}" class="form-control"
                                                   placeholder="Surname">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('User approval') }}</label>
                                    <div class="col col-sm-7">
                                        <select name="is_approved" id="is_approved" class="browser-default custom-select">
                                            <option value="{{isset($user->is_approved) ? $user->is_approved : null}}">{{isset($user->is_approved) ? $user->is_approved : 'Approve user'}}</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Organisation') }}</label>
                                    <div class="col col-sm-7">
                                        <select name="organisation_id" id="organisation_id" class="browser-default custom-select">
                                            <option value="{{isset($user->organisation->id) ? $user->organisation->id : null}}">{{isset($user->organisation->organisation_name) ? $user->organisation->organisation_name : 'Select organisation'}}</option>

                                        @foreach($organisation as $organisations)
                                                <option value="{{$organisations->id}}" {{$organisations->id==$organisations->organisation_name?'selected':''}}>{{$organisations->organisation_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Role') }}</label>
                                    <div class="col col-sm-7">
                                        <select name="role_id" id="role_id" class="browser-default custom-select">
                                            <option value="{{isset($user->roles[0]->id) ? $user->roles[0]->id : null}}">{{isset($user->roles[0]->display_name) ? $user->roles[0]->display_name : 'Select role'}}</option>
                                        @foreach($roles as $role)
                                                <option value="{{$role->id}}" {{$role->id==$role->display_name?'selected':''}}>{{$role->display_name}}</option>
                                            @endforeach
                                        </select>
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
