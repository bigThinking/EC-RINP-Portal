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
                        @if($user->roles[0]->name == config('constants.ADMINISTRATOR') || $user->roles[0]->name ==
                        config('constants.INCUBATOR') || $user->roles[0]->name == config('constants.FACILITATOR'))
                        <div class="row">
                            <div class="col">
                                <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                    href="{{url('create-call')}}" title="Create new call">Create new call
                                </a>
                            </div>

                            <div class="col">
                                <div class="row">
                                    <label class="col h4 text-right" style="padding-top:10px;"
                                        for="callSet">Show:</label>
                                    <select name="callSet" id="callSet" class="col browser-default custom-select"
                                        onchange="getCallSet()">
                                        <option value="all">All Calls</option>
                                        <option value="organisation" {{ $onOrganisation ? __('selected') : __('') }}>My
                                            Organisation's Calls</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="d-flex">
                            <div class="mx-auto">
                                {{ $calls->links() }}
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless" id="roles-table" style="width:100%!important;">
                                <tbody>
                                    @foreach($calls as $call)
                                    @if(($loop->index+1)%3 == 1)
                                    <tr>
                                        @endif
                                        <td>
                                            <div class="card" style="width: 20rem; cursor: pointer;  height: 40rem;"
                                                onclick="location.href='{{route('show-call', $call->id)}}';">
                                                @if($call->image_url != '')
                                                <img class="card-img-top"
                                                    src="{{ asset('storage/calls/').'/'.$call->image_url }}"
                                                    alt="Call image">
                                                @elseif($call->organisation->logo_url != '')
                                                <img class="card-img-top"
                                                    src="{{ asset('storage/org_logos/').'/'.$call->organisation->logo_url }}"
                                                    alt="Call image">
                                                @endif
                                                <div class="card-body">
                                                    <h4 class="card-title">{{Str::limit($call->title, 80)}}</h4>
                                                    <h6 class="card-subtitle mb-2 text-muted">
                                                        {{ Str::limit($call->organisation->organisation_name, 40) }}
                                                    </h6>
                                                    <p class="card-text">{{ Str::limit($call->description, 200) }}</p>
                                                    <p class="card-text"><Strong>Closing date: </strong> {{$call->closing_date}}</p>
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