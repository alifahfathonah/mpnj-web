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
                <div class="col-md-12">
                    <div class="">
                        <div class="modules__content">
                            <div class="withdraw_module withdraw_history">
                                <div class="withdraw_table_header">
                                    <h3>Daftar Pesanan Anda</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table withdraw__table">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Kode Transaksi</th>
                                                <th>Total</th>
{{--                                                <th>Waktu</th>--}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order as $o)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $o->kode_transaksi }}</td>
                                                <td>@currency($o->total_bayar)</td>
{{--                                                <td>{{ @o->waktu_transaksi->format("d, M Y") }}</td>--}}
                                                <td>
                                                    <a href="/pesanan/detail/{{ $o->id_transaksi  }}">Detail</a>
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
        </div>
    </section>
@endsection