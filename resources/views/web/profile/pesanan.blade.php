<div class="row my-1">
    <div class="col-md-12">
        <h3>Pesanan Saya</h3>
        <nav style="width: 100%">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link @if(app('request')->input('tab') == 'semua') active @else active @endif" id="nav-semua-tab" data-toggle="tab" href="#semua" role="tab" aria-controls="nav-home" aria-selected="true">Semua</a>
                <a class="nav-item nav-link" id="nav-pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="nav-home" aria-selected="true">Menunggu Konfirmasi</a>
                <a class="nav-item nav-link" id="nav-verifikasi-tab" data-toggle="tab" href="#verifikasi" role="tab" aria-controls="nav-profile" aria-selected="false">Telah Dikonfirmasi</a>
                <a class="nav-item nav-link" id="nav-packing-tab" data-toggle="tab" href="#packing" role="tab" aria-controls="nav-contact" aria-selected="false">Dikemas</a>
                <a class="nav-item nav-link" id="nav-dikirim-tab" data-toggle="tab" href="#dikirim" role="tab" aria-controls="nav-contact" aria-selected="false">Dikirim</a>
                <a class="nav-item nav-link" id="nav-sukses-tab" data-toggle="tab" href="#sukses" role="tab" aria-controls="nav-contact" aria-selected="false">Telah Sampai</a>
                <a class="nav-item nav-link" id="nav-batal-tab" data-toggle="tab" href="#batal" role="tab" aria-controls="nav-contact" aria-selected="false">Dibatalkan</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show @if(app('request')->input('tab') == 'semua') active @else active @endif" id="semua" role="tabpanel" aria-labelledby="nav-semua-tab">
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
                            @foreach($order as $key => $v)

                            <tr id="dataCart" style="background-color: #ccffcc;">
                                    <td colspan="4"><strong>Kode Transaksi: {{ $key }}</strong></td>
                                    <td ><strong>{{ $v[0]->transaksi->waktu_transaksi }}</strong></td>
                                </tr>
                            @foreach($v as $val)
                            <tr>
                                <td width="65">
                                    <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}" class="img-xs border">
                                </td>
                                <td>
                                    <a href="{{ URL::to('produk/'.$val->produk->slug) }}">
                                        <p class="title mb-0">{{ $val->produk->nama_produk }}</p>
                                    </a>
                                    <var class="price text-muted">
                                        @if($val->diskon == 0)
                                        <span style="color: black">@currency($val->harga_jual)</span>
                                        @else
                                        <strike style="color: red">@currency($val->harga_jual)</strike> <span style="color: black">| @currency($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))</span>
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
                                    @currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual)) * $val->jumlah) + $val->ongkir)
                                </td>
                                <td width="250">
                                    <a href="{{ URL::to('pesanan/detail/'.$val->id_transaksi_detail) }}" class="btn btn-light"> Details </a>
                                </td>
                            </tr>
                            @endforeach
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
            <div class="tab-pane fade @if(app('request')->input('tab') == 'pending') active @endif" id="pending" role="tabpanel" aria-labelledby="nav-pending-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th></th>
                                <th>Informasi Tambahan</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($order->has('pending'))
                            @foreach($order as $key => $v)
                            @if($key == 'pending')
                            @foreach($order[$key] as $val)
                            <tr>
                                <td width="65">
                                    <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}" class="img-xs border">
                                </td>
                                <td>
                                    <p class="title mb-0">{{ $val->produk->nama_produk }}</p>
                                    <var class="price text-muted">
                                        @if($val->diskon == 0)
                                        <span style="color: black">@currency($val->harga_jual)</span>
                                        @else
                                        <strike style="color: red">@currency($val->harga_jual)</strike> <span style="color: black">| @currency($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))</span>
                                        @endif
                                    </var>
                                </td>
                                <td>
                                    Jumlah : {{ $val->jumlah }} <br>
                                    Kurir : {{ $val->kurir }} <br>
                                    Service : {{ $val->service }}
                                    Ongkir : @currency($val->ongkir)
                                </td>
                                <td>
                                    @currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual)) * $val->jumlah) + $val->ongkir)
                                </td>
                                <td width="250">
                                    <a href="{{ URL::to('pesanan/detail/'.$val->id_transaksi_detail) }}" class="btn btn-light"> Details </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" align="center">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade @if(app('request')->input('tab') == 'verifikasi') active @endif" id="verifikasi" role="tabpanel" aria-labelledby="nav-verifikasi-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th></th>
                                <th>Informasi Tambahan</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($order->has('verifikasi'))
                            @foreach($order as $key => $v)
                            @if($key == 'verifikasi')
                            @foreach($order[$key] as $val)
                            <tr>
                                <td width="65">
                                    <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}" class="img-xs border">
                                </td>
                                <td>
                                    <p class="title mb-0">{{ $val->produk->nama_produk }}</p>
                                    <var class="price text-muted">
                                        @if($val->diskon == 0)
                                        <span style="color: black">@currency($val->harga_jual)</span>
                                        @else
                                        <strike style="color: red">@currency($val->harga_jual)</strike> <span style="color: black">| @currency($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))</span>
                                        @endif
                                    </var>
                                </td>
                                <td>
                                    Jumlah : {{ $val->jumlah }} <br>
                                    Kurir : {{ $val->kurir }} <br>
                                    Service : {{ $val->service }}
                                    Ongkir : @currency($val->ongkir)
                                </td>
                                <td>
                                    @currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual)) * $val->jumlah) + $val->ongkir)
                                </td>
                                <td width="250">
                                    <a href="{{ URL::to('pesanan/detail/'.$val->id_transaksi_detail) }}" class="btn btn-light"> Details </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" align="center">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade @if(app('request')->input('tab') == 'packing') active @endif" id="packing" role="tabpanel" aria-labelledby="nav-packing-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th></th>
                                <th>Informasi Tambahan</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($order->has('packing'))
                            @foreach($order as $key => $v)
                            @if($key == 'packing')
                            @foreach($order[$key] as $val)
                            <tr>
                                <td width="65">
                                    <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}" class="img-xs border">
                                </td>
                                <td>
                                    <p class="title mb-0">{{ $val->produk->nama_produk }}</p>
                                    <var class="price text-muted">
                                        @if($val->diskon == 0)
                                        <span style="color: black">@currency($val->harga_jual)</span>
                                        @else
                                        <strike style="color: red">@currency($val->harga_jual)</strike> <span style="color: black">| @currency($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))</span>
                                        @endif
                                    </var>
                                </td>
                                <td>
                                    Jumlah : {{ $val->jumlah }} <br>
                                    Kurir : {{ $val->kurir }} <br>
                                    Service : {{ $val->service }}
                                    Ongkir : @currency($val->ongkir)
                                </td>
                                <td>
                                    @currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual)) * $val->jumlah) + $val->ongkir)
                                </td>
                                <td width="250">
                                    <a href="{{ URL::to('pesanan/detail/'.$val->id_transaksi_detail) }}" class="btn btn-light"> Details </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" align="center">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade @if(app('request')->input('tab') == 'dikirim') active @endif" id="dikirim" role="tabpanel" aria-labelledby="nav-dikirim-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th></th>
                                <th>Informasi Tambahan</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($order->has('dikirim'))
                            @foreach($order as $key => $v)
                            @if($key == 'dikirim')
                            @foreach($order[$key] as $val)
                            <tr>
                                <td width="65">
                                    <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}" class="img-xs border">
                                </td>
                                <td>
                                    <p class="title mb-0">{{ $val->produk->nama_produk }}</p>
                                    <var class="price text-muted">
                                        @if($val->diskon == 0)
                                        <span style="color: black">@currency($val->harga_jual)</span>
                                        @else
                                        <strike style="color: red">@currency($val->harga_jual)</strike> <span style="color: black">| @currency($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))</span>
                                        @endif
                                    </var>
                                </td>
                                <td>
                                    Jumlah : {{ $val->jumlah }} <br>
                                    Kurir : {{ $val->kurir }} <br>
                                    Service : {{ $val->service }}
                                    Ongkir : @currency($val->ongkir)
                                </td>
                                <td>
                                    @currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual)) * $val->jumlah) + $val->ongkir)
                                </td>
                                <td width="250">
                                    <a href="{{ URL::to('pesanan/detail/'.$val->id_transaksi_detail) }}" class="btn btn-light"> Details </a>
                                    <a href="{{ URL::to('pesanan/diterima/'.$val->id_transaksi_detail) }}" class="btn btn-success"> Diterima </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" align="center">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade @if(app('request')->input('tab') == 'sukses') active @endif" id="sukses" role="tabpanel" aria-labelledby="nav-sukses-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th></th>
                                <th>Informasi Tambahan</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($order->has('sukses'))
                            @foreach($order as $key => $v)
                            @if($key == 'sukses')
                            @foreach($order[$key] as $val)
                            <tr>
                                <td width="65">
                                    <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}" class="img-xs border">
                                </td>
                                <td>
                                    <p class="title mb-0">{{ $val->produk->nama_produk }}</p>
                                    <var class="price text-muted">
                                        @if($val->diskon == 0)
                                        <span style="color: black">@currency($val->harga_jual)</span>
                                        @else
                                        <strike style="color: red">@currency($val->harga_jual)</strike> <span style="color: black">| @currency($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))</span>
                                        @endif
                                    </var>
                                </td>
                                <td>
                                    Jumlah : {{ $val->jumlah }} <br>
                                    Kurir : {{ $val->kurir }} <br>
                                    Service : {{ $val->service }}
                                    Ongkir : @currency($val->ongkir)
                                </td>
                                <td>
                                    @currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual)) * $val->jumlah) + $val->ongkir)
                                </td>
                                <td width="250">
                                    <a href="{{ URL::to('pesanan/detail/'.$val->id_transaksi_detail) }}" class="btn btn-light"> Details </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" align="center">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade @if(app('request')->input('tab') == 'batal') active @endif" id="batal" role="tabpanel" aria-labelledby="nav-batal-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th></th>
                                <th>Informasi Tambahan</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($order->has('batal'))
                            @foreach($order as $key => $v)
                            @if($key == 'batal')
                            @foreach($order[$key] as $val)
                            <tr>
                                <td width="65">
                                    <img src="{{ asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk) }}" class="img-xs border">
                                </td>
                                <td>
                                    <p class="title mb-0">{{ $val->produk->nama_produk }}</p>
                                    <var class="price text-muted">
                                        @if($val->diskon == 0)
                                        <span style="color: black">@currency($val->harga_jual)</span>
                                        @else
                                        <strike style="color: red">@currency($val->harga_jual)</strike> <span style="color: black">| @currency($val->harga_jual - ($val->diskon / 100 * $val->harga_jual))</span>
                                        @endif
                                    </var>
                                </td>
                                <td>
                                    Jumlah : {{ $val->jumlah }} <br>
                                    Kurir : {{ $val->kurir }} <br>
                                    Service : {{ $val->service }}
                                    Ongkir : @currency($val->ongkir)
                                </td>
                                <td>
                                    @currency((($val->harga_jual - ($val->diskon / 100 * $val->harga_jual)) * $val->jumlah) + $val->ongkir)
                                </td>
                                <td width="250">
                                    <a href="{{ URL::to('pesanan/detail/'.$val->id_transaksi_detail) }}" class="btn btn-light"> Details </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" align="center">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>