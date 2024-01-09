@extends('layouts.admin')
@section('content')
@can('user_management_create')
    
@endcan
 <style type="text/css">
      a.close-modal {
      /*display: none;*/
      }

      /*@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap");*/

.modal-backdrop {
    position: inherit!important;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1040;
    background-color: #000;
}


</style>

 <div class="content">
    <div class="container-fluid">
        <div id="notice" >
        </div>
          <form action="{{ route("admin.update.company") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="1">
            <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">Logo</label>
                <input type="file" id="logo" name="logo" class="form-control" value="">
                <br>
                <img src="../{{$data[0]->logo}}" width="200" height="100">
                </div>
            </div>
            <div class="clearfix"></div>
            </div>
            <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{$data[0]->title}}">
                </div>
            </div>
            <div class="clearfix"></div>
            </div>
            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
        
    </div>
</div>




  
@endsection
@section('scripts')
@parent

@endsection

