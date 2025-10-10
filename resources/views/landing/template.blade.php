<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="CareMed demo project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ asset('landing/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/styles/responsive.css') }}">
    @stack('styles')
    <style>
        .home_background.parallax-window {
            background-color: rgba(0, 0, 0, 0.4);
            background-blend-mode: overlay;
        }
    </style>
</head>
<body>

<div class="super_container">

    <!-- Header -->

    <header class="header trans_200">

        <!-- Top Bar -->
        <div class="top_bar">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
                            <div class="top_bar_item"><a href="#"></a></div>
                            <div class="top_bar_item"><a href="#"></a></div>
                            <div class="emergencies  d-flex flex-row align-items-center justify-content-start ml-auto"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Content -->
        <div class="header_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header_content d-flex flex-row align-items-center justify-content-start">
                            <nav class="main_nav ml-auto">
                                <ul>
                                    <li><a href="{{ route('home') }}">Beranda</a></li>
                                    <li><a href="{{ route('profil') }}">Profil</a></li>
                                    <li><a href="{{ route('layanan') }}">Layanan</a></li>
                                </ul>
                            </nav>
                            <div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logo -->
        <div class="logo_container_outer">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="logo_container">
                            <a href="#">
                                <div class="logo_content d-flex flex-column align-items-start justify-content-center">
                                    <div class="logo_line"></div>
                                    <div class="logo d-flex flex-row align-items-center justify-content-center">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/0/08/Lambang_kabupaten_nias_barat.jpg" alt="logo" width="70" style="margin-left: 30px">
                                    </div>
                                    <div class="logo_sub">RS Pratama Nias Barat</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>

    <!-- Menu -->

    <div class="menu_container menu_mm">

        <!-- Menu Close Button -->
        <div class="menu_close_container">
            <div class="menu_close"></div>
        </div>

        <!-- Menu Items -->
        <div class="menu_inner menu_mm">
            <div class="menu menu_mm">
                <ul class="menu_list menu_mm">
                    <li class="menu_item menu_mm"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="menu_item menu_mm"><a href="{{ route('profil') }}">Profil</a></li>
                    <li class="menu_item menu_mm"><a href="{{ route('layanan') }}">Layanan</a></li>
                </ul>
            </div>
            <div class="menu_extra">
                <div class="menu_appointment"><a href="#"></a></div>
                <div class="menu_emergencies"></div>
            </div>

        </div>

    </div>

    <!-- Content -->
    @yield('body')
    <!-- End Content -->

    <!-- Footer -->

    <footer class="footer">
        <div class="footer_container">
            <div class="container">
                <div class="row">

                    <!-- Footer - About -->
                    <div class="col-lg-4 footer_col">
                        <div class="footer_about">
                            <div class="footer_logo_container">
                                <a href="#" class="d-flex flex-column align-items-center justify-content-center">
                                    <div class="logo_content">
                                        <div class="logo d-flex flex-row align-items-center justify-content-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/0/08/Lambang_kabupaten_nias_barat.jpg" alt="logo" width="80">
                                        </div>
                                        <div class="logo_sub">RS Pratama Nias Barat</div>
                                    </div>
                                </a>
                            </div>
                            <ul class="footer_about_list">
                                <li><div class="footer_about_icon"><img src="{{ asset('landing/images/phone-call.svg') }}" alt=""></div><span>0822-2564-9298</span></li>
                                <li><div class="footer_about_icon"><img src="{{ asset('landing/images/placeholder.svg') }}" alt=""></div><span>JL. Budi Utomo Desa Onolimbu Kec. Lahomi</span></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Footer - Links -->
                    <div class="col-lg-4 footer_col">
                        <div class="footer_links footer_column">
                            <div class="footer_title">Tautan</div>
                            <ul>
                                <li><a href="{{ route('home') }}">Beranda</a></li>
                                <li><a href="{{ route('profil') }}">Profil</a></li>
                                <li><a href="{{ route('layanan') }}">Layanan</a></li>
                                <li><a href="#">Kontak</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="copyright_content d-flex flex-lg-row flex-column align-items-lg-center justify-content-start">
                            <div class="cr">
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> RS Pratama Nias Barat
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="{{ asset('landing/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('landing/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('landing/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('landing/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('landing/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('landing/plugins/parallax-js-master/parallax.min.js') }}"></script>
<script src="{{ asset('landing/js/custom.js') }}"></script>
@stack('scripts')
</body>
</html>
