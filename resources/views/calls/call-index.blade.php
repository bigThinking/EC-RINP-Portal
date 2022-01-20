@extends('layouts.app', ['activePage' => 'calls', 'titlePage' => __('View Calls')])

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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">calls</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                href="{{url('create-calls')}}" title="Add New call"><i
                                    class="large material-icons">add</i>
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table" id="roles-table" style="width: 100%!important">
                                <tbody>
                                    @foreach($calls as $call)
                                    <tr>
                                        <div class="card" style="width: 20rem;">
                                            <img class="card-img-top"
                                                src="https://images.unsplash.com/photo-1517303650219-83c8b1788c4c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bd4c162d27ea317ff8c67255e955e3c8&auto=format&fit=crop&w=2691&q=80"
                                                alt="Card image cap">
                                            <div class="card-body">
                                                <h4 class="card-title">{{$call->title}}</h4>
                                                <p class="card-text">{{$call->description}}</p>
                                                <p class="card-text">Closing date: {{$call->deadline}}</p>
                                                <a href="#0" class="card-link">Card link</a>
                                                <a href="#0" class="card-link">Another link</a>
                                            </div>
                                        </div>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- <table class="table" id="roles-table" style="width: 100%!important">
                                    <thead class=" text-primary">
                                    <th>Call</th>
                                    <th>All day</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Start time</th>
                                    <th>End time</th>
                                    <th>call type</th>
                                    <th>Actions</th>
                                    </thead> -->
                        <!-- <tbody>
                                    @foreach($calls as $call)
                                        <tr>
                                            <td>{{$call->title}}</td>
                                            <td>{{$call->all_day}}</td>
                                            <td>{{$call->start}}</td>
                                            <th>{{$call->end}}</th>
                                            <td>{{$call->start_time}}</td>
                                            <th>{{$call->end_time}}</th>
                                            <th>{{$call->type}}</th>
                                            <td>
                                                <button type="button" class="btn btn-primary" id="{{$call->id}}" onclick="editcall(this)">Edit</button>
                                                <button type="button" class="btn btn-danger" id="{{$call->id}}" onclick="deletecall(this)">Delete</button>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table> -->

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
function editcall(obj) {
    let call_id = obj.id;
    window.location.href = '/edit-call/' + call_id;
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