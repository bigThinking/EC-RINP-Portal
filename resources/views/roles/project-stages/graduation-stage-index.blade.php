@extends('layouts.app', ['activePage' => 'projects', 'titlePage' => __('Graduation stage')])

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
                            <h4 class="card-title ">Graduation stages</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="roles-table" style="width: 100%!important">
                                    <thead class=" text-primary">
                                    <th>Project</th>
                                    <th>Previous stage</th>
                                    <th>Next Stage</th>
                                    <th>Progress Summary</th>
                                    <th>Graduation date</th>
                                    <th>Actions</th>
                                    </thead>
                                    <tbody>
                                    @foreach($graduation_stage_array as $graduation_stage_arrays)
                                        <tr>
                                            <td>{{$graduation_stage_arrays->project_name}}</td>
                                            <td>{{$graduation_stage_arrays->project_stage}}</td>
                                            <td>{{$graduation_stage_arrays->next_stage_name}}</td>
                                            <td>{{$graduation_stage_arrays->progress_summary}}</td>
                                            <td>{{$graduation_stage_arrays->graduation_date}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" id="{{$graduation_stage_arrays->id}}" onclick="editProjectStage(this)">Edit</button>
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

