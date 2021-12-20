@extends('layouts.app', ['activePage' => 'All users', 'titlePage' => __('All users')])

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
                <h2><strong>List of users</strong></h2>
                <div class="row">
                    @foreach($organisation as $organisation)
                        @if($organisation->organisation_name == 'Other (if your organisation is not on the list)')
                        @else
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header card-header-warning">
                                        <h4 style="color: white;font-size: 1.5em" class="card-title"><strong>{{$organisation->organisation_name}}</strong></h4>
                                    </div>
                                    <div class="card-body">
                                        <p style="color: blue" class="card-category"><span style="font-size: 2em;color: blue" class="text-success"></span> Organisation name : {{$organisation->organisation_name}} </p>
                                        <p style="color: blue" class="card-category"><span style="font-size: 2em;color: blue" class="text-success"></span>Description : {{$organisation->description}}</p>
                                        <p style="color: blue" class="card-category"><span style="font-size: 2em;color: blue" class="text-success"></span> Location : {{$organisation->location}}</p>
                                        <p style="color: blue" class="card-category"><span style="font-size: 2em;color: blue" class="text-success"></span>Website : {{$organisation->website}}</p>
                                    </div>
                                    <div class="card-footer" style="margin: 0 auto">
                                        <a style="color: blue" href="{{url('/view-organisation-users/'.$organisation->id)}}">
                                            <i class="material-icons">person</i>View users</a>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        @endif
                    @endforeach
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
        .card .card-header-warning .card-icon, .card .card-header-warning .card-text, .card .card-header-warning:not(.card-header-icon):not(.card-header-text), .card.bg-warning, .card.card-rotate.bg-warning .front, .card.card-rotate.bg-warning .back {
            background: linear-gradient(
                60deg
                , #1E73BE, #1E73BE);
        }

    </style>

@endsection
