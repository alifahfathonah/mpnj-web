@extends('web.web_master')

@section('web_konten')
<!--================================
    START HERO AREA
=================================-->
<section class="hero-area bgimage">
    <div class="bg_image_holder">
        <img src="{{ asset('assets/images/hero_area_bg1.jpg') }}" alt="background-image">
    </div>
    <!-- start hero-content -->
    <div class="hero-content content_above">
        <!-- start .contact_wrapper -->
        <div class="content-wrapper">
            <!-- start .container -->
            <div class="container">
                <!-- start row -->
                <div class="row">
                    <!-- start col-md-12 -->
                    <div class="col-md-12">
                        <div class="hero__content__title">
                            <h1>
                                <span class="bold">Market Place Nurul Jadid</span>
                            </h1>
                            <p class="tagline">Menjadi Market Place Islami Pertama</p>
                        </div>

                        <!-- start .hero__btn-area-->
                        <div class="hero__btn-area">
                            <a href="all-products.html" class="btn btn--round btn--lg">Semua Produk</a>
                            <a href="all-products.html" class="btn btn--round btn--lg">Produk Populer</a>
                        </div>
                        <!-- end .hero__btn-area-->
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end .contact_wrapper -->
    </div>
    <!-- end hero-content -->

    <!--start search-area -->
    <div class="search-area">
        <!-- start .container -->
        <div class="container">
            <!-- start .container -->
            <div class="row">
                <!-- start .col-sm-12 -->
                <div class="col-sm-12">
                    <!-- start .search_box -->
                    <div class="search_box">
                        <form action="#">
                            <input type="text" class="text_field" placeholder="Cari Produk...">
                            <div class="search__select select-wrap">
                                <select name="category" class="select--field" id="blah">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($kategori as $k)
                                    <option value="{{$k->id_kategori_produk}}">{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                <span class="fa fa-arrow-down fa-4x"></span>
                            </div>
                            <button type="submit" class="search-btn btn--lg">Cari</button>
                        </form>
                    </div>
                    <!-- end ./search_box -->
                </div>
                <!-- end /.col-sm-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </div>
    <!--start /.search-area -->
</section>
<!--================================
END HERO AREA
=================================-->

<!--================================
START PRODUCTS AREA
=================================-->
<section class="products section--padding">
    <!-- start container -->
    <div class="container">
        <!-- start row -->
        <div class="row">
            <!-- start col-md-12 -->
            <div class="col-md-12">
                <div class="product-title-area">
                    <div class="product__title">
                        <h2>Produk Terbaru</h2>
                    </div>

                    <div class="filter__menu">
                        <p>Filter :</p>
                        <div class="filter__menu_icon">
                            <a href="#" id="drop1" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="svg" src="{{ asset('assets/images/svg/menu.svg') }}" alt="menu icon">
                            </a>

                            <ul class="filter_dropdown dropdown-menu" aria-labelledby="drop1">
                                <li>
                                    <a href="#">Trending Produk</a>
                                </li>
                                <li>
                                    <a href="#">Penjualan Terbaik</a>
                                </li>
                                <li>
                                    <a href="#">Rating Terbaik</a>
                                </li>
                                <li>
                                    <a href="#">Termurah</a>
                                </li>
                                <li>
                                    <a href="#">Termahal</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end /.col-md-12 -->
        </div>
        <!-- end /.row -->

        <!-- start row -->
        <div class="row">
            <!-- start .col-md-12 -->
            <div class="col-md-12">
                <div class="sorting">
                    <ul>
                        <li>
                            <a href="#">Elektronik</a>
                        </li>
                        <li>
                            <a href="#">Makanan</a>
                        </li>
                        <li>
                            <a href="#">Konveksi</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end /.col-md-12 -->
        </div>
        <!-- end /.row -->

        <!-- start .row -->
        <div class="row">
            <!-- start .col-md-4 -->
            @foreach ($produk as $p)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <!-- start .single-product -->
                <div class="product product--card ">

                    <div class="product__thumbnail">
                        <img src="{{ asset('assets/foto_produk/'.$p->foto_produk[0]->foto_produk) }}" alt="Product Image" style="height: 230px;" width="361" height="230">
                        <div class="prod_btn">
                            <a href="/produk/{{ $p->id_produk }}" class="transparent btn--sm btn--round">Lihat</a>
                        </div>
                        <!-- end /.prod_btn -->
                    </div>
                    <!-- end /.product__thumbnail -->

                    <div class="product-desc">
                        <a href="/produk/{{ $p->id_produk }}" class="product_title">
                            <h4>{{ $p->nama_produk }}</h4>
                        </a>
                        <ul class="titlebtm">
                            <li>
                                <!-- <img class="auth-img" src="{{ asset('assets/images/auth.jpg') }}" alt="author image"> -->
                                <p>
                                    <i class="fa fa-home" aria-hidden="true"></i> <a href="#">{{ $p->pelapak->nama_toko }}</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <i class="fa fa-book"></i>
                                <a href="/kategori/{{ strtolower($p->kategori->nama_kategori) }}">{{ $p->kategori->nama_kategori }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- end /.product-desc -->

                    <div class="product-purchase">
                        <div class="price_love">
                            <span>@currency($p->harga_jual)</span>
                            <p>
                                <span class="fa fa-heart"></span> {{ $p->wishlist }}</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="fa fa-cart-arrow-down"></span>
                                <span>{{ $p->terjual }}</span>
                            </p>
                        </div>
                    </div>
                    <!-- end /.product-purchase -->
                </div>
                <!-- end /.single-product -->
            </div>
            @endforeach
            <!-- end /.col-md-4 -->

        </div>
        <!-- end /.row -->

        <!-- start .row -->
        <div class="row">
            <div class="col-md-12">
                <div class="more-product">
                    <a href="all-products.html" class="btn btn--lg btn--round">Semua Produk Baru</a>
                </div>
            </div>
            <!-- end ./col-md-12 -->
        </div>
        <!-- end /.row -->
    </div>
    <!-- end /.container -->
</section>
<!--================================
END PRODUCTS AREA
=================================-->
@endsection