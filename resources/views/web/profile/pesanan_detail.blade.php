<main class="col-md-12">
    <article class="card">
        <header class="card-header">
            <strong class="d-inline-block">Kode Transaksi: {{ $detail->kode_transaksi }}</strong>
            <hr>
            <div class="col-md-8">
                <h6 class="text-dark">Keterangan</h6>
                <p>
                    Waktu Pesanan: {{ $detail->waktu_transaksi }}<br>
                    Dibayar Pada : {{ $detail->konfirmasi == null ? '-' : $detail->konfirmasi->tanggal_transfer }}
                </p>
            </div>
        </header>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h6 class="text-dark">Oleh</h6>
                    <p>{{ $detail->user->alamat_fix->nama }}<br>
                        Telepon {{ $detail->user->alamat_fix->nomor_telepon }}<br>
                        Alamat:{{ $detail->user->alamat_fix->alamat_lengkap}},
                        {{ $detail->user->alamat_fix->nama_kota }}, {{ $detail->user->alamat_fix->nama_provinsi }}
                        <br>
                        Kode Pos: {{ $detail->user->alamat_fix->kode_pos }}
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
                        <td>Jumlah : {{ $d->jumlah }}  <br> Ongkir : {{ $d->ongkir }}</td>
                        <td> Total :
                            @if($d->diskon == 0)
                                @currency($d->jumlah * $d->harga_jual + $d->ongkir)
                            @else
                                @currency(($d->harga_jual - ($d->diskon / 100 * $d->harga_jual)) * $d->jumlah + $d->ongkir)
                            @endif </td>
                        @if($detail->status_transaksi != 'batal')
                            @if($d->status_order == 'Dikirim')
                                <td>
                                	@if($d->resi != '')
                                		<a href="{{ URL::to('pesanan/tracking/'.$d->id_transaksi_detail) }}" class="btn btn-warning btn-sm"> Lacak Barang </a>
                            		@else
                                		<a href="#" class="btn btn-warning btn-sm" data-target="#modalLacak" data-toggle="modal"> Lacak Barang </a>
                            		@endif
                                    <a href="{{ URL::to('pesanan/diterima/'.$d->id_transaksi_detail) }}"
                                       class="btn btn-success btn-sm"> Pesanan Diterima </a>
                                </td>
                            @elseif($d->status_order == 'Telah Dikonfirmasi' || $d->status_order == 'Dikemas')
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm">Menunggu Pengiriman</button>
                                </td>
                            @elseif($d->status_order == 'Telah Sampai')
                                <td colspan="2">
                                    <a href="{{ URL::to('nilai/'.$d->id_transaksi_detail) }}"
                                       class="btn btn-success btn-sm"> Nilai</a>
                                </td>
                            @endif
                        @endif
                    </tr>
                    @endforeach
                    @if($detail->status_transaksi != 'batal')
                        @if($detail->proses_pembayaran == 'belum')
                            <tr>
                                <td colspan="4">
                                    <a href="{{ URL::to('checkout/sukses/'.$detail->kode_transaksi) }}" class="btn btn-danger btn-sm">Bayar Sekarang</a>
                                    <a href="#" class="btn btn-danger btn-sm" data-target="#modalBatalTransaksi"
                                       data-toggle="modal" onclick="batalTransaksiConfirm({{ $detail->kode_transaksi }}, {{ $detail->id_transaksi }})">Batalkan Pesanan</a>
                                </td>
                            </tr>
                        @endif
                    @endif
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

<div class="modal fade" id="modalLacak" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tidak dapat melacak pesanan.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Untuk saat ini anda tidak dapat melacak pesanan anda. Tunggu hingga penjual mengirimkan nomor resi pesanan, setelah itu anda dapat melacak pesanan anda.
            </div>
            <div class="modal-footer">
                <button class="btn btn--round modal_close" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalBatalTransaksi" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Apa anda yangkin ingin membatalkan transaksi ini ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="formBatalTransaksi">
                @csrf
                <div class="modal-body text-center">
                    <input type="hidden" class="form-control" id="kode_transaksi" name="kode_transaksi">
                    Pembatalan transaksi akan membuat anda kehilangan transaksi ini yang artinya transaksi ini tidak akan lagi diproses. Yakinkan diri anda terlebih dahulu untuk terus membatalkan transaksi ini. Jika anda yakin, tekan tombol lanjutkan.
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--round btn-danger btn--default" onclick="submitBatalTransakai()">Ya, Lanjutkan</button>
                    <button class="btn btn--round modal_close" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function batalTransaksiConfirm(kode, id_transaksi) {
            $("#kode_transaksi").val(kode);
            $("#formBatalTransaksi").attr('action', '{{ URL::to('pesanan/dibatalkan')}}/'+id_transaksi);
        }

        function submitBatalTransakai() {
            $("#formBatalTransaksi").submit();
        }
    </script>
@endpush
