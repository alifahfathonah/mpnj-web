

<div class="row my-1">
    <div class="col-md-12">
        <h3 >Pesanan Saya</h3>
        <nav style="width: 100%">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link @if(app('request')->input('tab') == 'semua') active @else active @endif" id="nav-home-tab" data-toggle="tab" href="#semua" role="tab" aria-controls="nav-home" aria-selected="true">Semua</a>
                <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="nav-home" aria-selected="true">Pending</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#verifikasi" role="tab" aria-controls="nav-profile" aria-selected="false">Verifikasi</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#packing" role="tab" aria-controls="nav-contact" aria-selected="false">Packing</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#dikirim" role="tab" aria-controls="nav-contact" aria-selected="false">Dikirim</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#sukses" role="tab" aria-controls="nav-contact" aria-selected="false">Sukses</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#batal" role="tab" aria-controls="nav-contact" aria-selected="false">Dibatalkan</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show @if(app('request')->input('tab') == 'semua') active @else active @endif" id="semua" role="tabpanel" aria-labelledby="nav-home-tab">
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
                        @if(COUNT($order) > 0)
                            @foreach($order as $key => $v)
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
            <div class="tab-pane fade @if(app('request')->input('tab') == 'pending') active @endif" id="pending" role="tabpanel" aria-labelledby="nav-profile-tab">
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
                                <td colspan="5">Tidak ada data</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade @if(app('request')->input('tab') == 'verifikasi') active @endif" id="verifikasi" role="tabpanel" aria-labelledby="nav-contact-tab">
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
                                @if($key == 'verifikasi ')
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
            <div class="tab-pane fade @if(app('request')->input('tab') == 'packing') active @endif" id="packing" role="tabpanel" aria-labelledby="nav-home-tab">
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
            <div class="tab-pane fade @if(app('request')->input('tab') == 'dikirim') active @endif" id="dikirim" role="tabpanel" aria-labelledby="nav-profile-tab">
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
            <div class="tab-pane fade @if(app('request')->input('tab') == 'sukses') active @endif" id="sukses" role="tabpanel" aria-labelledby="nav-contact-tab">
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
            <div class="tab-pane fade @if(app('request')->input('tab') == 'batal') active @endif" id="batal" role="tabpanel" aria-labelledby="nav-contact-tab">
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