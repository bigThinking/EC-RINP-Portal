@extends('layouts.app', ['activePage' => 'roles', 'titlePage' => __('View Roles')])

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
                            <h4 class="card-title ">Roles</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                   href="{{url('create-role')}}"
                                   title="Add New Roles"><i class="large material-icons">add</i>
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="roles-table" style="width: 100%!important">
                                    <thead class=" text-primary">
                                    <th>Name</th>
                                    <th>Actions</th>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{$role->display_name}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" id="{{$role->id}}" onclick="editRole(this)">Edit</button>
                                                <button type="button" class="btn btn-danger" id="{{$role->id}}" onclick="deleteRole(this)">Delete</button>
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
            function editRole(obj){
                let role_id = obj.id;
                window.location.href = '/edit-role/' + role_id;
            }

            function deleteRole(obj){
                let role_id = obj.id;
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
                        $.get('/delete-role/'+role_id, function(data,status){
                            if(status === 'success'){
                                Swal.fire(
                                    'Deleted!',
                                    'Role has been deleted. Page will reload.',
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

