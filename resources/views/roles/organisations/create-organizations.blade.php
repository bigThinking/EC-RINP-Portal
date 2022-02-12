@extends('layouts.app', ['activePage' => 'add-organisation', 'titlePage' => __('Add Organisation')])

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
                <form id="add-role" method="post" action="{{url('store-organisation')}}" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Add Organisation') }}</h4>
                            <p class="card-category">{{ __('Enter Organisation Information') }}</p>
                        </div>
                        <div class="card-body ">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input name="organisation_name" type="text" id="organisation_name"
                                            class="form-control" placeholder="Organisation name">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <textarea class="form-control" rows="5" cols="110" name="description"
                                            type="text" id="description"
                                            placeholder="Description of what organisation does"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input name="reg_no" type="text" id="reg_no" class="form-control"
                                            placeholder="Registration number(if company registered)">
                                    </div>
                                    <div class="col">
                                        <input name="location" type="text" id="location" class="form-control"
                                            placeholder="Location">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input name="email" type="text" id="email" class="form-control"
                                            placeholder="Email">
                                    </div>
                                    <div class="col">
                                        <input name="website" type="text" id="website" class="form-control"
                                            placeholder="Website">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input name="contact_number" type="text" id="contact_number"
                                            class="form-control" placeholder="Contact number">
                                    </div>
                                </div>
                            </div>

                            <div>
                            <label>Organisation logo</label>
                                <input type="file" id="organisation_logo" name="organisation_logo"
                                            class="form-control" accept="image/*" placeholder="Organisation logo">
                            </div>

                            

                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" id="save-organisation"
                                class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection