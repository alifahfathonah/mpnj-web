<div class="row my-1">
    <div class="col-md-12">
        <h3>Pesanan Saya</h3>
        @if ( session()->has('message') )
            <div class="alert alert-success alert-dismissable">{{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <nav style="width: 100%">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link @if(app('request')->input('tab') == 'semua') active @else active @endif"
                   id="nav-semua-tab" data-toggle="tab" href="#semua" role="tab" aria-controls="nav-home"
                   aria-selected="true">Semua</a>
                <a class="nav-item nav-link" id="nav-pending-tab" data-toggle="tab" href="#pending" role="tab"
                   aria-controls="nav-home" aria-selected="true">Menunggu Konfirmasi</a>
                <a class="nav-item nav-link" id="nav-verifikasi-tab" data-toggle="tab" href="#verifikasi" role="tab"
                   aria-controls="nav-profile" aria-selected="false">Telah Dikonfirmasi</a>
                <a class="nav-item nav-link" id="nav-packing-tab" data-toggle="tab" href="#packing" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Dikemas</a>
                <a class="nav-item nav-link" id="nav-dikirim-tab" data-toggle="tab" href="#dikirim" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Dikirim</a>
                <a class="nav-item nav-link" id="nav-sukses-tab" data-toggle="tab" href="#sukses" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Telah Sampai</a>
                <a class="nav-item nav-link" id="nav-batal-tab" data-toggle="tab" href="#batal" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Dibatalkan</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show @if(app('request')->input('tab') == 'semua') active @else active @endif"
                 id="semua" role="tabpanel" aria-labelledby="nav-semua-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Produk</th>
                            <th></th>
                            <th>Informasi Tambahan</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(COUNT($order) > 0)
                            @foreach($order as $v)
                                <tr id="dataCart" style="background-color: #ccffcc;">
                                    <td colspan="4"><strong>{{ $v['kode_transaksi'] }}</strong></td>
                                    <td><strong>{{ $v['waktu_transaksi'] }}</strong></td>
                                </tr>
                                @foreach($v['item'] as $val)
                                    <tr>
                                        <td width="95">
                                            <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}"
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
                                                    <span
                                                            style="color: black">| @currency($val->harga_jual - ($val->diskon / 100 *
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
                                            @if($val->transaksi->proses_pembayaran == 'sudah')
                                                <ul style="list-style-type:none;">
                                                    <li>
                                                        <i class="fa fa-check" style="color: #00e600;"></i>
                                                        {{ $val->transaksi->proses_pembayaran}} dibayar
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
                                        <h6> Jumlah yang harus dibayar : @currency($v['total_bayar'])</h6>
                                    </td>
                                    <td>
                                        @if($v['status_transaksi'] == 'batal')
                                            <button type="button" class="btn btn-danger">Batal</button>
                                        @else
                                            @if($v['proses_pembayaran'] == 'belum')
                                                <a href="{{ URL::to('konfirmasi/data/'.$v['kode_transaksi']) }}"
                                                   class="btn btn-danger"> Bayar Sekarang </a>
                                            @elseif($v['proses_pembayaran'] == 'sudah' || $v['proses_pembayaran'] == 'terima' || $v['proses_pembayaran'] == 'tolak')
                                                <a href="{{ URL::to('pesanan/detail/'.$v['kode_transaksi']) }}"
                                                   class="btn btn-success">
                                                    Lihat Pesanan </a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">Tidak ada data</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade @if(app('request')->input('tab') == 'pending') active @endif" id="pending"
                 role="tabpanel" aria-labelledby="nav-pending-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Produk</th>
                            <th></th>
                            <th>Informasi Tambahan</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order as $v)
                            @if($v['item']->contains('status_order', 'Menunggu Konfirmasi'))
                                <tr id="dataCart" style="background-color: #ccffcc;">
                                    <td colspan="4"><strong>{{ $v['kode_transaksi'] }}</strong></td>
                                    <td><strong>{{ $v['waktu_transaksi'] }}</strong></td>
                                </tr>
                                @foreach($v['item'] as $val)
                                    @if($val->status_order == 'Menunggu Konfirmasi')
                                        <tr>
                                            <td width="95">
                                                <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}"
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
                                                        <span
                                                                style="color: black">| @currency($val->harga_jual - ($val->diskon / 100 *
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
                                                @currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))
                                                *
                                                $val->jumlah) + $val->ongkir)
                                            </td>
                                            <td width="250">
                                                @if($val->transaksi->proses_pembayaran == 'sudah')
                                                    <ul style="list-style-type:none;">
                                                        <li>
                                                            <i class="fa fa-check" style="color: #00e600;"></i>
                                                            {{ $val->transaksi->proses_pembayaran}} dibayar
                                                        </li>
                                                    </ul>

                                                @elseif($val->transaksi->proses_pembayaran == 'belum')
                                                    <ul style="list-style-type:none;">
                                                        <li>
                                                            <i class="fa fa-times" style="color: red;"></i>
                                                            {{ $val->transaksi->proses_pembayaran}} bayar
                                                        </li>
                                                    </ul>

                                                @else
                                                    {{ $val->transaksi->proses_pembayaran}}
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
                                    @endif
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        <h6> Jumlah yang harus dibayar : @currency($v['total_bayar'])</h6>
                                    </td>
                                    <td>
                                        @if($v['proses_pembayaran'] == 'sudah')
                                            <a href="{{ URL::to('pesanan/detail/'.$v['kode_transaksi']) }}"
                                               class="btn btn-success"> Lihat Pesanan </a>
                                        @else
                                            <a href="{{ URL::to('checkout/sukses/'.$v['kode_transaksi']) }}"
                                               class="btn btn-danger"> Bayar Sekarang </a>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade @if(app('request')->input('tab') == 'verifikasi') active @endif" id="verifikasi"
                 role="tabpanel" aria-labelledby="nav-verifikasi-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Produk</th>
                            <th></th>
                            <th>Informasi Tambahan</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order as $v)
                            @if($v['item']->contains('status_order', 'Telah Dikonfirmasi'))
                                <tr id="dataCart" style="background-color: #ccffcc;">
                                    <td colspan="4"><strong>{{ $v['kode_transaksi'] }}</strong></td>
                                    <td><strong>{{ $v['waktu_transaksi'] }}</strong></td>
                                </tr>
                                @foreach($v['item'] as $val)
                                    @if($val->status_order == 'Telah Dikonfirmasi')
                                        <tr>
                                            <td width="95">
                                                <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}"
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
                                                        <span
                                                                style="color: black">| @currency($val->harga_jual - ($val->diskon / 100 *
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
                                                @currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))
                                                *
                                                $val->jumlah) + $val->ongkir)
                                            </td>
                                            <td width="250">
                                                @if($val->transaksi->proses_pembayaran == 'sudah')
                                                    <ul style="list-style-type:none;">
                                                        <li>
                                                            <i class="fa fa-check" style="color: #00e600;"></i>
                                                            {{ $val->transaksi->proses_pembayaran}} dibayar
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
                                    @endif
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        <h6> Jumlah yang harus dibayar : @currency($v['total_bayar'])</h6>
                                    </td>
                                    <td>
                                        <a href="{{ URL::to('pesanan/detail/'.$v['kode_transaksi']) }}"
                                           class="btn btn-success"> Lihat Pesanan </a>
                                    </td>
                                </tr>
                            @endif

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade @if(app('request')->input('tab') == 'packing') active @endif" id="packing"
                 role="tabpanel" aria-labelledby="nav-packing-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Produk</th>
                            <th></th>
                            <th>Informasi Tambahan</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order as $v)
                            @if($v['item']->contains('status_order', 'Dikemas'))
                                <tr id="dataCart" style="background-color: #ccffcc;">
                                    <td colspan="4"><strong>{{ $v['kode_transaksi'] }}</strong></td>
                                    <td><strong>{{ $v['waktu_transaksi'] }}</strong></td>
                                </tr>
                                @foreach($v['item'] as $val)
                                    @if($val->status_order == 'Dikemas')
                                        <tr>
                                            <td width="95">
                                                <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}"
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
                                                        <span
                                                                style="color: black">| @currency($val->harga_jual - ($val->diskon / 100 *
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
                                                @currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))
                                                *
                                                $val->jumlah) + $val->ongkir)
                                            </td>
                                            <td width="250">
                                                @if($val->transaksi->proses_pembayaran == 'sudah')
                                                    <ul style="list-style-type:none;">
                                                        <li>
                                                            <i class="fa fa-check" style="color: #00e600;"></i>
                                                            {{ $val->transaksi->proses_pembayaran}} dibayar
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
                                    @endif
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        <h6> Jumlah yang harus dibayar : @currency($v['total_bayar'])</h6>
                                    </td>
                                    <td>
                                        <a href="{{ URL::to('pesanan/detail/'.$v['kode_transaksi']) }}"
                                           class="btn btn-success"> Lihat Pesanan </a>
                                    </td>
                                </tr>
                            @endif

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade @if(app('request')->input('tab') == 'dikirim') active @endif" id="dikirim"
                 role="tabpanel" aria-labelledby="nav-dikirim-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Produk</th>
                            <th></th>
                            <th>Informasi Tambahan</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order as $v)
                            @if($v['item']->contains('status_order', 'Dikirim'))
                                <tr id="dataCart" style="background-color: #ccffcc;">
                                    <td colspan="4"><strong>{{ $v['kode_transaksi'] }}</strong></td>
                                    <td><strong>{{ $v['waktu_transaksi'] }}</strong></td>
                                </tr>
                                @foreach($v['item'] as $val)
                                    @if($val->status_order == 'Dikirim')
                                        <tr>
                                            <td width="95">
                                                <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}"
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
                                                        <span
                                                                style="color: black">| @currency($val->harga_jual - ($val->diskon / 100 *
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
                                                @currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))
                                                *
                                                $val->jumlah) + $val->ongkir)
                                            </td>
                                            <td width="250">
                                                @if($val->transaksi->proses_pembayaran == 'sudah')
                                                    <ul style="list-style-type:none;">
                                                        <li>
                                                            <i class="fa fa-check" style="color: #00e600;"></i>
                                                            {{ $val->transaksi->proses_pembayaran}} dibayar
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
                                    @endif
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        <h6> Jumlah yang harus dibayar : @currency($v['total_bayar'])</h6>
                                    </td>
                                    <td>
                                        <a href="{{ URL::to('pesanan/detail/'.$v['kode_transaksi']) }}"
                                           class="btn btn-success"> Lihat Pesanan </a>
                                    </td>
                                </tr>
                            @endif

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade @if(app('request')->input('tab') == 'sukses') active @endif" id="sukses"
                 role="tabpanel" aria-labelledby="nav-sukses-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Produk</th>
                            <th></th>
                            <th>Informasi Tambahan</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order as $v)
                            @if($v['item']->contains('status_order', 'Telah Sampai'))
                                <tr id="dataCart" style="background-color: #ccffcc;">
                                    <td colspan="4"><strong>{{ $v['kode_transaksi'] }}</strong></td>
                                    <td><strong>{{ $v['waktu_transaksi'] }}</strong></td>
                                </tr>
                                @foreach($v['item'] as $val)
                                    @if($val->status_order == 'Telah Sampai')
                                        <tr>
                                            <td width="95">
                                                <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}"
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
                                                        <span
                                                                style="color: black">| @currency($val->harga_jual - ($val->diskon / 100 *
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
                                                @currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))
                                                *
                                                $val->jumlah) + $val->ongkir)
                                            </td>
                                            <td width="250">
                                                @if($val->transaksi->proses_pembayaran == 'sudah')
                                                    <ul style="list-style-type:none;">
                                                        <li>
                                                            <i class="fa fa-check" style="color: #00e600;"></i>
                                                            {{ $val->transaksi->proses_pembayaran}} dibayar
                                                        </li>
                                                    </ul>

                                                @elseif($val->transaksi->proses_pembayaran == 'belum')
                                                    <ul style="list-style-type:none;">
                                                        <li>
                                                            <i class="fa fa-times" style="color: red;"></i>
                                                            {{ $val->transaksi->proses_pembayaran}} bayar
                                                        </li>
                                                    </ul>

                                                @else
                                                    {{ $val->transaksi->proses_pembayaran}}
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
                                    @endif
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        <h6> Jumlah yang harus dibayar : @currency($v['total_bayar'])</h6>
                                    </td>
                                    <td>
                                        <a href="{{ URL::to('pesanan/detail/'.$v['kode_transaksi']) }}"
                                           class="btn btn-success"> Lihat Pesanan </a>
                                    </td>
                                </tr>
                            @endif

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade @if(app('request')->input('tab') == 'batal') active @endif" id="batal"
                 role="tabpanel" aria-labelledby="nav-batal-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Produk</th>
                            <th></th>
                            <th>Informasi Tambahan</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order as $v)
                            @if($v['item']->contains('status_order', 'Dibatalkan'))
                                <tr id="dataCart" style="background-color: #ccffcc;">
                                    <td colspan="4"><strong>{{ $v['kode_transaksi'] }}</strong></td>
                                    <td><strong>{{ $v['waktu_transaksi'] }}</strong></td>
                                </tr>
                                @foreach($v['item'] as $val)
                                    @if($val->status_order == 'Dibatalkan')
                                        <tr>
                                            <td width="95">
                                                <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}"
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
                                                        <span
                                                                style="color: black">| @currency($val->harga_jual - ($val->diskon / 100 *
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
                                                @currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))
                                                *
                                                $val->jumlah) + $val->ongkir)
                                            </td>
                                            <td width="250">
                                                @if($val->transaksi->proses_pembayaran == 'sudah')
                                                    <ul style="list-style-type:none;">
                                                        <li>
                                                            <i class="fa fa-check" style="color: #00e600;"></i>
                                                            {{ $val->transaksi->proses_pembayaran}} dibayar
                                                        </li>
                                                    </ul>

                                                @elseif($val->transaksi->proses_pembayaran == 'belum')
                                                    <ul style="list-style-type:none;">
                                                        <li>
                                                            <i class="fa fa-times" style="color: red;"></i>
                                                            {{ $val->transaksi->proses_pembayaran}} bayar
                                                        </li>
                                                    </ul>

                                                @else
                                                    {{ $val->transaksi->proses_pembayaran}}
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
                                    @endif
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        <h6> Jumlah yang harus dibayar : @currency($v['total_bayar'])</h6>
                                    </td>
                                    <td>
                                        <a href="{{ URL::to('pesanan/detail/'.$v['kode_transaksi']) }}"
                                           class="btn btn-success"> Lihat Pesanan </a>
                                    </td>
                                </tr>
                            @endif

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>