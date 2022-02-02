@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('User Profile')])

@section('content')

    <?php
    $user = \Illuminate\Support\Facades\Auth::user();

    ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit Profile') }}</h4>
                <p class="card-category">{{ __('User information') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                        <div class="col col-sm-7">
                            <select name="title" id="title" class="browser-default custom-select">
                                <option value="" disabled selected>{{ old('email', auth()->user()->title) }}</option>
                                    <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Miss">Miss</option>
                                <option value="Dr">Dr</option>
                            </select>
                        </div>
                    </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Surname') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" id="input-surname" type="text" placeholder="{{ __('Surname') }}" value="{{ old('surname', auth()->user()->surname) }}" required="true" aria-required="true"/>
                                @if ($errors->has('surname'))
                                    <span id="surname-error" class="error text-danger" for="input-surname">{{ $errors->first('surname') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required />
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Contact number') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('contact_number') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('contact_number') ? ' is-invalid' : '' }}" name="contact_number" id="input-contact_number" type="text" placeholder="{{ __('Contact number') }}" value="{{ old('contact_number', auth()->user()->contact_number) }}" required="true" aria-required="true"/>
                                @if ($errors->has('contact_number'))
                                    <span id="contact_number-error" class="error text-danger" for="input-contact_number">{{ $errors->first('contact_number') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Address') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" id="input-address" type="text" placeholder="{{ __('Address') }}" value="{{ old('address', auth()->user()->address) }}" required="true" aria-required="true"/>
                                @if ($errors->has('address'))
                                    <span id="address-error" class="error text-danger" for="input-address">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Job title') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('job_title') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('job_title') ? ' is-invalid' : '' }}" name="job_title" id="input-job_title" type="text" placeholder="{{ __('Job title') }}" value="{{ old('job_title', auth()->user()->job_title) }}" required="true" aria-required="true"/>
                                @if ($errors->has('job_title'))
                                    <span id="job_title-error" class="error text-danger" for="input-job_title">{{ $errors->first('job_title') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Organisation') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('organisation_name') ? ' has-danger' : '' }}">
                                <select name="organisation_id" id="organisation_id" class="browser-default custom-select">
                                    <option value="{{isset($user->organisation->id) ? $user->organisation->id : null}}">{{isset($user->organisation->organisation_name) ? $user->organisation->organisation_name : 'Select organisation'}}</option>
                                    @foreach($organisation as $organisations)
                                        <option value="{{$organisations->id}}" {{$organisations->id==$organisations->organisation_name?'selected':''}}>{{$organisations->organisation_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    @if($user->is_innovator == 'No')
                        <div class="" hidden>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Are you an innovator') }}</label>
                                <div class="col col-sm-7">
                                    <select name="is_innovator" id="is_innovator" class="browser-default custom-select">
                                        <option value="" disabled selected>{{ old('is_innovator', auth()->user()->is_innovator) }}</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Gender') }}</label>
                                <div class="col col-sm-7">
                                    <select name="gender" id="gender" class="browser-default custom-select">
                                        <option value="" disabled selected>{{ old('gender', auth()->user()->gender) }}</option>
                                        <option value="female">Female</option>
                                        <option value="male">Male</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Race') }}</label>
                                <div class="col col-sm-7">
                                    <select name="race" id="race" class="browser-default custom-select">
                                        <option value="" disabled selected>{{ old('race', auth()->user()->race) }}</option>
                                        <option value="black">Black</option>
                                        <option value="white">White</option>
                                        <option value="indian">Indian</option>
                                        <option value="coloured">Coloured</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Personal profile') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('personal_profile') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('Personal profile') ? ' is-invalid' : '' }}" name="personal_profile" id="input-personal_profile" type="text" placeholder="{{ __('Personal profile') }}" value="{{ old('personal_profile', auth()->user()->personal_profile) }}" required="true" aria-required="true"/>
                                        @if ($errors->has('personal_profile'))
                                            <span id="personal_profile-error" class="error text-danger" for="input-personal_profile">{{ $errors->first('personal_profile') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Are you an innovator') }}</label>
                                <div class="col col-sm-7">
                                    <select name="is_innovator" id="is_innovator" class="browser-default custom-select">
                                        <option value="" disabled selected>{{ old('is_innovator', auth()->user()->is_innovator) }}</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Gender') }}</label>
                                <div class="col col-sm-7">
                                    <select name="gender" id="gender" class="browser-default custom-select">
                                        <option value="" disabled selected>{{ old('gender', auth()->user()->gender) }}</option>
                                        <option value="female">Female</option>
                                        <option value="male">Male</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Race') }}</label>
                                <div class="col col-sm-7">
                                    <select name="race" id="race" class="browser-default custom-select">
                                        <option value="" disabled selected>{{ old('race', auth()->user()->race) }}</option>
                                        <option value="black">Black</option>
                                        <option value="white">White</option>
                                        <option value="indian">Indian</option>
                                        <option value="coloured">Coloured</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Highest Education Level') }}</label>
                                <div class="col-sm-7">
                                    <select id="personal_profile" name="personal_profile" class="browser-default custom-select">
                                        <option value="" disabled selected>{{ old('personal_profile', auth()->user()->personal_profile) }}</option>
                                        <option value="black">Post-graduate degree</option>
                                        <option value="white">Degree</option>
                                        <option value="indian">Matric</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif

              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
       {{-- Organisation--}}
       {{-- <div class="row">
            <div class="col-md-12">
                <form id="add-role" method="post" action="{{url('store-organisation')}}" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Create your Organisation here...') }}</h4>
                            <p class="card-category">{{ __('If your organisation is not on the list create your organisation , and assign yourself.') }}</p>
                        </div>
                        <div class="card-body ">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input name="organisation_name" type="text" id="organisation_name" class="form-control"
                                               placeholder="Organisation name">
                                    </div>
                                    <div class="col">
                                        <input name="description" type="text" id="description" class="form-control"
                                               placeholder="Description of what organisation does">
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
                                        <input name="contact_number" type="text" id="contact_number" class="form-control"
                                               placeholder="Contact number">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" id="save-organisation" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>--}}

      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.password') }}" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Change password') }}</h4>
                <p class="card-category">{{ __('Password') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status_password'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status_password') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-current-password">{{ __('Current Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" input type="password" name="old_password" id="input-current-password" placeholder="{{ __('Current Password') }}" value="" required />
                      @if ($errors->has('old_password'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('old_password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password">{{ __('New Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('New Password') }}" value="" required />
                      @if ($errors->has('password'))
                        <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm New Password') }}" value="" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Change password') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
