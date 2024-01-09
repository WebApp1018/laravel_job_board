@extends('layouts.admin')
@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">

        
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.users.create") }}">
                {{ trans('global.add') }} {{ trans('global.user.title_singular') }}
            </a>
        </div>
        
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.user_management') }} {{ trans('global.list') }}
    </div>
<?php 
    
 ?>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('global.user.fields.email') }}
                        </th>
                        <th>
                           Type
                        </th>
                        <th>
                           Total Number of tries
                        </th>
                        <th>
                           Remaining Tries
                        </th>
                        <th>Used Tries</th>
                        <th>
                           Status
                        </th>
                        <th>
                            {{ trans('global.user.fields.roles') }}
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
                                {{ $user->name ?? '' }}
                            </td>
                            <td>
                                {{ $user->email ?? '' }}
                            </td>
                            <td>
                                {{ $user->user_type ?? '' }}
                            </td>
                            <td>
                                <?php 
                                if($user->user_type=='Free')
                                {
                                  $userSettingdata = App\UserSetting::where('type',"Free")->first();
                                  
                                }
                                else
                                {
                                  $userSettingdata = App\UserSetting::where('type',"Premium")->first();
                                }
                                echo $userSettingdata->number_of_try;
                                ?>
                                
                            </td>
                            <td>
                                <?php 
                                  $check_count = app\Helpers\helper::count_record_user('c_s_v_files','user_id',$user->id);
                                 $user_number_of_try = $userSettingdata->number_of_try;
                                
                                 echo $remaining =  $user_number_of_try - $check_count;
                                 ?>
                            </td>
                            <td>{{$check_count}}</td>
                            <td>
                                <?php if($user->status == 1){?>
                                  <span class="badge badge-success">Active</span>
                                    <?php }else{?>
                                     <span class="badge badge-danger">Deactive</span>
                                    <?php } ?>
                                 

                                    
                            </td>
                            <td>
                                @foreach($user->roles as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('user_show')
                                   
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-success btn-sm mr-2">{{ trans('global.view') }}</a>
                                @endcan
                                @can('user_edit')
                                    <a class="btn btn-primary btn-sm mr-2" href="{{ route('admin.users.edit', $user->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    
                                @endcan

                               

                                @can('user_delete')
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                         
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-danger btn-sm mr-2" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
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
<script>
    $(function () {
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection
@endsection