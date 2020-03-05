<header class="section-header">
    <nav class="navbar p-md-0 navbar-expand-lg navbar-light border-bottom">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop3" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTop3">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"> <i class="fa fa-phone"></i> Call us: 020 2366 455 </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> USD </a>
                        <ul class="dropdown-menu small">
                            <li><a class="dropdown-item" href="#">EUR</a></li>
                            <li><a class="dropdown-item" href="#">AED</a></li>
                            <li><a class="dropdown-item" href="#">RUBL </a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">   Language </a>
                        <ul class="dropdown-menu small">
                            <li><a class="dropdown-item" href="#">English</a></li>
                            <li><a class="dropdown-item" href="#">Arabic</a></li>
                            <li><a class="dropdown-item" href="#">Russian </a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="#" class="nav-link"> My Account </a></li>
                    <li class="nav-item"><a href="#" class="nav-link"> Wishlist </a></li>
                    <li class="nav-item"><a href="#" class="nav-link"> Checkout </a></li>
                </ul> <!-- list-inline //  -->
            </div> <!-- navbar-collapse .// -->
        </div> <!-- container //  -->
    </nav>
    <section class="header-main border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-4">
                    <a href="{{ URL::to('/') }}" class="brand-wrap">
                        <img class="logo" src="{{ url('assets/mpnj/images/nj.png') }}">
                    </a> <!-- brand-wrap.// -->
                </div>
                <div class="col-lg-6 col-sm-12 order-3 order-lg-2">
                    <form action="#" class="search-wrap">
                        <div class="input-group w-100">
                            <select class="custom-select" name="category_name">
                                <option value="">All type</option><option value="codex">Special</option>
                                <option value="comments">Only best</option>
                                <option value="content">Latest</option>
                            </select>
                            <input type="text" class="form-control" style="width:60%;" placeholder="Search">

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
                        <div class="widget-header">
                            <small class="title text-muted">Welcome guest!</small>
                            <div>
                                <a href="{{ URL::to('login') }}">Sign in</a> <span class="dark-transp"> | </span>
                                <a href="{{ URL::to('register') }}"> Register</a>
                            </div>
                        </div>
                        <a href="#" class="widget-header pl-3 ml-3">
                            <div class="icon icon-sm rounded-circle border"><i class="fa fa-shopping-cart"></i></div>
                            <span class="badge badge-pill badge-danger notify">0</span>
                        </a>
                    </div> <!-- widgets-wrap.// -->
                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- container.// -->
    </section> <!-- header-main .// -->
    <nav class="navbar navbar-main navbar-expand-lg border-bottom">
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
</header>