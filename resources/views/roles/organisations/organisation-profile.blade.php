@extends('layouts.app', ['activePage' => 'Organisation profile', 'titlePage' => __('Resource Request')])

@section('content')

<div class="content">
    <div id="resume">
    <a href="{{URL::previous()}}">
            <button style="margin-left: 2em" type="submit" id="back"
                class="btn btn-primary">{{ __('Back') }}</button>
    </a>
        <div class="col-md-12">
            <div class="card ">
                <div class="card-body ">
                    <img src="{{ $organisation->logo_url != '' ? asset('storage/org_logos/').'/'.$organisation->logo_url : asset('images') }}/rinp_logo.png"
                        alt="EC-RINP logo">

                    <p>Organisation: {{$organisation->organisation_name}}</p>
                    <p>Description: {{$organisation->description}}</p>
                    <p>Location : {{$organisation->location}}</p>
                    <p>Website : {{$organisation->website}}</p>
                    <p>Email : {{$organisation->email}}</p>
                    <p>Contact number : {{$organisation->contact_number}}</p>
                    <br>
                    <!-- <h2 style=" font-weight: bold;">Resource request</h2> -->
                </div>
            </div>
        </div>

        @if($organisation->project != null)
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Project Details</h4>
                </div>
                <div class="card-body ">
                    <div class="row justify-content-end">
                        <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                            href="{{route('project-timeline', $organisation->id)}}">View Project Timeline
                        </a>
                    </div>
                    <p>Project Name : {{$organisation->project->project_name}}</p>
                    <p>Project Description : {{$organisation->project->description}}</p>
                    <br>
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Organisation Members</h4>
                </div>
                <div class="card-body ">
                @foreach($organisation->user as $user)
                @if(($loop->index+1)%3 == 1)
                 <div class="row">
                 @endif
                  
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-category"><span style="font-size: 2em;" class="text-success"></span>
                                   Fullname : {{$user->name}} {{$user->surname}}</p>
                                <p class="card-category"><span style="font-size: 2em;" class="text-success"></span>
                                    Email : {{$user->email}}</p>
                                <p class="card-category"><span style="font-size: 2em;" class="text-success"></span>
                                    Contact number : {{$user->contact_number}}</p>
                                <p class="card-category"><span style="font-size: 2em;" class="text-success"></span>
                                    Job title : {{$user->organisation->organisation_name}}</p>
                                <p class="card-category"><span style="font-size: 2em;" class="text-success"></span>
                                    Personal profile : {{$user->personal_profile}}</p>
                            </div>
                        </div>
                    </div>

                    @if(($loop->index+1)%3 == 0)
                     </div>
                    @endif
                    @endforeach
                </div>
                </div>
            </div>
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
    transform: rotate(0deg);
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

.card .card-header-primary .card-icon,
.card .card-header-primary .card-text,
.card .card-header-primary:not(.card-header-icon):not(.card-header-text),
.card.bg-primary,
.card.card-rotate.bg-primary .front,
.card.card-rotate.bg-primary .back {
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