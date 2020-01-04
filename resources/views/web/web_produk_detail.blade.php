@extends('web.web_master')

@section('web_konten')
    <div class="row">
        <div class="col-md-5">
            <img src="http://localhost:8000/assets/foto_produk/{{ $produk->foto_produk[0]->foto_produk }}" alt="{{ $produk->nama_produk }}" width="300">
        </div>
        <div class="col-md-5">
            <form action="" method="post">
                <table class="table">
                    <tr>
                        <th>Nama Produk</th>
                        <td>{{ $produk->nama_produk }}</td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>{{ $produk->stok }}</td>
                    </tr>
                    <tr>
                        <th>Satuan</th>
                        <td>{{ $produk->satuan }}</td>
                    </tr>
                    <tr>
                        <th>Berat</th>
                        <td>{{ $produk->berat }} gram</td>
                    </tr>
                    <tr>
                        <th>Qty</th>
                        <td><input type="number" name="qty" id="qty" value="1"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit" name="tambah_cart">Tambah Ke Keranjang</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection
