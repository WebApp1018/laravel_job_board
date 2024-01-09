<head>

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

<!--<div style="margin-bottom: 10px;" class="row">-->

<!--    <div class="col-lg-12">-->

<!--        <button  type="button"  class="w3-btn w3-green" id="add_plot_type"> Add </button>-->

<!--    </div>-->

<!--</div>-->

@endcan

@if(session()->has('Downlaod_message'))                                           

    <div class="alert w-100 m-auto alert-danger alert-dismissible fade show"

    role="alert">

    <strong></strong>

    {{ session()->get('Downlaod_message') }}

    <button type="button" class="close"

        data-dismiss="alert" aria-label="Close">

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
                        <th >

                            Record ID

                        </th>
                        <th>

                            User ID

                        </th>

                        <th>

                            Project ID

                        </th>

                        <th>

                            Json0 (Project Tree json file)

                        </th>

                        <th>

                            Process FBX1

                        </th>

                        <th>

                            FBX1_File

                        </th>

                        <th>

                            JSON1_File

                        </th>

                        <th>

                            Process FBX2

                        </th>

                        <th>

                            FBX2_File

                        </th>

                        <th>

                            JSON2_File (Detailed Model JSON File)

                        </th>

                        <th>

                            Process DWG1

                        </th>

                        <th>

                            DWG1 (Drawing .dwg File)

                        </th>

                        <th>

                            Process pdf1

                        </th>

                        <th>

                            Pdf1_file

                        </th>

                        <th>

                           Conceptua Message

                        </th>

                        <th>

                            FBX1 Message

                        </th>

                        <th>

                            FBX2 Message

                        </th>

                        <th>

                            DWG1 Message

                        </th>

                        <th>

                            PDF1 Message

                        </th>

                        <th>

                            Project Revision

                        </th>

                        <th>

                            Valid

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

                            {{ $datas->user_id ?? '' }}

                        </td>

                        <td>

                            {{ $datas->project_id ?? '' }}

                        </td>

                        <td>@if($datas->json0)

                            <!-- <form > -->

                            <a href="/admin/download-file?pid={{ $datas->id}}&ftype=json" class="text-center">json0_{{ $datas->project_id ?? '' }}_rev{{ $datas->project_revision ?? '' }}</a>

                                <!-- <input type="hidden" id="jsonButton" name="jsonButton" value="{{ $datas->json0 ?? '' }}" >

                                <button type="submit" class="btn btn-link" onclick="dowloadjson()">Download JSON</button> -->

                            <!-- </form>  -->

                            @endif

                        </td> <!-- json -->

                        <td>

                        {{ $datas->process_fbx ?? '' }}

                        </td>

                        <td>

                        @if($datas->fbx1_file )

                            <a href="/admin/download-file?id={{ $datas->project_id}}&ftype=fbx1" class="text-center">fbx1_{{ $datas->project_id ?? '' }}_rev{{ $datas->project_revision ?? '' }}</a>

                        @endif

                        </td>

                        <td>

                        @if($datas->json1_file)

                            <!-- <form > -->

                            <a href="/admin/download-file?pid={{ $datas->id}}&ftype=json1" class="text-center">json1_{{ $datas->project_id ?? '' }}_rev{{ $datas->project_revision ?? '' }}</a>

                                <!-- <input type="hidden" id="jsonButton" name="jsonButton" value="{{ $datas->json0 ?? '' }}" >

                                <button type="submit" class="btn btn-link" onclick="dowloadjson()">Download JSON</button> -->

                            <!-- </form>  -->

                            @endif

                        </td> 

                        <td>

                        

                        {{ $datas->process_fbx2 ?? '' }}

                        </td> 

                        <td>@if($datas->fbx2_file)

                                <a href="/admin/download-file?id={{ $datas->project_id}}&ftype=fbx2" class="text-center">fbx2_{{ $datas->project_id ?? '' }}_rev{{ $datas->project_revision ?? '' }}</a>

                            @endif

                        </td>

                        <td>

                        @if($datas->json2_file)

                            <a href="/admin/download-file?pid={{ $datas->id}}&ftype=json2" class="text-center">

                            {{ $datas->json2_file ?? '' }} 

                            </a>

                        @endif

                        </td> 

                        <td>

                            {{ $datas->process_dwg1 ?? '' }}

                        </td>

                        <td>

                        @if($datas->dwg1_file)

                            <a href="/admin/download-file?id={{ $datas->project_id}}&ftype=dwgs" class="text-center">dwg_{{ $datas->project_id ?? '' }}_rev{{ $datas->project_revision ?? '' }}</a>

                        @endif

                        </td>

                        <td>

                        {{ $datas->process_pdf1 ?? '' }}

                        </td>

                        <td>

                        @if($datas->pdf1_file)

                            <a href="/admin/download-file?id={{ $datas->project_id}}&ftype=pdf" class="text-center">pdf_{{ $datas->project_id ?? '' }}_rev{{ $datas->project_revision ?? '' }}</a>

                        @endif

                        </td>

                        <td>

                        {{ $datas->conceptual_message ?? '' }}

                        </td>

                        <td>

                        {{ $datas->fbx1_message ?? '' }}

                        </td>

                        <td>

                        {{ $datas->fbx2_message ?? '' }}

                        </td>

                        <td>

                        {{ $datas->dwg1_message ?? '' }}

                        </td>

                        <td>

                        {{ $datas->pdf1_message ?? '' }}

                        </td>

                        <td>

                        {{ $datas->project_revision ?? '' }}

                        </td>

                        <td>

                        {{ $datas->valid ?? '' }}

                        </td>

                        <td>                  

                            <a href="/admin/project-trees/{{$datas->project_id }}/1" class="w3-btn w3-blue" style="position:relative;left: 5px;"> <i class="nav-icon fa fa-eye"></i></a>

                            <a href="/admin/delete-json-file?id={{ $datas->id }}" style="position:relative;left: 10px" class="w3-btn w3-red" style="position:relative;left: 5px;"> <i class="nav-icon fas fa-trash"></i></a>

                        </td>

                    </tr>

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

   let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'

      let deleteButton = {

    text: deleteButtonTrans,

    url: "{{ route('admin.users.massDestroy') }}",

    className: 'btn-danger',

   

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

<script>

    function dowloadjson(){

        var data = document.getElementById("jsonButton").value;

        const blob =new Blob([data], {type: 'application/json'});

        const url = URL.createObjectURL(blob);

        const a = document.createElement('a');

        a.download = 'PROJECT_TREE_JSON_FILE.json';

        a.href = url;

        a.style.display='none';

        document.body.appendChild(a);

        a.click();

        a.remove();

        URL.revokeObjectURL(url);

    }

</script>

@endsection

@endsection

