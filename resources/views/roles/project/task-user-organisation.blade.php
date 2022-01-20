@extends('layouts.app', ['activePage' => 'All users', 'titlePage' => __('Organisation')])

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

                    <div class="profile">
                        <div class="profile-pic">
                            <div class="header-color"></div>
                            <img src="{{ asset('images') }}/rinp_logo.png" alt="Profile Picture">
                        </div>
                        <div class="title">
                            <h1>{{$project->organisation_name}}</h1>
                            <h2><span class="highlighted">{{$project->description}}</span></h2>
                        </div>
                        <div class="description">
                            <p>Location : {{$project->location}}</p>
                            <p>Website :{{$project->website}}</p>
                        </div>
                    </div>

        </div>
    </div>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap");


        html,
        body {
            height: 100vh;
            display: grid;
            font-family: "Open Sans", sans-serif;
        }

        .profile {
            margin: auto;
            height: 500px;
            width: 600px;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            border-radius: 20px;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
            -ms-overflow-style: none; /* for Internet Explorer, Edge */
            scrollbar-width: none; /* for Firefox */
            overflow-y: scroll;
        }

        ::-webkit-scrollbar {
            display: none; /* for Chrome, Safari, and Opera */
        }

        .header-color {
            border-radius: 20px 20px 0 0;
            padding-bottom: 150px;
            width: 600px;
            background: #4f759b;
        }

        .profile-pic img {
            height: 200px;
            width: 200px;
            border-radius: 50%;
            border: 10px solid #ffffff;
            margin-top: -100px;
        }

        .title {
            margin-bottom: 25px;
        }

        h1 {
            font-size: 32px;
            font-weight: 700;
            color: #131b23;
            margin-bottom: 10px;
            letter-spacing: 0.025em;
        }

        h2 {
            font-size: 18px;
            letter-spacing: 0.01em;
            color: #131b23;
        }
        span {
            color: #4f759b;
            font-weight: 700;
        }


        .description {
            margin-bottom: 25px;
            color: #131b23;
            letter-spacing: 0.01em;

        p:not(:last-child) {
            margin-bottom: 5px;
        }


        button {
            font-family: "Open Sans", sans-serif;
            color: #ffffff;
            background: #4f759b;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.025em;
            border: none;
            border-radius: 15px;
            min-height: 35px;
            width: 100px;
            margin-bottom: 25px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        button:hover {
            width: 115px;
            background: #4f759be0;
        }

        .images-container {
            width: 350px;

        .image {
            margin-bottom: 25px;

        img {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        i {
            color: #9b1d20;
            display: flex;
            align-items: center;
            margin-left: 10px;

        span {
            margin-left: 5px;
            font-family: "Open Sans", sans-serif;
            font-size: 14px;
            font-weight: 400;
            color: #000000;
        }

        body {
            background-color: white;
        }

        .card .card-header-primary .card-icon, .card .card-header-primary .card-text, .card .card-header-primary:not(.card-header-icon):not(.card-header-text), .card.bg-primary, .card.card-rotate.bg-primary .front, .card.card-rotate.bg-primary .back {
            background: linear-gradient(60deg, #1E73BE, #1E73BE);
        }


    </style>

@endsection
