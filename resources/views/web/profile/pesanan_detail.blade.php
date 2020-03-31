<main class="col-md-12">
    <article class="card">
        <header class="card-header">
            <strong class="d-inline-block">Kode Transaksi: {{ $detail->kode_transaksi }}</strong>
            <hr>
            <div class="col-md-8">
                <h6 class="text-dark">Keterangan</h6>
                <p>ID Pesanan: {{ $detail->id_transaksi_detail }}<br>
                    <span class="text-danger">
                        {{ $detail->proses_pembayaran }} dibayar
                    </span><br>
                    Waktu Pesanan: {{ $detail->waktu_transaksi }}<br>
                </p>
            </div>
        </header>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h6 class="text-dark">Oleh</h6>
                    <p>{{ $detail->pembeli->alamat_fix->nama }}<br>
                        Telepon {{ $detail->pembeli->alamat_fix->nomor_telepon }}<br>
                        Alamat:{{ $detail->pembeli->alamat_fix->alamat_lengkap}},
                        {{ $detail->pembeli->alamat_fix->nama_kota }}, {{ $detail->pembeli->alamat_fix->nama_provinsi }}
                        <br>
                        Kode Pos: {{ $detail->pembeli->alamat_fix->kode_pos }}
                    </p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-dark">Overview</h6>
                    <span class="text-success">
                        {{--                        <i class="fab fa-lg fa-cc-visa"></i>--}}
                        {{--                        {{ $detail->proses_pembayaran }}--}}
                    </span>
                    <p>Total Bayar: @currency($detail->total_bayar)
                    </p>
                </div>
            </div> <!-- row.// -->
        </div> <!-- card-body .// -->
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                    @foreach( $detail->transaksi_detail as $d)
                    <tr>
                        <td width="65">
                            <img src="{{ asset('assets/foto_produk/'.$d->produk->foto_produk[0]->foto_produk) }}"
                                class="img-xs border">
                        </td>
                        <td>
                            <a href="{{ URL::to('produk/'.$d->produk->slug) }}">
                                <p class="title mb-0">{{ $d->produk->nama_produk }}</p>
                            </a>
                            <p class="title mb-0 text-success">Barang {{ $d->status_order }}</p>
                            <var class="price text">
                                @if($d->diskon == 0)
                                @currency($d->harga_jual)
                                @else
                                <strike style="color: red">@currency($d->harga_jual)</strike> <span
                                    style="color: black;">| @currency($d->harga_jual - ($d->diskon / 100 *
                                    $d->harga_jual))</span>
                                @endif
                            </var>
                        </td>
                        <td>Jumlah : {{ $d->jumlah }} Ongkir : <br>{{ $d->ongkir }}</td>
                        <td> Total :
                            @if($d->diskon == 0)
                            @currency($d->jumlah * $d->harga_jual + $d->ongkir)
                            @else
                            @currency(($d->harga_jual - ($d->diskon / 100 * $d->harga_jual)) * $d->jumlah + $d->ongkir)
                            @endif </td>
                        <td>
                            <a href="{{ URL::to('pesanan/tracking/'.$d->id_transaksi_detail) }}" class="btn btn-warning btn-sm"> Lacak Barang </a>
                        </td>
                        <td>
                            <a href="{{ URL::to('pesanan/diterima/'.$d->id_transaksi_detail) }}"
                                class="btn btn-success btn-sm"> Pesanan Diterima </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @php $edited = false; @endphp

        @if($detail->status_order == 'sukses')
        <div class="card-body">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="card-title mb-4">Review</h4>
                    @if($review != '')
                    <div class="small">{{ $review->updated_at->format('d M Y') }}</div>
                    <div class="rating-wrap my-3">
                        <ul class="rating-stars">
                            <li style="width:80%" class="stars-active">
                                @for($i = 1; $i <= $review->bintang; $i++)
                                    <i class="fa fa-star"></i>
                                    @endfor
                            </li>
                            <li>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </li>
                        </ul>
                    </div>
                    <p class="mb-">{{ $review->review}}</p>
                    <img src="{{ asset('assets/foto_review/'.$review->foto_review) }}" class="img-x border">
                    @else


                    <form method="post" action="{{ URL::to('review/produk') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_produk" value="{{ $detail->produk->id_produk }}">
                        <h5 class="card-title">Bintang</h5>

                        <label class="custom-control custom-radio">
                            <input type="radio" name="bintang" checked="" class="custom-control-input" value="1">
                            <div class="custom-control-label text-warning">
                                <i class="fa fa-star"></i>
                            </div>
                        </label>

                        <label class="custom-control custom-radio">
                            <input type="radio" name="bintang" checked="" class="custom-control-input" value="2">
                            <div class="custom-control-label text-warning">
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                        </label>

                        <label class="custom-control custom-radio">
                            <input type="radio" name="bintang" class="custom-control-input" value="3">
                            <div class="custom-control-label text-warning">
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                        </label>

                        <label class="custom-control custom-radio">
                            <input type="radio" name="bintang" class="custom-control-input" value="4">
                            <div class="custom-control-label text-warning">
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </label>

                        <label class="custom-control custom-radio">
                            <input type="radio" name="bintang" class="custom-control-input" value="5">
                            <div class="custom-control-label text-warning">
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                        </label>

                        <br>

                        <div class="form-group">
                            <label>Komentar Produk</label>
                            <textarea name="review" class="form-control" rows="3"
                                placeholder="Beri komentar Barang yang Sesuai."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Foto Produk</label><br>
                            <label for="exampleFormControlFile1">
                                <input type="file" name="foto_review" id="foto_review" class="form-control-file">
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Send</button>
                    </form>
                    @endif
                </div>
            </div> <!-- row.// -->
        </div>
        @endif
    </article> <!-- order-group.// -->
</main>