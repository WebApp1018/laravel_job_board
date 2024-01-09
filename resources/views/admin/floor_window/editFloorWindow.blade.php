<head>
      <title>Hierarchical building App Tree View</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <link href="{{ asset('css/treeview.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="http://www-db.deis.unibo.it/courses/TW/DOCS/w3schools/lib/w3.css">
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    .dashbord{
        margin: 10px 0 30px 0px;
    }
    .bi-speedometer2{
        margin: 0 15px 1px 0px;
    }
    .bi-hospital{
        margin: 0 15px 1px 0px;
    }
    .bi-person-rolodex{
        margin: 0 15px 1px 0px;   
    }
    .bi-building{
        margin: 0 15px 1px 0px;   
    }
    .bi-person-rolodex{
        margin: 0 15px 1px 0px;   
    }
    .bi-box-arrow-right{
        margin: 0 15px 1px 0px;   
    }
    .a-tag{
    
        font-family: monospace;
        text-decoration: none;
        text-decoration: none;
        color: black;
        text-transform: uppercase;
        line-height: 30px;
        font-size: 14px;
        font-weight: 550;
    }

    .dev-first{
        background-size: cover;
        background-color: #ecc7c7;
        background-blend-mode: overlay;
    }








    .con {
        border: 1px solid;
        border-radius: 10px;
        margin-top: 10px;
        width: 100%;
        border-color: gray;
        background-image: url('../images/2\ \(1\).jpg');
    }
    .edit{
        border: 1px solid;
        border-radius: 5px;
        background-color: white;
        text-align: center;
    }
    .pl {
        display: flex;
        margin-bottom: 20px;
    }

    .wid {
        margin: 20px 0px 0px 50px;

    }

    .inp {
        margin-left: 50px;
        border-radius: 5px;
        border: 0.5px solid gray;
    }

    .inp2 {
        margin-left: 43px;
        border-radius: 5px;
        border: 0.5px solid gray;
    }

    .inp1 {
        margin-left: 10px;
        border-radius: 5px;
        border: 0.5px solid gray;
    }

    .tot {
        margin: 31px 0 0 49px;
    }

    .per {
        margin-left: 30px;
    }

    .sel {
        margin-left: 40px;
        width: 100px;
        height: 25px;
        border-radius: 5px;
    }

    .sel2 {
        margin-left: 25px;
        width: 100px;
        height: 24px;
        border-radius: 5px;
    }

    .sel3 {
        margin: 5px 0 0 30px;
    }

    .bi {
        margin-left: 20px;
    }

    .p2 {
        display: flex;
    }

    .p6 {
        display: flex;
        width: 98%;
        height: 40px;
        align-items: center;
        margin-left: 10px;
        border: 1px solid grey;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .p3 {
        margin: 6px 0 0 20px;
    }

    .bi-plus-circle {
        margin: 6px 0px 0px 30px;
    }

    .p5 {
        margin-left: 20px;
    }

    .sell {
        margin-left: 40px;
        width: 120px;
        height: 25px;
        border-radius: 5px;
        border-color: gray;
        color: gray;
    }
    .sell1 {
        margin-left: 36px;
        width: 130px;
        height: 25px;
        border-radius: 5px;
        border-color: gray;
        color: gray;
    }
    .sell2 {
        margin-left: 25px;
        width: 120px;
        height: 24px;
        border-radius: 5px;
        border: 0.5px solid gray;
        color: gray;
    }
    .sell4 {
        margin-left: 40px;
        width: 120px;
        height: 25px;
        border-radius: 5px;
        border-color: gray;
        color: gray;
    }

    .sell3 {
        margin-left: 25px;
        width: 120px;
        height: 24px;
        border-radius: 5px;
        border: 0.5px solid gray;
        color: gray;
    }
    .sell8 {
        margin-left: 25px;
        width: 120px;
        height: 24px;
        border-radius: 5px;
        border: 0.5px solid gray;
        color: gray;
    }
    .p7 {
        display: flex;
        margin-left: 10px;
        margin-bottom: 20px;
    }


    .con1 {
        border: 1px solid;
        border-radius: 10px;
        margin-top: 10px;
        height: 300px;
        width: 100%;
        border-color: gray;
        background-image: url('../images/2\ \(1\).jpg');
    }

    .button {
        float: right;
        height: 25px;
        width: 120px;
        border-radius: 10px;
        margin: 10px 4px 10px 0px;
        border: none;
        box-shadow: 0px 0px 3px 0px;
        background-color: white;
    }

    p {
        font-size: 20px;
        align-items: center;
        justify-content: center;
        color: gray;
    }
    .per15{
        margin: 15px 0 0 70px;
    }
    .slider {
        margin: 7px 0 0 0px;
        width: 100%;
        height: 10px;
        border-radius: 5px;
        background: #d3d3d3;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;
    }
    .slider1 {
        margin: 8px 0 0 0px;
        width: 100%;
        height: 10px;
        border-radius: 5px;
        background: #d3d3d3;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;
    }
    .slider:hover {
        opacity: 1;
    }
    
    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 23px;
        height: 24px;
        border: 0;
        background: url('clock.png');
        cursor: pointer;
    }
    .piechart {
        display: block;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background-image: conic-gradient( lightblue 0 235deg, orange 0);

    }

    .piechart {
        display: flex;

    }
    .slidecontainer{
        margin: 0px 0 0 34px;
    }
    .slidecontainer1{
        margin: 19px 0 0 34px;
    }
    body{
        background: bisque;
        width: 100%;
        margin: auto;


        
    }
    form{
        width: 100%;
        margin: auto;
    
    }
    label,input{
        color: gray;
    }
    .raw{
        margin-left: 300px;
        color: red;
        margin-top: 40px;
    }
    .slidecontainer{
        display: flex;
    }
    .slidecontainer1{
        display: flex;
    }
    .mm{
        display: flex;
    }
    .mm1{
        display: flex;

    }
    .mm2{
        margin-left: 10px;
        display: flex;
        width: 40px;
    }
    .per2{
        margin: 19px 0 0 42px;
    }
    .percentage{
        margin-top: 0;
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
    .toggle-btn input[type="checkbox"]:hover + label:after  {
        box-shadow: 0 2px 15px 0 #0002, 0 3px 8px 0 #0001;
    }
    .toggle-btn input[type="checkbox"]:checked + label:before {
    background: #007bff;
    }
    .toggle-btn input[type="checkbox"]:checked + label:after {
    background: #fff;
    left: 21px;
    }
    .bi-trash-fill:hover{
        cursor: pointer;
    }
    .main-roof{
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    @media only screen and (max-width: 1090px) {
        .p6 {
        display: contents;
        margin-top: 0px;
        }
        .slider{
            margin: 8px 0 0 0px;
            width: auto;
            display: flex;
        }
        .slider1{
            margin: 8px 0 0 0px;
            width: auto;
            display: flex;
        }
        .mm2{
            margin: 0px 0 0 20px;
        }
        .mm{
            margin: 15px 0px 18px 77px;
        }
        .mm1{
            display: inline-flex;
        }
    .sel3{
        display: block;
    }
  }
  @media only screen and (max-width: 500px){
    .sell{
        margin: 0;
    }
    .sell2{
        margin-left: 15px;
    }
    .sell3{
        margin-left: 64px;
    }
    .sell4{
        margin-left: 15px;
    }
    .bi-exclamation-triangle{
        margin-left: 18px;
    }
    .slider{
        margin: 8px 0 0 0px;
        width: auto;
        display: flex;
    }
    
    .p7{
        
        display: block;
        margin-left: -8px;
        
    }
    .per1{
        margin-left: 39px;
    }
    .piechart{
        margin-left: 40px;
    }
    .bi-exclamation-triangle{
        float: right;
        margin-right: 10px;
    }
    .raw{
        margin: 0;
    }
  }

  
  
      </style>
   </head>
@extends('layouts.admin')
@section('content')
@can('user_create')
    
@endcan
@if(session()->has('message'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Congratulation!</strong>    {{ session()->get('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
@endif  
@if(session()->has('error'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Oops!</strong>    {{ session()->get('error') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
@endif
<div class="card">
    <div class="card-body">
        <div>
            <form style="" method="post" action="{{ Route('admin.update.floor.window')}}">
            @csrf
                <input type="hidden" id="project_id" name="project_id" value="{{  app('request')->input('pid') }}">
                <input type="hidden" id="project_revision_id" name="project_revision_id" value="{{  app('request')->input('rid') }}">
                <input type="hidden" id="building_parent_id_val" name="building_parent_id_val" value="{{ $dataaa['plot'][0]->id }}">
                <input type="hidden" id="floor_number" name="floor_number" value="0">
               
                <div class="" id="plot_perameters">
                    <p class="per">Parameters</p>
                    <div class="pl">
                        <select name="building_id" id="plot" class="sell">
                        <?php  $i=0;   ?>
                            @foreach($dataaa['buildings'] as $building)
                                <?php
                                if(isset($_GET['bid'])){

                                    if($building->id == $_GET['bid']){
                                        $bid = $i;
                                    }
                                }else{
                                    $bid= 0;
                                }
                                ?>
                                <option value="{{ $building->id }}" {{isset($_GET['bid']) && $_GET['bid'] == $building->id ? 'selected' : ''}}>{{ $building->title }}</option>
                            <?php    $i = $i+1;     ?>
                            @endforeach
                        </select>
                        <div class="p2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                            <p class="p5"><a id="addFloor" style="text-decoration:none ;color:gray;cursor: pointer;">Add Floor</a></p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                            <p class="p5"> <a id="addBasement" style="text-decoration:none ;color:gray;cursor: pointer;">Add Basement</a></p>
                            <!-- Default switch -->
                            <p class="p5">
                                <div class="custom-control custom-switch d-flex align-items-center">
                                    <label class="" for="addRoof">Add Roof</label>
                                    <div class="toggle-btn ml-2">
                                        <input type="checkbox" <?php echo count($dataaa['buildings'][$bid]['roof']) > 0 ? 'checked':''?> class="" name="roof" id="addRoof"/>
                                        <label></label>
                                    </div>
                                </div>
                            </p>
                        </div>
                        
                    </div>
                </div>
                            <?php 
                                $i=1;   
                                $totalroof = count($dataaa['buildings'][$bid]['roof']);
                            ?>

                            @if($totalroof)
                                @foreach($dataaa['buildings'][$bid]['roof'] as $roof)
                                    <div class="con roof" style=""  class="id-{{$roof->id}}">
                                    <p class="per">Roof Floors</p>
                                        <div id="container1">
                                                <section id="mainsection1">
                                                    <div id="container">
                                                        <section id="mainsection" class="d-flex ">
                                                        <div class="text-center px-3 main-roof roof-number">{{count($dataaa['buildings'][$bid]['floor'])}}</div>
                                                            <div class="p6" >
                                                                <svg class="removeRoof" onclick="deleteroof({{$roof->id}});"  xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                                </svg>
                                                                <input type="hidden" name="roof_id" id="roof_id" value="{{$roof->id}}">
                                                                    <span class="ms-3 roof-title">{{$roof->title}}</span>
                                                                </div>
                                                        </section>
                                                    </div>
                                                </section>
                                            <?php $i=$i+1; ?>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                <div class="con roof " style="display:none;">
                                    <p class="per">Roof Floors</p>
                                    <div id="container1">
                                        <section id="mainsection1">
                                            <div id="container">
                                                <section id="mainsection" class="d-flex">
                                                    <div class="text-center px-3 main-roof roof-number">{{count($dataaa['buildings'][$bid]['floor'])}}</div>
                                                    <div class="p6" >
                                                        <svg class="removeRoof" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                        </svg>
                                                        <span class="ms-3">Roof</span>
                                                    </div>
                                                </section>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            @endif
                        <div class="con">
                            <p class="per">Above Ground Floors</p>
                            <?php 
                                $i=1;   
                                $totalFloor = count($dataaa['buildings'][$bid]['floor']);
                            ?>

                            @if($totalFloor)
                            <div id="ground-floor" data-floor="{{$totalFloor}}">
                            @foreach($dataaa['buildings'][$bid]['floor'] as $key => $floor)
                            <?php
                            //   echo "<pre>";
                            //   print_r($floor);
                            ?>
                                    <section   class="id-{{$floor->id}}">
                                        <div>
                                            <section class="floor{{$i}} floorid-{{ $floor->id }} d-flex">
                                            <div class="text-center px-3 main-roof">{{$key}}</div>
                                                <div class="p6" >
                                                    <svg class="remove" data-id="{{$i}}" xmlns="http://www.w3.org/2000/svg" onclick="deleteExtroom({{$floor->id}});" width="26" height="26" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                    <input type="hidden" name="groundFloor[no][]" value="{{$i}}">   
                                                    <input type="hidden" name="groundFloor[id][]" value="{{$floor->id}}">   
                                                    <span class="ms-3">Floor {{$i}}</span>
                                                </div>
                                            </section>
                                        </div>
                                    </section>
                                    <?php $i=$i+1; ?>
                                    @endforeach
                                </div>
                                    @else
                            <div id="ground-floor" data-floor="0"></div>
                        @endif
          </div>
        <div class="con">
            <p class="per">Basement Floors</p>
            <?php  
                                $i=1;   
                                $totalBasement = count($dataaa['buildings'][$bid]['basement']);
                            ?>
                            @if($totalBasement)
                            <div id="basement-floor" data-basement="{{$totalBasement}}">
                                @foreach($dataaa['buildings'][$bid]['basement'] as $key => $basement)
                            
                                <section  class="id-{{$basement->id}}">
                                    <div >
                                        <section class="basement{{$i}} baseid-{{ $basement->id }} d-flex">
                                        <div class="text-center px-3 main-roof">{{$basement->floor_number}}</div>
                                            <div class="p6" >
                                                <svg class="remove" data-id="{{$i}}" xmlns="http://www.w3.org/2000/svg" onclick="deleteExtroom({{$basement->id}});" width="26" height="26" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                                <input type="hidden" name="groundbasement[no][]" value="{{$i}}">   
                                                <input type="hidden" name="groundbasement[id][]" value="{{$basement->id}}">   
                                                <span class="ms-3">Basement {{$i}}</span>
                                            </div>
                                        </section>
                                    </div>
                                </section>
                                <?php $i=$i+1; ?>
                                @endforeach
                            </div>
                       @else
                    <div id="basement-floor" data-basement="0"></div>
                @endif

            </div>
            <input type="submit" value="Update floor" class="button">
            </form>
        </div>
      </div>
    </div>
</div>
@section('scripts')
@parent
<script>

    

     function deleteExtroom(id) {
        console.log('run');
        $.ajax({
            url: "/admin/delete/plot/extroom",
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id
            },
            success: function (data) {

                    $(`.id-${id}`).remove();

                console.log(data);
            }
        });
        // console.log(id);
    }

    function deleteroof(id) {
        $.ajax({
            url: "/admin/delete/plot/extroom",
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id
            },
            success: function (data) {

                    $(`#roof_id`).remove();
                    $(`.roof-title`).html('');
                    $(`.roof-title`).html('Roof');

                console.log(data);
            }
        });
        // console.log(id);
    }
    
$("#plot").on("change", function($event) {
    let id = $(this).val();
    let currentLocation = window.location +'&bid='+ id;

    var url = new URL(currentLocation);
    url.searchParams.set('bid', id);
    $event.preventDefault();
    window.location.href = url.href;
});

$("#addRoof").change(function() {
    if(this.checked) {
        $('.roof').show();
        $('#addRoof').attr('checked', 'checked');
    }else{
        $('.roof').hide();
        $( "#addRoof").removeAttr('checked');
    }
});

$(".removeRoof").click(function(){
    $('.roof').hide();
    $( "#addRoof").removeAttr('checked');
});

$("#addFloor").click(function(){
    var count =  $('#ground-floor').attr("data-floor");
        count = parseInt(count)+1;
        $("#ground-floor").append(`
                    <section>
                        <div>
                            <section class="floor ${count} d-flex">
                            <div class="text-center px-3 main-roof">${count-1}</div>
                            <div class="p6" >
                                <svg class="remove removefloor${count}" data-id="${count}" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-trash-fill " viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg>
                                 <input type="hidden" name="groundFloor[no][]" value="${count}">   
                                <span class="ms-3">Floor ${count}</span>
                            </div>
                        </section>
                        </div>
                    </section>
        `);
        $('#floor_number').val(count);
        $('#ground-floor').attr("data-floor",count);
        $('.roof-number').text(`${count}`);

        $(`.removefloor${count}`).on('click', function () {
            $(`.floor${count}`).remove();
        });

});

$("#addBasement").click(function(){
    var count =  $('#basement-floor').attr("data-basement");
        count = parseInt(count)+1;
        $("#basement-floor").append(`
           <section>
                        <div>
                            <section class="basement ${count} d-flex">
                            <div class="text-center px-3 main-roof">-${count}</div>
                            <div class="p6" >
                                <svg class="remove removeextRooms${count}"  xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg>
                                 <input type="hidden" name="groundbasement[no][]" value="${count}">   
                                <span class="ms-3">Basement ${count}</span>
                            </div>
                        </section>
                        </div>
                    </section>
        `);
         $('#basement-floor').attr("data-basement",count);
        $(`.removeextRooms${count}`).on('click', function () {
            $(`.basement${count}`).remove();
        });
});


</script>
@endsection
@endsection