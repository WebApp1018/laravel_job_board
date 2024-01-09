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
            <button  type="button"  class="w3-btn w3-green" id="add_plot_type">  Add </button>
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
                          ID
                        </th>
                        <th>
                           Building Type
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
                   @foreach($data as $key => $datas)
                        <tr>
                            <td>
                              
                            </td>
                            <td>
                                 {{ $datas->user_plote_id ?? '' }}
                              
                            </td>
                            <td>
                                 {{ $datas->plot_type_name ?? '' }}
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
                                    <form  action="/admin/edit-plot/{{$datas->id}}" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="{{$datas->id}}">
                                    
                                    <button type="submit" class="w3-btn w3-blue edit_plot"  style="position:relative;left: 5px" >
                                        <i class="nav-icon fas fa-edit"></i></button>
                                    
                                    </form>  
                                @endcan

                               @can('user_delete')
                               
                                 @if(empty($datas->plotType))
                                    
                                <button class="btn btn-danger delete_plot" plottype="{{$datas->id}}" style="position:relative;left: 10px" ><i class="nav-icon fas fa-trash"></i></button>
                              
                               
                                @endif  
                                    
                                     <!--<button class="btn btn-danger delete_plot" plottype="{{$datas->id}}" style="position:relative;left: 10px" ><i class="nav-icon fas fa-trash"></i></button>-->
                                @endcan

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="plot_model" class="w3-modal">
<form method="POST" action="{{ route('admin.add.plot_type') }}" enctype="multipart/form-data">
   @csrf
   <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
   <div class="w3-center">
      <br>
      <h1> Add Edit Plot Type</h1>
   </div>
   <div class="w3-container">
      <div class="w3-section">
        
         <div class="w3-col s6 w3-center" style="width:40%" >
            <label><b>Plot Type</b></label>
         </div >
         <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
            <input type="text"  name="plot_type" value="" class="w3-input w3-border w3-margin-bottom" placeholder="Enter Floor Name" required="" id="plot_type" >   
         </div>
     
         <div class="w3-col s6 w3-center w3-red" style="width: 40%;position: relative;left: 38px;">
          <button type="button" id="close" class="w3-btn w3-btn-block w3-red" data-dismiss="modal" style="width: 48%;position: relative;">Cancel</button>
         </div>
         <div  class="w3-col s6 w3-center w3-green" style="width: 40%;position: relative;left: 46px;">
         <button  type="submit"  class="w3-btn w3-green" id="submit_floor">  Create</button>

               <a href="#close-modal" rel="modal:close" ><button type="button" class="w3-btn w3-green" id="update_floor" style='display:none'> 
                Update </button></a>
           
         </div>
         <input type="hidden" id="floor_parent_id" value="">
         <div class="w3-container w3-padding-hor-16 ">
            
         </div>
      </div>
</form>
</div>


@section('scripts')
@parent
<script>
  $('#add_plot_type').click(function(){
    $('#plot_model').modal('show');
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