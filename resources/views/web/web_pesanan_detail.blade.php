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
                                <a href="#">Pesanan Detail</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Detail Pesanan Anda</h1>
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

    <section class="dashboard-area">
        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h3>Invoice</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="invoice">
                            <div class="invoice__head">
                                <div class="invoice_logo">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="">
                                </div>

                                <div class="info">
                                    <h4>Invoice info</h4>
                                    <p>Kode Transaksi : {{ $detail->transaksi_detail->id_transaksi_detail }}</p>
                                </div>
                            </div>
                            <!-- end /.invoice__head -->

                            <div class="invoice__meta">
                                <div class="address">
                                    <h5 class="bold">{{ $detail->pembeli->username }}</h5>
                                    <p>{{ $detail->pembeli->alamat_fix->alamat_lengkap}}, {{ $detail->pembeli->alamat_fix->nama_kota }}, {{ $detail->pembeli->alamat_fix->nama_provinsi }}</p>
                                    <p>{{ $detail->pembeli->alamat_fix->kode_pos }}, {{ $detail->pembeli->alamat_fix->nomor_telepon }}</p>
{{--                                    <p>United States</p>--}}
                                </div>

                                <div class="date_info">
                                    <p>
                                        <span>Tanggal Transaksi</span>{{ $detail->waktu_transaksi }}</p>
{{--                                    <p>--}}
{{--                                        <span>Due Date</span>May 10, 2019--}}
{{--                                    </p>--}}
                                    <p class="status">
                                        <span>Status Order</span>
                                        {{ $detail->transaksi_detail->status_order }}
                                    </p>
                                </div>
                            </div>
                            <!-- end /.invoice__meta -->

                            <div class="invoice__detail">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Diskon</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/foto_produk/'.$detail->transaksi_detail->produk->foto_produk[0]->foto_produk) }}" alt="{{ $detail->transaksi_detail->produk->nama_produk }}" height="100px">
                                            </td>
                                            <td class="author">
                                                <a href="{{ URL::to('produk/'.$detail->transaksi_detail->produk->id_produk) }}">{{ $detail->transaksi_detail->produk->nama_produk }}</a>
                                            </td>
                                            <td class="detail">
                                                {{ $detail->transaksi_detail->jumlah }}
                                            </td>
                                            <td>
                                                @if($detail->transaksi_detail->diskon == 0)
                                                    @currency($detail->transaksi_detail->harga_jual)
                                                @else
                                                    <strike style="color: red">@currency($detail->transaksi_detail->harga_jual)</strike> | @currency($detail->transaksi_detail->harga_jual - ($detail->transaksi_detail->diskon / 100 * $detail->transaksi_detail->harga_jual))
                                                @endif
                                            </td>
                                            <td>{{ $detail->transaksi_detail->diskon }}%</td>
                                            <td>
                                                @if($detail->transaksi_detail->diskon == 0)
                                                    @currency($detail->transaksi_detail->jumlah * $detail->transaksi_detail->harga_jual)
                                                @else
                                                    @currency(($detail->transaksi_detail->harga_jual - ($detail->transaksi_detail->diskon / 100 * $detail->transaksi_detail->harga_jual)) * $detail->transaksi_detail->jumlah)
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="pricing_info">
                                    <p>
                                        Sub - Total:
                                        @if($detail->transaksi_detail->diskon == 0)
                                            @currency($detail->transaksi_detail->jumlah * $detail->transaksi_detail->harga_jual)
                                        @else
                                            @currency(($detail->transaksi_detail->harga_jual - ($detail->transaksi_detail->diskon / 100 * $detail->transaksi_detail->harga_jual)) * $detail->transaksi_detail->jumlah)
                                        @endif
                                    </p>
                                    <p>Kurir : {{ $detail->transaksi_detail->kurir }}</p>
                                    <p>Service : {{ $detail->transaksi_detail->service }}</p>
                                    <p>Ongkir : @currency($detail->transaksi_detail->ongkir)</p>
                                    <p class="bold">
                                        Total :
                                        @if($detail->transaksi_detail->diskon == 0)
                                            @currency(($detail->transaksi_detail->jumlah * $detail->transaksi_detail->harga_jual) + $detail->transaksi_detail->ongkir)
                                        @else
                                            @currency(($detail->transaksi_detail->harga_jual - ($detail->transaksi_detail->diskon / 100 * $detail->transaksi_detail->harga_jual)) * $detail->transaksi_detail->jumlah + $detail->transaksi_detail->ongkir)
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <!-- end /.invoice_detail -->
                        </div>
                        <!-- end /.invoice -->


                    </div>
                    <!-- end /.row -->
                </div>
            </div>
        </div>
    </section>
@endsection