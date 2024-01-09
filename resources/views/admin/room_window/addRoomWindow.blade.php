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
        margin-right: 20px;
    }

    .per {
        margin-left: 30px;
        padding-top: 1rem;
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
        margin-left: 40px;
    }

    .p2 {
        display: flex;
    }

    .p6 {
        display: flex;
        width: 95%;
        height: 40px;
        align-items: center;

        margin-left: 10px;
        margin-bottom: 20px;
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
        text-align: center;
    }
    .sell4 {
        margin-left: 40px;
        width: 120px;
        height: 25px;
        border-radius: 5px;
        border-color: gray;
        color: gray;
        width: 150px;
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
        align-items: center;
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
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <button  type="button"  class="w3-btn w3-green" id="add_plot_type">  Add </button>
        </div>
    </div>
@endcan
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Congratulation!</strong>    {{ session()->get('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
@endif  
@if(session()->has('error'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Oops!</strong>    {{ session()->get('error') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
@endif
<form style="margin: 0;"  method="post" action="{{ route('admin.add.room.window') }}">
    <div class="card">
    <div class="card-body">
        <div>
                @csrf
                <input type="hidden" id="project_id" name="project_id" value="{{  app('request')->input('pid') }}">
               <input type="hidden" id="project_revision_id" name="project_revision_id" value="{{  app('request')->input('rid') }}">
               
              
                <div class="con" id="plot_perameters">
                    <p class="per">Parameters</p>
                    <div class="pl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                        </svg>
                        <select name="building_id" id="building" class="sell">
                            @foreach($dataaa['buildings'] as $buildings)
                                <option value="{{ $buildings->id }}"  {{isset($_GET['bid']) && $_GET['bid'] == $building->id ? 'selected' : ''}}>{{ $buildings->title }}</option>
                            @endforeach
                        </select>

                        <select name="floor_number" id="floor" class="sell">
                            @foreach($dataaa['buildings'][0]['floor']  as $floors)
                                  <option value="{{ $floors->id }}"> {{ $floors->title  }}</option>
                            @endforeach
                        </select>
                        
                        <input type="text" name="floor_name" class="sell2" Placeholder="Floor Name" value="{{$dataaa['buildings'][0]['floor'][0]['title']}}" >

                        <div class="tot float-right" id="total_floor_area">
                              <p>Total Floor Area: {{ $dataaa['plot']['height'] * $dataaa['plot']['width'] }} </p>
                                <input type="hidden" id="total_area" value=" {{ $dataaa['plot']['height'] * $dataaa['plot']['width'] }}" >
                       
                        </div>
                    </div>
                </div>
                <div class="con">
                    <p class="per">Floor Rooms</p>
                    <div class="p2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                        <p class="p5"><a id="newsectionbtn" style="text-decoration:none ;color:gray;cursor: pointer;">Add Room</a></p>
                    </div>
                    <div id="container-room" data-building='0'></div>
                </div>
                
            </div>
            <div class="con">
                <p class="per">Floor Stacked Rooms</p> 
                <div class="p2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    <p class="p5"><a id="newsectionbtn1" style="text-decoration:none ;color:gray;cursor: pointer;">Add Stacked Room</a></p>
                </div>
                <div id="container-stacked_room" data-building='0'></div>
            </div>

            <div class="con1">
                <p class="per">Summary</p>
                <div class="p7">
                    <p class="per1 mx-4">Remaining area: 20%</p>
                    <div class="piechart"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-exclamation-triangle per1" viewBox="0 0 16 16">
                        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
                    </svg>
                    <p class="per2">Exceed total area</p>
                </div>
            </div>

            <input type="submit" value="Add Room" class="button">
        </div>
    </div>
</div>
</form>

<script>
    $('#plot_perameters').on('change',"#plot_width", function(){  
        var plot_width                      =   document.getElementById("plot_width").value;
        var plot_length                     =   document.getElementById("plot_length").value;
        var total_area                      =   parseInt(plot_width) * parseInt(plot_length);
        $('#plot_perameters').find('#total_area').val(total_area);
        $('#plot_perameters').find('#total_floor_area').html('Total Floor Area:'+total_area);
    }); 

    $('#plot_perameters').on('change',"#plot_length", function(){  
        var plot_width                      =   document.getElementById("plot_width").value;
        var plot_length                     =   document.getElementById("plot_length").value;
        var total_area                      =   parseInt(plot_width) * parseInt(plot_length);
        $('#plot_perameters').find('#total_area').val(total_area);
        $('#plot_perameters').find('#total_floor_area').html('Total Floor Area:'+total_area);
    });  
</script>


@section('scripts')
@parent
<script>
    $('#add_plot_type').click(function(){
        $('#plot_model').modal('show');
    });
  
    $("#newsectionbtn").click(function(){
                        var count =  $('#container-room').attr("data-building");
                        count = parseInt(count)+1;
                        total_area = total_area = $('#total_area').val();
                            $("#container-room").append(`
                            <section id="mainsection${count}" class="mainsectionRoom${count}">
                                <div class="p6" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-trash-fill removeRooms${count}" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                    <select name="rooms[type][${count}]" id="room_type" class="sell">
                                        @foreach($dataaa['room_types'] as $rooms)
                                        <option value="{{ $rooms->id }}">{{ $rooms->room_type }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="rooms[title][${count}]"  class="sell2 stacked_roomsName${count}" value="room">
                                    <div class="slidecontainer1">
                                        <input type="range" name="rooms[range][${count}]" min="0" max="100" value="0" class="slider" id="roomsRange${count}">
                                        <p style="  margin-left: 10px;    display: flex;  width: 40px; " class="percentage"> 
                                        <span class="roomsRange-range${count}" id="demo${count}">0</span> % </p>
                                    </div>

                                    <input type="text" name="rooms[room_area][${count}]" class="room_area${count}" value="">

                                    <select name="rooms[floor_room][${count}]" id="floor_room${count}" class="sell4">
                                        <option value="Proximity"> Proximity </option>
                                    </select>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                                        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
                                    </svg>
                                </div>
                            </section>`);
                           $('#container-room').attr("data-building",count);

                        $(`.roomsRange${count}`).on('input', function() {
                          //  $(`.roomsRange${count}`).text(Math.round(($(this).val()/total_area) * 100));
                            $(`.room_area${count}`).val($(this).val());
                        });
                        
                        $(`.removeRooms${count}`).on('click', function() {
                            $(`.mainsectionRoom${count}`).remove();
                        });

                        var slider = document.getElementById(`roomsRange${count}`);
                        var output = document.getElementById(`demo${count}`);
                        output.innerHTML = slider.value;
                        slider.oninput = function () {
                            output.innerHTML = this.value;
                        }
    });
  

    $("#newsectionbtn1").click(function(){
                        var count =  $('#container-stacked_room').attr("data-building");
                        count = parseInt(count)+1;
                        total_area = $('#total_area').val();
                            $("#container-stacked_room").append(`
                            <section id="mainsectionext${count}" class="mainsectionstacked_rooms${count}">
                                <div class="p6" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-trash-fill removestacked_rooms${count}" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                    <select name="stacked_rooms[type][${count}]" id="stacked_room_type" class="sell stacked_roomtypeselect">
                                        @foreach($dataaa['stack_room_types'] as $rooms)
                                        <option value="{{ $rooms->id }}">{{ $rooms->room_type }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="stacked_rooms[title][${count}]"  class="sell2 stacked_roomsName${count}" value="building">
                                    <div class="slidecontainer1">
                                        <input type="range" name="stacked_rooms[range][${count}]" min="0" max="100" value="0" class="slider" id="stacked_roomsRange${count}">
                                        <p style="  margin-left: 10px;   display: flex;  width: 40px; " class="percentage"> 
                                        <span id="extdemo${count}">0</span> % </p>
                                    </div>
                                    <input type="text" name="stacked_rooms[room_area][${count}]" class="stacked_rooms_area${count}" value="">

                                    <select name="stacked_rooms[floor_room][${count}]" id="floor_stacked_rooms${count}" class="sell4">
                                        <option value="Proximity">Proximity</option>
                                    </select>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                                        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
                                    </svg>
                                </div>
                            </section>`);
                           $('#container-stacked_rooms').attr("data-building",count);

                        $(`.stacked_roomsRange${count}`).on('change', function() {
                            $(`.stacked_roomsRange${count}`).text(Math.round(($(this).val()/total_area) * 100));
                            // $(`.buildingRange${count}`).val(Math.round(($(this).val()/total_area) * 100));
                        });
                        
                        $(`.removestacked_rooms${count}`).on('click', function() {
                            $(`.mainsectionstacked_rooms${count}`).remove();
                        });

                        var slider = document.getElementById(`stacked_roomsRange${count}`);
                        var output = document.getElementById(`extdemo${count}`);
                        output.innerHTML = slider.value;
                        slider.oninput = function () {
                            output.innerHTML = this.value;
                        }

    });
  
    $(function () {
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.users.massDestroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
            var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                return $(entry).data('entry-id')
            });

            if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')
                return;
            }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                    $.ajax({
                    headers: {'x-csrf-token': _token},
                    method: 'POST',
                    url: config.url,
                    data: { ids: ids, _method: 'DELETE' }})
                    .done(function () { location.reload() })
                }
            }
        }
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        // @can('user_delete')
        //   dtButtons.push(deleteButton)
        // @endcan

        $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        })

</script>

<script>
                
    $.ajax({
        url: "/admin/getstacked_roomTypes",
        type: 'GET',

        success: function(data) {
            //console.log(data);
            var $dropdown = $(".stacked_roomtypeselect");
            var i =1;
            $.each(data, function(key, val) {
                if(i==1)
                {
                    $("#stacked_room_area").val(val.room_area);
                }
                $dropdown.append($("<option />").val(val.room_type).text(val.room_type));
                i++;
            });    
        }
    });

</script>
@endsection
@endsection