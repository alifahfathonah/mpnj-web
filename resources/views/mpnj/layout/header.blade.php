<header class="section-header sticky-top">
    <nav class="navbar p-md-0 navbar-expand-sm navbar-dark shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop3"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTop3" style="font-size:12px;">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-mobile-alt"></i> Download Aplikasi Android belaNJ
                            disini </a>
                    </li>

                </ul>
                {{--                {{ dd(Auth::check()) }}--}}
                <ul class="navbar-nav">
                    @if (Auth::check())
                    <li class="nav-item"><a class="nav-link" href="{{ URL::to('login') }}">Bantuan</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link" href="{{ URL::to('login') }}">Bantuan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ URL::to('login') }}">Login</a> <span
                            class="dark-transp"></span></li>
                    <li class="nav-item"><a class="nav-link" href="{{ URL::to('register') }}"> Daftar</a></li>
                    @endif
                </ul>
            </div> <!-- navbar-collapse .// -->
        </div> <!-- container //  -->
    </nav>
    <section class="header-main pt-3 pb-3 shadow-sm" style="background-color: white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-4">
                    <a href="{{ URL::to('/') }}" class="brand-wrap">
                        <img class="logo" src="{{ asset('assets/logo/belaNJ-hijau.png') }}">
                    </a> <!-- brand-wrap.// -->
                </div>
                <div class="col-lg-6 col-sm-12 order-3 order-lg-2">
                    <form action="{{ URL::to('/produk') }}" class="search-wrap">
                        <div class="input-group w-100">
                            <input type="text" name="cari" class="form-control" style="width:60%;"
                                placeholder="Cari produk disini...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form> <!-- search-wrap .end// -->
                </div> <!-- col.// -->
                <div class="col-lg-3 col-sm-6 col-8 order-2 order-lg-3">
                    <div class="widgets-wrap d-flex justify-content-end">
                        <div class="widget-header dropdown">
                            <a data-toggle="dropdown" data-offset="20,10">
                                <div class="icontext">
                                    <div class="icon">
                                        <i class="icon-sm rounded-circle border fa fa-user"></i>
                                    </div>
                                    <div class="text">
                                        @if (Auth::check())
                                        <div> Halo @if (Auth::check())
                                            {{ Auth::user()->username }}
                                            @endif
                                        </div>
                                        @else
                                        <small>
                                            <a href="{{ URL::to('login') }}">Sign In</a>
                                            <hr class="dropdown-divider mb-0 mt-0">
                                            <a href="{{ URL::to('register') }}"> Register</a>
                                        </small>
                                        @endif
                                    </div>
                                </div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right mt-2">
                                @if(Auth::check())
                                    @if(Auth::user()->role == 'pelapak')
                                        <a href="http://seller.belanj.id" class="dropdown-item" style="padding-bottom: 0%">
                                            <i class="fas fa-users-cog mr-5"></i> Jual
                                        </a>
                                    @endif
                                    <a href="{{ URL::to('/profile') }}" class="dropdown-item" style="padding-bottom: 0%">
                                        <i class="fas fa-users-cog mr-5"></i> Atur Profil
                                    </a>
                                    <hr class="dropdown-divider-lg" style="margin-top: 0%; margin-bottom: 0%">
                                    <a href="{{ URL::to('pesanan') }}" class="dropdown-item">
                                        <i class="fas fa-shopping-basket mr-5"></i> Pesanan
                                    </a>
                                    <hr class="dropdown-divider-lg" style="margin-top: 0%; margin-bottom: 0%">
                                    <a href="{{ URL::to('wishlist') }}" class="dropdown-item ">
                                        <i class="fas fa-heart mr-5"></i> Wishlist
                                    </a>
                                    <hr class="dropdown-divider-lg" style="margin-top: 0%;margin-bottom: 0%">
                                    <a href="{{ route('keluar') }}" class="dropdown-item ">
                                        <i class="fas fa-sign-out-alt mr-5"></i> Sign Out
                                    </a>
                                @endif
                            </div> <!--  dropdown-menu .// -->
                        </div>
                        <div class="widget-header dropdown">
                            <a href="#" class="widget-header ml-4" data-toggle="dropdown">
                                <div class="icon icon-sm border rounded-circle"><i class="fa fa-shopping-cart"></i>
                                </div>
                                <span class="badge badge-pill badge-danger notify">@if(Auth::check()) {{ COUNT($cart) }}
                                    @else
                                    0 @endif</span>
                            </a>
                            <div class="dropdown-menu p-3 dropdown-menu-right" style="min-width:280px;">
                                @if(Auth::check())
                                @if($cart->count() > 0)
                                @foreach($cart as $c)
                                <figure class="itemside mb-3">
                                    <div class="aside"><img
                                            src="{{ asset('assets/foto_produk/'.$c->produk->foto_produk[0]->foto_produk) }}"
                                            class="img-sm border"></div>
                                    <figcaption class="info align-self-center">
                                        <p class="title"><a
                                                href="{{ URL::to('produk/'.$c->produk->slug) }}">{{ $c->produk->nama_produk }}</a>
                                        </p>
                                        <p class="text-dark small">{{ $c->produk->kategori->nama_kategori }}</p>
                                        <div class="price">
                                            @if($c->produk->diskon == 0)
                                            @currency($c->produk->harga_jual)
                                            @else
                                            @currency($c->produk->harga_jual - ($c->produk->diskon / 100
                                            * $c->produk->harga_jual))
                                            <p class="text-dark small"><strike
                                                    style="color: red">@currency($c->produk->harga_jual)</strike>
                                            </p>
                                            @endif
                                        </div> <!-- price-wrap.// -->
                                    </figcaption>
                                </figure>
                                @endforeach
                                <a href="{{ URL::to('/keranjang') }}" class="btn btn-primary btn-block"> Lihat
                                    Keranjang </a>
                                @else
                                <figure class="itemside mb-3" style="text-align: center">
                                    Tidak ada keranjang
                                </figure>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div> <!-- widgets-wrap.// -->
                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- container.// -->
    </section> <!-- header-main .// -->
    
    <nav class="navbar navbar-main navbar-expand-lg border-bottom">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL::to('/') }}">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('/produk') }}">Semua Produk</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('/profile') }}">Profile</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('/wishlist') }}">Wishlist</a>
                </li>
            </ul>
            </div> <!-- collapse .// -->
        </div> <!-- container .// -->
    </nav>
    <div class="corner-ribbon bottom-right sticky blue shadow">COMMIT UNUJA</div>
</header>