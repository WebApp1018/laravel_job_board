@extends('layouts.page_layout')
@section('content')

<style>
.smallblogimages{
    width: 120px;
    height: 70px;
    object-fit: cover;
}
.card-img {
    object-fit: cover;
}
.blogimg {
    width: 400px;
    height: 200px;
    object-fit: cover;
    margin-right: 10px;
}
a {
    color: #ff0000;
}
</style>
<div class="container">
    <div class="mt-5">
      <div class="row">
        <div class="col-lg-10 col-md-7 col-sm-12">
          <h1 class="fw-bolder text-center">{{ $blog->title }}</h1>
        </div>
        <div class="col-lg-2 col-md-5 col-sm-12">
          <a  href="{{ route('allblogs') }}"
            class="bg-color-danger text-light header-navlink login-link w-100 rounded-pill text-uppercase mt-2"
           
          >
            <small>See All Blogs Posts</small>
          </a>
        </div>
      </div>
    </div>

    <div class="row my-3">
      <div class="col-12 col-md-8  pb-2">
        <div class="blog-view">

          <div class="row ">
             
             <div class="text-column col-lg-12 col-md-12 col-sm-12">
              <div class="s-about-content  wow fadeInRight" data-animation="fadeInRight" data-delay=".2s" style="visibility: visible; animation-name: fadeInRight;">  
            
                <div class="team-img-box" style="float: left;margin-right: 15px;">
                  <img class="blogimg" src="{{ asset($blog->image) }}" alt="img">
                </div>
                
                 <p style="text-align: justify;">
                {!! $blog->description !!}
                 </p>
                
<div class="d-flex justify-content-end">
<i class="far fa-calendar mr-2"></i> {{ date('d M Y' , strtotime
              
($blog->created_at)) }} 
</div>
                


               </div>
             </div>
   
            
           </div>
      </div>
    </div>
      <div class="col-12 col-md-4  pb-2">
        <div class="border rounded border-danger p-2 card-height">
          <div class="pt-4">
            <div class="row">
                @if(!empty($new))
                @for($i=0; $i < count($new); $i++  )
              <div class="">
                <div class="col-12 d-flex">
                  <a href="{{url('Blog/'.$new[$i]['slug'].'')}}"> <img class="smallblogimages" src="{{ asset($new[$i]['image']) }}" alt="" /> </a>
                  <small class="fs-12 p-3 text-dark">
                    <a href="{{url('Blog/'.$new[$i]['slug'].'')}}">  {{ $new[$i]['title'] }} </a>
                  </small>
                </div>
                <hr class="w-90 text-center text-warning my-2" />
              </div>

              @endfor

              @else 
             <p>No blog posts</p>  
              @endif

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
