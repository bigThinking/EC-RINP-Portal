@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('EC-RINP Portal')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <h1 class="text-white text-center"><b>{{ __('EC-RINP PORTAL') }}</b></h1>
      </div>
  </div>
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
        <form class="form" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="card card-login card-hidden mb-3">
                <div class="card-header card-header-primary text-center">
                    <h4 class="card-title"><strong>{{ __('Login') }}</strong></h4>
                </div>
                <div class="card-body">
                    <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="input-group">
                            <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">email</i>
                  </span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="{{ __('Email...') }}" required>
                        </div>
                        @if ($errors->has('email'))
                            <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                            </div>
                            <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password...') }}"  required>
                        </div>
                        @if ($errors->has('password'))
                            <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-check mr-auto ml-3 mt-3">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember me') }}
                            <span class="form-check-sign">
                  <span class="check"></span>
                </span>
                        </label>
                    </div>
                </div>
                <div class="card-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-link btn-lg" style="color: #1E73BE">{{ __('Login') }}</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-6">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-light">
                        <small>{{ __('Forgot password?') }}</small>
                    </a>
                @endif
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('register') }}" class="text-light">
                    <small>{{ __('Register') }}</small>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    body{
        background-color: white;
    }
    .card .card-header-primary .card-icon, .card .card-header-primary .card-text, .card .card-header-primary:not(.card-header-icon):not(.card-header-text), .card.bg-primary, .card.card-rotate.bg-primary .front, .card.card-rotate.bg-primary .back {
        background: linear-gradient(60deg, #1E73BE, #1E73BE);
    }
    .btn.btn-primary {
        background-color: #1E73BE;
    }
    .text-primary {
        color: #1E73BE !important;
    }
    .btn.btn-primary:hover {
        background-color: #1E73BE;
    }

</style>

@endsection