<div class="row my-1">
    <div class="col-md-12">
        <h3>Pesanan Saya</h3>
        @if ( session()->has('message') )
            <div class="alert alert-success alert-dismissable">{{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('trxNull'))
            <div class="alert alert-danger alert-dismissable">{{ session()->get('trxNull') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <nav style="width: 100%">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a href="{{ URL::to('pesanan') }}"
                   class="nav-item nav-link @if(app('request')->input('tab') == 'semua' || app('request')->input('tab') == '') active @endif"
                   id="semua" role="tab" aria-controls="nav-home"
                   aria-selected="true">Semua</a>
                <a href="{{ URL::to('pesanan?tab=pending') }}"
                   class="nav-item nav-link @if(app('request')->input('tab') == 'pending') active @endif"
                   id="pending" href="#pending" role="tab" aria-controls="nav-home"
                   aria-selected="true">Menunggu Pembayaran/Konfirmasi</a>
                <a href="{{ URL::to('pesanan?tab=verifikasi') }}"
                   class="nav-item nav-link @if(app('request')->input('tab') == 'verifikasi') active @endif"
                   id="verifikasi" role="tab" aria-controls="nav-profile"
                   aria-selected="false">Telah Dikonfirmasi</a>
                <a href="{{ URL::to('pesanan?tab=packing') }}"
                   class="nav-item nav-link @if(app('request')->input('tab') == 'packing') active @endif"
                   id="packing" role="tab" aria-controls="nav-contact"
                   aria-selected="false">Dikemas</a>
                <a href="{{ URL::to('pesanan?tab=dikirim') }}"
                   class="nav-item nav-link @if(app('request')->input('tab') == 'dikirim') active @endif"
                   id="dikirim" role="tab" aria-controls="nav-contact"
                   aria-selected="false">Dikirim</a>
                <a href="{{ URL::to('pesanan?tab=sukses') }}"
                   class="nav-item nav-link @if(app('request')->input('tab') == 'sukses') active @endif"
                   id="sukses" role="tab" aria-controls="nav-contact"
                   aria-selected="false">Telah Sampai</a>
                <a href="{{ URL::to('pesanan?tab=batal') }}"
                   class="nav-item nav-link @if(app('request')->input('tab') == 'batal') active @endif"
                   id="batal" role="tab" aria-controls="nav-contact" aria-selected="false">Dibatalkan</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade {{ app('request')->input('tab') }} show active "
                 id="tab-result" role="tabpanel" aria-labelledby="nav-semua-tab">
                <div class="table-responsive">
                    <br>
                    @if(COUNT($order))
                        @foreach($order as $v)
                            @foreach($v->transaksi_detail->groupBy('user.nama_toko') as $key => $de)
                                <article class="card">
                                    <header class="card-header">
                                        <strong class="d-inline-block mr-3">{{ $key }}</strong>
                                        <div style="float: right; color: {{ $v->proses_pembayaran == 'belum' ? ('red') : ($v->proses_pembayaran == 'sudah' ? 'blue' : ($v->proses_pembayaran == 'terima' ? 'green' : 'black')) }};">
                                            <strong>
                                                @if($de[0]->status_order != 'Dibatalkan')
                                                    @if($v->proses_pembayaran == 'terima')
                                                        PEMBAYARAN DITERIMA
                                                    @else
                                                        {{ Str::upper($v->proses_pembayaran) }} BAYAR
                                                    @endif
                                                @else
                                                    DIBATALKAN
                                                @endif
                                            </strong>
                                        </div>
                                    </header>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
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
                                                                <span style="color: black">@currency($d->harga_jual) x {{ $d->jumlah }} </span>
                                                            @else
                                                                <span style="color: black">@currency($d->harga_jual - ($d->diskon / 100 *
                                                            $d->harga_jual)) x {{ $d->jumlah }} </span>
                                                            @endif
                                                        </var>
                                                    </td>
                                                    <td>@currency($d->sub_total)</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            @if($v->proses_pembayaran != 'belum')
                                                <table class="table table-hover table-bordered">
                                                    <tr>
                                                        <td width="665">Total Bayar (tidak termasuk ongkir)</td>
                                                        <td>@currency($de->sum('sub_total'))</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            @if($v->proses_pembayaran == 'belum')
                                                                Bayar
                                                                sebelum {{ \Carbon\Carbon::parse($v->batas_transaksi)->format('d M, Y H:m:s') }}
                                                            @else
                                                                Rincian
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ URL::to('pesanan/detail?id='.$v->id_transaksi.'&inv='.$d->kode_invoice) }}"
                                                               class="btn btn-outline-success">Rincian</a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            @endif
                                        </table>
                                    </div> <!-- table-responsive .end// -->
                                </article>
                            @endforeach
                            @if($v->proses_pembayaran == 'belum')
                                <table class="table table-hover table-bordered">
                                    <tr>
                                        <td width="665">Total Bayar (termasuk ongkir)</td>
                                        <td>@currency($v->total_bayar)</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            @if($de[0]->status_order != 'Dibatalkan')
                                                @if($v->proses_pembayaran == 'belum')
                                                    Bayar
                                                    sebelum {{ \Carbon\Carbon::parse($v->batas_transaksi)->format('d M, Y H:m:s') }}
                                                @else
                                                    Rincian
                                                @endif
                                            @else
                                                Dibatalkan
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('pesanan/detail?id='.$v->id_transaksi) }}"
                                               class="btn btn-outline-success">Rincian</a>
                                        </td>
                                    </tr>
                                </table>
                            @endif
                        @endforeach
                    @else
                        <table class="table table-hover">
                            <tr>
                                <td>Tidak ada data</td>
                            </tr>
                        </table>
                    @endif
                    {{--                    {{ $order->links() }}--}}
                </div>
            </div>
        </div>
    </div>
</div>