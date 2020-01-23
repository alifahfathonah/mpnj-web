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
                                <a href="#">Checkout</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Checkout Sukses</h1>
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
        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="shortcode_module_title">
                            <div class="dashboard__title">
                                <h3>Sukses!!! Anda telah menyelesaikan transaksi dengan nomor transaksi <strong>{{ $order_sukses->kode_transaksi  }}</strong> dengan total sebesar <strong>@currency($order_sukses->total_bayar)</strong>. Silahkan lakukan pemabayaran ke nomor rekening dibawah ini</h3>
                            </div>
                            <br>
                            <div class="information_wrapper form--fields table-responsive">
                                <table class="table withdraw__table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Rekening</th>
                                        <th>Nama Bank</th>
                                        <th>Atas Nama</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>1234567890</td>
                                        <td>Mandiri</td>
                                        <td>Nurul Jadid</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>0987654321</td>
                                        <td>BNI</td>
                                        <td>Nurul Jadid</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <br>
                            </div>
                            <h3>Setelah melakukan pembayaran, pastikan anda mengkonfirmasi pembayaran anda dengan mengunggah foto bukti transafer <a href="/konfirmasi">disini</a> agar transaksi anda segera di proses. Terima Kasih :D</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection