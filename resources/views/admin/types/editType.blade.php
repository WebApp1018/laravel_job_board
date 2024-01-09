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
          Add/Edit Plot Type
        </div>
        {{--  --}}

        <div class="card-body">
           {{-- <form  action="{{ route('admin.update.plot') }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 @foreach($plot_types as $plot)
                 
                 <div class="form-group ">
                    <label for="name">Plot Name*</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$plot->plot_type}}">
                    <p class="helper-block">

                    </p>
                </div>
                
                    <input type="hidden" id="id" name="id" class="form-control" value="{{$plot->id_plot}}">
                  
                 <p class="helper-block">
                 </p>
             </div>
             <div>
                <input class="btn btn-primary" type="submit" value="Save" style="position:relative;left: 10px;">

            </div>
            <br>
            @endforeach
        </form> --}}
        @if(!empty($plot_types) )
        <form  action="{{ route('admin.update.plot') }}" method="POST" enctype="multipart/form-data">
        @else
        <form  action="{{ route('admin.add.plot.type') }}" method="POST" enctype="multipart/form-data">
        @endif
        @csrf

            <div class="row">
                <div class="col-md-7">
                    <div class="concept-model">
                        <h6 class="d-flex py-2">General</h6>
                        <div style="margin-bottom:10px">
                            
                            @if(!empty($plot_types) )
                                @foreach($plot_types as $plot)
                                    <div>
                                        <label for="">Type Name</label>
                                        <input type="hidden" id="id" name="id" class="form-control" value="{{$plot->id_plot}}">
                                        <input style="margin-left:33px"type="text" id="name" name="name" placeholder="Text" value="{{$plot->plot_type}}" required >
                                    </div>
                                    <div>
                                        <label for="" style="margin-top:10px;">Default length</label>
                                        <input type="text" placeholder="default value" name="def_len" id="def_len" value="{{$plot->def_len ?? ''}}" required />
                                    </div>
                                    <div>
                                    <label for="" style="margin-top:10px">Default width</label>
                                    <input type="text" placeholder="default value" name="def_width" id="def_width" value="{{$plot->def_width ?? ''}}" required/>
                                    </div>
                                    <div>
                                    <label for="" style="margin-top:10px">Default Height</label>
                                    <input type="text" placeholder="default value" name="def_height" id="def_height" value="{{$plot->def_height ?? ''}}" required/>
                                    </div>
                                @endforeach
                            @else
                                <div>
                                    <label for="">Type Name</label>
                                    <input style="margin-left:33px"type="text" id="name" name="name" placeholder="Text" value="" required>
                                </div>
                                <div>
                                    <label for="" style="margin-top:10px;">Default length</label>
                                    <input type="text" placeholder="default length" name="def_len" id="def_len" value="" required />
                                </div>
                                <div>
                                    <label for="" style="margin-top:10px">Default width</label>
                                    <input type="text" placeholder="default width" name="def_width" id="def_width" value="" required/>
                                </div>
                                <div>
                                    <label for="" style="margin-top:10px">Default Height</label>
                                    <input type="text" placeholder="default height" name="def_height" id="def_height" value="" required/>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="concept-model">
                        <h6 class="py-2">Walls Types</h6>
                        <div style="margin-bottom:5px">
                            <label for="">Road Wall</label>
                            <select style="margin-left:43px"class="form-select" name="road_wall" id="road_wall">
                                @if(!empty($plot_types) )
                                    <option style="display:none;" value="{{$plot_types[0]->road_wall}}">{{$plot_types[0]->road_wall ?? 'Select'}}</option>
                                @else
                                    <option style="display:none;" value="">Select</option>
                                @endif
                                @foreach($wall_types as $walltype)
                                    <option value="{{$walltype->wall_type}}">{{$walltype->wall_type}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div style="margin-bottom:5px">
                            <label for="">Neighbour Wall</label>
                            <select class="form-select" name="Neigbr_wall" id="Neigbr_wall">
                                @if(!empty($plot_types) )
                                    <option style="display:none;" value="{{$plot_types[0]->neigbr_wall}}">{{$plot_types[0]->neigbr_wall  ?? 'Select'}}</option>
                                @else
                                    <option style="display:none;" value="">Select</option>
                                @endif
                                @foreach($wall_types as $walltype)
                                    <option value="{{$walltype->wall_type}}">{{$walltype->wall_type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="margin-bottom:5px">
                            <label for="">General Wall</label>
                            <select  style="margin-left:23px"class="form-select" name="gen_wall" id="gen_wall">
                                @if(!empty($plot_types) )
                                    <option style="display:none;" value="{{ $plot_types[0]->gen_wall}}">{{ $plot_types[0]->gen_wall  ?? 'Select'}}</option>
                                @else
                                    <option style="display:none;" value="">Select</option>
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
                        <h6 class="py-2">Slab Type</h6>
                        <div style="margin-bottom:5px">
                        <label for="">Soil Slab</label>
                            <select name="soil_slab" id="soil_slab">
                                @if(!empty($plot_types) )
                                    <option style="display:none;" value="{{$plot_types[0]->soil_slab}}">{{$plot_types[0]->soil_slab  ?? 'Select'}}</option>
                                @else
                                    <option style="display:none;" value="">Select</option>
                                @endif
                                @foreach($floor as $floortype)
                                    <option value="{{$floortype->floor_type}}">{{$floortype->floor_type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        <form>
        <div class="d-flex justify-content-sm-center">
            <button class="btn btn-success"type="submit">Apply</button>
        </div>
    </div>
</div>

</div>

    


@endsection
