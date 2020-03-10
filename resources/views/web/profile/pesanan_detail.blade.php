<main class="col-md-12">
    <article class="card">
        <header class="card-header">
            <strong class="d-inline-block mr-3">ID Pesanan: {{ $detail->transaksi_detail->id_transaksi_detail }}</strong>
            <span>Waktu Pesanan: {{ $detail->waktu_transaksi }}</span>
        </header>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h6 class="text-dark">Oleh</h6>
                    <p>{{ $detail->pembeli->nama_lengkap }}<br>
                        Telepon {{ $detail->pembeli->alamat_fix->nomor_telepon }}<br>
                        Alamat:{{ $detail->pembeli->alamat_fix->alamat_lengkap}}, {{ $detail->pembeli->alamat_fix->nama_kota }}, {{ $detail->pembeli->alamat_fix->nama_provinsi }} <br>
                        Kode Pos: {{ $detail->pembeli->alamat_fix->kode_pos }}
                    </p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-dark">Status</h6>
                    <span class="text-success">
                        <i class="fab fa-lg fa-cc-visa"></i>
                        {{ $detail->transaksi_detail->status_order }}
                    </span>
                    <p>Subtotal:
                        @if($detail->transaksi_detail->diskon == 0)
                        @currency($detail->transaksi_detail->jumlah * $detail->transaksi_detail->harga_jual)
                        @else
                        @currency(($detail->transaksi_detail->harga_jual - ($detail->transaksi_detail->diskon / 100 * $detail->transaksi_detail->harga_jual)) * $detail->transaksi_detail->jumlah)
                        @endif <br>
                        Kurir: {{ $detail->transaksi_detail->kurir }} - {{ $detail->transaksi_detail->service }} <br>
                        Ongkir: @currency($detail->transaksi_detail->ongkir) <br>
                        <span class="b">Total: @if($detail->transaksi_detail->diskon == 0)
                            @currency(($detail->transaksi_detail->jumlah * $detail->transaksi_detail->harga_jual) + $detail->transaksi_detail->ongkir)
                            @else
                            @currency(($detail->transaksi_detail->harga_jual - ($detail->transaksi_detail->diskon / 100 * $detail->transaksi_detail->harga_jual)) * $detail->transaksi_detail->jumlah + $detail->transaksi_detail->ongkir)
                            @endif
                        </span>
                    </p>
                </div>
            </div> <!-- row.// -->
        </div> <!-- card-body .// -->
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <td width="65">
                            <img src="{{ asset('assets/foto_produk/'.$detail->transaksi_detail->produk->foto_produk[0]->foto_produk) }}" class="img-xs border">
                        </td>
                        <td>
                            <a href="{{ URL::to('produk/'.$detail->transaksi_detail->produk->slug) }}">
                                <p class="title mb-0">{{ $detail->transaksi_detail->produk->nama_produk }}</p>
                            </a>
                            <var class="price text-muted">
                                @if($detail->transaksi_detail->diskon == 0)
                                @currency($detail->transaksi_detail->harga_jual)
                                @else
                                <strike style="color: red">@currency($detail->transaksi_detail->harga_jual)</strike> <span style="color: black;">| @currency($detail->transaksi_detail->harga_jual - ($detail->transaksi_detail->diskon / 100 * $detail->transaksi_detail->harga_jual))</span>
                                @endif
                            </var>
                        </td>
                        <td>Jumlah : {{ $detail->transaksi_detail->jumlah }}</td>
                        <td> Total :
                            @if($detail->transaksi_detail->diskon == 0)
                            @currency($detail->transaksi_detail->jumlah * $detail->transaksi_detail->harga_jual)
                            @else
                            @currency(($detail->transaksi_detail->harga_jual - ($detail->transaksi_detail->diskon / 100 * $detail->transaksi_detail->harga_jual)) * $detail->transaksi_detail->jumlah)
                            @endif </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </article> <!-- order-group.// -->
</main>