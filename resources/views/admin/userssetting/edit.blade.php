@extends('layouts.admin')
@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
           
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        <h2>User Project Setting</h2>
    </div>
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show"
            role="alert">
            
            {{ session()->get('message') }}
            <button type="button" class="close"
                data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @endif

    <div class="card-body">
        <form action="{{ route("admin.usersetting.update") }}" method="POST" enctype="multipart/form-data">
            @csrf
            
           
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">User Type</label>
                <input type="text" id="max_plot_number" readonly="" name="max_plot_number" class="form-control" value="{{ $user->type }}">
            </div>
  

            <input type="hidden" name="id" value="{{$user->id}}">
            
            
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">Max Plot Number</label>
                <input type="number" id="max_plot_number" name="max_plot_number" class="form-control" value="{{ old('max_plot_number', isset($user) ? $user->max_plot_number : '') }}">
            </div>
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">Max Building Number</label>
                <input type="number" id="max_building_number" name="max_building_number" class="form-control" value="{{ old('max_building_number', isset($user) ? $user->max_building_number : '') }}">
            </div>
           
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">Max Floor Number</label>
                <input type="number" id="max_floor_number" name="max_floor_number" class="form-control" value="{{ old('max_floor_number', isset($user) ? $user->max_floor_number : '') }}">
            </div>
            
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">Max Room Number</label>
                <input type="number" id="max_room_number" name="max_room_number" class="form-control" value="{{ old('max_room_number', isset($user) ? $user->max_room_number : '') }}">
            </div>

            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">Number of try</label>
                <input type="number" id="number_of_try" name="number_of_try" class="form-control" value="{{ old('number_of_try', isset($user) ? $user->number_of_try : '') }}">
            </div>
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">Number of User</label>
                <input type="number" id="number_of_user" name="number_of_user" class="form-control" value="{{ old('number_of_user', isset($user) ? $user->number_of_user : '') }}">
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@section('scripts')
@parent

@endsection
@endsection