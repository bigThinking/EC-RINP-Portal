@extends('layouts.app', ['activePage' => 'user management', 'titlePage' => __('View Users')])

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
                            <h4 class="card-title ">Users</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="roles-table" style="width: 100%!important">
                                    <thead class=" text-primary">
                                    <th>Title</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>Contact number</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Approved</th>
                                    <th>Organisation name</th>
                                    <th>Actions</th>
                                    </thead>
                                    <tbody>
                                    @foreach($users_array as $user)
                                        <tr>
                                            <td>{{$user->title}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->surname}}</td>
                                            <td>{{$user->contact_number}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->role}}</td>
                                            <td>{{$user->is_approved}}</td>
                                            <td>{{$user->organisation_name}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" id="{{$user->id}}" onclick="editUser(this)">Edit</button>

                                                <button type="button" class="btn btn-primary" id="{{$user->id}}" onclick="view(this)">View</button>
 <button type="button" class="btn btn-danger" id="{{$user->id}}" onclick="deleteUser(this)">Delete</button>
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
            function editUser(obj){
                let user_id = obj.id;
                window.location.href = '/portal/admin-approve-user/' + user_id;
            }
            function view(obj){
                let user_id = obj.id;
                window.location.href = '/portal/view-user-info/' + user_id;
            }
           function deleteUser(obj){
                let user_id = obj.id;
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
                        $.get('/portal/delete-user-and-project/'+user_id, function(data,status){
                            if(status === 'success'){
                                Swal.fire(
                                    'Deleted!',
                                    'User has been deleted. Page will reload.',
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

