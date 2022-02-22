@extends('layouts.app', ['activePage' => 'projects', 'titlePage' => __('View Projects')])

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
                            <h4 class="card-title ">Projects</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="roles-table" style="width: 100%!important">
                                    <thead class=" text-primary">
                                    <th>Project Name</th>
                                    <th>Organisation</th>
                                    <th>Is Closed</th>
                                    <th>Actions</th>
                                    </thead>
                                    <tbody>
                                    @foreach($project_array as $projects)
                                        <tr>
                                            <td>{{$projects->project_name}}</td>
                                            <td onclick="location.href='{{$projects->organisation_profile_url}}';" style="color: blue;cursor: pointer">{{$projects->organisation_name}}</td>
                                            <th>{{$projects->project_closed}}</th>
                                            <td>
                                                <button type="button" class="btn btn-primary" onclick="location.href='{{route('incubatee-edit-user-project', $projects->id)}}';">View</button>
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

    {{--@push('custom-scripts')
        <script>
            function deleteOrganisation(obj){
                let organisation_id = obj.id;
                var plainUrl = "{{route('delete-organisation', ':id')}}"
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
                        $.get(plainUrl.replace(':id', organisation_id), function(data,status){
                            if(status === 'success'){
                                Swal.fire(
                                    'Deleted!',
                                    'Organisation has been deleted. Page will reload.',
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
    @endpush--}}

@endsection

