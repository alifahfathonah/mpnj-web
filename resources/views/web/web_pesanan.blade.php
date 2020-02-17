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
                                <a href="#">Pesanan</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Pesanan Anda</h1>
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

    <section class="section--padding2 bgcolor">
        <div class="container">
            <div class="row">
                <div class="item-info table-responsive" style="width: 100%">
                    <div class="item-navigation">
                        <ul class="nav nav-tabs">
                            <li style="width: 19%">
                                <a href="#semua" class="active" aria-controls="semua" role="tab" data-toggle="tab">Semua</a>
                            </li>
                            <li>
                                <a href="#pending" aria-controls="pending" role="tab" data-toggle="tab">Pending <span>@isset($order['pending']) ({{ COUNT($order['pending']) }}) @endisset</span></a>
                            </li>
                            <li>
                                <a href="#verifikasi" aria-controls="verifikias" role="tab" data-toggle="tab">Verifikasi <span>@isset($order['verifikasi']) ({{ COUNT($order['verifikasi']) }}) @endisset</span></a>
                            </li>
                            <li>
                                <a href="#packing" aria-controls="packing" role="tab" data-toggle="tab">Packing <span>@isset($order['packing']) ({{ COUNT($order['packing']) }}) @endisset</span></a>
                            </li>
                            <li>
                                <a href="#dikirim" aria-controls="dikirim" role="tab" data-toggle="tab">Dikirim <span>@isset($order['dikirim']) ({{ COUNT($order['dikirim']) }}) @endisset</span></a>
                            </li>
                            <li>
                                <a href="#sukses" aria-controls="sukses" role="tab" data-toggle="tab">Sukses <span>@isset($order['sukses']) ({{ COUNT($order['sukses']) }}) @endisset</span></a>
                            </li>
                            <li>
                                <a href="#batal" aria-controls="batal" role="tab" data-toggle="tab">Dibatalkan <span>@isset($order['batal']) ({{ COUNT($order['batal']) }}) @endisset</span></a>
                            </li>
{{--                            <li>--}}
{{--                                <a href="#pengembalian" aria-controls="pengembalian" role="tab" data-toggle="tab">Pengembalian</a>--}}
{{--                            </li>--}}
                        </ul>
                    </div>

                    <div class="tab-content table-responsive">
                        <div class="fade show tab-pane product-tab active" id="pending">
                            <div class="tab-content-wrapper">
                                <div class="product_archive table-responsive">
                                    <div class="title_area">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h4>Detail Produk</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <h4 class="add_info">Informasi Tambahan</h4>
                                            </div>
                                            <div class="col-md-2">
                                                <h4>Total</h4>
                                            </div>
                                            <div class="col-md-2">
                                                <h4>Action</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @foreach($order as $key => $val)
                                            @if($key == 'pending')
                                                @foreach($val as $val)
                                                    <div class="col-md-12">
                                                        <div class="single_product clearfix">
                                                            <div class="row">
                                                                <div class="col-lg-5 col-md-5">
                                                                    <div class="product__description">
                                                                        <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}" alt="{{ $val->produk->nama_produk }}" height="100px">
                                                                        <div class="short_desc">
                                                                            <h4>{{ $val->produk->nama_produk }}</h4>
                                                                            <p>
                                                                                Harga :
                                                                                @if($val->diskon == 0)
                                                                                    @currency($val->harga_jual)
                                                                                @else
                                                                                    <strike style="color: red">@currency($val->harga_jual)</strike> | @currency($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))
                                                                                @endif
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end /.product__description -->
                                                                </div>
                                                                <!-- end /.col-md-5 -->

                                                                <div class="col-lg-3 col-md-3 col-6 xs-fullwidth">
                                                                    <div class="product__additional_info">
                                                                        <ul>
{{--                                                                            <li>--}}
{{--                                                                                <p>--}}
{{--                                                                                    <span>Tanggal: </span> {{ $val->transaksi->waktu_transaksi }}--}}
{{--                                                                                </p>--}}
{{--                                                                            </li>--}}
                                                                            <li class="license">
                                                                                <p>
                                                                                    <span>Jumlah:</span>  {{ $val->jumlah }}
                                                                                </p>
                                                                            </li>
                                                                            <li>
                                                                                <p>
                                                                                    <span>Kurir:</span>  {{ $val->kurir }}
                                                                                </p>
                                                                            </li>
                                                                            <li>
                                                                                <p>
                                                                                    <span>Service:</span>  {{ $val->service }}
                                                                                </p>
                                                                            </li>
                                                                            <li>
                                                                                <p>
                                                                                    <span>Ongkir:</span>  @currency($val->ongkir)
                                                                                </p>
                                                                            </li>
                                                                            <li>
                                                                                <p>
                                                                                    <a href="{{ URL::to('pelapak/'.$val->produk->pelapak->username) }}"><span>Penjual:</span> {{ $val->produk->pelapak->nama_toko }}</a>
                                                                                </p>
                                                                            </li>
{{--                                                                            <li>--}}
{{--                                                                                <a href="#">--}}
{{--                                                                                    <img src="images/catword.png" alt="">Wordpress</a>--}}
{{--                                                                            </li>--}}
                                                                        </ul>
                                                                    </div>
                                                                    <!-- end /.product__additional_info -->
                                                                </div>
                                                                <!-- end /.col-md-3 -->

                                                                <div class="col-lg-4 col-md-4 col-6 xs-fullwidth">
                                                                    <div class="product__price_download">
                                                                        <div class="item_price v_middle">
                                                                            <span>@currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual)) * $val->jumlah) + $val->ongkir)</span>
                                                                        </div>
                                                                        <div class="item_action v_middle">
                                                                            <a href="#" class="btn btn--md btn--round">Detail</a>
                                                                            <a href="#" class="btn btn--md btn--round btn--white rating--btn not--rated" data-toggle="modal" data-target="#myModal">
                                                                                <p class="rate_it">Beri Rating</p>
                                                                                <div class="rating product--rating">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <span class="fa fa-star-o"></span>
                                                                                        </li>
                                                                                        <li>
                                                                                            <span class="fa fa-star-o"></span>
                                                                                        </li>
                                                                                        <li>
                                                                                            <span class="fa fa-star-o"></span>
                                                                                        </li>
                                                                                        <li>
                                                                                            <span class="fa fa-star-o"></span>
                                                                                        </li>
                                                                                        <li>
                                                                                            <span class="fa fa-star-o"></span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </a>
                                                                            <!-- end /.rating_btn -->
                                                                        </div>
                                                                        <!-- end /.item_action -->
                                                                    </div>
                                                                    <!-- end /.product__price_download -->
                                                                </div>
                                                                <!-- end /.col-md-4 -->
                                                            </div>
                                                        </div>
                                                        <!-- end /.single_product -->
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                    <!-- end /.row -->
                                </div>
                            </div>
                        </div>

                        <div class="fade show tab-pane product-tab" id="verifikasi">
                            <div class="tab-content-wrapper">
                                <div class="product_archive table-responsive">
                                    <div class="title_area">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h4>Detail Produk</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <h4 class="add_info">Informasi Tambahan</h4>
                                            </div>
                                            <div class="col-md-2">
                                                <h4>Harga</h4>
                                            </div>
                                            <div class="col-md-2">
                                                <h4>Action</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @foreach($order as $key => $val)
                                            @if($key == 'verifikasi')
                                                @foreach($val as $val)
                                                    <div class="col-md-12">
                                                        <div class="single_product clearfix">
                                                            <div class="row">
                                                                <div class="col-lg-5 col-md-5">
                                                                    <div class="product__description">
                                                                        <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}" alt="{{ $val->produk->nama_produk }}" height="100px">
                                                                        <div class="short_desc">
                                                                            <h4>{{ $val->produk->nama_produk }}</h4>
                                                                            <p>
                                                                                Harga :
                                                                                @if($val->diskon == 0)
                                                                                    @currency($val->harga_jual)
                                                                                @else
                                                                                    <strike style="color: red">@currency($val->harga_jual)</strike> | @currency($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))
                                                                                @endif
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end /.product__description -->
                                                                </div>
                                                                <!-- end /.col-md-5 -->

                                                                <div class="col-lg-3 col-md-3 col-6 xs-fullwidth">
                                                                    <div class="product__additional_info">
                                                                        <ul>
                                                                            {{--                                                                            <li>--}}
                                                                            {{--                                                                                <p>--}}
                                                                            {{--                                                                                    <span>Tanggal: </span> {{ $val->transaksi->waktu_transaksi }}--}}
                                                                            {{--                                                                                </p>--}}
                                                                            {{--                                                                            </li>--}}
                                                                            <li class="license">
                                                                                <p>
                                                                                    <span>Jumlah:</span>  {{ $val->jumlah }}
                                                                                </p>
                                                                            </li>
                                                                            <li>
                                                                                <p>
                                                                                    <span>Kurir:</span>  {{ $val->kurir }}
                                                                                </p>
                                                                            </li>
                                                                            <li>
                                                                                <p>
                                                                                    <span>Service:</span>  {{ $val->service }}
                                                                                </p>
                                                                            </li>
                                                                            <li>
                                                                                <p>
                                                                                    <span>Ongkir:</span>  @currency($val->ongkir)
                                                                                </p>
                                                                            </li>
                                                                            <li>
                                                                                <p>
                                                                                    <a href="{{ URL::to('pelapak/'.$val->produk->pelapak->username) }}"><span>Penjual:</span> {{ $val->produk->pelapak->nama_toko }}</a>
                                                                                </p>
                                                                            </li>
                                                                            {{--                                                                            <li>--}}
                                                                            {{--                                                                                <a href="#">--}}
                                                                            {{--                                                                                    <img src="images/catword.png" alt="">Wordpress</a>--}}
                                                                            {{--                                                                            </li>--}}
                                                                        </ul>
                                                                    </div>
                                                                    <!-- end /.product__additional_info -->
                                                                </div>
                                                                <!-- end /.col-md-3 -->

                                                                <div class="col-lg-4 col-md-4 col-6 xs-fullwidth">
                                                                    <div class="product__price_download">
                                                                        <div class="item_price v_middle">
                                                                            <span>@currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual)) * $val->jumlah) + $val->ongkir)</span>
                                                                        </div>
                                                                        <div class="item_action v_middle">
                                                                            <a href="#" class="btn btn--md btn--round">Detail</a>
                                                                            <a href="#" class="btn btn--md btn--round btn--white rating--btn not--rated" data-toggle="modal" data-target="#myModal">
                                                                                <p class="rate_it">Beri Rating</p>
                                                                                <div class="rating product--rating">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <span class="fa fa-star-o"></span>
                                                                                        </li>
                                                                                        <li>
                                                                                            <span class="fa fa-star-o"></span>
                                                                                        </li>
                                                                                        <li>
                                                                                            <span class="fa fa-star-o"></span>
                                                                                        </li>
                                                                                        <li>
                                                                                            <span class="fa fa-star-o"></span>
                                                                                        </li>
                                                                                        <li>
                                                                                            <span class="fa fa-star-o"></span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </a>
                                                                            <!-- end /.rating_btn -->
                                                                        </div>
                                                                        <!-- end /.item_action -->
                                                                    </div>
                                                                    <!-- end /.product__price_download -->
                                                                </div>
                                                                <!-- end /.col-md-4 -->
                                                            </div>
                                                        </div>
                                                        <!-- end /.single_product -->
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                    <!-- end /.row -->
                                </div>
                            </div>
                        </div>

                        <div class="fade show tab-pane product-tab" id="packing">
                            <div class="tab-content-wrapper">
                                <div class="product_archive table-responsive">
                                    <div class="title_area">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h4>Detail Produk</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <h4 class="add_info">Informasi Tambahan</h4>
                                            </div>
                                            <div class="col-md-2">
                                                <h4>Harga</h4>
                                            </div>
                                            <div class="col-md-2">
                                                <h4>Action</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @foreach($order as $key => $val)
                                            @if($key == 'packing')
                                                @if(COUNT($val) > 0)
                                                    @foreach($val as $val)
                                                        <div class="col-md-12">
                                                            <div class="single_product clearfix">
                                                                <div class="row">
                                                                    <div class="col-lg-5 col-md-5">
                                                                        <div class="product__description">
                                                                            <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}" alt="{{ $val->produk->nama_produk }}" height="100px">
                                                                            <div class="short_desc">
                                                                                <h4>{{ $val->produk->nama_produk }}</h4>
                                                                                <p>
                                                                                    Harga :
                                                                                    @if($val->diskon == 0)
                                                                                        @currency($val->harga_jual)
                                                                                    @else
                                                                                        <strike style="color: red">@currency($val->harga_jual)</strike> | @currency($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end /.product__description -->
                                                                    </div>
                                                                    <!-- end /.col-md-5 -->

                                                                    <div class="col-lg-3 col-md-3 col-6 xs-fullwidth">
                                                                        <div class="product__additional_info">
                                                                            <ul>
                                                                                {{--                                                                            <li>--}}
                                                                                {{--                                                                                <p>--}}
                                                                                {{--                                                                                    <span>Tanggal: </span> {{ $val->transaksi->waktu_transaksi }}--}}
                                                                                {{--                                                                                </p>--}}
                                                                                {{--                                                                            </li>--}}
                                                                                <li class="license">
                                                                                    <p>
                                                                                        <span>Jumlah:</span>  {{ $val->jumlah }}
                                                                                    </p>
                                                                                </li>
                                                                                <li>
                                                                                    <p>
                                                                                        <span>Kurir:</span>  {{ $val->kurir }}
                                                                                    </p>
                                                                                </li>
                                                                                <li>
                                                                                    <p>
                                                                                        <span>Service:</span>  {{ $val->service }}
                                                                                    </p>
                                                                                </li>
                                                                                <li>
                                                                                    <p>
                                                                                        <span>Ongkir:</span>  @currency($val->ongkir)
                                                                                    </p>
                                                                                </li>
                                                                                <li>
                                                                                    <p>
                                                                                        <a href="{{ URL::to('pelapak/'.$val->produk->pelapak->username) }}"><span>Penjual:</span> {{ $val->produk->pelapak->nama_toko }}</a>
                                                                                    </p>
                                                                                </li>
                                                                                {{--                                                                            <li>--}}
                                                                                {{--                                                                                <a href="#">--}}
                                                                                {{--                                                                                    <img src="images/catword.png" alt="">Wordpress</a>--}}
                                                                                {{--                                                                            </li>--}}
                                                                            </ul>
                                                                        </div>
                                                                        <!-- end /.product__additional_info -->
                                                                    </div>
                                                                    <!-- end /.col-md-3 -->

                                                                    <div class="col-lg-4 col-md-4 col-6 xs-fullwidth">
                                                                        <div class="product__price_download">
                                                                            <div class="item_price v_middle">
                                                                                <span>@currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual)) * $val->jumlah) + $val->ongkir)</span>
                                                                            </div>
                                                                            <div class="item_action v_middle">
                                                                                <a href="#" class="btn btn--md btn--round">Detail</a>
                                                                                <a href="#" class="btn btn--md btn--round btn--white rating--btn not--rated" data-toggle="modal" data-target="#myModal">
                                                                                    <p class="rate_it">Beri Rating</p>
                                                                                    <div class="rating product--rating">
                                                                                        <ul>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </a>
                                                                                <!-- end /.rating_btn -->
                                                                            </div>
                                                                            <!-- end /.item_action -->
                                                                        </div>
                                                                        <!-- end /.product__price_download -->
                                                                    </div>
                                                                    <!-- end /.col-md-4 -->
                                                                </div>
                                                            </div>
                                                            <!-- end /.single_product -->
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <h2>Data Tidak Ada</h2>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                    <!-- end /.row -->
                                </div>
                            </div>
                        </div>

                        <div class="fade show tab-pane product-tab" id="dikirim">
                            <div class="tab-content-wrapper">
                                <div class="product_archive table-responsive">
                                    <div class="title_area">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h4>Detail Produk</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <h4 class="add_info">Informasi Tambahan</h4>
                                            </div>
                                            <div class="col-md-2">
                                                <h4>Harga</h4>
                                            </div>
                                            <div class="col-md-2">
                                                <h4>Action</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @foreach($order as $key => $val)
                                            @if($key == 'dikirim')
                                                @if(COUNT($val) > 0)
                                                    @foreach($val as $val)
                                                        <div class="col-md-12">
                                                            <div class="single_product clearfix">
                                                                <div class="row">
                                                                    <div class="col-lg-5 col-md-5">
                                                                        <div class="product__description">
                                                                            <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}" alt="{{ $val->produk->nama_produk }}" height="100px">
                                                                            <div class="short_desc">
                                                                                <h4>{{ $val->produk->nama_produk }}</h4>
                                                                                <p>
                                                                                    Harga :
                                                                                    @if($val->diskon == 0)
                                                                                        @currency($val->harga_jual)
                                                                                    @else
                                                                                        <strike style="color: red">@currency($val->harga_jual)</strike> | @currency($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end /.product__description -->
                                                                    </div>
                                                                    <!-- end /.col-md-5 -->

                                                                    <div class="col-lg-3 col-md-3 col-6 xs-fullwidth">
                                                                        <div class="product__additional_info">
                                                                            <ul>
                                                                                {{--                                                                            <li>--}}
                                                                                {{--                                                                                <p>--}}
                                                                                {{--                                                                                    <span>Tanggal: </span> {{ $val->transaksi->waktu_transaksi }}--}}
                                                                                {{--                                                                                </p>--}}
                                                                                {{--                                                                            </li>--}}
                                                                                <li class="license">
                                                                                    <p>
                                                                                        <span>Jumlah:</span>  {{ $val->jumlah }}
                                                                                    </p>
                                                                                </li>
                                                                                <li>
                                                                                    <p>
                                                                                        <span>Kurir:</span>  {{ $val->kurir }}
                                                                                    </p>
                                                                                </li>
                                                                                <li>
                                                                                    <p>
                                                                                        <span>Service:</span>  {{ $val->service }}
                                                                                    </p>
                                                                                </li>
                                                                                <li>
                                                                                    <p>
                                                                                        <span>Ongkir:</span>  @currency($val->ongkir)
                                                                                    </p>
                                                                                </li>
                                                                                <li>
                                                                                    <p>
                                                                                        <a href="{{ URL::to('pelapak/'.$val->produk->pelapak->username) }}"><span>Penjual:</span> {{ $val->produk->pelapak->nama_toko }}</a>
                                                                                    </p>
                                                                                </li>
                                                                                {{--                                                                            <li>--}}
                                                                                {{--                                                                                <a href="#">--}}
                                                                                {{--                                                                                    <img src="images/catword.png" alt="">Wordpress</a>--}}
                                                                                {{--                                                                            </li>--}}
                                                                            </ul>
                                                                        </div>
                                                                        <!-- end /.product__additional_info -->
                                                                    </div>
                                                                    <!-- end /.col-md-3 -->

                                                                    <div class="col-lg-4 col-md-4 col-6 xs-fullwidth">
                                                                        <div class="product__price_download">
                                                                            <div class="item_price v_middle">
                                                                                <span>@currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual)) * $val->jumlah) + $val->ongkir)</span>
                                                                            </div>
                                                                            <div class="item_action v_middle">
                                                                                <a href="#" class="btn btn--md btn--round">Detail</a>
                                                                                <a href="#" class="btn btn--md btn--round btn--white rating--btn not--rated" data-toggle="modal" data-target="#myModal">
                                                                                    <p class="rate_it">Beri Rating</p>
                                                                                    <div class="rating product--rating">
                                                                                        <ul>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </a>
                                                                                <!-- end /.rating_btn -->
                                                                            </div>
                                                                            <!-- end /.item_action -->
                                                                        </div>
                                                                        <!-- end /.product__price_download -->
                                                                    </div>
                                                                    <!-- end /.col-md-4 -->
                                                                </div>
                                                            </div>
                                                            <!-- end /.single_product -->
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <h2>Data Tidak Ada</h2>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                    <!-- end /.row -->
                                </div>
                            </div>
                        </div>

                        <div class="fade show tab-pane product-tab" id="sukses">
                            <div class="tab-content-wrapper table-responsive">
                                <div class="product_archive">
                                    <div class="title_area">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h4>Detail Produk</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <h4 class="add_info">Informasi Tambahan</h4>
                                            </div>
                                            <div class="col-md-2">
                                                <h4>Harga</h4>
                                            </div>
                                            <div class="col-md-2">
                                                <h4>Action</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @foreach($order as $key => $val)
                                            @if($key == 'sukses')
                                                @if(COUNT($val) > 0)
                                                    @foreach($val as $val)
                                                        <div class="col-md-12">
                                                            <div class="single_product clearfix">
                                                                <div class="row">
                                                                    <div class="col-lg-5 col-md-5">
                                                                        <div class="product__description">
                                                                            <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}" alt="{{ $val->produk->nama_produk }}" height="100px">
                                                                            <div class="short_desc">
                                                                                <h4>{{ $val->produk->nama_produk }}</h4>
                                                                                <p>
                                                                                    Harga :
                                                                                    @if($val->diskon == 0)
                                                                                        @currency($val->harga_jual)
                                                                                    @else
                                                                                        <strike style="color: red">@currency($val->harga_jual)</strike> | @currency($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end /.product__description -->
                                                                    </div>
                                                                    <!-- end /.col-md-5 -->

                                                                    <div class="col-lg-3 col-md-3 col-6 xs-fullwidth">
                                                                        <div class="product__additional_info">
                                                                            <ul>
                                                                                {{--                                                                            <li>--}}
                                                                                {{--                                                                                <p>--}}
                                                                                {{--                                                                                    <span>Tanggal: </span> {{ $val->transaksi->waktu_transaksi }}--}}
                                                                                {{--                                                                                </p>--}}
                                                                                {{--                                                                            </li>--}}
                                                                                <li class="license">
                                                                                    <p>
                                                                                        <span>Jumlah:</span>  {{ $val->jumlah }}
                                                                                    </p>
                                                                                </li>
                                                                                <li>
                                                                                    <p>
                                                                                        <span>Kurir:</span>  {{ $val->kurir }}
                                                                                    </p>
                                                                                </li>
                                                                                <li>
                                                                                    <p>
                                                                                        <span>Service:</span>  {{ $val->service }}
                                                                                    </p>
                                                                                </li>
                                                                                <li>
                                                                                    <p>
                                                                                        <span>Ongkir:</span>  @currency($val->ongkir)
                                                                                    </p>
                                                                                </li>
                                                                                <li>
                                                                                    <p>
                                                                                        <a href="{{ URL::to('pelapak/'.$val->produk->pelapak->username) }}"><span>Penjual:</span> {{ $val->produk->pelapak->nama_toko }}</a>
                                                                                    </p>
                                                                                </li>
                                                                                {{--                                                                            <li>--}}
                                                                                {{--                                                                                <a href="#">--}}
                                                                                {{--                                                                                    <img src="images/catword.png" alt="">Wordpress</a>--}}
                                                                                {{--                                                                            </li>--}}
                                                                            </ul>
                                                                        </div>
                                                                        <!-- end /.product__additional_info -->
                                                                    </div>
                                                                    <!-- end /.col-md-3 -->

                                                                    <div class="col-lg-4 col-md-4 col-6 xs-fullwidth">
                                                                        <div class="product__price_download">
                                                                            <div class="item_price v_middle">
                                                                                <span>@currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual)) * $val->jumlah) + $val->ongkir)</span>
                                                                            </div>
                                                                            <div class="item_action v_middle">
                                                                                <a href="#" class="btn btn--md btn--round">Detail</a>
                                                                                <a href="#" class="btn btn--md btn--round btn--white rating--btn not--rated" data-toggle="modal" data-target="#myModal">
                                                                                    <p class="rate_it">Beri Rating</p>
                                                                                    <div class="rating product--rating">
                                                                                        <ul>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </a>
                                                                                <!-- end /.rating_btn -->
                                                                            </div>
                                                                            <!-- end /.item_action -->
                                                                        </div>
                                                                        <!-- end /.product__price_download -->
                                                                    </div>
                                                                    <!-- end /.col-md-4 -->
                                                                </div>
                                                            </div>
                                                            <!-- end /.single_product -->
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <h2>Data Tidak Ada</h2>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                    <!-- end /.row -->
                                </div>
                            </div>
                        </div>

                        <div class="fade show tab-pane product-tab" id="batal">
                            <div class="tab-content-wrapper">
                                <div class="product_archive table-responsive">
                                    <div class="title_area">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h4>Detail Produk</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <h4 class="add_info">Informasi Tambahan</h4>
                                            </div>
                                            <div class="col-md-2">
                                                <h4>Harga</h4>
                                            </div>
                                            <div class="col-md-2">
                                                <h4>Action</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @foreach($order as $key => $val)
                                            @if($key == 'batal')
                                                @if(COUNT($val) > 0)
                                                    @foreach($val as $val)
                                                        <div class="col-md-12">
                                                            <div class="single_product clearfix">
                                                                <div class="row">
                                                                    <div class="col-lg-5 col-md-5">
                                                                        <div class="product__description">
                                                                            <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}" alt="{{ $val->produk->nama_produk }}" height="100px">
                                                                            <div class="short_desc">
                                                                                <h4>{{ $val->produk->nama_produk }}</h4>
                                                                                <p>
                                                                                    Harga :
                                                                                    @if($val->diskon == 0)
                                                                                        @currency($val->harga_jual)
                                                                                    @else
                                                                                        <strike style="color: red">@currency($val->harga_jual)</strike> | @currency($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end /.product__description -->
                                                                    </div>
                                                                    <!-- end /.col-md-5 -->

                                                                    <div class="col-lg-3 col-md-3 col-6 xs-fullwidth">
                                                                        <div class="product__additional_info">
                                                                            <ul>
                                                                                {{--                                                                            <li>--}}
                                                                                {{--                                                                                <p>--}}
                                                                                {{--                                                                                    <span>Tanggal: </span> {{ $val->transaksi->waktu_transaksi }}--}}
                                                                                {{--                                                                                </p>--}}
                                                                                {{--                                                                            </li>--}}
                                                                                <li class="license">
                                                                                    <p>
                                                                                        <span>Jumlah:</span>  {{ $val->jumlah }}
                                                                                    </p>
                                                                                </li>
                                                                                <li>
                                                                                    <p>
                                                                                        <span>Kurir:</span>  {{ $val->kurir }}
                                                                                    </p>
                                                                                </li>
                                                                                <li>
                                                                                    <p>
                                                                                        <span>Service:</span>  {{ $val->service }}
                                                                                    </p>
                                                                                </li>
                                                                                <li>
                                                                                    <p>
                                                                                        <span>Ongkir:</span>  @currency($val->ongkir)
                                                                                    </p>
                                                                                </li>
                                                                                <li>
                                                                                    <p>
                                                                                        <a href="{{ URL::to('pelapak/'.$val->produk->pelapak->username) }}"><span>Penjual:</span> {{ $val->produk->pelapak->nama_toko }}</a>
                                                                                    </p>
                                                                                </li>
                                                                                {{--                                                                            <li>--}}
                                                                                {{--                                                                                <a href="#">--}}
                                                                                {{--                                                                                    <img src="images/catword.png" alt="">Wordpress</a>--}}
                                                                                {{--                                                                            </li>--}}
                                                                            </ul>
                                                                        </div>
                                                                        <!-- end /.product__additional_info -->
                                                                    </div>
                                                                    <!-- end /.col-md-3 -->

                                                                    <div class="col-lg-4 col-md-4 col-6 xs-fullwidth">
                                                                        <div class="product__price_download">
                                                                            <div class="item_price v_middle">
                                                                                <span>@currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual)) * $val->jumlah) + $val->ongkir)</span>
                                                                            </div>
                                                                            <div class="item_action v_middle">
                                                                                <a href="#" class="btn btn--md btn--round">Detail</a>
                                                                                <a href="#" class="btn btn--md btn--round btn--white rating--btn not--rated" data-toggle="modal" data-target="#myModal">
                                                                                    <p class="rate_it">Beri Rating</p>
                                                                                    <div class="rating product--rating">
                                                                                        <ul>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                            <li>
                                                                                                <span class="fa fa-star-o"></span>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </a>
                                                                                <!-- end /.rating_btn -->
                                                                            </div>
                                                                            <!-- end /.item_action -->
                                                                        </div>
                                                                        <!-- end /.product__price_download -->
                                                                    </div>
                                                                    <!-- end /.col-md-4 -->
                                                                </div>
                                                            </div>
                                                            <!-- end /.single_product -->
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <h2>Data Tidak Ada</h2>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                    <!-- end /.row -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection