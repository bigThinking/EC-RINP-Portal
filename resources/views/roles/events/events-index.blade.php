@extends('layouts.app', ['activePage' => 'events', 'titlePage' => __('View Events')])

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
                            <h4 class="card-title ">Events</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                   href="{{url('create-events')}}"
                                   title="Add New event"><i class="large material-icons">add</i>
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="roles-table" style="width: 100%!important">
                                    <thead class=" text-primary">
                                    <th>Event</th>
                                    <th>All day</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Start time</th>
                                    <th>End time</th>
                                    <th>Event type</th>
                                    <th>Actions</th>
                                    </thead>
                                    <tbody>
                                    @foreach($events as $event)
                                        <tr>
                                            <td>{{$event->title}}</td>
                                            <td>{{$event->all_day}}</td>
                                            <td>{{$event->start}}</td>
                                            <th>{{$event->end}}</th>
                                            <td>{{$event->start_time}}</td>
                                            <th>{{$event->end_time}}</th>
                                            <th>{{$event->type}}</th>
                                            <td>
                                                <button type="button" class="btn btn-primary" id="{{$event->id}}" onclick="editEvent(this)">Edit</button>
                                                <button type="button" class="btn btn-danger" id="{{$event->id}}" onclick="deleteEvent(this)">Delete</button>

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

    </style>


    @push('custom-scripts')
        <script>
            function editEvent(obj){
                let event_id = obj.id;
                window.location.href = '/edit-event/' + event_id;
            }

            function deleteEvent(obj){
                let event_id = obj.id;
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
                        $.get('/delete-event/'+ event_id, function(data,status){
                            if(status === 'success'){
                                Swal.fire(
                                    'Deleted!',
                                    'Event have been deleted. Page will reload.',
                                    'success'
                                )

                                setTimeout(function(){
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

