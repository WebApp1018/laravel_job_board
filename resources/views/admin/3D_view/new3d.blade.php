<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="icon" type="image/png" href="assets/images/3dviewer_net_favicon.ico">

    <title>Online 3D Viewer</title>

    <!-- website libs start -->
    <link rel="stylesheet" type="text/css" href="{{ asset('3dviewer/libs/pickr.monolith.min.css') }}">
    <script type="text/javascript" src="{{ asset('3dviewer/libs/pickr.es5.min.js') }}"></script>
    <!-- website libs end -->

    <!-- meta start -->
    <!-- meta end -->

    <!-- website start -->
    <link rel="stylesheet" type="text/css" href="{{ asset('3dviewer/website/css/icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('3dviewer/website/css/themes.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('3dviewer/website/css/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('3dviewer/website/css/controls.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('3dviewer/website/css/dialogs.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('3dviewer/website/css/treeview.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('3dviewer/website/css/panelset.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('3dviewer/website/css/navigator.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('3dviewer/website/css/sidebar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('3dviewer/website/css/website.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('3dviewer/website/css/embed.css') }}">
    <script type="text/javascript" src="{{ asset('3dviewer/build/o3dv.website.min-dev.js') }}"></script>
    <!-- website end -->
    <style>
        #header{
            display: none;
        }
    </style>

<script>
    function getQueryParams(qs) {
qs = qs.split('+').join(' ');

var params = {},
    tokens,
    re = /[?&]?([^=]+)=([^&]*)/g;

while (tokens = re.exec(qs)) {
    params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
}

return params;
}




</script>
    <!-- analytics start -->
    <script type="text/javascript">
        OV.SetWebsiteEventHandler ((eventName, eventLabel, eventParams) => {

            if(eventName=='model_loaded'){
                var query = getQueryParams(document.location.search);

                    if(query.sidebar=='hide'){

                        var divsToHide = document.getElementsByClassName("ov_panel_set_menu"); //divsToHide is an array
                        divsToHide[0].style.visibility = "hidden"; // or
                        divsToHide[0].style.display = "none"; // depending on what you're doing
                    }

                    if(query.navigationlist=='hide'){

                        var divsToHide = document.getElementsByClassName("ov_panel_set_content ov_thin_scrollbar"); //divsToHide is an array
                        divsToHide[0].style.visibility = "hidden"; // or
                        divsToHide[0].style.display = "none"; // depending on what you're doing
                    }
                    // if(query.sidebar=='hide' &&  query.navigationlist=='hide'){
                    //     var divsToHide = document.getElementsByClassName("main_navigator"); //divsToHide is an array
                    //     divsToHide[0].style.visibility = "hidden"; // or
                    //     divsToHide[0].style.display = "none"; // depending on what you're doing
                    // }

                    if(query.dpanel=='hide'){

                        var divsToHide = document.getElementsByClassName("ov_sidebar_title"); //divsToHide is an array
                        divsToHide[0].style.visibility = "hidden"; // or
                        divsToHide[0].style.display = "none"; // depending on what you're doing

                        var divsToHide = document.getElementsByClassName("ov_sidebar_content"); //divsToHide is an array
                        divsToHide[0].style.visibility = "hidden"; // or
                        divsToHide[0].style.display = "none"; // depending on what you're doing

                    }
                    if(query.sidebartwo=='hide'){

                        var divsToHide = document.getElementsByClassName("ov_panel_set_menu"); //divsToHide is an array
                        divsToHide[1].style.visibility = "hidden"; // or
                        divsToHide[1].style.display = "none"; // depending on what you're doing
                    }

                    var rate = document.getElementsByClassName('icon icon-up_z')[0];
                    rate.click();

            }
            //alert("yes");
            console.log ({
                eventName : eventName,
                eventLabel : eventLabel,
                eventParams : eventParams
            });
        });
    </script>
    <!-- analytics end -->

    <!-- website init start -->
    <script type="text/javascript">
        OV.StartWebsite ('../libs');
    </script>
    <!-- website init end -->

    <!-- script start -->
    <!-- script end -->

</head>

<body>
    <input type="file" id="open_file" style="display:none;" multiple></input>
    <div class="header" id="header">
        <div class="title">
            <div class="title_left">
                <a href="index.html">
                    <svg class="logo_image"><use href="assets/images/3dviewer_net_logo_text.svg#logo"></use></svg>
                </a>
            </div>
            <div class="title_right" id="header_buttons"></div>
            <div class="main_file_name only_full_width" id="main_file_name"></div>
        </div>
        <div class="toolbar" id="toolbar"></div>
    </div>
    <div class="main" id="main">
        <div class="main_navigator ov_panel_set_container only_full_width" id="main_navigator"></div>
        <div class="main_splitter only_full_width" id="main_navigator_splitter"></div>
        <div class="main_viewer" id="main_viewer"></div>
        <div class="main_splitter only_full_width" id="main_sidebar_splitter"></div>
        <div class="main_sidebar ov_panel_set_right_container only_full_width" id="main_sidebar"></div>
    </div>
    <div class="intro ov_thin_scrollbar" id="intro">
        <div class="intro_section only_full_width only_full_height">
            <svg class="intro_logo"><use href="assets/images/3dviewer_net_logo.svg#logo"></use></svg>
        </div>
        <div class="intro_section intro_big_text">
            Drag and drop 3D models here.<br>
            <b>obj, 3ds, stl, ply, gltf, 3dm, fbx
                
                {{-- <a target="_blank" href="info/index.html">and more</a> --}}
            </b>
        </div>
        <div class="intro_section">
            {{-- <div>Example models:</div> --}}
            {{-- <div class="example_models">
                <a href="index.html#model=assets/models/solids.obj,assets/models/solids.mtl">solids</a>
                <span style="color:#aaaaaa;"> | </span>
                <a href="index.html#model=assets/models/car.glb">car</a>
                <span style="color:#aaaaaa;"> | </span>
                <a href="index.html#model=assets/models/DamagedHelmet.glb">helmet</a>
            </div> --}}
        </div>
        <!-- intro start -->
        <!-- intro end -->
    </div>

</body>

</html>
