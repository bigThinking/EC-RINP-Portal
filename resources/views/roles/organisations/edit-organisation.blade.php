@extends('layouts.app', ['activePage' => 'Edit organisation', 'titlePage' => __('Update Organisation')])

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
                        <a href="{{'/portal/organisation-index'}}"> <button type="submit" id="save-organisation" class="btn btn-primary">{{ __('Back') }}</button></a>


                    <form id="edit-role" method="post" action="{{ route('update-organisation', $organisation->id) }}" class="form-horizontal" >
                        @csrf
                        @method('put')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit organisation') }}</h4>
                                <p class="card-category">{{ __('Update Organisation Information Here') }}</p>
                            </div>
                            <div class="card-body ">

                                <div class="form-group">
                                    <div class="row">
                                        <input value="{{$organisation->id}}" id="role_id" hidden>
                                        <div class="col">
                                            <input name="organisation_name" type="text" id="organisation_name" value="{{$organisation->organisation_name}}" class="form-control"
                                                   placeholder="Organisation Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <textarea class="form-control" rows = "5" cols = "110" name="description" type="text" id="description"
                                                   placeholder="Description of what organisation does">{{$organisation->description}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input name="reg_no" type="text" id="reg_no" value="{{$organisation->reg_no}}" class="form-control"
                                                   placeholder="Registration number">
                                        </div>
                                        <div class="col">
                                            <input name="location" type="text" id="location" value="{{$organisation->location}}" class="form-control"
                                                   placeholder="Location">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input name="email" type="text" id="email" value="{{$organisation->email}}" class="form-control"
                                                   placeholder="Email">
                                        </div>
                                        <div class="col">
                                            <input name="website" type="text" id="website" value="{{$organisation->website}}" class="form-control"
                                                   placeholder="Website">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input name="contact_number" type="text" id="contact_number" value="{{$organisation->contact_number}}" class="form-control"
                                                   placeholder="Contact number">
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



@endsection
