
@extends('layouts.admin')
@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <button  type="button"  class="w3-btn w3-green" id="add_room_type">  Add </button>
             
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


 <!-- website start -->
 {{-- <link rel="stylesheet" type="text/css" href="{{ asset('website/css/icons.css') }}">
 <link rel="stylesheet" type="text/css" href=" {{ asset('website/css/themes.css') }} ">
 <link rel="stylesheet" type="text/css" href="{{ asset('website/css/core.css') }}">
 <link rel="stylesheet" type="text/css" href=" {{ asset('website/css/controls.css') }}">
 <link rel="stylesheet" type="text/css" href=" {{ asset('website/css/dialogs.css') }}">
 <link rel="stylesheet" type="text/css" href=" {{ asset('website/css/treeview.css') }}">
 <link rel="stylesheet" type="text/css" href=" {{ asset('website/css/panelset.css') }}">
 <link rel="stylesheet" type="text/css" href=" {{ asset('website/css/navigator.css') }}">
 <link rel="stylesheet" type="text/css" href=" {{ asset('website/css/sidebar.css') }}">
 <link rel="stylesheet" type="text/css" href=" {{ asset('website/css/website.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('website/css/embed.css') }}"> --}}
 {{-- <script type="text/javascript" src="{{ asset('website/build/o3dv.website.min-dev.js') }}"></script>
 <script type="text/javascript" src="../build/o3dv.website.min-dev.js"></script> --}}
 <!-- website end -->

<!-- analytics end -->

<!-- website init start -->



<div class="card" >
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
                           Title
                        </th>
                        <th>
                          Status
                       </th>
                        <th>
                           image
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
                                 {{ $datas->title ?? '' }}
                            </td>
                            <td>
                              <?php if($datas->status == 1){?>
                                <span class="badge badge-success">Active</span>
                                  <?php }else{?>
                                   <span class="badge badge-danger">Deactive</span>
                                  <?php } ?>
                               

                                  
                          </td>
                            <td>
                                 <img src="{{ asset($datas->image) }}" width="100px" height="100px"> 
                            </td>
                            <td>
                                  {{ $datas->created_at ?? '' }}
                            </td>
                           
                            
                            <td>
                                <!-- @can('user_show')
                               
                                 <button  type="submit"  id="tree_id" id="view" class="parent_id w3-btn w3-green"  name="fav_language"  style="position: relative;left: 2px;"><i class="nav-icon fa fa-folder-open"></i></button>
                                @endcan -->

                                @can('user_edit')
                                  
                                 <!--<form  action="{{url('/admin/edit-room',[$datas->id])}}" enctype="multipart/form-data">-->
                                        <!--<input type="hidden" name="id" value="{{$datas->id}}">-->
                                    
                                    <a href="{{url('/admin/edit-blog',[$datas->id])}}" class="w3-btn w3-blue edit_plot"  style="position:relative;left: 5px" >
                                        <i class="nav-icon fas fa-edit"></i></a>
                                    
                                    <!--</form>  -->
                                  <!--  <button class="w3-btn w3-blue " id="edit_room" style="position:relative;left: 5px;"><i class="nav-icon fas fa-edit"></i></button> -->
                                @endcan
                              
                               @can('user_delete')
                                
                               
                                    
                                @if(empty($datas->roomType))
                                    
                                <button class="btn btn-danger delete_blog" roomtype="{{$datas->id}}" style="position:relative;left: 10px" ><i class="nav-icon fas fa-trash"></i></button>
                              
                               
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

<div id="room_model" class="w3-modal">




<form method="POST" action="{{ route('admin.add.blog') }}" enctype="multipart/form-data">
   @csrf
   <div class="w3-modal-content w3-card-8 w3-animate-zoom" >
   <div class="w3-center">
      <br>
      <h1> Add Blog </h1>
   </div>
   <div class="w3-container">
      <div class="w3-section">
        
         <div class="w3-col s6 w3-center" style="width:20%" >
            <label><b>title</b></label>
         </div >
         <div class="w3-col s6 w3-center" style="width: 70%;position: relative;left: 46px;">
            <input type="text"  name="title" value="" class="w3-input w3-border w3-margin-bottom" placeholder="Title" required="" id="title" value="">   
         </div>
 <br>
         <div class="w3-col s6 w3-center" style="width:20%" >
          <label><b>Description</b></label>
       </div >
       <div class="w3-col s6 w3-center" style="width: 70%;position: relative;left: 46px;">
          <textarea  name="description"  class=" ckeditor w3-input w3-border w3-margin-bottom" placeholder="Description" required="" id="description" value=""> </textarea>  
       </div>

       <div class="w3-col s6 w3-center" style="width:20%" >
        <label><b>Image</b></label>
     </div >
     <div class="w3-col s6 w3-center" style="width: 70%;position: relative;left: 46px;">
        <input type="file"  name="image" value="" class="w3-input w3-border w3-margin-bottom" placeholder="image" required="" id="image" value="">   
     </div>
        
         <div class="clearfix"></div>
         <div class="w3-col s6 w3-center w3-red" style="width: 40%;position: relative;left: 38px;">
          <button type="button" id="close" class="w3-btn w3-btn-block w3-red" data-dismiss="modal" style="width: 48%;position: relative;">Cancel</button>
         </div>
         <div  class="w3-col s6 w3-center w3-green" style="width: 40%;position: relative;left: 46px;">
         <button  type="submit"  class="w3-btn w3-green" id="submit_floor">  Create</button>
               <a href="#close-modal" rel="modal:close"><button type="button" class="w3-btn w3-green" id="update_floor" style='display:none'> 
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

  $('#add_room_type').click(function(){
    $('#room_model').modal('show');
  })
  // $('#viewidbtn').click(function(){
   
  // })
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