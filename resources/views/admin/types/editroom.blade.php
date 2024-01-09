@extends('layouts.admin')
@section('content')
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<style type="text/css">

    .concept-model{
        border: 2px solid #b1b1b1;
        border-radius: 5px;
        padding: 0.5rem 0.8rem;
        margin-bottom: 1rem;
        margin-left: 15px;
    }
    .gen-concept-model{
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
    }
    .concept-model h5{
        margin: 0;
        font-size: 1rem;
    }
    .model-outline{
        border: 2px solid #b1b1b1;
        border-radius: 10px;
        padding: 0.4rem 1.4rem;
        text-transform: capitalize;
    
    }
    .card label{
        margin-bottom: 0 !important;
    }
    .status-box{
        border: 2px solid #aeabab;
        border-radius: 5px;
        padding: 0.5rem 0.8rem;
    }
    .manual-d-flex{
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
    .toggle-btn input[type="checkbox"]:hover + label:after  {
        box-shadow: 0 2px 15px 0 #0002, 0 3px 8px 0 #0001;
    }
    .toggle-btn input[type="checkbox"]:checked + label:before {
      background: #000;
    }
    .toggle-btn input[type="checkbox"]:checked + label:after {
      background: #fff;
      left: 21px;
    }
    .loader{
        transform: rotate(0);
        animation: spinner 1.5s infinite;
    }
    .auto-top-background {
        background-color: #2ab934;
        color: #fff;
        border-color: #2ab934;
    }
    /* @keyframes spinner {
        to{transform: rotate(360deg)}
    } */
    input[type=text], select {
        width: 30%;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 12px;
        margin-left:5px;
        text-transform: uppercase;
    }
    
    </style>
</head>
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Alert!</strong>    {{ session()->get('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>

@endif 
<div style="padding-top: 20px" class="container-fluid">

    <div class="card">
        <div class="card-header">
            @if(!empty($plot))
                Edit 
                @if($plot->type=='external') External 
                @elseif($plot->type=='stack') Stack 
                @endif Room Type
            @else
            Add @if($type=='external') External Room Type
                @elseif($type=='stack') Stack Room Type
                @elseif($type=='normal') Room Type
                @else
                Type
                @endif
            @endif
        </div>

        <div class="card-body">
            {{-- <form  action="{{ route('admin.update.room') }}" method="POST" enctype="multipart/form-data">
                 @csrf
               
                 
                 <div class="form-group ">
                    <label for="name">Room Type*</label>
                    <input type="text" name="room_type" class="form-control" value="{{$plot->room_type}}">
                    
                    <p class="helper-block">
                    <input type="hidden"  name="type_room"   id="type" value="{{$type}}">
                    </p>
                </div>
                <div class="form-group ">
                    <label for="name">Room Area*</label>
                    <input type="text" name="room_area" class="form-control" value="{{$plot->room_area}}">
                    <p class="helper-block">

                    </p>
                </div>
                    <input type="hidden" id="id" name="id" class="form-control" value="{{$plot->id}}">
                  
                 <p class="helper-block">
                 </p>
             </div>
             <div>
                <input class="btn btn-primary" type="submit" value="Save" style="position:relative;left: 10px;">

            </div>
            <br>
        </form> --}}
        @if(!empty($plot))
            <form  action="{{ route('admin.update.room') }}" method="POST" enctype="multipart/form-data">
        @else
            <form  action="{{ route('admin.add.room_type') }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="concept-model">
                        <h6 class="d-flex py-2">General</h6>
                        <div style="margin-bottom:10px">
                            <label for="">Type Name</label>
                            <input type="text" placeholder="Type" name="name" id="name" value="{{$plot->room_type ?? ''}}" required/>
                            <input type="hidden"  name="type_room"   id="type_room" value="{{$type ?? ''}}">
                            <label style="margin-left:12px"for="">Min Room Area</label>
                            <input type="text" placeholder="room area" name="room_area" id="room_area" value="{{$plot->room_area ?? ''}}" required/>
                            <input type="hidden" id="id" name="id" class="form-control" value="{{$plot->id ?? ''}}">
                            <input type="hidden" id="type" name="type" class="form-control" value="{{$plot->type ?? ''}}">
                        </div>
                        <div style="margin-bottom:10px">
                                <label for="">Default Value</label>
                                <input type="text" placeholder="default value" name="default" id="default" value="{{$plot->default_value ?? ''}}" required/>
                            </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="concept-model">
                        <h6 class="py-2">Walls Types</h6>
                        <div style="margin-bottom:20px">
                            <label for="">Wall Finish</label>
                            <select class="form-select" name="wall_type" id="wall_type">
                                @if(!empty($plot) )
                                    <option style="display:none;">{{$plot->wall_type}}</option>
                                @else
                                    <option value="" style="display:none;">Select</option>
                                @endif
                                @foreach($wall_types as $walltype)
                                    <option value="{{$walltype->wall_type}}">{{$walltype->wall_type}}</option>
                                @endforeach
                            </select>
                                <input style="margin-left:2rem" type="checkbox" id="byparent_wall_type" name="byparent_wall_type" value="">
                                <label for="vehicle1">By parent</label><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="concept-model">
                        <h6 class="py-2">Floor Finish</h6>
                        <div style="margin-bottom:20px">
                        <label for="">Floor Finish</label>
                            <select name="floor_type" id="floor_type">
                                @if(!empty($plot) )
                                    <option style="display:none;">{{$plot->floor_finish ?? 'Select'}}</option>
                                @else
                                    <option value="" style="display:none;">Select</option>
                                @endif
                                @foreach($floortypes as $floortype)
                                    <option value="{{$floortype->floor_type}}">{{$floortype->floor_type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="concept-model">
                        <h6 class="py-2">Railing Types</h6>
                        <div style="margin-bottom:20px">
                        <label for="">Railing Type</label>
                            <select name="railing_type" id="railing_type">
                                @if(!empty($plot) )
                                    <option style="display:none;">{{$plot->railing_type ?? 'Select'}}</option>
                                @else
                                    <option value="" style="display:none;">Select</option>
                                @endif
                                @foreach($railingtypes as $railingtype)
                                    <option value="{{$railingtype->railing_type}}">{{$railingtype->railing_type ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($plot))
                @if($plot->type=='normal' || $plot->type=='stack')
                    <div class="row">
                        <div class="col-md-7">
                            <div class="concept-model">
                                <h6 class="py-2">Ceiling Types</h6>
                                <div style="margin-bottom:20px">
                                <label for="">Ceiling Type</label>
                                    <select name="ceiling_type" id="ceiling_type">
                                    @if(!empty($plot) )
                                        <option style="display:none;">{{$plot->ceiling_type ?? 'Select'}}</option>
                                    @else
                                        <option value="" style="display:none;">Select</option>
                                    @endif
                                        @foreach($ceilingtypes as $ceilingtype)
                                            <option value="{{$ceilingtype->ceiling_type}}">{{$ceilingtype->ceiling_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                @if($type=='normal' || $type=='stack')
                    <div class="row">
                        <div class="col-md-7">
                            <div class="concept-model">
                                <h6 class="py-2">Ceiling Types</h6>
                                <div style="margin-bottom:20px">
                                <label for="">Ceiling Type</label>
                                    <select name="ceiling_type" id="ceiling_type">
                                        <option value="" style="display:none;">Select</option>
                                        @foreach($ceilingtypes as $ceilingtype)
                                            <option value="{{$ceilingtype->ceiling_type}}">{{$ceilingtype->ceiling_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <div class="row">
                <div class="col-md-7">
                    <div class="concept-model">
                        <h6 class="py-2">Light Types</h6>
                        <div style="margin-bottom:10px">
                            <a id="newsectionbtn" style="text-decoration:none ;color:#474242;cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                                Add Light Object
                            </a>
                        </div>
                        <div style="margin-bottom:20px">
                            @if(!empty($roomtypeadds) && count($roomtypeadds) != 0)
                            <?php $i=0; ?>
                                @foreach($roomtypeadds as $roomtype)
                                    @if($roomtype->type == "lights")
                                        <div style="margin-bottom:10px" class="edit-light{{$i}}">
                                            <label for="">Light Type</label>
                                            <select name="object_type[lights][{{$roomtype->id}}]" id="light_type">
                                                    <option style="display:none;">{{$roomtype->object_type ?? 'Select'}}</option>
                                                @foreach($lighttypes as $lighttype)
                                                    <option value="{{$lighttype->lights_type}}">{{$lighttype->lights_type ?? ''}}</option>
                                                @endforeach
                                            </select>
                                            <a style="cursor: pointer;"class="del-light" data-id="{{$roomtype->id}}">
                                                <svg class="remove-type" data-id="{{$i}}" data-objid="{{$roomtype->id}}" data-mainclass="edit-light{{$i}}" style="margin-left:10px"id="remove-remove-me" xmlns="http://www.w3.org/2000/svg"  width="20" height="20"
                                                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                            </a>
                                        </div>
                                        <?php $i++; ?>
                                    @endif
                                @endforeach
                            @else
                                <div style="margin-bottom:10px" data-id="0" class="light-obj">
                                    <label for="">Light Type</label>
                                    <select name="object_type[lights][0]" id="light_type">
                                        <option style="display:none;" value="">Select</option>
                                        @foreach($lighttypes as $lighttype)
                                            <option value="{{$lighttype->lights_type}}">{{$lighttype->lights_type ?? ''}}</option>
                                        @endforeach
                                    </select>
                                    <svg data-id="0" class="del-light" style="margin-left:10px"id="remove-remove-me" xmlns="http://www.w3.org/2000/svg"  width="20" height="20"
                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </div>
                            @endif
                            <div id="container-light" data-light="0"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="concept-model">
                        <h6 class="py-2">Primary Furn Objects</h6>
                        <div style="margin-bottom:10px">
                            <a id="newsectionbtn1" style="text-decoration:none ;color:#474242;cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                                Add Furn Object
                            </a>
                        </div>
                        <div style="margin-bottom:20px">
                            @if(!empty($roomtypeadds) && count($roomtypeadds) != 0)
                            <?php $i=0; ?>
                                @foreach($roomtypeadds as $roomtype)
                                    @if($roomtype->type == "p_furn")
                                    
                                        <div style="margin-bottom:10px" class="edit-pfurn{{$i}}">
                                        <label for="">Furn Object</label>
                                            <select name="object_type[p_furn][{{$roomtype->id}}]" id="p_furn_type">
                                                <option style="display:none;">{{$roomtype->object_type ?? 'Select'}}</option>
                                                @foreach($furntypes as $furntype)
                                                    <option value="{{$furntype->furniture_type}}">{{$furntype->furniture_type ?? ''}}</option>
                                                @endforeach
                                            </select>
                                            <svg class="remove-type" data-id="{{$i}}" data-objid="{{$roomtype->id}}" data-mainclass="edit-pfurn{{$i}}" style="margin-left:10px"id="remove-remove-me" xmlns="http://www.w3.org/2000/svg"  width="20" height="20"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                        </div>
                                        <?php $i++; ?>
                                    @endif
                                @endforeach
                            @else
                                <div style="margin-bottom:10px" data-id="0" class="pfurn-obj">
                                    <label for="">Furn Object</label>
                                    <select name="object_type[p_furn][0]" id="p_furn_type">
                                        <option value="" style="display:none;">Select</option>
                                        @foreach($furntypes as $furntype)
                                            <option value="{{$furntype->furniture_type}}">{{$furntype->furniture_type ?? ''}}</option>
                                        @endforeach
                                    </select>
                                        <svg data-id="0" class="del-pfurn" style="margin-left:10px"id="remove-remove-me" xmlns="http://www.w3.org/2000/svg"  width="20" height="20"
                                            fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                        </svg>
                                </div>
                            @endif
                            <div id="container-furn1" data-furn1="0"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="concept-model">
                        <h6 class="py-2">Secondary Furn Objects</h6>
                        <div style="margin-bottom:10px;">
                            <a id="newsectionbtn2" style="text-decoration:none ;color:#474242;cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                                Add Furn Object
                            </a>
                        </div>
                        <div style="margin-bottom:20px">
                            @if(!empty($roomtypeadds) && count($roomtypeadds) != 0)
                            <?php $i=0; ?>
                                @foreach($roomtypeadds as $roomtype)
                                    @if($roomtype->type == "s_furn")
                                        <div style="margin-bottom:10px" class="edit-sfurn{{$i}}">
                                            <label for="">Furn Object</label>
                                            <select name="object_type[s_furn][{{$roomtype->id}}]" id="s_furn_type">
                                                    <option style="display:none;">{{$roomtype->object_type ?? 'Select'}}</option>
                                                @foreach($furntypes as $furntype)
                                                    <option value="{{$furntype->furniture_type}}">{{$furntype->furniture_type ?? ''}}</option>
                                                @endforeach
                                            </select>
                                            <svg class="remove-type" data-id="{{$i}}" data-objid="{{$roomtype->id}}" data-mainclass="edit-sfurn{{$i}}" style="margin-left:10px"id="remove-remove-me" xmlns="http://www.w3.org/2000/svg"  width="20" height="20"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                        </div>
                                    <?php $i++; ?>
                                    @endif
                                @endforeach
                            @else
                                <div style="margin-bottom:10px" data-id="0" class="sfurn-obj">
                                    <label for="">Furn Object</label>
                                    <select name="object_type[s_furn][0]" id="s_furn_type">
                                            <option style="display:none;" value="">Select</option>
                                        @foreach($furntypes as $furntype)
                                            <option value="{{$furntype->furniture_type}}">{{$furntype->furniture_type ?? ''}}</option>
                                        @endforeach
                                    </select>
                                    <svg data-id="0" class="del-sfurn" style="margin-left:10px"id="remove-remove-me" xmlns="http://www.w3.org/2000/svg"  width="20" height="20"
                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </div>
                            @endif
                            <div id="container-furn2" data-furn2="0"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="concept-model">
                        <h6 class="py-2">Door Objects</h6>
                        <div style="margin-bottom:10px;">
                            <a style ="text-decoration:none ;color:#474242;cursor: pointer;" id="newsectionbtn3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                                Add Door Object
                            </a>
                        </div>
                        <div style="margin-bottom:20px">
                            @if(!empty($roomtypeadds) && count($roomtypeadds) != 0)
                            <?php $i=0; ?>
                                @foreach($roomtypeadds as $roomtype)
                                    @if($roomtype->type == "door")
                                        <div style="margin-bottom:10px" class="edit-door{{$i}}">
                                        <label for="">Door Object</label>
                                            <select name="object_type[door][{{$roomtype->id}}]" id="door_obj">
                                                    <option style="display:none;">{{$roomtype->object_type ?? 'Select'}}</option>
                                                @foreach($doortypes as $doortype)
                                                    <option value="{{$doortype->door_type}}">{{$doortype->door_type ?? ''}}</option>
                                                @endforeach
                                            </select>
                                            <svg class="remove-type" data-id="{{$i}}" data-objid="{{$roomtype->id}}" data-mainclass="edit-door{{$i}}" style="margin-left:10px"id="remove-remove-me" xmlns="http://www.w3.org/2000/svg"  width="20" height="20"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                        </div>
                                    <?php $i++; ?>
                                    @endif
                                @endforeach
                            @else
                                <div style="margin-bottom:10px" data-id="0" class="door-obj">
                                    <label for="">Door Object</label>
                                    <select name="object_type[door][0]" id="door_obj">
                                            <option value="" style="display:none;">Select</option>
                                        @foreach($doortypes as $doortype)
                                            <option value="{{$doortype->door_type}}">{{$doortype->door_type ?? ''}}</option>
                                        @endforeach
                                    </select>
                                    <svg class="del-door" data-id="0" style="margin-left:10px"id="remove-remove-me" xmlns="http://www.w3.org/2000/svg"  width="20" height="20"
                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </div>
                            @endif
                            <div id="container-door" data-door="0"></div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($plot))
                @if($plot->type=='normal' || $plot->type=='stack')
                <div class="row">
                    <div class="col-md-7">
                        <div class="concept-model">
                            <h6 class="py-2">Window Objects</h6>
                            <div style="margin-bottom:10px;">
                                <a style ="text-decoration:none ;color:#474242;cursor: pointer;" id="newsectionbtn4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                        class="bi bi-plus-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                    Add Window Object
                                </a>
                            </div>
                            @if(!empty($roomtypeadds) && count($roomtypeadds) != 0)
                            <?php $i=0; ?>
                                @foreach($roomtypeadds as $roomtype)
                                    @if($roomtype->type == "window")
                                        <div style="margin-bottom:10px" class="edit-window{{$i}}">
                                            <label for="">Window Object</label>
                                            <select name="object_type[window][{{$roomtype->id}}]" id="window_obj">
                                                    <option style="display:none;">{{$roomtype->object_type ?? 'Select'}}</option>
                                                @foreach($windowtypes as $windowtype)
                                                    <option value="{{$windowtype->window_type}}">{{$windowtype->window_type ?? ''}}</option>
                                                @endforeach
                                            </select>
                                            <svg class="remove-type" data-id="{{$i}}" data-objid="{{$roomtype->id}}" data-mainclass="edit-window{{$i}}" style="margin-left:10px"id="remove-remove-me" xmlns="http://www.w3.org/2000/svg"  width="20" height="20"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                        </div>
                                    <?php $i++; ?>
                                    @endif
                                @endforeach
                            @else
                                <div style="margin-bottom:10px" data-id="0" class="window-obj">
                                    <label for="">Window Object</label>
                                    <select name="object_type[window][0]" id="window_obj">
                                            <option value="" style="display:none;">Select</option>
                                        @foreach($windowtypes as $windowtype)
                                            <option value="{{$windowtype->window_type}}">{{$windowtype->window_type ?? ''}}</option>
                                        @endforeach
                                    </select>
                                    <svg data-id="0" class="del-window" style="margin-left:10px"id="remove-remove-me" xmlns="http://www.w3.org/2000/svg"  width="20" height="20"
                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </div>
                            @endif
                            <div id="container-window" data-window="0"></div>
                        </div>
                    </div>
                </div>
                @endif
            @else
                @if($type=='normal' || $type=='stack')
                    <div class="row">
                        <div class="col-md-7">
                            <div class="concept-model">
                                <h6 class="py-2">Window Objects</h6>
                                <div style="margin-bottom:10px;">
                                    <a style ="text-decoration:none ;color:#474242;cursor: pointer;" id="newsectionbtn4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                            class="bi bi-plus-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>
                                        Add Window Object
                                    </a>
                                </div>
                                <div style="margin-bottom:10px" data-id="0" class="window-obj">
                                    <label for="">Window Object</label>
                                    <select name="object_type[window][0]" id="window_obj">
                                        <option value="" style="display:none;">Select</option>
                                        @foreach($windowtypes as $windowtype)
                                            <option value="{{$windowtype->window_type}}">{{$windowtype->window_type ?? ''}}</option>
                                        @endforeach
                                    </select>
                                    <svg data-id="0" class="del-window" style="margin-left:10px"id="remove-remove-me" xmlns="http://www.w3.org/2000/svg"  width="20" height="20"
                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </div>
                                <div id="container-window" data-window="0"></div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <div class="d-flex justify-content-sm-center">
                <button class="btn btn-success"type="submit">Apply</button>
            </div>
            <script>
                var array_id_of_obj = [];
                $(document).on('click', `.remove-type`, function () {
                var class_name = $(this).attr("data-mainclass");
                // var obj_ID = $(this).attr("data-objid");
                // var count = $(this).attr("data-id");
                $(`.${class_name}`).hide();
                array_id_of_obj.push( $(this).attr("data-objid") );
                // alert("class name : "+class_name+" and id is : "+obj_ID+" and data-id is : "+count);
                data= array_id_of_obj.map(array_id_of_obj => array_id_of_obj);
                console.log(data);
                $("input[name=id_obj_del]").val(data.join(", "));
                // document.getElementById("texens").value = data;
                console.log($("input[name=id_obj_del]").val());
            });
            
            </script>
            <input type="hidden" name="id_obj_del" value="">
        </form>
    </div>
</div>

</div>

    
<script>

$("#newsectionbtn").click(function()
    {
        var count =  $('#container-light').attr("data-light");
        count = parseInt(count)+1;
        $('#container-light').attr("data-light",count);
        // $('#container-light').data("light", count );
        $("#container-light").append(`
            <div style="margin-bottom:10px" data-id="${count}" class="light-obj${count}">
                <label for="">Light Type</label>
                <select name="object_type[lights][${count}]" id="l-${count}">
                    <option value="" style="display:none;">Select</option>
                    @foreach($lighttypes as $lighttype)
                        <option value="{{$lighttype->lights_type}}">{{$lighttype->lights_type ?? ''}}</option>
                    @endforeach
                </select>
                <svg data-id="${count}" data-name="light-obj${count}" class="del-obj" style="margin-left:10px"id="remove-remove-me" xmlns="http://www.w3.org/2000/svg"  width="20" height="20"
                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path
                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                </svg>
            </div>
        `);
    });
$("#newsectionbtn1").click(function()
{
    var count =  $('#container-furn1').attr("data-furn1");
    count = parseInt(count)+1;
    $('#container-furn1').attr("data-furn1",count);
    $("#container-furn1").append(`
        <div style="margin-bottom:10px" data-id="${count}" class="pfurn-obj${count}">
            <label for="">Furn Object</label>
            <select name="object_type[p_furn][${count}]" id="furn1-${count}">
                <option value="" style="display:none;">Select</option>
                @foreach($furntypes as $furntype)
                    <option value="{{$furntype->furniture_type}}">{{$furntype->furniture_type ?? ''}}</option>
                @endforeach
            </select>
            <svg data-id="${count}" data-name="pfurn-obj${count}" class="del-obj" style="margin-left:10px"id="remove-remove-me" xmlns="http://www.w3.org/2000/svg"  width="20" height="20"
                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                <path
                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
            </svg>
        </div>
    `);
});
$("#newsectionbtn2").click(function()
    {
        var count =  $('#container-furn2').attr("data-furn2");
        count = parseInt(count)+1;
        $('#container-furn2').attr("data-furn2",count);
        $("#container-furn2").append(`
            <div style="margin-bottom:10px" data-id="${count}" class="sfurn-obj${count}">
                <label for="">Furn Object</label>
                <select name="object_type[s_furn][${count}]" id="furn2-${count}">
                    <option value="" style="display:none;">Select</option>
                    @foreach($furntypes as $furntype)
                        <option value="{{$furntype->furniture_type}}">{{$furntype->furniture_type ?? ''}}</option>
                    @endforeach
                </select>
                <svg data-id="${count}" data-name="sfurn-obj${count}" class="del-obj" style="margin-left:10px"id="remove-remove-me" xmlns="http://www.w3.org/2000/svg"  width="20" height="20"
                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path
                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                </svg>
            </div>
        `);
    });
$("#newsectionbtn3").click(function()
{
    var count =  $('#container-door').attr("data-door");
    count = parseInt(count)+1;
    $('#container-door').attr("data-door",count);
    console.log(count+" hellow");
    $("#container-door").append(`
        <div style="margin-bottom:10px" data-id="${count}" class="door-obj${count}">
            <label for="">Door Object</label>
            <select name="object_type[door][${count}]" id="door-${count}">
                <option value="" style="display:none;">Select</option>
                @foreach($doortypes as $doortype)
                    <option value="{{$doortype->door_type}}">{{$doortype->door_type ?? ''}}</option>
                @endforeach
            </select>
            <svg class="del-obj" data-name="door-obj${count}" data-id="${count}" style="margin-left:10px"id="RootNode" xmlns="http://www.w3.org/2000/svg"  width="20" height="20"
                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                <path
                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
            </svg>
        </div>
    `);
});

$("#newsectionbtn4").click(function()
{
    var count =  $('#container-window').attr("data-window");
    count = parseInt(count)+1;
    $('#container-window').attr("data-window",count);
    $("#container-window").append(`
        <div style="margin-bottom:10px" data-id="${count}" class="window-obj${count}">
            <label for="">Window Object</label>
            <select name="object_type[window][${count}]" id="window-${count}">
                <option value="" style="display:none;">Select</option>
                @foreach($windowtypes as $windowtype)
                    <option value="{{$windowtype->window_type}}">{{$windowtype->window_type ?? ''}}</option>
                @endforeach
            </select>
            <svg data-id="${count}" data-name="window-obj${count}" class="del-obj" style="margin-left:10px"id="remove-remove-me" xmlns="http://www.w3.org/2000/svg"  width="20" height="20"
                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                <path
                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
            </svg>
        </div>
    `);
});

// $(".del-light").click(function()
//     {
//         // $('#container-light').remove();
//         var obj_id = $(this).attr('data-id')
//         // alert($(this).attr('data-id'));
//         // console.log(obj_id+" : success");
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//         $.ajax({
//                url: "/admin/delete-object-of-room",
//                type: 'post',
//                data: {
//                    'id': obj_id,
//                },
//                success: function(result) {

//                    console.log(result+" : success");
//                }
//            });
//     });
$(document).on('click', `.del-obj`, function () {
    var class_name = $(this).attr("data-name");
    $(`.${class_name}`).remove();
});
</script>
@endsection
