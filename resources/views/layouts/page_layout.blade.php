

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('vergecad/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vergecad/responsive.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Buildings Trees</title>
</head>
<body>
    <?php 
    
    use App\SiteSetting;
    $settings =  SiteSetting::first();
    
    ?>
    <header class="bg-gray">
        <div class="header-left">
            <a href="/">
                <img src=" {{ asset('vergecad/assets/img/logo.png') }}" alt="">
            </a>
        </div>
        <div class="header-right">
            @if($settings->viewblogs=='show')
            <a href="{{ route('latestblog') }}" class="header-navlink text-dark">Blogs</a>
            @endif
            <a href="/login" class="bg-color-danger text-light header-navlink login-link">LOGIN</a>
            @if($settings->viewsignup=='show')   <a href="/register" class="bg-color-secondary text-light header-navlink signup-link">SIGNUP</a>     @endif
        </div>
        <div id='menu'>
            <div class='menu-line1'></div>
            <div class='menu-line2'></div>
          </div>
    </header>

    <div class="mobile-menu bg-gray">
        @if($settings->viewblogs=='show')
        <a href="{{ route('latestblog') }}" class="header-navlink text-dark">Blogs</a>
        @endif
        <a href="/login" class="bg-color-danger text-light header-navlink login-link">LOGIN</a>
        @if($settings->viewsignup=='show')  <a href="/register" class="bg-color-secondary text-light header-navlink signup-link">SIGNUP</a>     @endif
    </div>

 
    @yield("content")
    <footer class="pt-5">

        <div class="container">
            <h5 class="text-red mt-5">Address</h5>
            <p class="mb-0"><img src=" {{ asset('vergecad/assets/icons/tick.png') }}" alt=""> {{ $settings->address }}</p>
            <p><img src=" {{ asset('vergecad/assets/icons/mail.png') }}" alt="">{{ $settings->email }}</p>
        </div>

        <div class="container copyright">
            Copyright @ Vergecad 2022. All Rights Reserved.
        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="{{ asset('vergecad/main.js') }}"></script>
</body>
</html>

{{-- 
<section>
    <nav> 
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn"> 
            <i class="fas fa-bars"></i> 
        </label> 
            @if($logo->logo)
        <a href="./">
            
            <label  class="logo"><img src="{{$logo->logo}}" class="img-responsive" style="width: 100%;height: auto"></label>
        </a>
        @else
        <a href="./">
            
            <label  class="logo">BT</label>
        </a>
        @endif
        <ul>
            <li><a class="" href="./">HOME</a></li>
            <li><a href="{{url('/support')}}">SUPPORT</a></li>
            <li><a href="{{url('/faq')}}">FAQ</a></li>
            
            <li><a href="{{url('/feature')}}">FEATURE</a></li>
        </ul>
    </nav>
  </section>
  <div class="clearfix"></div>
<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page" style="">
    <div class="">
        <div class="">
          
        </div>
    </div>
</body>

</html> --}}
