@extends('layouts.app')
@section('content')


<div class="container">
    <div class="col-12 col-md-10 col-lg-9 mx-auto">
      <div class="row pt-0 pt-md-5 pt-lg-5">
        <div class="col-12 col-lg-6">
          <img
            src="{{ asset('vergecad/assets/img/login_left_img.svg') }}"
            alt=""
            width="100%"
            class="pt-5 mt-3 px-4"
          />
        </div>
        <div class="col-12 col-lg-6">
            @if(\Session::has('message'))
            <p class="alert alert-info">
                {{ \Session::get('message') }}
            </p>
        @endif
          <h4
            class="text-uppercase text-center fw-bolder mt-5 mt-lg-0 mt-md-0"
          >
            Login
          </h4>
          
            <form  class="form-group mt-5 pt-0 pt-lg-3"method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <input
              type="email"
              name="email"
              class="form-control rounded @if($errors->has('email')) is-invalid @endif"
              placeholder="{{ trans('global.login_email') }}"
            />
            @if($errors->has('email'))
            <em class="invalid-feedback">
                {{ $errors->first('email') }}
            </em>
        @endif
            <input
              type="password"
              name="password"
              class="form-control rounded my-3 @if($errors->has('password')) is-invalid @endif"
             placeholder="{{ trans('global.login_password') }}"
            />
            @if($errors->has('password'))
            <em class="invalid-feedback">
                {{ $errors->first('password') }}
            </em>
        @endif
            <button
              class="bg-color-danger text-light header-navlink login-link w-100 rounded text-uppercase text-space"
              type="submit"
            >
              Login
            </button>
            <div class="col-6 text-right">
                                <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                    {{ trans('global.forgot_password') }}
                                </a> | 
                                <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                    Reset Password
                                </a>
                            </div>
        </form>
        </div>
      </div>
    </div>
  </div>


  
@endsection
