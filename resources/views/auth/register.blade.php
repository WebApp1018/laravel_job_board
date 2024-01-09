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
          Register
          </h4>
          
            <form  class="form-group mt-5 pt-0 pt-lg-3"method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
              
                <input id="name" placeholder="Name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif

                <input id="email" placeholder="Email" type="email" class="  my-3 form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <input placeholder="Password" id="password" type="password" class="  my-3 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                                <input placeholder="Confirm Password" id="password-confirm" type="password" class="  my-3 form-control" name="password_confirmation" required>
            <button
              class="bg-color-danger text-light header-navlink login-link w-100 rounded text-uppercase text-space"
              type="submit"
            >
            {{ __('Register') }}
            </button>
           
        </form>
        </div>
      </div>
    </div>
  </div>


  
@endsection



