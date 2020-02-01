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
                                <a href="#">Transaksi</a>
                            </li>
                            <li class="active">
                                <a href="#">Detail</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Detail Transaksi</h1>
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
    @include('pelapak.master')
    <!-- end /.dashboard_menu_area -->

        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h3>Detail Transaksi</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="upload_modules">
                            <div class="modules__title">
                                <h3>Detail Transaksi Anda</h3>
                            </div>
                            <div class="modules__content">
                                <table id="tbl" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Ekspedisi</th>
                                            <th>Ongkir</th>
                                            <th>Sub Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transaksi as $t)
                                            @if($t->status_order == 'pending')
                                                <?php $warna = 'red'; ?>
                                            @elseif($t->status_order == 'verifikasi')
                                                <?php $warna = 'blue'; ?>
                                            @elseif($t->status_order == 'packing')
                                                <?php $warna = 'yellow'; ?>
                                            @elseif($t->status_order == 'dikirim')
                                                <?php $warna = 'green'; ?>
                                            @endif
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $t->produk->nama_produk }}</td>
                                                <td>@currency($t->harga_jual)</td>
                                                <td>{{ $t->jumlah }}</td>
                                                <td>{{ $t->kurir }} ({{ $t->service }}) ({{ $t->etd }}) hari</td>
                                                <td>@currency($t->ongkir)</td>
                                                <td>@currency($t->jumlah * $t->harga_jual + $t->ongkir)</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: {{ $warna }}">
                                                            {{ $t->status_order }}
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="{{ URL::to('adminstrator/transaksi/status/edit/'.$t->id_transaksi_detail.'/pending/'.$t->transaksi_id) }}">Pending</a>
                                                            <a class="dropdown-item" href="{{ URL::to('adminstrator/transaksi/status/edit/'.$t->id_transaksi_detail.'/verifikasi/'.$t->transaksi_id) }}">Verifikasi</a>
                                                            <a class="dropdown-item" href="{{ URL::to('adminstrator/transaksi/status/edit/'.$t->id_transaksi_detail.'/packing/'.$t->transaksi_id) }}">Packing</a>
                                                            <a class="dropdown-item" href="{{ URL::to('adminstrator/transaksi/status/edit/'.$t->id_transaksi_detail.'/dikirim/'.$t->transaksi_id) }}">Dikirim</a>
                                                        </div>
                                                    </div>
                                                </td>
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
    </section>
@endsection