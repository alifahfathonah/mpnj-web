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
                                <span class="light">Create Your Own</span>
                                <span class="bold">Digital Product Marketplace</span>
                            </h1>
                            <p class="tagline">MartPlace is the most powerful, & customizable template for Easy
                                Digital Downloads Products</p>
                        </div>

                        <!-- start .hero__btn-area-->
                        <div class="hero__btn-area">
                            <a href="all-products.html" class="btn btn--round btn--lg">View All Products</a>
                            <a href="all-products.html" class="btn btn--round btn--lg">Popular Products</a>
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
                            <input type="text" class="text_field" placeholder="Search your products...">
                            <div class="search__select select-wrap">
                                <select name="category" class="select--field" id="blah">
                                    <option value="">All Categories</option>
                                    <option value="">PSD</option>
                                    <option value="">HTML</option>
                                    <option value="">WordPress</option>
                                    <option value="">All Categories</option>
                                </select>
                                <span class="lnr lnr-chevron-down"></span>
                            </div>
                            <button type="submit" class="search-btn btn--lg">Search Now</button>
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
                        <h2>Newest Release Products</h2>
                    </div>

                    <div class="filter__menu">
                        <p>Filter by:</p>
                        <div class="filter__menu_icon">
                            <a href="#" id="drop1" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <img class="svg" src="{{ asset('assets/images/svg/menu.svg') }}" alt="menu icon">
                            </a>

                            <ul class="filter_dropdown dropdown-menu" aria-labelledby="drop1">
                                <li>
                                    <a href="#">Trending items</a>
                                </li>
                                <li>
                                    <a href="#">Best seller</a>
                                </li>
                                <li>
                                    <a href="#">Best rating</a>
                                </li>
                                <li>
                                    <a href="#">Low price</a>
                                </li>
                                <li>
                                    <a href="#">High price</a>
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
                            <a href="#">Plugins</a>
                        </li>
                        <li>
                            <a href="#">WordPress</a>
                        </li>
                        <li>
                            <a href="#">Site Template</a>
                        </li>
                        <li>
                            <a href="#">PSD Template</a>
                        </li>
                        <li>
                            <a href="#">Joomla</a>
                        </li>
                        <li>
                            <a href="#">User Interface</a>
                        </li>
                        <li>
                            <a href="#">Landing Page</a>
                        </li>
                        <li>
                            <a href="#">Software</a>
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
            <div class="col-lg-4 col-md-6">
                <!-- start .single-product -->
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="{{ asset('assets/foto_produk/'.$p->foto_produk[0]->foto_produk) }}" alt="Product Image" style="height: 350px;">
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
                                <img class="auth-img" src="{{ asset('assets/images/auth.jpg') }}" alt="author image">
                                <p>
                                    <a href="#">{{ $p->pelapak->nama_toko }}</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="/kategori/{{ strtolower($p->kategori->nama_kategori) }}">
                                    <span class="lnr lnr-book"></span>{{ $p->kategori->nama_kategori }}</a>
                            </li>
                        </ul>

                    </div>
                    <!-- end /.product-desc -->

                    <div class="product-purchase">
                        <div class="price_love">
                            <span>@currency($p->harga_jual)</span>
                            <p>
                                <span class="lnr lnr-heart"></span> {{ $p->wishlist }}</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart"></span>
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
                    <a href="all-products.html" class="btn btn--lg btn--round">All New Products</a>
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