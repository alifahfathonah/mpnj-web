@extends('mpnj.layout.main')

@section('title','Market Place PP Nurul Jadid')


@section('content')
    <br>
    <section class="signup_area section--padding2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="card mb-4">
                        <article class="card-body">
                            <header class="mb-4">
                                <center>
                                    <h4 class="card-title">Konfirmasi Pembayaran</h4>
                                    <small>Masukkan kode transaksi anda untuk melakukan konfirmasi pembayaran.</small>
                                </center>
                            </header>
                            <form action="{{ isset($cek) ? '/konfirmasi/simpan' : '/konfirmasi/data' }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @if(session('kodeKosong'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('kodeKosong') }}
                                    </div>
                                @endif

                                @if(isset($cek))
                                    <div class="form-group">
                                        <label for="kode_transaksi">Kode Transaksi</label>
                                        <input id="kode_transaksi" type="text" class="form-control" placeholder="Isi dengan kode transaksi anda" name="kode_transaksi" value="{{  $cek->kode_transaksi }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_pengirim">Nama Pengirim</label>
                                        <input id="nama_pengirim" type="text" class="form-control" name="nama_pengirim" value="{{  $cek->pembeli->nama_lengkap }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="total_bayar">Total Bayar</label>
                                        <input id="total_bayar" type="text" class="form-control" name="total_bayar" value="{{ $cek->total_bayar }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="rekening">Pilih Rekening</label>
                                        <select name="rekening" id="rekening" class="form-control" required>
                                            <option value="1">Mandiri - 1234567890 - Nurul Jadid</option>
                                            <option value="2">BNI - 0987654321 - Nurul Jadid</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="bukti_transfer">Bukti Transfer</label>
                                        <input id="bukti_transfer" type="file" class="form-control" name="bukti_transfer">
                                        @if($errors->has('bukti_transfer'))  <small style="color: red">{{ $errors->first('bukti_transfer') }}</small> @endif
                                    </div>
                                    <button class="btn btn-primary" type="submit" name="kirim">Kirim</button>
                                @else
                                    <div class="form-group">
                                        <label>Kode Transaksi</label>
                                        <input type="text" class="form-control" placeholder="Isi dengan kode transaksi" name="kode_transaksi" value="{{ old('kode_transaksi') }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block"> Lanjut  </button>
                                @endif
                            </form>
                        </article>
                    </div>
                    <!-- card-body end .// -->
                </div> <!-- card.// -->

            </div>
            <!-- end .col-md-6 -->
        </div>
        <!-- end .row -->

        <!-- end .container -->
    </section>
@endsection