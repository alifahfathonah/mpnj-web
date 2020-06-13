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
                   aria-selected="true">Menunggu Konfirmasi</a>
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
                    <table class="table table-hover" id="table-pesanan">
                        <thead>
                        <tr>
                            <th>Produk</th>
                            <th></th>
{{--                            <th>Informasi Tambahan</th>--}}
                            <th>Total</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody id="tab-body table-responsive">
                        <tbody>
                        @if(COUNT($order) > 0)
                            @foreach($order as $v)
                                <tr>
                                    <td width="65">
                                        <img src="{{ env('FILES_ASSETS').$v->produk->foto_produk[0]->foto_produk }}"
                                             class="img-xs border">
                                    </td>
                                    <td>
                                        <p class="title mb-0">{{ $v->produk->nama_produk }}</p>
                                        <var class="price text-muted">
                                            @if($v->diskon == 0)
                                                <span style="color: black">@currency($v->harga_jual) x {{ $v->jumlah }} @<a href="{{ URL::to('pelapak/'.$v->user->username) }}">{{ $v->user->nama_toko }}</a></span>
                                            @else
                                                <span style="color: black">@currency($v->harga_jual - ($v->diskon / 100 *
                                                            $v->harga_jual)) x {{ $v->jumlah }} @<a href="{{ URL::to('pelapak/'.$v->user->username) }}">{{ $v->user->nama_toko }}</a></span>
                                            @endif
                                        </var>
                                    </td>
                                    <td> @currency((($v->harga_jual - ($v->diskon / 100 * $v->harga_jual)) *
                                        $v->jumlah) + $v->ongkir)</td>
                                    <td width="250">
                                        <a href="{{ URL::to('pesanan/detail/'.$v->id_transaksi_detail) }}" class="btn btn-light"> Details </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5">{{ $order->links() }}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>