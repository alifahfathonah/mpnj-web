<header class="section-header sticky-top">
    <nav class="navbar p-md-0 navbar-expand-sm navbar-dark shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop3" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTop3" style="font-size:12px;">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"> Download Aplikasi Android NJ Market </a>
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
    <section class="header-main pt-0 pb-0 shadow">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-4">
                    <a href="{{ URL::to('/') }}" class="brand-wrap">
                        <img class="logo" src="{{ asset('assets/mpnj/images/logo_mp1.png') }}">
                    </a> <!-- brand-wrap.// -->
                </div>
                <div class="col-lg-6 col-sm-12 order-3 order-lg-2">
                    <form action="{{ URL::to('/produk') }}" class="search-wrap">
                        <div class="input-group w-100">
                            <input type="text" name="cari" class="form-control" style="width:60%;" placeholder="Search">
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
                        <a href="#" class="widget-header pl-2 ml-2">
                            <i class="icon icon-sm rounded-circle border fa fa-heart"></i>
                        </a>
                        <a href="#" class="widget-header pl-2 ml-2">
                            <div class="icon icon-sm rounded-circle border"><i class="fa fa-shopping-cart"></i></div>
                            <span class="badge badge-pill badge-danger notify">0</span>
                        </a>
                        
                        <a href="#" class="widget-header pl-2 ml-2">
                            <i class="icon icon-sm rounded-circle border fa fa-user"></i>
                        </a>
                        
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