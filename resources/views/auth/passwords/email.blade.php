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
            Forgot you password ?
          </h4>
          
            <form  class="form-group mt-5 pt-0 pt-lg-3"method="POST" action="{{ route('password.email') }}">
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
           
            <button
              class="bg-color-danger text-light header-navlink login-link w-100 rounded text-uppercase text-space"
              type="submit"
            >
            {{ trans('global.reset_password') }}
            </button>
            <div class="col-6 text-right">
                                <a class="btn btn-link px-0" href="\login">
                                   Login
                                </a> 
                            </div>
        </form>
        </div>
      </div>
    </div>
  </div>


{{-- 
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-group">
            <div class="card p-4">
                <div class="card-body">
                    @if(\Session::has('status'))
                        <p class="alert alert-info">
                            {{ \Session::get('status') }}
                        </p>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <h1>
                            <div class="login-logo">
                                <a href="#">
                                     Building Trees sdds
                                </a>
                            </div>
                        </h1>
                        <p class="text-muted"></p>
                        <div>
                            {{ csrf_field() }}
                            <div class="form-group has-feedback">
                                <input type="email" name="email" class="form-control @if($errors->has('email')) is-invalid @endif" required="required"="autofocus" placeholder="{{ trans('global.login_email') }}">
                                @if($errors->has('email'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </em>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">
                                    {{ trans('global.reset_password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
