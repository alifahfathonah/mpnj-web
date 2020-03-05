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
                            <a href="{{ URL::to('/')}}">Home</a>
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
                            <a href="#semua" class="@if(app('request')->input('tab') == 'semua') active @endif" aria-controls="semua" role="tab" data-toggle="tab">Semua</a>
                        </li>
                        <li>
                            <a href="#pending" class="@if(app('request')->input('tab') == 'pending') active @endif" aria-controls="pending" role="tab" data-toggle="tab">Pending <span>@isset($order['pending']) ({{ COUNT($order['pending']) }}) @endisset</span></a>
                        </li>
                        <li>
                            <a href="#verifikasi" class="@if(app('request')->input('tab') == 'verifikasi') active @endif" aria-controls="verifikasi" role="tab" data-toggle="tab">Verifikasi <span>@isset($order['verifikasi']) ({{ COUNT($order['verifikasi']) }}) @endisset</span></a>
                        </li>
                        <li>
                            <a href="#packing" class="@if(app('request')->input('tab') == 'packing') active @endif" aria-controls="packing" role="tab" data-toggle="tab">Packing <span>@isset($order['packing']) ({{ COUNT($order['packing']) }}) @endisset</span></a>
                        </li>
                        <li>
                            <a href="#dikirim" class="@if(app('request')->input('tab') == 'dikirim') active @endif" aria-controls="dikirim" role="tab" data-toggle="tab">Dikirim <span>@isset($order['dikirim']) ({{ COUNT($order['dikirim']) }}) @endisset</span></a>
                        </li>
                        <li>
                            <a href="#sukses" class="@if(app('request')->input('tab') == 'sukses') active @endif" aria-controls="sukses" role="tab" data-toggle="tab">Sukses <span>@isset($order['sukses']) ({{ COUNT($order['sukses']) }}) @endisset</span></a>
                        </li>
                        <li>
                            <a href="#batal" class="@if(app('request')->input('tab') == 'batal') active @endif" aria-controls="batal" role="tab" data-toggle="tab">Dibatalkan <span>@isset($order['batal']) ({{ COUNT($order['batal']) }}) @endisset</span></a>
                        </li>
                        {{-- <li>--}}
                        {{-- <a href="#pengembalian" aria-controls="pengembalian" role="tab" data-toggle="tab">Pengembalian</a>--}}
                        {{-- </li>--}}
                    </ul>
                </div>

                <div class="tab-content table-responsive">
                    <div class="fade show tab-pane product-tab @if(app('request')->input('tab') == 'semua') active @else active @endif" id="semua">
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
                                    @foreach($order as $key => $v)
                                    @foreach($order[$key] as $val)
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
                                                            {{-- <li>--}}
                                                            {{-- <p>--}}
                                                            {{-- <span>Tanggal: </span> {{ $val->transaksi->waktu_transaksi }}--}}
                                                            {{-- </p>--}}
                                                            {{-- </li>--}}
                                                            <li class="license">
                                                                <p>
                                                                    <span>Jumlah:</span> {{ $val->jumlah }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Kurir:</span> {{ $val->kurir }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Service:</span> {{ $val->service }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Ongkir:</span> @currency($val->ongkir)
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <a href="{{ URL::to('pelapak/'.$val->produk->pelapak->username) }}"><span>Penjual:</span> {{ $val->produk->pelapak->nama_toko }}</a>
                                                                </p>
                                                            </li>
                                                            {{-- <li>--}}
                                                            {{-- <a href="#">--}}
                                                            {{-- <img src="images/catword.png" alt="">Wordpress</a>--}}
                                                            {{-- </li>--}}
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
                                                            <a href="{{ URL::to('pesanan/detail/'.$val->id_transaksi_detail) }}" class="btn btn--md btn--round">Detail</a>
                                                            {{-- <a href="#" class="btn btn--md btn--round btn--white rating--btn not--rated" data-toggle="modal" data-target="#myModal1">--}}
                                                            {{-- <p class="rate_it">Review Produk</p>--}}
                                                            {{-- <div class="rating product--rating">--}}
                                                            {{-- <ul>--}}
                                                            {{-- <li>--}}
                                                            {{-- <span class="fa fa-star-o"></span>--}}
                                                            {{-- </li>--}}
                                                            {{-- <li>--}}
                                                            {{-- <span class="fa fa-star-o"></span>--}}
                                                            {{-- </li>--}}
                                                            {{-- <li>--}}
                                                            {{-- <span class="fa fa-star-o"></span>--}}
                                                            {{-- </li>--}}
                                                            {{-- <li>--}}
                                                            {{-- <span class="fa fa-star-o"></span>--}}
                                                            {{-- </li>--}}
                                                            {{-- <li>--}}
                                                            {{-- <span class="fa fa-star-o"></span>--}}
                                                            {{-- </li>--}}
                                                            {{-- </ul>--}}
                                                            {{-- </div>--}}
                                                            {{-- </a>--}}
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
                                    @endforeach
                                </div>
                                <!-- end /.row -->
                            </div>
                        </div>
                    </div>

                    <div class="fade show tab-pane product-tab @if(app('request')->input('tab') == 'pending') active @endif" id="pending">
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
                                                            {{-- <li>--}}
                                                            {{-- <p>--}}
                                                            {{-- <span>Tanggal: </span> {{ $val->transaksi->waktu_transaksi }}--}}
                                                            {{-- </p>--}}
                                                            {{-- </li>--}}
                                                            <li class="license">
                                                                <p>
                                                                    <span>Jumlah:</span> {{ $val->jumlah }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Kurir:</span> {{ $val->kurir }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Service:</span> {{ $val->service }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Ongkir:</span> @currency($val->ongkir)
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <a href="{{ URL::to('pelapak/'.$val->produk->pelapak->username) }}"><span>Penjual:</span> {{ $val->produk->pelapak->nama_toko }}</a>
                                                                </p>
                                                            </li>
                                                            {{-- <li>--}}
                                                            {{-- <a href="#">--}}
                                                            {{-- <img src="images/catword.png" alt="">Wordpress</a>--}}
                                                            {{-- </li>--}}
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
                                                            <a href="{{ URL::to('pesanan/detail/'.$val->id_transaksi_detail) }}" class="btn btn--md btn--round">Detail</a>
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

                    <div class="fade show tab-pane product-tab @if(app('request')->input('tab') == 'verifikasi') active @endif" id="verifikasi">
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
                                                            {{-- <li>--}}
                                                            {{-- <p>--}}
                                                            {{-- <span>Tanggal: </span> {{ $val->transaksi->waktu_transaksi }}--}}
                                                            {{-- </p>--}}
                                                            {{-- </li>--}}
                                                            <li class="license">
                                                                <p>
                                                                    <span>Jumlah:</span> {{ $val->jumlah }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Kurir:</span> {{ $val->kurir }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Service:</span> {{ $val->service }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Ongkir:</span> @currency($val->ongkir)
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <a href="{{ URL::to('pelapak/'.$val->produk->pelapak->username) }}"><span>Penjual:</span> {{ $val->produk->pelapak->nama_toko }}</a>
                                                                </p>
                                                            </li>
                                                            {{-- <li>--}}
                                                            {{-- <a href="#">--}}
                                                            {{-- <img src="images/catword.png" alt="">Wordpress</a>--}}
                                                            {{-- </li>--}}
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
                                                            <a href="{{ URL::to('pesanan/detail/'.$val->id_transaksi_detail) }}" class="btn btn--md btn--round">Detail</a>
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

                    <div class="fade show tab-pane product-tab @if(app('request')->input('tab') == 'packing') active @endif" id="packing">
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
                                                            {{-- <li>--}}
                                                            {{-- <p>--}}
                                                            {{-- <span>Tanggal: </span> {{ $val->transaksi->waktu_transaksi }}--}}
                                                            {{-- </p>--}}
                                                            {{-- </li>--}}
                                                            <li class="license">
                                                                <p>
                                                                    <span>Jumlah:</span> {{ $val->jumlah }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Kurir:</span> {{ $val->kurir }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Service:</span> {{ $val->service }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Ongkir:</span> @currency($val->ongkir)
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <a href="{{ URL::to('pelapak/'.$val->produk->pelapak->username) }}"><span>Penjual:</span> {{ $val->produk->pelapak->nama_toko }}</a>
                                                                </p>
                                                            </li>
                                                            {{-- <li>--}}
                                                            {{-- <a href="#">--}}
                                                            {{-- <img src="images/catword.png" alt="">Wordpress</a>--}}
                                                            {{-- </li>--}}
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
                                                            <a href="{{ URL::to('pesanan/detail/'.$val->id_transaksi_detail) }}" class="btn btn--md btn--round">Detail</a>
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

                    <div class="fade show tab-pane product-tab @if(app('request')->input('tab') == 'dikirim') active @endif" id="dikirim">
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
                                                            {{-- <li>--}}
                                                            {{-- <p>--}}
                                                            {{-- <span>Tanggal: </span> {{ $val->transaksi->waktu_transaksi }}--}}
                                                            {{-- </p>--}}
                                                            {{-- </li>--}}
                                                            <li class="license">
                                                                <p>
                                                                    <span>Jumlah:</span> {{ $val->jumlah }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Kurir:</span> {{ $val->kurir }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Service:</span> {{ $val->service }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Ongkir:</span> @currency($val->ongkir)
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <a href="{{ URL::to('pelapak/'.$val->produk->pelapak->username) }}"><span>Penjual:</span> {{ $val->produk->pelapak->nama_toko }}</a>
                                                                </p>
                                                            </li>
                                                            {{-- <li>--}}
                                                            {{-- <a href="#">--}}
                                                            {{-- <img src="images/catword.png" alt="">Wordpress</a>--}}
                                                            {{-- </li>--}}
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
                                                            <a href="{{ URL::to('pesanan/detail/'.$val->id_transaksi_detail) }}" class="btn btn--md btn--round">Detail</a>
                                                            <a href="{{ URL::to('pesanan/diterima/'.$val->id_transaksi_detail) }}" class="btn btn--md btn--round">Pesanan Diterima</a>
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

                    <div class="fade show tab-pane product-tab @if(app('request')->input('tab') == 'sukses') active @endif" id="sukses">
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
                                                            {{-- <li>--}}
                                                            {{-- <p>--}}
                                                            {{-- <span>Tanggal: </span> {{ $val->transaksi->waktu_transaksi }}--}}
                                                            {{-- </p>--}}
                                                            {{-- </li>--}}
                                                            <li class="license">
                                                                <p>
                                                                    <span>Jumlah:</span> {{ $val->jumlah }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Kurir:</span> {{ $val->kurir }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Service:</span> {{ $val->service }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Ongkir:</span> @currency($val->ongkir)
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <a href="{{ URL::to('pelapak/'.$val->produk->pelapak->username) }}"><span>Penjual:</span> {{ $val->produk->pelapak->nama_toko }}</a>
                                                                </p>
                                                            </li>
                                                            {{-- <li>--}}
                                                            {{-- <a href="#">--}}
                                                            {{-- <img src="images/catword.png" alt="">Wordpress</a>--}}
                                                            {{-- </li>--}}
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
                                                            <a href="{{ URL::to('pesanan/detail/'.$val->id_transaksi_detail) }}" class="btn btn--md btn--round">Detail</a>
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

                    <div class="fade show tab-pane product-tab @if(app('request')->input('tab') == 'batal') active @endif" id="batal">
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
                                                            {{-- <li>--}}
                                                            {{-- <p>--}}
                                                            {{-- <span>Tanggal: </span> {{ $val->transaksi->waktu_transaksi }}--}}
                                                            {{-- </p>--}}
                                                            {{-- </li>--}}
                                                            <li class="license">
                                                                <p>
                                                                    <span>Jumlah:</span> {{ $val->jumlah }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Kurir:</span> {{ $val->kurir }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Service:</span> {{ $val->service }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span>Ongkir:</span> @currency($val->ongkir)
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <a href="{{ URL::to('pelapak/'.$val->produk->pelapak->username) }}"><span>Penjual:</span> {{ $val->produk->pelapak->nama_toko }}</a>
                                                                </p>
                                                            </li>
                                                            {{-- <li>--}}
                                                            {{-- <a href="#">--}}
                                                            {{-- <img src="images/catword.png" alt="">Wordpress</a>--}}
                                                            {{-- </li>--}}
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
                                                            <a href="{{ URL::to('pesanan/detail/'.$val->id_transaksi_detail) }}" class="btn btn--md btn--round">Detail</a>
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
<div class="modal fade rating_modal" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="rating_modal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="rating_modal">Rating this Item</h3>
                <h4>Product Enquiry Extension</h4>
                <p>by
                    <a href="#">AazzTech</a>
                </p>
            </div>
            <!-- end /.modal-header -->

            <div class="modal-body">
                <form method="post" action="{{ URL::to('review/produk') }}">
                    @csrf
                    <ul>
                        <li>
                            <p>Bintang</p>
                            <div class="right_content btn btn--round btn--white btn--md">
                                <select name="bintang" class="give_rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </li>
                    </ul>
                    <input type="hidden" name="id_produk" value="2">
                    <input type="hidden" name="nama_provinsi" id="nama_provinsi" class="form-control">
                    <div class="rating_field">
                        <label for="rating_field">Komentar</label>
                        <textarea name="review" id="rating_field" class="text_field" placeholder="Beri komentar Barang yang Sesuai. "></textarea>
                        <p class="notice">Terima kasih Sudah Mereview Barang Kami. </p>
                    </div>
                    <button type="submit" class="btn btn--round btn--default">Kirim</button>
                    <button class="btn btn--round modal_close" data-dismiss="modal">Batal</button>
                </form>
                <!-- end /.form -->
            </div>
            <!-- end /.modal-body -->
        </div>
    </div>
</div>
@endsection