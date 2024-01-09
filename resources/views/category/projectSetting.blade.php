
<?php
    
    $cplot  =  \App\Category::where(['id' => 18 ])->first();
    // echo "<pre>";
    // print_r($categories);exit;

?>
@extends('layouts.admin')
@section('content')


<div class="main-panel">
    <nav class="navbar navbar-expand-lg " color-on-scroll="500">
        <div class="container-fluid">
          
            <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar burger-lines"></span>
                <span class="navbar-toggler-bar burger-lines"></span>
                <span class="navbar-toggler-bar burger-lines"></span>
            </button>

            <div class="navbar-collapse justify-content-end" id="navigation">
              
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="position:relative;top: 10px;">
                            <strong>Username:</strong>{{ Auth::user()->name }}
                        </a>
                    </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <button class="btn btn-primary">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            {{ trans('global.logout') }}
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div style="padding-top: 20px" class="container-fluid">
        @yield('content')
                <div class="content col-md-6">
    
    <h3 class="mb-4">Account Settings</h3>
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
            <label>Name</label>
            <input type="text" readonly="" class="form-control" value="{{$user->name}}">
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
            <label>Email</label>
            <input type="text" readonly="" class="form-control" value="{{$user->email}}">
        </div>
        </div>

    </div>
    <h3>Project Settings</h3>
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
            <label>Max number of Plot Objects</label>
            <input type="text" readonly="" class="form-control" value="{{$data->max_plot_number}}">
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
            <label>Max number of Building Objects</label>
            <input type="text" readonly="" class="form-control" value="{{$data->max_building_number}}">
        </div>
        </div>
    </div>
        <div class="row">
        <div class="col-md-6">
        <div class="form-group">
            <label>Max number of Floors Objects</label>
            <input type="text" readonly="" class="form-control" value="{{$data->max_floor_number}}">
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
            <label>Max number of Rooms Objects</label>
            <input type="text" readonly="" class="form-control" value="{{$data->max_room_number}}">
        </div>
        </div>
    </div>
        <h3>Global Settings</h3>
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label>Available tries credit</label>
                <input type="text" readonly="" class="form-control" value="{{$data->number_of_try}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Remaining tries credit</label>
                <input type="text" readonly="" class="form-control" value="{{$remaining_count}}">
            </div>
        </div>
    </div>

{{--       
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
          <label>User Type</label>
          <select class="selectbox1">
              <option>Free</option>
              <option>Premium</option>
          </select>
      </div>
    </div>
  </div> --}}


    @if($SiteSetting->usertype=='show' )
        <div class="col-md-12">
            <div class="form-group">
                <button class="btn btn-primary">Upgrade</button>
            </div>
        </div>
    @endif
</div>
  
<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

@endsection
@section('scripts')
@parent

@endsection