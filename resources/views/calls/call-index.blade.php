@extends('layouts.app', ['activePage' => 'calls', 'titlePage' => __('View Calls')])

@section('content')

<?php
    $user = \Illuminate\Support\Facades\Auth::user();
    $user->load('organisation');
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
                        <h4 class="card-title ">calls</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                href="{{url('create-call')}}" title="Create new call"><i
                                    class="large material-icons">add</i> Create new call
                            </a>

                            @if($user->roles[0]->name == 'administrator')
                            <label for="callSet">Show:</label>

                            <select name="callSet" id="callSet" class="browser-default custom-select">
                                <option value="all">All Calls</option>
                                <option value="organisation">My Organisation's Calls</option>
                            </select>
                            @endif
                        </div>

                        <div class="modal fade" id="viewCallModal" tabindex="-1" role="dialog"
                            aria-labelledby="callModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="callModalLongTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        lots of text
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="mx-auto">
                                {{ $calls->links() }}
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table" id="roles-table" style="width: 100%!important">
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
                                                    @if($user->roles[0]->name == 'administrator')
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#viewCallModal"
                                                        data-callid="{{$call->id}}">View</button>
                                                    <button type="button" class="btn btn-primary" onclick="signUp(this)"
                                                        data-callid="{{$call->id}}">Sign up</button>
                                                    @endif

                                                    {{--@if($user->roles[0]->name == 'innovator')
                                                <a href="#0" class="card-link">View</a>
                                                <a href="#0" class="card-link">Sign up</a>
                                                @endif

                                                @if($user->roles[0]->name == 'administrator' || $user->roles[0]->name == 'facilitator' || $user->roles[0]->name == 'incubator')
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewCallModal"data-callid="{{$call->id}}">View</button>

                                                    @if($user->organisation[0]->id == $call->organisation_id)
                                                    <button type="button" class="btn btn-primary" onclick="signUp(this)"
                                                        data-callid="{{$call->id}}">Edit</button>
                                                    @endif
                                                    @endif --}}
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
$(document).ready(function() {
    $('#viewCallModal').on('shown.bs.modal', function(event) {
        var plainUrl = "{{route('get-call', ':id')}}";
        $.get({
            url: plainUrl.replace(':id', $(event.relatedTarget).data("callid")),
            success: function(response) {
                console.log(response);
                var modal = $(this);
                var data = JSON.parse(response);
                modal.find('.modal-title').text(data.title);
                modal.find('.modal-body').text(data.description);
            }
        })
    })
})

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