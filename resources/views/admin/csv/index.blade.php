@extends('layouts.admin')
@section('content')
@can('user_create')
<!--<div style="margin-bottom: 10px;" class="row">-->
<!--    <div class="col-lg-12">-->
<!--        <button  type="button"  class="w3-btn w3-green" id="add_plot_type"> Add </button>-->
<!--    </div>-->
<!--</div>-->
@endcan
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Congratulation!</strong> {{ session()->get('message') }}
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
                            Project Name
                        </th>
                        <th>
                            Email
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
                    <?php $num = 1;$grand_total = 0; ?>
                    @foreach($allcsvFile as $key => $datas)
                    <tr>
                        <td>

                        </td>

                        <td>
                            {{ $datas->id ?? '' }}
                        </td>
                        <td>
                            {{ $datas->project_name ?? '' }}
                        </td>
                        <td>
                            {{ $datas->email ?? '' }}
                        </td>
                        <td>
                            {{ $datas->created_at ?? '' }}
                        </td>
                        <td>
                            {{ $datas->updated_at ?? '' }}
                        </td>


                        <td>
                            @foreach(explode('/',$datas->file_path) as $info)
                            @endforeach
                            
                            <!--<button class="btn btn-danger" id="add_project_type"  deleteId="{{ $datas->id ?? ''}}" ><i class="nav-icon fas fa-trash"></i></button>-->

                            <a href="{{URL::to('/')}}/storage/csv{{$datas->file_path}}" target="_blank">
                             <button class="btn"><i class="fa fa-download"></i> Download File</button>
                         </a>
                           <!--  <a href="{{base_path()}}/storage/csv{{$datas->file_path}}" target="_blank" download  class="btn btn-primary" ><i class="fa fa-download"></i> Download</a> -->
                           <!-- <form action="{{url('admin/exportCsv2')}}" action="post">
                           @csrf
                           
                           <input type="hidden" name="project_id" value="{{$datas->project_id}}">
                           <input type="hidden" id="project_revision_id2" name="project_revision_id" value="{{$datas->project_revision}}">
                           <input type="hidden" id="revesion_id" name="revesion_id" value="{{$datas->file_path}}">
                           <span class="nav-link">
                           <button class="btn btn-primary downloadcsv" type="submit" style="">Csv File Download</button>
                           </span>
                        </form> -->
                        
                        </td>
                    </tr>
                    <?php $num++; ?>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>

<div class="w3-modal project_model">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
        <div class="w3-center">
            <br>
            <h1>Delete project!</h1>
            <p style="width: 100%;max-width: 454px;margin: auto;font-size: 19px;">Are you sure you want to delete your
                project?</p>
        </div>

        <div class="w3-container">
            <div class="w3-section">

                <div class="w3-col s6 w3-center " style="width: 40%;position: relative;left: 16px;">
                    <a href="/" rel="modal:close" style="padding: 14px;"> <button class="w3-btn w3-btn-block w3-red"
                            style="padding: 14px;">
                            Cancel</button></a>
                </div>
                <div class="w3-col s6 w3-center w3-green" style="width: 40%;position: relative;left: 70px;">
                    @if(!empty($allcsvFile) && $allcsvFile->count())
                    <button class="w3-btn w3-btn-block w3-green project_delete" deleteId="{{$datas->id}}"
                        style="padding: 14px;">
                        Delete</button>
                </div>
                @else
                <div>
                    <td colspan="10">There are no data.</td>
                </div>
                @endif
                <div class="w3-container w3-padding-hor-16 ">

                </div>
            </div>
        </div>

    </div>
</div>
@section('scripts')
@parent


<script>
    // $(document).ready(function(){
    //   let num = {{$num-1}};
      
      

    //   $(".record_"+num).click(function(e){
    //       let url = $(this).attr('href');
    //       let downloadFile = $(this).attr('data-downlaodFile');
    //       alert(url);
    //       alert(downloadFile);
    //       e.preventDefault();  
    //       // window.location.href = url;
    //   });
    //   $(".record_"+num).trigger('click')
      
    // });
</script>
<script>
  $('.destroy_admin_p').click(function() {

      $('#floor_model').modal('show');
  });

  $('.project_delete').click(function() {
      var id = $(this).attr('deleteId');
      alert(id);
      // alert(description);
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          url: "/admin/delete_pro",
          type: 'post',
          data: {
              'id': id
          },
          success: function(data) {
              // console.log(data);
              //  window.location.reload();

              // $("#notice").html('<div class="alert alert-warning"<strong>Successfully !</strong> Project deleted.</div>').fadeOut(5000);
              //      parent.fadeOut('slow', function() {$(this).remove();});

              // console.log(data);  
          }
      });
  });
  $('.add_project_type').click(function() {
      $('.project_model').modal('show');
  });



  $(function() {
      let deleteButtonTrans = '{{ trans('
      global.datatables.delete ') }}'
      let deleteButton = {
          text: deleteButtonTrans,
          url: "{{ route('admin.users.massDestroy') }}",
          className: 'btn-danger',
          action: function(e, dt, node, config) {
              var ids = $.map(dt.rows({
                  selected: true
              }).nodes(), function(entry) {
                  return $(entry).data('entry-id')
              });

              if (ids.length === 0) {
                  alert('{{ trans('
                      global.datatables.zero_selected ') }}')

                  return
              }

              if (confirm('{{ trans('
                      global.areYouSure ') }}')) {
                  $.ajax({
                          headers: {
                              'x-csrf-token': _token
                          },
                          method: 'POST',
                          url: config.url,
                          data: {
                              ids: ids,
                              _method: 'DELETE'
                          }
                      })
                      .done(function() {
                          location.reload()
                      })
              }
          }
      }
      let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
      // @can('user_delete')
      //   dtButtons.push(deleteButton)
      // @endcan

      $('.datatable:not(.ajaxTable)').DataTable({
          buttons: dtButtons
      })
  })
</script>
@endsection
@endsection