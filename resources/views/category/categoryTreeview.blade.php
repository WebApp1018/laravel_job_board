<?php
$cplot = \App\Category::where(['id' => 18])->first();
// echo "<pre>";sampleMods
// print_r($categories);exit;
?>

<?php $segment_users = request()->segment(3); ?>
@extends('layouts.admin')
@section('styles')
    <script>
        var x = "loader";
    </script>
    <meta charset="UTF-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    <link href="{{ asset('css/treeview.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/w3-css/4.1.0/3/w3.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <!-- 3D viewei -->
    <!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script> -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel='stylesheet' href='../../../3D_Model_viwer/css/spectrum.css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='../../../3D_Model_viwer/css/main_style.css' />
    <!--Three.js scripts-->
    <script src="../../../3D_Model_viwer/js/three.js"></script>
    <script src="../../../3D_Model_viwer/js/Projector.js"></script>
    <script src="../../../3D_Model_viwer/js/Detector.js"></script>
    <script src="../../../3D_Model_viwer/js/loaders/MTLLoader.js"></script>
    <script src="../../../3D_Model_viwer/js/loaders/OBJLoader.js"></script>
    <script src="../../../3D_Model_viwer/js/loaders/ColladaLoader.js"></script>
    <script src="../../../3D_Model_viwer/js/loaders/inflate.min.js"></script>
    <script src="../../../3D_Model_viwer/js/loaders/FBXLoader.js"></script>
    <script src="../../../3D_Model_viwer/js/loaders/GLTFLoader.js"></script>
    <script src="../../../3D_Model_viwer/js/loaders/STLLoader.js"></script>
    <script src="../../../3D_Model_viwer/js/loaders/DDSLoader.js"></script>
    <script src="../../../3D_Model_viwer/js/OrbitControls.js"></script>
    <script src="../../../3D_Model_viwer/js/TransformControls.js"></script>
    <script src="../../../3D_Model_viwer/js/THREEx.FullScreen.js"></script>
    <script src="../../../3D_Model_viwer/js/THREEx.WindowResize.js"></script>
    <script src="../../../3D_Model_viwer/js/screenfull.min.js"></script>
    <!--Post-Processing-->
    <script src="../../../3D_Model_viwer/js/effects/EffectComposer.js"></script>
    <script src="../../../3D_Model_viwer/js/effects/ShaderPass.js"></script>
    <script src="../../../3D_Model_viwer/js/effects/RenderPass.js"></script>
    <script src="../../../3D_Model_viwer/js/effects/CopyShader.js"></script>
    <script src="../../../3D_Model_viwer/js/effects/OutlinePass.js"></script>
    <script src="../../../3D_Model_viwer/js/effects/FXAAShader.js"></script>
    <script src="../../../3D_Model_viwer/js/jquery.nicescroll.js"></script>
    <script src="../../../3D_Model_viwer/js/spectrum.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" />


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

        .csv_file_selectbox {
            width: 30%;
            margin-top: 20px;
        }

        .tree-area {
            height: 300px;
        }

        select {
            appearance: auto;
            outline: 0;
            box-shadow: none;
            border: 1px solid rgba(0, 0, 0, .125) !important;
            background: #ffffff;
            background-image: none;
            color: #000000;
            width: 300px;
            height: 40px;
        }

        .ui-sortable-handle {
            cursor: move;
        }

        .right-content {
            border: 1px solid #ccc;
        }

        .alert-danger {
            margin-top: 20px;
        }

        .link1 a:hover {
            text-decoration: none;
            color: #fff;
        }

        .multiselect {
            width: 200px;
        }

        .selectBox {
            position: relative;
        }

        .selectBox select {
            width: 100%;

        }

        .overSelect {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
        }

        #roomlist {
            /* display: none; */
            border: 1px #dadada solid;
            text-align: left;
            line-height: 30px;
        }

        #checkboxes label {
            display: block;
        }

        #checkboxes label:hover {
            background-color: #1e90ff;
        }

        .error_message_area {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
            padding: 20px;
        }

        input:checked+.toggle:after {
            content: 'Unlock';
            left: 35%;
        }

        .toggle:after {
            content: 'Lock';
        }

        li.nav-item {
            list-style-type: none;
        }

        .removeprointerevent {
            pointer-events: none;
        }

        .roundicon {
            margin-top: 20px;
            width: 40px;
            height: 40px;
            padding: 10px;
        }

        .concept-model {
            border: 2px solid #b1b1b1;
            border-radius: 5px;
            padding: 0.5rem 0.8rem;
            margin-bottom: 2rem;
            margin-left: 15px;
        }

        .gen-concept-model {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .concept-model h5 {
            margin: 0;
            font-size: 1rem;
        }

        .model-outline {
            border: 2px solid #b1b1b1;
            border-radius: 10px;
            padding: 0.4rem 1.4rem;
            text-transform: capitalize;

        }

        .card label {
            margin-bottom: 0 !important;
        }

        .status-box {
            border: 2px solid #aeabab;
            border-radius: 5px;
            padding: 0.5rem 0.8rem;
        }

        .manual-d-flex {
            display: flex;
            /* justify-content: space-between; */
            align-items: center;
        }

        .toggle-btn {
            position: relative;
        }

        .toggle-btn input[type="checkbox"] {
            position: absolute;
            left: 0;
            top: 0;
            z-index: 10;
            width: 100%;
            height: 100%;
            cursor: pointer;
            opacity: 0;
        }

        .toggle-btn label {
            position: relative;
            display: flex;
            align-items: center;
        }

        .toggle-btn label:before {
            content: '';
            width: 45px;
            height: 26px;
            background: lightgrey;
            position: relative;
            display: inline-block;
            border-radius: 46px;
            transition: 0.2s ease-in;
        }

        .toggle-btn label:after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            left: 4px;
            top: 3px;
            z-index: 2;
            background: #fff;
            box-shadow: 0 0 5px #0002;
            transition: 0.2s ease-in;
        }

        .toggle-btn input[type="checkbox"]:hover+label:after {
            box-shadow: 0 2px 15px 0 #0002, 0 3px 8px 0 #0001;
        }

        .toggle-btn input[type="checkbox"]:checked+label:before {
            background: #000;
        }

        .toggle-btn input[type="checkbox"]:checked+label:after {
            background: #fff;
            left: 21px;
        }

        .loader {
            transform: rotate(0);
            animation: spinner 1.5s infinite;
        }

        .auto-top-background {
            background-color: #2ab934;
            color: #fff;
            border-color: #2ab934;
        }

        @keyframes spinner {
            to {
                transform: rotate(360deg)
            }
        }

        @media (orientation: Portrait) {
            .mobile-concept {
                flex-wrap: wrap;
            }

            .order-auto {
                order: 1;

            }

            .mobile-auto-top {
                margin-top: 1rem;
            }
        }
    </style>
    <?php
    function generateRandomString($length = 25)
    {
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
    $u_id = Auth::user()->id;
    
    ?>
@endsection
@section('content')

    <body class="app header-fixed sidebar-fixed aside-menu-fixed pace-done sidebar-lg-show">
        <div class="wrapper">
            <div class="">
                <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                    <div class="container-fluid">
                        <button href="" class="navbar-toggler navbar-toggler-right" type="button"
                            data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-bar burger-lines"></span>
                            <span class="navbar-toggler-bar burger-lines"></span>
                            <span class="navbar-toggler-bar burger-lines"></span>
                        </button>
                        <div class="navbar-collapse justify-content-end" id="navigation">
                            <ul class="nav navbar-nav">
                                @if ($u_id == 1)
                                    <li class="dropdown nav-item">
                                        @if (count($categories) > 0)
                                            <!-- <a download="<?php //print_r($csvFile[0]->file_path)
                                            ?>"   href="/storage/csv/<?php
                                            //print_r($csvFile[0]->file_path)
                                            ?>" class="nav-link">
                                                                           <button class="btn btn-primary " style="margin-bottom: 40px;">Csv File Download</button>
                                                                           </a> -->
                                            <form action="{{ url('admin/exportCsv2') }}" action="post">
                                                @csrf
                                                <?php $segment_users = request()->segment(3);
                                                ?>
                                                <input type="hidden" name="project_id" value="{{ $segment_users }}">
                                                <input type="hidden" id="project_revision_id2" name="project_revision_id"
                                                    value="{{ request()->segment(4) }}">
                                                <input type="hidden" id="revesion_id" name="revesion_id"
                                                    value="{{ '/' . $segment_users . '_' . $csv_counter . '_' . $u_name . '.csv' }}">
                                                <span class="nav-link p-0">

                                                    @if (file_exists(public_path() .
                                                                '/' .
                                                                $sitesettings->csvfilepath .
                                                                '/' .
                                                                $segment_users .
                                                                '_' .
                                                                $csv_counter .
                                                                '_' .
                                                                $u_name .
                                                                '.csv'))
                                                        <button class="btn btn-success downloadcsv " type="submit">Csv File
                                                            Download</button>
                                                    @else
                                                        <button class="btn btn-secondary" type="button">Csv File
                                                            Download</button>
                                                    @endif


                                                </span>
                                            </form>
                                        @endif
                                    </li>
                                    <li class="dropdown nav-item">
                                        @if (count($categories) > 0)
                                            <form action="{{ url('admin/exportJson2') }}" action="post">
                                                @csrf

                                                <input type="hidden" name="project_id" value="{{ $segment_users }}">
                                                <input type="hidden" id="project_revision_id2" name="project_revision_id"
                                                    value="{{ request()->segment(4) }}">
                                                <input type="hidden" id="revesion_id_json" name="revesion_id"
                                                    value="{{ '/' . $segment_users . '_' . $csv_counter . '_' . $u_name . '.json' }}">
                                                <span class="nav-link p-0">
                                                    @if (file_exists(public_path() .
                                                                '/' .
                                                                $sitesettings->jsonfilepath .
                                                                '/' .
                                                                $segment_users .
                                                                '_' .
                                                                $csv_counter .
                                                                '_' .
                                                                $u_name .
                                                                '.json'))
                                                        <button class="btn btn-success downloadjson " type="submit">Json
                                                            File
                                                            Download</button>
                                                    @else
                                                        <button class="btn btn-secondary " type="button">Json File
                                                            Download</button>
                                                    @endif
                                                </span>
                                            </form>
                                        @endif
                                    </li>
                                @endif



                                <a href="{{ route('admin.add.plot.window', ['pid' => request()->segment(3), 'rid' => request()->segment(4)]) }}"
                                    class="btn btn-secondary error_message"> Add Plot</a>
                                <a href="{{ route('admin.add.floor.window', ['pid' => request()->segment(3), 'rid' => request()->segment(4)]) }}"
                                    class="btn btn-secondary error_message"> Add Floor</a>
                                <a href="{{ route('admin.add.room.window', ['pid' => request()->segment(3), 'rid' => request()->segment(4)]) }}"
                                    class="btn btn-secondary error_message"> Add Room</a>

                                <li class="dropdown nav-item" style="list-style: none;">
                                    <?php
                                    $file_name = request()->segment(3) . '_' . $csv_counter . '_' . $u_name . '.pdf'; ?>
                                    @if (file_exists(public_path() . '/' . $sitesettings->pdffilepath . '/' . $file_name))
                                        <a href="{{ asset('' . $sitesettings->pdffilepath . '/' . $file_name) }}"
                                            target="_blank" download class="btn btn-success"><i
                                                class="fa fa-download"></i>
                                            PDF Download</a>
                                    @else
                                        <a href="#" class="btn btn-secondary error_message"><i
                                                class="fa fa-download"></i>
                                            PDF Download</a>
                                    @endif
                                    <!--  <span class="nav-link">
                                                                        <button class="btn btn-primary" type="button" style="margin-bottom: 40px;">Download PDF</button>
                                                                        </span> -->

                                </li>
                                <li class="dropdown nav-item" style="list-style: none;">
                                    <?php
                                    $file_name = request()->segment(3) . '_' . $csv_counter . '_' . $u_name . '.fbx';
                                    ?>
                                    @if (file_exists(public_path() . '/' . $sitesettings->fbxfilepath . '/' . $file_name))
                                        <a href="{{ asset('' . $sitesettings->fbxfilepath . '/' . $file_name) }}"
                                            target="_blank" download class="btn btn-success"><i
                                                class="fa fa-download"></i>
                                            FBX Download</a>
                                    @else
                                        <a href="#" class="btn btn-secondary error_message"><i
                                                class="fa fa-download"></i>
                                            FBX Download</a>
                                    @endif
                                </li>
                                <li class="dropdown nav-item" style="list-style: none;">
                                    <?php
                                    $file_name = request()->segment(3) . '_' . $csv_counter . '_' . $u_name . '.dwg'; ?>
                                    @if (file_exists(public_path() . '/' . $sitesettings->dwgfilepath . '/' . $file_name))
                                        <a href="{{ asset('' . $sitesettings->dwgfilepath . '/' . $file_name) }}"
                                            target="_blank" download class="btn btn-success"><i
                                                class="fa fa-download"></i>
                                            DWG Download</a>
                                    @else
                                        <a href="#" class="btn btn-secondary error_message"><i
                                                class="fa fa-download"></i>
                                            DWG Download</a>
                                    @endif
                                </li>
                                <?php /*
                                                                                                                                                                                                                                                                                                                                                                             <li class="dropdown nav-item" style="display: contents;">
                                                                                                                                                                                                                                                                                                                                                                                <?php
                                                                                                                                                                                                                                                                                                                                                                                   if(!empty($values)){
                                                                                                                                                                                                                                                                                                                                                                                      
                                                                                                                                                                                                                                                                                                                                                                                          ?>
                                ?>
                                ?>
                                ?>
                                ?>
                                ?>
                                ?>
                                ?>
                                ?>
                                ?>
                                ?>
                                ?>
                                ?>
                                <a href="/../../../{{ $sitesettings->fbxfilepath }}/<?php print_r($values[1]); ?>"
                                    download="<?php print_r($values[1]); ?>" class="btn btn-primary  mr-2"
                                    style="position: relative;list-style: inherit;">FBX File Download</a>
                                <?php 
                                    }
                                ?>
                                </li>
                                */ ?>

                                <li class="nav-item">
                                    {{-- <a href="/admin/3d-view-model" class="nav-link"> --}}

                                    @if (file_exists(public_path() .
                                                '/' .
                                                $sitesettings->fbxfilepath .
                                                '/' .
                                                $segment_users .
                                                '_' .
                                                $csv_counter .
                                                '_' .
                                                $u_name .
                                                '.fbx'))
                                        <button onclick="viewm_model(this)"
                                            data-id="model=/{{ $sitesettings->fbxfilepath }}/{{ $segment_users . '_' . $csv_counter . '_' . $u_name . '.fbx' }}"
                                            class="btn btn-success">3D view</button>
                                    @elseif(file_exists(public_path() .
                                                '/' .
                                                $sitesettings->dwgfilepath .
                                                '/' .
                                                $segment_users .
                                                '_' .
                                                $csv_counter .
                                                '_' .
                                                $u_name .
                                                '.dwg'))
                                        <button onclick="viewm_model(this)"
                                            data-id="model=/{{ $sitesettings->dwgfilepath }}/{{ $segment_users . '_' . $csv_counter . '_' . $u_name . '.dwg' }}"
                                            class="btn btn-success">3D view</button>
                                    @else
                                        <button
                                            data-id="model=/{{ $sitesettings->dwgfilepath }}/{{ $segment_users . '_' . $csv_counter . '_' . $u_name . '.fbx' }}"
                                            class="btn btn-secondary">3D view</button>
                                    @endif
                                    {{-- </a> --}}
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
                <div class="error_message_area" style="display: none;" role="alert">
                    File not exists!
                </div>


                <div id="room_model_new" class="w3-modal">

                    <div class="w3-modal-content" id="w3-modal-content" style="height: 500px">
                        <div class="w3-container" id="w3-container" style="height: 100%">

                            <div class="card" style="height: 100%">
                                <h1>3D Viewer</h1>
                                <span onclick="document.getElementById('room_model_new').style.display='none'"
                                    id="close" class="w3-button w3-display-topright">&times;</span>
                                <div id="iframemodel"
                                    style="width: 100%; height:100%; margin: auto;">

                                </div>

                            </div>
                        </div>
                    </div>

                </div>


                <script>
                    $('#w3-modal-content').resizable({
                        //alsoResize: ".modal-dialog",
                        minHeight: 300,
                        minWidth: 300,
                        start: function(e, ui) {
                            $('#iframemodel').addClass('removeprointerevent');
                        },
                        stop: function(e, ui) {
                            $('#iframemodel').removeClass('removeprointerevent');
                        },

                    });
                    $('#w3-modal-content').draggable();

                    // $('#room_model_new').on('show.bs.modal', function() {
                    // $(this).find('.modal-body').css({
                    //     'max-height': '100%'
                    // });
                    // });


                    $('#close').click(function() {
                        $('#iframemodel').html('');
                        $('#room_model_new').modal('hide');
                        $('#room_model_new').hide();
                    })

                    function viewm_model(s) {
                        // $('#iframemodel').attr('src' , ''+$(s).data('id'));

                        $('#iframemodel').html(
                            '<iframe    style="height: 100%;  width:100%" src="{{ route('admin.3dnewviewer') }}?sidebar={{ $sitesettings->sidebar }}&navigationlist={{ $sitesettings->navigationlist }}&dpanel={{ $sitesettings->dpanel }}&sidebartwo={{ $sitesettings->sidebartwo }}#' +
                            $(s).data('id') + '"></iframe>');
                        $('#room_model_new').modal('show');
                    }
                </script>

                <div style="padding-top: 20px" class="container-fluid  pd-top-card">
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="lockicon">



                                                <i class="fa fa-lock  "
                                                    style="font-size: 28px; {{ $project->is_locked == 'Yes' ? 'display:none;' : '' }}"></i>


                                                <i class="fa fa-unlock  "
                                                    style="font-size: 28px; {{ $project->is_locked == 'Yes' ? 'display:none;' : '' }}"></i>
                             
                                            </div>

                                            {{-- <a href="/" class="btn btn-primary mr-2"><i class="fa fa-home"
                                            style="font-size:19px;"></i></a> --}}
                                                    <!--<a href="#" class="btn btn-primary  mr-2"><i class="nc-icon nc-cloud-download-93 mr-2"></i>Save as</a>-->
                                                    <!--<a href="#" class="btn btn-primary  mr-2"><i class="nc-icon nc-circle mr-2"></i>Rename</a>-->
                                                    {{-- <a href="#" class="btn btn-primary  mr-2" id="scale_up"><i
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
                                        <img src="../../../3D_Model_viwer/images/fullscreen.png" width="32"
                                            height="32" alt="fullscreen">
                                        </button>
                                        </a> --}}
                                        </div>
                                        <!-- flash messag -->

                                        {{-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div> --}}


                                        @if ($generate_button == 'true')
                                            <div class="alert alert-danger alert-dismissible fade show w-75 mx-auto my-2"
                                                role="alert">
                                                <strong>Alert!</strong> Your number of tries completed! .
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        @if ($plot_button == 'true')
                                            <div class="alert alert-danger alert-dismissible fade show w-75 mx-auto my-2 "
                                                role="alert">
                                                <strong>Alert!</strong> The maximum number of Plot have been added .
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        @if ($building_button == 'true')
                                            <div class="alert alert-danger alert-dismissible fade show w-75 mx-auto my-2"
                                                role="alert">
                                                <strong>Alert!</strong> The maximum number of Building have been added.
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        @if ($floor_button == 'true')
                                            <div class="alert alert-danger alert-dismissible fade show w-75 mx-auto my-2"
                                                role="alert">
                                                <strong>Alert!</strong> The maximum number of Floor have been added.
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        @if ($room_button == 'true')
                                            <div class="alert alert-danger alert-dismissible fade show w-75 mx-auto my-2"
                                                role="alert">
                                                <strong>Alert!</strong> The maximum number of Room have been added.
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif


                                        <?php 
                                 if(count($csc_selectbox)> 0)
                                 { 
                                     $select_id = request()->segment(4);
                                     ?>
                                        <div class="csv_file_selectbox d-none" style="width: 100%;margin-left: 1%">
                                            <label>CVS file</label><br>

                                            <select name="csv_file_list" id="csv_file_list">
                                                <?php
                                                $i = 1;
                                                foreach ($csc_selectbox as $key => $value) {
                                                    if ($select_id == $value->project_revision) {
                                                        $checked = 'selected';
                                                    } else {
                                                        $checked = false;
                                                    }
                                                    echo '<option value="' . $value->file_path . '" ' . $checked . ' data-revision="' . $value->project_revision . '"  data-id="' . $value->id . '" data-path="' . url('/') . '/public/' . $sitesettings->csvfilepath . $value->file_path . '" >' . $value->file_name . '</option>';
                                                    $i++;
                                                }
                                                ?>
                                            </select>
                                            <a href="javascript:void(0)" class="btn btn-primary file_rename">Rename</a>

                                            <div class="" style="margin-top: 2%;">
                                                <p id="p1" style="display: none"></p>
                                                <p id="p2" style="display: none"></p>
                                                <p id="p3" style="display: none"></p>
                                                <p id="p4" style="display: none"></p>
                                                <p id="p5" style="display: none"></p>
                                                @if ($u_id == 1)
                                                    <?php
                                    $file_name =  request()->segment(3).'_'.$csv_counter.'_'.$u_name.'.csv';
                                    if (file_exists( public_path() . '/'.$sitesettings->csvfilepath.'/'.$file_name)) { ?>
                                                    <button onclick="copyToClipboard('#p1')"
                                                        class="btn btn-primary copy_json">Copy CSV file path</button>
                                                    <?php } else
                                    {
                                       ?>
                                                    <button class="btn btn-primary copy_json error_message">Copy CSV file
                                                        path</button>
                                                    <?php
                                    }
                                    $file_name =  request()->segment(3).'_'.$csv_counter.'_'.$u_name.'.json';
                                    if (file_exists( public_path() . '/'.$sitesettings->jsonfilepath.'/'.$file_name)) { ?>
                                                    <button onclick="copyToClipboard2('#p2')"
                                                        class="btn btn-primary copy_json">Copy Json file path</button>
                                                    <?php } else
                                    {
                                       ?>
                                                    <button class="btn btn-primary copy_json error_message">Copy Json file
                                                        path</button>
                                                    <?php
                                    } ?>
                                                @endif
                                                @if ($u_id != 1 || $u_id == 1)
                                                    <?php 
                                    $file_name =  request()->segment(3).'_'.$csv_counter.'_'.$u_name.'.pdf';
                                    if (file_exists( public_path() . '/'.$sitesettings->pdffilepath.'/'.$file_name)) { ?>

                                                    <button onclick="copyToClipboard3('#p3')"
                                                        class="btn btn-primary ">Copy PDF file path</button>
                                                    <?php } else
                                    {
                                       ?>
                                                    <button class="btn btn-primary copy_json error_message">Copy PDF file
                                                        path</button>
                                                    <?php
                                    } 
                                    $file_name =  request()->segment(3).'_'.$csv_counter.'_'.$u_name.'.fbx';
                                    if (file_exists( public_path() . '/'.$sitesettings->fbxfilepath.'/'.$file_name)) { ?>

                                                    <button onclick="copyToClipboard4('#p4')"
                                                        class="btn btn-primary ">Copy FBX file path</button>
                                                    <?php } else
                                    {
                                       ?>
                                                    <button class="btn btn-primary copy_json error_message">Copy FBX file
                                                        path</button>
                                                    <?php
                                    }  
                                    $file_name =  request()->segment(3).'_'.$csv_counter.'_'.$u_name.'.dwg';
                                    if (file_exists( public_path() . '/'.$sitesettings->dwgfilepath.'/'.$file_name)) { ?>

                                                    <button onclick="copyToClipboard5('#p5')"
                                                        class="btn btn-primary ">Copy DWG file path</button>
                                                    <?php }  else
                                    {
                                       ?>
                                                    <button class="btn btn-primary copy_json error_message">Copy DWG file
                                                        path</button>
                                                    <?php
                                    } ?>
                                                @endif
                                            </div>

                                        </div>
                                        <?php } 
                                 else
                                 {
                                     ?>
                                        <div class="csv_file_selectbox d-none" style="width: 30%;margin-left: 1%">
                                            <label>CVS file</label><br>
                                            <select name="csv_file_list" id="csv_file_list">
                                                <?php
                                                echo '<option value="0" >Revsion_0</option>';
                                                
                                                ?>
                                            </select>
                                        </div>
                                        <?php
                                 }
                                 ?>
                                        <div class="card-body all-icons">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card ">
                                                        <div class="card-header ">
                                                            <div class="tree-area">
                                                                <div class="panel-body">
                                                                    @if (session()->has('message'))
                                                                        <div id="updategenconMod"
                                                                            class="alert w-100 m-auto alert-success alert-dismissible fade show"
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
                                                                            <p id="error_msg"
                                                                                style="display: none;color:red">Please
                                                                                select same level tree</p>
                                                                            <p id="error_msg1"
                                                                                style="display: none;color:red">L0 Floor
                                                                                not be deleted</p>
                                                                            <p id="duplicate_error"
                                                                                style="display: none;color:red"></p>
                                                                            <ul id="tree1">
                                                                                <li class="branch">
                                                                                    <input type="checkbox"
                                                                                        id="tree_id_project_name"
                                                                                        value="yes" class="parent_id_s"
                                                                                        name="project_name_s">
                                                                                    {{ $project_name }}
                                                                                    <ul>
                                                                                        @foreach ($categories as $category)
                                                                                            <li>
                                                                                                <input type="checkbox"
                                                                                                    id="tree_id_{{ $category->id }}"
                                                                                                    class="parent_id"
                                                                                                    name="fav_language[]"
                                                                                                    value="{{ $category->id }}">
                                                                                                {{ $category->title }}
                                                                                                @if (count($category->childs))
                                                                                                    @include(
                                                                                                        'category.manageChild',
                                                                                                        [
                                                                                                            'childs' =>
                                                                                                                $category->childs,
                                                                                                        ]
                                                                                                    )
                                                                                                @endif
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </li>
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
                                                            <!-- <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                
                                                                                                    <button class="btn-sm w3-btn w3-red w3-large btn-block"
                                                                                                        id="reset_radio">
                                                                                                        Reset Radio Button
                                                                                                    </button>
                                                                                                
                                                                                                
                                                                                                    <br>
                                                                                                </div>
                                                                                                </div> -->
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <button type="button" <?php if ($plot_button == 'false') {
                                                                        echo 'id="add_plot"';
                                                                    } ?>
                                                                        class="btn-sm w3-btn w3-green w3-large btn-block"
                                                                        data-toggle="modal" data-target="#exampleModal"
                                                                        <?php if ($plot_button == 'true') {
                                                                            echo 'disabled="disabled"';
                                                                        } ?>>
                                                                        Add Plot
                                                                    </button>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button <?php if ($building_button == 'false') {
                                                                        echo 'id="addbuilding"';
                                                                    } ?>
                                                                        class="btn-sm w3-btn w3-green w3-large btn-block"
                                                                        <?php if ($building_button == 'true') {
                                                                            echo 'disabled="disabled"';
                                                                        } ?>>Add
                                                                        Builiding</button>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <button
                                                                        class="btn-sm w3-btn w3-indigo w3-large btn-block"
                                                                        <?php if ($floor_button == 'false') {
                                                                            echo 'id="addfloor"';
                                                                        } ?> <?php if ($floor_button == 'true') {
                                                                            echo 'disabled="disabled"';
                                                                        } ?>>
                                                                        Add Floor
                                                                    </button>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button
                                                                        class="btn-sm w3-btn w3-indigo w3-large btn-block"
                                                                        <?php if ($room_button == 'false') {
                                                                            echo 'id="addextroom"';
                                                                        } ?> <?php if ($room_button == 'true') {
                                                                            echo 'disabled="disabled"';
                                                                        } ?>> Add Ext
                                                                        Room</button>
                                                                </div>

                                                                <div class="col-md-6 mt-3">
                                                                    <button
                                                                        class="btn-sm w3-btn w3-indigo w3-large btn-block"
                                                                        <?php if ($room_button == 'false') {
                                                                            echo 'id="addroom"';
                                                                        } ?> <?php if ($room_button == 'true') {
                                                                            echo 'disabled="disabled"';
                                                                        } ?>>Add
                                                                        Room</button>
                                                                </div>

                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                @if ($sitesettings->propbutton == 'show')
                                                                    <div class="col-md-6 mb-2">
                                                                        <button
                                                                            class="btn-sm w3-btn w3-deep-purple w3-large btn-block"
                                                                            id="properties_plot">
                                                                            Properties
                                                                        </button>
                                                                    </div>
                                                                @endif
                                                                @if ($sitesettings->dupbutton == 'show')
                                                                    <div class="col-md-6 mb-2">
                                                                        <button
                                                                            class="btn-sm w3-btn w3-deep-purple w3-large btn-block duplicate">Duplicate</button>
                                                                    </div>
                                                                @endif

                                                                @if (Auth::user()->id != 1)
                                                                    <div class="col-md-6">
                                                                        <button
                                                                            class="btn-sm w3-btn w3-red w3-large btn-block"
                                                                            id="delete_project">
                                                                            Delete
                                                                        </button>
                                                                        <br>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <button
                                                                            class="btn-sm w3-btn w3-blue w3-large btn-block"
                                                                            id="edit_plot">
                                                                            Edit
                                                                        </button>
                                                                    </div>
                                                                @endif
                                                                @if (Auth::user()->id == 1)
                                                                    <div class="col-md-6">
                                                                        <button
                                                                            class="btn-sm w3-btn w3-blue w3-large btn-block"
                                                                            id="edit_plot">
                                                                            Edit
                                                                        </button>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <button
                                                                            class="btn-sm w3-btn w3-red w3-large btn-block"
                                                                            id="delete_project">
                                                                            Delete
                                                                        </button>
                                                                        <br>
                                                                    </div>
                                                                @endif

                                                                @if (file_exists(public_path() .
                                                                            '/' .
                                                                            $sitesettings->fbxfilepath .
                                                                            '/' .
                                                                            $segment_users .
                                                                            '_' .
                                                                            $csv_counter .
                                                                            '_' .
                                                                            $u_name .
                                                                            '.fbx') ||
                                                                        file_exists(public_path() .
                                                                                '/' .
                                                                                $sitesettings->pdffilepath .
                                                                                '/' .
                                                                                $segment_users .
                                                                                '_' .
                                                                                $csv_counter .
                                                                                '_' .
                                                                                $u_name .
                                                                                '.pdf') ||
                                                                        file_exists(public_path() .
                                                                                '/' .
                                                                                $sitesettings->dwgfilepath .
                                                                                '/' .
                                                                                $segment_users .
                                                                                '_' .
                                                                                $csv_counter .
                                                                                '_' .
                                                                                $u_name .
                                                                                '.dwg'))
                                                                @else
                                                                    @if ($project->is_locked == 'Yes')
                                                                        <div
                                                                            class="  col-md-12 mt-2 underprocess text-center   ">
                                                                            <span>Under Process ....</span>
                                                                        </div>
                                                                    @endif
                                                                @endif


                                                                <div
                                                                    class="col-md-12 bgt-lg d-flex justify-content-center">
                                                                    <br>
                                                                    <button
                                                                        class="btn-sm w3-btn w3-black w3-large btn-block generate_CSV  d-none"
                                                                        <?php if ($generate_button == 'true') {
                                                                            echo 'disabled="disabled"';
                                                                        } ?>>Generate</button>
                                                                    <?php if ($generate_button == 'true') {
                                                                        echo '<p style="color:red;text-align:center">Number of try count complete</p>';
                                                                    }
                                                                    ?>
                                                                    <i
                                                                        class="fa fa-cog border border-danger bg-danger  text-white rounded-circle roundicon"></i>
                                                                    <label class="switch mt-3 mx-3">

                                                                        <input class="togglecheckbox" type="checkbox"
                                                                            data-toggle="switch"
                                                                            @if ($project->is_locked == 'No') checked="" @endif
                                                                            data-on-color="primary"
                                                                            data-off-color="primary"><span
                                                                            class="toggle"></span>
                                                                    </label>
                                                                    <i
                                                                        class="fa fa-pencil border border-success bg-success text-white rounded-circle roundicon"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 rightside">
                                                    <div class="w3-container right-content" id="plot_model"
                                                        style="display: none;">
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
                                                        <div class="w3-section">
                                                            <div class="w3-row">
                                                            </div>
                                                            <div id="auto_generated_id" style="display:none;">
                                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                                    <label><b>Obejct ID</b></label>
                                                                </div>
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="number"
                                                                            name="plot_auto_id" disabled required=""
                                                                            id='plot_auto_id'>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="auto_generated_proper">
                                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                                    <label><b>Obejct ID</b></label>
                                                                </div>
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <div class="form-group">
                                                                        <i> <label>Auto Generated ID</label></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <form role="form" id="category" method="POST"
                                                                action="{{ route('admin.add.plot') }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                                    <label><b>Plot Name</b></label>
                                                                </div>
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <div
                                                                        class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                                        <input class="form-control" type="text"
                                                                            name="title" placeholder="Enter Plot"
                                                                            required="" id='title' value="">
                                                                    </div>
                                                                </div>
                                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                                    <label><b>Plot Type</b></label>
                                                                </div>
                                                                <!-- <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;" id="plotdropdown" >
                                                                                                      <select id="parent_id" name="parent_id" class="form-control w3-margin-bottom  " required>
                                                                                                          <option  value=""  >Select Plot Type</option>
                                                                                                           @foreach ($plottype as $rows)
    @foreach ($plottypeSelect as $data)
    <option value="{{ $rows->plot_type }}" {{ $rows->plot_type }}  >{{ $rows->plot_type }}</option>
    @endforeach
    @endforeach
                                                                                                      </select>
                                                                                                      </div> -->
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;"
                                                                    id="plotdropdownajax">
                                                                    <select id="parent_id" name="parent_id"
                                                                        class="form-control w3-margin-bottom plottypeselect">
                                                                        <!--<option  value="">Select Plot Type</option>-->
                                                                    </select>
                                                                </div>
                                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                                    <label><b>Height limit</b></label>
                                                                </div>
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <input class="form-control w3-margin-bottom"
                                                                        name="height" type="number"
                                                                        placeholder="Enter Height" id="height"
                                                                        value="" step="any">
                                                                </div>
                                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                                    <label><b>Width limit</b></label>
                                                                </div>
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <input class="form-control w3-margin-bottom"
                                                                        name="width" type="number"
                                                                        placeholder="Enter Width" id="width"
                                                                        value="" step="any">
                                                                </div>
                                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                                    <label><b>Length limit</b></label>
                                                                </div>
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <input class="form-control w3-margin-bottom"
                                                                        name="length" type="number"
                                                                        placeholder="Enter Length" id="length"
                                                                        value="" step="any">
                                                                </div>
                                                                <?php
                                                                $currenturl = url()->full();
                                                                $projectId = explode('/project-trees/', $currenturl);
                                                                
                                                                ?><br> <input type="hidden"
                                                                    id="pro_id" name="project_id"
                                                                    value="<?php echo request()->segment(3); ?>">
                                                                <input type="hidden" id="project_revision_id"
                                                                    name="project_revision_id"
                                                                    value="<?php echo request()->segment(4); ?>">
                                                                <?php
                                                                ?>
                                                                <input type="hidden" id="plot_id" value="">
                                                                <div class="w3-col s6 w3-center w3-green"
                                                                    style="width: 40%;position: relative;left: 38px;">
                                                                    <a href="javascript:void(0)"
                                                                        class="w3-btn w3-btn-block w3-red">
                                                                        Cancel</a>
                                                                </div>
                                                                <div class="w3-col s6 w3-center w3-green"
                                                                    style="width: 40%;position: relative;left: 46px;"
                                                                    id="submit_form">
                                                                    <button type="submit" class="w3-btn w3-green"
                                                                        id="submit_plot"> Create Plot</button>
                                                                    <a href="#close-modal" rel="modal:close"><button
                                                                            type="button" class="w3-btn w3-green"
                                                                            id="update_plot" style='display:none'>
                                                                            Update Plot</button></a>
                                                                    <!-- <a href="#close-modal" rel="modal:close"> <button type="submit"  class="w3-btn w3-btn-block w3-red" id="update_plot" style='display:none'>
                                                                                                         Update Plot</button></a> -->
                                                                </div>
                                                                <input type="hidden" id="plot_parent_id" value="">
                                                                <input type="hidden" id="plot_parent_category"
                                                                    value="">
                                                                <!-- newwwwwwwwwwwwwwwwwwwwwwwwwwwww -->
                                                                <input type="hidden" id="user_id" value="">
                                                                <input type="hidden" id="project_id" value="">
                                                                <input type="hidden" id="building_primiry_id"
                                                                    value="">
                                                                <div class="w3-container w3-padding-hor-16 ">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div id="show_building"
                                                        style="display: none;border: 1px solid #ccc;padding: 16px;">
                                                        <div class="">
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
                                                                    <div id="auto_generated_id_building"
                                                                        style="display:none;">
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width:40%">
                                                                            <label><b>Obejct ID</b></label>
                                                                        </div>
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width: 40%;position: relative;left: 46px;">
                                                                            <div
                                                                                class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
                                                                                <input class="form-control" type="number"
                                                                                    name="buliding_id" required=""
                                                                                    disabled id='buliding_id'
                                                                                    value="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="auto_generated_building">
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width:40%">
                                                                            <label><b>Obejct ID</b></label>
                                                                        </div>
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width: 40%;position: relative;left: 46px;">
                                                                            <div class="form-group">
                                                                                <i> <label>Auto Generated ID</label></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <form role="form" id="categorys" method="POST"
                                                                        action="{{ route('admin.add.building') }}"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width:40%">
                                                                            <label><b>Building Name</b></label>
                                                                        </div>
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width: 40%;position: relative;left: 46px;">
                                                                            <input class="form-control w3-margin-bottom"
                                                                                type="text" name="title"
                                                                                placeholder="Enter Building Name"
                                                                                required="" id='building_title'
                                                                                value="">
                                                                        </div>
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width:40%">
                                                                            <label><b>Building Type</b></label>
                                                                        </div>
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width: 40%;position: relative;left: 46px;">
                                                                            <select id="building_type"
                                                                                name="building_type"
                                                                                class="form-control w3-margin-bottom buildingtypeselect"
                                                                                value="">
                                                                                <!--<option value="">Select Building</option>  -->
                                                                            </select>
                                                                        </div>
                                                                        <div id="hide_plot">
                                                                            <div class="w3-col s6 w3-center"
                                                                                style="width:40%">
                                                                                <label><b>Plot</b></label>
                                                                            </div>
                                                                            <div class="w3-col s6 w3-center"
                                                                                style="width: 40%;position: relative;left: 46px;">
                                                                                <select id="parent_id" name="parent_id1"
                                                                                    class="form-control w3-margin-bottom">
                                                                                    <option value="">Select Plot
                                                                                    </option>
                                                                                    @foreach ($allPlot as $rows)
                                                                                        <option
                                                                                            value="{{ $rows->id }}">
                                                                                            {{ $rows->title }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div id="show_plot" style="display:none">
                                                                            <div class="w3-col s6 w3-center"
                                                                                style="width:40%">
                                                                                <label><b>Plot</b></label>
                                                                            </div>
                                                                            <div class="w3-col s6 w3-center"
                                                                                style="width: 40%;position: relative;left: 46px;">
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
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <input class="form-control w3-margin-bottom"
                                                                        type="number" name="floor_height"
                                                                        placeholder="Floor Height" id="floor_height"
                                                                        value="" step="any">
                                                                </div>
                                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                                    <label><b>Number Of Floor</b></label>
                                                                </div>
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <input class="form-control w3-margin-bottom"
                                                                        type="number" name="number_of_floor"
                                                                        placeholder="Number Of Floor" id="number_of_floor"
                                                                        value="" step="any">
                                                                </div>
                                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                                    <label><b>Target Area</b></label>
                                                                </div>
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <input class="form-control w3-margin-bottom"
                                                                        type="number" name="target_area"
                                                                        placeholder="Target Area" id="target_area"
                                                                        value="" step="any">
                                                                </div>
                                                                <input type="hidden" id="plot_idss" value="">
                                                                <div class="w3-col s6 w3-center w3-green"
                                                                    style="width: 40%;position: relative;left: 38px;">
                                                                    <a href="#close-modal" rel="modal:close"><button
                                                                            type="button"
                                                                            class="w3-btn w3-btn-block w3-red"
                                                                            id="cancel_btn">Cancel</button></a>
                                                                </div>
                                                                <?php
                                                                $currenturl = url()->full();
                                                                $projectId = explode('/project-trees/', $currenturl);
                                                                
                                                                ?><br> <input type="hidden"
                                                                    name="project_id" value="<?php echo request()->segment(3); ?>">
                                                                <?php
                                                                ?> <input type="hidden"
                                                                    id="project_revision_id" name="project_revision_id"
                                                                    value="<?php echo request()->segment(4); ?>">
                                                                <div class="w3-col s6 w3-center w3-green"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <button type="submit" class="w3-btn w3-green"
                                                                        id="submit_building"> Create Building</button>
                                                                    <a href="#close-modal" rel="modal:close"><button
                                                                            type="button" class="w3-btn w3-green"
                                                                            id="update_building" style='display:none'>
                                                                            Update Building</button></a>
                                                                    <input type="hidden" id="building_parent_id"
                                                                        value="">
                                                                    <input type="hidden" id="building_child_val"
                                                                        value="">
                                                                    <input type="hidden" id="plot_id_del"
                                                                        value="">
                                                                </div>
                                                            </div>
                                                            </form>
                                                            <div class="w3-container w3-padding-hor-16 ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="floor_model"
                                                        style="display: none;border: 1px solid #ccc;padding: 16px;">
                                                        <div>
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
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <div
                                                                        class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
                                                                        <input class="form-control" type="number"
                                                                            name="id" required="" id='floor_id'
                                                                            disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="auto_generated_floor">
                                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                                    <label><b>Obejct ID</b></label>
                                                                </div>
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <div class="form-group">
                                                                        <i> <label>Auto Generated ID</label></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <form method="POST" action="{{ route('admin.add.floor') }}"
                                                                enctype="multipart/form-data" id="floor_clear"
                                                                class="floor_clear">
                                                                @csrf

                                                                <div class="w3-row">
                                                                    <input type="hidden" name="building_parent_id_val"
                                                                        id="building_parent_id_val" value="">
                                                                    <!-- <div class="w3-col s6 w3-center" style="width:40%" >
                                                                                                                 <p>Obejct ID</p>
                                                                                                                 </div>
                                                                                                                 <div class="w3-col s6  w3-center">
                                                                                                                 <p>0001</p>
                                                                                                                 </div> -->
                                                                </div>
                                                                <div id="hide_building">
                                                                    <div class="w3-col s6 w3-center" style="width:40%">
                                                                        <label><b>Select Building</b></label>
                                                                    </div>
                                                                    <div class="w3-col s6 w3-center"
                                                                        style="width: 40%;position: relative;left: 46px;">
                                                                        <select id="parent_id" name="parent_id"
                                                                            class="w3-input w3-border w3-margin-bottom">
                                                                            <!--<option value="">Select Building</option>-->
                                                                            @foreach ($buildings as $rows)
                                                                                <option value="{{ $rows->id }}">
                                                                                    {{ $rows->title }}</option>
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
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 100%;margin-bottom: 20px;">
                                                                    <button style="margin: 0px 20px;" type="submit"
                                                                        class="w3-btn w3-green" id="add_floor"> Add
                                                                        Floor</button>
                                                                    @if ($sitesettings->basebutton == 'show')
                                                                        <button style="margin: 0px 20px;" type="submit"
                                                                            class="w3-btn w3-green" id="add_basement"> Add
                                                                            Basement</button>
                                                                    @endif
                                                                    <button style="margin: 8px 20px;" type="submit"
                                                                        class="w3-btn w3-green" id="add_roof"> Add
                                                                        Roof</button>
                                                                </div>
                                                                <input type="hidden" id="floor_type" name="floor_type"
                                                                    value="">
                                                                <div class="w3-col s6 w3-center w3-green"
                                                                    style="width: 40%;position: relative;left: 38px;">
                                                                    <a href="#close-modal" rel="modal:close"> <button
                                                                            type="button"
                                                                            class="w3-btn w3-btn-block w3-red"
                                                                            id="cancel_btn">
                                                                            Cancel</button></a>
                                                                </div>
                                                                <div class="w3-col s6 w3-center w3-green"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <!-- <button type="submit" class="w3-btn w3-green" id="submit_floor"> Create
                                                                                                                 Floor</button> -->
                                                                    <a href="#close-modal" rel="modal:close"><button
                                                                            type="button" class="w3-btn w3-green"
                                                                            id="update_floor" style='display:none'>
                                                                            Update Floor </button></a>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <?php
                                                                $currenturl = url()->full();
                                                                $projectId = explode('/project-trees/', $currenturl);
                                                                
                                                                ?>
                                                                <br> <input type="hidden" name="project_id"
                                                                    value="<?php echo request()->segment(3); ?>"> <?php ?>
                                                                <input type="hidden" id="project_revision_id"
                                                                    name="project_revision_id"
                                                                    value="<?php echo request()->segment(4); ?>">
                                                                <input type="hidden" id="floor_parent_id"
                                                                    value="">
                                                                <input type="hidden" id="floor_child_val"
                                                                    value="">
                                                                <div class="w3-container w3-padding-hor-16 ">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div id="room_model"
                                                        style="display: none;border: 1px solid #ccc;padding: 16px;">
                                                        <div>
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
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <div
                                                                        class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
                                                                        <input class="form-control" type="number"
                                                                            name="id" required="" id='room_id'
                                                                            disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="auto_generated_room">
                                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                                    <label><b>Obejct ID</b></label>
                                                                </div>
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <div class="form-group">
                                                                        <i> <label>Auto Generated ID</label></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <form role="form" id="room_clear" class="room_clear"
                                                                method="POST" action="{{ route('admin.add.room') }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="project_id"
                                                                    id="project_id_room_wpr"
                                                                    value="<?php echo request()->segment(3); ?>" />
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
                                                                            <div class="w3-col s6 w3-center"
                                                                                style="width:40%">
                                                                                <label><b>Room Name</b></label>
                                                                            </div>
                                                                            <div class="w3-col s6 w3-center"
                                                                                style="width: 40%;position: relative;left: 46px;">
                                                                                <input type="text" id="room_title"
                                                                                    name="title" value="Room"
                                                                                    class="w3-input w3-border w3-margin-bottom"
                                                                                    placeholder="Enter Room Name"
                                                                                    required="">
                                                                                @if ($errors->has('title'))
                                                                                    <span class="text-red" role="alert">
                                                                                        <strong>{{ $errors->first('title') }}</strong>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="w3-col s6 w3-center"
                                                                                style="width: 15%;position: relative;left: 46px;">
                                                                                <input type="number"
                                                                                    name="number_of_room" value="1"
                                                                                    name="" id="number_of_room"
                                                                                    style="width:70%">
                                                                            </div>
                                                                        </div>
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width:40%">
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
                                                                        <div class="w3-col s6 w3-center radio_plot_floor d-none"
                                                                            style="width:40%">
                                                                            <label><b>Floor </b></label>
                                                                        </div>
                                                                        <div class="w3-col s6 mb-3 radio_plot_floor  d-none"
                                                                            style="width: 40%;position: relative;left: 46px;">
                                                                            <label for="floor_label"
                                                                                class="floor_label">Floor</label> <input
                                                                                type="radio" id="floor_label"
                                                                                name="floorPlot" class="mr-2"
                                                                                value="floor" checked style="">
                                                                            <label for="plot_label">Plot</label> <input
                                                                                type="radio" id="plot_label"
                                                                                name="floorPlot" class=""
                                                                                value="building" style="">
                                                                        </div>

                                                                        <div id="hide_floor ">
                                                                            <div class="w3-col s6 w3-center"
                                                                                style="width:40%">
                                                                                <label><b
                                                                                        class="floorPlot_heading--">Floor</b></label>
                                                                            </div>
                                                                            <div class="w3-col s6 w3-center"
                                                                                style="width: 40%;position: relative;left: 46px;">
                                                                                <div id="floor_wpr1">
                                                                                    <div class="hidde_check">
                                                                                        <input type='hidden'
                                                                                            name='flotFlor_check'
                                                                                            class='flotFlor_check'
                                                                                            value='f' />
                                                                                    </div>
                                                                                    <select id="parent_id"
                                                                                        name="parent_id1"
                                                                                        class="w3-input w3-border w3-margin-bottom floor_add_select_id f1">
                                                                                        <!--<option value="">Select Floor</option>-->
                                                                                        @foreach ($floors as $rows)
                                                                                            <option
                                                                                                value="{{ $rows->id }}">
                                                                                                {{ $rows->title }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @if ($errors->has('parent_id'))
                                                                                        <span class="text-red"
                                                                                            role="alert">
                                                                                            <strong>{{ $errors->first('parent_id') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                                <div id="Plot_wpr" style="display:none">
                                                                                    <div class="hidde_check"></div>
                                                                                    <select id="newid"
                                                                                        name="plot_parent"
                                                                                        class="w3-input w3-border w3-margin-bottom plot_add_select_id p1"
                                                                                        required>
                                                                                        <!--<option value="">Select Plot</option>-->
                                                                                        @foreach ($allPlot as $rows)
                                                                                            <option
                                                                                                value="{{ $rows->id }}">
                                                                                                {{ $rows->title }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        {{-- <div id="show_floordd"   >
                                                           <div class="w3-col s6 w3-center" style="width:40%">
                                                              <label><b class="floorPlot_heading">Floor</b></label>
                                                           </div>
                                                           <div class="w3-col s6 w3-center" style="width: 40%;position: relative;left: 46px;">
                                                              <div id="floor_wpr1">
                                                                 <div class="hidde_check">
                                                                    <input type='hidden' name='flotFlor_check' class='flotFlor_check' value='f' />
                                                                 </div>
                                                                 <select id="parent_id"  name="parent_id" data-plotFloorId="" class="w3-input w3-border w3-margin-bottom floorselect floor_edit_select_id f1">
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
                                                                 <select id="newid" name="plot_parent" class="w3-input w3-border w3-margin-bottom plot_edit_select_id p1" required>
                                                                    <!--<option value="">Select Plot</option>-->
                                                                    @foreach ($allPlot as $rows)
                                                                    <option value="{{ $rows->id }}" >{{ $rows->title }}</option>
                                                                    @endforeach
                                                                 </select>
                                                              </div>
                                                           </div>
                                                        </div> --}}
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width:40%">
                                                                            <label><b class="">Proximity
                                                                                    room</b></label>
                                                                        </div>
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width: 40%;position: relative;left: 46px;">
                                                                            <!-- <select name="floor_room[]" id="roomlist" multiple>
                                                                                                           </select> -->
                                                                            <div class="multiselect">
                                                                                <div class="selectBox"
                                                                                    onclick="showCheckboxes()">
                                                                                    <select multiple id="roomlist"
                                                                                        name="floor_room[]">
                                                                                        <option>Select an Room</option>
                                                                                    </select>
                                                                                    {{-- <div class="overSelect"></div> --}}
                                                                                </div>
                                                                                {{-- <div id="roomlist">
                                                                 
                                                                   
                                                               </div> --}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                        <?php
                                                                        $currenturl = url()->full();
                                                                        $projectId = explode('/project-trees/', $currenturl);
                                                                        
                                                                        ?><br>
                                                                        <input type="hidden" id="project_revision_id"
                                                                            name="project_revision_id"
                                                                            value="<?php echo request()->segment(4); ?>">
                                                                        <input type="hidden" name="project_id"
                                                                            value="<?php echo request()->segment(3); ?>">
                                                                        <?php
                                                                        ?>
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width:40%">
                                                                            <label><b>Area</b></label>
                                                                        </div>
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width: 40%;position: relative;left: 46px;">
                                                                            <input
                                                                                class="w3-input w3-border w3-margin-bottom"
                                                                                type="text" placeholder="Enter Area"
                                                                                name="room_area" id="room_area"
                                                                                value="">
                                                                        </div>
                                                                        <input type="hidden" id="floor_id"
                                                                            value="">
                                                                        <div class="w3-col s6 w3-center w3-green"
                                                                            style="width: 40%;position: relative;left: 38px;">
                                                                            <a href="#close-modal" rel="modal:close">
                                                                                <button type="button"
                                                                                    class="w3-btn w3-btn-block w3-red"
                                                                                    id="cancel_btn">Cancel</button>
                                                                            </a>
                                                                        </div>
                                                                        <input type="hidden" id="room_parent_id"
                                                                            value="">
                                                                    </div>
                                                                    <div class="w3-col s6 w3-center w3-green"
                                                                        style="width: 40%;position: relative;left: 46px;">
                                                                        <button type="submit" class="w3-btn w3-green"
                                                                            id="submit_room"> Create Room</button>
                                                                        <!--<a href="#close-modal" rel="modal:close">-->
                                                                        <button type="button" class="w3-btn w3-green"
                                                                            id="update_room" style='display:none'> Update
                                                                            Room </button>
                                                                        <!--</a>-->
                                                                    </div>
                                                                    <div class="w3-container w3-padding-hor-16 ">
                                                                        <input type="hidden" id="room_child_val"
                                                                            value="">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div id="extroom_model"
                                                        style="display: none;border: 1px solid #ccc;padding: 16px;">
                                                        <div>
                                                            <div class="w3-center">
                                                                <br>
                                                                <div id="auto_edit_extroom" style="display:none;">
                                                                    <h1> Edit extroom</h1>
                                                                </div>
                                                                <div id="auto_add_extroom">
                                                                    <h1> Add extroom</h1>
                                                                </div>
                                                                <div id="auto_details_extroom" style="display:none;">
                                                                    <h1> extroom Details</h1>
                                                                </div>
                                                            </div>
                                                            <div id="auto_generated_id_extroom" style="display:none;">
                                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                                    <label><b>Obejct ID</b></label>
                                                                </div>
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <div
                                                                        class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
                                                                        <input class="form-control" type="number"
                                                                            name="id" required="" id='extroom_id'
                                                                            disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="auto_generated_extroom">
                                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                                    <label><b>Obejct ID</b></label>
                                                                </div>
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <div class="form-group">
                                                                        <i> <label>Auto Generated ID</label></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <form role="form" id="extroom_clear" class="extroom_clear"
                                                                method="POST" action="{{ route('admin.add.extroom') }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="project_id"
                                                                    id="project_id_extroom_wpr"
                                                                    value="<?php echo request()->segment(3); ?>" />
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
                                                                            <div class="w3-col s6 w3-center"
                                                                                style="width:40%">
                                                                                <label><b>extroom Name</b></label>
                                                                            </div>
                                                                            <div class="w3-col s6 w3-center"
                                                                                style="width: 40%;position: relative;left: 46px;">
                                                                                <input type="text" id="extroom_title"
                                                                                    name="title" value="extroom"
                                                                                    class="w3-input w3-border w3-margin-bottom"
                                                                                    placeholder="Enter extroom Name"
                                                                                    required="">
                                                                                @if ($errors->has('title'))
                                                                                    <span class="text-red"
                                                                                        role="alert">
                                                                                        <strong>{{ $errors->first('title') }}</strong>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="w3-col s6 w3-center"
                                                                                style="width: 15%;position: relative;left: 46px;">
                                                                                <input type="number"
                                                                                    name="number_of_extroom"
                                                                                    value="1" name=""
                                                                                    id="number_of_extroom"
                                                                                    style="width:70%">
                                                                            </div>
                                                                        </div>
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width:40%">
                                                                            <label><b>extroom Type</b></label>
                                                                        </div>
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width: 40%;position: relative;left: 46px;">
                                                                            <select id="extroom_type"
                                                                                name="extroom_type"
                                                                                class="form-control w3-margin-bottom extroomtypeselect extroom_type"
                                                                                value="">
                                                                                <!--<option value="">Select extroom Type</option>   -->
                                                                            </select>
                                                                        </div>
                                                                        <div class="w3-col s6 w3-center radio_plot_floor d-none"
                                                                            style="width:40%">
                                                                            <label><b>Plot</b></label>
                                                                        </div>
                                                                        <div class="w3-col s6 mb-3 radio_plot_floor d-none"
                                                                            style="width: 40%;position: relative;left: 46px;">
                                                                            {{-- <label for="floor_label" class="floor_label">Floor</label> <input type="radio" id="floor_label" name="floorPlot" class="mr-2" value="floor"  style=""> --}}
                                                                            <label for="plot_label">Plot</label> <input
                                                                                type="radio" id="plot_label"
                                                                                name="floorPlot" class=""
                                                                                value="building" checked style="">
                                                                        </div>
                                                                        <div id="hide_floor ">
                                                                            <div class="w3-col s6 w3-center"
                                                                                style="width:40%">
                                                                                <label><b class="">Plot</b></label>
                                                                            </div>
                                                                            <div class="w3-col s6 w3-center"
                                                                                style="width: 40%;position: relative;left: 46px;">
                                                                                <div id="floor_wpr1"
                                                                                    style="display:none">
                                                                                    <div class="hidde_check">
                                                                                        <input type='hidden'
                                                                                            name='flotFlor_check'
                                                                                            class='flotFlor_check----'
                                                                                            value='p' />
                                                                                    </div>
                                                                                    <select id="parent_id"
                                                                                        name="parent_id1"
                                                                                        class="w3-input w3-border w3-margin-bottom floor_add_select_id f1">
                                                                                        <!--<option value="">Select Floor</option>-->
                                                                                        @foreach ($floors as $rows)
                                                                                            <option
                                                                                                value="{{ $rows->id }}">
                                                                                                {{ $rows->title }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @if ($errors->has('parent_id'))
                                                                                        <span class="text-red"
                                                                                            role="alert">
                                                                                            <strong>{{ $errors->first('parent_id') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                                <div id="Plot_wprextroom"
                                                                                    style="display: block">
                                                                                    <div class="hidde_check"></div>
                                                                                    <select id="newid"
                                                                                        name="plot_parent"
                                                                                        class="w3-input w3-border w3-margin-bottom plot_add_select_idext p1"
                                                                                        required>
                                                                                        <!--<option value="">Select Plot</option>-->
                                                                                        @foreach ($allPlot as $rows)
                                                                                            <option
                                                                                                value="{{ $rows->id }}">
                                                                                                {{ $rows->title }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div id="show_floor" style="display:none">
                                                                            <div class="w3-col s6 w3-center"
                                                                                style="width:40%">
                                                                                <label><b
                                                                                        class="floorPlot_heading">Floor</b></label>
                                                                            </div>
                                                                            <div class="w3-col s6 w3-center"
                                                                                style="width: 40%;position: relative;left: 46px;">
                                                                                <div id="floor_wpr1">
                                                                                    <div class="hidde_check">
                                                                                        <input type='hidden'
                                                                                            name='flotFlor_check'
                                                                                            class='flotFlor_check'
                                                                                            value='p' />
                                                                                    </div>
                                                                                    <select id="parent_id"
                                                                                        name="parent_id"
                                                                                        data-plotFloorId=""
                                                                                        class="w3-input w3-border w3-margin-bottom floorselect floor_edit_select_id f1">
                                                                                        <!--<option value="">Select Floor</option>-->
                                                                                    </select>
                                                                                    @if ($errors->has('parent_id'))
                                                                                        <span class="text-red"
                                                                                            role="alert">
                                                                                            <strong>{{ $errors->first('parent_id') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                                <div id="Plot_wpr"
                                                                                    style="display:none">
                                                                                    <div class="hidde_check"></div>
                                                                                    <select id="newid"
                                                                                        name="plot_parent"
                                                                                        class="w3-input w3-border w3-margin-bottom plot_edit_select_id p1"
                                                                                        required>
                                                                                        <!--<option value="">Select Plot</option>-->
                                                                                        @foreach ($allPlot as $rows)
                                                                                            <option
                                                                                                value="{{ $rows->id }}">
                                                                                                {{ $rows->title }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width:40%">
                                                                            <label><b class="">Proximity
                                                                                    extroom</b></label>
                                                                        </div>
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width: 40%;position: relative;left: 46px;">
                                                                            <!-- <select name="floor_extroom[]" id="extroomlist" multiple>
                                                                                                       </select> -->
                                                                            <div class="multiselect">
                                                                                <div class="selectBox"
                                                                                    onclick="showCheckboxes()">
                                                                                    <select multiple id="extroomlist"
                                                                                        name="floor_extroom[]">
                                                                                        <option>Select an extroom</option>
                                                                                    </select>
                                                                                    {{-- <div class="overSelect"></div> --}}
                                                                                </div>
                                                                                {{-- <div id="extroomlist">
                                                             
                                                               
                                                           </div> --}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                        <?php
                                                                        $currenturl = url()->full();
                                                                        $projectId = explode('/project-trees/', $currenturl);
                                                                        
                                                                        ?><br>
                                                                        <input type="hidden" id="project_revision_id"
                                                                            name="project_revision_id"
                                                                            value="<?php echo request()->segment(4); ?>">
                                                                        <input type="hidden" id="project_id22"
                                                                            name="project_id"
                                                                            value="<?php echo request()->segment(3); ?>">
                                                                        <?php
                                                                        ?>
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width:40%">
                                                                            <label><b>Area</b></label>
                                                                        </div>
                                                                        <div class="w3-col s6 w3-center"
                                                                            style="width: 40%;position: relative;left: 46px;">
                                                                            <input
                                                                                class="w3-input w3-border w3-margin-bottom"
                                                                                type="text" placeholder="Enter Area"
                                                                                name="extroom_area" id="extroom_area"
                                                                                value="">
                                                                        </div>
                                                                        <input type="hidden" id="floor_id"
                                                                            value="">
                                                                        <div class="w3-col s6 w3-center w3-green"
                                                                            style="width: 40%;position: relative;left: 38px;">
                                                                            <a href="#close-modal" rel="modal:close">
                                                                                <button type="button"
                                                                                    class="w3-btn w3-btn-block w3-red"
                                                                                    id="cancel_btn">Cancel</button>
                                                                            </a>
                                                                        </div>
                                                                        <input type="hidden" id="extroom_parent_id"
                                                                            value="">
                                                                    </div>
                                                                    <div class="w3-col s6 w3-center w3-green"
                                                                        style="width: 40%;position: relative;left: 46px;">
                                                                        <button type="submit" class="w3-btn w3-green"
                                                                            id="submit_extroom"> Create extroom</button>
                                                                        <!--<a href="#close-modal" rel="modal:close">-->
                                                                        <button type="button" class="w3-btn w3-green"
                                                                            id="update_extroom" style='display:none'>
                                                                            Update extroom </button>
                                                                        <!--</a>-->
                                                                    </div>
                                                                    <div class="w3-container w3-padding-hor-16 ">
                                                                        <input type="hidden" id="extroom_child_val"
                                                                            value="">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ui..................... -->
                                        @if (session()->has('Downlaod_message'))
                                            <div class="alert w-100 m-auto alert-danger alert-dismissible fade show"
                                                role="alert">
                                                <strong></strong>
                                                {{ session()->get('Downlaod_message') }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="concept-model">
                                                    <div class="msg-status">
                                                        <div class="progress" role="progressbar"
                                                            aria-label="Example with label" aria-valuenow="25"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                            <div id="msgBar_gcm"
                                                                data-allowReload="{{ $msg < '100' ? '1' : '0' }}"
                                                                class="progress-bar"
                                                                style="width: {{ $msg ?? '0' }}%" value="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--- demo for ui start-------- -->
                                                    <div
                                                        class="d-flex align-items-center justify-content-between my-3 mobile-concept">
                                                        <h6 class="px-3 py-2 model-outline">
                                                            <form>
                                                                <input type="hidden" id="provisionID"
                                                                    name="provisionID"
                                                                    value="{{ request()->segment(4) }}">
                                                                <input type="hidden" id="projectID" name="projectID"
                                                                    value="{{ request()->segment(3) }}">
                                                                <a href="javascript:void(0)" onclick="genConMod()">
                                                                    Generate Concept Model
                                                                </a>
                                                            </form>
                                                        </h6>


                                                        <div class="d-flex align-items-center">
                                                            <h5 class="mr-3">Manual</h5>
                                                            <div class="toggle-btn">
                                                                <input class="mcheck" id="manualcheck" type="checkbox"
                                                                    {{ $manual_gen == 'true' ? 'checked' : '' }} />
                                                                <label></label>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex align-items-center order-auto mobile-auto-top">
                                                            <h5 class="mr-3">Auto</h5>
                                                            @if ($msg != '100' && $process_fbx == '1')
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    width="16" height="16"
                                                                    id="load1"class="loader" viewBox="0 0 32 32">
                                                                    <title>loop2</title>
                                                                    <path
                                                                        d="M27.802 5.197c-2.925-3.194-7.13-5.197-11.803-5.197-8.837 0-16 7.163-16 16h3c0-7.18 5.82-13 13-13 3.844 0 7.298 1.669 9.678 4.322l-4.678 4.678h11v-11l-4.198 4.197z">
                                                                    </path>
                                                                    <path
                                                                        d="M29 16c0 7.18-5.82 13-13 13-3.844 0-7.298-1.669-9.678-4.322l4.678-4.678h-11v11l4.197-4.197c2.925 3.194 7.13 5.197 11.803 5.197 8.837 0 16-7.163 16-16h-3z">
                                                                    </path>
                                                                </svg>
                                                            @else
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    width="16" height="16"
                                                                    id="load1"class="1111" viewBox="0 0 32 32">
                                                                    <title>loop2</title>
                                                                    <path
                                                                        d="M27.802 5.197c-2.925-3.194-7.13-5.197-11.803-5.197-8.837 0-16 7.163-16 16h3c0-7.18 5.82-13 13-13 3.844 0 7.298 1.669 9.678 4.322l-4.678 4.678h11v-11l-4.198 4.197z">
                                                                    </path>
                                                                    <path
                                                                        d="M29 16c0 7.18-5.82 13-13 13-3.844 0-7.298-1.669-9.678-4.322l4.678-4.678h-11v11l4.197-4.197c2.925 3.194 7.13 5.197 11.803 5.197 8.837 0 16-7.163 16-16h-3z">
                                                                    </path>
                                                                </svg>
                                                            @endif

                                                        </div>


                                                        &nbsp;&nbsp;
                                                        @if (file_exists($fbxpath))
                                                            <div
                                                                class="model-outline px-4 mobile-auto-top auto-top-background">
                                                                <button onclick="viewm_model(this)"
                                                                    data-id="model={{ url($fbxpath) }}"
                                                                    class="btn btn-success">3D view</button>

                                                            </div>
                                                        @else
                                                            <div class="model-outline px-4 mobile-auto-top">
                                                                <h6>3D View</h6>
                                                            </div>
                                                        @endif
                                                        <!--- demo for ui end-------- -->
                                                        &nbsp;&nbsp;
                                                        @if (file_exists($fbxpath))
                                                            <div class="model-outline px-4 w-25 ml-auto auto-top-background"
                                                                title="Download fbx1">
                                                                <a href="/admin/download-file?id=<?php echo $t = request()->segment(3); ?>&ftype=fbx1"
                                                                    class="text-center">
                                                                    <h6>Download</h6>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="model-outline px-4 mobile-auto-top">
                                                                <h6>Download</h6>
                                                            </div>
                                                        @endif


                                                    </div>
                                                </div>

                                            </div>
                                            <!--div added extra for proper view -->
                                        </div> <!--div added extra for proper view -->
                                        <?php
                                        if ($msg == '100') {
                                            $gdm_href = 'href';
                                            echo '<input id="GenDetMod" type="hidden" value="false">';
                                        } else {
                                            $gdm_href = 'alt';
                                            echo '<input id="GenDetMod" type="hidden" value="true">';
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="concept-model">
                                                    <div class="msg-status">
                                                        <div class="progress" role="progressbar"
                                                            aria-label="Example with label" aria-valuenow="25"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                            <div id="msgBar_gdm"
                                                                data-allowReload="{{ $msg_fbx2 < '100' ? '1' : '0' }}"
                                                                value="" class="progress-bar"
                                                                style="width: {{ $msg_fbx2 ?? '0' }}%"></div>
                                                        </div>
                                                    </div>


                                                    <div
                                                        class="d-flex align-items-center justify-content-between my-3 mobile-concept">
                                                        <h6 class="px-3 py-2 model-outline">
                                                            <form>
                                                                <input type="hidden" id="provisionID"
                                                                    name="provisionID"
                                                                    value="{{ request()->segment(4) }}">
                                                                <input type="hidden" id="projectID" name="projectID"
                                                                    value="{{ request()->segment(3) }}">
                                                                <a {{ $gdm_href }}="javascript:void(0)"
                                                                    id="h_gdm2" onclick="GenDetailedM()">
                                                                    Generate Detailed Model
                                                                </a>
                                                            </form>
                                                        </h6>
                                                        <div class="d-flex align-items-center">
                                                            <h5 class="mr-3">Manual</h5>
                                                            <div class="toggle-btn">
                                                                <input class="mcheck" id="t_gdm2" type="checkbox"
                                                                    {{ $manual_gdm == 'true' ? 'checked' : '' }} />
                                                                <label></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center order-auto mobile-auto-top">
                                                            <h5 class="mr-3">Auto</h5>

                                                            @if ($msg_fbx2 != '100' && $process_fbx2 == '1')
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    width="16" height="16"
                                                                    id="fbx2_load1"class="loader" viewBox="0 0 32 32">
                                                                    <title>loop2</title>
                                                                    <path
                                                                        d="M27.802 5.197c-2.925-3.194-7.13-5.197-11.803-5.197-8.837 0-16 7.163-16 16h3c0-7.18 5.82-13 13-13 3.844 0 7.298 1.669 9.678 4.322l-4.678 4.678h11v-11l-4.198 4.197z">
                                                                    </path>
                                                                    <path
                                                                        d="M29 16c0 7.18-5.82 13-13 13-3.844 0-7.298-1.669-9.678-4.322l4.678-4.678h-11v11l4.197-4.197c2.925 3.194 7.13 5.197 11.803 5.197 8.837 0 16-7.163 16-16h-3z">
                                                                    </path>
                                                                </svg>
                                                            @else
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    width="16" height="16"
                                                                    id="fbx2_load1"class="1111" viewBox="0 0 32 32">
                                                                    <title>loop2</title>
                                                                    <path
                                                                        d="M27.802 5.197c-2.925-3.194-7.13-5.197-11.803-5.197-8.837 0-16 7.163-16 16h3c0-7.18 5.82-13 13-13 3.844 0 7.298 1.669 9.678 4.322l-4.678 4.678h11v-11l-4.198 4.197z">
                                                                    </path>
                                                                    <path
                                                                        d="M29 16c0 7.18-5.82 13-13 13-3.844 0-7.298-1.669-9.678-4.322l4.678-4.678h-11v11l4.197-4.197c2.925 3.194 7.13 5.197 11.803 5.197 8.837 0 16-7.163 16-16h-3z">
                                                                    </path>
                                                                </svg>
                                                            @endif

                                                        </div>
                                                        &nbsp;&nbsp;
                                                        @if (file_exists($fbx2path))
                                                            <div
                                                                id="3dv_div"class="model-outline px-4 mobile-auto-top auto-top-background">
                                                                <button id="3dv_bt" onclick="viewm_model(this)"
                                                                    data-id="model={{ url($fbx2path) }}"
                                                                    class="btn btn-success">3D View</button>

                                                            </div>
                                                        @else
                                                            <div class="model-outline px-4 mobile-auto-top">
                                                                <h6>3D View</h6>
                                                            </div>
                                                        @endif
                                                        &nbsp;&nbsp;
                                                        @if (file_exists($fbx2path))
                                                            <div class="model-outline px-4 w-25 ml-auto auto-top-background"
                                                                title="Download fbx2">
                                                                <a id="d_f2"
                                                                    {{ $gdm_href }}="/admin/download-file?id=<?php echo $t = request()->segment(3); ?>&ftype=fbx2"
                                                                    class="text-center">
                                                                    <h6>Download</h6>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="model-outline px-4 w-25 ml-auto"
                                                                title="Download fbx2">
                                                                <a id="d_f2" class="text-center">
                                                                    <h6>Download</h6>
                                                                </a>
                                                            </div>
                                                        @endif


                                                    </div>
                                                    <center>
                                                        <h6 id="resultfbx"></h6>
                                                    </center>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="concept-model">
                                                    <div class="msg-status">
                                                        <!-- enable buttons of DWGS -->
                                                        @php $gdm_href="href" @endphp
                                                        <div class="progress" role="progressbar"
                                                            aria-label="Example with label" aria-valuenow="25"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                            <div id="msgBar_gdd"
                                                                data-allowReload="{{ $msg_dwg < '100' ? '1' : '0' }}"
                                                                value="" class="progress-bar"
                                                                style="width: {{ $msg_dwg }}%"></div>
                                                        </div>
                                                        <!-- disable buttons of DWGS -->
                                                        @php $gdm_href="alt" @endphp
                                                        <input id="GenDwgs" type="hidden" value="false">
                                                    </div>


                                                    <div
                                                        class="d-flex align-items-center justify-content-between my-3 mobile-concept">
                                                        <h6 class="px-3 py-2 model-outline">
                                                            <form>
                                                                <input type="hidden" id="provisionID"
                                                                    name="provisionID"
                                                                    value="{{ request()->segment(4) }}">
                                                                <input type="hidden" id="projectID" name="projectID"
                                                                    value="{{ request()->segment(3) }}">
                                                                <a id="h_dwgs"
                                                                    {{ $gdm_href }}="javascript:void(0)"
                                                                    onclick="genDwgs()">
                                                                    Generate Dwgs drawings
                                                                </a>
                                                            </form>
                                                        </h6>
                                                        <div class="d-flex align-items-center">
                                                            <h5 class="mr-3">Manual</h5>
                                                            <div class="toggle-btn">
                                                                <input class="mcheck" id="t_gdwgs" type="checkbox"
                                                                    {{ $manual_dwg == 'true' ? 'checked' : '' }} />
                                                                <label></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center order-auto mobile-auto-top">
                                                            <h5 class="mr-3">Auto</h5>
                                                            @if ($msg_dwg != '100' && $process_dwg1 == '1')
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    width="16" height="16"
                                                                    id="dwg_load1"class="loader" viewBox="0 0 32 32">
                                                                    <title>loop2</title>
                                                                    <path
                                                                        d="M27.802 5.197c-2.925-3.194-7.13-5.197-11.803-5.197-8.837 0-16 7.163-16 16h3c0-7.18 5.82-13 13-13 3.844 0 7.298 1.669 9.678 4.322l-4.678 4.678h11v-11l-4.198 4.197z">
                                                                    </path>
                                                                    <path
                                                                        d="M29 16c0 7.18-5.82 13-13 13-3.844 0-7.298-1.669-9.678-4.322l4.678-4.678h-11v11l4.197-4.197c2.925 3.194 7.13 5.197 11.803 5.197 8.837 0 16-7.163 16-16h-3z">
                                                                    </path>
                                                                </svg>
                                                            @else
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    width="16" height="16"
                                                                    id="dwg_load1"class="1111" viewBox="0 0 32 32">
                                                                    <title>loop2</title>
                                                                    <path
                                                                        d="M27.802 5.197c-2.925-3.194-7.13-5.197-11.803-5.197-8.837 0-16 7.163-16 16h3c0-7.18 5.82-13 13-13 3.844 0 7.298 1.669 9.678 4.322l-4.678 4.678h11v-11l-4.198 4.197z">
                                                                    </path>
                                                                    <path
                                                                        d="M29 16c0 7.18-5.82 13-13 13-3.844 0-7.298-1.669-9.678-4.322l4.678-4.678h-11v11l4.197-4.197c2.925 3.194 7.13 5.197 11.803 5.197 8.837 0 16-7.163 16-16h-3z">
                                                                    </path>
                                                                </svg>
                                                            @endif

                                                        </div>

                                                        &nbsp;&nbsp;

                                                        @if (file_exists($dwg1_file))
                                                            <div class="model-outline px-4 w-25 ml-auto auto-top-background"
                                                                title="Download DWGS">
                                                                <a id="d_dwgs"
                                                                    href="/admin/download-file?id=<?php echo $t = request()->segment(3); ?>&ftype=dwgs"
                                                                    class="text-center">
                                                                    <h6>Download</h6>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="model-outline px-4 w-25 ml-auto"
                                                                title="Download DWGS">
                                                                <a id="d_f2" class="text-center">
                                                                    <h6>Download</h6>
                                                                </a>
                                                            </div>
                                                        @endif



                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="concept-model">
                                                    <div class="msg-status">
                                                        <!-- enable buttons of DWGS -->
                                                        @php $pdf_href="href" @endphp
                                                        <div class="progress" role="progressbar"
                                                            aria-label="Example with label" aria-valuenow="25"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                            <div id="msgBar_gpd"
                                                                data-allowReload="{{ $msg_pdf < '100' ? '1' : '0' }}"
                                                                class="progress-bar" value=""
                                                                style="width: {{ $msg_pdf ?? '0' }}%"></div>
                                                        </div>
                                                        <!-- disable buttons of DWGS -->
                                                        @php $pdf_href="alt" @endphp
                                                        <input id="GenPDF" type="hidden" value="false">

                                                    </div>


                                                    <div
                                                        class="d-flex align-items-center justify-content-between my-3 mobile-concept">
                                                        <h6 class="px-3 py-2 model-outline">
                                                            <form>
                                                                <input type="hidden" id="provisionID"
                                                                    name="provisionID"
                                                                    value="{{ request()->segment(4) }}">
                                                                <input type="hidden" id="projectID" name="projectID"
                                                                    value="{{ request()->segment(3) }}">
                                                                <a id="h_pdf"
                                                                    {{ $pdf_href }} ="javascript:void(0)"
                                                                    onclick="genpdf()">
                                                                    Generate pdf Drawings
                                                                </a>
                                                            </form>
                                                        </h6>
                                                        <div class="d-flex align-items-center">
                                                            <h5 class="mr-3">Manual</h5>
                                                            <div class="toggle-btn">
                                                                <input class="mcheck" id="t_pdf" type="checkbox"
                                                                    {{ $manual_pdf == 'true' ? 'checked' : '' }} />
                                                                <label></label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center order-auto mobile-auto-top">
                                                            <h5 class="mr-3">Auto</h5>
                                                            @if ($msg_pdf != '100' && $process_pdf1 == '1')
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    width="16" height="16"
                                                                    id="pdf_load1"class="loader" viewBox="0 0 32 32">
                                                                    <title>loop2</title>
                                                                    <path
                                                                        d="M27.802 5.197c-2.925-3.194-7.13-5.197-11.803-5.197-8.837 0-16 7.163-16 16h3c0-7.18 5.82-13 13-13 3.844 0 7.298 1.669 9.678 4.322l-4.678 4.678h11v-11l-4.198 4.197z">
                                                                    </path>
                                                                    <path
                                                                        d="M29 16c0 7.18-5.82 13-13 13-3.844 0-7.298-1.669-9.678-4.322l4.678-4.678h-11v11l4.197-4.197c2.925 3.194 7.13 5.197 11.803 5.197 8.837 0 16-7.163 16-16h-3z">
                                                                    </path>
                                                                </svg>
                                                            @else
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    width="16" height="16"
                                                                    id="pdf_load1"class="1111" viewBox="0 0 32 32">
                                                                    <title>loop2</title>
                                                                    <path
                                                                        d="M27.802 5.197c-2.925-3.194-7.13-5.197-11.803-5.197-8.837 0-16 7.163-16 16h3c0-7.18 5.82-13 13-13 3.844 0 7.298 1.669 9.678 4.322l-4.678 4.678h11v-11l-4.198 4.197z">
                                                                    </path>
                                                                    <path
                                                                        d="M29 16c0 7.18-5.82 13-13 13-3.844 0-7.298-1.669-9.678-4.322l4.678-4.678h-11v11l4.197-4.197c2.925 3.194 7.13 5.197 11.803 5.197 8.837 0 16-7.163 16-16h-3z">
                                                                    </path>
                                                                </svg>
                                                            @endif

                                                        </div>
                                                        &nbsp;&nbsp;

                                                        @if (file_exists($pdf1_file))
                                                            <div class="model-outline px-4 w-25 ml-auto  auto-top-background"
                                                                title="Download PDF">
                                                                <a d_pdf
                                                                    {{ $pdf_href }}="/admin/download-file?id=<?php echo $t = request()->segment(3); ?>&ftype=pdf"
                                                                    class="text-center">
                                                                    <h6>Download</h6>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="model-outline px-4 w-25 ml-auto"
                                                                title="Download PDF">
                                                                <a id="d_f2" class="text-center">
                                                                    <h6>Download</h6>
                                                                </a>
                                                            </div>
                                                        @endif


                                                    </div>

                                                </div>
                                            </div>
                                        </div>






                                        <div id="room_model"
                                            style="display: none;border: 1px solid #ccc;padding: 16px;">
                                            <div>
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
                                                    <div class="w3-col s6 w3-center"
                                                        style="width: 40%;position: relative;left: 46px;">
                                                        <div
                                                            class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
                                                            <input class="form-control" type="number" name="id"
                                                                required="" id='room_id' disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="auto_generated_room">
                                                    <div class="w3-col s6 w3-center" style="width:40%">
                                                        <label><b>Obejct ID</b></label>
                                                    </div>
                                                    <div class="w3-col s6 w3-center"
                                                        style="width: 40%;position: relative;left: 46px;">
                                                        <div class="form-group">
                                                            <i> <label>Auto Generated ID</label></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form role="form" id="room_clear" class="room_clear"
                                                    method="POST" action="{{ route('admin.add.room') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="project_id" id="project_id_room_wpr"
                                                        value="<?php echo request()->segment(3); ?>" />
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
                                                                    <input type="text" id="room_title"
                                                                        name="title" value="Room"
                                                                        class="w3-input w3-border w3-margin-bottom"
                                                                        placeholder="Enter Room Name" required="">
                                                                    @if ($errors->has('title'))
                                                                        <span class="text-red" role="alert">
                                                                            <strong>{{ $errors->first('title') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 15%;position: relative;left: 46px;">
                                                                    <input type="number" name="number_of_room"
                                                                        value="1" name=""
                                                                        id="number_of_room" style="width:70%">
                                                                </div>
                                                            </div>
                                                            <div class="w3-col s6 w3-center" style="width:40%">
                                                                <label><b>Room Type</b></label>
                                                            </div>
                                                            <div class="w3-col s6 w3-center"
                                                                style="width: 40%;position: relative;left: 46px;">
                                                                <select id="room_type" name="room_type"
                                                                    class="form-control w3-margin-bottom roomtypeselect room_type"
                                                                    value="">
                                                                    <!--<option value="">Select Room Type</option>   -->
                                                                </select>
                                                            </div>
                                                            <div class="w3-col s6 w3-center radio_plot_floor"
                                                                style="width:40%">
                                                                <label><b>Floor or Plot</b></label>
                                                            </div>
                                                            <div class="w3-col s6 mb-3 radio_plot_floor"
                                                                style="width: 40%;position: relative;left: 46px;">
                                                                <label for="floor_label"
                                                                    class="floor_label">Floor</label> <input
                                                                    type="radio" id="floor_label" name="floorPlot"
                                                                    class="mr-2" value="floor" checked
                                                                    style="">
                                                                <label for="plot_label">Plot</label> <input
                                                                    type="radio" id="plot_label" name="floorPlot"
                                                                    class="" value="building" style="">
                                                            </div>
                                                            <div id="hide_floor">
                                                                <div class="w3-col s6 w3-center" style="width:40%">
                                                                    <label><b class="floorPlot_heading">Floor</b></label>
                                                                </div>
                                                                <div class="w3-col s6 w3-center"
                                                                    style="width: 40%;position: relative;left: 46px;">
                                                                    <div id="floor_wpr1">
                                                                        <div class="hidde_check">
                                                                            <input type='hidden' name='flotFlor_check'
                                                                                class='flotFlor_check' value='f' />
                                                                        </div>
                                                                        <select id="parent_id" name="parent_id1"
                                                                            class="w3-input w3-border w3-margin-bottom floor_add_select_id f1">
                                                                            <!--<option value="">Select Floor</option>-->
                                                                            @foreach ($floors as $rows)
                                                                                <option value="{{ $rows->id }}">
                                                                                    {{ $rows->title }}</option>
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
                                                                        <select id="newid" name="plot_parent"
                                                                            class="w3-input w3-border w3-margin-bottom plot_add_select_id p1"
                                                                            required>
                                                                            <!--<option value="">Select Plot</option>-->
                                                                            @foreach ($allPlot as $rows)
                                                                                <option value="{{ $rows->id }}">
                                                                                    {{ $rows->title }}</option>
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
                                                                    <div id="floor_wpr1">
                                                                        <div class="hidde_check">
                                                                            <input type='hidden' name='flotFlor_check'
                                                                                class='flotFlor_check' value='f' />
                                                                        </div>
                                                                        <select id="parent_id" name="parent_id"
                                                                            data-plotFloorId=""
                                                                            class="w3-input w3-border w3-margin-bottom floorselect floor_edit_select_id f1">
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
                                                                        <select id="newid" name="plot_parent"
                                                                            class="w3-input w3-border w3-margin-bottom plot_edit_select_id p1"
                                                                            required>
                                                                            <!--<option value="">Select Plot</option>-->
                                                                            @foreach ($allPlot as $rows)
                                                                                <option value="{{ $rows->id }}">
                                                                                    {{ $rows->title }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="w3-col s6 w3-center" style="width:40%">
                                                                <label><b class="">Proximity room</b></label>
                                                            </div>
                                                            <div class="w3-col s6 w3-center"
                                                                style="width: 40%;position: relative;left: 46px;">
                                                                <!-- <select name="floor_room[]" id="roomlist" multiple>
                                                                                                            </select> -->
                                                                <div class="multiselect">
                                                                    <div class="selectBox" onclick="showCheckboxes()">
                                                                        <select multiple id="roomlist"
                                                                            name="floor_room[]">
                                                                            <option>Select an Room</option>
                                                                        </select>
                                                                        {{-- <div class="overSelect"></div> --}}
                                                                    </div>
                                                                    <div id="roomlist">


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <?php
                                                            $currenturl = url()->full();
                                                            $projectId = explode('/project-trees/', $currenturl);
                                                            
                                                            ?><br>
                                                            <input type="hidden" id="project_revision_id"
                                                                name="project_revision_id" value="<?php echo request()->segment(4); ?>">
                                                            <input type="hidden" name="project_id"
                                                                value="<?php echo request()->segment(3); ?>"> <?php
                                                                ?>
                                                            <div class="w3-col s6 w3-center" style="width:40%">
                                                                <label><b>Area</b></label>
                                                            </div>
                                                            <div class="w3-col s6 w3-center"
                                                                style="width: 40%;position: relative;left: 46px;">
                                                                <input class="w3-input w3-border w3-margin-bottom"
                                                                    type="text" placeholder="Enter Area"
                                                                    name="room_area" id="room_area" value="">
                                                            </div>
                                                            <input type="hidden" id="floor_id" value="">
                                                            <div class="w3-col s6 w3-center w3-green"
                                                                style="width: 40%;position: relative;left: 38px;">
                                                                <a href="#close-modal" rel="modal:close">
                                                                    <button type="button"
                                                                        class="w3-btn w3-btn-block w3-red"
                                                                        id="cancel_btn">Cancel</button>
                                                                </a>
                                                            </div>
                                                            <input type="hidden" id="room_parent_id" value="">
                                                        </div>
                                                        <div class="w3-col s6 w3-center w3-green"
                                                            style="width: 40%;position: relative;left: 46px;">
                                                            <button type="submit" class="w3-btn w3-green"
                                                                id="submit_room"> Create Room</button>
                                                            <!--<a href="#close-modal" rel="modal:close">-->
                                                            <button type="button" class="w3-btn w3-green"
                                                                id="update_room" style='display:none'> Update Room
                                                            </button>
                                                            <!--</a>-->
                                                        </div>
                                                        <div class="w3-container w3-padding-hor-16 ">
                                                            <input type="hidden" id="room_child_val" value="">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div>

                                            <div id="project-edit-modal"
                                                style="display: none;border: 1px solid #ccc;padding: 16px;">
                                                <div>
                                                    <div>
                                                        <h1 class="text-center"> Edit Project</h1>
                                                    </div>
                                                    <form role="form" id="category" method="POST"
                                                        action="{{ route('admin.update.Projectupdate') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div>
                                                            <div style="width: 85%;margin:20px auto;">
                                                                <label><b>Project Name</b></label>
                                                                <div
                                                                    class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                                    <input class="form-control" type="text"
                                                                        name="project_name" placeholder="Create Project"
                                                                        required="" id="get_project_name">
                                                                </div>
                                                                <input type="hidden" name="id"
                                                                    id="get_project_id">
                                                                <br>
                                                                <label><b>Location</b></label>
                                                                <div
                                                                    class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                                    <input class="form-control" type="text"
                                                                        name="location" placeholder="Location"
                                                                        required="" id="get_location">
                                                                </div>
                                                                <br>
                                                                <label><b>Current Revision</b></label>
                                                                <div
                                                                    class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                                    <input class="form-control" type="text"
                                                                        name="current_revision"
                                                                        placeholder="Current Revision" required=""
                                                                        id="get_current_revision">
                                                                </div>
                                                                <br>
                                                                <label><b>Project Description</b></label>
                                                                <div
                                                                    class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                                    <textarea maxlength="702" class="form-control" type="text" name="description" id="get_description"
                                                                        placeholder="you can write upto 700 characters" required="" rows="6" cols="50"></textarea>
                                                                </div>
                                                                <!-- <div class="w3-col s6 w3-center w3-green" style="width: 48%;position: relative;"> -->
                                                                <button type="button" id="close"
                                                                    class="btn btn-danger w3-btn-block"
                                                                    data-dismiss="modal"
                                                                    style="width: 48%;position: relative;">Close</button>
                                                                <!-- </div> -->
                                                                <button class="w3-btn w3-green" id="create_project"
                                                                    style="width: 48%;position: relative;left:20px;">
                                                                    Update Project</button>
                                                                <button type="button"
                                                                    class="w3-btn w3-green update_project"
                                                                    id="update_project"
                                                                    style="width: 48%;position: relative;left:20px;display:none">
                                                                    update Project</button>
                                                            </div>
                                                        </div>
                                                    </form>
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
        <div id="duplicate_show" class="w3-modal">
            <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
                <div class="w3-center">
                    <br>
                    <h1> Do you want to duplicate</h1>
                </div>
                <div class="w3-container">
                    <div class="w3-section">
                        <div class="w3-col s6 w3-center w3-green" style="width: 40%;position: relative;left: 38px;">
                            <a href="#close-modal" rel="modal:close"> <button class="w3-btn w3-btn-block w3-red">
                                    Cancel</button></a>
                        </div>
                        <div class="w3-col s6 w3-center w3-green" style="width: 40%;position: relative;left: 46px;">
                            <!-- <button  type="submit"  class="w3-btn w3-green" id="submit_floor">  view Button</button> -->
                            <button type="button" class="w3-btn w3-green" id="duplicate_insert">
                                Duplicate </button>
                        </div>
                        <input type="hidden" id="floorID" value="">
                        <div class="w3-container w3-padding-hor-16 ">
                        </div>
                    </div>
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
                        <div class="w3-col s6 w3-center w3-green" style="width: 40%;position: relative;left: 38px;">
                            <a href="#close-modal" rel="modal:close">
                                <button class="w3-btn w3-btn-block w3-red"> Cancel</button>
                            </a>
                        </div>
                        <div class="w3-col s6 w3-center w3-green" style="width: 40%;position: relative;left: 46px;">
                            <!-- <button  type="submit"  class="w3-btn w3-green" id="submit_floor">  view Button</button> -->
                            <button type="button" class="w3-btn w3-green" id="delete_tree_project"> Delete Tree
                            </button>
                        </div>
                        <div class="w3-container w3-padding-hor-16 ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            <?php
                            if (request()->segment(4) != 1) {
                                $revision_plus = request()->segment(4) + 1;
                            } else {
                                $revision_plus = request()->segment(4);
                            }
                            ?>

                            <div class="w3-col s6 w3-center w3-green" style="width: 40%;position: relative;left: 38px;">
                                <a href="/admin/project-trees/<?php echo request()->segment(3) . '/' . $revision_plus; ?>"
                                    class="w3-btn w3-btn-block w3-red link1">
                                    Cancel</a>
                            </div>
                            <div class="w3-col s6 w3-center w3-green" style="width: 40%;position: relative;left: 46px;">
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
                    </div>
                </div>
            </form>
        </div>
        </div>
        </div>
        <div id="rename-modal" class="w3-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form action="{{ route('admin.filename.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">File Name</h5>

                        </div>
                        <div class="modal-body">
                            <input type="text" id="rename-text" name="file_name" value=""
                                class="form-control">
                        </div>
                        <input type="hidden" name="project_id" value="<?php echo request()->segment(3); ?>">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="file_id" id="file_id">
                        <div class="modal-footer">
                            <button type="button" class="w3-btn w3-red close_rename_modal">Close</button>
                            <button type="submit" class="w3-btn w3-green">Save changes</button>

                        </div>
                    </div>
                </form>
            </div>
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
    @endsection
    @section('scripts')
        <script src="{{ asset('js/treeview.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.alert').alert();

                $('#extroomlist').select2();
                $('#roomlist').select2();
            });

            // floor selected and plot deselected
            function floorIsSelected() {

                $("#plot_label").prop('checked', false);

                $("#floor_label").prop('checked', true);
                $('#floor_wpr').css('display', 'block');
                $('#Plot_wpr').css('display', 'none');
                $('.floorPlot_heading').text("Floor");
                //$('#Plot_wpr select').attr("name", '');
                $('#Plot_wpr select').attr("required", false);
                $('#floor_wpr1 select').attr("required", true);
                $('#floor_wpr select').attr("name", 'parent_id1');
                //$('#floor_wpr select').attr("required", false);

                $('#Plot_wpr .hidde_check').html('');
                $('#floor_wpr .hidde_check').append(
                    "<input type='hidden' name='flotFlor_check' class='flotFlor_check' value='f' />");
                $('.f1').show();


            }

            // plot selected and floor deselected
            function plotIsSelected() {

                $('.f1').hide();
                $("#plot_label").prop('checked', true);
                $("#floor_label").prop('checked', false);
                $('#floor_wpr').css('display', 'none');
                $('#Plot_wpr').css('display', 'block');
                $('#Plot_wprextroom').css('display', 'block');
                $('.floorPlot_heading').text("Plot");
                //$('#floor_wpr select').attr("name", '');
                $('#floor_wpr1 select').attr("required", false);
                $('#Plot_wpr select').attr("required", true);
                $('#Plot_wprextroom select').attr("required", true);
                //$('#Plot_wpr select').attr("name", 'parent_id1');
                $('#floor_wpr .hidde_check').html('');

                $('#Plot_wpr .hidde_check').append(
                    "<input type='hidden' name='flotFlor_check' class='flotFlor_check' value='p' />");
                $('#Plot_wprextroom .hidde_check').append(
                    "<input type='hidden' name='flotFlor_check' class='flotFlor_check' value='p' />");


            }

            function plotSelectedFRoom(val, room_id) {
                var plot_parent_id = val;
                var room_id = room_id;
                //var conceptName = $('#newid').find(":selected").val();

                $("#roomlist").empty();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "/admin/getEditFloorRoom",
                    type: 'post',
                    data: {
                        'id': plot_parent_id,
                        'room_id': room_id
                    },
                    dataType: 'json',
                    success: function(response) {

                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }
                        var len1 = 0;
                        if (response['rooms'] != null) {
                            len1 = response['rooms'].length;
                        }
                        var roomids = [];
                        if (len1 > 0) {

                            for (var i = 0; i < len1; i++) {

                                roomids.push(response['rooms'][i].room_ids);
                            }
                        }
                        if (len > 0) {

                            for (var i = 0; i < len; i++) {

                                var id = response['data'][i].id;
                                var name = response['data'][i].title;
                                var status = checkValue(id, roomids);
                                if (status == 'Exist') {
                                    // var option = "<input type='checkbox' checked name='floor_room[]' value='"+id+"'> "+name+"<br>";
                                    var option = "<option selected value='" + id + "'> " + name + "</option>";
                                } else {
                                    var option = "<option  value='" + id + "'> " + name + "</option>";
                                    // var option = "<input type='checkbox' name='floor_room[]' value='"+id+"'> "+name+"<br>";
                                }

                                $("#roomlist").append(option);


                            }
                        }
                    }
                });
            }

            function plotSelectedPRoom(val, room_id) {
                var plot_parent_id = val;
                var room_id = room_id;
                //var conceptName = $('#newid').find(":selected").val();

                $("#roomlist").empty();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "/admin/getEditPlotRoom",
                    type: 'post',
                    data: {
                        'id': plot_parent_id,
                        'room_id': room_id
                    },
                    dataType: 'json',
                    success: function(response) {

                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }
                        var len1 = 0;
                        if (response['rooms'] != null) {
                            len1 = response['rooms'].length;
                        }
                        var roomids = [];
                        if (len1 > 0) {

                            for (var i = 0; i < len1; i++) {

                                roomids.push(response['rooms'][i].room_ids);
                            }
                        }
                        console.log(roomids);

                        if (len > 0) {

                            for (var i = 0; i < len; i++) {

                                var id = response['data'][i].id;
                                var name = response['data'][i].title;
                                var status = checkValue(id, roomids);


                                if (status == 'Exist') {
                                    var option = "<option selected value='" + id + "'> " + name + "</option>";
                                    // var option = "<input type='checkbox' checked name='floor_room[]' value='"+id+"'> "+name+"<br>";
                                } else {
                                    var option = "<option  value='" + id + "'> " + name + "</option>";
                                    // var option = "<input type='checkbox' name='floor_room[]' value='"+id+"'> "+name+"<br>";
                                }

                                $("#roomlist").append(option);
                            }
                        }
                    }
                });
            }

            function checkValue(value, arr) {
                var status = 'Not exist';

                for (var i = 0; i < arr.length; i++) {
                    var name = arr[i];
                    if (name == value) {
                        status = 'Exist';
                        break;
                    }
                }

                return status;
            }
            //

            $("#plot_label").click(function() {
                $("#plot_label").prop('checked', true);
                $("#parent_id1").attr('required', false);
                var plot_parent_id = $('#newid').find(":selected").val();
                //var conceptName = $('#newid').find(":selected").val();

                $("#roomlist").empty();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "/admin/getPlotRoom",
                    type: 'post',
                    data: {
                        'id': plot_parent_id

                    },
                    dataType: 'json',
                    success: function(response) {

                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {

                                var id = response['data'][i].id;
                                var name = response['data'][i].title;

                                //var option = "<option value='"+id+"'>"+name+"</option>"; 
                                //   var option = "<input type='checkbox' name='floor_room[]' value='"+id+"'> "+name+"<br>";
                                var option = "<option  value='" + id + "'> " + name + "</option>";
                                $("#roomlist").append(option);
                            }
                        }
                    }
                });
            })
            $("#floor_label").click(function() {
                $("#floor_label").prop('checked', true);
                //var floor_parent_id =$('#parent_id').find(":selected").val();
                var floor_parent_id = $('#floor_wpr1 select').find(":selected").val();
                //var conceptName = $('#newid').find(":selected").val();
                //console.log(floor_parent_id);
                var room_id = $("#room_id").val();
                $("#roomlist").empty();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "/admin/getEditFloorRoom",
                    type: 'post',
                    data: {
                        'id': floor_parent_id,
                        'room_id': room_id
                    },
                    dataType: 'json',
                    success: function(response) {

                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {

                                var id = response['data'][i].id;
                                var name = response['data'][i].title;

                                //var option = "<option value='"+id+"'>"+name+"</option>"; 
                                //   var option = "<input type='checkbox' name='floor_room[]' value='"+id+"'> "+name+"<br>";
                                var option = "<option  value='" + id + "'> " + name + "</option>";
                                $("#roomlist").append(option);
                            }
                        }
                    }
                });
            })
            //
            $(document).ready(function() {
                $("input[name='floorPlot']").change(function() {

                    if ($(this).is(":checked")) { // check if the radio is checked
                        var val = $(this).val(); // retrieve the value
                        if (val == 'building') {
                            // plot selected and floor deselected
                            plotIsSelected();
                            $('#floor_wpr').find('.flotFlor_check').remove();
                        } else if (val == 'floor') {
                            // floor selected and plot deselected
                            floorIsSelected();

                            $('#Plot_wpr').find('.flotFlor_check').remove();
                            $('#Plot_wprextroom').find('.flotFlor_check').remove();
                        } else {
                            $('#floor_wpr').css('display', 'block');
                            $('#Plot_wpr').css('display', 'none');
                            $('#Plot_wprextroom').css('display', 'none');

                            $('.floorPlot_heading').text("Floor");
                        }
                    }
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('.parent_id').click(function() {
                    let parent_id = $(this).val();
                    $radio = $('#newid').find('option')

                    // return false;
                    $.ajax({
                        url: "/admin/checkParent",
                        type: 'post',
                        data: {
                            'parent_id': parent_id,
                        },
                        success: function(response) {

                            if (response.parent_id == 0) {

                                $.each($radio, function(i, e) {
                                    if ($(this).val() == parent_id) {
                                        $(this).attr('selected', 'selected')
                                        // alert($(this).val())
                                    }
                                })

                                // plot selected and floor deselected
                                plotIsSelected();

                                // $().append($("<option selected />").val(val.id).text(val.title));
                            } else {
                                $.each($radio, function(i, e) {
                                    // if($(this).val() == parent_id){
                                    //       $(this).attr('selected' , 'selected'))
                                    //     // alert($(this).val())
                                    // }
                                })
                                // floor selected and plot deselected
                                floorIsSelected();
                            }
                        }
                    });
                })
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                //   $('#reset_radio').on('click', function(){
                $('#reset_radio').click(function() {
                    $('input[type="radio"]').prop('checked', false);
                    location.reload();

                });
            });

            $(document).ready(function() {
                $('.mcheck').change(function() {
                    if ($(this).prop('checked')) {
                        $.ajax({
                            type: 'GET',
                            url: '/admin/manual-gen',
                            data: {
                                'status': 'true',
                                'project_id': project_id,
                                'tag_id': $(this).attr('id'),
                            },
                            success: function(response) {
                                console.log('working');
                            }
                        })
                    } else {
                        $.ajax({
                            type: 'GET',
                            url: '/admin/manual-gen',
                            data: {
                                'status': 'false',
                                'project_id': project_id,
                                'tag_id': $(this).attr('id'),
                            },
                            success: function(response) {
                                console.log('working');
                            }
                        })
                    }
                    return false;
                })

            });
            $('#add_plot').click(function() {
                // alert('jejej');
                //$('#plot_model').modal('show');
                $('#plot_model').show();
                $('#show_building').hide();
                $('#room_model').hide();
                $('#extroom_model').hide();
                $('#floor_model').hide();
                $('#project-edit-modal').hide();
                $.ajax({

                    url: "/admin/getLastCategoryId",
                    type: 'GET',

                    success: function(data) {
                        $("#title").val("Plot" + data);
                    }
                });

                $.ajax({

                    url: "/admin/getPlotTypes",
                    type: 'GET',

                    success: function(data) {
                        var $dropdown = $(".plottypeselect");
                        $.each(data, function(key, val) {
                            $dropdown.append($("<option />").val(val.plot_type).text(val
                                .plot_type));


                        });

                    }
                });
            });
            $('#properties_plot').click(function() {

                var plot_parent_id = $('#plot_parent_id').val();
                var building_parent_id = $('#building_parent_id').val();
                var floor_parent_id = $('#floor_child_val').val();
                var room_parent_id = $('#room_child_val').val();
                var extroom_parent_id = $('#extroom_child_val').val();
                if (plot_parent_id) {
                    $('#plot_model').show();
                    $("#show_building").hide();
                    $("#floor_model").hide();
                    $("#room_model").hide();
                    $('#update_plot').hide();
                    $('#auto_generated_id').css("display", "block");
                    $('#edit_plot').css("display", "block");
                    $('#details_plot').css("display", "block");
                    $('#auto_generated_proper').css("display", "none");

                    $('#auto_edit_plot').css("display", "none");
                    $('#auto_add_plot').css("display", "none");
                    $('#auto_details_plot').css("display", "block");

                } else if (room_parent_id) {
                    $('#auto_add_room').css("display", "none");
                    $('#auto_edit_room').css("display", "none");
                    $('#auto_details_room').css("display", "block");
                    $('#auto_generated_room').css("display", "none");
                    $('#auto_generated_id_room').css("display", "none");

                    $('#room_model').show();
                    $('#plot_model').hide();
                    $("#show_building").hide();
                    $("#floor_model").hide();
                    $('#update_room').hide();
                    $('#auto_generated_id_room').css("display", "block");


                } else if (building_parent_id) {
                    $('#auto_add_building').css("display", "none");
                    $('#auto_edit_building').css("display", "none");
                    $('#auto_details_building').css("display", "block");
                    $('#auto_generated_building').css("display", "none");
                    $('#show_building').show();
                    $('#plot_model').hide();
                    $("#floor_model").hide();
                    $("#room_model").hide();
                    $('#update_building').hide();
                    $('#auto_generated_id_building').css("display", "block");

                    $('#show_plot').show();
                    $('#hide_plot').remove();
                } else if (floor_parent_id) {

                    $('#auto_add_floor').css("display", "none");
                    $('#auto_edit_floor').css("display", "none");
                    $('#auto_details_floor').css("display", "block");
                    $('#auto_generated_floor').css("display", "none");


                    $('#floor_model').show();
                    $('#plot_model').hide();
                    $("#show_building").hide();
                    $("#room_model").hide();
                    $("#add_floor").hide();
                    $("#add_basement").hide();
                    $('#update_floor').hide();
                    $('#auto_generated_id_floor').css("display", "block");


                } else {
                    $('#display_message').append("<b>Select the tree first</b>");

                }
                // else if (room_parent_id ) {
                //  alert('hhhh');
                //     $('#room_model').modal('show');

            });

            $('#edit_plot').click(function() {
                // alert('jejej');
                // $('.floorselect').prop( "disabled", true );
                // $('.radio_plot_floor').css('display','none');
                if ($('input[name="project_name_s"]:checked').val() == 'yes') {
                    //$("#project-edit-modal").modal('show');
                    $("#project-edit-modal").show();
                    $('#plot_model').hide();
                    $('#show_building').hide();
                    $('#floor_model').hide();
                    $('#room_model').hide();
                    $('#extroom_model').hide();
                    var project_id = $('#pro_id').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "/admin/getProjectData",
                        type: 'post',
                        data: {
                            'project_id': project_id,


                        },
                        dataType: 'json',
                        success: function(response) {

                            //console.log(data);

                            $("#get_project_id").val(response['data']['id']);
                            $("#get_project_name").val(response['data']['project_name']);
                            $("#get_location").val(response['data']['location']);
                            $("#get_description").val(response['data']['description']);
                            $("#get_current_revision").val(response['data']['current_revision']);
                        }
                    });
                    return false;
                }
                var plot_parent_id = $('#plot_parent_id').val();
                var building_parent_id = $('#building_parent_id').val();
                var floor_parent_id = $('#floor_child_val').val();
                var room_parent_id = $('#room_child_val').val();
                var extroom_parent_id = $('#extroom_child_val').val();
                //var r_id = $("#csv_file_list").find(':selected').data('revision');
                // console.log(room_parent_id);
                // console.log(floor_parent_id);
                // console.log(building_parent_id);
                // console.log(plot_parent_id);
                if (plot_parent_id) {
                    //$('#plot_model').modal('show');

                    $('#plot_model').show();
                    $('#show_building').hide();
                    $('#floor_model').hide();
                    $('#room_model').hide();
                    $('#project-edit-modal').hide();

                    $('#auto_edit_plot').css("display", "block");
                    $('#auto_generated_id').css("display", "block");
                    $('#auto_add_plot').css("display", "none");
                    $('#auto_generated_proper').css("display", "none");
                } else if (extroom_parent_id) {
                    //coding..
                    $('#auto_add_extroom').css("display", "none");
                    $('#auto_edit_extroom').css("display", "block");
                    $('#auto_details_extroom').css("display", "none");
                    $('#auto_generated_extroom').css("display", "none");
                    $('#auto_generated_id_extroom').css("display", "block");
                    //$('#room_model').modal('show');
                    $('#room_model').hide();
                    $('#extroom_model').show();
                    $('#plot_model').hide();
                    $('#show_building').hide();
                    $('#floor_model').hide();
                    $('#project-edit-modal').hide();
                    // newwwwwwwwwwwwwwwwwwwwwww   
                    //  $('#show_floor').show();
                    $('#hide_floor').remove();
                    var project_id = $('#project_id_extroom_wpr').val();
                    var room_child_val = $('#extroom_child_val').val();
                    var select_radio = $(".child_id:checked").val();
                    var project_revision = $("#project_revision_id").val();


                    $.ajax({

                        url: "/admin/geteditroom",
                        type: 'GET',
                        data: {
                            'room_child_val': room_child_val,
                            project_id: project_id,
                            project_revision: project_revision,
                            select_radio: select_radio
                        },
                        success: function(data) {

                            //room_child_val
                            //console.log(data.pro_room);
                            // console.log(data.floor_data[0]);
                            //alert(room_child_val);
                            var $dropdowns = $(".floorselect");
                            var $dropdowns2 = $(".floor_edit_select_id");
                            var $dropdowns3 = $(".plot_edit_select_id");

                            var $dropdwons4 = $(".extroomlist");


                            if (data.roomRecord.parent_host == 'Plot') {
                                $($dropdowns3).html('');
                            }
                            //alert(data.allfloors);
                            $.each(data.allfloors, function(key, val) {
                                //console.log("zahid");
                                // console.log(val);
                                if (val.project_id == project_id) {

                                    if (val.family == "Plot") {

                                        plotIsSelected();
                                        if (val.id == room_child_val) {
                                            //console.log(val.title)
                                            $dropdowns3.append($("<option selected />").val(val.id)
                                                .text(val.title));
                                            plotSelectedPRoom(val.id, select_radio);
                                        } else {
                                            $dropdowns3.append($("<option />").val(val.id).text(val
                                                .title));
                                        }

                                    } else {

                                        floorIsSelected();
                                        // if (val.title == data.floor_data[0].title) {
                                        if (val.id == room_child_val) {
                                            $dropdowns2.append($("<option selected />").val(val.id)
                                                .text(val.title));
                                            plotSelectedFRoom(val.id, select_radio);
                                        } else {
                                            $dropdowns2.append($("<option />").val(val.id).text(val
                                                .title));
                                        }
                                    }
                                }

                            });

                            $.each(data.floorRecord, function(recordKey, recordVal) {

                                if (recordVal.project_id == project_id && data.roomRecord
                                    .parent_host == 'Plot') {

                                    if (recordVal.family == "Floor") {
                                        if (recordVal.title) {
                                            $dropdowns2.append($("<option selected />").val(
                                                recordVal.id).text(recordVal.title));
                                        } else {
                                            $dropdowns2.append($("<option />").val(recordVal.id)
                                                .text(recordVal.title));
                                        }
                                    }
                                }
                            })
                            // Multicheckbox
                            $("#extroomlist").empty();
                            // $.each(data.pro_room, function(recordKey,recordVal){
                            //       //var option = "<input type='checkbox' checked name='floor_room[]' value='"+recordVal.id+"'> "+recordVal.title+"<br>";
                            //     //$("#roomlist").append(option);
                            //  })


                            var len = 0;

                            if (data.pro_room != null) {
                                len = data.pro_room.length;
                            }

                            if (len > 0) {
                                // Read data and create <option >
                                $.each(data.pro_room, function(recordKey, recordVal) {


                                    if (recordVal.id != select_radio && recordVal.plot_id != null) {
                                        var id = recordVal.id;
                                        var name = recordVal.title;

                                        //var option = "<option value='"+id+"'>"+name+"</option>"; 
                                        //   var option = "<input type='checkbox' name='floor_room[]' value='"+id+"'> "+name+"<br>";
                                        var option = "<option  value='" + id + "'> " + name +
                                            "</option>";
                                        $("#extroomlist").append(option);
                                    }

                                })
                            }


                        }
                    });
                } else if (room_parent_id) {

                    $('#auto_add_room').css("display", "none");
                    $('#auto_edit_room').css("display", "block");
                    $('#auto_details_room').css("display", "none");
                    $('#auto_generated_room').css("display", "none");
                    $('#auto_generated_id_room').css("display", "block");
                    //$('#room_model').modal('show');
                    $('#extroom_model').hide();
                    $('#room_model').show();
                    $('#plot_model').hide();
                    $('#show_building').hide();
                    $('#floor_model').hide();
                    $('#project-edit-modal').hide();
                    // newwwwwwwwwwwwwwwwwwwwwww   
                    $('#show_floor').show();
                    $('#hide_floor').remove();
                    var project_id = $('#project_id_room_wpr').val();
                    var room_child_val = $('#room_child_val').val();
                    var select_radio = $(".child_id:checked").val();
                    var project_revision = $("#project_revision_id").val();


                    $.ajax({

                        url: "/admin/geteditroom",
                        type: 'GET',
                        data: {
                            'room_child_val': room_child_val,
                            project_id: project_id,
                            project_revision: project_revision,
                            select_radio: select_radio
                        },
                        success: function(data) {

                            //room_child_val
                            //console.log(data.pro_room);
                            // console.log(data.floor_data[0]);
                            //alert(room_child_val);
                            var $dropdowns = $(".floorselect");
                            var $dropdowns2 = $(".floor_edit_select_id");
                            var $dropdowns3 = $(".plot_edit_select_id");
                            if (data.roomRecord.parent_host == 'Plot') {
                                $($dropdowns3).html('');
                            }
                            //alert(data.allfloors);
                            $.each(data.allfloors, function(key, val) {
                                //console.log("zahid");
                                // console.log(val);
                                if (val.project_id == project_id) {

                                    if (val.family == "Plot") {

                                        plotIsSelected();
                                        if (val.id == room_child_val) {
                                            //console.log(val.title)
                                            $dropdowns3.append($("<option selected />").val(val.id)
                                                .text(val.title));
                                            plotSelectedPRoom(val.id, select_radio);
                                        } else {
                                            $dropdowns3.append($("<option />").val(val.id).text(val
                                                .title));
                                        }

                                    } else {

                                        floorIsSelected();
                                        // if (val.title == data.floor_data[0].title) {
                                        if (val.id == room_child_val) {
                                            $dropdowns2.append($("<option selected />").val(val.id)
                                                .text(val.title));
                                            plotSelectedFRoom(val.id, select_radio);
                                        } else {
                                            $dropdowns2.append($("<option />").val(val.id).text(val
                                                .title));
                                        }
                                    }
                                }

                            });

                            $.each(data.floorRecord, function(recordKey, recordVal) {

                                if (recordVal.project_id == project_id && data.roomRecord
                                    .parent_host == 'Plot') {

                                    if (recordVal.family == "Floor") {
                                        if (recordVal.title) {
                                            $dropdowns2.append($("<option selected />").val(
                                                recordVal.id).text(recordVal.title));
                                        } else {
                                            $dropdowns2.append($("<option />").val(recordVal.id)
                                                .text(recordVal.title));
                                        }
                                    }
                                }
                            })
                            // Multicheckbox
                            $("#roomlist").empty();

                            var len = 0;

                            if (data.pro_room != null) {
                                len = data.pro_room.length;
                            }

                            if (len > 0) {
                                // Read data and create <option >
                                $.each(data.pro_room, function(recordKey, recordVal) {

                                    var id = recordVal.id;
                                    var name = recordVal.title;

                                    if (recordVal.id != select_radio && recordVal.plot_id == null) {
                                        var id = recordVal.id;
                                        var name = recordVal.title;

                                        //var option = "<option value='"+id+"'>"+name+"</option>"; 
                                        //   var option = "<input type='checkbox' name='floor_room[]' value='"+id+"'> "+name+"<br>";
                                        var option = "<option  value='" + id + "'> " + name +
                                            "</option>";
                                        $("#roomlist").append(option);
                                    }
                                })
                            }

                            //   $.each(data.pro_room, function(recordKey,recordVal){
                            //         //var option = "<input type='checkbox' checked name='floor_room[]' value='"+recordVal.id+"'> "+recordVal.title+"<br>";
                            //       //$("#roomlist").append(option);
                            //    })
                        }
                    });
                } else if (building_parent_id) {

                    $('#auto_add_building').css("display", "none");
                    $('#auto_edit_building').css("display", "block");
                    $('#auto_details_building').css("display", "none");
                    $('#auto_generated_id_building').css("display", "block");
                    $('#auto_generated_building').css("display", "none");
                    //$('#show_building').modal('show');
                    $('#show_building').show();
                    $('#room_model').hide();
                    $('#plot_model').hide();
                    $('#floor_model').hide();
                    $('#project-edit-modal').hide();
                    $('#show_plot').show();
                    $('#hide_plot').remove();
                } else if (floor_parent_id) {
                    //   alert(building_parent_id);
                    // $('#building_parent_id_val').val(building_parent_id);

                    $('#auto_add_floor').css("display", "none");
                    $('#auto_edit_floor').css("display", "block");
                    $('#auto_details_floor').css("display", "none");
                    $('#auto_generated_floor').css("display", "none");
                    $('#auto_generated_id_floor').css("display", "block");
                    //$('#floor_model').modal('show');
                    $('#floor_model').show();
                    $('#room_model').hide();
                    $('#plot_model').hide();
                    $('#show_building').hide();
                    $('#project-edit-modal').hide();
                    $("#add_floor").show();
                    $("#add_basement").show();
                    var floor_child_val = $('#floor_child_val').val();
                    $('#show_buildings').show();
                    $('#hide_building').remove();

                    $.ajax({

                        url: "/admin/geteditfloor",
                        type: 'GET',
                        data: {
                            'floor_child_val': floor_child_val,
                        },
                        success: function(data) {
                            console.log(data.allfloors);
                            console.log(data.floor_data[0]);
                            var $dropdowns = $(".buildingselect");
                            $.each(data.allfloors, function(key, val) {

                                if (val.title == data.floor_data[0].title) {
                                    $dropdowns.append($("<option selected/>").val(val.id).text(val
                                        .title));
                                } else {
                                    $dropdowns.append($("<option />").val(val.id).text(val.title));
                                }

                            });

                        }
                    });

                } else {
                    $('#display_message').append("<b>Select the tree first</b>");

                }
                // else if (room_parent_id ) {
                //  alert('hhhh');
                //     $('#room_model').modal('show');

            });


            $('#addbuilding').click(function() {

                //$('#show_building').modal('show');
                $('#show_building').show();
                $('#room_model').hide();
                $('#plot_model').hide();
                $('#floor_model').hide();
                $('#extroom_model').hide();
                $('#project-edit-modal').hide();
                $('#building_type').find('option').remove();
                $.ajax({

                    url: "/admin/getBuildingTypes",
                    type: 'GET',

                    success: function(data) {
                        console.log(data);
                        var $dropdown = $(".buildingtypeselect");
                        var i = 1;
                        $.each(data, function(key, val) {
                            if (i == 1) {
                                $("#floor_height").val(val.floor_height);
                                $("#number_of_floor").val(val.number_of_floor);
                                $("#target_area").val(val.target_area);
                            }
                            $dropdown.append($("<option />").val(val.building_type).text(val
                                .building_type));
                            i++;

                        });
                    }
                });

                // newwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww
                var plot_primary_id = $('#plot_parent_category').val();
                var user_id = $('#user_id').val();
                var project_id = $('#project_id').val();

                $.ajax({

                    url: "/admin/getplot",
                    type: 'GET',
                    data: {
                        'plot_primary_id': plot_primary_id,
                        'user_id': user_id,
                        'project_id': project_id
                    },
                    success: function(data) {
                        //console.log(data.allPlots);
                        //console.log(data.plot_data);
                        var $dropdowns = $(".plotselect");
                        $.each(data.allPlots, function(key, val) {

                            if (val.title == data.plot_data.title) {
                                $dropdowns.append($("<option selected/>").val(val.id).text(val
                                    .title));
                            } else {
                                $dropdowns.append($("<option />").val(val.id).text(val.title));
                            }

                        });

                    }
                });
                // end newwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww
                // Get categories id
                $.ajax({

                    url: "/admin/getCateId",
                    type: 'GET',
                    data: {

                    },
                    success: function(data) {
                        //console.log(data.cate_id);
                        $("#building_title").val('Building ' + data.cate_id);

                    }
                });
                // end 
            });

            $('#addextroom').click(function() {
                var project_id = $('#pro_id').val();
                var project_revision_id = $('#project_revision_id').val();
                $('#number_of_extroom').show();
                $.ajax({

                    url: "/admin/getLastextroomId",
                    type: 'GET',
                    data: {

                        'project_id': project_id,
                        'project_revision_id': project_revision_id
                    },
                    success: function(data) {
                        $("#extroom_title").val("Extroom " + data);
                    }
                });
                var plot_frimary_id = $(".parent_id:checked").val();

                $('.plot_edit_select_id').remove();
                //$('#extroom_model').modal('show');

                $('#extroom_model').show();
                $('#plot_model').hide();
                $('#show_building').hide();
                $('#floor_model').hide();
                $('#room_model').hide();
                $('#project-edit-modal').hide();
                $.ajax({

                    url: "/admin/getextroomTypes",
                    type: 'GET',

                    success: function(data) {
                        //console.log(data);
                        var $dropdown = $(".extroomtypeselect");
                        var i = 1;
                        $.each(data, function(key, val) {
                            if (i == 1) {
                                $("#extroom_area").val(val.room_area);
                            }
                            $dropdown.append($("<option />").val(val.room_type).text(val
                                .room_type));
                            i++;
                        });


                    }
                });
                // getextroom
                var fid = $('.plot_add_select_idext').val();
                $('#extroomlist').find('option').remove();
                // Department id
                $("#extroomlist").empty();
                //id = ;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/admin/getextroom",
                    type: 'post',
                    data: {
                        'id': fid

                    },
                    dataType: 'json',
                    success: function(response) {

                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            // Read data and create <option >

                            for (var i = 0; i < len; i++) {

                                var id = response['data'][i].id;
                                var name = response['data'][i].title;

                                //var option = "<option value='"+id+"'>"+name+"</option>"; 
                                var option = "<option  value='" + id + "'> " + name + "</option>";
                                $("#extroomlist").append(option);
                            }
                        }
                    }
                });
                // getextroom

                // Empty the dropdown
                //
                // newwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww
                var floor_parent_id = $('#floor_child_val').val();
                var floor_primary_id = $('#floor_id').val();
                //   alert(floor_primary_id);
                var user_id = $('#user_id').val();
                var project_id = $('#project_id').val();

                // alert(floor_primary_id);
                $.ajax({

                    url: "/admin/getfloor",
                    type: 'GET',
                    data: {
                        'floor_primary_id': floor_primary_id,
                        'user_id': user_id,
                        'project_id': project_id,
                        'floor_parent_id': floor_parent_id
                    },
                    success: function(data) {
                        //console.log(data);
                        var $dropdowns = $(".floorselect");

                        $.each(data.allfloors, function(key, val) {

                            if (val.title == data.floor_data.title) {
                                $dropdowns.append($("<option selected/>").val(val.id).text(val
                                    .title));
                            } else {
                                $dropdowns.append($("<option />").val(val.id).text(val.title));
                            }
                        });
                        //get extroom Edit

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "/admin/getextroom",
                            type: 'post',
                            data: {
                                'id': floor_primary_id

                            },
                            dataType: 'json',
                            success: function(response) {

                                var len = 0;
                                if (response['data'] != null) {
                                    len = response['data'].length;
                                }

                                if (len > 0) {
                                    // Read data and create <option >
                                    for (var i = 0; i < len; i++) {

                                        var id = response['data'][i].id;
                                        var name = response['data'][i].title;

                                        //var option = "<option value='"+id+"'>"+name+"</option>"; 
                                        //    var option = "<input type='checkbox' name='floor_extroom[]' value='"+id+"'> "+name+"<br>";
                                        //    $("#extroomlist").append(option); 

                                        var option = "<option  value='" + id + "'> " + name +
                                            "</option>";
                                        $("#extroomlist").append(option);


                                    }
                                }
                            }
                        });
                        //

                    }
                });
                // end newwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww

                if (!$(".parent_id ,.child_id").is(':checked')) {
                    $('.parent_id').trigger();

                } else {
                    $('.parent_id').trigger();
                }

                var select_radio = $(".parent_id:checked").val();

                $.ajax({

                    url: "/admin/getextroomRecord",
                    type: 'GET',
                    data: {
                        'select_radio': select_radio
                    },
                    success: function(data) {

                        //console.log(data.extroomRecord);


                        if (data.extroomRecord.family == 'Plot') {
                            $('.floor_edit_select_id').attr('name', '');
                            $('.floor_edit_select_id').attr("required", false);

                            $('.plot_edit_select_id').attr('name', '');
                            $('.plot_edit_select_id').attr("required", false);
                        }


                    }
                });

                if ('.parent_id:checked') {

                    $.ajax({

                        url: "/admin/getParentfloor",
                        type: 'GET',
                        data: {
                            'plot_frimary_id': plot_frimary_id,
                            'project_id': project_id
                        },
                        success: function(data) {
                            //console.log(data);
                            var $dropdowns5 = $(".floor_add_select_id");
                            $($dropdowns5).html('');
                            $.each(data.parentFloor, function(key, val) {

                                $dropdowns5.append($("<option />").val(val.id).text(val.title));


                            });
                        }
                    });
                }


            });


            $('#addroom').click(function() {
                var project_id = $('#pro_id').val();
                var project_revision_id = $('#project_revision_id').val();
                $('#number_of_room').show();
                $.ajax({

                    url: "/admin/getLastRoomId",
                    type: 'GET',
                    data: {

                        'project_id': project_id,
                        'project_revision_id': project_revision_id
                    },
                    success: function(data) {
                        $("#room_title").val("Room" + data);
                    }
                });
                var plot_frimary_id = $(".parent_id:checked").val();

                $('.plot_edit_select_id').remove();
                //$('#room_model').modal('show');

                $('#room_model').show();
                $('#plot_model').hide();
                $('#show_building').hide();
                $('#floor_model').hide();
                $('#extroom_model').hide();
                $('#project-edit-modal').hide();
                $.ajax({

                    url: "/admin/getRoomTypes",
                    type: 'GET',

                    success: function(data) {
                        //console.log(data);
                        var $dropdown = $(".roomtypeselect");
                        var i = 1;
                        $.each(data, function(key, val) {
                            if (i == 1) {
                                $("#room_area").val(val.room_area);
                            }
                            $dropdown.append($("<option />").val(val.room_type).text(val
                                .room_type));
                            i++;
                        });


                    }
                });
                // getRoom
                var fid = $('.f1').val();
                $('#roomlist').find('option').remove();
                $("#roomlist").empty();

                //id = ;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/admin/getRoom",
                    type: 'post',
                    data: {
                        'id': fid

                    },
                    dataType: 'json',
                    success: function(response) {

                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            // Read data and create <option >

                            for (var i = 0; i < len; i++) {

                                var id = response['data'][i].id;
                                var name = response['data'][i].title;

                                //var option = "<option value='"+id+"'>"+name+"</option>"; 
                                //   var option = "<input type='checkbox' name='floor_room[]' value='"+id+"'> "+name+"<br>";
                                // $("#roomlist").append(option); 

                                var option = "<option  value='" + id + "'> " + name + "</option>";
                                $("#roomlist").append(option);


                            }
                        }
                    }
                });
                // getRoom

                // Empty the dropdown
                //
                // newwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww
                var floor_parent_id = $('#floor_child_val').val();
                var floor_primary_id = $('#floor_id').val();
                //   alert(floor_primary_id);
                var user_id = $('#user_id').val();
                var project_id = $('#project_id').val();

                // alert(floor_primary_id);
                $.ajax({

                    url: "/admin/getfloor",
                    type: 'GET',
                    data: {
                        'floor_primary_id': floor_primary_id,
                        'user_id': user_id,
                        'project_id': project_id,
                        'floor_parent_id': floor_parent_id
                    },
                    success: function(data) {
                        //console.log(data);
                        var $dropdowns = $(".floorselect");
                        $dropdowns.html('');
                        $.each(data.allfloors, function(key, val) {

                            if (val.title == data.floor_data.title) {
                                $dropdowns.append($("<option selected/>").val(val.id).text(val
                                    .title));
                            } else {
                                $dropdowns.append($("<option />").val(val.id).text(val.title));
                            }
                        });
                        //get Room Edit

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "/admin/getRoom",
                            type: 'post',
                            data: {
                                'id': floor_primary_id

                            },
                            dataType: 'json',
                            success: function(response) {

                                var len = 0;
                                if (response['data'] != null) {
                                    len = response['data'].length;
                                }

                                if (len > 0) {
                                    // Read data and create <option >
                                    for (var i = 0; i < len; i++) {

                                        var id = response['data'][i].id;
                                        var name = response['data'][i].title;

                                        //var option = "<option value='"+id+"'>"+name+"</option>"; 
                                        // var option = "<input type='checkbox' name='floor_room[]' value='"+id+"'> "+name+"<br>";
                                        // $("#roomlist").append(option); 

                                        var option = "<option  value='" + id + "'> " + name +
                                            "</option>";
                                        $("#roomlist").append(option);
                                    }
                                }
                            }
                        });
                        //

                    }
                });
                // end newwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww

                if (!$(".parent_id ,.child_id").is(':checked')) {
                    $('.parent_id').trigger();

                } else {
                    $('.parent_id').trigger();
                }

                var select_radio = $(".parent_id:checked").val();

                $.ajax({

                    url: "/admin/getRoomRecord",
                    type: 'GET',
                    data: {
                        'select_radio': select_radio
                    },
                    success: function(data) {

                        //console.log(data.roomRecord);


                        if (data.roomRecord.family == 'Plot') {
                            $('.floor_edit_select_id').attr('name', '');
                            $('.floor_edit_select_id').attr("required", false);

                            $('.plot_edit_select_id').attr('name', '');
                            $('.plot_edit_select_id').attr("required", false);
                        }


                    }
                });

                if ('.parent_id:checked') {

                    $.ajax({

                        url: "/admin/getParentfloor",
                        type: 'GET',
                        data: {
                            'plot_frimary_id': plot_frimary_id,
                            'project_id': project_id
                        },
                        success: function(data) {
                            //console.log(data);
                            var $dropdowns5 = $(".floor_add_select_id");
                            $($dropdowns5).html('');
                            $.each(data.parentFloor, function(key, val) {

                                $dropdowns5.append($("<option />").val(val.id).text(val.title));


                            });
                        }
                    });
                }


            });




            $('#addfloor').click(function() {
                //$('#floor_model').modal('show');
                $('#plot_model').hide();
                $('#show_building').hide();
                $('#room_model').hide();
                $('#extroom_model').hide();
                $('#floor_model').show();
                $('#project-edit-modal').hide();
                // newwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww
                var building_primiry_id = $('#building_primiry_id').val();
                var user_id = $('#user_id').val();
                var project_id = $('#project_id').val();
                var building_parent_id = $('#building_parent_id').val();
                $('#building_parent_id_val').val(building_parent_id);
                // alert(building_primiry_id);
                $.ajax({

                    url: "/admin/getbuilding",
                    type: 'GET',
                    data: {
                        'building_primiry_id': building_primiry_id,
                        'user_id': user_id,
                        'project_id': project_id,
                        'building_parent_id': building_parent_id
                    },
                    success: function(data) {
                        //console.log(data);
                        var $dropdowns = $(".buildingselect");
                        $.each(data.allbuildings, function(key, val) {

                            if (val.title == data.building_data.title) {
                                $dropdowns.append($("<option selected/>").val(val.id).text(val
                                    .title));

                            } else {
                                $dropdowns.append($("<option />").val(val.id).text(val.title));

                            }

                        });
                    }
                });
            });

            $('.w3-btn-block').click(function() {
                window.location.reload();
            });

            $('.generate_CSV').click(function() {
                //alert('Hi');

                //$('#generate_CSV_file_pop').modal('show');

                $(".generate_CSV").removeClass("w3-black");
                $(".generate_CSV").css("background-color", "red");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var parent_val = $('#pro_id').val();
                var project_revision_id = $('#project_revision_id').val();

                $.ajax({

                    url: "/admin/exportCsv",
                    type: 'GET',
                    data: {
                        'project_id': parent_val,
                        'project_revision_id': project_revision_id
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Please wait work under process...',
                            showConfirmButton: false,
                        });
                    },
                    success: function(data) {
                        //console.log(data);
                        //window.location.href = "{{ url('/admin/view-csv-file') }}";

                        Swal.fire(
                            'Success!',
                            'Files generated successfully.',
                            'success'
                        )
                        location.reload();

                    }
                });
            });
            //
            $('#generate_files').click(function() {


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var parent_val = $('#pro_id').val();
                var project_revision_id = $('#project_revision_id').val();

                $.ajax({

                    url: "/admin/exportCsv",
                    type: 'GET',
                    data: {
                        'project_id': parent_val,
                        'project_revision_id': project_revision_id
                    },
                    success: function(data) {
                        //console.log(data);
                        window.location.href = "{{ url('/admin/view-csv-file') }}";
                    }
                });

            });
            //
            $('.parent_id').click(function() {
                // changes 
                $('#categorys')[0].reset();
                $('#submit_building').show();
                $('#update_building').hide();

                $('.floor_clear')[0].reset();
                $('#submit_floor').show();
                $('#update_floor').hide();

                $('.room_clear')[0].reset();
                $('#submit_room').show();
                $('#update_room').hide();
                // end changes

                $('#plotdropdown').hide();
                $('#plotdropdownajax').show();
                var parent_val = $(this).val();
                // hide display buttons
                $('#plot_parent_category').val(parent_val);
                $('#add_plot').attr('disabled', 'true');
                //    $('#addextroom').attr('disabled', 'true');
                $('#addbuilding').prop('disabled', false);
                $('#addextroom').prop('disabled', false);
                $('#addfloor').prop('disabled', false);
                $('#addroom').prop('disabled', true);
                //end hide display buttons
                // newwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww
                $('#show_plot').show();
                $('#hide_plot').remove();
                //   $('#plot_parent_category').val(parent_val);
                $.ajax({
                    url: "/admin/category-tree-view",
                    type: 'get',
                    data: {
                        'id': parent_val
                    },
                    success: function(data) {

                        var $dropdown = $(".plottypeselect");
                        $.each(data.plotType, function(key, val) {

                            if (val.plot_type == data.allPlot[0].plot_type_name) {
                                $dropdown.append($("<option selected/>").val(val.plot_type).text(val
                                    .plot_type));
                            } else {
                                $dropdown.append($("<option />").val(val.plot_type).text(val
                                    .plot_type));
                            }

                        });
                        //    $("#plottypeselect").val(data[0].plot_type_name).text(data[0].plot_type_name);

                        // $("#parent_id select").val(data[0].id).change();
                        //    var option = "<option selected value='"+data[0].id+"'>"+data[0].plot_type_name+"</option>"; 
                        //  $("#parent_id").append(option); 

                        var parent_id = data.allPlot[0].parent_id;
                        var plot_auto_id = data.allPlot[0].plot_id;
                        // alert(plot_auto_id);
                        var titles = data.allPlot[0].title;
                        var heights = data.allPlot[0].height;
                        var widths = data.allPlot[0].width;
                        var lengths = data.allPlot[0].length;
                        var plot_ids = data.allPlot[0].id;
                        var user_id = data.allPlot[0].user_id;
                        var project_id = data.allPlot[0].project_id;
                        $('#plot_auto_id').val(plot_auto_id);
                        $('#title').val(titles);
                        $('#user_id').val(user_id);
                        $('#project_id').val(project_id);
                        $('#height').val(heights);
                        $('#width').val(widths);
                        $('#length').val(lengths);
                        $('#plot_id').val(plot_ids);
                        $('#plot_parent_id').val(parent_id);
                        $('#submit_plot').hide();
                        $('#update_plot').show();
                    }
                });


                $('#update_plot').click(function() {

                    var plot_id = $('#plot_id').val();
                    // alert(plot_id);
                    var id = $('#id').val();

                    var title = $('#title').val();
                    var height = $('#height').val();
                    var width = $('#width').val();
                    var length = $('#length').val();
                    var parent_id = $('#parent_id').val();
                    // alert(height+' height,,'+title+" title,,"+width+" width,,"+length+" length,,"+parent_id+" parent_id,,");return false;

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/admin/update-plots",
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

                            $('#plot_model').hide();
                            window.location.reload();


                        }
                    });

                    $.ajax({
                        url: "/admin/update-building",
                        type: 'post',
                        data: {
                            'idss': parent_val,
                            'title': title,
                            'height': height,
                            'width': width,
                            'length': length,
                            'parent_id': parent_id,

                            'plot_id': plot_id
                        },
                        success: function(data) {

                            $('#plot_model').hide();
                            window.location.reload();


                        }
                    });
                });
            });
            $('.duplicate').click(function() {
                //    alert('dhfa');
                var plot_parent_id = $('#plot_parent_category').val();
                var plot_id = $('#plot_id').val();
                var building_parent_id = $('#building_parent_id').val();
                var floor_parent_id = $('#floor_child_val').val();
                var floorID = $('#floorID').val();
                var project_revision_id = $('#project_revision_id').val();
                var project_id = $('#pro_id').val();

                // alert(floorID); false;
                var room_parent_id = $('#room_child_val').val();

                var roomID = $('#floor_id').val();
                var building_id = "";
                // var direct_room_id = "";

                // New changes
                var plot_parent_ids = [];
                $('input[name="fav_language[]"]:checked').each(function() {
                    plot_parent_ids[plot_parent_ids.length] = (this.checked ? $(this).val() : "");
                });

                //
                // if($('.child_id:checked')){
                //     var building_id = $('.child_id:checked').val();
                //     // alert(building_id)
                // }
                var building_parent_ids = [];
                var building_ids = [];
                $('input[name="fav_language_b[]"]:checked').each(function() {
                    building_ids[building_ids.length] = (this.checked ? $(this).val() : "");
                    building_parent_ids[building_parent_ids.length] = (this.checked ? $(this).attr("data-id") :
                        "");
                });



                // alert(plot_parent_id);
                // alert(building_parent_id);
                // alert(floor_parent_id);
                // alert(roomID); return false;
                $('#duplicate_show').modal('show');

                $('#duplicate_insert').click(function() {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "/admin/duplicate-record",
                        type: 'post',
                        data: {
                            'plot_parent_ids': plot_parent_ids,
                            'plot_id': plot_id,
                            'building_ids': building_ids,
                            'building_parent_ids': building_parent_ids,
                            'floor_parent_id': floor_parent_id,
                            'floorID': floorID,
                            'room_parent_id': roomID,
                            'project_revision_id': project_revision_id,
                            'project_id': project_id

                        },
                        success: function(data) {
                            console.log(data);
                            if (data == 'error') {
                                $('#duplicate_show').modal('hide');
                                //$('#error_show').modal('show');
                                $('#error_msg').show();
                                $('#duplicate_show').css('display', 'none');
                            } else if (data == 'plot_er') {
                                $('#duplicate_show').modal('hide');
                                //$('#error_show').modal('show');
                                $('#duplicate_error').show();
                                $('#duplicate_error').html('Your Plot maximum limit completed!');
                                $('#duplicate_show').css('display', 'none');
                            } else if (data == 'building_er') {
                                $('#duplicate_show').modal('hide');
                                //$('#error_show').modal('show');
                                $('#duplicate_error').show();
                                $('#duplicate_error').html('Your building limit completed!');
                                $('#duplicate_show').css('display', 'none');
                            } else if (data == 'floor_er') {
                                $('#duplicate_show').modal('hide');
                                //$('#error_show').modal('show');
                                $('#duplicate_error').show();
                                $('#duplicate_error').html('Your floor limit completed!');
                                $('#duplicate_show').css('display', 'none');
                            } else if (data == 'room_er') {
                                $('#duplicate_show').modal('hide');
                                //$('#error_show').modal('show');
                                $('#duplicate_error').show();
                                $('#duplicate_error').html('Your room limit completed!');
                                $('#duplicate_show').css('display', 'none');
                            } else {
                                $('#error_msg').hide();
                                window.location.reload();
                            }

                        }
                    });

                });

            });

            $('.child_id').click(function() {

                var child_val = $(this).val();

                //   alert(child_val);
                var parent_child_val = $(this).attr('vals');
                $('#category')[0].reset();
                $('#plot_parent_id').val('');

                $('#edit_plot').prop('disabled', false);
                $('#delete_project').prop('disabled', false);
                // alert(child_val);return false;

                // floor selected and plot deselected
                floorIsSelected();

                //   if (building_child_val ) {
                //       $('#addbuilding').prop('disabled', true);
                //   }
                //   if (floor_child_val ) {
                //       $('#addfloor').prop('disabled', true);
                //   }


                //   if (room_child_val ) {
                //       $('#addroom').prop('disabled', true);
                //   }
                // alert(building_child_val);

                // newwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww

                $.ajax({

                    url: "/admin/geteditbuilding",
                    type: 'GET',
                    data: {
                        'parent_child_val': parent_child_val,
                    },
                    success: function(data) {
                        //console.log(data.allbuildings);
                        //console.log(data.building_data[0]);

                        var $dropdowns = $(".plotselect");
                        $.each(data.allbuildings, function(key, val) {

                            if (val.title == data.building_data[0].title) {
                                $dropdowns.append($("<option selected/>").val(val.id).text(val
                                    .title));

                                if (data.building_data[0].parent_id == 0) {
                                    $('.floorPlot_heading').text("Plot");
                                } else {
                                    $('.floorPlot_heading').text("Floor");
                                }
                            } else {
                                $dropdowns.append($("<option />").val(val.id).text(val.title));
                                if (data.building_data[0].parent_id == 0) {
                                    $('.floorPlot_heading').text("Plot");
                                } else {
                                    $('.floorPlot_heading').text("Floor");
                                }
                            }

                        });

                    }
                });
                //     // end newwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww

                $.ajax({
                    url: "/admin/tree-child-view",
                    type: 'get',
                    data: {
                        'id': child_val,
                        'parent_child_val': parent_child_val
                    },
                    success: function(data) {
                        console.log(data);

                        var $dropdown = $(".buildingtypeselect");




                        // floor data
                        var floor_id = data.floor[0].id;

                        //   alert(floorID);

                        var floor_title = data.floor[0].title;
                        var floor_number = data.floor[0].floor_number;

                        var parent_id1 = data.floor[0].parent_id;
                        if (data.floor[0].parent_host == 'Building') {
                            // changes
                            $('.room_clear')[0].reset();
                            $('#submit_room').show();
                            $('#update_room').hide();
                            // end changes
                            //hide display buttons
                            $('#addfloor').prop('disabled', true);
                            $('#add_plot').prop('disabled', true);
                            $('#addbuilding').prop('disabled', true);
                            $('#addextroom').prop('disabled', true);
                            $('#addroom').prop('disabled', false);
                            //end hide display buttons
                            $('#building_parent_id').val('');
                            $('#floor_id').val(floor_id);
                            $('#floor_title').val(floor_title);
                            $('#floor_number').val(floor_number);
                            $('#floor_child_val').val(parent_id1);
                            $('#floor_id').val(floor_id);
                            $('#submit_floor').hide();
                            $('#update_floor').show();
                            // newwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww
                            $('#show_floor').show();
                            $('#hide_floor').remove();
                        }
                        // alert(data);
                        // console.log(parent_id1);

                        // building data

                        if (!data.room[0]) {
                            $.each(data.buildingType, function(key, val) {
                                // console.log(data.buildings);

                                if (val.building_type == data.buildings[0].building_type) {
                                    $dropdown.append($("<option selected/>").val(val.building_type)
                                        .text(val.building_type));
                                } else {
                                    $dropdown.append($("<option />").val(val.building_type).text(val
                                        .building_type));
                                }

                            });
                            var buliding_id = data.floor[0].id;
                            var title = data.buildings[0].title;
                            var floor_height = data.buildings[0].floor_height;
                            var number_of_floor = data.buildings[0].number_of_floor;
                            var target_area = data.buildings[0].target_area;
                            var building_type = data.buildings[0].building_type;
                            var plot_idss = data.buildings[0].id;
                            var parent_id2 = data.buildings[0].parent_id;
                            var plot_id_del = data.buildings[0].plot_id;
                            var building_primiry_id = data.buildings[0].plot_id;
                            if (plot_idss) {
                                // changes 
                                $('.floor_clear')[0].reset();
                                $('#submit_floor').show();
                                $('#update_floor').hide();

                                $('.room_clear')[0].reset();
                                $('#submit_room').show();
                                $('#update_room').hide();
                                // end changes
                                //hide display buttons
                                $('#addbuilding').prop('disabled', true);
                                $('#addextroom').prop('disabled', true);
                                $('#add_plot').attr('disabled', 'true');
                                $('#addextroom').attr('disabled', 'true');
                                $('#addfloor').prop('disabled', false);
                                $('#addroom').prop('disabled', false);
                                // end hide display buttons

                                $('#buliding_id').val(buliding_id);
                                $('#building_title').val(title);
                                $('#floor_height').val(floor_height);
                                $('#number_of_floor').val(number_of_floor);
                                $('#target_area').val(target_area);
                                $('#plot_id_del').val(plot_id_del);

                                //   var option = "<option value='" + building_type + "'>" + building_type + "</option>";
                                //   $("#building_type").append(option);
                                $('#building_parent_id').val(parent_id2);
                                $('#plot_idss').val(plot_idss);
                                $('#submit_building').hide();
                                $('#update_building').show();
                                // newwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww
                                $('#building_primiry_id').val(building_primiry_id);
                                $('#show_buildings').show();
                                $('#hide_building').remove();

                                // end newwwwwwwwwwwwwwwwwwwwwwwwwwwwwww
                            }
                        }
                        //data for room

                        var room_id = data.floor[0].id;
                        //   alert(id);
                        var room_title = data.room[0].title;
                        var room_type = data.room[0].room_type;
                        var room_area = data.room[0].room_area;
                        var floor_id = data.room[0].floor_id;
                        var parent_id3 = data.room[0].parent_id;
                        var parent_host = data.room[0].parent_host;
                        var plot_id = data.room[0].plot_id;
                        if (plot_id) {
                            //hide display buttons
                            ///new coding
                            $('#addroom').prop('disabled', true);
                            $('#add_plot').attr('disabled', 'true');

                            $('#addbuilding').prop('disabled', true);
                            $('#addextroom').prop('disabled', true);
                            $('#addfloor').prop('disabled', true);
                            // end hide display buttons

                            // console.log(parent_id3);
                            $('#extroom_id').val(room_id);
                            $('#extroom_title').val(room_title);
                            //    $('#room_type').val(room_type);
                            var $dropdowns = $(".extroomtypeselect");
                            $.each(data.roomType, function(key, val) {
                                if (val.type == 'external') {
                                    if (val.room_type == data.room[0].room_type) {
                                        $dropdowns.append($("<option selected/>").val(val.room_type)
                                            .text(val
                                                .room_type));
                                    } else {
                                        $dropdowns.append($("<option />").val(val.room_type).text(
                                            val
                                            .room_type));
                                    }

                                }



                            });


                            $('#extroom_area').val(room_area);
                            $('#extfloor_id').val(floor_id);
                            $('#extroom_child_val').val('');
                            $('#extroom_child_val').val(parent_id3);
                            $('.plot_add_select_idext').val(parent_id3);

                            $('#submit_extroom').hide();
                            $('#update_extroom').show();
                            $('#number_of_extroom').hide();
                            if (parent_host == 'Plot') {
                                $(".flotFlor_check").val('p');
                            }
                            if (parent_host == 'Floor') {
                                $(".flotFlor_check").val('f');
                            }

                        } else if (floor_id) {
                            //hide display buttons
                            $('#addroom').prop('disabled', true);
                            $('#add_plot').attr('disabled', 'true');

                            $('#addbuilding').prop('disabled', true);
                            $('#addextroom').prop('disabled', true);
                            $('#addfloor').prop('disabled', true);
                            // end hide display buttons

                            // console.log(parent_id3);
                            $('#room_id').val(room_id);
                            $('#room_title').val(room_title);
                            //    $('#room_type').val(room_type);
                            var $dropdowns = $(".roomtypeselect");
                            $.each(data.roomType, function(key, val) {
                                if (val.type == 'normal') {
                                    if (val.room_type == data.room[0].room_type) {
                                        $dropdowns.append($("<option selected/>").val(val.room_type)
                                            .text(val
                                                .room_type));
                                    } else {
                                        $dropdowns.append($("<option />").val(val.room_type).text(
                                            val
                                            .room_type));
                                    }

                                }



                            });
                            $('#room_area').val(room_area);
                            $('#floor_id').val(floor_id);
                            $('#extroom_child_val').val('');
                            $('#room_child_val').val(parent_id3);
                            $('.floor_add_select_id').val(parent_id3);

                            $('#submit_room').hide();
                            $('#update_room').show();
                            $('#number_of_room').hide();
                            if (parent_host == 'Plot') {
                                $(".flotFlor_check").val('p');
                            }
                            if (parent_host == 'Floor') {
                                $(".flotFlor_check").val('f');
                            }
                            // }
                        }
                    }
                });


                $('#update_building').click(function() {


                    var plot_idss = $('#plot_idss').val();
                    var id = $('#id').val();
                    var buliding_id = $('#buliding_id').val();
                    var building_title = $('#building_title').val();
                    var plotselect = $('.plotselect').val();
                    var floor_height = $('#floor_height').val();
                    var number_of_floor = $('#number_of_floor').val();
                    var target_area = $('#target_area').val();
                    var building_type = $('#building_type').val();



                    // alert(buliding_id);return false;

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/admin/update-building",
                        type: 'post',
                        data: {
                            // 'id': child_val,
                            'id': buliding_id,

                            'building_title': building_title,
                            'floor_height': floor_height,
                            'plotselect': plotselect,
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

                    var floor_title = $('#floor_title').val();
                    var floor_number = $('#floor_number').val();
                    var buildingselectId = $('.buildingselect').val();
                    var id = $('#floor_id').val();
                    //   alert(floor_number);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/admin/update-floor",
                        type: 'post',
                        data: {
                            // 'id': child_val,
                            'id': id,
                            'buildingselectId': buildingselectId,
                            'floor_title': floor_title,
                            'floor_number': floor_number
                        },
                        success: function(data) {

                            $('#plot_model').hide();
                            window.location.reload();


                        }
                    });



                });

                $('#update_room').click(function() {

                    var floor_id = $('#floor_id').val();
                    var id = $('#room_id').val();
                    var room_title = $('#room_title').val();
                    var room_area = $('#room_area').val();
                    var room_type = $('.room_type').val();
                    //var room_type = $("input[name='room_type']").val();
                    var flotFlor_check = $('.flotFlor_check').val();
                    //
                    var pro_room = [];
                    $.each($("input[name='floor_room[]']:checked"), function() {
                        pro_room.push($(this).val());
                    });
                    //console.log(room_type);

                    //
                    if ($("input[name='floorPlot']").prop("checked")) { // check if the radio is checked
                        var val = $("input[name='floorPlot']").val(); // retrieve the value

                        if (val == 'floor') {
                            var parent_id = $('select[data-plotFloorId]').val();
                        } else if (val == 'building') {
                            var parent_id = $('.plot_edit_select_id').val();
                        }
                    } else {
                        var parent_id = $('.plot_edit_select_id').val();
                        // alert(parent_id);
                    }
                    // alert(parent_id);return false;

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/admin/update-rooms",
                        type: 'post',
                        data: {
                            // 'id': child_val,
                            'id': id,

                            'room_title': room_title,
                            'room_area': room_area,
                            'floor_id': floor_id,
                            'parent_id': parent_id,
                            'flotFlor_check': flotFlor_check,
                            'room_type': room_type,
                            'pro_room': pro_room
                        },
                        success: function(data) {

                            $('#room_model').hide();
                            window.location.reload();


                        }
                    });



                });



                $('#update_extroom').click(function() {

                    var floor_id = $('#floor_id').val();
                    var id = $('#extroom_id').val();
                    var room_title = $('#extroom_title').val();
                    var room_area = $('#extroom_area').val();
                    var room_type = $('.extroom_type').val();
                    //var room_type = $("input[name='room_type']").val();
                    var flotFlor_check = $('.flotFlor_check').val();
                    //
                    var pro_room = [];
                    $.each($("input[name='floor_room[]']:checked"), function() {
                        pro_room.push($(this).val());
                    });
                    //console.log(room_type);

                    //
                    if ($("input[name='floorPlot']").prop("checked")) { // check if the radio is checked
                        var val = $("input[name='floorPlot']").val(); // retrieve the value

                        if (val == 'floor') {
                            var parent_id = $('select[data-plotFloorId]').val();
                        } else if (val == 'building') {
                            var parent_id = $('.plot_edit_select_id').val();
                        }
                    } else {
                        var parent_id = $('.plot_edit_select_id').val();
                        // alert(parent_id);
                    }
                    // alert(parent_id);return false;

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/admin/update-extrooms",
                        type: 'post',
                        data: {
                            // 'id': child_val,
                            'id': id,

                            'room_title': room_title,
                            'room_area': room_area,
                            'floor_id': floor_id,
                            'parent_id': parent_id,
                            'flotFlor_check': flotFlor_check,
                            'room_type': room_type,
                            'pro_room': pro_room
                        },
                        success: function(data) {

                            $('#extroom_model').hide();
                            window.location.reload();


                        }
                    });



                });

            });
            $('#delete_tree_project').click(function() {

                var parent_val = $('#plot_parent_category').val();
                // New changes
                var plot_parent_ids = [];
                $('input[name="fav_language[]"]:checked').each(function() {
                    plot_parent_ids[plot_parent_ids.length] = (this.checked ? $(this).val() : "");
                });

                //
                // alert('parent_val id = '+parent_val); return false;
                if ($(".parent_id").is(":checked")) {
                    // alert('flot delte'); return false;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/admin/delete-plots",
                        type: 'post',
                        data: {
                            'plot_parent_ids': plot_parent_ids,
                        },
                        success: function(data) {
                            $('#delete_rocord_show').hide();
                            window.location.reload();
                        }
                    });
                }
            });


            $('#delete_tree_project').click(function() {
                var child_val = $('#building_parent_id').val();
                var floor_val = $('#floor_child_val').val();
                var room_child_val = $('#floor_id').val();
                var plot_id_del = $('#plot_id_del').val();
                //
                var building_parent_ids = [];
                var building_ids = [];
                $('input[name="fav_language_b[]"]:checked').each(function() {
                    building_ids[building_ids.length] = (this.checked ? $(this).val() : "");
                    building_parent_ids[building_parent_ids.length] = (this.checked ? $(this).attr("data-id") :
                        "");
                });
                //
                // alert(child_val+' child_val,,'+floor_val+" floor_val,,"+room_child_val+" room_child_val,,"+plot_id_del+" plot_id_del,,");return false;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/admin/delete-child",
                    type: 'post',
                    data: {
                        'id': child_val,
                        'floor_val': floor_val,
                        'room_child_val': room_child_val,
                        'plot_id_del': plot_id_del,
                        'building_ids': building_ids,
                        'building_parent_ids': building_parent_ids
                    },
                    success: function(data) {
                        if (data == 'error') {
                            $('#error_msg1').show();
                            $('#delete_rocord_show').hide();
                        } else {
                            $('#delete_rocord_show').hide();
                            window.location.reload();
                        }



                    }
                });


            });

            $('#delete_project').click(function() {
                //   alert('HI');
                $('#delete_rocord_show').modal('show');

            });
        </script>
        <!--//-------------------------------------------------------3D----------------------------------------------------------------------------------//-->
        <script>
            $(function() {

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })


                $(".togglecheckbox").click(function() {
                    if ($('.togglecheckbox').is(":checked")) {
                        $('.btn-block').attr('disabled', false);
                        $(".tree input:checkbox").attr("disabled", false); // Disable
                        $(".underprocess").addClass('d-none'); // Disable


                        @if (file_exists(public_path() .
                                    '/' .
                                    $sitesettings->fbxfilepath .
                                    '/' .
                                    $segment_users .
                                    '_' .
                                    $csv_counter .
                                    '_' .
                                    $u_name .
                                    '.fbx') ||
                                file_exists(public_path() .
                                        '/' .
                                        $sitesettings->pdffilepath .
                                        '/' .
                                        $segment_users .
                                        '_' .
                                        $csv_counter .
                                        '_' .
                                        $u_name .
                                        '.pdf') ||
                                file_exists(public_path() .
                                        '/' .
                                        $sitesettings->dwgfilepath .
                                        '/' .
                                        $segment_users .
                                        '_' .
                                        $csv_counter .
                                        '_' .
                                        $u_name .
                                        '.dwg'))





                            swalWithBootstrapButtons.fire({
                                title: 'Are you sure?',
                                text: "Files related to this project will be lost!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'No, cancel!',
                                reverseButtons: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $(".fa-unlock").css('display', 'block'); // Disable
                                    $(".fa-lock").css('display', 'none'); // Disable

                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                                'content')
                                        }
                                    });

                                    $.ajax({
                                        url: "/admin/removeprojectfiles",
                                        type: 'post',
                                        data: {
                                            'user': '{{ $u_name }}',
                                            'version': '{{ request()->segment(4) }}',
                                            'project_id': '{{ $segment_users }}',
                                        },
                                        beforeSend: function() {
                                            swalWithBootstrapButtons.fire({
                                                title: 'Please wait work under process...',
                                                showConfirmButton: false,
                                            });
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            swalWithBootstrapButtons.fire(
                                                'Deleted!',
                                                'Files are deleted.',
                                                'success'
                                            )

                                            location.reload();

                                        }
                                    });






                                } else if (
                                    /* Read more about handling dismissals below */
                                    result.dismiss === Swal.DismissReason.cancel
                                ) {

                                    $('.togglecheckbox').prop('checked', false); // Unchecks it
                                    $('.btn-block').attr('disabled', true);
                                    $(".tree input:checkbox").attr("disabled", true); // Disable
                                    // swalWithBootstrapButtons.fire(
                                    //                     'Deleted!',
                                    //                     'Files are deleted.',
                                    //                     'success'
                                    //                     )
                                }
                            })
                        @else

                            $(".fa-unlock").css('display', 'block'); // Disable
                            $(".fa-lock").css('display', 'none'); // Disable

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                                url: "/admin/removeprojectfiles",
                                type: 'post',
                                data: {
                                    'user': '{{ $u_name }}',
                                    'version': '{{ request()->segment(4) }}',
                                    'project_id': '{{ $segment_users }}',
                                },
                                dataType: 'json',
                                beforeSend: function() {
                                    swalWithBootstrapButtons.fire({
                                        title: 'Please wait work under process...',
                                        showConfirmButton: false,
                                    });
                                },
                                success: function(response) {
                                    swalWithBootstrapButtons.fire(
                                        'Unloced!',
                                        'Project has been unlocked.',
                                        'success'
                                    )

                                }
                            });
                        @endif
                    } else {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: "/admin/lockfile",
                            type: 'post',
                            data: {
                                'project_id': '{{ $segment_users }}',
                            },
                            dataType: 'json',
                            beforeSend: function() {
                                swalWithBootstrapButtons.fire({
                                    title: 'Please wait work under process...',
                                    showConfirmButton: false,
                                });
                            },
                            success: function(response) {
                                // swalWithBootstrapButtons.fire(
                                //         'Locked!',
                                //         'Project has been locked.',
                                //         'success'
                                //         )


                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                            'content')
                                    }
                                });
                                var parent_val = $('#pro_id').val();
                                var project_revision_id = $('#project_revision_id').val();

                                $.ajax({

                                    url: "/admin/exportCsv",
                                    type: 'GET',
                                    data: {
                                        'project_id': parent_val,
                                        'project_revision_id': project_revision_id
                                    },
                                    success: function(data) {
                                        //console.log(data);
                                        //window.location.href = "{{ url('/admin/view-csv-file') }}";

                                        Swal.fire(
                                            'Success!',
                                            'Files generated successfully.',
                                            'success'
                                        )
                                        location.reload();

                                    }
                                });

                            }
                        });

                        $('.btn-block').attr('disabled', true);
                        $(".tree input:checkbox").attr("disabled", true); // Disable
                    }
                })


                if ($('.togglecheckbox').is(":checked")) {
                    $('.btn-block').attr('disabled', false);
                    $(".tree input:checkbox").attr("disabled", false); // Disable

                } else {
                    $('.btn-block').attr('disabled', true);
                    $(".tree input:checkbox").attr("disabled", true); // Disable
                }
            });


            var container = document.getElementById('container');
            var view = document.getElementById('main_viewer');
            // alert(view);
            if (!Detector.webgl) Detector.addGetWebGLMessage();

            var camera, camerHelper, scene, renderer, loader,
                stats, controls, transformControls, numOfMeshes = 0,
                model, modelDuplicate, sample_model, wireframe, mat, scale, delta;

            const manager = new THREE.LoadingManager();

            var modelLoaded = false,
                sample_model_loaded = false;
            var modelWithTextures = false,
                fbxLoaded = false,
                gltfLoaded = false;;
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
            var animations = {},
                animationsSelect = document.getElementById("animationSelect"),
                animsDiv = document.getElementById("anims"),
                mixer, currentAnimation, actions = {};

            //X-RAY SHADER MATERIAL
            //http://free-tutorials.org/shader-x-ray-effect-with-three-js/
            var materials = {
                default_material: new THREE.MeshLambertMaterial({
                    side: THREE.DoubleSide
                }),
                default_material2: new THREE.MeshLambertMaterial({
                    side: THREE.DoubleSide
                }),
                wireframeMaterial: new THREE.MeshPhongMaterial({
                    side: THREE.DoubleSide,
                    wireframe: true,
                    shininess: 100,
                    specular: 0x000,
                    emissive: 0x000,
                    flatShading: false,
                    depthWrite: true,
                    depthTest: true
                }),
                wireframeMaterial2: new THREE.LineBasicMaterial({
                    wireframe: true,
                    color: 0xffffff
                }),
                wireframeAndModel: new THREE.LineBasicMaterial({
                    color: 0xffffff
                }),
                phongMaterial: new THREE.MeshPhongMaterial({
                    color: 0x555555,
                    specular: 0xffffff,
                    shininess: 10,
                    flatShading: false,
                    side: THREE.DoubleSide,
                    skinning: true
                }),
                xrayMaterial: new THREE.ShaderMaterial({
                    uniforms: {
                        p: {
                            type: "f",
                            value: 3
                        },
                        glowColor: {
                            type: "c",
                            value: new THREE.Color(0x84ccff)
                        },
                    },
                    vertexShader: document.getElementById('vertexShader').textContent,
                    fragmentShader: document.getElementById('fragmentShader').textContent,
                    side: THREE.DoubleSide,
                    blending: THREE.AdditiveBlending,
                    transparent: true,
                    depthWrite: false
                })
            };

            var clock = new THREE.Clock();
            var winDims = [window.innerWidth * 0.8, window.innerHeight * 0.89]; //size of renderer

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
                renderer = new THREE.WebGLRenderer();
                // renderer.setPixelRatio(window.devicePixelRatio);
                renderer.setSize(window.innerWidth / 2, window.innerHeight)
                renderer.setClearColor(0x292121); //565646, 29212

                view.appendChild(renderer.domElement);

                THREEx.WindowResize(renderer, camera);

                function toggleFullscreen(elem) {
                    elem = elem || document.documentElement;
                    if (!document.fullscreenElement && !document.mozFullScreenElement &&
                        !document.webkitFullscreenElement && !document.msFullscreenElement) {

                        THREEx.FullScreen.request(container);

                    } else {
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

                document.getElementById('fullscreenBtn').addEventListener('click', function() {
                    toggleFullscreen();
                });

                ambient = new THREE.AmbientLight(0x404040);
                $('#ambient_light').change(function() {
                    if (amb.checked) {
                        scene.add(ambient);
                    } else {
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

                transformControls.addEventListener('mouseDown', function() {
                    controls.enabled = false;
                });
                transformControls.addEventListener('mouseUp', function() {
                    controls.enabled = true;
                });

                window.addEventListener('keydown', function(event) {

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
                    change: function(color) {
                        $("#basic_log").text("Hex Colour Selected: " + color.toHexString()); //Log information
                        var bg_value = $(".bg_select").spectrum('get').toHexString(); //Get the colour selected
                        renderer.setClearColor(bg_value); //Set renderer colour to the selected hex value
                        ssaaRenderPass.clearColor = bg_value;
                        document.body.style.background =
                            bg_value; //Set body of document to selected colour           
                    }
                });

                // postprocessing    
                var renderPass = new THREE.RenderPass(scene, camera);

                var fxaaPass = new THREE.ShaderPass(THREE.FXAAShader);
                var pixelRatio = renderer.getPixelRatio();

                fxaaPass.material.uniforms['resolution'].value.x = 1 / (window.innerWidth * pixelRatio);
                fxaaPass.material.uniforms['resolution'].value.y = 1 / (window.innerHeight * pixelRatio);
                fxaaPass.renderToScreen = true;

                outlinePass = new THREE.OutlinePass(new THREE.Vector2(window.innerWidth, window.innerHeight), scene, camera);
                outlinePass.edgeStrength = 1.5;
                outlinePass.edgeGlow = 2;

                composer = new THREE.EffectComposer(renderer);
                composer.addPass(renderPass);
                composer.addPass(outlinePass);
                composer.addPass(fxaaPass);

                /*LOAD SAMPLE MODELS*/
                var modalname = thiiii;
                // alert(modalname);
                var modal_extention = modalname.split('.').pop();
                //   alert(modal_extention);
                if (modal_extention == 'fbx' || modal_extention == 'FBX') {
                    var sceneInfo = modelList[index]; //index from array of sample models in html select options
                    loader = new THREE.FBXLoader(manager);
                    var url = sceneInfo.url;
                } else {
                    var sceneInfo = modelList[index]; //index from array of sample models in html select options
                    loader = new THREE.OBJLoader(manager);
                    var url = sceneInfo.url;
                }
                // alert(url);

                //progress/loading bar
                var onProgress = function(data) {
                    if (data.lengthComputable) { //if size of file transfer is known
                        var percentage = Math.round((data.loaded * 100) / data.total);
                        console.log(percentage);
                        statsNode.innerHTML = 'Loaded : ' + percentage + '%' + ' of ' + sceneInfo.name +
                            '<br>' +
                            '<progress value="0" max="100" class="progress"></progress>';
                        $('.progress').css({
                            'width': percentage + '%'
                        });
                        $('.progress').val(percentage);
                    }
                }
                var onError = function(xhr) {
                    console.log('ERROR');
                };

                loader.load(url, function(data) {

                    sample_model = data;
                    sample_model_loaded = true;

                    console.log(sample_model);

                    sample_model.traverse(function(child) {
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


                $('#transform').on('change', function() {

                    if (transform.checked) {
                        document.getElementById('transformKey').style.display = 'block';
                        if (modelLoaded) {
                            transformControls.attach(model);
                        } else if (sample_model_loaded) {
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
                controls
                    .reset(); //Reset controls, for when previous object has been moved around e.g. larger object = larger rotation
                statsNode.innerHTML = ''; //Reset stats box (faces, vertices etc)

                $("#red, #green, #blue, #ambient_red, #ambient_green, #ambient_blue").slider("value",
                    127); //Reset colour sliders

                amb.checked = false;
                rot1.checked = false;
                wire.checked = false;
                model_wire.checked = false;
                phong.checked = false;
                xray.checked = false;
                glow.checked = false;
                grid.checked = false;
                polar_grid.checked = false;
                axis.checked = false;
                bBox.checked = false;
                smooth.checked = false;
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

            $('#remove').click(function() {
                removeModel();
            });

            $("#red, #green, #blue, #ambient_red, #ambient_green, #ambient_blue").slider({
                change: function(event, ui) {
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
                slide: function(event, ui) {
                    rotation_speed = rotVal[ui.value]; //Set speed variable to the current selected value of slider
                }
            });

            $('#rotation').change(function() {
                if (rot1.checked) {
                    rotation_speed = rotVal[$("#rot_slider").slider("value")];
                    //set the speed to the current slider value on initial use
                    controls.autoRotate = true;

                    $("#rot_slider").slider({
                        disabled: false,
                        change: function(event, ui) {
                            console.log(rotVal[ui.value]);
                            controls.autoRotate = true;
                            controls.autoRotateSpeed = delta * rotation_speed;
                        }
                    });
                } else {
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
            let thiiii = <?php echo $objvalues; ?>;
            //  alert(thiiii);
            let modelList = [{
                    name: "'" + thiiii + "'",
                    url: '../../../{{ $sitesettings->fbxfilepath }}/' + thiiii + ''
                },
                // {
                //     name: "bear.obj", url: '../../../3D_Model_viwer/sample_models/2_Alex.obj'
                // },
                // {
                //     name: "car.obj", url: '../../../3D_Model_viwer/sample_models/car2.obj'
                //     //, objectRotation: new THREE.Euler(0, 3 * Math.PI / 2, 0)

                // },
                // {
                //     name: "tiger.obj", url: '../../../3D_Model_viwer/sample_models/Tiger.obj'
                // },
                // {
                //     name: "dinosaur.obj", url: '../../../3D_Model_viwer/sample_models/Dinosaur_V02.obj'
                // },
                // {
                //     name: "skeleton.obj", url: '../../../3D_Model_viwer/3D_Model_viwersample_models/skeleton.obj'
                // }
            ];
            // alert(modelList);
            // console.log(modelList);
            function switchScene(index) {

                clear();
                initScene(index);
                var elt = document.getElementById('scenes_list');
                elt.selectedIndex = index;

            }

            $(document).ready(function() {

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
            $('.downloadcsv').click(function() {
                //$('revesion_id')

                //$('#revesion_id').val($("#csv_file_list option:selected").val());
            })
            $('.downloadjson').click(function() {
                //$('revesion_id')

                ///$('#revesion_id_json').val($("#csv_file_list option:selected").val());
            })
            $(function() {

                $('.glyphicon-plus-sign').click();

            });
            // form submit on change
            $("#csv_file_list").change(function() {
                var r_id = $("#csv_file_list").find(':selected').data('revision');
                var p_id = $("#pro_id").val();

                window.location.href = "{{ url('/admin/project-trees/') }}/" + p_id + '/' + r_id;
            })
            //
            $("#add_floor").click(function() {
                $("#floor_type").val('a_floor');
            })
            $("#add_basement").click(function() {
                $("#floor_type").val('b_floor');
            })
            $("#add_roof").click(function() {
                $("#floor_type").val('r_floor');
            })
            // Rename file
            $('.file_rename').click(function() {


                $("#rename-modal").modal('show');
                $("#rename-text").val($("#csv_file_list option:selected").text());
                $("#file_id").val($("#csv_file_list").find(':selected').data('id'));


            });
            $('.close_rename_modal').click(function() {
                window.location.reload();
            })

            function copyToClipboard(element) {
                var $temp = $("<input>");
                $("body").append($temp);
                //var file_path = ;

                $("#p1").html($("#csv_file_list").find(':selected').data('path'));
                $temp.val($(element).text()).select();
                document.execCommand("copy");
                $temp.remove();
            }

            function copyToClipboard2(element) {
                var $temp = $("<input>");
                $("body").append($temp);
                //var file_path = ;

                $("#p2").html($("#csv_file_list").find(':selected').data('path').replaceAll("csv", 'json'));
                $temp.val($(element).text()).select();
                document.execCommand("copy");
                $temp.remove();
            }

            function copyToClipboard3(element) {
                var $temp = $("<input>");
                $("body").append($temp);
                //var file_path = ;

                $("#p3").html($("#csv_file_list").find(':selected').data('path').replaceAll("csv", 'pdf'));

                $temp.val($(element).text()).select();
                document.execCommand("copy");
                $temp.remove();
            }

            function copyToClipboard4(element) {
                var $temp = $("<input>");
                $("body").append($temp);
                //var file_path = ;

                $("#p4").html($("#csv_file_list").find(':selected').data('path').replaceAll("csv", 'fbx'));
                $temp.val($(element).text()).select();
                document.execCommand("copy");
                $temp.remove();
            }

            function copyToClipboard5(element) {
                var $temp = $("<input>");
                $("body").append($temp);
                //var file_path = ;

                $("#p5").html($("#csv_file_list").find(':selected').data('path').replaceAll("csv", 'dwg'));
                $temp.val($(element).text()).select();
                document.execCommand("copy");
                $temp.remove();
            }
            onload();
        </script>
        <script type='text/javascript'>
            $('#updategenconMod').each(function() {
                if ($('#manualcheck').prop('checked')) {
                    genConMod();
                }
            });


            $(document).ready(function() {


                // Department Change
                $('.f1').change(function() {
                    $('#roomlist').find('option').remove();
                    // Department id
                    $("#roomlist").empty();
                    var id = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/admin/getRoom",
                        type: 'post',
                        data: {
                            'id': id

                        },
                        dataType: 'json',
                        success: function(response) {

                            var len = 0;
                            if (response['data'] != null) {
                                len = response['data'].length;
                            }

                            if (len > 0) {
                                // Read data and create <option >

                                for (var i = 0; i < len; i++) {

                                    var id = response['data'][i].id;
                                    var name = response['data'][i].title;

                                    //var option = "<option value='"+id+"'>"+name+"</option>"; 
                                    var option = "<option  value='" + id + "'> " + name +
                                        "</option>";
                                    $("#roomlist").append(option);
                                    $("#room_area").val(response['data'][i].room_area);
                                }
                            }

                        }
                    });
                    // Empty the dropdown

                });
                $('.p1').change(function() {
                    $('#roomlist').find('option').remove();
                    // Department id
                    $("#roomlist").empty();

                    $('#extroomlist').find('option').remove();
                    // Department id
                    $("#extroomlist").empty();
                    var id = $(this).val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/admin/getPlotRoom",
                        type: 'post',
                        data: {
                            'id': id

                        },
                        dataType: 'json',
                        success: function(response) {

                            var len = 0;
                            if (response['data'] != null) {
                                len = response['data'].length;
                            }

                            if (len > 0) {
                                // Read data and create <option >

                                for (var i = 0; i < len; i++) {

                                    var id = response['data'][i].id;
                                    var name = response['data'][i].title;

                                    //var option = "<option value='"+id+"'>"+name+"</option>"; 
                                    var option = "<option  value='" + id + "'> " + name +
                                        "</option>";
                                    $("#roomlist").append(option);
                                    $("#room_area").val(response['data'][i].room_area);
                                    $("#extroomlist").append(option);
                                    $("#extroom_area").val(response['data'][i].room_area);
                                }
                            }

                        }
                    });
                    // Empty the dropdown

                });
                // room type
                $('.room_type').change(function() {
                    $('#room_type ').find('option').remove();
                    // Department id
                    var id = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/admin/getRoomArea",
                        type: 'post',
                        data: {
                            'id': id

                        },
                        dataType: 'json',
                        success: function(response) {

                            var len = 0;
                            if (response['data'] != null) {
                                len = response['data'].length;
                            }

                            if (len > 0) {
                                // Read data and create <option >
                                for (var i = 0; i < len; i++) {



                                    $("#room_area").val(response['data'][i].room_area);
                                }
                            }
                        }
                    });
                    // Empty the dropdown

                });
                // building type

                $('.buildingtypeselect').change(function() {
                    //$('#building_type').find('option').remove();
                    // Department id
                    var id = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/admin/getBuildingTypesArea",
                        type: 'post',
                        data: {
                            'id': id

                        },
                        dataType: 'json',
                        success: function(response) {

                            var len = 0;
                            if (response['data'] != null) {
                                len = response['data'].length;
                            }

                            if (len > 0) {
                                // Read data and create <option >
                                for (var i = 0; i < len; i++) {
                                    $("#floor_height").val(response['data'][i].floor_height);
                                    $("#number_of_floor").val(response['data'][i].number_of_floor);
                                    $("#target_area").val(response['data'][i].target_area);

                                }
                            }
                        }
                    });
                    // Empty the dropdown

                });

                $("#tree1").find('.floor_class').closest('ul').addClass('sortableList');

                $(".sortableList").sortable({
                    revert: true,
                    /*update: function (event, ui) {
                        // Some code to prevent duplicates
                    }*/
                    stop: function(event, ui) {
                        //console.log(ui.item.find(".floor_class").val());
                        let floor_ids = [];
                        $(ui.item.closest("ul").find('.ui-sortable-handle')).each(function() {
                            console.log($(this).find('.floor_class').val());
                            floor_ids.push($(this).find('.floor_class').val());
                        })
                        console.log(floor_ids)
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "/admin/postFloorSort",
                            type: 'post',
                            data: {
                                'floor_ids': floor_ids

                            },
                            success: function(response) {

                            }
                        });
                    }
                });
                $(".draggable").draggable({
                    connectToSortable: '.sortableList',
                    cursor: 'pointer',
                    helper: 'clone',
                    revert: 'invalid'
                });

                $('.error_message').click(function() {
                    $('.error_message_area').show();
                })
                var expanded = false;
            });

            function showCheckboxes() {
                var checkboxes = document.getElementById("checkboxes");
                if (!expanded) {
                    roomlist.style.display = "block";
                    expanded = true;
                } else {
                    roomlist.style.display = "none";
                    expanded = false;
                }
            }

            function genConMod() {
                $('#load1').removeClass('1234').addClass('loader');
                var project_revision_id = document.getElementById("provisionID").value;
                var project_id = document.getElementById("projectID").value;

                $.ajax({
                    type: 'GET',
                    url: '/admin/generate-Json',
                    data: {
                        'project_revision_id': project_revision_id,
                        'project_id': project_id
                    },
                    success: function(response) {
                        location.reload();
                        setTimeout(function() {
                            checkMsgBarData();
                            disable_button();
                        }, 2000);
                        // alert(response);
                        // $('#resultjson').html(response)
                        //  $('#load1').removeClass('loader').addClass('1234');
                    }
                })
            }

            function GenDetailedM() {
                $('#fbx2_load1').removeClass('1111').addClass('loader');
                var project_revision_id = document.getElementById("provisionID").value;
                var project_id = document.getElementById("projectID").value;


                $.ajax({
                    type: 'GET',
                    url: '/admin/gen-detail-model',
                    data: {
                        'project_revision_id': project_revision_id,
                        'project_id': project_id
                    },
                    success: function(response) {
                        setTimeout(function() {
                            checkMsgBarData();
                        }, 2000);
                        // alert(response);
                        //$('#resultfbx').html(response)
                        //$('#load2').removeClass('loader').addClass('1234');
                    }
                })

            }

            var project_id = document.getElementById("project_id22").value;


            function genDwgs() {
                $('#dwg_load1').removeClass('1111').addClass('loader');
                var project_revision_id = document.getElementById("provisionID").value;
                var project_id = document.getElementById("projectID").value;

                $.ajax({
                    type: 'GET',
                    url: '/admin/gen-dwg',
                    data: {
                        'project_revision_id': project_revision_id,
                        'project_id': project_id
                    },
                    success: function(response) {
                        setTimeout(function() {
                            checkMsgBarData();
                        }, 2000);
                        // alert(response);
                        //$('#resultfbx').html(response)
                        //$('#load2').removeClass('loader').addClass('1234');
                    }
                })
            }

            function genpdf() {
                $('#pdf_load1').removeClass('1111').addClass('loader');
                var project_revision_id = document.getElementById("provisionID").value;
                var project_id = document.getElementById("projectID").value;
                //alert(project_id);


                $.ajax({
                    type: 'GET',
                    url: '/admin/gen-pdf',
                    data: {
                        'project_revision_id': project_revision_id,
                        'project_id': project_id
                    },
                    success: function(response) {
                        // alert(response);
                        setTimeout(function() {
                            checkMsgBarData();
                        }, 2000);
                        //$('#resultfbx').html(response)
                        //$('#load2').removeClass('loader').addClass('1234');
                    }
                })
            }

            function makeCompleted(key) {
                if (key == 0) {
                    $('#load1').removeClass('loader');
                    if ($('#msgBar_gcm').attr("data-allowReload") == 1) {
                        //location.reload();
                    }
                } else if (key == 1) {
                    $('#fbx2_load1').removeClass('loader');
                    if ($('#msgBar_gdm').attr("data-allowReload") == 1) {
                        //location.reload();
                    }
                } else if (key == 2) {
                    $('#dwg_load1').removeClass('loader');
                    if ($('#msgBar_gdd').attr("data-allowReload") == 1) {
                        //  location.reload();
                    }
                } else {
                    $('#pdf_load1').removeClass('loader');
                    if ($('#msgBar_gpd').attr("data-allowReload") == 1) {
                        // location.reload();
                    }
                }

            }

            function resetLoading(results) {
                $.each(results, function(key, val) {
                    if (val == 100) {
                        //stop this loader
                        makeCompleted(key)
                    }
                });
            }

            function checkMsgBarData() {
                var project_revision_id = document.getElementById("provisionID").value;
                var project_id = document.getElementById("projectID").value;
                $.ajax({
                    type: 'GET',
                    url: '/admin/update-msg-bar',
                    data: {
                        'project_revision_id': project_revision_id,
                        'project_id': project_id
                    },
                    success: function(response) {
                        var result = $.parseJSON(response);
                        resetLoading(result);
                        $('#msgBar_gcm').html(result[0]);
                        $('#msgBar_gcm').val(result[0]);
                        $('#msgBar_gcm').css({
                            "width": result[0] + '%'
                        });
                        $('#msgBar_gdm').html(result[1]);
                        $('#msgBar_gdm').val(result[1]);
                        $('#msgBar_gdm').css({
                            "width": result[1] + '%'
                        });
                        $('#msgBar_gdd').html(result[2]);
                        $('#msgBar_gdd').val(result[2]);
                        $('#msgBar_gdd').css({
                            "width": result[2] + '%'
                        });
                        $('#msgBar_gpd').html(result[3]);
                        $('#msgBar_gpd').val(result[3]);
                        $('#msgBar_gpd').css({
                            "width": result[3] + '%'
                        });

                    }
                })
            }
            checkMsgBarData();
            setInterval(function() {
                checkMsgBarData();
            }, 10 * 1000);
            if (history.scrollRestoration) {
                history.scrollRestoration = 'manual';
            } else {
                window.onbeforeunload = function() {
                    window.scrollTo(0, 0);
                }
            }
        </script>
    @endsection
