@extends('layouts.admin')
@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
           
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        <h2>Site Settings</h2>
    </div>

    <div class="card-body">
        <form role="form" id="category" method="POST" action="{{ route('admin.add.sitesettings') }}" enctype="multipart/form-data">
            @csrf
          <div style="width: 85%;margin: auto;">
             <label><b>Home Page text 1</b></label>
             <div class="form-group ">
                <input class="form-control" type="text" value="{{ $settings->homepagetext1 }}" name="homepagetext1" placeholder="Home Page text 1" required="" id="homepagetext1" required>
            </div>
            <br>

            <label><b>Home Page text 2</b></label>
            <div class="form-group ">
               <input class="form-control" type="text" value="{{ $settings->homepagetext2 }}" name="homepagetext2" placeholder="Home Page text 2" required="" id="homepagetext2" >
           </div>
           {{-- <br>
           <label><b>Home Page text 3</b></label>
           <div class="form-group ">
              <input class="form-control" type="text" value="{{ $settings->homepagetext2 }}" name="homepagetext2" placeholder="Home Page text 2" required="" id="homepagetext3" >
          </div>
          <br> --}}
          <label><b>Subscription text</b></label>
           <div class="form-group ">
              <input class="form-control" type="text" value="{{ $settings->subscriptiontxt }}" name="subscriptiontxt" placeholder="Subscription text" required="" id="subscriptiontxt" >
          </div>
          <br>
          <label><b>Address</b></label>
          <div class="form-group ">
             <input class="form-control" type="text" value="{{ $settings->address }}" name="address" placeholder="address" required="" id="address" >
         </div>
         <br>
         <label><b>Email</b></label>
         <div class="form-group ">
            <input class="form-control" type="email" value="{{ $settings->email }}" name="email" placeholder="Email" required="" id="email" >
        </div>
        <br>
        <label><b>Hero Image</b></label>
        <div class="form-group ">
           <input class="form-control" type="file" name="hero" placeholder="Image" id="hero" >
       </div>
       <br>
        <br>
        <label><b>How It Works Image</b></label>
        <div class="form-group ">
           <input class="form-control" type="file" name="image" placeholder="Image" id="hiwi" >
       </div>
       <br>



       <br>

       <label><b>Json file path</b></label>
       <div class="form-group ">
          <input class="form-control" type="text" value="{{ $settings->jsonfilepath }}" name="jsonfilepath" placeholder="Json file path" required="" id="jsonfilepath" >
      </div>

      <br>

      <label><b>Csv file path</b></label>
      <div class="form-group ">
         <input class="form-control" type="text" value="{{ $settings->csvfilepath }}" name="csvfilepath" placeholder="Csv file path" required="" id="csvfilepath" >
     </div>


     <br>

     <label><b>Pdf file path</b></label>
     <div class="form-group ">
        <input class="form-control" type="text" value="{{ $settings->pdffilepath }}" name="pdffilepath" placeholder="Pdf file path" required="" id="pdffilepath" >
    </div>
    <br>


    <label><b>FBX file path</b></label>
    <div class="form-group ">
       <input class="form-control" type="text" value="{{ $settings->fbxfilepath }}" name="fbxfilepath" placeholder="FBX file path" required="" id="fbxfilepath" >
   </div>
 <br>

    <label><b>Dwg file path</b></label>
    <div class="form-group ">
       <input class="form-control" type="text" value="{{ $settings->dwgfilepath }}" name="dwgfilepath" placeholder="Dwg file path" required="" id="dwgfilepath" >
   </div>



       <br>
        <label><b>Side bar</b></label>
        <div class="form-group ">
           <select class="form-control"  name="sidebar" >
                <option @if($settings->sidebar=='show') selected @endif value="show" >show</option>
                <option @if($settings->sidebar=='hide') selected @endif value="hide" >hide</option>
           </select>
       </div>
       <br>
       <label><b>Side bar2</b></label>
        <div class="form-group ">
           <select class="form-control"  name="sidebartwo" >
            <option @if($settings->sidebartwo=='show') selected @endif value="show" >show</option>
            <option @if($settings->sidebartwo=='hide') selected @endif value="hide" >hide</option>
           </select>
       </div>
       <br>
       <label><b>Navigation list</b></label>
       <div class="form-group ">
          <select class="form-control"  name="navigationlist" >
            <option @if($settings->navigationlist=='show') selected @endif value="show" >show</option>
            <option @if($settings->navigationlist=='hide') selected @endif value="hide" >hide</option>
          </select>
      </div>
      <br>
      <label><b>Display Panel</b></label>
      <div class="form-group ">
         <select class="form-control"  name="dpanel" >
            <option @if($settings->dpanel=='show') selected @endif value="show" >show</option>
            <option @if($settings->dpanel=='hide') selected @endif value="hide" >hide</option>
         </select>
     </div>
     <br>
     <label><b>Show blogs</b></label>
      <div class="form-group ">
         <select class="form-control"  name="viewblogs" >
            <option @if($settings->viewblogs=='show') selected @endif value="show" >show</option>
            <option @if($settings->viewblogs=='hide') selected @endif value="hide" >hide</option>
         </select>
     </div>
     <br>
     <label><b>Show Signup</b></label>
     <div class="form-group ">
        <select class="form-control"  name="viewsignup" >
           <option @if($settings->viewsignup=='show') selected @endif value="show" >show</option>
           <option @if($settings->viewsignup=='hide') selected @endif value="hide" >hide</option>
        </select>
    </div>
    <br>
     <label><b>Show Upgrade Package </b></label>
     <div class="form-group ">
        <select class="form-control"  name="usertype" >
           <option @if($settings->usertype=='show') selected @endif value="show" >show</option>
           <option @if($settings->usertype=='hide') selected @endif value="hide" >hide</option>
        </select>
    </div>
    <br>
     <label><b>Show Duplicate Button</b></label>
      <div class="form-group ">
         <select class="form-control"  name="dupbutton" >
            <option @if($settings->dupbutton=='show') selected @endif value="show" >show</option>
            <option @if($settings->dupbutton=='hide') selected @endif value="hide" >hide</option>
         </select>
     </div>
     <br>
     <label><b>Show Properties Button</b></label>
      <div class="form-group ">
         <select class="form-control"  name="propbutton" >
            <option @if($settings->propbutton=='show') selected @endif value="show" >show</option>
            <option @if($settings->propbutton=='hide') selected @endif value="hide" >hide</option>
         </select>
     </div>
     <br>
     <label><b>Show Basement Button</b></label>
      <div class="form-group ">
         <select class="form-control"  name="basebutton" >
            <option @if($settings->basebutton=='show') selected @endif value="show" >show</option>
            <option @if($settings->basebutton=='hide') selected @endif value="hide" >hide</option>
         </select>
     </div>
     <br>

            
            
            <button type="submit" class="w3-btn w3-green update_project" id="update_project" style="width: 48%;position: relative;left:20px;"> Update </button>
          </div>
          
          <div class="w3-container w3-padding-hor-16 ">
            
          </div>
      </form> 
    </div>
</div>
@section('scripts')
@parent

@endsection
@endsection