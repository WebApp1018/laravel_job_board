<head>
      <title>Hierarchical building App Tree View</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <link href="{{ asset('css/treeview.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="http://www-db.deis.unibo.it/courses/TW/DOCS/w3schools/lib/w3.css">
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <style>
        .modal-backdrop {
    position: inherit !important;
   
}
      </style>
   </head>
@extends('layouts.admin')
@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <button  type="button"  class="w3-btn w3-green" id="add_wall">  Add </button>
        </div>
    </div>
@endcan
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
                          S.No
                        </th>
                        <th>
                           Wall Type
                        </th>
                        <th>
                            Created At
                        </th>
                       <th>
                            Updated At
                        </th>
                        <th>
                           Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php $num=1; ?>
                   @foreach($data as $key => $datas)
                        <tr>
                            <td>
                              
                            </td>
                            <td>
                                {{$num}}
                            </td>
                            <td>
                                {{$datas->wall_type ?? '' }}
                            </td>
                            <td>
                                {{ $datas->created_at ?? '' }}
                            </td>
                            <td>
                                  {{ $datas->updated_at ?? '' }}
                            </td>
                           
                            
                           <td>
                                 @can('user_edit')
    
                                  <!--  <button class="w3-btn w3-blue edit_plot" value="{{$datas->id}}" style="position:relative;left: 5px;"><i class="nav-icon fas fa-edit"></i></button> -->
                                        <button  type="button" data-id="{{$datas->id}}" class="editmodal w3-btn w3-blue">
                                        <i class="nav-icon fas fa-edit"></i></button>
                                        <input type="hidden"  value="{{$datas->wall_type}}" class="type_value{{$datas->id}}">
                                @endcan

                                @can('user_delete')
                                <form method="POST" action="{{ route('admin.delete.wall') }}" enctype="multipart/form-data">
                                  @csrf
                                  <input type="hidden" value="{{$datas->id}}" name="delete_id" id="delete_id">
                                  <button class="btn btn-danger" type="submit" style="position:relative;left: 10px" ><i class="nav-icon fas fa-trash"></i></button>
                                </form>
                                @endcan

                            </td>
                        </tr>
                        <?php $num++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- modal test -->


<div id="wall_add_modal" class="w3-modal">
  <form method="POST" action="{{ route('admin.add.wall_type') }}" enctype="multipart/form-data">
    @csrf
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
      <div class="w3-center">
        <br>
        <h1> Add Wall Type</h1>
      </div>
      <div class="w3-container">
        <div class="w3-section">
          <div class="w3-col s6 w3-center" style="width:40%" >
            <label><b>Wall Type</b></label>
          </div >
          <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
            <input type="text"  name="wall_type" value="" class="w3-input w3-border w3-margin-bottom" placeholder="Enter Type" required="" id="wall_type" >   
          </div>
          <div class="w3-col s6 w3-center w3-red" style="width: 40%;position: relative;left: 38px;">
            <button type="button" id="close" class="w3-btn w3-btn-block w3-red" data-dismiss="modal" style="width: 48%;position: relative;">Cancel</button>
          </div>
          <div  class="w3-col s6 w3-center w3-green" style="width: 40%;position: relative;left: 46px;">
            <button  type="submit"  class="w3-btn w3-green" id="submit_wall">  Create</button>
            <a href="#close-modal" rel="modal:close" ><button type="button" class="w3-btn w3-green" id="update_wall" style='display:none'> Update </button></a>
          </div>
          <div class="w3-container w3-padding-hor-16 ">
          </div>
        </div>
      </div> 
    </div> 
  </form>
</div>

<div id="wall_edit_modal" class="w3-modal">
  <form method="POST" action="{{ route('admin.update.wall') }}" enctype="multipart/form-data">
    @csrf
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
      <div class="w3-center">
        <br>
        <h1> Edit Wall Type</h1>
      </div>
      <div class="w3-container">
        <div class="w3-section">
          <!-- <div class="w3-col s6 w3-center" style="width:40%" >
            <label><b>Type ID</b></label>
          </div > -->
          <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
            <input type="hidden"  name="wall_typeID" value="" class="w3-input w3-border w3-margin-bottom" placeholder="Enter Type" required="" id="wall_typeID">   
          </div>
          <div class="w3-col s6 w3-center" style="width:40%" >
            <label><b>Wall Type</b></label>
          </div >
          <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
            <input type="text"  name="wall_type_value" value="" class="w3-input w3-border w3-margin-bottom" placeholder="Enter Type" required="" id="wall_type_value">   
          </div>
          <div class="w3-col s6 w3-center w3-red" style="width: 40%;position: relative;left: 38px;">
            <button type="button" id="close" class="w3-btn w3-btn-block w3-red" data-dismiss="modal" style="width: 48%;position: relative;">Cancel</button>
          </div>
          <div  class="w3-col s6 w3-center w3-green" style="width: 40%;position: relative;left: 46px;">
            <button  type="submit"  class="w3-btn w3-green" id="submit_wall">  Update</button>           
          </div>
          <div class="w3-container w3-padding-hor-16 ">
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- modal end -->

@section('scripts')
@parent
<script>
  $('#add_wall').click(function(){
     $('#wall_add_modal').modal('show');
  });
  $('.editmodal').click(function(){
    $('#wall_typeID').val($(this).data('id'));
    $('#wall_type_value').val($('.type_value'+$(this).data('id')).val());
    $('#wall_edit_modal').modal('show');
  });
  
 
  
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