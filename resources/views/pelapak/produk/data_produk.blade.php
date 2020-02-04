@extends('web.web_master')

@section('web_konten')
    <!--================================
        START BREADCRUMB AREA
    =================================-->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="index.html">Home</a>
                            </li>
                            <li class="active">
                                <a href="#">Pelapak</a>
                            </li>
                            <li class="active">
                                <a href="#">Produk</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Data Produk</h1>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
            END BREADCRUMB AREA
        =================================-->

    <!--================================
                START DASHBOARD AREA
        =================================-->
    <section class="dashboard-area">
        @include('pelapak.master')
        <!-- end /.dashboard_menu_area -->

        <div class="dashboard_contents">
            <div class="container">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="filter-bar dashboard_title_area clearfix filter-bar2">
                                <div class="dashboard__title dashboard__title pull-left">
                                    <h3>Data Produk</h3>
                                    <a href="{{ URL::to('administrator/produk/tambah') }}" class="btn btn-primary">Tambah</a>
                                </div>

                                <div class="pull-right">
                                    <div class="filter__option filter--text">
                                        <p>
                                            <span>{{ count($produk) }}</span> Produk</p>
                                    </div>

                                    <div class="filter__option filter--select">
                                        <div class="select-wrap">
                                            <select name="price">
                                                <option value="low">Price : Low to High</option>
                                                <option value="high">Price : High to low</option>
                                            </select>
                                            <span class="lnr lnr-chevron-down"></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- end /.pull-right -->
                            </div>
                            <!-- end /.filter-bar -->
                        </div>
                        <!-- end /.col-md-12 -->
                    </div>

                    <div class="row">
                        @foreach($produk as $p)
                            <div class="col-lg-4 col-md-6">
                                <!-- start .single-product -->
                                <div class="product product--card">

                                    <div class="product__thumbnail">
                                        <img src="{{ asset('assets/foto_produk/'.$p->foto_produk[0]->foto_produk) }}" alt="Product Image" width="361" height="230">

                                        <div class="prod_option">
                                            <a href="#" id="drop4" class="dropdown-trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <span class="lnr lnr-cog setting-icon"></span>
                                            </a>

                                            <div class="options dropdown-menu" aria-labelledby="drop4">
                                                <ul>
                                                    <li>
                                                        <a href="administrator/produk/edit/{{ $p->id_produk }}">
                                                            <span class="lnr lnr-pencil"></span>Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <span class="lnr lnr-eye"></span>Hide</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" data-toggle="modal" data-target="#myModal2" class="delete">
                                                            <span class="lnr lnr-trash"></span>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end /.product__thumbnail -->

                                    <div class="product-desc">
                                        <a href="#" class="product_title">
                                            <h4>{{ $p->nama_produk }}</h4>
                                        </a>
                                        <ul class="titlebtm">
                                            <li>
                                                <img class="auth-img" src="{{ asset('assets/images/auth3.jpg') }}" alt="author image">
                                                <p>
                                                    <a href="#">{{ $p->pelapak->nama_toko }}</a>
                                                </p>
                                            </li>
{{--                                            <li class="product_cat">--}}
{{--                                                <a href="#">--}}
{{--                                                    <span class="lnr lnr-book"></span>Plugin</a>--}}
{{--                                            </li>--}}
                                        </ul>
                                    </div>
                                    <!-- end /.product-desc -->

                                    <div class="product-purchase">
                                        <a href="{{ URL::to('administrator/produk/edit/'.$p->id_produk) }}">
                                            <div class="price_love">
                                                <span>Edit</span>
                                            </div>
                                        </a>
                                        <a href="{{ URL::to('administrator/produk/hapus/'.$p->id_produk) }}">
                                            <div class="price_love">
                                                <span>Hapus</span>
                                            </div>
                                        </a>

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
                    </div>
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.dashboard_menu_area -->
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->
@endsection
