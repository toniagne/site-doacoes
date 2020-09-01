<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ Config::get('app.title') }} - {{ Config::get('app.subtitle') }} @yield('title')</title>
    <meta name="description" content="{{ Config::get('app.subtitle') }}">

    <!--Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Karla:400,400italic,700italic,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lora:400,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!--Bootstrap-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}">
    <!--Font Awesome-->
    <link rel="stylesheet" href=" {{ asset('css/font-awesome.min.css')}}">
    <!--Owl Carousel-->
    <link rel="stylesheet" href="{{ asset('vendors/owl.carousel/owl.carousel.css')}}">
    <!--Magnific Popup-->
    <link rel="stylesheet" href="{{ asset('vendors/magnific-popup/magnific-popup.css')}}">
    <!--Flip Clock-->
    <link rel="stylesheet" href="{{ asset('vendors/flip-clock/flipclock.css')}}">

    <!--Theme Styles-->
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/theme.css')}}">

    <!--[if lt IE 9]>

    <script src="{{ asset('js/html5shiv.min.js')}}"></script>
    <script src="{{ asset('js/respond.min.js')}}"></script>
    <![endif]-->
    @stack('style')
</head>

<body class="home-page-2">

<nav class="navbar navbar-default navbar-static-top navbar2">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNav" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="nav navbar-nav">
                <li class="{{ (request()->is('/')) ? 'active' : '' }}">
                    <a href="{{ route('home') }}" >Home</a>
                </li>
                <li class="{{ (request()->is('about')) ? 'active' : '' }}">
                    <a href="{{ route('about') }}">About</a>
                </li>
                <li class="{{ (request()->is('campaign/*')) ? 'active' : '' }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Campaigns</a>
                    <ul class="dropdown-menu">
                        @foreach ($campaigns as $campaing)
                            <li><a href="{{ route('campaign-details', $campaing->slug) }}">{{$campaing->title}}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <ul class="nav social_navbar navbar-right">
                <li><a href="https://www.facebook.com/bitexchangeofficial/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://www.instagram.com/bitexchangeofficial/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                <li> </li>
            </ul>
        </div>
    </div>
</nav>

<header class="row header1">
    <div class="container">

        <div class="logo pull-left">
            <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png')}}" alt=""></a>
        </div>

        <a href="{{ route('campaigns-list') }}" class="btn-primary btn-outline hidden-sm hidden-xs pull-right">Make a donation</a>

        <div class="pull-right emergency-contact">
            <div class="pull-left">
                <span><i class="fa fa-envelope-o"></i></span>
                <div class="infos_col">
                    <h6>e-mail</h6>
                    <a href="mailto:{{ Config::get('app.siteConfigs.email') }}"><h5>{{ Config::get('app.siteConfigs.email') }}</h5></a>
                </div>
            </div>
        </div>
    </div>
</header>


@yield('content')

<section class="row recent_products">
    <div class="container">
        <div class="row sectionTitle text-center">
            <h3>Partners</h3>
        </div>
        <div class="row">
            <div class="recent_product_carosel">

                @foreach ($partners as $partner)
                <div class="item product">
                    <div class="images_row row m0">
                        <div id="product_carousel_inner" class="carousel slide" data-ride="carousel" data-interval="3000">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <a href="{{ $partner->website }}" target="_blank">
                                        <img src="{{ asset('images/'.$partner->image ) }}"  height="150px" alt="">
                                    </a>
                                </div>
                           </div>
                        </div>
                    </div>

                </div>
                @endforeach


            </div>
        </div>
    </div>
</section>



<footer class="row foooter footer2">
    <div class="container">
        <div class="row footer_sidebar">
            <div class="widget widget-about col-sm-6 col-md-6">
                <h5 class="widget-title">{{ $about->title }}</h5>
                <p>{{ $about->introduction }}</p>
                <a href="{{ route('about') }}" class="btn-primary btn-outline white">about us</a>
            </div>
            <div class="widget widget-recent-posts col-sm-6 col-md-6">
                <h5 class="widget-title">recent campaigns</h5>
                <ul class="nav recent-posts">
                    @foreach($campaigns as $campaing)
                        <li><a href="{{ route('campaign-details', $campaing -> slug) }}">{{ $campaing -> title }}</a></li>
                    @endforeach

                </ul>
            </div>

        </div>
    </div>

    <div class="row copyright_area m0">
        <div class="container">
            <div class="copy_inner row">
                <div class="col-sm-7 copyright_text">Copyright {{ date('Y') }}. All rights reserved to  <a href="#">{{ $about->title }}</a>.</div>
                <div class="col-sm-5 footer-nav">
                    <ul class="nav">
                        <li><a href="{{ route('privacy') }}">Privacy terms</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


<!--Donate Form-->
<form action="#" method="get" class="row m0 donate_form mfp-hide" id="donate_box">
    <h3>ENTER YOUR DONATION AMOUNT</h3>

    <input type="radio" name="donate-amount" id="donate-amount01" value="10">
    <label for="donate-amount01">
        <strong>DONATE <span>$10</span></strong><br>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa ips tum sed, suscipit sit amet arcu. Ut ut finibus tortor
    </label>

    <input type="radio" name="donate-amount" id="donate-amount02" value="25">
    <label for="donate-amount02">
        <strong>DONATE <span>$10</span></strong><br>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa ips tum sed, suscipit sit amet arcu. Ut ut finibus tortor
    </label>

    <input type="radio" name="donate-amount" id="donate-amount03" value="100">
    <label for="donate-amount03">
        <strong>DONATE <span>$10</span></strong><br>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa ips tum sed, suscipit sit amet arcu. Ut ut finibus tortor
    </label>

    <input type="radio" name="donate-amount" id="donate-amount04" value="500">
    <label for="donate-amount04">
        <strong>DONATE <span>$10</span></strong><br>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa ips tum sed, suscipit sit amet arcu. Ut ut finibus tortor
    </label>

    <h5>ENTER CUSTOM AMOUNT</h5>

    <div class="input-group">
        <span class="input-group-addon left">$</span>
        <input type="number" class="form-control" name="donate-amount">
        <span class="input-group-addon right">
                <button type="submit" class="btn-primary">donate now</button>
            </span>
    </div>
</form>

<script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!--Magnific Popup-->
<script src="{{ asset('vendors/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<!--Owl Carousel-->
<script src="{{ asset('vendors/owl.carousel/owl.carousel.min.js') }}"></script>
<!--Flip Clock-->
<script src="{{ asset('vendors/flip-clock/flipclock.min.js') }}"></script>
<!--CounterUp-->
<script src="{{ asset('vendors/couterup/jquery.counterup.min.js') }}"></script>
<!--WayPoints-->
<script src="{{ asset('vendors/waypoint/waypoints.min.js') }}"></script>
<!--Theme Script-->
@stack('script')

<script src="{{ asset('js/theme.js') }}"></script>
<script src="{{ asset('js/utils.js') }}" charset="utf-8"></script>



</body>

<!-- end::Body -->
</html>
