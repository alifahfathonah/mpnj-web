<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice BelaNj</title>
    <link rel="stylesheet" href="{{ asset('css/styleInvoice.css')}}" media="all" />
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img style="width: 170px; height: 75px;" src="{{asset('assets/logo/belaNJ-hijau.png')}}">
        </div>
        <h1></h1>
        <div id="project">
            <div><span>Kode Transaksi/Detail Pesanan</span><br>
                {{ $d->transaksi->kode_transaksi }}/{{ $d->id_transaksi_detail }}</div>
            <div><span>Diterbitkan atas nama</span></div>
            <div><span>Penjual</span>:{{$d->user->nama_lengkap}}
            </div>
            <div><span>Toko</span>:{{$d->user->nama_toko}}</div>
            <div><span>Tanggal</span>:{{ $d->transaksi->waktu_transaksi }}</div>
        </div>
        <div id="company">
            <div>Tujuan Pengiriman :<br />{!! $d->transaksi->to !!}</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="desc">PRODUK</th>
                    <th>JUMLAH</th>
                    <th>BERAT</th>
                    <th>DISKON</th>
                    <th>HARGA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="desc">
                        <img style="width: 50px; height: 50px; margin: 5px;"
                            src="{{ asset('assets/foto_produk').'/'.$d->produk->foto_produk[0]->foto_produk }}"><br>
                        {{ $d->produk->nama_produk}}</td>
                    <td class="qty">{{ $d->jumlah}}</td>
                    <td class="qty">{{ $d->produk->berat}}/{{ $d->produk->satuan}}</td>
                    <td class="total">{{ $d->diskon }} %</td>
                    <td class="total">@if($d->diskon == 0)
                        Rp. {{ $d->harga_jual }}
                        @else
                        <strike style="color: red">Rp. {{ $d->harga_jual }}</strike> <br>
                        Rp. {{ $d->harga_jual - ($d->diskon / 100 * $d->harga_jual) }}
                        @endif</td>
                    {{-- <td class="service">@if($d->status_order == 'Menunggu Konfirmasi')
                        {{ 'Menuggu Konfirmasi Pembayaran' }}
                    @elseif($d->status_order == 'Telah Dikonfirmasi' || $d->status_order ==
                    'Dikirim' || $d->status_order == 'Dikemas')
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            style="background-color: green">
                            {{ $d->status_order }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item"
                                href="{{ URL::to('transaksi/status/'.$d->id_transaksi_detail.'/Dikemas/'.$d->transaksi_id) }}">Dikemas</a>
                            <a class="dropdown-item"
                                href="{{ URL::to('transaksi/status/'.$d->id_transaksi_detail.'/dikirim/'.$d->transaksi_id) }}">Dikirim</a>
                        </div>
                    </div>
                    @elseif($d->status_order == 'Telah Sampai')
                    {{ 'Barang Telah Sampai' }}
                    @else
                    {{ 'Dibatalkan' }}
                    @endif</td> --}}
                </tr>
                <tr>
                    <td colspan="4" class="grand total">SUBTOTAL HARGA BARANG:</td>
                    <td class="grand total">Rp. {{ $d->harga_jual - ($d->diskon / 100 * $d->harga_jual) }}</td>
                </tr>
            </tbody>
        </table>
        <table class="right">
            <tbody>
                <tr>
                    <td colspan="5">SHIPPING:</td>
                </tr>
                <tr>
                    <td colspan="3">{{ $d->kurir }} - {{ $d->service }}<br>
                        Etd: {{ $d->etd }}<br></td>
                    <td>
                        @if($d->resi != '')
                        Resi: {{ $d->resi }}
                        @endif</td>
                    <td class="total">Rp. {{$d->ongkir}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="grand total">SUBTOTAL PEMBAYARAN:</td>
                    <td class="grand total">Rp. {{$d->sub_total}}</td>
                </tr>
            </tbody>
        </table>
        <div id="notices">
            <div>CATATAN:</div>
            <div class="notice">Jika barang tidak sesuai anda bisa langsung menghubungi pelapak atau admin Belanj.id
            </div>
        </div>
    </main>
    <footer>
        Invoice ini dibuat di komputer dan valid tanpa tanda tangan dan meterai.
    </footer>
</body>

</html>