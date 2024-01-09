<?php
                  
                  $cplot  =  \App\Category::where(['id' => 18 ])->first();
                  // echo "<pre>";sampleMods
                  // print_r($categories);exit;
  
               ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/logo.png">
    <link rel="icon" type="image/png" href="../../assets/img/logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Building Trees</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
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
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />

    <!-- sweet alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.5/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.5/sweetalert2.min.css">

    <!-- <link rel="stylesheet" href="http://www-db.deis.unibo.it/courses/TW/DOCS/w3schools/lib/w3.css"> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js">
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


    @yield('styles')


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href="{{ asset('css/treeview.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/w3-css/4.1.0/3/w3.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js">
    </script>
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
    $(function() {
        $("#red, #green, #blue, #ambient_red, #ambient_green, #ambient_blue").slider({
            orientation: "horizontal",
            range: "min",
            max: 255,
            value: 127 //Default value, Light colour of model set to median value (grey colour)
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
    $(document).ready(function() {
        $('#load_help').dialog({
            autoOpen: false,
            width: 667
        }).css("font-size", "16px");

        $('.qBtn').click(function() {
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
    position: inherit !important;

}
</style>
<?php 
               
               function generateRandomString($length = 25) {
     $characters = '0123456789';
     $charactersLength = strlen($characters);
     $randomString = '';
     for ($i = 0; $i < $length; $i++) {
         $randomString .= $characters[rand(0, $charactersLength - 1)];
     }
     return $randomString;
 }
 //usage 
 $myRandomString = generateRandomString(3);
               
               ?>

<body class="app header-fixed sidebar-fixed aside-menu-fixed pace-done sidebar-lg-show">
    <div class="wrapper">
        @include('partials.menu')
        <div class="main-panel">
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">

                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>

                    <div class="navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav">
                        </ul>

                        <li class="dropdown nav-item">

                            @if(!empty($csvFile) && count($csvFile))
                            <a download="<?php print_r($csvFile[0]->file_path)?>" href="/storage/csv/<?php
                                 
                                 print_r($csvFile[0]->file_path)?>" class="nav-link">
                                <button class="btn btn-primary " style="margin-bottom: 40px;">Csv File Download</button>
                            </a>
                            @endif
                        </li>

                        <li class="dropdown nav-item" style="display: contents;">
                            <?php
                                  if(!empty($values)){
                                     
                                         ?>
                            <a href="/../../storage/fbx/<?php print_r($values[1])?>"
                                download="<?php print_r($values[1])?>" class="btn btn-primary  mr-2"
                                style="position: relative;list-style: inherit;">FBX File Download</a>
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
                                <a href="#" class="nav-link"
                                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
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


                                        <a href="/" class="btn btn-primary mr-2"><i class="fa fa-home"
                                                style="font-size:19px;"></i></a>

                                        <!--<a href="#" class="btn btn-primary  mr-2"><i class="nc-icon nc-cloud-download-93 mr-2"></i>Save as</a>-->
                                        <!--<a href="#" class="btn btn-primary  mr-2"><i class="nc-icon nc-circle mr-2"></i>Rename</a>-->


                                        <a href="#" class="btn btn-primary  mr-2" id="scale_up"><i
                                                class="fa fa-search-plus" style="font-size: 18px;"></i></a>

                                        <a href="#" class="btn btn-primary  mr-2" id="scale_down"><i
                                                class="fa fa-search-minus " style="font-size: 18px;"></i> </a>
                                        <a href="/" class="btn btn-primary mr-2"> <i
                                                class="nc-icon nc-simple-add mr-2"></i>New Project</a>
                                        <a href="/" class="btn btn-primary  mr-2"><i
                                                class="nc-icon nc-bag mr-2"></i>Open Project</a>
                                        <a href="#" id="scale_down">
                                            <button id="fullscreenBtn" title="Fullscreen Mode"
                                                style="border: 0; background: transparent">
                                                <img src="../../3D_Model_viwer/images/fullscreen.png" width="32"
                                                    height="32" alt="fullscreen">
                                            </button>
                                        </a>


                                    </div>
                                    <div class="card-body all-icons">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <div class="tree-area">

                                                            <div class="panel-body">
                                                                @if(session()->has('message'))
                                                                <div class="alert alert-success alert-dismissible fade show"
                                                                    role="alert">
                                                                    <strong>Congratulation!</strong>
                                                                    {{ session()->get('message') }}
                                                                    <button type="button" class="close"
                                                                        data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                @endif
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h3>Building App Project </h3>
                                                                        <ul id="tree1">
                                                                            @foreach($categories as $category)
                                                                            <li>
                                                                                <input type="radio" id="tree_id"
                                                                                    class="parent_id"
                                                                                    name="fav_language"
                                                                                    value="{{ $category->id}}">
                                                                                {{ $category->title }}
                                                                                @if(count($category->childs))
                                                                                @include('category.manageChild',['childs'
                                                                                => $category->childs])
                                                                                @endif
                                                                            </li>
                                                                            @endforeach


                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="card-body ">

                                                        <hr>
                                                        <!--                 <a href="#" class="nav-link" >-->
                                                        <!--        <button class="btn btn-danger" id="reset_radio"><i class="nav-icon fas fa-sign-out-alt">-->

                                                        <!--        </i>-->
                                                        <!--    reset</button>-->
                                                        <!--</a>            -->
                                                        <div class="row">
                                                            <div class="col-md-12">

                                                                <button class="btn-sm w3-btn w3-red w3-large btn-block"
                                                                    id="reset_radio">
                                                                    Reset Radio Button
                                                                </button>


                                                                <br>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <button type="button" id="add_plot"
                                                                    class="btn-sm w3-btn w3-green w3-large btn-block"
                                                                    data-toggle="modal" data-target="#exampleModal">
                                                                    Add Plot
                                                                </button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button id="addbuilding"
                                                                    class="btn-sm w3-btn w3-green w3-large btn-block">Add
                                                                    Builiding</button>

                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-6">

                                                                <button
                                                                    class="btn-sm w3-btn w3-indigo w3-large btn-block"
                                                                    id="addfloor">
                                                                    Add Floor
                                                                </button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button
                                                                    class="btn-sm w3-btn w3-indigo w3-large btn-block"
                                                                    id="addroom">Add Room</button>

                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">

                                                                <button
                                                                    class="btn-sm w3-btn w3-deep-purple w3-large btn-block"
                                                                    id="properties_plot">
                                                                    Properties
                                                                </button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button
                                                                    class="btn-sm w3-btn w3-deep-purple w3-large btn-block duplicate">Duplicate</button>

                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            @if(Auth::user()->id != 1 )
                                                            <div class="col-md-6">

                                                                <button class="btn-sm w3-btn w3-red w3-large btn-block"
                                                                    id="delete_project">
                                                                    Delete
                                                                </button>


                                                                <br>
                                                            </div>

                                                            <div class="col-md-6">



                                                                <button class="btn-sm w3-btn w3-blue w3-large btn-block"
                                                                    id="edit_plot">
                                                                    Edit
                                                                </button>

                                                            </div>

                                                            @endif

                                                            @if(Auth::user()->id == 1 )


                                                            <div class="col-md-6">



                                                                <button class="btn-sm w3-btn w3-blue w3-large btn-block"
                                                                    id="edit_plot">
                                                                    Edit
                                                                </button>

                                                            </div>
                                                            <div class="col-md-6">

                                                                <button class="btn-sm w3-btn w3-red w3-large btn-block"
                                                                    id="delete_project">
                                                                    Delete
                                                                </button>


                                                                <br>
                                                            </div>

                                                            @endif



                                                            <div class="col-md-12 bgt-lg">
                                                                <br>
                                                                <button
                                                                    class="btn-sm w3-btn w3-black w3-large btn-block generate_CSV">Generate</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card d-none" style="height: 100%;">

                                                    <!-- <div class="card-header ">
                                                     <h4 class="card-title">3D View</h4>
                                                    
                                                 </div> -->
                                                    <div id="container">
                                                        <div id="stats"></div>

                                                        <!-- <button id="collapse_side" title="Collapse Side Menu">&larr;</button> -->
                                                        <!--<button id="collapse_btm" title="Collapse Bottom Menu">&darr;</button>-->

                                                        <!--Side Menu Start-->
                                                        <div class="side_menu" style="display: none;">
                                                            <ul class="menu_item">

                                                                <li id="header">
                                                                    <table style="width:100%">
                                                                        <tr>
                                                                            <th style="font-size: 15px;">Viewer Theme
                                                                            </th>
                                                                            <th style="font-size: 11px;"><button
                                                                                    id="lightSkin">Light</button></th>
                                                                            <th style="font-size: 11px;"><button
                                                                                    id="darkSkin">Dark</button></th>
                                                                        </tr>
                                                                    </table>
                                                                </li>

                                                                <li class='dropdown'>
                                                                    <a href='#'><img
                                                                            src="../../3D_Model_viwer/images/dir_light_icon.png"
                                                                            class="image" /> Lighting</a>
                                                                    <ul>
                                                                        <li><span>Ambient Light</span></li>
                                                                        <li>
                                                                            <label class="switch">
                                                                                <input class="check" type="checkbox"
                                                                                    id="ambient_light">
                                                                                <span class="toggle round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li><span style="font-size: 12px">R</span></li>
                                                                        <li>
                                                                            <div id="ambient_red"></div>
                                                                        </li>
                                                                        <li><span style="font-size: 12px">G</span></li>
                                                                        <li>
                                                                            <div id="ambient_green"></div>
                                                                        </li>
                                                                        <li><span style="font-size: 12px">B</span></li>
                                                                        <li>
                                                                            <div id="ambient_blue"></div>
                                                                        </li>

                                                                        <li>
                                                                            <hr style="margin-top:15px" />
                                                                        </li>
                                                                        <li>Directional Light Colour</li>
                                                                        <li><span style="font-size: 12px">R</span></li>
                                                                        <li>
                                                                            <div id="red"></div>
                                                                        </li>
                                                                        <li><span style="font-size: 12px">G</span></li>
                                                                        <li>
                                                                            <div id="green"></div>
                                                                        </li>
                                                                        <li><span style="font-size: 12px">B</span></li>
                                                                        <li>
                                                                            <div id="blue"></div>
                                                                        </li>

                                                                        <li>
                                                                            <hr style="margin-top:15px" />
                                                                        </li>
                                                                        <li>Point Light Intensity</li>
                                                                        <li><span style="font-size: 12px">Intensity
                                                                                Value</span></li>
                                                                        <li>
                                                                            <div id="point_light"></div>
                                                                        </li>
                                                                    </ul>
                                                                </li>


                                                                <li class='dropdown'>
                                                                    <a href='#'><img
                                                                            src="../../3D_Model_viwer/images/wireframe_cube.png"
                                                                            class="image" />Wireframe View</a>
                                                                    <ul>
                                                                        <li><span>Wireframe</span></li>
                                                                        <li>
                                                                            <label class="switch">
                                                                                <input class="check" type="checkbox"
                                                                                    name="mod_mat" id="wire_check">
                                                                                <span class="toggle round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li><span>Model + Wireframe</span></li>
                                                                        <li>
                                                                            <label class="switch">
                                                                                <input class="check" type="checkbox"
                                                                                    name="mod_mat" id="model_wire">
                                                                                <span class="toggle round"></span>
                                                                            </label>
                                                                        </li>
                                                                    </ul>
                                                                </li>

                                                                <li class='dropdown'>
                                                                    <a href='#'><img
                                                                            src="../../3D_Model_viwer/images/phong_icon.png"
                                                                            class="image" />Phong Shading</a>
                                                                    <ul>
                                                                        <li> <span>Phong Shading </span></li>

                                                                        <li>
                                                                            <label class="switch">
                                                                                <input class="check" type="checkbox"
                                                                                    name="mod_phong" id="phong_check">
                                                                                <span class="toggle round"></span>
                                                                            </label>
                                                                        </li>

                                                                        <li><span
                                                                                style="font-size: 12px">Shininess</span>
                                                                        </li>
                                                                        <li>
                                                                            <div id="shine"></div>
                                                                        </li>
                                                                    </ul>
                                                                </li>

                                                                <li class='dropdown'>
                                                                    <a href='#'><img
                                                                            src="../../3D_Model_viwer/images/XRay.png"
                                                                            class="image" />X-Ray Shading</a>
                                                                    <ul>
                                                                        <li> <span>X-Ray </span></li>
                                                                        <li>
                                                                            <label class="switch">
                                                                                <input class="check" type="checkbox"
                                                                                    name="mod_xray" id="xray_check">
                                                                                <span class="toggle round"></span>
                                                                            </label>
                                                                        </li>
                                                                    </ul>
                                                                </li>

                                                                <li class='dropdown'>
                                                                    <a href='#'><img
                                                                            src="../../3D_Model_viwer/images/glowing.png"
                                                                            width="32" height="32" class="image" />Glow
                                                                        Outline</a>
                                                                    <ul>
                                                                        <li> <span>Glow Outline</span></li>
                                                                        <li>
                                                                            <label class="switch">
                                                                                <input class="check" type="checkbox"
                                                                                    name="mod_mat" id="glow_check">
                                                                                <span class="toggle round"></span>
                                                                            </label>
                                                                        </li>

                                                                        <li><span
                                                                                style="font-size: 12px">edgeStrength</span>
                                                                        </li>
                                                                        <li>
                                                                            <div id="edgeStrength"></div>
                                                                        </li>

                                                                        <li> <span>Set Glow Colour</span></li>
                                                                        <li><input type='text' class="glow_select" />
                                                                        </li>
                                                                        <li><em id='basic-log'></em></li>
                                                                    </ul>
                                                                </li>

                                                                <li class='dropdown'>
                                                                    <a href='#'><img
                                                                            src="../../3D_Model_viwer/images/smoothed.png"
                                                                            width="32" height="32"
                                                                            class="image" />Smooth Model</a>
                                                                    <ul>
                                                                        <li> <span id="smooth-model"
                                                                                style="font-size:18px">Smooth
                                                                                Model</span></li>
                                                                        <li>
                                                                            <label class="switch">
                                                                                <input type="checkbox" id="smooth">
                                                                                <span class="toggle round"></span>
                                                                            </label>
                                                                        </li>
                                                                    </ul>
                                                                </li>

                                                                <li class='dropdown'>
                                                                    <a href='#'><img
                                                                            src="../../3D_Model_viwer/images/colour_pick.png"
                                                                            class="image" />Set Background</a>
                                                                    <ul>
                                                                        <li> <span>Set Background Colour</span></li>
                                                                        <li><input type='text' class="bg_select" /></li>
                                                                        <li><em id='basic_log'></em></li>
                                                                    </ul>
                                                                </li>

                                                                <li class='dropdown'>
                                                                    <a href='#'><img
                                                                            src="../../3D_Model_viwer/images/folder_icon.png"
                                                                            class="image" />Select/Drop Model File</a>
                                                                    <ul>
                                                                        <li
                                                                            style="background: #d9d9f2; color: black; text-align: center">
                                                                            Select from button or drag and drop model
                                                                            onto the viewer</li>

                                                                        <li
                                                                            style="margin-top: 12px; margin-bottom: 16px;">
                                                                            <label for="obj_file" class="model-upload">
                                                                                <i style="margin-right: 5px;"
                                                                                    class="fa fa-upload"></i> Load Model
                                                                            </label>
                                                                            <button class="qBtn" id="q_btn"
                                                                                title="Model Loading Help"><i
                                                                                    class="fa fa-question-circle q_mark"></i></button>
                                                                        </li>
                                                                        <li><input onclick="this.value=null;"
                                                                                type="file" id="obj_file" /></li>

                                                                        <li
                                                                            style="margin-top: 12px; margin-bottom: 16px;">
                                                                            <label for="modelPlusTexture"
                                                                                class="model-upload">
                                                                                <i style="margin-right: 5px;"
                                                                                    class="fa fa-upload"></i> Model and
                                                                                Textures
                                                                            </label>
                                                                        </li>
                                                                        <li><input id="modelPlusTexture" type="file"
                                                                                name="files[]" multiple=""
                                                                                class="model-upload"></li>

                                                                        <li><button type="button" id="remove"><i
                                                                                    style="margin-right: 5px;"
                                                                                    class="fa fa-trash"></i> Remove
                                                                                file</button></li>
                                                                        <li><output id="result" /></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>

                                                            <div id="load_help" title="Loading Models">
                                                                <p>Locate the model file you wish to view.
                                                                    Textures/associated images of the model
                                                                    are supported (.obj, .gltf, .fbx and .dae formats),
                                                                    make sure the images and model file are in the same
                                                                    folder
                                                                    on your machine.
                                                                </p>
                                                                <h4>Supported File Types</h4>
                                                                <ul>
                                                                    <li><span style="color: green">.obj (+ .mtl)</span>
                                                                    </li>
                                                                    <li><span style="color: green">.stl</span></li>
                                                                    <li><span style="color: green">.dae (Collada)</span>
                                                                    </li>
                                                                    <li><span style="color: green">.glTF</span></li>
                                                                    <li><span style="color: green">.FBX</span></li>
                                                                </ul>
                                                                <p>
                                                                <h4>Model Sizes</h4>
                                                                <hr />
                                                                Some Models may be out of view of the camera on load.
                                                                Try to use the mouse wheel and the
                                                                scale up/scale down buttons to see if the model comes
                                                                into view.
                                                                </p>
                                                                <p>
                                                                <h4>Object Rotation</h4>
                                                                <hr />
                                                                Some Models load with a different up axis, depending on
                                                                the software used to create the model.
                                                                The model rotation section contains radio buttons to
                                                                rotate the model in the x, y or z direction
                                                                in order to fix the orientation for viewing your model.
                                                                Most often <b>X axis</b> rotation is the one required.
                                                                </p>
                                                                <p>
                                                                <h4>Model Loads in Black</h4>
                                                                <hr />
                                                                Some Models may load in black, try using the smooth
                                                                model checkbox, to compute the vertex and face Normals.
                                                                </p>
                                                            </div>

                                                            <div id="disp_tmp_path"></div>

                                                        </div>
                                                        <!--Side Menu End-->

                                                        <!--Bottom Menu Start-->

                                                        <!--Bottom Menu End-->





                                                        <?php if(!empty($values)){ ?>

                                                        <div id="bottom_menu">
                                                            <ul class="bottom_menu_item">

                                                                <li class='dropdown'>
                                                                    <a href='#'><img
                                                                            src="../../3D_Model_viwer/images/rotation.png"
                                                                            class="image" />Model Rotation</a>
                                                                    <ul>
                                                                        <li
                                                                            style="display:inline-block;  margin:0 35px 0 0;">
                                                                            <span>Auto Rotate</span>
                                                                        </li>
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
                                                                        <li>Fix Rotation of Imported Models
                                                                            <hr style="margin-top:0px" />
                                                                        </li>

                                                                        <li>
                                                                            <div id="rotation">
                                                                                <div class="radioBtn">
                                                                                    <input type="radio" id="r1"
                                                                                        name="rotate" value="rotateX">
                                                                                    Rotate X
                                                                                </div>

                                                                                <div class="radioBtn">
                                                                                    <input type="radio" id="r2"
                                                                                        name="rotate" value="rotateY">
                                                                                    Rotate Y
                                                                                </div>

                                                                                <div class="radioBtn">
                                                                                    <input type="radio" id="r3"
                                                                                        name="rotate" value="rotateZ">
                                                                                    Rotate Z
                                                                                </div>
                                                                            </div>
                                                                        </li>

                                                                        <li><button class="resetRotateButton"
                                                                                type='reset'
                                                                                id="reset_rot">Reset</button></li>
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
                                                                    <a href='#'><img
                                                                            src="../../3D_Model_viwer/images/grid.png"
                                                                            class="image" />Model View Helpers</a>
                                                                    <ul style="font-size: 13.5px">
                                                                        <li
                                                                            style="display:inline-block; margin:0 25px 0 0;">
                                                                            <span style="font-size:18px">Grid</span>
                                                                            <label class="switch helper">
                                                                                <input type="checkbox" id="grid">
                                                                                <span class="toggle grid round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li
                                                                            style="display:inline-block; margin:0 25px 0 0;">
                                                                            <span
                                                                                style="font-size:18px">Polar-grid</span>
                                                                            <label class="switch helper">
                                                                                <input type="checkbox" id="polar_grid">
                                                                                <span class="toggle grid round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li
                                                                            style="display:inline-block; margin:0 25px 0 0;">
                                                                            <span style="font-size:18px">Axis</span>
                                                                            <label class="switch helper">
                                                                                <input type="checkbox" id="axis">
                                                                                <span class="toggle grid round"></span>
                                                                            </label>
                                                                        </li>
                                                                        <li
                                                                            style="display:inline-block; margin:0 25px 0 0;">
                                                                            <span style="font-size:18px">Model
                                                                                Box</span>
                                                                            <label class="switch helper">
                                                                                <input type="checkbox" id="bBox">
                                                                                <span class="toggle grid round"></span>
                                                                            </label>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div id="main_viewer"></div>
                                                        <div id="fullscreen">
                                                            <button id="fullscreenBtn" title="Fullscreen Mode"
                                                                style="border: 0; background: transparent">
                                                                <img src="../../3D_Model_viwer/images/fullscreen.png"
                                                                    width="32" height="32" alt="fullscreen" />
                                                            </button>
                                                        </div>
                                                        <div id="sampleMods" style="display:none;">
                                                            Sample Models
                                                            <br />

                                                            <div class="select">
                                                                <select id="scenes_list" onchange="selectModel(this);">
                                                                    <?php
                                                                         print_r(array_splice($values, 0, 1));
                                                                         foreach($values as $data){
                                                                         
                                                                         
                                                                         ?>
                                                                    <option
                                                                        data-url="../../storage/fbx/<?php print_r($data)?>">
                                                                        <?php print_r($data)?></option>
                                                                    <?php
                                                                         }
                                                                         
                                                                         
                                                                         ?>
                                                                </select>
                                                                <br /><br />
                                                            </div>

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
                                                        <!--<script src="../../3D_Model_viwer/js/main.js"></script>-->
                                                        <script src="../../3D_Model_viwer/js/userModelTextures.js">
                                                        </script>
                                                        <script src="../../3D_Model_viwer/js/userModel.js"></script>
                                                    </div>

                                                    <script src="../../3D_Model_viwer/js/ColourTheme.js"></script>

                                                    <script>
                                                    $(document).ready(function() {
                                                        $("html").niceScroll({
                                                            styler: "fb",
                                                            cursorcolor: "#000"
                                                        });
                                                        $("#stats").niceScroll({
                                                            horizrailenabled: false
                                                        });
                                                    });
                                                    </script>
                                                    <?php }else{
                                                             ?> <img src="/assets/img/plot.png" alt="fullscreen"
                                                        style="width:100%;" /><?php
                                                             
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

    <div id="display_message">
    </div>


    <div class="w3-modal" id="plot_model">
        <span onclick="document.getElementById('id01').style.display='none'"
            class="w3-closebtn w3-hover-red w3-container w3-padding-hor-8 w3-display-topright">&times;</span>
        <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
            <div class="w3-center">
                <br>
                <div id="auto_edit_plot" style="display:none;">
                    <h1> Edit Plot</h1>
                </div>
                <div id="auto_add_plot">
                    <h1> Add Plot</h1>
                </div>
                <div id="auto_details_plot" style="display:none;">
                    <h1> Plot Details</h1>
                </div>
            </div>
            <div class="w3-container">
                <div class="w3-section">
                    <div class="w3-row">

                    </div>
                    <div id="auto_generated_id" style="display:none;">
                        <div class="w3-col s6 w3-center" style="width:40%">
                            <label><b>Obejct ID</b></label>
                        </div>
                        <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                            <div class="form-group">
                                <input class="form-control" type="number" name="plot_auto_id" disabled required=""
                                    id='plot_auto_id'>
                            </div>
                        </div>
                    </div>

                    <div id="auto_generated_proper">
                        <div class="w3-col s6 w3-center" style="width:40%">
                            <label><b>Obejct ID</b></label>
                        </div>
                        <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                            <div class="form-group">
                                <i> <label>Auto Generated ID</label></i>
                            </div>
                        </div>
                    </div>
                    <form role="form" id="category" method="POST" action="{{ route('admin.add.plot') }}"
                        enctype="multipart/form-data">
                        @csrf


                        <div class="w3-col s6 w3-center" style="width:40%">
                            <label><b>Plot Name</b></label>
                        </div>
                        <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <input class="form-control" type="text" name="title" placeholder="Enter Plot"
                                    required="" id='title' value="Plot<?php echo $myRandomString;?>">
                            </div>
                        </div>
                        <div class="w3-col s6 w3-center" style="width:40%">
                            <label><b>Plot Type</b></label>
                        </div>

                        <!-- <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;" id="plotdropdown" >
                   <select id="parent_id" name="parent_id" class="form-control w3-margin-bottom  " required>
                       <option  value=""  >Select Plot Type</option>
                        @foreach($plottype as $rows) 
                        @foreach($plottypeSelect as $data)
 
                       <option value="{{ $rows->plot_type }}" {{ ($rows->plot_type)}}  >{{ $rows->plot_type }}</option>
                     
                        @endforeach
                       @endforeach
                   </select>
               </div> -->
                        <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;"
                            id="plotdropdownajax">
                            <select id="parent_id" name="parent_id"
                                class="form-control w3-margin-bottom plottypeselect " required>
                                <!--<option  value="">Select Plot Type</option>-->
                            </select>
                        </div>

                        <div class="w3-col s6 w3-center" style="width:40%">
                            <label><b>Height limit</b></label>
                        </div>
                        <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                            <input class="form-control w3-margin-bottom" name="height" type="number"
                                placeholder="Enter Height" id="height" value="">
                        </div>
                        <div class="w3-col s6 w3-center" style="width:40%">
                            <label><b>Width limit</b></label>
                        </div>
                        <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                            <input class="form-control w3-margin-bottom" name="width" type="number"
                                placeholder="Enter Width" id="width" value="">
                        </div>
                        <div class="w3-col s6 w3-center" style="width:40%">
                            <label><b>Length limit</b></label>
                        </div>
                        <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                            <input class="form-control w3-margin-bottom" name="length" type="number"
                                placeholder="Enter Length" id="length" value="">
                        </div>
                        <?php 
              $currenturl = url()->full();
              $projectId = explode('/project-trees/', $currenturl);
           
              ?><br> <input type="hidden" id="pro_id" name="project_id" value="<?php echo $projectId[1]; ?>"> <?php
             ?>
                        <input type="hidden" id="plot_id" value="">
                        <div class="w3-col s6 w3-center w3-green" style="width: 40%;position: relative;left: 38px;">
                            <a href="#close-modal" rel="modal:close"> <button class="w3-btn w3-btn-block w3-red"
                                    id="cancel_btn">
                                    Cancel</button></a>
                        </div>
                        <div class="w3-col s6 w3-center w3-green" style="width: 40%;position: relative;left: 46px;"
                            id="submit_form">

                            <button type="submit" class="w3-btn w3-green" id="submit_plot"> Create Plot</button>
                            <a href="#close-modal" rel="modal:close"><button type="button" class="w3-btn w3-green"
                                    id="update_plot" style='display:none'>
                                    Update Plot</button></a>

                            <!-- <a href="#close-modal" rel="modal:close"> <button type="submit"  class="w3-btn w3-btn-block w3-red" id="update_plot" style='display:none'>
                 Update Plot</button></a> -->
                        </div>
                        <input type="hidden" id="plot_parent_id" value="">
                        <input type="hidden" id="plot_parent_category" value="">
                        <!-- newwwwwwwwwwwwwwwwwwwwwwwwwwwww -->
                        <input type="hidden" id="user_id" value="">
                        <input type="hidden" id="project_id" value="">
                        <input type="hidden" id="building_primiry_id" value="">

                        <div class="w3-container w3-padding-hor-16 ">

                        </div>
                    </form>
                </div>
            </div>


            <div id="show_building" class="w3-modal">
                <span onclick="document.getElementById('id02').style.display='none'"
                    class="w3-closebtn w3-hover-red w3-container w3-padding-hor-8 w3-display-topright">&times;</span>
                <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
                    <div class="w3-center">
                        <br>
                        <div id="auto_edit_building" style="display:none;">
                            <h1> Edit Buliding</h1>
                        </div>
                        <div id="auto_add_building">
                            <h1> Add Buliding</h1>
                        </div>
                        <div id="auto_details_building" style="display:none;">
                            <h1> Buliding Details</h1>
                        </div>
                    </div>
                    <div class="w3-container">
                        <div class="w3-section">
                            <div class="w3-row">
                                <!-- <div class="w3-col s6 w3-center" style="width:40%" >
                      <p>Obejct ID</p>
                   </div>
                   <div class="w3-col s6  w3-center">
                      <p>0001</p>
                   </div> -->
                            </div>

                            <div id="auto_generated_id_building" style="display:none;">
                                <div class="w3-col s6 w3-center" style="width:40%">
                                    <label><b>Obejct ID</b></label>
                                </div>
                                <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                                    <div class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
                                        <input class="form-control" type="number" name="buliding_id" required=""
                                            disabled id='buliding_id' value="">
                                    </div>
                                </div>
                            </div>



                            <div id="auto_generated_building">
                                <div class="w3-col s6 w3-center" style="width:40%">
                                    <label><b>Obejct ID</b></label>
                                </div>
                                <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                                    <div class="form-group">
                                        <i> <label>Auto Generated ID</label></i>
                                    </div>
                                </div>
                            </div>


                            <form role="form" id="categorys" method="POST" action="{{ route('admin.add.building') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="w3-col s6 w3-center" style="width:40%">
                                    <label><b>Building Name</b></label>
                                </div>
                                <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                                    <input class="form-control w3-margin-bottom" type="text" name="title"
                                        placeholder="Enter Building Name" required="" id='building_title'
                                        value="Building<?php echo $myRandomString;?>">
                                </div>
                                <div class="w3-col s6 w3-center" style="width:40%">
                                    <label><b>Building Type</b></label>
                                </div>

                                <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                                    <select id="building_type" name="building_type"
                                        class="form-control w3-margin-bottom buildingtypeselect" value="">
                                        <!--<option value="">Select Building</option>  -->
                                    </select>
                                </div>
                                <div id="hide_plot">
                                    <div class="w3-col s6 w3-center" style="width:40%">
                                        <label><b>Plot</b></label>
                                    </div>
                                    <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                                        <select id="parent_id" name="parent_id1" class="form-control w3-margin-bottom"
                                            required>
                                            <option value="">Select Plot</option>
                                            @foreach($allPlot as $rows)
                                            <option value="{{ $rows->id }}">{{ $rows->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div id="show_plot" style="display:none">
                                    <div class="w3-col s6 w3-center" style="width:40%">
                                        <label><b>Plot</b></label>
                                    </div>
                                    <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                                        <select id="parent_id" name="parent_id"
                                            class="form-control w3-margin-bottom plotselect ">
                                            <!--<option value="">Select Plot</option>-->

                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="w3-col s6 w3-center" style="width:40%">
                            <label><b>Floor Height</b></label>
                        </div>
                        <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                            <input class="form-control w3-margin-bottom" type="number" name="floor_height"
                                placeholder="Floor Height" id="floor_height" value="">
                        </div>
                        <div class="w3-col s6 w3-center" style="width:40%">
                            <label><b>Number Of Floor</b></label>
                        </div>
                        <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                            <input class="form-control w3-margin-bottom" type="number" name="number_of_floor"
                                placeholder="Number Of Floor" id="number_of_floor" value="">
                        </div>
                        <div class="w3-col s6 w3-center" style="width:40%">
                            <label><b>Target Area</b></label>
                        </div>
                        <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                            <input class="form-control w3-margin-bottom" type="number" name="target_area"
                                placeholder="Target Area" id="target_area" value="">
                        </div>
                        <input type="hidden" id="plot_idss" value="">
                        <div class="w3-col s6 w3-center w3-green" style="width: 40%;position: relative;left: 38px;">
                            <a href="#close-modal" rel="modal:close"><button class="w3-btn w3-btn-block w3-red"
                                    id="cancel_btn">Cancel</button></a>
                        </div>
                        <?php 
              $currenturl = url()->full();
              $projectId = explode('/project-trees/', $currenturl);
           
              ?><br> <input type="hidden" name="project_id" value="<?php echo $projectId[1]; ?>"> <?php
             ?>

                        <div class="w3-col s6 w3-center w3-green" style="width: 40%;position: relative;left: 46px;">
                            <button type="submit" class="w3-btn w3-green" id="submit_building"> Create Building</button>
                            <a href="#close-modal" rel="modal:close"><button type="button" class="w3-btn w3-green"
                                    id="update_building" style='display:none'>
                                    Update Building</button></a>
                            <input type="hidden" id="building_parent_id" value="">
                            <input type="hidden" id="building_child_val" value="">
                            <input type="hidden" id="plot_id_del" value="">
                        </div>
                    </div>
                    </form>
                    <div class="w3-container w3-padding-hor-16 ">

                    </div>

                </div>

                <!-- Model for Floor -->
                <div id="floor_model" class="w3-modal">


                    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
                        <div class="w3-center">
                            <br>
                            <div id="auto_edit_floor" style="display:none;">
                                <h1> Edit Floor</h1>
                            </div>
                            <div id="auto_add_floor">
                                <h1> Add Floor</h1>
                            </div>
                            <div id="auto_details_floor" style="display:none;">
                                <h1> Floor Details</h1>
                            </div>
                        </div>
                        <div id="auto_generated_id_floor" style="display:none;">
                            <div class="w3-col s6 w3-center" style="width:40%">
                                <label><b>Obejct ID</b></label>
                            </div>
                            <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                                <div class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
                                    <input class="form-control" type="number" name="id" required="" id='floor_id'
                                        disabled>
                                </div>
                            </div>
                        </div>

                        <div id="auto_generated_floor">
                            <div class="w3-col s6 w3-center" style="width:40%">
                                <label><b>Obejct ID</b></label>
                            </div>
                            <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                                <div class="form-group">
                                    <i> <label>Auto Generated ID</label></i>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('admin.add.floor') }}" enctype="multipart/form-data"
                            id="floor_clear" class="floor_clear">
                            @csrf
                            <div class="w3-container">
                                <div class="w3-section">
                                    <div class="w3-row">
                                        <!-- <div class="w3-col s6 w3-center" style="width:40%" >
                                            <p>Obejct ID</p>
                                         </div>
                                         <div class="w3-col s6  w3-center">
                                            <p>0001</p>
                                         </div> -->
                                    </div>

                                    <div class="w3-col s6 w3-center" style="width:40%">
                                        <label><b>Floor Name</b></label>
                                    </div>
                                    <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                                        <input type="text" name="title" value="Floor<?php echo $myRandomString;?>"
                                            class="w3-input w3-border w3-margin-bottom" placeholder="Enter Floor Name"
                                            required="" id="floor_title" value="">
                                        @if ($errors->has('title'))
                                        <span class="text-red" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="w3-col s6 w3-center" style="width:40%">
                                        <label><b>Floor Number</b></label>
                                    </div>
                                    <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                                        <input type="number" name="floor_number"
                                            class="w3-input w3-border w3-margin-bottom" placeholder="Enter Floor Number"
                                            required="" id="floor_number" value="">
                                        @if ($errors->has('title'))
                                        <span class="text-red" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div id="hide_building">
                                        <div class="w3-col s6 w3-center" style="width:40%">
                                            <label><b>Select Building</b></label>
                                        </div>
                                        <div class="w3-col s6 w3-center"
                                            style="width: 40%;position: relative;left: 46px;">
                                            <select id="parent_id" name="parent_id1"
                                                class="w3-input w3-border w3-margin-bottom" required>
                                                <!--<option value="">Select Building</option>-->
                                                @foreach($buildings as $rows)
                                                <option value="{{ $rows->id }}">{{ $rows->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('parent_id'))
                                            <span class="text-red" role="alert">
                                                <strong>{{ $errors->first('parent_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="show_buildings" style="display:none">
                                        <div class="w3-col s6 w3-center" style="width:40%">
                                            <label><b>Select Building</b></label>
                                        </div>
                                        <div class="w3-col s6 w3-center"
                                            style="width: 40%;position: relative;left: 46px;">
                                            <select id="parent_id" name="parent_id"
                                                class="w3-input w3-border w3-margin-bottom buildingselect">
                                                <!--<option value="">Select Building Type</option>-->
                                            </select>
                                            @if ($errors->has('parent_id'))
                                            <span class="text-red" role="alert">
                                                <strong>{{ $errors->first('parent_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="w3-col s6 w3-center w3-green"
                                        style="width: 40%;position: relative;left: 38px;">
                                        <a href="#close-modal" rel="modal:close"> <button
                                                class="w3-btn w3-btn-block w3-red" id="cancel_btn">
                                                Cancel</button></a>
                                    </div>
                                    <div class="w3-col s6 w3-center w3-green"
                                        style="width: 40%;position: relative;left: 46px;">
                                        <button type="submit" class="w3-btn w3-green" id="submit_floor"> Create
                                            Floor</button>
                                        <a href="#close-modal" rel="modal:close"><button type="button"
                                                class="w3-btn w3-green" id="update_floor" style='display:none'>
                                                Update Floor </button></a>

                                    </div>
                                    <?php 
                                          $currenturl = url()->full();
                                          $projectId = explode('/project-trees/', $currenturl);
                                       
                                          ?>
                                    <br> <input type="hidden" name="project_id" value="<?php echo $projectId[1]; ?>">
                                    <?php ?>
                                    <input type="hidden" id="floor_parent_id" value="">
                                    <input type="hidden" id="floor_child_val" value="">
                                    <div class="w3-container w3-padding-hor-16 ">

                                    </div>

                        </form>
                    </div>
                </div>

                <!-- csv generate modal -->

                <div id="generate_CSV_file_pop" class="w3-modal">
                    <form method="POST" action="{{ route('admin.add.floor') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
                            <div class="w3-center">
                                <br>
                                <h1> Thank You !</h1>
                                <p style="width: 100%;max-width: 454px;margin: auto;font-size: 19px;"><strong>Your Csv
                                        File Generated.If you want downlad csv file then Please click this view
                                        Button</strong></p>
                            </div>
                            <div class="w3-container">
                                <div class="w3-section">

                                    <div class="w3-col s6 w3-center w3-green"
                                        style="width: 40%;position: relative;left: 38px;">
                                        <a href="#close-modal" rel="modal:close"> <button
                                                class="w3-btn w3-btn-block w3-red" id="cancel_btn">
                                                Cancel</button></a>
                                    </div>
                                    <div class="w3-col s6 w3-center w3-green"
                                        style="width: 40%;position: relative;left: 46px;">
                                        <!-- <button  type="submit"  class="w3-btn w3-green" id="submit_floor">  view Button</button> -->
                                        <a href="/admin/view-csv-file"><button type="button" class="w3-btn w3-green"
                                                id="update_floor">
                                                View Csv File </button></a>

                                    </div>
                                    <?php 
                                      $currenturl = url()->full();
                                      $projectId = explode('/project-trees/', $currenturl);
                                   
                                      ?><br> <input type="hidden" name="project_id"
                                        value="<?php echo $projectId[1]; ?>"> <?php
                                     ?>
                                    <input type="hidden" id="floor_parent_id" value="">

                                    <div class="w3-container w3-padding-hor-16 ">

                                    </div>
                                </div>
                    </form>
                </div>



                <!-- end csv file generate -->
                <!-- duplicate project -->
                <div id="duplicate_show" class="w3-modal">

                    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
                        <div class="w3-center">
                            <br>
                            <h1> Do you want to duplicate</h1>
                        </div>
                        <div class="w3-container">
                            <div class="w3-section">

                                <div class="w3-col s6 w3-center w3-green"
                                    style="width: 40%;position: relative;left: 38px;">
                                    <a href="#close-modal" rel="modal:close"> <button
                                            class="w3-btn w3-btn-block w3-red">
                                            Cancel</button></a>
                                </div>
                                <div class="w3-col s6 w3-center w3-green"
                                    style="width: 40%;position: relative;left: 46px;">
                                    <!-- <button  type="submit"  class="w3-btn w3-green" id="submit_floor">  view Button</button> -->
                                    <button type="button" class="w3-btn w3-green" id="duplicate_insert">
                                        Duplicate </button>

                                </div>
                                <input type="hidden" id="floorID" value="">

                                <div class="w3-container w3-padding-hor-16 ">

                                </div>
                            </div>

                        </div>



                        <!-- End duplicate project -->

                        <div id="delete_rocord_show" class="w3-modal">

                            <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
                                <div class="w3-center">
                                    <br>
                                    <h1> Do you want to delete this tree</h1>
                                </div>
                                <div class="w3-container">
                                    <div class="w3-section">
                                        <div class="w3-col s6 w3-center w3-green"
                                            style="width: 40%;position: relative;left: 38px;">
                                            <a href="#close-modal" rel="modal:close">
                                                <button class="w3-btn w3-btn-block w3-red"> Cancel</button>
                                            </a>
                                        </div>
                                        <div class="w3-col s6 w3-center w3-green"
                                            style="width: 40%;position: relative;left: 46px;">
                                            <!-- <button  type="submit"  class="w3-btn w3-green" id="submit_floor">  view Button</button> -->
                                            <button type="button" class="w3-btn w3-green" id="delete_tree_project">
                                                Delete Tree </button>
                                        </div>
                                        <div class="w3-container w3-padding-hor-16 ">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- Model for Room -->
                        <div id="room_model" class="w3-modal">
                            <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
                                <div class="w3-center">
                                    <br>
                                    <div id="auto_edit_room" style="display:none;">
                                        <h1> Edit Room</h1>
                                    </div>
                                    <div id="auto_add_room">
                                        <h1> Add Room</h1>
                                    </div>
                                    <div id="auto_details_room" style="display:none;">
                                        <h1> Room Details</h1>
                                    </div>
                                </div>
                                <div id="auto_generated_id_room" style="display:none;">
                                    <div class="w3-col s6 w3-center" style="width:40%">
                                        <label><b>Obejct ID</b></label>
                                    </div>
                                    <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                                        <div class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
                                            <input class="form-control" type="number" name="id" required="" id='room_id'
                                                disabled>
                                        </div>
                                    </div>
                                </div>

                                <div id="auto_generated_room">
                                    <div class="w3-col s6 w3-center" style="width:40%">
                                        <label><b>Obejct ID</b></label>
                                    </div>
                                    <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                                        <div class="form-group">
                                            <i> <label>Auto Generated ID</label></i>
                                        </div>
                                    </div>
                                </div>

                                <form role="form" id="room_clear" class="room_clear" method="POST"
                                    action="{{ route('admin.add.room') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="project_id" id="project_id_room_wpr"
                                        value="<?php echo $projectId[1]; ?>" />
                                    <div class="w3-container">
                                        <div class="w3-section">
                                            <div class="w3-row">
                                                <!-- <div class="w3-col s6 w3-center" style="width:40%" >
                                                   <p>Obejct ID</p>
                                                </div>
                                                <div class="w3-col s6  w3-center">
                                                   <p>0001</p>
                                                </div> -->
                                            </div>
                                            <div>

                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                    <label><b>Room Name</b></label>
                                                </div>
                                                <div class="w3-col s6 w3-center"
                                                    style="width: 40%;position: relative;left: 46px;">
                                                    <input type="text" id="room_title" name="title"
                                                        value="Room<?php echo $myRandomString;?>"
                                                        class="w3-input w3-border w3-margin-bottom"
                                                        placeholder="Enter Room Name" required="">
                                                    @if ($errors->has('title'))
                                                    <span class="text-red" role="alert">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="w3-col s6 w3-center" style="width:40%">
                                                <label><b>Room Type</b></label>
                                            </div>
                                            <div class="w3-col s6 w3-center"
                                                style="width: 40%;position: relative;left: 46px;">
                                                <select id="room_type " name="room_type"
                                                    class="form-control w3-margin-bottom roomtypeselect room_type"
                                                    value="">
                                                    <!--<option value="">Select Room Type</option>   -->
                                                </select>
                                            </div>
                                            <div class="w3-col s6 w3-center radio_plot_floor" style="width:40%">
                                                <label><b>Floor or Plot</b></label>
                                            </div>
                                            <div class="w3-col s6 mb-3 radio_plot_floor"
                                                style="width: 40%;position: relative;left: 46px;">
                                                <label for="floor_label">Floor</label> <input type="radio"
                                                    id="floor_label" name="floorPlot" class="mr-2" value="floor" checked
                                                    style="">
                                                <label for="plot_label">Plot</label> <input type="radio" id="plot_label"
                                                    name="floorPlot" class="" value="building" style="">
                                            </div>
                                            <div id="hide_floor">
                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                    <label><b class="floorPlot_heading">Floor</b></label>
                                                </div>
                                                <div class="w3-col s6 w3-center"
                                                    style="width: 40%;position: relative;left: 46px;">
                                                    <div id="floor_wpr">
                                                        <div class="hidde_check">
                                                            <input type='hidden' name='flotFlor_check'
                                                                class='flotFlor_check' value='f' />
                                                        </div>
                                                        <select id="parent_id" name="parent_id1"
                                                            class="w3-input w3-border w3-margin-bottom" required>
                                                            <!--<option value="">Select Floor</option>-->
                                                            @foreach($floors as $rows)
                                                            <option value="{{ $rows->id }}">{{ $rows->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('parent_id'))
                                                        <span class="text-red" role="alert">
                                                            <strong>{{ $errors->first('parent_id') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div id="Plot_wpr" style="display:none">
                                                        <div class="hidde_check"></div>
                                                        <select id="newid" name=""
                                                            class="w3-input w3-border w3-margin-bottom" required>
                                                            <!--<option value="">Select Plot</option>-->
                                                            @foreach($allPlot as $rows)
                                                            <option value="{{ $rows->id }}">{{ $rows->title }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div id="show_floor" style="display:none">
                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                    <label><b class="floorPlot_heading">Floor</b></label>
                                                </div>
                                                <div class="w3-col s6 w3-center"
                                                    style="width: 40%;position: relative;left: 46px;">
                                                    <div id="floor_wpr">
                                                        <select id="parent_id" name="parent_id" data-plotFloorId=""
                                                            class="w3-input w3-border w3-margin-bottom floorselect">
                                                            <!--<option value="">Select Floor</option>-->
                                                        </select>
                                                        @if ($errors->has('parent_id'))
                                                        <span class="text-red" role="alert">
                                                            <strong>{{ $errors->first('parent_id') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div id="Plot_wpr" style="display:none">
                                                        <div class="hidde_check"></div>
                                                        <select id="newid" name=""
                                                            class="w3-input w3-border w3-margin-bottom" required>
                                                            <!--<option value="">Select Plot</option>-->
                                                            @foreach($allPlot as $rows)
                                                            <option value="{{ $rows->id }}">{{ $rows->title }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <?php 
                                                  $currenturl = url()->full();
                                                  $projectId = explode('/project-trees/', $currenturl);
                                               
                                                  ?><br> <input type="hidden" name="project_id"
                                                value="<?php echo $projectId[1]; ?>"> <?php
                                            ?>
                                            <div class="w3-col s6 w3-center" style="width:40%">
                                                <label><b>Area</b></label>
                                            </div>
                                            <div class="w3-col s6 w3-center"
                                                style="width: 40%;position: relative;left: 46px;">
                                                <input class="w3-input w3-border w3-margin-bottom" type="text"
                                                    placeholder="Enter Area" name="room_area" id="room_area" value="">
                                            </div>
                                            <input type="hidden" id="floor_id" value="">
                                            <div class="w3-col s6 w3-center w3-green"
                                                style="width: 40%;position: relative;left: 38px;">
                                                <a href="#close-modal" rel="modal:close">
                                                    <button class="w3-btn w3-btn-block w3-red"
                                                        id="cancel_btn">Cancel</button>
                                                </a>
                                            </div>
                                            <input type="hidden" id="room_parent_id" value="">
                                        </div>
                                        <div class="w3-col s6 w3-center w3-green"
                                            style="width: 40%;position: relative;left: 46px;">
                                            <button type="submit" class="w3-btn w3-green" id="submit_room"> Create
                                                Room</button>
                                            <!--<a href="#close-modal" rel="modal:close">-->
                                            <button type="button" class="w3-btn w3-green" id="update_room"
                                                style='display:none'> Update Room </button>
                                            <!--</a>-->
                                        </div>
                                        <div class="w3-container w3-padding-hor-16 ">
                                            <input type="hidden" id="room_child_val" value="">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



    <script src="{{ asset('js/treeview.js') }}"></script>
</body>

</html>