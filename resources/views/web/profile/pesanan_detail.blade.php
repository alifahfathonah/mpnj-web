<main class="col-md-12">
    <article class="card">
        <header class="card-header">
            <strong class="d-inline-block mr-3">ID Transaksi: {{ $detail->kode_transaksi }} -
                <span>Waktu Pemesanan:
                    {{ \Carbon\Carbon::parse($detail->created_at)->format('d M, Y') }}</span></strong>
        </header>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h6 class="text-dark">Oleh</h6>
                    <p>{!! $detail->to !!}</p>
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
            <br>
            <table class="table table-hover">
                <tbody>
                    @foreach($detail->transaksi_detail->groupBy('user.nama_toko') as $key => $de)
                    <article class="card">
                        <header class="card-header">
                            <strong class="d-inline-block mr-3">{{ $key }}</strong>
                        </header>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    @foreach($de as $d)
                                    <tr>
                                        <td width="65">
                                            <img src="{{ env('FILES_ASSETS').$d->produk->foto_produk[0]->foto_produk }}"
                                                class="img-xs border">
                                        </td>
                                        <td width="600">
                                            <p class="title mb-0">{{ $d->produk->nama_produk }}</p>
                                            <var class="price text-muted">
                                                @if($d->diskon == 0)
                                                <span style="color: black">@currency($d->harga_jual) x {{ $d->jumlah }}
                                                </span>
                                                @else
                                                <span style="color: black">@currency($d->harga_jual - ($d->diskon / 100
                                                    *
                                                    $d->harga_jual)) x {{ $d->jumlah }} </span>
                                                @endif
                                            </var>
                                        </td>
                                        <td>@currency($d->sub_total)</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2">Ongkir ({{ $d->pengiriman->kurir }},
                                            {{ $d->pengiriman->service }}
                                            )
                                        </td>
                                        <td>@currency($d->pengiriman->ongkir)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Total</td>
                                        <td>
                                            @currency($de->sum('sub_total') + $d->pengiriman->ongkir)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Aksi</td>
                                        <td>@if($detail->transaksi_detail[0]->status_order ==
                                            'Telah Sampai')
                                            <a href="{{URL::to('review/produk/'.$d->produk->slug) }}"
                                                class="btn btn-sm btn-outline-success ml-2" style="float: right">Beri
                                                Ulasan</a>
                                            @endif
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- table-responsive .end// -->
                    </article>
                    @endforeach
                </tbody>
            </table>
            <br>
            <table class="table table-hover table-bordered">
                <tr>
                    <td width="665">Total Bayar</td>
                    <td>
                        @if($detail->proses_pembayaran == 'belum')
                            @currency($detail->total_bayar)
                        @else
                            @currency($detail->transaksi_detail->sum('sub_total') + $d->pengiriman->ongkir)
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Aksi</td>
                    <td>
                        @if($detail->transaksi_detail[0]->status_order != 'Dibatalkan')
                            @if($detail->proses_pembayaran == 'belum')
                            <a href="{{ URL::to('konfirmasi/data/'.$detail->kode_transaksi) }}"
                                class="btn btn-sm btn-outline-success">Bayar Sekarang</a>
                            <a href="#" class="btn btn-sm btn-outline-danger" data-target="#modalBatalTransaksi"
                                data-toggle="modal">Batalkan Pesanan</a>
                            @elseif($detail->proses_pembayaran == 'terima' && $detail->transaksi_detail[0]->status_order ==
                            'Dikirim')
                            <a href="#" class="btn btn-sm btn-outline-success" data-target="#modalPesananDiterima"
                                data-toggle="modal">Pesanan Diterima</a>
                            <a href="{{ URL::to('pesanan/tracking/'.$detail->transaksi_detail[0]->kode_invoice) }}"
                                class="btn btn-sm btn-outline-success">Tracking</a>
                            @elseif($detail->proses_pembayaran == 'terima' && $detail->transaksi_detail[0]->status_order ==
                            'Telah Sampai')
                            <a href="{{ URL::to('pesanan/tracking/'.$detail->transaksi_detail[0]->kode_invoice) }}"
                                class="btn btn-sm btn-outline-success">Tracking</a>
                            {{-- <a href="#" class="btn btn-sm btn-outline-success" data-target="#modalBatalTransaksi"
                                data-toggle="modal">Beri Ulasan</a> --}}
                            @endif
                        @endif
                        <a href="{{ URL::to('pesanan/export_invoice?id='.$detail->id_transaksi.'&inv='.$detail->transaksi_detail[0]->kode_invoice) }}"
                            class="btn btn-sm btn-outline-success">Cetak Invoice</a>
                    </td>
                </tr>
                {{--                @if($detail->proses_pembayaran == 'belum')--}}
                {{--                    <tr>--}}
                {{--                        <td>Aksi</td>--}}
                {{--                        <td>--}}
                {{--                            <a href="{{ URL::to('konfirmasi/data/'.$detail->kode_transaksi) }}"
                class="btn btn-outline-danger">Bayar Sekarang</a>--}}
                {{--                            <a href="#" class="btn btn-outline-danger" data-target="#modalBatalTransaksi" data-toggle="modal">Batalkan Pesanan</a>--}}
                {{--                        </td>--}}
                {{--                    </tr>--}}
                {{--                @else--}}
                {{--                    <tr>--}}
                {{--                        <td>Aksi</td>--}}
                {{--                        <td>--}}
                {{--                            <a href="#" class="btn btn-outline-success" data-target="#modalPesananDiterima" data-toggle="modal">Pesanan Diterima</a>--}}
                {{--                        </td>--}}
                {{--                    </tr>--}}
                {{--                @endif--}}
            </table>
        </div>
    </article> <!-- order-group.// -->
</main>


<div class="modal fade" id="modalPesananDiterima" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Anda Yakin Pesanan Anda Sudah Sampai ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Pastikan pesanan anda telah sampai dan sesuai. Jika anda mengkonfirmasi pesanan anda telah sampai, maka
                dana akan kita kirimkan ke penjual dan transaksi dianggap telah selesai.
                <br>
                <br>
                <form action="{{ URL::to('pesanan/diterima/'.$detail->transaksi_detail[0]->kode_invoice) }}"
                    method="POST">
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
            <form method="POST" action="{{ URL::to('pesanan/dibatalkan/'.$detail->id_transaksi) }}">
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