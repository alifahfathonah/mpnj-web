@extends('mpnj.layout.main')

@section('title','Market Place PP Nurul Jadid')

@section('content')
<br>
<section class="dashboard-area">
    <div class="dashboard_contents">
        <div class="container">
            <div class="row">
                <div class="box">
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
                        <h3>Setelah melakukan pembayaran, pastikan anda mengkonfirmasi pembayaran anda dengan mengunggah foto bukti transafer agar transaksi anda segera di proses.</h3>
                        <div class="card-body border-top">
                            <a href="{{ URL::to('konfirmasi') }}"><button class="btn btn-primary float-md-right">Lanjutkan <i class="fa fa-chevron-right"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
@endsection
