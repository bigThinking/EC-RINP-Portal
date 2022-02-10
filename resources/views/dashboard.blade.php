@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <?php
    $user = \Illuminate\Support\Facades\Auth::user();
    $user->load('organisation');

    ?>

    <div class="content">
        <div class="container-fluid">
            {{--<h4><b>Welcome {{$user->name}} {{$user->surname}}</b></h4>--}}
            @if($user->roles[0]->name == 'administrator')
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 style="color: white;font-size: 1.5em" class="card-title"><strong>Users</strong></h4>
                        </div>
                        <div class="card-body">
                            <h4 style="color: white" class="card-title">Number of users</h4>
                            <p style="color: #1E73BE" class="card-category"><span style="font-size: 2em;color: #1E73BE" class="text-success"><b>{{$users}}  </b></span> Users in the system</p>
                        </div>
                        <div class="card-footer" style="margin: 0 auto">
                            <a style="color: #1E73BE" class="txt" id="view-products"
                               href="<?= FULL_PATH ?>/users">
                                <i class="material-icons">person</i>   View users</a>
                        </div>
                        <br>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 style="color: white;font-size: 1.5em" class="card-title"><strong>Organisations</strong></h4>
                        </div>
                        <div class="card-body">
                            <h4 style="color: white" class="card-title">Number of Organisations</h4>
                            <p style="color: #1E73BE" class="card-category"><span style="font-size: 2em;color: #1E73BE" class="text-success"><b>{{$organisations}}  </b></span> Organisations in the system</p>
                        </div>
                        <div class="card-footer" style="margin: 0 auto">
                            <a style="color: #1E73BE" class="txt" id="view-products"
                               href="<?= FULL_PATH ?>/organisations">
                                <i class="material-icons">business_center</i>   View Organisations</a>
                        </div>
                        <br>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 style="color: white;font-size: 1.5em" class="card-title"><strong>Events</strong></h4>
                        </div>
                        <div class="card-body">
                            <h4 style="color: white" class="card-title">Number of Events</h4>
                            <p style="color: #1E73BE" class="card-category"><span style="font-size: 2em;color: #1E73BE" class="text-success"><b>{{$events}}</b></span> Events in the system</p>
                        </div>
                        <div class="card-footer" style="margin: 0 auto">
                            <a style="color: #1E73BE" class="txt" id="view-products"
                               href="<?= FULL_PATH ?>/view-events">
                                <i class="material-icons">event_available</i>View Events</a>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
                @endif
            @if($user->roles[0]->name == 'Incubator staff')
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 style="color: white;font-size: 1.5em" class="card-title"><strong>Events</strong></h4>
                        </div>
                        <div class="card-body">
                            <h4 style="color: white" class="card-title">Number of Events</h4>
                            <p style="color: #1E73BE" class="card-category"><span style="font-size: 2em;color: #1E73BE" class="text-success"><b></b>{{$events}}</span> Events in the system</p>
                        </div>
                        <div class="card-footer" style="margin: 0 auto">
                            <a style="color: #1E73BE" class="txt" id="view-products"
                               href="<?= FULL_PATH ?>/view-events">
                                <i class="material-icons">event_available</i>View Events</a>
                        </div>
                        <br>
                    </div>
                </div>
                @endif
            @if($user->roles[0]->name == 'innovator')
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 style="color: white;font-size: 1.5em" class="card-title"><strong>Events</strong></h4>
                        </div>
                        <div class="card-body">
                            <h4 style="color: white" class="card-title">Number of Events</h4>
                            <p style="color: #1E73BE" class="card-category"><span style="font-size: 2em;color: #1E73BE" class="text-success"><b>{{$events}}</b></span> Events in the system</p>
                        </div>
                        <div class="card-footer" style="margin: 0 auto">
                            <a style="color: #1E73BE" class="txt" id="view-products"
                               href="<?= FULL_PATH ?>/view-events">
                                <i class="material-icons">event_available</i>View Events</a>
                        </div>
                        <br>
                    </div>
                </div>
            @endif
            @if($user->roles[0]->name == 'Facilitator')
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 style="color: white;font-size: 1.5em" class="card-title"><strong>Events</strong></h4>
                        </div>
                        <div class="card-body">
                            <h4 style="color: white" class="card-title">Number of Events</h4>
                            <p style="color: #1E73BE" class="card-category"><span style="font-size: 2em;color: #1E73BE" class="text-success"><b>{{$events}}</b></span> Events in the system</p>
                        </div>
                        <div class="card-footer" style="margin: 0 auto">
                            <a style="color: #1E73BE" class="txt" id="view-products"
                               href="<?= FULL_PATH ?>/view-events">
                                <i class="material-icons">event_available</i>View Events</a>
                        </div>
                        <br>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <style>
        .card .card-header-warning .card-icon, .card .card-header-warning .card-text, .card .card-header-warning:not(.card-header-icon):not(.card-header-text), .card.bg-warning, .card.card-rotate.bg-warning .front, .card.card-rotate.bg-warning .back {
            background: linear-gradient(
                60deg
                , #1E73BE, #1E73BE);
        }

    </style>

@endsection



@push('js')
    <script>
        $(document).ready(function () {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();
        });
    </script>
@endpush
