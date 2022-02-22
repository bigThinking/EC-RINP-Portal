@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<?php
    $user = \Illuminate\Support\Facades\Auth::user();
    $user->load('organisation');

    ?>

<div class="content">
    @if (!$user->is_approved)
    <div class="alert alert-success">
        Welcome to the Eastern Cape Regional Innovation Platform. Your account is awaiting review by an
        administrator, after which you will have access to the functionalities of the portal. For queries please email admin@innovateec.co.za.
    </div>
    @endif
    <div class="container-fluid">
        {{--<h4><b>Welcome {{$user->name}} {{$user->surname}}</b></h4>--}}
        @if($user->roles[0]->name == config('constants.ADMINISTRATOR'))
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 style="color: white;font-size: 1.5em" class="card-title"><strong>Users</strong></h4>
                    </div>
                    <div class="card-body">
                        <h4 style="color: white" class="card-title">Number of users</h4>
                        <p style="color: #1E73BE" class="card-category"><span style="font-size: 2em;color: #1E73BE"
                                class="text-success"><b>{{$users}} </b></span> Users in the system</p>
                    </div>
                    <div class="card-footer" style="margin: 0 auto">
                        <a style="color: #1E73BE" class="txt" id="view-products" href="<?= FULL_PATH ?>/users">
                            <i class="material-icons">person</i> View users</a>
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
                        <p style="color: #1E73BE" class="card-category"><span style="font-size: 2em;color: #1E73BE"
                                class="text-success"><b>{{$organisations}} </b></span> Organisations in the system</p>
                    </div>
                    <div class="card-footer" style="margin: 0 auto">
                        <a style="color: #1E73BE" class="txt" id="view-products" href="<?= FULL_PATH ?>/organisations">
                            <i class="material-icons">business_center</i> View Organisations</a>
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
                        <p style="color: #1E73BE" class="card-category"><span style="font-size: 2em;color: #1E73BE"
                                class="text-success"><b>{{$events}}</b></span> Events in the system</p>
                    </div>
                    <div class="card-footer" style="margin: 0 auto">
                        <a style="color: #1E73BE" class="txt" id="view-products" href="<?= FULL_PATH ?>/view-events">
                            <i class="material-icons">event_available</i>View Events</a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        @endif
        @if($user->roles[0]->name == config('constants.INCUBATOR'))
        <div class="col-md-4">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 style="color: white;font-size: 1.5em" class="card-title"><strong>Events</strong></h4>
                </div>
                <div class="card-body">
                    <h4 style="color: white" class="card-title">Number of Events</h4>
                    <p style="color: #1E73BE" class="card-category"><span style="font-size: 2em;color: #1E73BE"
                            class="text-success"><b></b>{{$events}}</span> Events in the system</p>
                </div>
                <div class="card-footer" style="margin: 0 auto">
                    <a style="color: #1E73BE" class="txt" id="view-products" href="<?= FULL_PATH ?>/view-events">
                        <i class="material-icons">event_available</i>View Events</a>
                </div>
                <br>
            </div>
        </div>
        @endif
        @if($user->roles[0]->name == config('constants.INNOVATOR'))
        <div class="col-md-4">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 style="color: white;font-size: 1.5em" class="card-title"><strong>Events</strong></h4>
                </div>
                <div class="card-body">
                    <h4 style="color: white" class="card-title">Number of Events</h4>
                    <p style="color: #1E73BE" class="card-category"><span style="font-size: 2em;color: #1E73BE"
                            class="text-success"><b>{{$events}}</b></span> Events in the system</p>
                </div>
                <div class="card-footer" style="margin: 0 auto">
                    <a style="color: #1E73BE" class="txt" id="view-products" href="<?= FULL_PATH ?>/view-events">
                        <i class="material-icons">event_available</i>View Events</a>
                </div>
                <br>
            </div>
        </div>
        @endif
        @if($user->roles[0]->name == config('constants.FACILITATOR'))
        <div class="col-md-4">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 style="color: white;font-size: 1.5em" class="card-title"><strong>Events</strong></h4>
                </div>
                <div class="card-body">
                    <h4 style="color: white" class="card-title">Number of Events</h4>
                    <p style="color: #1E73BE" class="card-category"><span style="font-size: 2em;color: #1E73BE"
                            class="text-success"><b>{{$events}}</b></span> Events in the system</p>
                </div>
                <div class="card-footer" style="margin: 0 auto">
                    <a style="color: #1E73BE" class="txt" id="view-products" href="<?= FULL_PATH ?>/view-events">
                        <i class="material-icons">event_available</i>View Events</a>
                </div>
                <br>
            </div>
        </div>
        @endif
    </div>

    <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Recent Opportunities</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="roles-table" style="width: 100%!important">
                                    <thead class=" text-primary">
                                    <th>Type</th>
                                    <th>Title</th>
                                    <th>Closing Date</th>
                                    <th>Actions</th>
                                    </thead>
                                    <tbody>
                                    @foreach($recentCalls as $call)
                                        <tr>
                                            <td>{{$call->call_type}}</td>
                                            <td>{{$call->title}}</td>
                                            <td>{{$call->closing_date}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" onclick="location.href='{{route('show-call', $call->id)}}';">View</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
<style>
.card .card-header-warning .card-icon,
.card .card-header-warning .card-text,
.card .card-header-warning:not(.card-header-icon):not(.card-header-text),
.card.bg-warning,
.card.card-rotate.bg-warning .front,
.card.card-rotate.bg-warning .back {
    background: linear-gradient(60deg, #1E73BE, #1E73BE);
}
</style>

@endsection



@push('js')
<script>
$(document).ready(function() {
    // Javascript method's body can be found in assets/js/demos.js
    md.initDashboardPageCharts();
});
</script>
@endpush