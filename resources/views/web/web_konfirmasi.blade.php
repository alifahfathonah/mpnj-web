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
                                <a href="#">Konfirmasi Pembayaran</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Konfirmasi Pembayaran</h1>
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
                    <div class="col-lg-6 offset-lg-3">
                        <form action="{{ isset($cek) ? '/konfirmasi/simpan' : '/konfirmasi/data' }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="cardify signup_form">
                                <div class="login--header">
                                    <h3>Konfirmasi Pembayaran</h3>
                                    <p>Konfirmasi pembayaran anda dengan mengunggah bukti pembayaran anda disini.</p>
                                </div>
                                <div class="login--form">
                                    @if(session('kodeKosong'))
                                        <div class="alert alert-danger" role="alert">
                                            <span class="alert_icon lnr lnr-warning"></span>
                                            {{ session('kodeKosong') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span class="lnr lnr-cross" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    @endif
                                    @if(isset($cek))
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <input id="kode_transaksi" type="text" class="text_field" placeholder="Isi dengan kode transaksi anda" name="kode_transaksi" value="{{  $cek->kode_transaksi }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_pengirim">Nama Pengirim</label>
                                            <input id="nama_pengirim" type="text" class="text_field" name="nama_pengirim" value="{{  $cek->pembeli->nama_lengkap }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="total_bayar">Total Bayar</label>
                                            <input id="total_bayar" type="text" class="text_field" name="total_bayar" value="{{ $cek->total_bayar }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="rekening">Pilih Rekening</label>
                                            <select name="rekening" id="rekening" class="text_field" required>
                                                <option value="1">Mandiri - 1234567890 - Nurul Jadid</option>
                                                <option value="2">BNI - 0987654321 - Nurul Jadid</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="bukti_transfer">Bukti Transfer</label>
                                            <input id="bukti_transfer" type="file" class="form-control" name="bukti_transfer">
                                            @if($errors->has('bukti_transfer'))  <small style="color: red">{{ $errors->first('bukti_transfer') }}</small> @endif
                                        </div>
                                        <button class="btn btn--md btn--round register_btn" type="submit" name="kirim">Kirim</button>
                                    @else
                                    <div class="form-group">
                                        <label for="kode_transaksi">Kode Transaksi</label>
                                        <input id="kode_transaksi" type="text" class="text_field" placeholder="Isi dengan kode transaksi anda" name="kode_transaksi" value="{{ old('kode_transaksi') }}">
                                    </div>
                                        <button class="btn btn--md btn--round register_btn" type="submit">Lanjut</button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection