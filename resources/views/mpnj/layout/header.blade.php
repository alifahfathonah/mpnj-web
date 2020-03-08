<header class="section-header sticky-top">
    <nav class="navbar p-md-0 navbar-expand-sm navbar-dark shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop3" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTop3" style="font-size:12px;">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-mobile-alt"></i> Download Aplikasi Android belaNJ disini </a>
                    </li>

                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ URL::to('login') }}">Bantuan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ URL::to('login') }}">Login</a> <span class="dark-transp"></li>
                    <li class="nav-item"><a class="nav-link" href="{{ URL::to('register') }}"> Daftar</a></li>
                </ul>
                <!--<ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="{{ URL::to('/') }}"> <strong>Home</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('/produk') }}">Semua Produk</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                            <div class="dropdown-menu">
                                @foreach ($kategori as $k)
                                <a class="dropdown-item" href="{{ URL::to('produk?kategori='.strtolower($k->nama_kategori)) }}">{{ $k->nama_kategori }}</a>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                <!--
                <!-- list-inline //  -->
            </div> <!-- navbar-collapse .// -->
        </div> <!-- container //  -->
    </nav>
    <section class="header-main pt-3 pb-3 shadow-sm" style="background-color: white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-4">
                    <a href="{{ URL::to('/') }}" class="brand-wrap">
                        <img class="logo" src="{{ asset('assets/logo/belanj-hijau.png') }}">
                    </a> <!-- brand-wrap.// -->
                </div>
                <div class="col-lg-6 col-sm-12 order-3 order-lg-2">
                    <form action="{{ URL::to('/produk') }}" class="search-wrap">
                        <div class="input-group w-100">
                            <input type="text" name="cari" class="form-control" style="width:60%;" placeholder="Cari produk disini...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form> <!-- search-wrap .end// -->
                </div> <!-- col.// -->
                <div class="col-lg-3 col-sm-6 col-8 order-2 order-lg-3">
                    <div class="d-flex justify-content-end">
                        <div class="dropdown">

                            <div class="d-flex justify-content-md-end widgets-wrap">
                                <a href="{{ URL::to('/profile') }}" class="widget-header">
                                    <div class="icontext">
                                        <div class="icon icon-sm border rounded-circle">
                                            <i class="fa  fa-user"></i>
                                        </div>
                                        <div class="text">
                                            @if (Auth::guard(Session::get('role'))->check())
                                            <div> Halo @if (Auth::guard(Session::get('role'))->check())
                                                {{ Auth::guard(Session::get('role'))->user()->username }}
                                                @endif
                                            </div>
                                            @else
                                            <small><a href="{{ URL::to('login') }}">Login</a> |<a href="{{ URL::to('register') }}"> Register</a> </small>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="widget-header ml-4" data-toggle="dropdown">
                                    <div class="icon icon-sm border rounded-circle"><i class="fa fa-shopping-cart"></i></div>
                                    <span class="badge badge-pill badge-danger notify">@if(Session::has('id')) {{ COUNT($cart) }} @else 0 @endif</span>
                                </a>
                                <div class="dropdown-menu p-3 dropdown-menu-right" style="min-width:280px;">
                                    @if(Session::has('id'))
                                    @foreach($cart as $c)
                                    <figure class="itemside mb-3">
                                        <div class="aside"><img src="{{ asset('assets/foto_produk/'.$c->produk->foto_produk[0]->foto_produk) }}" class="img-sm border"></div>
                                        <figcaption class="info align-self-center">
                                            <p class="title"><a href="{{ URL::to('produk/detail/'.$c->produk->id_produk) }}">{{ $c->produk->nama_produk }}</a></p>
                                            <p class="text-dark small">{{ $c->produk->kategori->nama_kategori }}</p>
                                            <div class="price">
                                                @if($c->produk->diskon == 0)
                                                @currency($c->produk->harga_jual)
                                                @else
                                                @currency($c->produk->harga_jual - ($c->produk->diskon / 100 * $c->produk->harga_jual))
                                                <p class="text-dark small"> <strike style="color: red">@currency($c->produk->harga_jual)</strike></p>
                                                @endif
                                            </div> <!-- price-wrap.// -->
                                        </figcaption>
                                    </figure>
                                    @endforeach
                                    @endif
                                    <a href="{{ URL::to('/keranjang') }}" class="btn btn-primary btn-block"> Lihat Keranjang </a>
                                </div>
                            </div> <!-- drowpdown-menu.// -->
                        </div> <!-- dropdown.// -->
                    </div> <!-- widgets-wrap.// -->
                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- container.// -->
        <!--
        <nav class="navbar navbar-expand-sm p-md-0 bg-light mb-0 pb-0">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav3" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="main_nav3">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="{{ URL::to('/') }}"> <strong>Home</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('/produk') }}">Semua Produk</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                            <div class="dropdown-menu">
                                @foreach ($kategori as $k)
                                <a class="dropdown-item" href="{{ URL::to('produk?kategori='.strtolower($k->nama_kategori)) }}">{{ $k->nama_kategori }}</a>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div> <!-- collapse .// -->
        </div> <!-- container .// -->
        </nav> <!-- navbar main end.// -->
    </section> <!-- header-main .// -->

    <div class="corner-ribbon bottom-right sticky blue shadow">COMMIT UNUJA</div>
</header>