<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SonnaCake  @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS
    ========================= -->

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!--modernizr min js here-->
    <script src="{{ asset('assets/js/vendor/modernizr-3.7.1.min.js') }}"></script>
</head>

<body >

<!-- Main Wrapper Start -->
<div class="home_black_version" id="home_black_version">
    <!--Offcanvas menu area start-->
    <div class="off_canvars_overlay">

    </div>
    <div class="Offcanvas_menu Offcanvas_five">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="canvas_open">
                        <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                    </div>
                    <div class="Offcanvas_menu_wrapper" style="background-color: pink">
                        <div class="canvas_close">
                            <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                        </div>


                        <div class="contact_box">
                            <p>Zəng edin:  <a href="tel:994 70 311 11 34">+994 70 311 11 34</a> </p>
                        </div>
                        <div id="menu" class="text-left ">
                            <ul class="offcanvas_main_menu">
                                <li class="menu-item-has-children active">
                                    <a href="{{ route('welcome') }}">Əsas səhifə</a>
                                </li>

                                <li class="menu-item-has-children">
                                    <a href="{{ route('categoryIndex') }}">Tort kateqoriyaları<i class="fa fa-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        @foreach($__categories AS $category)
                                            <li><a href="{{ route('categoryShow', $category->id) }}">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>

                                </li>
                                <li class="menu-item-has-children active">
                                    <a href="{{ route('productIndex') }}"> Məhsullar</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="tel:994 70 311 11 34"> Bizimlə əlaqə</a>
                                </li>
                            </ul>
                        </div>
                        <div class="Offcanvas_footer">
                            <span><a href="#"><i class="fa fa-envelope-o"></i> info@sonnacake.com</a></span>
                            <ul>
                                <li class="facebook"><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Offcanvas menu area end-->

    <!--header area start-->
    <header class="header_area header_black">


        <!--header middle start-->
        <div class="header_middel">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-5">
                        <div class="home_contact">
                            <div class="contact_icone">
                                <img src="assets/img/icon/icon_phone.png" alt="">
                            </div>
                            <div class="contact_box">
                                <p>Ödənişsiz Konsultasiya: <a href="tel:994 70 311 11 34">+994 70 311 11 34</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-4">
                        <div class="logo">
                            <a href=""><img src="assets/img/logo/logo-3.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-7 col-6">
                        <div class="middel_right">
                            <div class="search_btn">
                                <a href="#"><i class="ion-ios-search-strong"></i></a>
                                <div class="dropdown_search">
                                    <form action="{{ route('search') }}" method="get">
                                        @csrf
                                        <input placeholder="İstədiyiniz məhsulu axtarın" type="text" name="search">
                                        <button type="submit"><i class="ion-ios-search-strong"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--header middel end-->

        <!--header bottom satrt-->
        <div class="header_bottom sticky-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="main_menu_inner">
                            <div class="logo_sticky">
                                <a href="{{ route('welcome') }}"><img src="{{ asset('assets/img/logo/logo-3.png') }}" alt=""></a>
                            </div>
                            <div class="main_menu">
                                <nav>
                                    <ul>

                                        <li class="active"><a href="{{ route('welcome') }}">Home</a>
                                        </li>
                                        <li><a href="{{ route('categoryIndex') }}">Tort kateqoriyaları<i class="fa fa-angle-down"></i></a>
                                            <ul class="sub_menu pages">
                                                @foreach($__categories AS $category)
                                                <li><a href="{{ route('categoryShow', $category->id) }}">{{ $category->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('productIndex') }}">Bütün Tortlar</a></li>
                                        <li><a href="{{ route('categoryIndex') }}">Kateqoriyalar</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--header bottom end-->
    </header>
    <!--header area end-->

    <div class="lds-ellipsis center" id="preloader">
        <div></div><div></div><div></div><div></div>
    </div>
    @yield('content')

    <!--footer area start-->
    <footer class="footer_widgets footer_black">
        <div class="container">
            <div class="footer_bottom">
                <div class="row">
                    <div class="col-12">
                        <div class="copyright_area">
                            <p>&copy; 2023 <a href="{{ route('welcome') }}" class="text-uppercase">SonnaCake</a>. Made with <i class="fa fa-heart"></i> by <a target="_blank" href="https://babayeff.info">TheBabayeff</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--footer area end-->
</div>


<script>
    window.addEventListener('load', () => {
        const preloader = document.getElementById('preloader');
        const mainContent = document.getElementById('home_black_version');

        preloader.style.display = 'none';
        mainContent.style.display = 'block';
    });

</script>



<!-- JS
============================================ -->

<!-- Plugins JS -->
<script src="{{ asset('assets/js/vendor/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.main.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nice.select.js') }}"></script>
<script src="{{ asset('assets/js/scrollup.js') }}"></script>
<script src="{{ asset('assets/js/ajax.chimp.js') }}"></script>
<script src="{{ asset('assets/js/jquery.ui.js') }}"></script>
<script src="{{ asset('assets/js/jquery.elevatezoom.js') }}"></script>
<script src="{{ asset('assets/js/imagesloaded.js') }}"></script>
<script src="{{ asset('assets/js/isotope.main.js') }}"></script>
<script src="{{ asset('assets/js/jqquery.ripples.js') }}"></script>
<script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>
<script src="{{ asset('assets/js/bpopup.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>



</body>

</html>
