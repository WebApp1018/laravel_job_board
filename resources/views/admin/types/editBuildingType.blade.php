@extends('layouts.admin')
@section('content')
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
        width: 25%;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 12px;
        margin-left:5px;
        text-transform: uppercase;
    }
    
    </style>

<div style="padding-top: 20px" class="container-fluid">
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Alert!</strong>    {{ session()->get('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>

@endif 

    <div class="card">
        <div class="card-header">
        @if(!empty($building_type))
           Edit Buildings Type
        @else
        Add Buildings Type
        @endif
        </div>

        <div class="card-body">
            {{-- <form  action="{{ route('admin.update.building') }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 @foreach($building_type as $plot)
                 
                 <div class="form-group ">
                    <label for="name">Building Type*</label>
                    <input type="text" name="building_type" class="form-control" value="{{$plot->building_type}}">
                    <p class="helper-block">

                    </p>
                </div>
                <div class="form-group ">
                    <label for="name">Floor Height*</label>
                    <input type="text" name="floor_height" class="form-control" value="{{$plot->floor_height}}">
                    <p class="helper-block">

                    </p>
                </div>
                <div class="form-group ">
                    <label for="name">Number of floor*</label>
                    <input type="text" name="number_of_floor" class="form-control" value="{{$plot->number_of_floor}}">
                    <p class="helper-block">

                    </p>
                </div>
                <div class="form-group ">
                    <label for="name">Target Area*</label>
                    <input type="text" name="target_area" class="form-control" value="{{$plot->target_area}}">
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
            @endforeach
        </form> --}}
        @if(!empty($building_type))
        <form  action="{{ route('admin.update.building') }}" method="POST" enctype="multipart/form-data">
        @else
        <form  action="{{ route('admin.add.building_type') }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf
                <div class="row">
                    <div class="col-md-7">
                        <div class="concept-model">
                            <h6 class="d-flex py-2">General</h6>
                            <div style="margin-bottom:10px">
                                <label for="">Type Name</label>
                                @if(!empty($building_type))
                                    @foreach($building_type as $plot)
                                        <input type="text" placeholder="Text" id="name" name="name"value="{{$plot->building_type}}"/>
                                        <input type="hidden" id="id" name="id" value="{{$plot->id}}">
                                        <label for="" style="margin-left:10px">Default Value</label>
                                        <input type="text" placeholder="default value" name="default" id="default" value="{{$plot->default_value ?? ''}}" required/>
                                    @endforeach

                                @else
                                    <input type="text" placeholder="Text" id="name" name="name">
                                    <label for="" style="margin-left:10px">Default Value</label>
                                    <input type="text" placeholder="default value" name="default" id="default" value=""/>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="concept-model">
                            <h6 class="py-2">Walls Types</h6>
                            <div style="margin-bottom:10px">
                                <label for="">Ext Wall</label>
                                <select class="form-select" name="ext_wall" id="ext_wall">
                                    @if(!empty($building_type) )
                                        <option style="display:none;" value="{{$building_type[0]->ext_wall}}">{{$building_type[0]->ext_wall ?? 'Select'}}</option>
                                    @else
                                        <option value="" style="display:none;">Select</option>
                                    @endif
                                    @foreach($wall_types as $walltype)
                                        <option value="{{$walltype->wall_type}}">{{$walltype->wall_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="margin-bottom:10px">
                                <label for="">Room Wall</label>
                                <select class="form-select" name="room_wall" id="room_wall">
                                    @if(!empty($building_type) )
                                        <option style="display:none;" value="{{$building_type[0]->room_wall}}">{{$building_type[0]->room_wall ?? 'Select'}}</option>
                                    @else
                                        <option value="" style="display:none;">Select</option>
                                    @endif
                                    @foreach($wall_types as $walltype)
                                        <option value="{{$walltype->wall_type}}">{{$walltype->wall_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="margin-bottom:10px">
                                <label for="">Corridor Wall</label>
                                <select  class="form-select" name="corri_wall" id="corri_wall">
                                    @if(!empty($building_type) )
                                        <option style="display:none;" value="{{$building_type[0]->corri_wall}}">{{$building_type[0]->corri_wall ?? 'Select'}}</option>
                                    @else
                                        <option value="" style="display:none;">Select</option>
                                    @endif
                                    @foreach($wall_types as $walltype)
                                        <option value="{{$walltype->wall_type}}">{{$walltype->wall_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="concept-model">
                            <h6 class="py-2">Slab Types</h6>
                            <div style="margin-bottom:10px">
                            <label for="">Soil Slab</label>
                                <select name="soil_slab" id="soil_slab">
                                    @if(!empty($building_type) )
                                        <option style="display:none;" value="{{$building_type[0]->soil_slab}}">{{$building_type[0]->soil_slab ?? 'Select'}}</option>
                                    @else
                                        <option value="" style="display:none;">Select</option>
                                    @endif
                                    @foreach($floor as $floor_types)
                                        <option value="{{$floor_types->floor_type}}">{{$floor_types->floor_type ?? ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="margin-bottom:10px">
                                <label for="">Roof Slab</label>
                                <select name="roof_slab" id="roof_slab">
                                    @if(!empty($building_type) )
                                        <option style="display:none;" value="{{$building_type[0]->roof_slab}}">{{$building_type[0]->roof_slab ?? 'Select'}}</option>
                                    @else
                                        <option value="" style="display:none;">Select</option>
                                    @endif
                                    @foreach($floor as $floor_types)
                                        <option value="{{$floor_types->floor_type}}">{{$floor_types->floor_type ?? ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="margin-bottom:10px">
                                <label for="">General Slab</label>
                                <select name="gen_slab" id="gen_slab">
                                    @if(!empty($building_type) )
                                        <option style="display:none;" value="{{$building_type[0]->gen_slab}}">{{$building_type[0]->gen_slab ?? 'Select'}}</option>
                                    @else
                                        <option value="" style="display:none;">Select</option>
                                    @endif
                                    @foreach($floor as $floor_types)
                                        <option value="{{$floor_types->floor_type}}">{{$floor_types->floor_type ?? ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="concept-model">
                            <h6 class="d-flex py-2">Railing Types</h6>
                            <div style="margin-bottom:10px">
                                <label for="">Railing Type</label>
                                <select name="railing_type" id="railing_type">
                                    @if(!empty($building_type) )
                                        <option style="display:none;" value="{{$building_type[0]->railing_type}}">{{$building_type[0]->railing_type ?? 'Select'}}</option>
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
                <div class="row">
                    <div class="col-md-7">
                        <div class="concept-model">
                            <h6 class="d-flex py-2">Roof Types</h6>
                            <div style="margin-bottom:10px">
                                <label for="">Roof Type</label>
                                <select name="roof_type" id="roof_type">
                                    @if(!empty($building_type) )
                                        <option style="display:none;" value="{{$building_type[0]->roof_type}}">{{$building_type[0]->roof_type ?? 'Select'}}</option>
                                    @else
                                        <option value="" style="display:none;">Select</option>
                                    @endif.
                                    @foreach($rooftypes as $rooftype)
                                        <option value="{{$rooftype->roof_type}}">{{$rooftype->roof_type ?? ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="concept-model">
                            <h6 class="d-flex py-2">Mass Types</h6>
                            <div style="margin-bottom:10px">
                                <label for="">Mass Type</label>
                                <select name="mass_type" id="mass_type">
                                    @if(!empty($building_type) )
                                        <option style="display:none;" value="{{$building_type[0]->mass_type}}">{{$building_type[0]->mass_type ?? 'Select'}}</option>
                                    @else
                                        <option value="" style="display:none;">Select</option>
                                    @endif
                                    @foreach($mass as $mass_type)
                                        <option value="{{$mass_type->mass_type}}">{{$mass_type->mass_type ?? ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="d-flex justify-content-sm-center">
                <button class="btn btn-success"type="submit">Apply</button>
            </div>
        </form>
    </div>
</div>

</div>

    


@endsection
