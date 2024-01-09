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
                    <div class="row" style="margin:2% 0px;">
                        <div class="col-lg-12">
                                <a class="btn btn-success" href="{{ url("admin/add-company") }}">
                                    Add Company Logo
                                </a>
                            </div>
                    </div>
                    <div class="row" style="margin:2% 0px;">
                            <div class="col-lg-12">
                                <a class="btn btn-success" href="{{ url("admin/add-feature-content") }}">
                                    Add Features Content
                                </a>
                            </div>
                    </div>
                    <div class="row" style="margin:2% 0px;">
                             <div class="col-lg-12">
                                <a class="btn btn-success" href="{{ url("admin/add-faq-content") }}">
                                    Add FAQ Content
                                </a>
                            </div>
                    </div>
                    <div class="row" style="margin:2% 0px;">
                             <div class="col-lg-12">
                                <a class="btn btn-success" href="{{ url("admin/add-support-content") }}">
                                    Add Support Page Content
                                </a>
                            </div>
                    </div>
                    <div class="row" style="margin:2% 0px;">
                             <div class="col-lg-12">
                                <a class="btn btn-success" href="{{ url("admin/add-landing-content") }}">
                                    Add Landing Page Content
                                </a>
                            </div>
                    </div>   
                    
                </div>
            </div>




  
@endsection
@section('scripts')
@parent

@endsection

