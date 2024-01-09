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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title"><strong>3D View Project</strong></h4>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>ID</th>
                                           <!--  <th>Name</th>
                                            <th>Email</th> -->
                                            <th>Project Name</th>
                                            <th>Project Deception</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                             <?php $i = 0; if (!empty($allProject)) {?>
                                              @foreach($allProject as $project)
                                            <tr>
                                                <td><?php  echo ++$i; ?></td>
                                                <!-- <td>{{$project->name ?? ''}}</td>
                                                <td>{{$project->email ?? ''}}</td> -->
                                                <td>{{$project->project_name ?? ''}}</td>
                                                <td>{{ substr($project->description ?? '', 0, 60) }}...</button></td>   
                                                <td>
                                                   
                                                        <a href="/admin/3d-view-model/{{$project->id}}" class="w3-btn w3-blue" style="position:relative;left: 5px;"> <i class="nav-icon fa fa-eye"></i></a>

                                                      <!--   <button class="btn btn-danger delete_pro" ids="{{$project->id}}" style="position:relative;left: 10px" ><i class="nav-icon fas fa-trash"></i></button> -->

                                                        <!-- <input type="hidden" value="{{$project->id}}" name="pro_id" id="p_id">   -->
                                                </td>
                                            </tr>
                                             @endforeach   
                                          <?php }else{
                                            // echo "No Data";
                                          } ?>
                                
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

      <div id="id01" class="w3-modal">
        <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
        <div class="w3-center">
           <br>
           <h1> Create Project</h1>
        </div>
        <div class="w3-container">
           <div class="w3-section">
              <div class="w3-row">
                 <div class="w3-col s6 w3-center" style="width:40%" >
                    <!-- <p>Obejct ID</p> -->
                 </div>
                 <div class="w3-col s6  w3-center">

                   
                 </div>
              </div>
               <form role="form" id="category" method="POST" action="{{ route('admin.add.project') }}" enctype="multipart/form-data">
                @csrf
              <div style="width: 85%;margin: auto;">
                 <label><b>Project Name</b></label>
                 <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <input class="form-control" type="text" name="project_name" placeholder="Create Project" required="" id="project_name">
                </div>
                <br>
                <label><b>Project Description</b></label>
                 <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <textarea class="form-control" type="text" name="description" id="description" placeholder="description..." required=""  rows="6" cols="50"></textarea>
                </div>

                <!-- <div class="w3-col s6 w3-center w3-green" style="width: 48%;position: relative;"> -->
                <button type="button" id="close" class="btn btn-danger" data-dismiss="modal" style="width: 48%;position: relative;">Close</button>
                 <!-- </div> -->

             
                
                <button type="button" class="w3-btn w3-green" id="update_project" style="width: 48%;position: relative;left:20px;display:none"> update Project</button>
              </div>
              
              <div class="w3-container w3-padding-hor-16 ">
                
              </div>
          </form> 
           </div>
        </div>


  
  </div>
  



  
@endsection
@section('scripts')
@parent

@endsection

