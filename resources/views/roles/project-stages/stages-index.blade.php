@extends('layouts.app', ['activePage' => 'projects', 'titlePage' => __('View  Stage')])

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
                            <h4 class="card-title ">Project stages</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="roles-table" style="width: 100%!important">
                                    <thead class=" text-primary">
                                    <th>Project Name</th>
                                    <th>Creator</th>
                                    <th>Project Stage</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Stage description</th>
                                    <th>Actions</th>
                                    </thead>
                                    <tbody>
                                    @foreach($stage_array as $projects)
                                        <tr>
                                            <td>{{$projects->project_name}}</td>
                                            <td>{{$projects->memberName}}</td>
                                            <td>{{$projects->project_stage}}</td>
                                            <td>{{$projects->start_date}}</td>
                                            <td>{{$projects->end_date}}</td>
                                            <td>{{$projects->stage_description}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" id="{{$projects->id}}" onclick="editProjectStage(this)">Edit</button>
                                                <button type="button" class="btn btn-danger" id="{{$projects->id}}" onclick="deleteProjectStage(this)">Delete</button>
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
            function editProjectStage(obj){
                let stage_id = obj.id;
                window.location.href = '/edit-stages/' + stage_id;
            }

            function deleteProjectStage(obj){
                let project_stage_id = obj.id;
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
                        $.get('/delete-project-stage/'+project_stage_id, function(data,status){
                            if(status === 'success'){
                                Swal.fire(
                                    'Deleted!',
                                    'Project stage has been deleted. Page will reload.',
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

