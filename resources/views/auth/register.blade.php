@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'register', 'title' => __('Material
Dashboard')])

<?php
$organisations = \App\Models\Organisation::all();

?>
@section('content')

<div class="container" style="height: auto;">
<a href="{{ route('login') }}">
            <button style="margin-left: 2em" type="submit" id="save-organisation"
                class="btn btn-primary">{{ __('Back to login') }}</button>
        </a>
    <div class="card card-login card-hidden mb-3">
        <div class="card-header card-header-primary text-center">
            <h4 class="card-title"><strong>{{ __('Register') }}</strong></h4>
        </div>
        <div class="card-body ">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-row">
                            <div
                                class="form-group {{ $errors->has('email') ? ' has-danger' : '' }} col-md-11 mt-3 ml-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="{{ __('email...') }}" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <div id="email-error" class="error text-danger pl-3" for="email"
                                    style="display: block;">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div
                                class="form-group {{ $errors->has('password') ? ' has-danger' : '' }} col-md-11 mt-3 ml-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="{{ __('password...') }}" required>

                                @if ($errors->has('password'))
                                <div id="password-error" class="error text-danger pl-3" for="password"
                                    style="display: block;">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div
                                class="form-group {{ $errors->has('password_confirmation') ? ' has-danger' : '' }} col-md-11 mt-3 ml-3">
                                <label for="password_confirmation">Confirm password</label>

                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="{{ __('confirm password...') }}" required>

                                @if ($errors->has('password_confirmation'))
                                <div id="password_confirmation-error" class="error text-danger pl-3"
                                    for="password_confirmation" style="display: block;">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="bmd-form-group {{ $errors->has('title') ? ' has-danger' : '' }}">
                            <label class="col-sm-4 col-form-label">{{ __('Title') }}</label>
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
                            <div id="title-error" class="error text-danger pl-3" for="title" style="display: block;">
                                <strong>{{ $errors->first('title') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-row">
                            <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }} col-md-11 mt-3 ml-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="{{ __('Name...') }}"
                                    value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div
                                class="form-group {{ $errors->has('surname') ? ' has-danger' : '' }} col-md-11 mt-3 ml-3">
                                <label for="surname">Surname</label>
                                <input type="text" name="surname" class="form-control"
                                    placeholder="{{ __('Surname...') }}" value="{{ old('surname') }}" required>

                                @if ($errors->has('surname'))
                                <div id="surname-error" class="error text-danger pl-3" for="surname"
                                    style="display: block;">
                                    <strong>{{ $errors->first('surname') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div
                                class="form-group {{ $errors->has('contact_number') ? ' has-danger' : '' }} col-md-11 mt-3 ml-3">
                                <label for="contact_number">Contact number</label>
                                <input type="text" id="contact_number" name="contact_number" class="form-control"
                                    placeholder="{{ __('Contact number...') }}" value="{{ old('contact_number') }}"
                                    required>

                                @if ($errors->has('surname'))
                                <div id="contact_number-error" class="error text-danger pl-3" for="contact_number"
                                    style="display: block;">
                                    <strong>{{ $errors->first('contact_number') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div
                                class="form-group {{ $errors->has('address') ? ' has-danger' : '' }} col-md-11 mt-3 ml-3">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" class="form-control"
                                    placeholder="{{ __('Address...') }}" value="{{ old('address') }}" required>

                                @if ($errors->has('address'))
                                <div id="address-error" class="error text-danger pl-3" for="address"
                                    style="display: block;">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div
                                class="form-group {{ $errors->has('job_title') ? ' has-danger' : '' }} col-md-11 mt-3 ml-3">
                                <label for="job_title">Job title</label>
                                <input type="text" id="job_title" name="job_title" class="form-control"
                                    placeholder="{{ __('Job title...') }}" value="{{ old('job_title') }}" required>

                                @if ($errors->has('job_title'))
                                <div id="job_title-error" class="error text-danger pl-3" for="job_title"
                                    style="display: block;">
                                    <strong>{{ $errors->first('job_title') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="bmd-form-group{{ $errors->has('Organisation') ? ' has-danger' : '' }}">
                            <label class="col-sm-4 col-form-label">{{ __('Organisation') }}</label>
                            <div class="col-sm-12">
                                <select name="organisation_id" id="organisation_id"
                                    class="browser-default custom-select">
                                    @foreach($organisations as $organisation)
                                    <option value="{{$organisation->id}}">
                                        {{$organisation->organisation_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('title'))
                            <div id="title-error" class="error text-danger pl-3" for="title" style="display: block;">
                                <strong>{{ $errors->first('title') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="bmd-form-group{{ $errors->has('is_innovator') ? ' has-danger' : '' }}">
                            <label class="col-sm-4 col-form-label">{{ __('Are you an Innovator') }}</label>
                            <div class="col-sm-12">
                                <select name="is_innovator" id="is_innovator" class="browser-default custom-select">
                                    <option value="" disabled selected>Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            @if ($errors->has('is_innovator'))
                            <div id="is_innovator-error" class="error text-danger pl-3" for="is_innovator"
                                style="display: block;">
                                <strong>{{ $errors->first('is_innovator') }}</strong>
                            </div>
                            @endif
                        </div>
                        <div id="Yes" class="colors Yes" style="display: none">
                            <div class="bmd-form-group">
                                <label class="col-sm-4 col-form-label">{{ __('Highest Education Level') }}</label>
                                <div class="col-sm-12">
                                    <select id="personal_profile" name="personal_profile"
                                        class="browser-default custom-select">
                                        <option value="" disabled selected>Select education level</option>
                                        <option value="black">Post-graduate degree</option>
                                        <option value="white">Degree</option>
                                        <option value="indian">Matric</option>
                                    </select>
                                </div>
                            </div>

                            <div class="bmd-form-group">
                                <label class="col-sm-4 col-form-label">{{ __('Race') }}</label>
                                <div class="col-sm-12">
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
                                <div class="col-sm-12">
                                    <select name="gender" id="gender" class="browser-default custom-select">
                                        <option value="" disabled selected>Select gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="bmd-form-group">
                                <label class="col-sm-4 col-form-label">{{ __('Do you have any disabilities?') }}</label>
                                <div class="col-sm-12">
                                    <select name="disability" id="disability" class="browser-default custom-select">
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-check mr-auto ml-3 mt-3">
                            <label class="form-check-label" style="color: #1E73BE">
                                <input class="form-check-input" type="checkbox" id="policy" name="policy"
                                    {{ old('policy', 1) ? 'checked' : '' }} style="color: #1E73BE">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                                {{ __('I agree with the ') }} <a href="#" style="color: #1E73BE">{{ __('Privacy Policy') }}</a>
                            </label>
                        </div>

                        <div class="card-footer justify-content-center">
                            <button type="submit"
                                class="btn btn-primary btn-link btn-lg" style="color: #1E73BE">{{ __('Create account') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
<script>
$(function() {
    $('#is_innovator').change(function() {
        $('.colors').hide();
        $('#' + $(this).val()).show();
    });
});
</script>
@endpush

@endsection