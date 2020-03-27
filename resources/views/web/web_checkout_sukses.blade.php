@extends('mpnj.layout.main')

@section('title','Market Place PP Nurul Jadid')

@section('content')
<section class="section-content padding-y">
    <div class="container">
        <div class="col-md-12">
            <article class="card order-group">
                <header class="card-header text-center">
                    <b class="d-inline-block mr-3">No. Transaksi: <a class="title ml-3 h4" id="noTransaksi"
                            value="{{ $order_sukses->kode_transaksi }}">{{ $order_sukses->kode_transaksi }}</a></b>
                    <br>
                    <span>Waktu Transaksi: {{ $order_sukses->waktu_transaksi  }} | Batas Pembayaran:
                        {{ $order_sukses->batas_transaksi  }}</span>
                </header>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="text">Pembayaran</h6>
                            <span class="text-success font-weight-bold">
                                @foreach($rekening_admin as $ra)
                                @if($ra->bank->nama_bank == 'BNI')
                                <img src="{{ asset('assets/logo/ic_bni.png') }}" height="26">
                                @elseif($ra->bank->nama_bank == 'Mandiri')
                                <img src="{{ asset('assets/logo/ic_mandiri.png') }}" height="26">
                                @endif
                                | {{$ra->nomor_rekening}} | {{$ra->atas_nama_rekening}}<br>
                                @endforeach
                            </span>
                            <p>Total Ongkir : @currency($order_ongkir) <br>
                                <span class="b">Total Bayar: @currency($order_sukses->total_bayar)</span>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text">Contact Pengirim</h6>
                            <p> {{ $order_sukses->pembeli->nama_lengkap }} <br> {{ $order_sukses->pembeli->nomor_hp }}
                                <br> {{ $order_sukses->pembeli->email }}</p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text">Alamat Pengiriman</h6>
                            <p> {{ $order_sukses->pembeli->alamat_fix->alamat_lengkap }} {{strtotime("+1 day")}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="container">
                        <ul class="list-unstyled">
                            <li>Penting :
                                <ol>
                                    <li>Pastikan anda melakukan pembayaran melalui rekening yang sudah tertera diatas.
                                    </li>
                                    <li>Pastikan anda melakukan pembayaran sesuai dengan total bayar yang sudah tertera
                                        diatas.
                                    </li>
                                    <li>Jika anda tidak melakukan pembayaran sampai <strong>Batas Pembayaran</strong>
                                        transaksi anda otomatis dibatalkan.</li>
                                    <li>Setelah melakukan pembayaran, pastikan anda mengkonfirmasi pembayaran anda
                                        dengan mengunggah
                                        foto bukti transafer agar transaksi anda segera di proses (Tekan tombol
                                        Lanjutkan Proses / Konfirmasi di laman profil pesanan).</li>
                                </ol>
                            </li>
                        </ul>
                        <a href="{{ URL::to('konfirmasi/data/'.$order_sukses->kode_transaksi) }}"><button type="button"
                                class="btn btn-primary btn-block">Lanjutkan Proses <i
                                    class="fa fa-chevron-right"></i></button></a>
                    </div>
                </div>
            </article>
        </div>
    </div>

</section>
@endsection