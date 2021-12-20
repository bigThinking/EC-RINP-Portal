@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'register', 'title' => __('Material Dashboard')])

<?php
$organisations = \App\Models\Organisation::all();

?>
@section('content')


    <div class="container" style="height: auto;">
        <div class="row">
            <div class="col-md-12">
                <form class="form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="container" style="height: auto;">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-8 col-sm-8 ml-auto mr-auto">
                                <form class="form" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="card card-login card-hidden mb-3">
                                        <div class="card-header card-header-primary text-center">
                                            <h4 class="card-title"><strong>{{ __('Register') }}</strong></h4>
                                        </div>
                                        <div class="card-body ">

                                            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }} mt-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons"></i> Email
                  </span>
                                                    </div>
                                                  <input type="email" name="email" class="form-control"
                                                           placeholder="{{ __('email...') }}" value="{{ old('email') }}"
                                                           required>
                                                </div>
                                                @if ($errors->has('email'))
                                                    <div id="email-error" class="error text-danger pl-3" for="email"
                                                         style="display: block;">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons"></i>Password
                  </span>
                                                    </div>
                                                    <input type="password" name="password" id="password"
                                                           class="form-control"
                                                           placeholder="{{ __('password...') }}" required>
                                                </div>
                                                @if ($errors->has('password'))
                                                    <div id="password-error" class="error text-danger pl-3"
                                                         for="password"
                                                         style="display: block;">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="bmd-form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }} mt-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons"></i>Confirm password
                  </span>
                                                    </div>
                                                    <input type="password" name="password_confirmation"
                                                           id="password_confirmation"
                                                           class="form-control"
                                                           placeholder="{{ __('confirm password...') }}" required>
                                                </div>
                                                @if ($errors->has('password_confirmation'))
                                                    <div id="password_confirmation-error" class="error text-danger pl-3"
                                                         for="password_confirmation" style="display: block;">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <br>
                                            <div class="bmd-form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                                <label
                                                    class="col-sm-4 col-form-label">{{ __('Title') }}</label>
                                                <div class="col col-sm-12">
                                                    <select name="title" id="title" class="browser-default custom-select">
                                                        <option value="" disabled selected>Select title</option>
                                                        <option value="Mr">Mr</option>
                                                        <option value="Mrs">Mrs</option>
                                                        <option value="Miss">Miss</option>
                                                        <option value="Dr">Dr</option>
                                                    </select>
                                                </div>
                                                @if ($errors->has('title'))
                                                    <div id="title-error" class="error text-danger pl-3" for="title"
                                                         style="display: block;">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons"></i>Name
                  </span>
                                                    </div>
                                                    <input type="text" name="name" class="form-control"
                                                           placeholder="{{ __('Name...') }}" value="{{ old('name') }}"
                                                           required>
                                                </div>
                                                @if ($errors->has('name'))
                                                    <div id="name-error" class="error text-danger pl-3" for="name"
                                                         style="display: block;">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="bmd-form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons"></i>Surname
                  </span>
                                                    </div>
                                                    <input type="text" name="surname" class="form-control"
                                                           placeholder="{{ __('Surname...') }}"
                                                           value="{{ old('surname') }}" required>
                                                </div>
                                                @if ($errors->has('surname'))
                                                    <div id="surname-error" class="error text-danger pl-3" for="surname"
                                                         style="display: block;">
                                                        <strong>{{ $errors->first('surname') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="bmd-form-group{{ $errors->has('contact_number') ? ' has-danger' : '' }}">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons"></i>Contact Number
                  </span>
                                                    </div>
                                                    <input type="text" name="contact_number" class="form-control"
                                                           placeholder="{{ __('Contact number...') }}"
                                                           value="{{ old('contact_number') }}" required>
                                                </div>
                                                @if ($errors->has('surname'))
                                                    <div id="contact_number-error" class="error text-danger pl-3"
                                                         for="contact_number" style="display: block;">
                                                        <strong>{{ $errors->first('contact_number') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="bmd-form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons"></i>Address
                  </span>
                                                    </div>
                                                    <input type="text" name="address" class="form-control"
                                                           placeholder="{{ __('Address...') }}"
                                                           value="{{ old('address') }}" required>
                                                </div>
                                                @if ($errors->has('address'))
                                                    <div id="address-error" class="error text-danger pl-3" for="address"
                                                         style="display: block;">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="bmd-form-group{{ $errors->has('job_title') ? ' has-danger' : '' }}">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons"></i>Job title
                  </span>
                                                    </div>
                                                    <input type="text" name="job_title" class="form-control"
                                                           placeholder="{{ __('Job title...') }}"
                                                           value="{{ old('job_title') }}" required>
                                                </div>
                                                @if ($errors->has('job_title'))
                                                    <div id="job_title-error" class="error text-danger pl-3"
                                                         for="job_title" style="display: block;">
                                                        <strong>{{ $errors->first('job_title') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <br>
                                            <div class="bmd-form-group{{ $errors->has('Organisation') ? ' has-danger' : '' }}">
                                                <label
                                                    class="col-sm-4 col-form-label">{{ __('Organisation') }}</label>
                                                <div class="col col-sm-12">
                                                    <select name="organisation_id" id="organisation_id"
                                                            class="browser-default custom-select">
                                                        @foreach($organisations as $organisation)
                                                            <option value="{{$organisation->id}}">{{$organisation->organisation_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if ($errors->has('title'))
                                                    <div id="title-error" class="error text-danger pl-3" for="title"
                                                         style="display: block;">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="bmd-form-group{{ $errors->has('is_innovator') ? ' has-danger' : '' }}">
                                                <label
                                                    class="col-sm-4 col-form-label">{{ __('Are you an Innovator') }}</label>
                                                <div class="col col-sm-12">
                                                    <select name="is_innovator" id="is_innovator"
                                                            class="browser-default custom-select">
                                                        <option value="" disabled selected>Select</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                                @if ($errors->has('is_innovator'))
                                                    <div id="is_innovator-error" class="error text-danger pl-3"
                                                         for="is_innovator" style="display: block;">
                                                        <strong>{{ $errors->first('is_innovator') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                            <div id="Yes" class="colors Yes" style="display: none">
                                            <div class="bmd-form-group{{ $errors->has('personal_profile') ? ' has-danger' : '' }}">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons"></i>Highest Education level
                  </span>
                                                    </div>
                                                    <input type="text" name="personal_profile" class="form-control"
                                                           placeholder="{{ __('highest education level...') }}"
                                                           value="{{ old('personal_profile') }}" >
                                                </div>
                                            </div>
                                            <div class="bmd-form-group">
                                                <label class="col-sm-4 col-form-label">{{ __('Race') }}</label>
                                                <div class="col col-sm-12">
                                                    <select name="race" id="race" class="browser-default custom-select">
                                                        <option value="" disabled selected>Select race</option>
                                                        <option value="black">Black</option>
                                                        <option value="white">White</option>
                                                        <option value="indian">Indian</option>
                                                        <option value="coloured">Coloured</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="bmd-form-group">
                                                <label class="col-sm-4 col-form-label">{{ __('Gender') }}</label>
                                                <div class="col col-sm-12">
                                                    <select name="gender" id="gender"
                                                            class="browser-default custom-select">
                                                        <option value="" disabled selected>Select gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="bmd-form-group">
                                                <label class="col-sm-4 col-form-label">{{ __('Disability') }}</label>
                                                <div class="col col-sm-12">
                                                    <select name="disability" id="disability"
                                                            class="browser-default custom-select">
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-check mr-auto ml-3 mt-3">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" id="policy"
                                                           name="policy" {{ old('policy', 1) ? 'checked' : '' }} >
                                                    <span class="form-check-sign">
                  <span class="check"></span>
                </span>
                                                    {{ __('I agree with the ') }} <a
                                                        href="#">{{ __('Privacy Policy') }}</a>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card-footer justify-content-center">
                                            <button type="submit"
                                                    class="btn btn-primary btn-link btn-lg"
                                                    onclick="CreateAccount(this)">{{ __('Create account') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


        @push('custom-scripts')
            <script>

                function CreateAccount(obj) {
                    Swal.fire({
                        title: 'Registered  ?',
                        text: "You are now registered!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok.'
                    })
                }

                $(function() {
                    $('#is_innovator').change(function(){
                        $('.colors').hide();
                        $('#' + $(this).val()).show();
                    });
                });

            </script>
    @endpush

@endsection

