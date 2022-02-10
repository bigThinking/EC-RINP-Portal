@extends('layouts.app', ['activePage' => 'All users', 'titlePage' => __('Organisation users')])

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
            <h2><strong>List of users</strong></h2>
            <div class="row">
                @foreach($organisation->user as $user)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header card-header-warning">
                                    <h4 style="color: white;font-size: 1.5em" class="card-title"><strong>{{$user->name}}</strong></h4>
                                </div>
                                <div class="card-body">
                                    <p  class="card-category"><span style="font-size: 2em;" class="text-success"></span> Name & surname : {{$user->name}} {{$user->surname}}</p>
                                    <p  class="card-category"><span style="font-size: 2em;" class="text-success"></span> Email : {{$user->email}}</p>
                                    <p  class="card-category"><span style="font-size: 2em;" class="text-success"></span> Contact number : {{$user->contact_number}}</p>
                                    <p  class="card-category"><span style="font-size: 2em;" class="text-success"></span> Organisation : {{$user->organisation->organisation_name}}</p>
                                </div>
                                <div class="card-footer" style="margin: 0 auto">
                                    <a style="color: blue" href="{{route('user-profile', $user->id)}}">
                                        <i class="material-icons">person</i>View {{$user->name}}</a>
                                </div>
                                <br>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        .card .card-header-warning .card-icon, .card .card-header-warning .card-text, .card .card-header-warning:not(.card-header-icon):not(.card-header-text), .card.bg-warning, .card.card-rotate.bg-warning .front, .card.card-rotate.bg-warning .back {
            background: linear-gradient(
                60deg
                , #1E73BE, #1E73BE);
        }


    </style>
    @push('custom-scripts')
        <script>
            function viewUser(obj) {
                let user_id = obj.id;
                window.location.href = '/user-profile/' + user_id;
            }
        </script>
    @endpush
@endsection
