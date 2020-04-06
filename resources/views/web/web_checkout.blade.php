@extends('mpnj.layout.main')

@section('title','Market Place PP Nurul Jadid')


@section('content')
<section class="section-content padding-y">
    <div class="container">

        <div class="row">
            <aside class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Pilih Alamat Pengiriman | <a href="#" class="btn btn--md btn--round" data-target="#pilihAlamat" data-toggle="modal">Ubah</a></h3>
                        <hr>
                        <p class="text-center mb-3">
                            @if($pembeli->alamat_fix != null)
                            <div class="information_module order_summary">
                                <div class="toggle_title" id="dataPembeli" data-destination="{{ $pembeli->alamat_fix->kecamatan_id }}">
                                    <h5>{{ $pembeli->alamat_fix->nama }} | {{ $pembeli->alamat_fix->nomor_telepon }}</h5>
                                    <h4>{{ $pembeli->alamat_fix->alamat_lengkap }}, {{ $pembeli->alamat_fix->nama_kota }}, {{ $pembeli->alamat_fix->nama_provinsi }}, {{ $pembeli->alamat_fix->kode_pos }}</h4>
                                </div>
                            </div>
                            @else
                            <div class="information_module order_summary">
                                <div class="toggle_title">
                                    <h4>Anda belum mempunyai data alamat. Silahkan tambah data alamat <a href="{{ URL::to('profile/alamat') }}" target="_blank">disini</a> </h4>
                                </div>
                            </div>
                            @endif
                        </p>

                    </div> <!-- card-body.// -->
                </div> <!-- card .// -->
            </aside> <!-- col.// -->
        </div>
        <br>
        <div class="row">
            <main class="col-md-9">
                <div class="card table-responsive">

                    <table class="table table-borderless table-shopping-cart">
                        <thead class="text-dark">
                            <tr class="small text-uppercase">
                                <th scope="col">Produk</th>
                                <th scope="col">Berat</th>
                                <th scope="col">Harga</th>
                                <th scope="col" width="120">Jumlah</th>
                                <th scope="col" width="120">Sub Harga</th>
                                <th scope="col">Pilihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $o = 0;
                            $n = 1;
                            $x = 1;
                            $m = 1;
                            $total = 0; ?>
                            @foreach($data_keranjang as $val)
                            <tr id="dataPelapak{{ $x }}" data-origin="{{ $val['alamat']['city_id'] }}" data-berat="{{ $val['total_berat'] }}" data-jumlahbarang="{{ COUNT($val['item']) }}" data-mulai="{{ $n }}" data-akhir="{{ COUNT($val['item']) == 1 ? $n : $n + COUNT($val['item']) - 1}}">
                                <td colspan="7">
                                    <h4><strong>{{ $val['nama_toko'] }}</strong></h4>
                                </td>
                            </tr>
                            <?php $x++; ?>
                            @foreach ($val['item'] as $k)
                            <tr id="data_keranjang{{ $n }}" data-idproduk="{{ $k['id_produk'] }}" data-hargajual="{{ $k['harga_jual'] }}" data-stok="{{ $k['stok'] }}" data-diskon="{{ $k['diskon'] }}" data-terjual="{{ $k['terjual'] }}" data-jumlah="{{ $k['jumlah'] }}" data-subtotal="{{ $k['jumlah'] * $k['harga_jual'] }}" data-idkeranjang="{{  $k['id_keranjang'] }}" data-idpelapak="{{ $val['id_toko'] }}" data-total="{{ $total += ($k['harga_jual'] - ($k['diskon'] / 100 * $k['harga_jual'])) * $k['jumlah'] }}">
                                <td>
                                    <figure class="itemside">
                                        <div class="aside"><img src="{{ $k['foto'] }}" class="img-sm"></div>
                                        <figcaption class="info">
                                            <a href="{{ URL::to('produk/'.$k['slug']) }}" class="title text-dark">{{ $k['nama_produk'] }}</a>
                                            <p class="text-muted small">Kategori: {{ $k['kategori'] }}</p>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td>
                                    {{ $k['berat'] }} gram
                                </td>
                                <td class="bold" id="harga{{ $n }}">
                                    @if($k['diskon'] == 0)
                                    @currency($k['harga_jual'])
                                    @else
                                    <strike style="color: red">@currency($k['harga_jual'])</strike> | @currency($k['harga_jual'] - ($k['diskon'] / 100 * $k['harga_jual']))
                                    @endif
                                </td>
                                <td>
                                    {{ $k['jumlah'] }}
                                </td>
                                <td id="subHarga{{ $n }}">
                                    @if($k['diskon'] == 0)
                                    @currency($k['harga_jual'] * $k['jumlah'])
                                    @else
                                    @currency(($k['harga_jual'] - ($k['diskon'] / 100 * $k['harga_jual'])) * $k['jumlah'])
                                    @endif
                                </td>
                            </tr>
                            <?php $n++; ?>
                            @endforeach
                            <tr>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="card-deck text-center">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="my-0" id="kurirDipilih{{ $o+1 }}">Pilih Opsi Pengiriman</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="modal-body">
                                                    <select name="pilih_kurir" id="pilih_kurir{{ $m }}" class="form-control" onchange="getKurir({{ $m }})">
                                                        <option>Pilih Kurir</option>
                                                        <option value="jne">JNE</option>
                                                        <option value="pos">POS</option>
                                                        <option value="tiki">TIKI</option>
                                                    </select>
                                                    <br>
                                                    <div id="kurir{{ $m }}" class="custom-radio"></div>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-block" id="fixKurir" onclick="fixKurir({{ $m }})" data-dismiss="modal">Pilih</button>
                                            </div>
                                        </div>

                                </td>
                            </tr>

                            <tr>
                                <td>
                                </td>
                            </tr>
                            <?php $o++;
                            $m++; ?>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="card-body border-top">
                        <button class="btn btn-primary" id="batal" data-toggle="modal" data-target="#batalCheckout" onclick="batalCheckoutConfirm()"><i class="fa fa-chevron-left"></i> Batal</button>
                        <button class="btn btn-primary float-md-right" id="bayar" onclick="bayarSekarang()">Bayar Sekarang <i class="fa fa-chevron-right"></i></button>
                    </div>
                </div> <!-- card.// -->

                <div class="alert alert-success mt-3">
                    <p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks</p>
                </div>

            </main> <!-- col.// -->
            <aside class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <dl class="dlist-align">
                            <dt>Sub Total:</dt>
                            <dd class="text-right">@currency($total)</dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Ongkir:</dt>
                            <dd class="text-right" id="totalOngkir">Rp. -</dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Total:</dt>
                            <dd class="text-right  h5" id="totalBayar">@currency($total)</dd>
                        </dl>
                        <hr>
                        <p class="text-center mb-3">
                            <img src="{{ asset('assets/mpnj/images/misc/payments.png') }}" height="26">
                        </p>

                    </div> <!-- card-body.// -->
                </div> <!-- card .// -->
            </aside> <!-- col.// -->
        </div>

    </div> <!-- container .//  -->
