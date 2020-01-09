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
                            <a href="#">Keranjang</a>
                        </li>
                    </ul>
                </div>
                <h1 class="page-title">Keranjang Belanja Anda</h1>
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
<section class="cart_area section--padding2 bgcolor">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product_archive added_to__cart">
                    <div class="title_area">
                        <div class="row">
                            <div class="col-md-5">
                                <h4>Daftar Barang dalam Keranjang</h4>
                            </div>
                            <div class="col-md-3">
                                <h4 class="add_info">Kategori</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Harga</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Hapus</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($keranjang as $k)
                        <div class="col-md-12">
                            <div class="single_product clearfix">
                                <div class="col-lg-5 col-md-7 v_middle">
                                    <div class="product__description">
                                        <img src="{{ asset('assets/foto_produk/'.$k->produk->foto_produk[0]->foto_produk) }}" alt="Purchase image" width="100">
                                        <div class="short_desc">
                                            <a href="single-product.html">
                                                <h4>{{ $k->produk->nama_produk }}</h4>
                                            </a>
                                            {{-- <p>Nunc placerat mi id nisi inter dum mollis. Praesent phare...</p> --}}
                                        </div>
                                    </div>
                                    <!-- end /.product__description -->
                                </div>
                                <!-- end /.col-md-5 -->

                                <div class="col-lg-3 col-md-2 v_middle">
                                    <div class="product__additional_info">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <img src="images/catword.png" alt="">{{ $k->produk->kategori->nama_kategori }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- end /.product__additional_info -->
                                </div>
                                <!-- end /.col-md-3 -->

                                <div class="col-lg-4 col-md-3 v_middle">
                                    <div class="product__price_download">
                                        <div class="item_price v_middle">
                                            <span>@currency($k->produk->harga_jual)</span>
                                        </div>
                                        <div class="item_action v_middle">
                                            <a href="/keranjang/hapus/{{ $k->id_keranjang }}" class="remove_from_cart">
                                                <span class="lnr lnr-trash"></span>
                                            </a>
                                        </div>
                                        <!-- end /.item_action -->
                                    </div>
                                    <!-- end /.product__price_download -->
                                </div>
                                <!-- end /.col-md-4 -->
                            </div>
                            <!-- end /.single_product -->
                        </div>
                        @endforeach
                    </div>
                    <!-- end /.row -->

                    <div class="row">
                        <div class="col-md-6 offset-md-6">
                            <div class="cart_calculation">
                                {{-- <div class="cart--subtotal">
                                    <p>
                                        <span>Cart Subtotal</span>$120</p>
                                </div> --}}
                                <div class="cart--total">
                                    <p>
                                        <span>total</span>@currency($k->produk->sum('harga_jual'))</p>
                                </div>

                                <a href="checkout.html" class="btn btn--round btn--md checkout_link">Lanjut Checkout</a>
                            </div>
                        </div>
                        <!-- end .col-md-12 -->
                    </div>
                    <!-- end .row -->
                </div>
                <!-- end /.product_archive2 -->
            </div>
            <!-- end .col-md-12 -->
        </div>
        <!-- end .row -->

    </div>
    <!-- end .container -->
</section>
<!--================================
            END DASHBOARD AREA
    =================================-->
@endsection
