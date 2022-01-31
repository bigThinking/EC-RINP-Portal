@extends('layouts.app', ['activePage' => 'calls', 'titlePage' => __('View Calls')])

@section('content')

<?php
    $user = \Illuminate\Support\Facades\Auth::user();
    $user->load('organisation');

    $onOrganisation = Route::currentRouteName() == 'view-calls-organisation';
?>

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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Calls</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col">
                            <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                href="{{url('create-call')}}" title="Create new call">Create new call
                            </a>
                            </div>

                            @if($user->roles[0]->name == 'administrator')
                            <div class="col">
                            <div class="row">
                                
                                <label class="col h4 text-right" style="padding-top:10px;" for="callSet">Show:</label>
                            
                                
                                <select name="callSet" id="callSet" class="col browser-default custom-select"
                                    onchange="getCallSet()">
                                    <option value="all">All Calls</option>
                                    <option value="organisation" {{ $onOrganisation ? __('selected') : __('') }}>My
                                        Organisation's Calls</option>
                                </select>
                                
                            </div>
                           </div>
                            @endif
                        </div>

                        <div class="d-flex">
                            <div class="mx-auto">
                                {{ $calls->links() }}
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless" id="roles-table"
                                style="width:100%!important;">
                                <tbody>
                                    @foreach($calls as $call)
                                    @if(($loop->index+1)%3 == 1)
                                    <tr>
                                        @endif
                                        <td>
                                            <div class="card" style="width: 20rem;">
                                                <img class="card-img-top"
                                                    src="https://images.unsplash.com/photo-1517303650219-83c8b1788c4c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bd4c162d27ea317ff8c67255e955e3c8&auto=format&fit=crop&w=2691&q=80"
                                                    alt="Card image cap">
                                                <div class="card-body">
                                                    <h4 class="card-title">{{$call->title}}</h4>
                                                    <h6 class="card-subtitle mb-2 text-muted">organisation</h6>
                                                    <p class="card-text">{{$call->description}}</p>
                                                    <p class="card-text">Closing date: {{$call->closing_date}}</p>
                                                    @if($user->roles[0]->name == config('constants.ADMINISTRATOR'))
                                                    <a type="button" class="btn btn-primary" data-toggle="tooltip"
                                                        data-placement="bottom" href="{{route('show-call', $call->id)}}"
                                                        title="View this call">View
                                                    </a>

                                                    <button type="button" class="btn btn-primary" onclick="signUp(this)"
                                                        data-callid="{{$call->id}}">Sign up</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    @if(($loop->index+1)%3 == 0)
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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


@push('custom-scripts')
<script>
function signUp(obj) {
    var plainUrl = "{{route('call-signup', ':id')}}";
    $.get({
        url: plainUrl.replace(':id', obj.data("callid")),
        success: function(response) {
            console.log(response);
            var modal = $(this);
            var data = JSON.parse(response);
        }
    })
}

function getCallSet() {
    var x = document.getElementById("callSet").value;
    if (x == 'all')
        window.location.replace("{{route('view-calls')}}");
    else if (x == 'organisation')
        window.location.replace("{{route('view-calls-organisation')}}");
}


function deletecall(obj) {
    let call_id = obj.id;
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete.'
    }).then((result) => {
        if (result.value) {
            $.get('/delete-call/' + call_id, function(data, status) {
                if (status === 'success') {
                    Swal.fire(
                        'Deleted!',
                        'call have been deleted. Page will reload.',
                        'success'
                    )

                    setTimeout(function() {
                        window.location.reload();
                    }, 1500);
                }
            });
        }
    })
}
</script>
@endpush

@endsection