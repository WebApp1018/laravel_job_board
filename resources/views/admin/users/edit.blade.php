@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.user.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.users.update", [$user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('global.user.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}">
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.user.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('global.user.fields.email') }}*</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}">
                @if($errors->has('email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.user.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">{{ trans('global.user.fields.password') }}</label>
                <input type="password" id="password" name="password" class="form-control">
                @if($errors->has('password'))
                    <em class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.user.fields.password_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">{{ trans('global.user.fields.roles') }}*
                    <span class="btn btn-info btn-xs select-all">Select all</span>
                    <span class="btn btn-info btn-xs deselect-all">Deselect all</span></label>
                <select name="roles[]" id="roles" class="form-control select2" multiple="multiple">
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>
                            {{ $roles }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <em class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.user.fields.roles_helper') }}
                </p>
            </div>
             <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">Status</label>
                <!-- <select name="status" id="status" class="form-control">
                        <option value="@if($user->status == $user->status) selected @endif"  >Active</option>
                        <option value="@if($user->status == $user->status) selected  @endif" > Deactive</option>
                </select> -->
                <select name="status" id="status" class="form-control">
                   <option {{old('Status',$user->status)=="1"? 'selected':''}}  value="1">Active</option>
                   <option {{old('Status',$user->status)=="0"? 'selected':''}} value="0">Deactive</option>
                </select>
               
                <p class="helper-block">
                    {{ trans('global.user.fields.roles_helper') }}
                </p>
            </div>
            <!-- <div class="form-group {{ $errors->has('number_of_try') ? 'has-error' : '' }}">
                <label for="roles">Number of try</label>
                <input type="number" id="number_of_try" name="number_of_try" class="form-control" value="{{ old('number_of_try', isset($user) ? $user->number_of_try : '') }}">
               
            </div>
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
            </div> -->
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection