
  <?php
                  
                 $cplot  =  \App\Category::where(['id' => 18 ])->first();
                 // echo "<pre>";
                 // print_r($categories);exit;
 
              ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/logo.png">
    <link rel="icon" type="image/png" href="../../assets/img/logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Building Trees</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="../../../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../../../assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <!-- <link href="https://unpkg.com/@coreui/coreui@2.1.16/dist/css/coreui.min.css" rel="stylesheet" /> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" /> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />

        <!-- sweet alert -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.5/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.5/sweetalert2.min.css">

      <!-- <link rel="stylesheet" href="http://www-db.deis.unibo.it/courses/TW/DOCS/w3schools/lib/w3.css"> -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
     
    @yield('styles')

  
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <link href="{{ asset('css/treeview.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="http://www-db.deis.unibo.it/courses/TW/DOCS/w3schools/lib/w3.css">
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
      <meta name="csrf-token" content="{{ csrf_token() }}" />



     <!-- 3D viewei -->
     <!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script> -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel='stylesheet' href='../../3D_Model_viwer/css/spectrum.css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel='stylesheet' href='../../3D_Model_viwer/css/main_style.css' />

    <!--Three.js scripts-->
    <script src="../../3D_Model_viwer/js/three.js"></script>

    <script src="../../3D_Model_viwer/js/Projector.js"></script>
    <script src="../../3D_Model_viwer/js/Detector.js"></script>

    <script src="../../3D_Model_viwer/js/loaders/MTLLoader.js"></script>
    <script src="../../3D_Model_viwer/js/loaders/OBJLoader.js"></script>
    <script src="../../3D_Model_viwer/js/loaders/ColladaLoader.js"></script>
    <script src="../../3D_Model_viwer/js/loaders/inflate.min.js"></script>
    <script src="../../3D_Model_viwer/js/loaders/FBXLoader.js"></script>
    <script src="../../3D_Model_viwer/js/loaders/GLTFLoader.js"></script>
    <script src="../../3D_Model_viwer/js/loaders/STLLoader.js"></script>
    <script src="../../3D_Model_viwer/js/loaders/DDSLoader.js"></script>

    <script src="../../3D_Model_viwer/js/OrbitControls.js"></script>
    <script src="../../3D_Model_viwer/js/TransformControls.js"></script>

    <script src="../../3D_Model_viwer/js/THREEx.FullScreen.js"></script>
    <script src="../../3D_Model_viwer/js/THREEx.WindowResize.js"></script>
    <script src="../../3D_Model_viwer/js/screenfull.min.js"></script>

    <!--Post-Processing-->
    <script src="../../3D_Model_viwer/js/effects/EffectComposer.js"></script>
    <script src="../../3D_Model_viwer/js/effects/ShaderPass.js"></script>
    <script src="../../3D_Model_viwer/js/effects/RenderPass.js"></script>
    <script src="../../3D_Model_viwer/js/effects/CopyShader.js"></script>
    <script src="../../3D_Model_viwer/js/effects/OutlinePass.js"></script>
    <script src="../../3D_Model_viwer/js/effects/FXAAShader.js"></script>

    <script src="../../3D_Model_viwer/js/jquery.nicescroll.js"></script>
    <script src="../../3D_Model_viwer/js/spectrum.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <script>
        $(function () {
            $("#red, #green, #blue, #ambient_red, #ambient_green, #ambient_blue").slider({
                orientation: "horizontal",
                range: "min",
                max: 255,
                value: 127  //Default value, Light colour of model set to median value (grey colour)
            });
        }); 
    </script>

    <script id="vertexShader" type="x-shader/x-vertex">
        uniform float p;
        varying float intensity;
        void main()
        {
           vec3 vNormal = normalize( normalMatrix * normal );
           intensity = pow(1.0 - abs(dot(vNormal, vec3(0, 0, 1))), p);
           gl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );
        }
    </script>

    <script id="fragmentShader" type="x-shader/x-vertex">
        uniform vec3 glowColor;
        varying float intensity;
        void main()
        {
           vec3 glow = glowColor * intensity;
           gl_FragColor = vec4( glow, 1.0 );
        }
    </script>

    <script>
        $(document).ready(function () {
            $('#load_help').dialog({
                autoOpen: false,
                width: 667
            }).css("font-size", "16px");

            $('.qBtn').click(function () {
                $('#load_help').dialog('open');
            });
        });
    </script>

    <!-- END viver -->
   </head>
   <style type="text/css">
      a.close-modal {
      display: none;
      }
      .modal-backdrop {
    position: inherit!important;
    
}
#sampleMods {
  
    left: 203px!important;
}
   </style>
 <body class="app header-fixed sidebar-fixed aside-menu-fixed pace-done sidebar-lg-show">
<div class="wrapper">
        @include('partials.menu')
        <div class="main-panel">
             <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                   
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>

                     <div class="navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav">
                         </ul>
                         
                            <li class="dropdown nav-item">
                                @if(!empty($csvFile) && count($csvFile))
                                <a  download="<?php print_r($csvFile[0]->file_path)?>" href="/storage/csv/<?php
                                
                                print_r($csvFile[0]->file_path)?>" class="nav-link">
                                    <button class="btn btn-primary "  style="margin-bottom: 40px;">Csv File Download</button>
                                </a>
                                @endif
                            </li>
                            
                             <li class="dropdown nav-item" style="display: contents;">
                                                    <?php
                                 if(!empty($values)){
                                    
                                        ?>
                                 <a href="/../../storage/fbx/<?php print_r($values[1])?>"  download="<?php print_r($values[1])?>" class="btn btn-primary  mr-2" style="position: relative;list-style: inherit;" >FBX File Download</a>
                                <?php 
                                 }
                              ?>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/3d-view-model" class="nav-link">
                                <button class="btn btn-primary" style="margin-bottom: 40px;">3D view</button>
                            </a>
                            </li>
                           
                        </ul>
                         <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#" style="position:relative;top: 10px;">
                                    <strong>Username:</strong>{{ Auth::user()->name }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                    <button class="btn btn-primary"><i class="nav-icon fas fa-sign-out-alt">

                                    </i>
                                {{ trans('global.logout') }}</button>
                            </a>
                        </li>
                        </ul>
                    </div>
                    
                    
                    
                </div>
            </nav>
            <div style="padding-top: 20px" class="container-fluid">
                @yield('content')
                      <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                 <div class="card-header"> 
                                        
                               
                                       <a href="/" class="btn btn-primary mr-2"><i class="fa fa-home" style="font-size:19px;" ></i></a>
                                        
                                         <!--<a href="#" class="btn btn-primary  mr-2"><i class="nc-icon nc-cloud-download-93 mr-2"></i>Save as</a>-->
                                         <!--<a href="#" class="btn btn-primary  mr-2"><i class="nc-icon nc-circle mr-2"></i>Rename</a>-->
                                         
                                         
                                          <a href="#" class="btn btn-primary  mr-2" id="scale_up"><i class="fa fa-search-plus" style="font-size: 18px;"></i></a>
                                          
                                           <a href="#" class="btn btn-primary  mr-2"  id="scale_down"><i class="fa fa-search-minus " style="font-size: 18px;"></i> </a>
                                            <a href="/" class="btn btn-primary mr-2"> <i class="nc-icon nc-simple-add mr-2"></i>New Project</a>
                                         <a href="/" class="btn btn-primary  mr-2"><i class="nc-icon nc-bag mr-2"></i>Open Project</a>
                                          <a href="#" id="scale_down">
                                               <button id="fullscreenBtn" title="Fullscreen Mode" style="border: 0; background: transparent"> 
                                                             <img src="../../3D_Model_viwer/images/fullscreen.png" width="32" height="32" alt="fullscreen"> 
                                                        </button>
                                               </a> 
                                               
                                           
                                </div>
                                <div class="card-body all-icons">
                                    <div class="row">
                                       
                                       <div class="col-md-12">
                                            <div class="card "  style="height: 100%;">
                                                <!-- <div class="card-header ">
                                                    <h4 class="card-title">3D View</h4>
                                                   
                                                </div> -->
                                                 <div id="container">
                                                    <div id="stats"></div>

                                                    <!-- <button id="collapse_side" title="Collapse Side Menu">&larr;</button> -->
                                                    <!--<button id="collapse_btm" title="Collapse Bottom Menu">&darr;</button>-->

                                                    <!--Side Menu Start-->
                                                    <div class="side_menu" style="display: none;">
                                                        <ul class="menu_item" >

                                                            <li id="header">
                                                                <table style="width:100%">
                                                                    <tr>
                                                                        <th style="font-size: 15px;">Viewer Theme</th>
                                                                        <th style="font-size: 11px;"><button id="lightSkin">Light</button></th>
                                                                        <th style="font-size: 11px;"><button id="darkSkin">Dark</button></th>
                                                                    </tr>
                                                                </table>
                                                            </li>

                                                            <li class='dropdown'>
                                                                <a href='#'><img src="../../3D_Model_viwer/images/dir_light_icon.png" class="image" /> Lighting</a>
                                                                <ul>
                                                                    <li><span>Ambient Light</span></li>
                                                                    <li>
                                                                        <label class="switch">
                                                                            <input class="check" type="checkbox" id="ambient_light">
                                                                            <span class="toggle round"></span>
                                                                        </label>
                                                                    </li>
                                                                    <li><span style="font-size: 12px">R</span></li>
                                                                    <li><div id="ambient_red"></div></li>
                                                                    <li><span style="font-size: 12px">G</span></li>
                                                                    <li><div id="ambient_green"></div></li>
                                                                    <li><span style="font-size: 12px">B</span></li>
                                                                    <li><div id="ambient_blue"></div></li>

                                                                    <li><hr style="margin-top:15px"/></li>
                                                                    <li>Directional Light Colour</li>                 
                                                                        <li><span style="font-size: 12px">R</span></li>
                                                                        <li><div id="red"></div></li>
                                                                        <li><span style="font-size: 12px">G</span></li>
                                                                        <li><div id="green"></div></li>
                                                                        <li><span style="font-size: 12px">B</span></li>
                                                                        <li><div id="blue"></div></li>                           
                                                                    
                                                                        <li><hr style="margin-top:15px" /></li>
                                                                        <li>Point Light Intensity</li>
                                                                        <li><span style="font-size: 12px">Intensity Value</span></li>
                                                                        <li><div id="point_light"></div></li>   
                                                                </ul>                   
                                                            </li>


                                                            <li class='dropdown'>
                                                                <a href='#'><img src="../../3D_Model_viwer/images/wireframe_cube.png" class="image" />Wireframe View</a>
                                                                <ul>
                                                                    <li><span>Wireframe</span></li>
                                                                    <li>
                                                                        <label class="switch">
                                                                            <input class="check" type="checkbox" name="mod_mat" id="wire_check">
                                                                            <span class="toggle round"></span>
                                                                        </label>
                                                                    </li>
                                                                    <li><span>Model + Wireframe</span></li>
                                                                    <li>
                                                                        <label class="switch">
                                                                            <input class="check" type="checkbox" name="mod_mat" id="model_wire">
                                                                            <span class="toggle round"></span>
                                                                        </label>
                                                                    </li>
                                                                </ul>
                                                            </li>

                                                            <li class='dropdown'>
                                                                <a href='#'><img src="../../3D_Model_viwer/images/phong_icon.png" class="image" />Phong Shading</a>
                                                                <ul>
                                                                    <li> <span>Phong Shading </span></li>

                                                                    <li>
                                                                        <label class="switch">
                                                                            <input class="check" type="checkbox" name="mod_phong" id="phong_check">
                                                                            <span class="toggle round"></span>
                                                                        </label>
                                                                    </li>

                                                                    <li><span style="font-size: 12px">Shininess</span></li>
                                                                    <li><div id="shine"></div></li>
                                                                </ul>
                                                            </li>

                                                            <li class='dropdown'>
                                                                <a href='#'><img src="../../3D_Model_viwer/images/XRay.png" class="image" />X-Ray Shading</a>
                                                                <ul>
                                                                    <li> <span>X-Ray </span></li>
                                                                    <li>
                                                                        <label class="switch">
                                                                            <input class="check" type="checkbox" name="mod_xray" id="xray_check">
                                                                            <span class="toggle round"></span>
                                                                        </label>
                                                                    </li>
                                                                </ul>
                                                            </li>

                                                            <li class='dropdown'>
                                                                <a href='#'><img src="../../3D_Model_viwer/images/glowing.png" width="32" height="32" class="image" />Glow Outline</a>
                                                                <ul>
                                                                    <li> <span>Glow Outline</span></li>
                                                                    <li>
                                                                        <label class="switch">
                                                                            <input class="check" type="checkbox" name="mod_mat" id="glow_check">
                                                                            <span class="toggle round"></span>
                                                                        </label>
                                                                    </li>

                                                                    <li><span style="font-size: 12px">edgeStrength</span></li>
                                                                    <li><div id="edgeStrength"></div></li>

                                                                    <li> <span>Set Glow Colour</span></li>
                                                                    <li><input type='text' class="glow_select" /></li>
                                                                    <li><em id='basic-log'></em></li>
                                                                </ul>
                                                            </li>

                                                            <li class='dropdown'>
                                                                <a href='#'><img src="../../3D_Model_viwer/images/smoothed.png" width="32" height="32" class="image" />Smooth Model</a>
                                                                <ul>
                                                                    <li> <span id="smooth-model" style="font-size:18px">Smooth Model</span></li>
                                                                    <li>
                                                                        <label class="switch">
                                                                            <input type="checkbox" id="smooth">
                                                                            <span class="toggle round"></span>
                                                                        </label>
                                                                    </li>
                                                                </ul>
                                                            </li>

                                                            <li class='dropdown'>
                                                                <a href='#'><img src="../../3D_Model_viwer/images/colour_pick.png" class="image" />Set Background</a>
                                                                <ul>
                                                                    <li> <span>Set Background Colour</span></li>
                                                                    <li><input type='text' class="bg_select" /></li>
                                                                    <li><em id='basic_log'></em></li>
                                                                </ul>
                                                            </li>

                                                            <li class='dropdown'>
                                                                <a href='#'><img src="../../3D_Model_viwer/images/folder_icon.png" class="image" />Select/Drop Model File</a>
                                                                <ul>
                                                                    <li style="background: #d9d9f2; color: black; text-align: center">Select from button or drag and drop model onto the viewer</li>

                                                                    <li style="margin-top: 12px; margin-bottom: 16px;">
                                                                         <label for="obj_file" class="model-upload">
                                                                             <i style="margin-right: 5px;" class="fa fa-upload"></i> Load Model 
                                                                        </label>
                                                                        <button class="qBtn" id="q_btn" title="Model Loading Help"><i class="fa fa-question-circle q_mark"></i></button>
                                                                    </li>                  
                                                                    <li><input onclick="this.value=null;" type="file" id="obj_file" /></li>                       

                                                                    <li style="margin-top: 12px; margin-bottom: 16px;">
                                                                        <label for="modelPlusTexture" class="model-upload">
                                                                            <i style="margin-right: 5px;" class="fa fa-upload"></i> Model and Textures
                                                                        </label>                          
                                                                    </li>         
                                                                    <li><input id="modelPlusTexture" type="file" name="files[]" multiple="" class="model-upload"></li>

                                                                    <li><button type="button" id="remove"><i style="margin-right: 5px;" class="fa fa-trash"></i> Remove file</button></li>
                                                                    <li><output id="result" /></li>
                                                                </ul>
                                                            </li>
                                                        </ul>

                                                        <div id="load_help" title="Loading Models">
                                                            <p>Locate the model file you wish to view. Textures/associated images of the model
                                                               are supported (.obj, .gltf, .fbx and .dae formats), make sure the images and model file are in the same folder
                                                               on your machine.
                                                            </p>
                                                            <h4>Supported File Types</h4>
                                                            <ul >
                                                                <li><span style="color: green">.obj (+ .mtl)</span></li>
                                                                <li><span style="color: green">.stl</span></li>
                                                                <li><span style="color: green">.dae (Collada)</span></li>
                                                                <li><span style="color: green">.glTF</span></li>
                                                                <li><span style="color: green">.FBX</span></li>
                                                            </ul>
                                                            <p>
                                                                <h4>Model Sizes</h4>
                                                                <hr />
                                                                Some Models may be out of view of the camera on load. Try to use the mouse wheel and the
                                                                scale up/scale down buttons to see if the model comes into view.
                                                            </p>
                                                            <p>
                                                                <h4>Object Rotation</h4>
                                                                <hr />
                                                                Some Models load with a different up axis, depending on the software used to create the model.
                                                                The model rotation section contains radio buttons to rotate the model in the x, y or z direction
                                                                in order to fix the orientation for viewing your model. Most often <b>X axis</b> rotation is the one required.
                                                            </p> 
                                                            <p>
                                                                <h4>Model Loads in Black</h4>
                                                                <hr />
                                                                Some Models may load in black, try using the smooth model checkbox, to compute the vertex and face Normals.
                                                            </p>   
                                                        </div>

                                                        <div id="disp_tmp_path"></div>

                                                    </div>
                                                    <!--Side Menu End-->

                                                    <!--Bottom Menu Start-->
                                                     <?php if(!empty($values)){ ?>
                                                   <div id="bottom_menu">
                                                        <ul class="bottom_menu_item">

                                                            <li class='dropdown'>
                                                                <a href='#'><img src="../../3D_Model_viwer/images/rotation.png" class="image" />Model Rotation</a>
                                                                <ul>
                                                                    <li style="display:inline-block;  margin:0 35px 0 0;"><span>Auto Rotate</span></li>
                                                                    <li style="display:inline-block">
                                                                        <span>Set Rotation Speed</span>
                                                                        <span id="rot_slider"></span>
                                                                    </li>
                                                                    <li>
                                                                        <label class="switch">
                                                                            <input type="checkbox" id="rotation">
                                                                            <span class="toggle round"></span>
                                                                        </label>
                                                                    </li>
                                                                    <li>Fix Rotation of Imported Models<hr style="margin-top:0px" /></li>

                                                                    <li>
                                                                        <div id="rotation">
                                                                            <div class="radioBtn">
                                                                                <input type="radio" id="r1" name="rotate" value="rotateX"> Rotate X
                                                                            </div>  
                                                                                    
                                                                            <div class="radioBtn">
                                                                                <input type="radio" id="r2" name="rotate" value="rotateY"> Rotate Y
                                                                            </div>  

                                                                            <div class="radioBtn">
                                                                                <input type="radio" id="r3" name="rotate" value="rotateZ"> Rotate Z
                                                                            </div>                             
                                                                        </div>
                                                                    </li>

                                                                    <li><button class="resetRotateButton" type='reset' id="reset_rot">Reset</button></li>                     
                                                                </ul>
                                                            </li>

                                                            <!--<li class='dropdown'>-->
                                                            <!--    <a href='#'><img src="../../3D_Model_viwer/images/scale.png" class="image" />Transform Model</a>-->
                                                            <!--    <ul>-->
                                                            <!--        <li style="margin-left:25px; font-size: 15px">-->
                                                            <!--            <label for="transform">-->
                                                            <!--                Attach Transform Controls:-->
                                                            <!--                <label class="switch helper">-->
                                                            <!--                    <input type="checkbox" id="transform">-->
                                                            <!--                    <span class="toggle grid round"></span>-->
                                                            <!--                </label>-->
                                                            <!--            </label>-->
                                                            <!--        </li>-->
                                                                    <!--<li id="transformKey">Press S: (Scale), T: (Translate), R: (Rotate)</li>-->

                                                                    <!--<li style="text-align:center; margin-top:8px;font-size: 15px">-->
                                                                    <!--    <span>Scale Up:</span> &nbsp;<button id="scale_up" style="margin:0 35px 0 0" type="button">+</button>-->
                                                                    <!--    <span>Scale Down:</span> &nbsp;<button id="scale_down" type="button">-</button>-->
                                                                    <!--</li>-->
                                                                    
                                                            <!--    </ul>-->
                                                            <!--</li>-->

                                                            <li class='dropdown'>
                                                                <a href='#'><img src="../../3D_Model_viwer/images/grid.png" class="image" />Model View Helpers</a>
                                                                <ul style="font-size: 13.5px">
                                                                    <li style="display:inline-block; margin:0 25px 0 0;">
                                                                        <span style="font-size:18px">Grid</span>
                                                                        <label class="switch helper">
                                                                            <input type="checkbox" id="grid">
                                                                            <span class="toggle grid round"></span>
                                                                        </label>
                                                                    </li>
                                                                    <li style="display:inline-block; margin:0 25px 0 0;">
                                                                        <span style="font-size:18px">Polar-grid</span>
                                                                        <label class="switch helper">
                                                                            <input type="checkbox" id="polar_grid">
                                                                            <span class="toggle grid round"></span>
                                                                        </label>
                                                                    </li>
                                                                    <li style="display:inline-block; margin:0 25px 0 0;">
                                                                        <span style="font-size:18px">Axis</span>
                                                                        <label class="switch helper">
                                                                            <input type="checkbox" id="axis">
                                                                            <span class="toggle grid round"></span>
                                                                        </label>
                                                                    </li>
                                                                    <li style="display:inline-block; margin:0 25px 0 0;">
                                                                        <span style="font-size:18px">Model Box</span>
                                                                        <label class="switch helper">
                                                                            <input type="checkbox" id="bBox">
                                                                            <span class="toggle grid round"></span>
                                                                        </label>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>           
                                                    </div>
                                                 <div id="main_viewer"  ></div>
                                                 <div id="fullscreen">
                                                        <button id="fullscreenBtn" title="Fullscreen Mode" style="border: 0; background: transparent">
                                                             <img src="../../3D_Model_viwer/images/fullscreen.png" width="32" height="32" alt="fullscreen" /> 
                                                        </button>
                                                    </div>
                                                              <div id="sampleMods">
                                                               Sample Models
                                                               <br /> 
                                                              
                                                               <div class="select">
                                                                  <select id="scenes_list" onchange="selectModel(this);">
                                                                     <?php
                                                                        print_r(array_splice($values, 0, 1));
                                                                        foreach($values as $data){
                                                                        
                                                                        
                                                                        ?> 
                                                                     <option data-url="../../storage/fbx/<?php print_r($data)?>"><?php print_r($data)?></option>
                                                                     <?php
                                                                        }
                                                                        
                                                                        
                                                                        ?>
                                                                  </select>
                                                                  <br /><br />
                                                               </div>
                                                               <?php
                                                                  foreach($values as $data){ ?>
                                                               <a href="/../../storage/fbx/<?php print_r($data)?>"  download="<?php print_r($data)?>" class="btn btn-primary  mr-2" style="position: relative;left: 550px;    bottom: 40px;" ><i class="nc-icon nc-cloud-download-93 mr-2"></i>FBX File Downlaod</a>
                                                               <?php }?>
                                                            </div>
                                                              <div id="anims">   
                                                                <span>Select Animation</span>
                                                                <div class="select">
                                                                    <select id="animationSelect"></select>
                                                                </div>    
                                                                <br /> 
                                                                <button class="animBtn" id="play">Play</button>
                                                                <button class="animBtn" id="stop">Stop</button>
                                                                <button class="animBtn" id="playAll">Play All</button>
                                                            </div>
                                                             <script src="../../3D_Model_viwer/js/menu.js"></script>
                                                                <script src="../../3D_Model_viwer/js/utils.js"></script>
                                                                <script src="../../3D_Model_viwer/js/main.js"></script>
                                                                <script src="../../3D_Model_viwer/js/userModelTextures.js"></script>
                                                                <script src="../../3D_Model_viwer/js/userModel.js"></script>     
                                                            </div>
            
                                                            <script src="../../3D_Model_viwer/js/ColourTheme.js"></script>
            
                                                            <script>
                                                                $(document).ready(function () {
                                                                    $("html").niceScroll({ styler: "fb", cursorcolor: "#000" });
                                                                    $("#stats").niceScroll({ horizrailenabled: false });
                                                                });
                                                            </script>
                                                            <?php }else{
                                                            ?> <img src="/assets/img/plot.png"  alt="fullscreen" style="width:100%;"/><?php
                                                            
                                                            } ?>

                                                  <!--  <div class="card-body ">
                                                
                                                    <img src="/assets/plot.png" style="width:100%;">
                
                                                    </div> -->
                                                </div>
                                                
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
            </div>
        </div>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        
    </div>
<footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="#">3D Building View</a>
                        </p>
                    </nav>
                </div>
            </footer>    
  
  
     

         <!-- Model for Floor -->



<!-- end csv file generate -->


       
      
      <script src="{{ asset('js/treeview.js') }}"></script>
   </body>
</html>

<script type="text/javascript">
   //  $(document).ready(function(){
   //    $('#edit_plot').attr('disabled','true');
   //    $('#delete_project').attr('disabled','true');

   //  });
   $('#add_plot').click(function() {
       $('#plot_model').modal('show');
   });
   $('#edit_plot').click(function() {
        // alert('jejej');
       $('#hide_plot').hide();
       $('#hide_building').hide();
       $('#hide_floor').hide();
       var plot_parent_id = $('#plot_parent_id').val();
       // alert(plot_parent_id);
       var building_parent_id = $('#building_parent_id').val();
       var floor_parent_id = $('#floor_child_val').val();
       // alert(floor_parent_id);
       var room_parent_id = $('#room_child_val').val();
       
       var plot_parent_category = $('#plot_parent_category').val();
       
      // var option = "<option value='"+id+"'>"+name+"</option>"; 

      // $("#sel_emp").append(option); 
      
       if (plot_parent_id) {
           $('#plot_model').modal('show');
       } else if (building_parent_id ) {
           $('#show_building').modal('show');
       } else if (floor_parent_id ) {
           $('#floor_model').modal('show');
       }
        // else if (room_parent_id ) {
       //  alert('hhhh');
       //     $('#room_model').modal('show');
       // } 
       else {
           // $('#display_message').append("<b>Select the tree first</b>");
           $('#room_model').modal('show');

       }

   });
   $('#addbuilding').click(function() {
       $('#show_building').modal('show');
   });
   $('#addroom').click(function() {
       $('#room_model').modal('show');
   });
   $('#addfloor').click(function() {
       $('#floor_model').modal('show');;
   });

   $('.w3-btn-block').click(function() {
       window.location.reload();
   });

   $('.generate_CSV').click(function() {
    // alert('Hi');
    $('#generate_CSV_file_pop').modal('show');
     $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
       var parent_val = $('#pro_id').val();
      
      // alert(parent_val);
      $.ajax({

           url: "/admin/exportCsv",
           type: 'GET',
           data: {
               'project_id': parent_val
           },
           success: function(data) {
              
           }
       });
   });
   $('.parent_id').click(function() {
// alert('jdlk');
       var parent_val = $(this).val();
       $('#plot_parent_category').val(parent_val);
       // var abc = $('#plot_parent_id').val();
       // alert(abc);
       // $('#add_plot').hide();
       // $('#edit_plot').prop('disabled', false);
       // $('#delete_project').prop('disabled', false);
       $('#add_plot').attr('disabled', 'true');
       $.ajax({
           url: "/admin/category-tree-view",
           type: 'get',
           data: {
               'id': parent_val
           },
           success: function(data) {
               // console.log(data);
               
               
               var option = "<option selected value='"+data[0].id+"'>"+data[0].plot_type_name+"</option>"; 
                 $("#parent_id").append(option); 
              // alert(option);
               var parent_id = data[0].parent_id;
               var titles = data[0].title;
               var heights = data[0].height;
               var widths = data[0].width;
               var lengths = data[0].length;
               var plot_ids = data[0].id;
               $('#title').val(titles);
               $('#height').val(heights);
               $('#width').val(widths);
               $('#length').val(lengths);
               $('#plot_id').val(plot_ids);
               $('#plot_parent_id').val(parent_id);
               $('#submit_plot').hide();
               $('#update_plot').show();
           }
       });
       $('#delete_project').click(function() {
           alert(parent_val);return false;
          
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           $.ajax({
               url: "/admin/delete-plot",
               type: 'post',
               data: {
                   'id': parent_val,
               },
               success: function(data) {

                   window.location.reload();
               }
           });
       })


       $('#update_plot').click(function() {

           var plot_id = $('#plot_id').val();
           // alert(plot_id);
           var title = $('#title').val();
           var height = $('#height').val();
           var width = $('#width').val();
           var length = $('#length').val();
           var parent_id = $('#parent_id').val();

         
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           $.ajax({
               url: "/admin/update-plot",
               type: 'post',
               data: {
                   'id': parent_val,
                   'title': title,
                   'height': height,
                   'width': width,
                   'length': length,
                   'parent_id': parent_id,

                   'plot_id': plot_id
               },
               success: function(data) {

                   // $('#plot_model').hide();
                   // window.location.reload();


               }
           });
       });
   });

   $('.child_id').click(function() {

       var child_val = $(this).val();
       var parent_child_val = $(this).attr('vals');
      
       $('#floor_child_val').val(parent_child_val);
       $('#building_child_val').val(parent_child_val);
    
       $('#room_child_val').val(parent_child_val);
       var building_child_val= $('#building_child_val').val();
       var floor_child_val= $('#floor_child_val').val();
       // alert(floor_child_val);
       var room_child_val= $('#room_child_val').val();
       // alert(building_child_val);
       $('#edit_plot').prop('disabled', false);
       $('#delete_project').prop('disabled', false);
       if (building_child_val ) {
           $('#addbuilding').prop('disabled', true);
       }
       if (floor_child_val ) {
           $('#addfloor').prop('disabled', true);
       }
       if (room_child_val ) {
           $('#addroom').prop('disabled', true);
       }
       // alert(building_child_val);
       $.ajax({
           url: "/admin/tree-child-view",
           type: 'get',
           data: {
               'id': child_val,
               'building_child_val': building_child_val, 'floor_child_val': floor_child_val, 'room_child_val': room_child_val
           },
           success: function(data) {
               console.log(data);
             // floor data
                   var floor_title = data.floor[0].title;
                   $('#floor_title').val(floor_title);
                   $('#floor_parent_id').val(parent_id);
                   $('#submit_floor').hide();
                   $('#update_floor').show();
             // building data
                   var title = data.buildings[0].title;
                   console.log('title');
                   var floor_height = data.buildings[0].floor_height;
                   var number_of_floor = data.buildings[0].number_of_floor;
                   var target_area = data.buildings[0].target_area;
                   var building_type = data.buildings[0].building_type;
                   var plot_idss = data.buildings[0].id;
                   var parent_id = data.buildings[0].parent_id;

                   

                   $('#building_title').val(title);
                   $('#floor_height').val(floor_height);
                   $('#number_of_floor').val(number_of_floor);
                   $('#target_area').val(target_area);
                   var option = "<option value='" + building_type + "'>" + building_type + "</option>";
                   $("#building_type").append(option);
                   $('#building_parent_id').val(parent_id);
                   $('#plot_idss').val(plot_idss);
                   $('#submit_building').hide();
                   $('#update_building').show();
              
                //data for room
                   var room_title = data.room[0].title;
                     console.log(room_title);
                   var room_type = data.room[0].room_type;
                   var room_area = data.room[0].room_area;
                   var floor_id = data.room[0].id;
                   $('#room_title').val(room_title);
                   $('#room_type').val(room_type);
                   $('#room_area').val(room_area);
                   $('#floor_id').val(floor_id);
                   $('#room_parent_id').val(parent_id);
                   $('#submit_room').hide();
                   $('#update_room').show();
                // }



           }
       });


       $('#update_building').click(function() {
           var plot_idss = $('#plot_idss').val();
           var building_title = $('#building_title').val();
           var floor_height = $('#floor_height').val();
           var number_of_floor = $('#number_of_floor').val();
           var target_area = $('#target_area').val();
           var building_type = $('#building_type').val();

       // alert(building_type);

           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           $.ajax({
               url: "/admin/update-building",
               type: 'post',
               data: {
                   'id': child_val,
                   'building_title': building_title,
                   'floor_height': floor_height,
                   'number_of_floor': number_of_floor,
                   'target_area': target_area,
                   'building_type': building_type,
                   'plot_idss': plot_idss
               },
               success: function(data) {

                   $('#plot_model').hide();
                   window.location.reload();


               }
           });



       });

       $('#update_floor').click(function() {
         // alert('sdhlfds');
           var floor_title = $('#floor_title').val();


           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           $.ajax({
               url: "/admin/update-floor",
               type: 'post',
               data: {
                   'id': child_val,
                   'floor_title': floor_title
               },
               success: function(data) {

                   $('#plot_model').hide();
                   window.location.reload();


               }
           });



       });

       $('#update_room').click(function() {

           var floor_id = $('#floor_id').val();
           var room_title = $('#room_title').val();
           var room_area = $('#room_area').val();




           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           $.ajax({
               url: "/admin/update-room",
               type: 'post',
               data: {
                   'id': child_val,
                   'room_title': room_title,
                   'room_area': room_area,
                   'floor_id': floor_id
               },
               success: function(data) {

                   $('#room_model').hide();
                   window.location.reload();


               }
           });



       });

       $('#delete_project').click(function() {
           // alert('hi');
           alert(child_val);return false;
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           $.ajax({
               url: "/admin/delete-child",
               type: 'post',
               data: {
                   'id': child_val
               },
               success: function(data) {

                   window.location.reload();


               }
           });


       })
   });



//-------------------------------------------------------3D----------------------------------------------------------------------------------//

var container = document.getElementById('container');
var view = document.getElementById('main_viewer');

if (!Detector.webgl) Detector.addGetWebGLMessage();

var camera, camerHelper, scene, renderer, loader,
    stats, controls, transformControls, numOfMeshes = 0, model, modelDuplicate, sample_model, wireframe, mat, scale, delta;

const manager = new THREE.LoadingManager();

var modelLoaded = false, sample_model_loaded = false;
var modelWithTextures = false, fbxLoaded = false, gltfLoaded = false;;
var bg_Texture = false;

var glow_value, selectedObject, composer, effectFXAA, position, outlinePass, ssaaRenderPass;
var clock = new THREE.Clock();

var ambient, directionalLight, directionalLight2, directionalLight3, pointLight, bg_colour;
var backgroundScene, backgroundCamera, backgroundMesh;

var amb = document.getElementById('ambient_light');
var rot1 = document.getElementById('rotation');
var wire = document.getElementById('wire_check');
var model_wire = document.getElementById('model_wire');
var phong = document.getElementById('phong_check');
var xray = document.getElementById('xray_check');
var glow = document.getElementById('glow_check');
var grid = document.getElementById('grid');
var polar_grid = document.getElementById('polar_grid');
var axis = document.getElementById('axis');
var bBox = document.getElementById('bBox');

var transform = document.getElementById('transform');
var smooth = document.getElementById('smooth');
var outline = document.getElementById('outline');

var statsNode = document.getElementById('stats');

//ANIMATION GLOBALS
var animations = {}, animationsSelect = document.getElementById("animationSelect"),
animsDiv = document.getElementById("anims"), mixer, currentAnimation, actions = {};

//X-RAY SHADER MATERIAL
//http://free-tutorials.org/shader-x-ray-effect-with-three-js/
var materials = {
    default_material: new THREE.MeshLambertMaterial({ side: THREE.DoubleSide }),
    default_material2: new THREE.MeshLambertMaterial({ side: THREE.DoubleSide }),
    wireframeMaterial: new THREE.MeshPhongMaterial({
        side: THREE.DoubleSide,
        wireframe: true, 
        shininess: 100,
        specular: 0x000, emissive: 0x000,
        flatShading: false, depthWrite: true, depthTest: true
    }),
    wireframeMaterial2: new THREE.LineBasicMaterial({ wireframe: true, color: 0xffffff }),
    wireframeAndModel: new THREE.LineBasicMaterial({ color: 0xffffff }),
    phongMaterial: new THREE.MeshPhongMaterial({
        color: 0x555555, specular: 0xffffff, shininess: 10,
        flatShading: false, side: THREE.DoubleSide, skinning: true
    }),
    xrayMaterial: new THREE.ShaderMaterial({
        uniforms: {
            p: { type: "f", value: 3 },
            glowColor: { type: "c", value: new THREE.Color(0x84ccff) },
        },
        vertexShader: document.getElementById('vertexShader').textContent,
        fragmentShader: document.getElementById('fragmentShader').textContent,
        side: THREE.DoubleSide, blending: THREE.AdditiveBlending,
        transparent: true, depthWrite: false
    })
};

var clock = new THREE.Clock();
var winDims = [window.innerWidth * , window.innerHeight * 0.89]; //size of renderer

function onload() {

    //window.addEventListener('resize', onWindowResize, false);
    switchScene(0);
    animate();
}

function initScene(index) {

    scene = new THREE.Scene();

    camera = new THREE.PerspectiveCamera(70, window.innerWidth / window.innerHeight, 0.1, 500000);
    camera.position.set(0, 0, 20);

    //Setup renderer
    //renderer = new THREE.CanvasRenderer({ alpha: true });
    //renderer = new THREE.WebGLRenderer();
    // renderer.setPixelRatio(window.devicePixelRatio);
   // renderer.setSize(window.innerWidth/2, window.innerHeight)
    //renderer.setClearColor(0x292121); //565646, 29212

    view.appendChild(renderer.domElement);

    THREEx.WindowResize(renderer, camera);

    function toggleFullscreen(elem) {
        elem = elem || document.documentElement;
        if (!document.fullscreenElement && !document.mozFullScreenElement &&
            !document.webkitFullscreenElement && !document.msFullscreenElement) {

            THREEx.FullScreen.request(container);

        }
        else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
                //renderer.setSize(winDims[0], winDims[1]); //Reset renderer size on fullscreen exit
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
                //renderer.setSize(winDims[0], winDims[1]);
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
               // renderer.setSize(winDims[0], winDims[1]);
            }
        }
    }

    document.getElementById('fullscreenBtn').addEventListener('click', function () {
        toggleFullscreen();
    });
  
    ambient = new THREE.AmbientLight(0x404040);
    $('#ambient_light').change(function () {
        if (amb.checked) {
            scene.add(ambient);
        }
        else {
            scene.remove(ambient);
        }
    });

    /*LIGHTS*/
    directionalLight = new THREE.DirectionalLight(0xffeedd);
    directionalLight.position.set(0, 0, 1).normalize();
    scene.add(directionalLight);

    directionalLight2 = new THREE.DirectionalLight(0xffeedd);
    directionalLight2.position.set(0, 0, -1).normalize();
    scene.add(directionalLight2);

    directionalLight3 = new THREE.DirectionalLight(0xffeedd);
    directionalLight3.position.set(0, 1, 0).normalize();
    scene.add(directionalLight3);

    var ambientLight = new THREE.AmbientLight(0x808080, 0.2); //Grey colour, low intensity
    scene.add(ambientLight);

    pointLight = new THREE.PointLight(0xcccccc, 0.5);
    camera.add(pointLight);

    scene.add(camera);
    
    controls = new THREE.OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.09;
    controls.rotateSpeed = 0.09;

    transformControls = new THREE.TransformControls(camera, renderer.domElement);
    transformControls.addEventListener('change', render);
    scene.add(transformControls);

    transformControls.addEventListener('mouseDown', function () {
        controls.enabled = false;
    });
    transformControls.addEventListener('mouseUp', function () {
        controls.enabled = true;
    });

    window.addEventListener('keydown', function (event) {

        switch (event.keyCode) {

            case 82: // R key pressed - set rotate mode
                transformControls.setMode("rotate");
                break;

            case 84: // T key pressed - set translate mode
                transformControls.setMode("translate");
                break;

            case 83: // S key pressed - set scale mode
                transformControls.setMode("scale");
                break;
        }

    });

    //Colour changer, to set background colour of renderer to user chosen colour
    $(".bg_select").spectrum({
        color: "#fff",
        change: function (color) {
            $("#basic_log").text("Hex Colour Selected: " + color.toHexString()); //Log information
            var bg_value = $(".bg_select").spectrum('get').toHexString(); //Get the colour selected
            renderer.setClearColor(bg_value); //Set renderer colour to the selected hex value
            ssaaRenderPass.clearColor = bg_value;
            document.body.style.background = bg_value; //Set body of document to selected colour           
        }
    });

    // postprocessing    
    var renderPass = new THREE.RenderPass( scene, camera );

    var fxaaPass = new THREE.ShaderPass( THREE.FXAAShader );
    var pixelRatio = renderer.getPixelRatio();

    fxaaPass.material.uniforms[ 'resolution' ].value.x = 1 / ( window.innerWidth * pixelRatio );
    fxaaPass.material.uniforms[ 'resolution' ].value.y = 1 / ( window.innerHeight * pixelRatio );
    fxaaPass.renderToScreen = true;

    outlinePass = new THREE.OutlinePass(new THREE.Vector2(window.innerWidth, window.innerHeight), scene, camera);   
    outlinePass.edgeStrength = 1.5; 
    outlinePass.edgeGlow = 2;

    composer = new THREE.EffectComposer( renderer );
    composer.addPass( renderPass );
    composer.addPass(outlinePass);
    composer.addPass( fxaaPass );
    
    /*LOAD SAMPLE MODELS*/
    var sceneInfo = modelList[index]; //index from array of sample models in html select options
    loader = new THREE.OBJLoader(manager);
    var url = sceneInfo.url;

    // alert(url);

    //progress/loading bar
    var onProgress = function (data) {
        if (data.lengthComputable) { //if size of file transfer is known
            var percentage = Math.round((data.loaded * 100) / data.total);
            console.log(percentage);
            statsNode.innerHTML = 'Loaded : ' + percentage + '%' + ' of ' + sceneInfo.name
            + '<br>'
            + '<progress value="0" max="100" class="progress"></progress>';
            $('.progress').css({ 'width': percentage + '%' });
            $('.progress').val(percentage);
        }
    }
    var onError = function (xhr) {
        console.log('ERROR');
    };

    loader.load(url, function (data) {

        sample_model = data;
        sample_model_loaded = true;

        console.log(sample_model);

        sample_model.traverse(function (child) {
            if (child instanceof THREE.Mesh) {

                numOfMeshes++;
                var geometry = child.geometry;
                stats(sceneInfo.name, geometry, numOfMeshes);
                
                child.material = materials.default_material;

                var wireframe2 = new THREE.WireframeGeometry(child.geometry);
                var edges = new THREE.LineSegments(wireframe2, materials.wireframeAndModel);
                materials.wireframeAndModel.visible = false;
                sample_model.add(edges);

                setWireFrame(child);
                setWireframeAndModel(child);

                setPhong(child);
                setXray(child);

            }
        });

        setCamera(sample_model);

        setSmooth(sample_model);

        setBoundBox(sample_model);
        setPolarGrid(sample_model);
        setGrid(sample_model);
        setAxis(sample_model);

        scaleUp(sample_model);
        scaleDown(sample_model);

        selectedObject = sample_model;
        outlinePass.selectedObjects = [selectedObject];
        outlinePass.enabled = false;

        scene.add(sample_model);

    }, onProgress, onError);


    $('#transform').on('change', function () {
        
        if (transform.checked) {
            document.getElementById('transformKey').style.display = 'block';
            if (modelLoaded) {
                transformControls.attach(model);
            }
            else if(sample_model_loaded) {
                transformControls.attach(sample_model);
            }
            
        } else {
            document.getElementById('transformKey').style.display = 'none';
            transformControls.detach(scene);
        }
    });
}

function removeModel() {

    scene.remove(model);
    scale = 1;
    numOfMeshes = 0;
    modelLoaded = false;
    modelWithTextures = false;
    fbxLoaded = false;
    gltfLoaded = false;
    
    if (ambient) {
        scene.remove(ambient);
    }
    
    $('#point_light').slider("value", 0.5);
    pointLight.intensity = 0.5;

    camera.position.set(0, 0, 20); //Reset camera to initial position
    controls.reset(); //Reset controls, for when previous object has been moved around e.g. larger object = larger rotation
    statsNode.innerHTML = ''; //Reset stats box (faces, vertices etc)

    $("#red, #green, #blue, #ambient_red, #ambient_green, #ambient_blue").slider("value", 127); //Reset colour sliders

    amb.checked = false; rot1.checked = false; wire.checked = false;
    model_wire.checked = false; phong.checked = false; xray.checked = false;
    glow.checked = false; grid.checked = false; polar_grid.checked = false;
    axis.checked = false; bBox.checked = false; smooth.checked = false; 
    transform.checked = false, smooth.disabled = false; //Uncheck any checked boxes
    
    transformControls.detach(scene);

    document.getElementById('smooth-model').innerHTML = "Smooth Model";

    $('#rot_slider').slider({
        disabled: true //disable the rotation slider
    });
    controls.autoRotate = false; //Stop model auto rotating if doing so on new file select
    $('#shine').slider("value", 10); //Set phong shine level back to initial

    $('input[name="rotate"]').prop('checked', false); //uncheck rotate x, y or z checkboxes
    
    animsDiv.style.display = "none"; //Hide animation <div>
}

$('#remove').click(function () {
    removeModel();
});

$("#red, #green, #blue, #ambient_red, #ambient_green, #ambient_blue").slider({
    change: function (event, ui) {
        console.log(ui.value);
        render();
    }
});

var rotVal = [40, 80, 110, 140, 170, 200, 240, 280, 340, 400, 520]; //Rotation speeds low - high
var rotation_speed;

$("#rot_slider").slider({
    orientation: "horizontal",
    range: "min",
    max: rotVal.length - 1,
    value: 0,
    disabled: true,
    slide: function (event, ui) {
        rotation_speed = rotVal[ui.value]; //Set speed variable to the current selected value of slider
    }
});

$('#rotation').change(function () {
    if (rot1.checked) {
        rotation_speed = rotVal[$("#rot_slider").slider("value")];
        //set the speed to the current slider value on initial use
        controls.autoRotate = true;

        $("#rot_slider").slider({
            disabled: false,
            change: function (event, ui) {
                console.log(rotVal[ui.value]);
                controls.autoRotate = true;
                controls.autoRotateSpeed = delta * rotation_speed;
            }
        });
    }
    else {
        controls.autoRotate = false;
        $('#rot_slider').slider({
            disabled: true //disable the slider from being able to rotate object when rotation toggle is off
        });
    }
});

function setColours() {

    var colour = getColours($('#red').slider("value"), $('#green').slider("value"), $('#blue').slider("value"));
    directionalLight.color.setRGB(colour[0], colour[1], colour[2]);
    directionalLight2.color.setRGB(colour[0], colour[1], colour[2]);
    directionalLight3.color.setRGB(colour[0], colour[1], colour[2]);

    var colour = getColours($('#ambient_red').slider("value"), $('#ambient_green').slider("value"),
                            $('#ambient_blue').slider("value"));
    ambient.color.setRGB(colour[0], colour[1], colour[2]);

}

function getColours(r, g, b) {

    var colour = [r.valueOf() / 255, g.valueOf() / 255, b.valueOf() / 255];
    return colour;
}

function render() {

    setColours();
   // renderer.render(scene, camera);
}

function animate() {

    delta = clock.getDelta();
    requestAnimationFrame(animate);
    
    if (mixer) {
        mixer.update(delta);
    }
    controls.update(delta);
    
    composer.render();
    render();

}
 let  thiiii = <?php echo  $objvalues  ?>;
 let modelList = [
             {
                name: "'"+thiiii+"'", url: '../../storage/fbx/'+thiiii+''
            },
            // {
            //     name: "bear.obj", url: '../../3D_Model_viwer/sample_models/2_Alex.obj'
            // },
            // {
            //     name: "car.obj", url: '../../3D_Model_viwer/sample_models/car2.obj'
            //     //, objectRotation: new THREE.Euler(0, 3 * Math.PI / 2, 0)
                        
            // },
            // {
            //     name: "tiger.obj", url: '../../3D_Model_viwer/sample_models/Tiger.obj'
            // },
            // {
            //     name: "dinosaur.obj", url: '../../3D_Model_viwer/sample_models/Dinosaur_V02.obj'
            // },
            // {
            //     name: "skeleton.obj", url: '../../3D_Model_viwer/3D_Model_viwersample_models/skeleton.obj'
            // }
];
console.log(modelList);
function switchScene(index) {

    clear();
    initScene(index);
    var elt = document.getElementById('scenes_list');
    elt.selectedIndex = index;

}

$(document).ready(function(){

 $('#scenes_list').trigger('change');
})
function selectModel(obj) {


// let url = $(obj).find('option:selected').data('data-url')
let url = $(obj).find('option:selected').data('url')
 
 // alert(url)
// let url = $(obj).find('option:selected').val();

    var select = document.getElementById("scenes_list");
    var index = select.selectedIndex;

    if (index >= 0) {
        removeModel();     
        switchScene(index);
    }

}

function clear() {

    if (view && renderer) {
        view.removeChild(renderer.domElement);
        // document.body.style.background = "#292121";
    }
}

onload();
      
</script>