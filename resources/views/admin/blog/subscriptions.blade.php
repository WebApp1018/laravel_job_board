
@extends('layouts.admin')
@section('content')

@if(session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Congratulation!</strong>    {{ session()->get('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>

@endif  
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                           Email
                        </th>
                        <th>
                            Created At
                        </th>
                       
                        <th>
                           Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($data as $key => $datas)
                   
                        <tr>
                            <td>
                              
                            </td>
                             <td>
                                 {{ $datas->id ?? '' }}
                              
                            </td>
                            <td>
                                 {{ $datas->email ?? '' }}
                            </td>
                            <td>
                                  {{ $datas->created_at ?? '' }}
                            </td>
                           
                            
                            <td>
                             
                              
                               @can('user_delete')
                                
                               
                                    
                                @if(empty($datas->roomType))
                                    
                                <button class="btn btn-danger delete_subscription" roomtype="{{$datas->id}}" style="position:relative;left: 10px" ><i class="nav-icon fas fa-trash"></i></button>
                              
                               
                                @endif    
                                   
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
  $('#add_room_type').click(function(){
    $('#room_model').modal('show');
  })
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
// @can('user_delete')
//   dtButtons.push(deleteButton)
// @endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection
@endsection