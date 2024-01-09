@extends('layouts.page_layout')
@section('content')
<section class="banner" style="background-image: url({{ asset($settings->hero) }});">

    <div class="container">
        <div class="col-lg-6">
            <h1>{{ $settings->homepagetext1 }}</h1>
            <h2>{{ $settings->homepagetext2 }}</h2>
            <p>{{ $settings->homepagetext3 }}</p>
            <form method="POST" action="{{ route('addsubsription') }}" class="banner-form">
                <h3>{{ $settings->subscriptiontxt }}</h3>
                @if(\Session::has('message'))
                <p class="alert alert-info">
                    {{ \Session::get('message') }}
                </p>
            @endif
            @if($errors->has('email'))
            <div class="alert alert-danger">
                {{ $errors->first('email') }}
            </div>
        @endif
                {{ csrf_field() }}
                <div class="banner-form-container">
                    <input name="email" type="email" placeholder="Your email address" required>
                    
                    <button submit class="bg-red">Subscribe</button>
                </div>
            </form>
        </div>
    </div>

</section>

<section class="bg-gray py-5">

    <h2 class="text-red section-title">How It Works</h2>

    <div class="container mt-5">

        <img src="{{ asset($settings->hiwi) }}" class="w-100 my-3 steps" alt="">

        <img src=" {{ asset($settings->hiwi) }}" class="w-100 my-3 steps-mobile" alt="">

    </div>

</section>

<section class="faq py-5">

    <h2 class="text-light section-title mb-5">FAQ</h2>

    <div class="container">
        <div class="accordion" id="accordionExample">
@php
  $i=0;   
@endphp
          @foreach($faqs as $faq)
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne{{ $faq->id }}">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $faq->id }}" aria-expanded="true" aria-controls="collapseOne{{ $faq->id }}">
                   {{ $faq->question }}
                </button>
              </h2>
              <div id="collapseOne{{ $faq->id }}" class="accordion-collapse collapse @if($i==0) show @endif  " aria-labelledby="headingOne{{ $faq->id }}" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  {{ $faq->answer }}
                </div>
              </div>
            </div>
            @php
            $i++;   
          @endphp
            @endforeach
        </div>
    </div>

</section>
  <div class="container">
    <div class="row">
      <div class="col-12">
        
        
      </div>
    </div>
  </div>
@endsection
