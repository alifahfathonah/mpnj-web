<h5 class="card-title">Wishlist Anda</h5>
<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-4">Apa Masalah Yang Anda Temui ?</h5>
        <form action="{{ URL::to('konfirmasi/simpan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Pilih Toko Yang Bermasalah !</label>
                <select class="form-control" name="id_user" id="id_user">
                    @foreach($komplain->transaksi_detail->unique('user_id') as $toko)
                    <option value="{{$toko->user_id}}">{{$toko->user->nama_toko}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Pilih Produk Yang Bermasalah !</label>
                <select class="form-control" name="id_produk" id="id_produk">
                    @foreach($komplain->transaksi_detail as $produk)
                    <option value="{{$produk->produk_id}}">{{$produk->produk->nama_produk}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Pilih Masalah Yang Anda Temukan !</label>
                <select class="form-control" name="komplain" id="komplain">
                    <option value="TS">Produk Tidak Sesuai Deskripsi</option>
                    <option value="TL">Produk Tidak Lengkap</option>
                    <option value="RS">Produk Rusak</option>
                </select>
            </div>
            <div class="form-group">
                <label>Masukkan Deskripsi Masalah</label>
                <textarea class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Masukkan Bukti Masalah</label>
                <input type="file" class="form-control">
            </div>
            <button class="btn btn-primary btn-block" type="submit">Kirim</button>
        </form>
    </div> <!-- card-body.// -->
</div>