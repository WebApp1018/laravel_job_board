@extends('layouts.admin')
@section('styles')
<script src="https://unpkg.com/konva@9.2.3/konva.min.js"></script>
<style>
    /* #sketch_canvas::-webkit-scrollbar {
        display: none;
    } */

</style>
@endsection
@section('content')
<div class="content">
    <?php 
        $mode='all';
        $plot_types=[
            (object)['id_plot' => 1, 'plot_type' => 'Residental'],
            (object)['id_plot' => 1, 'plot_type' => 'Commercial']
        ];
        $building_types=[
            (object)['id' => 1, 'building_type' => 'Villa'],
        ];
        $room_types=[
            (object)['id'=>1, 'type'=>'normal', 'room_type' => 'Bedroom'],
            (object)['id'=>2, 'type'=>'normal', 'room_type' => 'Saloon'],
            (object)['id'=>3, 'type'=>'normal', 'room_type' => 'Bathroom'],
            (object)['id'=>4, 'type'=>'normal', 'room_type' => 'Balcony'],
            (object)['id'=>5, 'type'=>'normal', 'room_type' => 'Master Bedroom'],
            (object)['id'=>6, 'type'=>'normal', 'room_type' => 'Living Room'],
            (object)['id'=>7, 'type'=>'external', 'room_type' => 'Hardscape'],
            (object)['id'=>8, 'type'=>'external', 'room_type' => 'Softscape'],
            (object)['id'=>9, 'type'=>'external', 'room_type' => 'Parking'],
            (object)['id'=>10, 'type'=>'external', 'room_type' => 'garden'],
            (object)['id'=>11, 'type'=>'stack', 'room_type' => 'Elevator'],
            (object)['id'=>12, 'type'=>'stack', 'room_type' => 'Stair'],
        ];
    ?>
    @if (session()->has('message'))
    <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium">
            <strong>Congratulation!</strong> {{ session()->get('message') }}
        </div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
    @endif
    <div id="notice">
    </div>
    <div class="flex mb-4 gap-6">
        <button class="flex rounded-full h-10 px-4 items-center hover:bg-neutral-600 hover:text-white gap-3 {{ $mode == 'all' ? 'bg-black text-white' : 'bg-white text-neutral-500' }}" onclick="location.href='{{ route('admin.home', ['mode' => 'all']) }}'">
            <i class="fa-solid fa-eye"></i>
            <span class="text-base">All Projects</span>
        </button>
        <button class="flex rounded-full h-10 px-4 items-center hover:bg-neutral-600 hover:text-white gap-3 {{ $mode == 'sketch' ? 'bg-black text-white' : 'bg-white text-neutral-500' }}" onclick="location.href='{{ route('admin.home', ['mode' => 'sketch']) }}'">
            <i class="fa-solid fa-eye"></i>
            <span class="text-base">Sketch Mode</span>
        </button>
        <button class="flex rounded-full h-10 px-4 items-center hover:bg-neutral-600 hover:text-white gap-3 {{ $mode == 'data' ? 'bg-black text-white' : 'bg-white text-neutral-500' }}" onclick="location.href='{{ route('admin.home', ['mode' => 'data']) }}'">
            <i class="fa-solid fa-eye"></i>
            <span class="text-base">Data Mode</span>
        </button>
    </div>
    <div class="container-fluid">

        <div class="grid 2xl:grid-cols-4 xl:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-10">
            <div class="rounded-xl bg-rose-100 min-h-96 flex justify-center items-center">
                <button class="bg-[#FF0000] text-white hover:bg-red-600 hover:text-gray-200 rounded-full" data-te-toggle="modal" data-te-target="#create_project_modal">
                    <i class="text-[50px] w-[50px] fa-solid fa-square-plus m-12 text-center"></i>
                </button>
            </div>
            @include('partials.create_project_modal')
            
            @foreach ($allProject as $project)
            <?php
                    $p_revision_id = 1;
                    $project_revision_id = \App\ProjectRevision::where(['project_id' => $project->id])
                        ->latest('id')
                        ->first();
                    if (isset($project_revision_id->revision)) {
                        $p_revision_id = $project_revision_id->revision;
                    }
                    ?>

            <div class="relative bg-white rounded-xl overflow-hidden shadow-md hover:shadow-2xl hover:-mt-1">
                <img class="w-full" src="/assets/img/sketch_mode.png" />
                <div class="py-2 px-4 flex items-center">
                    <div class="flex-1 py-2">
                        <div class="text-lg font-semibold truncate">
                            {{ $project->project_name ?? '' }}
                        </div>
                        <span class="text-neutral-500 text-sm">
                            <i class="fa fa-calendar"></i>
                            {{ $project->updated_at }}
                        </span>
                    </div>

                    <div class="relative" data-te-dropdown-ref>
                        <button class="rounded-full hover:bg-neutral-100 w-10 h-10 flex justify-center items-center" id="projectMenu{{ $project->id }}" data-te-dropdown-toggle-ref
                            aria-expanded="false"
                            data-te-ripple-init
                            data-te-ripple-color="light">
                            <i class="fas fa-angle-down p-3"></i>
                        </button>

                        <div aria-labelledby="projectMenu{{ $project->id }}" class="absolute z-[1000] float-left m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block"
                            data-te-dropdown-menu-ref>
                            <ul class="py-2 overflow-y-auto text-gray-700 dark:text-gray-200">
                                <li class="parent_id decoration-none flex items-center px-4 h-12 hover:bg-gray-100 text-black text-lg cursor-pointer border-b-2" updateId="{{ $project->id }}">
                                    <i class="fa-regular fa-pen-to-square text-red-500 w-10"></i>
                                    Edit
                                </li>
                                <li class="destroy_project decoration-none flex items-center px-4 h-12 hover:bg-gray-100 text-black text-lg cursor-pointer" deleteId="{{ $project->id }}">
                                    <i class="fa-solid fa-trash-can text-red-500 w-10"></i>
                                    Delete
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- <p class="card-category">Performance</p> -->
                </div>
                <div class="px-4">
                    <p class="text-neutral-500 h-[70px] overflow-hidden">{{ $project->description ?? '' }}</p>
                    <div class="py-2 text-sm">
                        <div class="flex justify-between">
                            <span>Project Progress</span>
                            <span>70%</span>
                        </div>
                        <div class="py-3">
                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 overflow-hidden">
                                <div class="bg-rose-500 h-2.5" style="width: {{ '70%' }};"></div>
                            </div>
                        </div>
                    </div>
                    <button class="w-full rounded-md bg-neutral-700 hover:bg-neutral-800 py-2.5 text-white text-md mb-4" onclick="location.href='/admin/project-trees/{{ $project->id }}/{{ $p_revision_id }}'">
                        View
                    </button>

                </div>
                <span class="absolute top-4 left-5 rounded-full border text-[#13816B] bg-emerald-100 text-sm px-2.5 py-0.5">Data Mode</span>
                {{-- @if ($project->mode == 'Sketch')
                <span class="absolute top-4 left-5 rounded-full border text-[#13816B] bg-emerald-100 text-sm px-2.5 py-0.5">{{ $project->mode }}
                    Mode</span>
                @else
                <span class="absolute top-4 left-5 rounded-full border text-[#ED0000] bg-rose-100 text-sm px-2.5 py-0.5">{{ $project->mode }}
                    Mode</span>
                @endif --}}
            </div>

            <input type="hidden" editId="{{ $project->id }}" class="p_id">
            @endforeach

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
                    <div class="w3-col s6 w3-center" style="width:40%">
                        <!-- <p>Obejct ID</p> -->
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
                        <label><b>Location</b></label>
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <input class="form-control" type="text" name="location" placeholder="Location" required="" id="location">
                        </div>
                        <br>
                        <label class="d-none"><b>Current Revision</b></label>
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }} d-none">
                            <input value="1" class="form-control" type="text" name="current_revision" placeholder="Current Revision" required="" id="">
                        </div>
                        <br>
                        <label><b>Project Description</b></label>
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <textarea maxlength="702" class="form-control" type="text" name="description" id="description" placeholder="you can write upto 700 characters" required="" rows="6" cols="50"></textarea>
                        </div>

                        <!-- <div class="w3-col s6 w3-center w3-green" style="width: 48%;position: relative;"> -->
                        <button type="close" id="close" class="btn btn-danger" data-dismiss="modal" style="width: 48%;position: relative;" onclick="event.preventDefault();">Close1</button>
                        <!-- </div> -->



                        <button class="w3-btn w3-green" id="create_project" style="width: 48%;position: relative;left:20px;"> Create
                            Project</button>


                        <button type="button" class="w3-btn w3-green update_project" id="update_project" style="width: 48%;position: relative;left:20px;display:none"> update Project</button>
                    </div>

                    <div class="w3-container w3-padding-hor-16 ">

                    </div>
                </form>
            </div>
        </div>



    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/konvaSketch.js') }}"></script>
{{-- <script>
        var new_project_mode;
        function set_new_project_mode(mode) {
            new_project_mode = mode;
        }
    </script> --}}
@endsection
