@extends('layouts.app', ['activePage' => 'organisations', 'titlePage' => __('View Organisations')])

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
                        <h4 class="card-title ">Organisation</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                href="{{url('admin-create-organisation')}}" title="Add New Organisation"><i
                                    class="large material-icons">add</i>
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="roles-table" style="width: 100%!important">
                                <thead class=" text-primary">
                                    <th>Organisation Name</th>
                                    <th>Description</th>
                                    <th>Reg No.</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach($organisation as $organisations)
                                    <tr>
                                        <td>{{$organisations->organisation_name}}</td>
                                        <td>{{$organisations->description}}</td>
                                        <td>{{$organisations->reg_no}}</td>
                                        <td>{{$organisations->location}}</td>
                                        <td>
                                            <a type="button" class="btn btn-primary" data-toggle="tooltip"
                                                data-placement="bottom"
                                                href="{{route('edit-organisation', $organisations->id)}}"
                                                title="Edit this organisation">Edit
                                            </a>

                                            {{--
                                                <button type="button" class="btn btn-danger" id="{{$organisations->id}}"
                                            onclick="deleteOrganisation(this)">Delete</button>
                                            --}}
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
function deleteOrganisation(obj) {
    let organisation_id = obj.id;
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
            $.get('/delete-organisation/' + organisation_id, function(data, status) {
                if (status === 'success') {
                    Swal.fire(
                        'Deleted!',
                        'Organisation has been deleted. Page will reload.',
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