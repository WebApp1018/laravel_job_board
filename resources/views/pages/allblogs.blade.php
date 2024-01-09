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
          <h1 class="fw-bolder text-center">Our  Blog Posts</h1>
        </div>
        {{-- <div class="col-lg-2 col-md-5 col-sm-12">
          <button
            class="bg-color-danger text-light header-navlink login-link w-100 rounded-pill text-uppercase mt-2"
            type="button"
          >
            <small>See All Blogs Posts</small>
          </button>
        </div> --}}
      </div>
    </div>

    <div class="row my-3">
        @if(!empty($blogs))
        @foreach($blogs as $blog )
      <div class="col-12 col-md-6 col-lg-4 pb-2">
        <div class="border rounded border-danger p-2 card-height">
          <div class="py-4">
            <a href="{{url('Blog/'.$blog->slug.'')}}">  <img src="{{ asset($blog->image) }}" alt="" class="card-img mb-3" /> </a>
            <p class="fw-bold text-red">
              <a href="{{url('Blog/'.$blog->slug.'')}}">   {{ $blog->title }} </a>
            </p>
            <small class="fs-12">
                { !! \Illuminate\Support\Str::limit($blog->description, 100, $end='...') !! }
            </small>
          </div>
        </div>
      </div>
     
     @endforeach

     <div class="d-flex align-items-center justify-content-center mt-4">
      {!! $blogs->links() !!}	
    </div>
     @else 
     <p>No blog posts</p>  
     @endif

      
      </div>
    </div>
  </div>
@endsection
