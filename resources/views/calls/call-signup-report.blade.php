@extends('layouts.app', ['activePage' => 'call_signup_report', 'titlePage' => __('Application report')])

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
        <!-- call title
              user name
            user organisation
            last edited by
         -->
            <div id="resume">
                <img src="{{ asset('images') }}/rinp_logo.png" alt="EC-RINP logo">
                <h1>Call title :  {{$call_sign_up_report[0]->callSignUp->call->title}}</h1>
                <p>Innovator Name: {{$call_sign_up_report[0]->callSignUp->user->name.' '.$call_sign_up_report[0]->callSignUp->user->surname}}</p>
                <p>Innovator Organisation: {{$call_sign_up_report[0]->callSignUp->organisation->name}}</p>
                <p>Report last edited by : {{$call_sign_up_report[0]->user != null ? $call_sign_up_report[0]->user->name.' '.$call_sign_up_report[0]->user->surname : ''}}</p>
                <p>Report last edited on : {{$call_sign_up_report[0]-> updated_at}}</p>
                <div class="col-md-12">
                    <form method="post" action="{{ route('save-signup-report', $call_sign_up_report[0]->callSignUp->id) }}"
                          class="form-horizontal">
                        @csrf
                        @method('put')
                        <div class="card ">
                           
                            <div class="card-body ">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Application report') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <textarea class="form-control" rows = "5" cols = "120" name = "report" id="report" >{{$call_sign_up_report[0]->report}}</textarea><br>
                                                </div>
                                            </div>
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

    <style>
        div#resume {
            min-width: 310px;
            font: 16px Helvetica, Avernir, sans-serif;
            line-height: 24px;
            color: #000;
            margin-left: 2em;
            margin-right: 2em;
        }

        div#resume h1 {
            margin: 0 0 16px 0;
            padding: 0 0 16px 0;
            font-size: 42px;
            font-weight: bold;
            letter-spacing: -2px;
            border-bottom: 1px solid #999;
            line-height: 50px
        }

        div#resume h2 {
            font-size: 20px;
            margin: 0 0 6px 0;
            position: relative
        }

        div#resume h2 span {
            position: absolute;
            bottom: 0;
            right: 0;
            font-style: italic;
            font-family: Georgia, serif;
            font-size: 16px;
            color: #999;
            font-weight: normal
        }

        div#resume p {
            margin: 0 0 16px 0
        }

        div#resume a {
            color: #999;
            text-decoration: none;
            border-bottom: 1px dotted #999
        }

        div#resume a:hover {
            border-bottom-style: solid;
            color: #000
        }

        div#resume p.objective {
            font-family: Georgia, serif;
            font-style: italic;
            color: #666
        }

        div#resume dt {
            font-style: italic;
            font-weight: bold;
            font-size: 18px;
            text-align: right;
            padding: 0 26px 0 0;
            width: 150px;
            border-right: 1px solid #999
        }

        div#resume dl {
            display: table-row
        }

        div#resume dl dt,
        div#resume dl dd {
            display: table-cell;
            padding-bottom: 20px
        }

        div#resume dl dd {
            width: 500px;
            padding-left: 26px
        }

        div#resume img {
            float: right;
            padding: 10px;
            background: #fff;
            margin: 0 30px;
            transform: rotate(-4deg);
            box-shadow: 0 0 4px rgba(0, 0, 0, .3);
            width: 30%;
            max-width: 220px
        }

        @media screen and (max-width:1100px) {
            div#resume h2 span {
                position: static;
                display: block;
                margin-top: 2px
            }
        }

        @media screen and (max-width:550px) {
            body {
                margin: 1rem
            }
            div#resume img {
                transform: rotate(0deg)
            }
        }

        @media screen and (max-width:400px) {
            div#resume dl dt {
                border-right: none;
                border-bottom: 1px solid #999
            }
            div#resume dl,
            div#resume dl dd,
            div#resume dl dt {
                display: block;
                padding-left: 0;
                margin-left: 0;
                padding-bottom: 0;
                text-align: left;
                width: 100%
            }
            div#resume dl dd {
                margin-top: 6px
            }
            div#resume h2 {
                font-style: normal;
                font-weight: 400;
                font-size: 18px
            }
            div#resume dt {
                font-size: 20px
            }
            h1 {
                font-size: 36px;
                margin-right: 0;
                line-height: 0
            }
            h2 {
                font-size: 36px;
                margin-right: 0;
                line-height: 0
            }

            div#resume img {
                margin: 0
            }
        }

        @media screen and (max-width:320px) {
            body {
                margin: 0
            }
            img {
                margin: 0;
                margin-bottom: -40px
            }
            div#resume {
                width: 320px;
                padding: 12px;
                overflow: hidden
            }
            p,
            li {
                margin-right: 20px
            }
        }
        body {
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
    @push('custom-scripts')
        <script>


            function projectUserOrganisation(obj){
                let project_id = obj.id;
                window.location.href = '/portal/task-user-organisation/' + project_id;
            }

        </script>
    @endpush
@endsection