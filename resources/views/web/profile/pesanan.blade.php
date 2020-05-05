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
                            <th>Informasi Tambahan</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody id="tab-body">
                        @if(COUNT($order) > 0)
                            @foreach($order as $v)
                                <tr id="dataCart" style="background-color: #ccffcc;">
                                    <td colspan="4"><strong>{{ $v['kode_transaksi'] }}</strong></td>
                                    <td><strong>{{ $v['waktu_transaksi'] }}</strong></td>
                                </tr>
                                @foreach($v['item'] as $val)
                                    <tr>
                                        <td width="95">
                                            <img src="{{ env('FILES_ASSETS').$val->produk->foto_produk[0]->foto_produk }}"
                                                 class="img-xs border">
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('produk/'.$val->produk->slug) }}">
                                                <p class="title mb-0">{{ $val->produk->nama_produk }}</p>
                                            </a>
                                            <var class="price text-muted">
                                                @if($val['diskon'] == 0)
                                                    <span style="color: black">@currency($val->harga_jual)</span>
                                                @else
                                                    <strike style="color: red">@currency($val->harga_jual)</strike>
                                                    <span style="color: black">| @currency($val->harga_jual - ($val->diskon / 100 *
                                                $val->harga_jual))</span>
                                                @endif
                                            </var>
                                        </td>
                                        <td>
                                            Jumlah : {{ $val->jumlah }} <br>
                                            Kurir : {{ $val->kurir }} <br>
                                            Service : {{ $val->service }} <br>
                                            Ongkir : @currency($val->ongkir)
                                        </td>
                                        <td>
                                            @currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual)) *
                                            $val->jumlah) + $val->ongkir)
                                        </td>
                                        <td width="250">
                                            @if($val->transaksi->proses_pembayaran == 'sudah' ||
                                            $val->transaksi->proses_pembayaran == 'terima')
                                                <ul style="list-style-type:none;">
                                                    <li>
                                                        <i class="fa fa-check" style="color: #00e600;"></i>
                                                        Sudah Dibayar
                                                    </li>
                                                </ul>

                                            @elseif($val->transaksi->proses_pembayaran == 'belum')
                                                <ul style="list-style-type:none;">
                                                    <li>
                                                        <i class="fa fa-times" style="color: red;"></i>
                                                        {{ $val->transaksi->proses_pembayaran}} bayar
                                                    </li>
                                                </ul>
                                            @endif
                                            <br>
                                            <ul style="list-style-type:none;">
                                                <li>
                                                    <i class="fa fa-box" style="color: #3377ff;"></i>
                                                    {{ $val->status_order}}
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        <h6> Total : @currency($v['total_bayar'])</h6>
                                    </td>
                                    <td>
                                        <a href="{{ URL::to('pesanan/detail/'.$v['kode_transaksi']) }}"
                                           class="btn btn-success">
                                            Lihat Pesanan </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5">{{ $order->links() }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="5" style="text-align: center">Tidak ada data</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>