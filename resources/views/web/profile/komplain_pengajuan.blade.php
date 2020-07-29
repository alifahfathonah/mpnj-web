<h5 class="card-title">Komplain Anda</h5>
<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-4">Apa Masalah Yang Anda Temui ?</h5>
        <form action="{{ URL::to('komplain/simpan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="id_transaksi" name="id_transaksi" value="{{$komplain->id_transaksi}}">
            <div class="form-group">
                <label>Toko Yang Bermasalah !</label>
                @foreach($komplain->transaksi_detail->unique('user_id') as $toko)
                <input type="text" id="nama_toko" name="nama_toko" class="form-control"
                    value="{{$toko->user->nama_toko}}" maxlength="225" disabled>
                <input type="hidden" id="id_user" name="id_user" value="{{$toko->user_id}}">
                <input type="hidden" id="kode_invoice" name="kode_invoice" value="{{$toko->kode_invoice}}">
                @endforeach
            </div>
            <div class="form-group">
                <label>Pilih Produk Yang Bermasalah !</label>
                <select class="form-control" name="id_produk" id="id_produk">
                    @foreach($komplain->transaksi_detail as $produk)
                    <option value="{{$produk->produk_id}}" id="produk">{{$produk->produk->nama_produk}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Pilih Masalah Yang Anda Temukan !</label>
                <select class="form-control" name="komplain" id="komplain">
                    <option value="Tidak Sesuai">Produk Tidak Sesuai Deskripsi</option>
                    <option value="Tidak Lengkap">Produk Tidak Lengkap</option>
                    <option value="Rusak">Produk Rusak</option>
                </select>
            </div>
            <div class="form-group">
                <label>Masukkan Deskripsi Masalah</label>
                <textarea class="form-control" rows="3" name="deskripsi" id="deskripsi"
                    placeholder="Berikan Deskripsi Lengkap Anda"></textarea>
            </div>
            <div class="form-group">
                <label>Masukkan Bukti Masalah</label>
                <input type="file" class="form-control" name="foto_komplain" id="foto_komplain">
                @if($errors->has('foto_komplain'))
                <small style="color: red">{{ $errors->first('foto_komplain') }}</small> @endif
            </div>
            <button class="btn btn-primary btn-block" type="submit">Kirim</button>
        </form>
    </div> <!-- card-body.// -->
</div>