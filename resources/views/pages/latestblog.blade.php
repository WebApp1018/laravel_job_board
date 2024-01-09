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
a {
    color: #ff0000;
}
</style>
<div class="container">
    <div class="mt-5">
      <div class="row">
        <div class="col-lg-10 col-md-7 col-sm-12">
          <h1 class="fw-bolder text-center">Our Latest Blog Posts</h1>
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
        @if(!empty($blogs))
        @for($i=0; $i < count($blogs); $i++  )
      <div class="col-12 col-md-6 col-lg-4 pb-2">
        <div class="border rounded border-danger p-2 card-height">
          <div class="py-4">
            <a href="{{url('Blog/'.$blogs[$i]['slug'].'')}}">  <img src="{{ asset($blogs[$i]['image']) }}" alt="" class="card-img mb-3" /></a>
            <p class="fw-bold text-red">
                <a href="{{url('Blog/'.$blogs[$i]['slug'].'')}}"> {{ $blogs[$i]['title'] }} </a>
            </p>
            <small class="fs-12">
              <?php $des =   strip_tags($blogs[$i]['description']); ?>
                {{ \Illuminate\Support\Str::limit( $des, 100, $end='...') }}
            </small>
          </div>
        </div>
      </div>
     
     @endfor
     @else 
     <p>No blog posts</p>  
     @endif
     @if(!empty($new))
      <div class="col-12 col-md-6 col-lg-4 pb-2">
        <div class="border rounded border-danger p-2 card-height">
          <div class="pt-4">
            <div class="row">
               
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

            

            </div>
          </div>
        </div>

          @endif
      </div>
    </div>
  </div>
@endsection
