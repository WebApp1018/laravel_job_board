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
    {{-- <link href="../../../assets/css/bootstrap.min.css" rel="stylesheet" /> --}}
    {{-- <link href="../../../assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" /> --}}

    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" /> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v6.4.2/css/all.css" rel="stylesheet" />

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

    {{-- <link rel="stylesheet" href="https://flowbite.com/docs/flowbite.css?v=2.2.0a"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/w3-css/4.1.0/3/w3.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js">
    </script>
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                fontFamily: {
                    sans: ["Roboto", "sans-serif"],
                    body: ["Roboto", "sans-serif"],
                    mono: ["ui-monospace", "monospace"],
                },
            },
            corePlugins: {
                preflight: false,
            },
        };
    </script>
    @yield('styles')
    <style type="text/css">
        .modal-backdrop {
            position: relative !important;
            top: 0;
        }

        .sidebar:after,
        body>.navbar-collapse:after {
            background: #ebc1c1 !important;
            background-size: 150% 150%;
            z-index: 3;
            opacity: 1;
        }

        .decoration-none {
            text-decoration: none !important;
        }
    </style>
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed pace-done sidebar-lg-show">
    <div id="fullscreen" class="hidden absolute w-screen h-screen p-6 z-[10000]">

    </div>

    <div class="flex bg-gray-100">
        @include('partials.menu')

        <div class="flex-1">
            <div class="h-screen flex flex-col">

                <div class="flex text-light-text-grey items-center justify-between px-4 py-6">
                    <div
                        class="rounded-full bg-white shadow-md flex-1 flex flex-row items-center justify-between box-border px-2 mx-4 h-16">
                        <input type="text" class="flex-1 px-4 border-transparent active:border-transparent"
                            placeholder='Try searching "NewProducts"' />
                        <i
                            class="text-xl fas fa-search hover:bg-gray-200 w-12 h-12 flex justify-center items-center rounded-full"></i>
                    </div>
                    <div
                        class="flex rounded-full bg-white shadow-md h-16 w-fit text-black items-center cursor-pointer mx-4 pr-2">

                        <div
                            class="rounded-full bg-black h-16 w-16 overflow-hidden font-semibold text-white flex items-center justify-center">
                            34
                        </div>
                        <div class="px-3">
                            Remaining Credits
                        </div>
                    </div>
                    <button
                        class="h-16 w-16 rounded-full flex justify-center items-center bg-white text-black mx-4 shadow-md cursor-pointer hover:bg-black hover:text-white">
                        <i class="fa-regular fa-bell text-2xl"></i>
                    </button>
                    <div class="relative" data-te-dropdown-ref>
                        <button
                            class="flex rounded-full bg-white shadow-md h-16 w-fit min-w-[10%] text-black items-center justify-between mx-4 cursor-pointer relative"
                            type="button" id="dropdownMenuButton1" data-te-dropdown-toggle-ref aria-expanded="false"
                            data-te-ripple-init data-te-ripple-color="light">
                            <i class="fas fa-angle-down p-3"></i>

                            <div class="flex-1 font-semibold text-center px-3">
                                {{ Auth::user()->name }}
                            </div>
                            <div
                                class="rounded-full bg-black h-16 w-16 overflow-hidden font-semibold text-white flex items-center justify-center">
                                {{ Auth::user()->name[0] }}
                            </div>
                        </button>
                        <ul class="absolute z-[1000] float-left m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block"
                            aria-labelledby="dropdownMenuButton1" data-te-dropdown-menu-ref>
                            <li>
                                <a href="/admin/projectSetting"
                                    class="decoration-none flex items-center px-4 h-16 hover:bg-gray-100 text-black text-lg">
                                    <i class="text-xl fas w-10 fa-user text-red-500"></i>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="decoration-none flex items-center px-4 h-16 hover:bg-gray-100 text-black text-lg"
                                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                    <i class="fas w-10 text-xl text-red-500 fa-sign-out-alt"></i>
                                    {{ trans('global.logout') }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    
                </div>
                <div class="px-8 flex-1 overflow-scroll">
                    @yield('content')
                </div>
                <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>

        </div>

    </div>
    <div id="floor_model" class="w3-modal">
        <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
            <div class="w3-center">
                <br>
                <h1>Delete project!</h1>
                <p style="width: 100%;max-width: 454px;margin: auto;font-size: 19px;">Are you sure you want to delete
                    your project?</p>
            </div>

            <div class="w3-container">
                <div class="w3-section">

                    <div class="w3-col s6 w3-center " style="width: 40%;position: relative;left: 16px;">
                        <a href="/" rel="modal:close" style="padding: 14px;"> <button
                                class="w3-btn w3-btn-block w3-red" style="padding: 14px;">
                                Cancel</button></a>
                    </div>
                    <div class="w3-col s6 w3-center w3-green" style="width: 40%;position: relative;left: 70px;">
                        @if (!empty($allProject) && count($allProject))
                            <button class="w3-btn w3-btn-block w3-green destroy_project"
                                deleteId="{{ $project->id }}" style="padding: 14px;">
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
    {{-- 
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
</footer> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-switch.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script> --}}
    <script type="text/javascript">
        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.disableAutoInline = true;
            CKEDITOR.addCss('img {max-width:100%; height: auto;}');
            var editor = CKEDITOR.replace('editor2', {
                extraPlugins: 'easyimage,image2',
                removePlugins: 'image',
                height: 250,
            });
            CKFinder.setupCKEditor(editor);

        } else {
            document.getElementById('editor2').innerHTML =
                '<div class="tip-a tip-a-alert">This sample requires working Internet connection to load CKEditor 4 from CDN.</div>'
        }
    </script>
    <script>
        $(function() {
            let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
            let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
            let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
            let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
            let printButtonTrans = '{{ trans('global.datatables.print') }}'
            let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'

            let languages = {
                'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
            };

            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
                className: 'btn'
            })
            $.extend(true, $.fn.dataTable.defaults, {
                language: {
                    url: languages.{{ app()->getLocale() }}
                },
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }, {
                    orderable: false,
                    searchable: false,
                    targets: -1
                }],
                select: {
                    style: 'multi+shift',
                    selector: 'td:first-child'
                },
                order: [],
                scrollX: true,
                pageLength: 100,
                dom: 'lBfrtip<"actions">',
                buttons: [{
                        extend: 'copy',
                        className: 'btn-default',
                        text: copyButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn-default',
                        text: csvButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn-default',
                        text: excelButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-default',
                        text: pdfButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn-default',
                        text: printButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        className: 'btn-default',
                        text: colvisButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });

            $.fn.dataTable.ext.classes.sPageButton = '';
        });
    </script>
    <script type="text/javascript">
        $('.parent_id').click(function() {
            alert('ok');

            var parent_val = $(this).attr('updateId');
            $(this).parent().parent().removeClass('block');
            $(this).parent().parent().addClass('hidden');
            $('#id01').modal('show');
            $('.update_project').val(parent_val);
            // update_project

            //   alert(parent_val);
            $.ajax({
                url: "/admin/user-project",
                type: 'GET',
                data: {
                    'id': parent_val
                },
                success: function(data) {
                    var project_name = data[0].project_name;
                    var description = data[0].description;
                    var location = data[0].location;
                    var current_revision = data[0].current_revision;
                    $('#project_name').val(project_name);
                    $('#description').val(description);
                    $('#location').val(location);
                    $('#current_revision').val(current_revision);
                    $('#update_project').show();
                    $('#create_project').hide();

                }
            });

        });

        // $('.edit_plot').click(function() {

        //     var plot_val = $(this).val();
        //     // $('#submit_floor').hide();
        //     $('#plot_model').show();
        //     // $('#update_floor').show();
        //      alert(plot_val);
        //     $.ajax({
        //         url: "/admin/plot-type",
        //         type: 'GET',
        //         data: {
        //             'id': plot_val
        //         },
        //         success: function(data) {
        //             console.log(data[0].plot_type);
        //             var plot_type = data[0].plot_type;
        //             $('#plot_type').val(plot_type);
        //         }
        //     });

        // });


        $('#add_Project').click(function() {
            $('#id01').modal('show');;
        });

        $('#update_project').click(function() {

            // var id = $('this').attr('editId');
            var id = $('.update_project').val();

            // alert(id);


            var project_name = $('#project_name').val();
            var description = $('#description').val();
            var location = $('#location').val();
            var current_revision = $('#current_revision').val();
            var status = 0;
            // alert(description);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/update-project",
                type: 'post',
                data: {
                    'id': id,
                    'project_name': project_name,
                    'description': description,
                    'location': location,
                    'current_revision': current_revision
                },
                success: function(data) {



                    location.reload();

                    //  alert(data);
                    //  console.log(data);  
                }
            });
        });


        $(function() {
            $("#btnClosePopup").click(function() {
                $("#MyPopup").modal("hide");
            });
        });

        $('#close').click(function() {
            location.reload();
        });
        $('.delete_pro').click(function() {
            // var id = $(this).attr('ids');
            $('#floor_model').modal('show');
            // alert(id);

            // // alert(description);
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            // $.ajax({
            //     url: "/admin/delete-project",
            //     type: 'post',
            //     data: {
            //         'id': id
            //     },
            //     success: function(data) {
            //         //  alert(data);
            //          setTimeout(function() {
            //      window.location.reload();
            //   }, 1000);
            //             $("#notice").html('<div class="alert alert-warning"<strong>Successfully !</strong> Project deleted.</div>').fadeOut(5000);
            //                  parent.fadeOut('slow', function() {$(this).remove();});
            //     }
            // });
        });

        $('.delete_faq').click(function() {
            var id = $(this).attr('roomtype');
            // alert(id);

            // alert(description);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/delete-faqs",
                type: 'post',
                data: {
                    'id': id
                },
                success: function(data) {
                    //  alert(data);
                    //  alert("Are you sure?");

                    location.reload();
                    // console.log(data);  
                }
            });
        });



        $('.delete_subscription').click(function() {
            var id = $(this).attr('roomtype');
            // alert(id);

            // alert(description);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/delete-subscriptions",
                type: 'post',
                data: {
                    'id': id
                },
                success: function(data) {
                    //  alert(data);
                    //  alert("Are you sure?");

                    location.reload();
                    // console.log(data);  
                }
            });
        });




        $('.delete_blog').click(function() {
            var id = $(this).attr('roomtype');
            // alert(id);

            // alert(description);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/delete-blog",
                type: 'post',
                data: {
                    'id': id
                },
                success: function(data) {
                    //  alert(data);
                    //  alert("Are you sure?");

                    location.reload();
                    // console.log(data);  
                }
            });
        });


        $('.delete_room').click(function() {
            var id = $(this).attr('roomtype');
            // alert(id);

            // alert(description);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/delete-room",
                type: 'post',
                data: {
                    'id': id
                },
                success: function(data) {
                    //  alert(data);
                    //  alert("Are you sure?");

                    location.reload();
                    // console.log(data);  
                }
            });
        });

        $('.delete_plot').click(function() {
            var id = $(this).attr('plottype');
            // alert(id);return false;

            // alert(description);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/delete-plot",
                type: 'post',
                data: {
                    'id': id
                },
                success: function(data) {
                    //  alert(data);
                    //  alert("Are you sure?");

                    location.reload();
                    // console.log(data);  
                }
            });
        });


        $('.delete_building').click(function() {
            var id = $(this).attr('buildingtype');


            // alert(description);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/delete-building",
                type: 'post',
                data: {
                    'id': id
                },
                success: function(data) {
                    //  alert(data);
                    //  alert("Are you sure?");

                    location.reload();
                    // console.log(data);  
                }
            });
        });


        $('.destroy').click(function() {
            $('#floor_model').modal('show');
        });

        $('.destroy_project').click(function() {
            var id = $(this).attr('deleteId');
            // alert(id);
            // alert(description);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/delete-project",
                type: 'post',
                data: {
                    'id': id
                },
                success: function(data) {
                    window.location.reload();

                    // $("#notice").html('<div class="alert alert-warning"<strong>Successfully !</strong> Project deleted.</div>').fadeOut(5000);
                    //      parent.fadeOut('slow', function() {$(this).remove();});

                    // console.log(data);  
                }
            });
        });




        $("#description").keyup(function() {
            var countChar = this.value.length;
            console.log(countChar);
            if (countChar > 700) {
                alert('you can write upto 700 characters');
                $("textarea#description").css({
                    border: "2px solid red"
                });

            }

        });
    </script>
    @yield('scripts')
</body>

</html>