</section>

<div class="modal fade rating_modal item_remove_modal" id="batalCheckout" tabindex="-1" role="dialog" aria-labelledby="myModal2">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Anda Yakin Ingin Membatalkan Transaksi Ini</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- end /.modal-header -->

            <div class="modal-body">
                <form method="POST" id="formBatalCheckout">
                    @csrf
                    <button type="submit" class="btn btn--round btn-danger btn--default" onclick="submitBatalCheckout()">Ya, Lanjutkan</button>
                    <button class="btn btn--round modal_close" data-dismiss="modal">Batal</button>
                </form>
            </div>
            <!-- end /.modal-body -->
        </div>
    </div>
</div>


<div class="modal fade rating_modal item_remove_modal" id="pilihAlamat" tabindex="-1" role="dialog" aria-labelledby="myModal2">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Pilih Alamat Pengiriman</h3>
                {{-- <p>You will not be able to recover this file!</p> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- end /.modal-header -->

            <div class="modal-body">
                @foreach($pembeli->daftar_alamat as $v)
                <div class="information_module order_summary">
                    <div class="toggle_title" data-destination="{{ $v->kecamatan_id }}">
                        <h5>{{ $v->nama }} | {{ $v->nomor_telepon }}</h5>
                        <h4>{{ $v->alamat_lengkap }}, {{ $v->nama_kota }}, {{ $v->nama_provinsi }}, {{ $v->kode_pos }}</h4>
                        <br>
                        <form action="{{ URL::to('profile/alamat/ubah/utama/'.$v->id_alamat) }}">
                            <button type="submit" class="btn btn--round modal_close">Pilih
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- end /.modal-body -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function getKurir(n) {
            let kurir = $("#pilih_kurir" + n).val();
            $.ajax({
                url: '/api/ongkir',
                type: 'POST',
                data: {
                    'asal': $(`#dataPelapak${n}`).data('origin'),
                    'origin_type': 'city',
                    'tujuan': $(`#dataPembeli`).data('destination'),
                    'destinationType': 'subdistrict ',
                    'berat': $(`#dataPelapak${n}`).data('berat'),
                    'kurir': kurir
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $(`.ok${n}`).remove();
                    response.ongkir.rajaongkir.results[0].costs.map(e => {
                        $("#kurir" + n).append(`
                            <div class="ok${n}">
                                <input type="radio" id="${n + e.service}" class="" name="ongkir${n}" data-service="${e.service}" data-ongkir="${e.cost[0].value}" data-etd="${e.cost[0].etd}">
                                <label for="${n + e.service}">
                                <span class="circle"></span>${e.service} - Rp. ${numberFormat(e.cost[0].value)} - ${e.cost[0].etd}  hari</label>
                                <br>
                            </div>
                        `);
                    });
                },
                error: function (error) {
                    console.log(error);
                }
            })
        }

        function fixKurir(i) {
            let kurir = $("#pilih_kurir" + i).val();
            let service = $(`input[name='ongkir${i}']:checked`).data('service');
            let ongkir = $(`input[name='ongkir${i}']:checked`).data('ongkir');
            let etd = $(`input[name='ongkir${i}']:checked`).data('etd');

            $(`#dataPelapak${i}`).data('kurir', kurir);
            $(`#dataPelapak${i}`).data('service', service);
            $(`#dataPelapak${i}`).data('ongkir', ongkir);
            $(`#dataPelapak${i}`).data('etd', etd);

            console.log(i);

            $(`#kurirDipilih${i}`).html(`<h6>Kurir : ${kurir} - ${service} - ${numberFormat(ongkir)} - ${etd}</h6>`);
            hitungOngkir();
        }

        function hitungOngkir() {
            let ko = 0;
            for (let index = 1; index <= "{{ $m }}"; index++) {
                if ($(`#dataPelapak${index}`).data('ongkir') == undefined) {
                    ko += 0;
                } else {
                    ko += $(`#dataPelapak${index}`).data('ongkir');
                }
            }
            $('#totalOngkir').html("Rp. " + numberFormat(ko));
            $("#totalBayar").html('Rp. ' + numberFormat(parseInt("{{ $total }}") + ko));
            $("#totalBayar").data('totalbayar', parseInt("{{ $total }}") + ko);
        }

        function bayarSekarang() {
            let dataTrxDetail = [];
            let keranjangId = [];
            let proses = [];
            let produkId = [];

            //ulasan
            //1. saya harus tau jumlah pelapak nya
            //2. saya harus tau jumlah barang yang dibeli dari setiap pelapak
            //3. for pertama berdasarkan jumlah pelapak
            //4. for kedua bedasarkan jumlah barang dari setiap pelapak

            for (let index = 1; index <= "{{ $m }}"; index++) {
                for (let j = $(`#dataPelapak${index}`).data('mulai'); j <= $(`#dataPelapak${index}`).data('akhir'); j++) {
                    keranjangId.push($(`#data_keranjang${j}`).data('idkeranjang'));
                    produkId.push($(`#data_keranjang${j}`).data('idproduk'));
                    proses.push({
                        'stok': $(`#data_keranjang${j}`).data('stok') - $(`#data_keranjang${j}`).data('jumlah'),
                        'terjual' : $(`#data_keranjang${j}`).data('terjual') + $(`#data_keranjang${j}`).data('jumlah')
                    });

                    dataTrxDetail.push({
                        'produk_id' : $(`#data_keranjang${j}`).data('idproduk'),
                        'pelapak_id' : $(`#data_keranjang${j}`).data('idpelapak'),
                        'diskon' : $(`#data_keranjang${j}`).data('diskon'),
                        'kurir': $(`#dataPelapak${index}`).data('kurir'),
                        'service': $(`#dataPelapak${index}`).data('service'),
                        'ongkir': $(`#dataPelapak${index}`).data('ongkir'),
                        'etd': $(`#dataPelapak${index}`).data('etd'),
                        'jumlah': $(`#data_keranjang${j}`).data('jumlah'),
                        'harga_jual': $(`#data_keranjang${j}`).data('hargajual'),
                        'sub_total': $(`#data_keranjang${j}`).data('diskon') == 0 ? parseInt($(`#data_keranjang${j}`).data('hargajual') * $(`#data_keranjang${j}`).data('jumlah') + $(`#dataPelapak${index}`).data('ongkir')) : parseInt($(`#data_keranjang${j}`).data('hargajual') * $(`#data_keranjang${j}`).data('jumlah') - $(`#data_keranjang${j}`).data('diskon') / 100 * $(`#data_keranjang${j}`).data('hargajual'))
                    });
                }
            }

            $.ajax({
                async: true,
                url: "{{ URL::to('checkout/simpanTransaksi') }}",
                type: 'POST',
                data: {
                    'trxDetail': dataTrxDetail,
                    'totalBayar': $("#totalBayar").data('totalbayar'),
                    'idKeranjang': keranjangId,
                    'idp' : produkId,
                    'prosesData' : proses
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    window.location.href = `/checkout/sukses/${response.kode_transaksi}`;
                    // console.log(response);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        function numberFormat(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        }

        function batalCheckoutConfirm() {
            $("#formBatalCheckout").attr('action', '{{ URL::to('checkout/batal')}}');
        }

        function submitBatalCheckout() {
            $("#formBatalCheckout").submit();
        }
    </script>
@endpush