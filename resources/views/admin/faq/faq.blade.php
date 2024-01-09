
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
                           question
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
                                 {{ $datas->question ?? '' }}
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
                                    
                                    <a href="{{url('/admin/edit-faqs',[$datas->id])}}" class="w3-btn w3-blue edit_plot"  style="position:relative;left: 5px" >
                                        <i class="nav-icon fas fa-edit"></i></a>
                                    
                                    <!--</form>  -->
                                  <!--  <button class="w3-btn w3-blue " id="edit_room" style="position:relative;left: 5px;"><i class="nav-icon fas fa-edit"></i></button> -->
                                @endcan
                              
                               @can('user_delete')
                                
                               
                                    
                                @if(empty($datas->roomType))
                                    
                                <button class="btn btn-danger delete_faq" roomtype="{{$datas->id}}" style="position:relative;left: 10px" ><i class="nav-icon fas fa-trash"></i></button>
                              
                               
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
<form method="POST" action="{{ route('admin.add.faqs') }}" enctype="multipart/form-data">
   @csrf
   <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
   <div class="w3-center">
      <br>
      <h1> Add FAQ </h1>
   </div>
   <div class="w3-container">
      <div class="w3-section">
        
         <div class="w3-col s6 w3-center" style="width:40%" >
            <label><b>Question</b></label>
         </div >
         <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
            <input type="text"  name="question" value="" class="w3-input w3-border w3-margin-bottom" placeholder="Question" required="" id="question" value="">   
         </div>

         <div class="w3-col s6 w3-center" style="width:40%" >
          <label><b>Answer</b></label>
       </div >
       <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
          <textarea  name="answer"  class="w3-input w3-border w3-margin-bottom" placeholder="Answer" required="" id="answer" value=""> </textarea>  
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