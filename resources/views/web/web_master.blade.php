<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MartPlace - Complete Online Multipurpose Marketplace HTML Template">
    <meta name="keywords" content="marketplace, easy digital download, digital product, digital, html5">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Marketplate</title>

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontello.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lnr-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/trumbowyg.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/dropzone/dropzone.css') }}">

    <!-- Font Awesome -->
    <link href="{{ asset('assets/fontawesome/css/fontawesome.css')  }}" rel="stylesheet">
    <link href="{{ asset('assets/fontawesome/css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/fontawesome/css/solid.css') }}" rel="stylesheet">

    <!-- endinject -->
</head>

<body class="preload home1 mutlti-vendor">

    <!-- ================================
    START MENU AREA
================================= -->
    <!-- start menu-area -->
    <div class="menu-area">
        <!-- start .top-menu-area -->
        <div class="top-menu-area">
            <!-- start .container -->
            <div class="container">
                <!-- start .row -->
                <div class="row">
                    <!-- start .col-md-3 -->
                    <div class="col-lg-3 col-md-3 col-6 v_middle">
                        <div class="logo">
                            <a href="{{ URL::to('/') }}">
                                <img src="{{ asset('assets/images/logo_mp1.png') }}" alt="logo image" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <!-- end /.col-md-3 -->

                    <!-- start .col-md-5 -->
                    <div class="col-lg-8 offset-lg-1 col-md-9 col-6 v_middle">
                        <!-- start .author-area -->
                        <div class="author-area">
                            @if(Session::has('id'))
                            @if(Session::get('role') == 'pelapak')
                            <a href="{{ URL::to('/jual') }}" class="author-area__seller-btn inline">Jual</a>
                            @endif
                            @endif

                            <div class="author__notification_area">
                                <ul>
                                    <li class="has_dropdown">
                                        <div class="icon_wrap">
                                            <span class="fa fa-shopping-cart fa-lg" style="color: green;"></span>
                                            <span class="notification_count purch">@if(Session::has('id')) {{ COUNT($cart) }} @else 0 @endif</span>
                                        </div>

                                        <div class="dropdowns dropdown--cart">
                                            <div class="cart_area">
                                                @if(Session::has('id'))

                                                @foreach($cart as $c)
                                                <div class="cart_product">
                                                    <div class="product__info">
                                                        <div class="thumbn">
                                                            <img src="{{ asset('assets/foto_produk/'.$c->produk->foto_produk[0]->foto_produk) }}" alt="cart product thumbnail">
                                                        </div>

                                                        <div class="info">
                                                            <a class="title" href="{{ URL::to('produk/detail/'.$c->produk->id_produk) }}">{{ $c->produk->nama_produk }}</a>
                                                            <div class="cat">
                                                                <a href="#">
                                                                    <img src="images/catword.png" alt="">{{ $c->produk->kategori->nama_kategori }}</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="product__action">
                                                        {{-- <a href="#">--}}
                                                        {{-- <span class="lnr lnr-trash"></span>--}}
                                                        {{-- </a>--}}
                                                        <p>@currency($c->harga_jual)</p>
                                                    </div>
                                                </div>
                                                @endforeach

                                                @endif
                                                <div class="cart_action">
                                                    <a class="go_cart" href="/keranjang">Lihat Keranjang</a>
                                                    <a class="go_checkout" href="checkout.html">Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!--start .author__notification_area -->

                            <!--start .author-author__info-->
                            <div class="author-author__info inline has_dropdown">
                                <div class="author__avatar">
                                    <img src="http://www.johnmeyerwebdev.com/images/Me-Avatar-Maker.svg" alt="user avatar">
                                    <!-- <img src="{{ asset('assets/images/usr_avatar.png') }}" alt="user avatar"> -->
                                </div>
                                <div class="autor__info">
                                    <p class="name">
                                        Halo @if (Auth::guard(Session::get('role'))->check())
                                        {{ Auth::guard(Session::get('role'))->user()->username }}
                                        @endif
                                    </p>
                                    {{-- <p class="ammount">$20.45</p>--}}
                                </div>

                                <div class="dropdowns dropdown--author">
                                    <ul>
                                        @if (Auth::guard(Session::get('role'))->check())
                                        <li>
                                            <a href="{{ URL::to('pesanan') }}">
                                                <span class="fa fa-shopping-bag"></span>Pesanan Anda</a>
                                        </li>
                                        <li>
                                            <a href="{{ URL::to('profile') }}">
                                                <span class="fa fa-user"></span>Profile</a>
                                        </li>
                                        <li>
                                            <a href="{{ URL::to('konfirmasi') }}">
                                                <span class="fa fa-user"></span>Konfirmasi Pembayaran</a>
                                        </li>
                                        <li>
                                            <a href="{{ URL::to('keluar') }}">
                                                <span class="fa fa-sign-out-alt"></span>Keluar</a>
                                        </li>
                                        @else
                                        <li>
                                            <a href="{{ URL::to('login') }}">
                                                <span class="fa fa-sign-in-alt"></span>Masuk</a>
                                        </li>
                                        <li>
                                            <a href="{{ URL::to('register') }}">
                                                <span class="fa fa-user-edit"></span>Daftar</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <!--end /.author-author__info-->
                        </div>
                        <!-- end .author-area -->

                        <!-- author area restructured for mobile -->
                        <div class="mobile_content ">
                            <span class="fa fa-user-circle menu_icon"></span>
                            <!-- <span class="lnr lnr-user menu_icon"></span> -->
                            <!-- offcanvas menu -->
                            <div class="offcanvas-menu closed">
                                <span class="fa fa-window-close fa-lg close_menu" style="color: blue;"></span>
                                <div class="author-author__info">
                                    <div class="author__avatar v_middle">
                                        <img src="http://www.johnmeyerwebdev.com/images/Me-Avatar-Maker.svg" alt="user avatar">
                                    </div>
                                    <div class="autor__info v_middle">
                                        <p class="name">
                                            Halo @if (Auth::guard(Session::get('role'))->check())
                                            {{ Auth::guard(Session::get('role'))->user()->username }}
                                            @endif
                                        </p>
                                        <p class="ammount">$20.45</p>
                                    </div>
                                </div>
                                <!--end /.author-author__info-->

                                <div class="author__notification_area">
                                    <ul>
                                        <li>
                                            <a href="{{ URL::to('keranjang') }}">
                                                <div class="icon_wrap">
                                                    <span class="fa fa-shopping-cart fa-lg" style="color: green;"></span>
                                                    <span class="notification_count purch">@if(Session::has('id')) {{ COUNT($cart) }} @else 0 @endif</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!--start .author__notification_area -->

                                <div class="dropdowns dropdown--author">
                                    <ul>
                                        @if (Auth::guard(Session::get('role'))->check())
                                        <li>
                                            <a href="/pesanan">
                                                <span class="fa fa-shopping-bag"></span>Pesanan Anda</a>
                                        </li>
                                        <li>
                                            <a href="{{ URL::to('profile') }}">
                                                <span class="fa fa-user"></span>Profile</a>
                                        </li>
                                        <li>
                                            <a href="/keluar">
                                                <span class="fa fa-sign-out-alt"></span>Keluar</a>
                                        </li>
                                        @else
                                        <li>
                                            <a href="/login">
                                                <span class="fa fa-sign-in-alt"></span>Masuk</a>
                                        </li>
                                        <li>
                                            <a href="/register">
                                                <span class="fa fa-user-edit"></span>Daftar</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>

{{--                                <div class="text-center">--}}
{{--                                    <a href="{{ URL::to('/jual') }}" class="author-area__seller-btn inline">Jual</a>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <!-- end /.mobile_content -->
                    </div>
                    <!-- end /.col-md-5 -->
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end  -->

        <!-- start .mainmenu_area -->
        <div class="mainmenu">
            <!-- start .container -->
            <div class="container">
                <!-- start .row-->
                <div class="row">
                    <!-- start .col-md-12 -->
                    <div class="col-md-12">
                        <div class="navbar-header">
                            <!-- start mainmenu__search -->
                            <div class="mainmenu__search">
                                <form action="{{ URL::to('produk')  }}">
                                    <div class="searc-wrap">
                                        <input type="text" name="cari" placeholder="Cari Produk">
                                        <button type="submit" class="search-wrap__btn">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- start mainmenu__search -->
                        </div>

                        <nav class="navbar navbar-expand-md navbar-light mainmenu__menu">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="has_dropdown">
                                        <a href="{{ URL::to('/') }}"><span class="fa fa-home"></span> HOME</a>

                                    </li>
                                    <li class="has_dropdown">
                                        <a href="{{ URL::to('produk') }}"><span class="fa fa-store"></span> SEMUA PORDUK</a>

                                    </li>
                                    <li class="has_dropdown">
                                        <a href="#"><span class="fa fa-arrow-alt-circle-down"></span> KATEGORI</a>

                                        <div class="dropdowns dropdown--menu">
                                            <ul>
                                                @foreach ($kategori as $k)
                                                <a href="{{ URL::to('produk?kategori='.strtolower($k->nama_kategori)) }}">
                                                    <li value="{{$k->id_kategori_produk}}">{{ $k->nama_kategori }}</li>
                                                </a>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                    {{-- <li>--}}
                                    {{-- <a href="#"><span class="fa fa-id-card"></span> KONTAK</a>--}}
                                    {{-- --}}
                                    {{-- </li>--}}
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                        </nav>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row-->
            </div>
            <!-- start .container -->
        </div>
        <!-- end /.mainmenu-->
    </div>
    <!-- end /.menu-area -->
    <!--================================
    END MENU AREA
=================================-->

    @yield('web_konten')

    <!--================================
    START FOOTER AREA
=================================-->
    <footer class="footer-area">
        <div class="footer-big section--padding">
            <!-- start .container -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="info-footer">
                            <div class="info__logo">
                                <img src="{{ asset('assets/images/logo_mp2.png') }}" alt="footer logo">
                            </div>
                            <p class="info--text">Nunc placerat mi id nisi interdum they mollis. Praesent pharetra,
                                justo ut scel erisque the mattis,
                                leo quam.</p>
                            <ul class="info-contact">
                                <li>
                                    <span class="lnr lnr-phone info-icon"></span>
                                    <span class="info">Phone: +6789-875-2235</span>
                                </li>
                                <li>
                                    <span class="lnr lnr-envelope info-icon"></span>
                                    <span class="info">support@aazztech.com</span>
                                </li>
                                <li>
                                    <span class="lnr lnr-map-marker info-icon"></span>
                                    <span class="info">202 New Hampshire Avenue Northwest #100, New York-2573</span>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.info-footer -->
                    </div>
                    <!-- end /.col-md-3 -->

                    <div class="col-lg-5 col-md-6">
                        <div class="footer-menu">
                            <h4 class="footer-widget-title text--white">Our Company</h4>
                            <ul>
                                <li>
                                    <a href="#">How to Join Us</a>
                                </li>
                                <li>
                                    <a href="#">How It Work</a>
                                </li>
                                <li>
                                    <a href="#">Buying and Selling</a>
                                </li>
                                <li>
                                    <a href="#">Testimonials</a>
                                </li>
                                <li>
                                    <a href="#">Copyright Notice</a>
                                </li>
                                <li>
                                    <a href="#">Refund Policy</a>
                                </li>
                                <li>
                                    <a href="#">Affiliates</a>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.footer-menu -->

                        <div class="footer-menu">
                            <h4 class="footer-widget-title text--white">Help and FAQs</h4>
                            <ul>
                                <li>
                                    <a href="#">How to Join Us</a>
                                </li>
                                <li>
                                    <a href="#">How It Work</a>
                                </li>
                                <li>
                                    <a href="#">Buying and Selling</a>
                                </li>
                                <li>
                                    <a href="#">Testimonials</a>
                                </li>
                                <li>
                                    <a href="#">Copyright Notice</a>
                                </li>
                                <li>
                                    <a href="#">Refund Policy</a>
                                </li>
                                <li>
                                    <a href="#">Affiliates</a>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.footer-menu -->
                    </div>
                    <!-- end /.col-md-5 -->

                    <div class="col-lg-4 col-md-12">
                        <div class="newsletter">
                            <h4 class="footer-widget-title text--white">Newsletter</h4>
                            <p>Subscribe to get the latest news, update and offer information. Don't worry, we won't
                                send spam!</p>
                            <div class="newsletter__form">
                                <form action="#">
                                    <div class="field-wrapper">
                                        <input class="relative-field rounded" type="text" placeholder="Enter email">
                                        <button class="btn btn--round" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>

                            <!-- start .social -->
                            <div class="social social--color--filled">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-facebook"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-twitter"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-google-plus"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-pinterest"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-linkedin"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-dribbble"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end /.social -->
                        </div>
                        <!-- end /.newsletter -->
                    </div>
                    <!-- end /.col-md-4 -->
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.footer-big -->

        <div class="mini-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright-text">
                            <p>&copy; 2019
                                <a href="#">MartPlace</a>. All rights reserved. Created by
                                <a href="#">AazzTech</a>
                            </p>
                        </div>

                        <div class="go_top">
                            <span class="fa fa-angle-up"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--================================
END FOOTER AREA
=================================-->

    <!-- inject:js -->
    <script src="{{ asset('assets/js/vendor/jquery/jquery-1.12.3.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery/uikit.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/grid.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.easing1.3.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tether.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/trumbowyg.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/map.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/dropzone/dropzone.js') }}"></script>
    <!-- endinject -->
    @stack('scripts')
</body>

</html>