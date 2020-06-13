<main class="col-md-12">
    <article class="card">
        <header class="card-header">
            <strong class="d-inline-block mr-3">ID Transaksi: {{ $detail->id_transaksi_detail }} - <span>Waktu Pemesanan: {{ \Carbon\Carbon::parse($detail->transaksi->created_at)->format('d M, Y') }}</span></strong>
        </header>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h6 class="text-dark">Oleh</h6>
                    <p>{!! $detail->transaksi->to !!}</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-dark">Overview</h6>
                    <span>
                        Status: <div class="btn btn-primary btn-sm">{{ $detail->status_order }}</div>
                    </span>
{{--                    <p>Total Bayar: @currency($detail->transaksi->total_bayar)--}}
{{--                    </p>--}}
                </div>
            </div> <!-- row.// -->
        </div> <!-- card-body .// -->
        <div class="table-responsive">
            @if(session()->has('trxBatalSukses'))
                <div class="alert alert-danger alert-dismissable">{{ session()->get('trxBatalSukses') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif(session()->has('trxSukses'))
                <div class="alert alert-success alert-dismissable">{{ session()->get('trxSukses') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <table class="table table-hover">
                <thead>
                    <th colspan="2">Produk</th>
                    <th>Total</th>
                    <th>Kurir</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                <tr>
                    <td width="65">
                        <img src="{{ env('FILES_ASSETS').$detail->produk->foto_produk[0]->foto_produk }}" class="img-xs border">
                    </td>
                    <td>
                        <p class="title mb-0">{{ $detail->produk->nama_produk }}</p>
                        <var class="price text-muted">
                            @if($detail->diskon == 0)
                                <span style="color: black">@currency($detail->harga_jual) x {{ $detail->jumlah }} @<a href="{{ URL::to('pelapak/'.$detail->user->username) }}">{{ $detail->user->nama_toko }}</a></span>
                            @else
                                <span style="color: black">@currency($detail->harga_jual - ($detail->diskon / 100 *
                                                            $detail->harga_jual)) x {{ $detail->jumlah }} @<a href="{{ URL::to('pelapak/'.$detail->user->username) }}">{{ $detail->user->nama_toko }}</a></span>
                            @endif
                        </var>
                    </td>
                    <td>
                        @if($detail->diskon == 0)
                            <span style="color: black">@currency($detail->harga_jual)</span>
                        @else
                            <span style="color: black">@currency($detail->harga_jual - ($detail->diskon / 100 * $detail->harga_jual))</span>
                        @endif
                    </td>
                    <td>
                        Kurir: {{ $detail->kurir }} <br>
                        Service: {{ $detail->service }} <br>
                        Ongkir: @currency($detail->ongkir)
                    </td>
                    <td>
                        @if($detail->status_order != 'Dibatalkan')
                            @if($detail->transaksi->proses_pembayaran != 'belum')
                                @if($detail->transaksi->proses_pembayaran != 'sudah' && $detail->resi != '')
                                    <a href="{{ URL::to('pesanan/tracking/'.$detail->id_transaksi_detail) }}" class="btn btn-outline-success">Track order</a>
                                @elseif($detail->transaksi->proses_pembayaran != 'sudah' && $detail->resi == '')
                                    <a href="#" class="btn btn-outline-success" data-target="#modalLacak" data-toggle="modal">
                                        Track order </a>
                                @else
                                   Menunggu Konfirmasi
                                @endif
                                @if($detail->status_order == 'Dikirim')
                                    <a href="#" class="btn btn-outline-success" data-target="#modalPesananDiterima" data-toggle="modal">Pesanan Diterima</a>
                                @endif
                                @if($detail->status_order == 'Telah Sampai')
                                    <a href="{{ URL::to('review/produk/'.$detail->produk->slug) }}" class="btn btn-outline-success">Beri Ulasan</a>
                                @endif
                            @else
                                <a href="{{ URL::to('konfirmasi/data/'.$detail->transaksi->kode_transaksi) }}" class="btn btn-outline-danger">Bayar Sekarang</a>
                                <a href="#" class="btn btn-outline-danger" data-target="#modalBatalTransaksi" data-toggle="modal">Batalkan Pesanan</a>
                            @endif
                        @else
                            Transaksi Dibatalkan
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="4" rowspan="6"></td>
                    <td>Subtotal : @currency($detail->sub_total - $detail->ongkir)</td>
                </tr>
                <td>Ongkir : @currency($detail->ongkir)</td>
                <tr>
                    <td>Total : @currency($detail->sub_total)</td>
                </tr>
                <tr>
                    <td>
                        <a href="{{ URL::to('pesanan/export_invoice/'.$detail->id_transaksi_detail) }}" class="btn btn-outline-success">Cetak Invoice</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </article> <!-- order-group.// -->
</main>

<div class="modal fade" id="modalPesananDiterima" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Anda Yakin Pesanan Anda Sudah Sampai ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Pastikan pesanan anda telah sampai dan sesuai. Jika anda mengkonfirmasi pesanan anda telah sampai, maka dana akan kita kirimkan ke penjual dan transaksi dianggap telah selesai.
                <br>
                <br>
                <form action="{{ URL::to('pesanan/diterima/'.$detail->id_transaksi_detail) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-success">Lanjutkan</button>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn--round modal_close" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

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
                Untuk saat ini anda tidak dapat melacak pesanan anda. Tunggu hingga penjual mengirimkan nomor resi
                pesanan, setelah itu anda dapat melacak pesanan anda.
            </div>
            <div class="modal-footer">
                <button class="btn btn--round modal_close" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalBatalTransaksi" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Apa anda yangkin ingin membatalkan transaksi ini ?
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ URL::to('pesanan/dibatalkan/'.$detail->id_transaksi_detail) }}">
                @csrf
                <div class="modal-body text-center">
                    <input type="hidden" class="form-control" id="kode_transaksi" name="kode_transaksi">
                    Pembatalan transaksi akan membuat anda kehilangan transaksi ini yang artinya transaksi ini tidak
                    akan lagi diproses. Yakinkan diri anda terlebih dahulu untuk terus membatalkan transaksi ini. Jika
                    anda yakin, tekan tombol lanjutkan.
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--round btn-danger btn--default">Ya, Lanjutkan</button>
                </div>
            </form>
        </div>
    </div>
</div>