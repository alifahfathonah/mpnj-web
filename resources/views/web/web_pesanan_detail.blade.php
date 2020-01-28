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

    <section class="section--padding2 bgcolor">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="">
                        <div class="modules__content">
                            <div class="withdraw_module withdraw_history">
                                <div class="withdraw_table_header">
                                    <h3>Daftar Pesanan Anda</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table withdraw__table">
                                        <tbody>
                                            <tr>
                                                <td>Kode Transaksi</td>
                                                <td>{{ $detail->kode_transaksi }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <table class="table withdraw__table">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Produk</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>Kurir</th>
                                                <th>Ongkir</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($detail->transaksi_detail as $d)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $d->produk->nama_produk }}</td>
                                                    <td>{{ $d->jumlah }}</td>
                                                    <td>@currency($d->harga_jual)</td>
                                                    <td>{{  $d->kurir }} ({{ $d->service }})</td>
                                                    <td>@currency($d->ongkir)</td>
                                                    <td>@currency(($d->jumlah * $d->harga_jual) + $d->ongkir)</td>
                                                    <td>{{ $d->status_order }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection