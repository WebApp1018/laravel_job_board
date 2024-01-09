
@extends('layouts.admin')
@section('content')
@can('user_create')
   
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

<h5>Models</h5>

    <div class="card">
    <div style="margin-bottom: 10px;" class="row">
    
        <div class="col-lg-12 mx-5 my-5">
            <button  type="button"  class="w3-btn w3-green" onclick="viewm_model(this)" data-id="model=assets/models/151_1_Omda.fbx" >  View Omda</button>
             <button  type="button"  class="w3-btn w3-green" onclick="viewm_model(this)" data-id="model=assets/models/car.glb" >  View car</button>
             <button  type="button"  class="w3-btn w3-green" onclick="viewm_model(this)" data-id="model=assets/models/DamagedHelmet.glb" >  View Halmet</button>
        </div>
    </div>

</div>



<div id="room_model_new" class="w3-modal">

    <div class="w3-modal-content">
        <div class="w3-container">
      
          <div class="card" >
            <h1>3d viewer</h1>
            <span id="close"  class="w3-button w3-display-topright">&times;</span>
            <iframe id="iframemodel"  style="height: 450px; " src="http://127.0.0.1:8080/website/index.html#model=assets/models/car.glb"></iframe>
          </div>
        </div>
      </div>

</div>

<div id="room_model" class="w3-modal">

  






@section('scripts')
@parent

<script>

  $('#add_room_type').click(function(){
    $('#room_model').modal('show');
  })
  $('#close').click(function(){
    $('#room_model').modal('hide');
  })
  function viewm_model(s){
    $('#iframemodel').attr('src' , '{{  env("VIEWER_URL") }}/website/index.html?sidebar={{ $sitesettings->sidebar }}&navigationlist={{ $sitesettings->navigationlist }}&dpanel={{ $sitesettings->dpanel }}&sidebartwo={{ $sitesettings->sidebartwo }}#'+$(s).data('id'));
    $('#room_model_new').modal('show');
  }
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