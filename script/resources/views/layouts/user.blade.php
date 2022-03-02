<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title') {{$setdata['name']}}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href="{{asset($setdata['favicon'])}}" />
  <meta name="description"
    content="@hasSection('description') @yield('description')@else {{$setdata['description']}} @endif" />
  <meta name="keywords" content="{{$setdata['keywords']}}" />
  <!-- font awesome icons -->
  <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet">
  <!-- bootstrap css -->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- owl carousel css -->
  <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
  <!-- Custom  -->

@if (!empty($setdata['google_analytics_code']))
  <!-- Google Analytics -->
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  
  ga('create', '{{$setdata['google_analytics_code']}}', 'auto');
  ga('send', 'pageview');
  </script>
  <!-- End Google Analytics -->
@endif

  <!--SET DYNAMIC VARIABLE IN STYLE-->
  <style>
    :root {
      --main-color: {{$setdata['main_color']}};
      --color1: {{$setdata['secondary_color']}};
    }
  </style>

  <!-- Custom Code -->
  {{$setdata['head_ad']}}


</head>

<body>

  <!-- Preloader Start -->
  <div class="preloader">
    <span></span>
  </div>
  <!-- Preloader End -->

  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <!--  Show this only on mobile to medium screens  -->
      <a class="navbar-brand d-lg-none" href="{{$setdata['site_url']}}"><img class="logo_mobile"
          src="{{asset($setdata['site_logo'])}}"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle"
        aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
      </button>
      <!--  Use flexbox utility classes to change how the child elements are justified  -->
      <div class="collapse navbar-collapse justify-content-between" id="navbarToggle">
        <!--   Show this only lg screens and up   -->
        <a class="navbar-brand d-none d-lg-block" href="{{$setdata['site_url']}}"><img class="logo"
            src="{{asset($setdata['site_logo'])}}"></a>
        <ul class="navbar-nav">
          @if (!empty($setdata['facebook']) && $setdata['facebook'] != "#")
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="{{$setdata['facebook']}}"><i class="fab fa-facebook-f"></i></a>
          </li>
          @endif
          @if (!empty($setdata['instagram']) && $setdata['instagram'] != "#")
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="{{$setdata['instagram']}}"><i class="fab fa-instagram"></i></a>
          </li>
          @endif
          @if (!empty($setdata['twitter']) && $setdata['twitter'] != "#")
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="{{$setdata['twitter']}}"><i class="fab fa-twitter"></i></a>
          </li>
          @endif
          @if (!empty($setdata['youtube']) && $setdata['youtube'] != "#")
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="{{$setdata['youtube']}}"><i class="fab fa-youtube"></i></a>
          </li>
          @endif
          @if (!empty($setdata['appstore']) && $setdata['appstore'] != "#")
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="{{$setdata['appstore']}}"><i class="fab fa-app-store"></i></a>
          </li>
          @endif
          @if (!empty($setdata['playstore']) && $setdata['playstore'] != "#")
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="{{$setdata['playstore']}}"><i class="fas fa-play"></i></a>
          </li>
          @endif
          @if (!empty($setdata['chrome_extensions']) && $setdata['chrome_extensions'] != "#")
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="{{$setdata['chrome_extensions']}}"><i
                class="fab fa-chrome"></i></a>
          </li>
          @endif
          @if (!empty($setdata['mozilla_extensions']) && $setdata['mozilla_extensions'] != "#")
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="{{$setdata['mozilla_extensions']}}"><i
                class="fab fa-firefox-browser"></i></a>
          </li>
          @endif

        </ul>
      </div>
    </div>
  </nav>

  <!-- Navbar End -->

  @yield('content')


  <!-- Footer Start -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="nav">
            @foreach ($pages as $page)
            <a href="{{route('page', $page->slug)}}">{{$page->title}}</a>
            @endforeach
            @if ($setdata['enable_blog'])
            <a href="{{route('blog')}}">{{$tran['Blog']}}</a>
            @endif
            <a href="{{route('contact')}}">{{$tran['Contact Us']}}</a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <p class="copyright-text">
            {!!$tran['Copyright']!!}
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer End -->

  <!-- jquery js -->
  <script src="{{ asset('assets/js/vendor/jquery.min.js') }}"></script>
  <!-- popper js -->
  <script src="{{ asset('assets/js/vendor/popper.min.js') }}"></script>
  <!-- bootstrap js -->
  <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
  <!-- ScrollIt js -->
  <script src="{{ asset('assets/js/vendor/scrollIt.min.js') }}"></script>
  <!-- OWl Carousel -->
  <script src="{{ asset('assets/js/vendor/owl.carousel.min.js') }}"></script>
  <!-- Clipboard -->
  <script src="{{ asset('assets/js/vendor/clipboard.min.js') }}"></script>
  <!-- Progress Bar -->
  <script src="{{ asset('assets/js/vendor/progress.js') }}"></script>

  
  <!--SET DYNAMIC VARIABLE IN SCRIPT-->
  <script>
    "use strict";
    var fetch_time = "{{$setdata['fetch_time']}}",
    url = "{{route('messages')}}" ,
    color = "{{$setdata['secondary_color']}}" ;
  </script>
  <!-- main js -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>