@extends('mpnj.layout.main')

@section('title','Market Place PP Nurul Jadid')

@section('content')
<section class="section-content padding-y">
    <div class="container">
        <div class="alert alert-success mt-3">
            <p><i class="icon text-success fa fa-thumbs-up"></i> Sukses!!! Anda telah menyelesaikan transaksi dengan nomor transaksi <strong> {{ $order_sukses->kode_transaksi  }}</strong> dengan total sebesar <strong> @currency($order_sukses->total_bayar)</strong>. Silahkan lakukan pemabayaran ke nomor rekening dibawah ini</p>
        </div>
        <table class="table table-striped" style="background-color: white;">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nomor Rekening</th>
                    <th scope="col">Nama Bank</th>
                    <th scope="col">Atas Nama</th>
                </tr>
            </thead>
            <tbody class="table-striped ">
                <tr>
                    <td scope="row">1</td>
                    <td>1234567890</td>
                    <td>Mandiri</td>
                    <td>Nurul Jadid</td>
                </tr>
                <tr>
                    <td scope="row">2</td>
                    <td>0987654321</td>
                    <td>BNI</td>
                    <td>Nurul Jadid</td>
                </tr>
            </tbody>
        </table>
        <section class="section-name border-top padding-y">
            <div class="container">
                <p>Setelah melakukan pembayaran, pastikan anda mengkonfirmasi pembayaran anda dengan mengunggah foto bukti transafer agar transaksi anda segera di proses.</p>
                <a href="{{ URL::to('konfirmasi') }}"><button type="button" class="btn btn-primary btn-block">Lanjutkan Proses <i class="fa fa-chevron-right"></i></button></a>
            </div>
        </section>
    </div>
</section>
@endsection