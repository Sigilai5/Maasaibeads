<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Maasai Beads</title>
    <link rel="shortcut icon" href="images/home/logo.jpg" />
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
    <![endif]-->
    <link rel="shortcut icon" href="{{asset('images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('images/ico/apple-touch-icon-57-precomposed.png')}}">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
</head><!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +254703808145</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> scentsbygeraldine@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
{{--                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>--}}
{{--                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{route('allProducts')}}"><img src="images/home/logo.jpg" alt="" width="300px" height="250px"/></a>
                    </div>
                    <div class="btn-group pull-right">
{{--                        <div class="btn-group">--}}
{{--                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">--}}
{{--                                USA--}}
{{--                                <span class="caret"></span>--}}
{{--                            </button>--}}
{{--                            <ul class="dropdown-menu">--}}
{{--                                <li><a href="#">Canada</a></li>--}}
{{--                                <li><a href="#">UK</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}

{{--                        <div class="btn-group">--}}
{{--                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">--}}
{{--                                DOLLAR--}}
{{--                                <span class="caret"></span>--}}
{{--                            </button>--}}
{{--                            <ul class="dropdown-menu">--}}
{{--                                <li><a href="#">Canadian Dollar</a></li>--}}
{{--                                <li><a href="#">Pound</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
{{--                            <li><a href="#"><i class="fa fa-user"></i> Account</a></li>--}}
{{--                            <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>--}}
{{--                            <li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>--}}
                            <li><a href="{{route('cartProducts')}}"><i class="fa fa-shopping-cart"></i>

                                    <span class="cart-with-numbers">

                                        @if(Session::has('cart'))
                                            {{ Session::get('cart')->totalQuantity  }}
                                            @endif

                                    </span>





                                    Cart</a></li>

                            @if(Auth::check())
                            <li><a href="/home"><i class="fa fa-lock"></i> Profile</a></li>
                            @else
                                <li><a href="/login"><i class="fa fa-lock"></i> Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->
