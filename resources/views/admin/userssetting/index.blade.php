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

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            User Type
                        </th>
                        <th>
                            Max Plot number
                        </th>
                        <th>
                           Max Building number
                        </th>
                        <th>
                            Max Floor number
                        </th>
                        <th>
                           Max Room number
                        </th>
                        <th>
                           Number of tries
                        </th>
                        <th>
                           Number of Users
                        </th>
                        <th>
                           Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                        <tr data-entry-id="{{ $user->id }}">
                            <td>
                              
                            </td>
                            <td>
                                {{ $user->type ?? '' }}
                            </td>
                            <td>
                                {{ $user->max_plot_number ?? '' }}
                            </td>
                            <td>
                                {{ $user->max_building_number ?? '' }}
                            </td>
                            <td>
                                {{ $user->max_floor_number ?? '' }}
                            </td>
                            <td>
                                {{ $user->max_room_number ?? '' }}
                            </td>
                            <td>
                                {{ $user->number_of_try ?? '' }}
                            </td>
                            <td>
                                {{ $user->number_of_user ?? '' }}
                            </td>
                            <td>
                               <a class="btn btn-primary btn-sm mr-2" href="{{ route('admin.usersetting.edit', $user->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('scripts')
@parent

@endsection
@endsection