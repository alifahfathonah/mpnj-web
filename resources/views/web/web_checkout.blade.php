@extends('web.web_master')

@section('web_konten')
<!--================================
        START BREADCRUMB AREA
    =================================-->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb">
                    <ul>
                        <li>
                            <a href="{{ URL::to('/') }}">Home</a>
                        </li>
                        <li class="active">
                            <a href="{{ URL::to('checkout') }}">Checkout</a>
                        </li>
                    </ul>
                </div>
                <h1 class="page-title">Checkout</h1>
            </div>
            <!-- end /.col-md-12 -->
        </div>
        <!-- end /.row -->
    </div>
    <!-- end /.container -->
</section>
<!--================================
            END BREADCRUMB AREA
        =================================-->

<!--================================
                START DASHBOARD AREA
        =================================-->
<section class="dashboard-area">
    <div class="dashboard_contents">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="information_module">
                        <div class="toggle_title">
                            <h4>Alamat Pembeli | <a href="#" class="btn btn--md btn--round" data-target="#pilihAlamat" data-toggle="modal">Ubah</a></h4>
                        </div>
                        <div class="information__set">
                            <div class="information_wrapper form--fields table-responsive">
                                @foreach($order as $key => $val)
                                @if($val[0]->pembeli->alamat_fix == null)
                                <div class="information_module order_summary">
                                    <div class="toggle_title">
                                        <h4>Anda belum mempunyai data alamat. Silahkan tambah data alamat <a href="{{ URL::to('profile/alamat') }}" target="_blank">disini</a> </h4>
                                    </div>
                                </div>
                                @else
                                <div class="information_module order_summary">
                                    <div class="toggle_title" id="dataPembeli" data-destination="{{ $val[0]->pembeli->alamat_fix->city_id }}">
                                        <h5>{{ $val[0]->pembeli->alamat_fix->nama }} | {{ $val[0]->pembeli->alamat_fix->nomor_telepon }}</h5>
                                        <h4>{{ $val[0]->pembeli->alamat_fix->alamat_lengkap }}, {{ $val[0]->pembeli->alamat_fix->nama_kota }}, {{ $val[0]->pembeli->alamat_fix->nama_provinsi }}, {{ $val[0]->pembeli->alamat_fix->kode_pos }}</h4>
                                    </div>
                                </div>
                                @if($val[0] != null)
                                @break;
                                @endif
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form class="setting_form" id="checkoutForm">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="information_module">
                            <div class="toggle_title">
                                <h4>Informasi Transaksi (Lanjutan) </h4>
                            </div>

                            <div class="information__set">
                                <div class="information_wrapper form--fields table-responsive">
                                    <table class="table withdraw__table">
                                        <thead>
                                            <tr>
                                                <th>Barang</th>
                                                <th>Harga</th>
                                                <th>Berat</th>
                                                <th>Qty</th>
                                                <th>Sub Berat</th>
                                                <th>Sub Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $o = 0;
                                            $n = 1;
                                            $x = 1;
                                            $total = 0; ?>
                                            @foreach ($order as $key => $val)
                                            <tr id="dataPelapak{{ $x }}" data-origin="{{ $val[0]->produk->pelapak->city_id }}" data-berat="{{ $berat[$o]->total_berat }}" data-jumlahbarang="{{ COUNT($val) }}" data-mulai="{{ $n }}" data-akhir="{{ COUNT($val) == 1 ? $n : $n + COUNT($val) - 1}}">
                                                <td colspan="7">
                                                    <h4><strong>{{ $key }}</strong></h4>
                                                </td>
                                            </tr>
                                            <?php $x++; ?>
                                            @foreach ($val as $k)
                                            <tr id="data_keranjang{{ $n }}" data-idproduk="{{ $k->produk_id }}" data-hargajual="{{ $k->harga_jual }}" data-jumlah="{{ $k->jumlah }}" data-subtotal="{{ $k->jumlah * $k->harga_jual }}" data-idkeranjang="{{  $k->id_keranjang }}" data-idpelapak="{{ $k->produk->pelapak->id_pelapak }}" data-total="{{ $total += ($k->harga_jual - ($k->produk->diskon / 100 * $k->harga_jual)) * $k->jumlah }}">
                                                <td>
                                                    <div class="product__description">
                                                        <img src="{{ asset('assets/foto_produk/'.$k->produk->foto_produk[0]->foto_produk) }}" alt="Purchase image" width="100">
                                                        <div class="short_desc">
                                                            <a href="#">
                                                                <h4>{{ $k->produk->nama_produk }}</h4>
                                                            </a>
                                                            {{-- <p>Nunc placerat mi id nisi inter dum mollis. Praesent phare...</p> --}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="bold" id="harga{{ $n }}">
                                                    @currency($k->produk->harga_jual)
                                                </td>
                                                <td class="bold">
                                                    {{ $k->produk->berat }} gram
                                                </td>
                                                <td>{{ $k->jumlah }}</td>
                                                <td class="bold">
                                                    {{ $k->produk->berat * $k->jumlah }} gram
                                                </td>
                                                <td id="subHarga{{ $n }}">@currency($k->harga_jual * $k->jumlah)
                                                </td>
                                            </tr>
                                            <?php $n++; ?>
                                            @endforeach
                                            <tr>
                                                <td colspan="6">

                                                    <div class="shortcode_module_title">
                                                        <div class="dashboard__title pull-left" id="kurirDipilih{{ $o+1 }}">
                                                            <h5>Kurir : </h5>
                                                        </div>
                                                        <div class="pull-right">
                                                            <a href="#" class="btn btn--md btn--round" data-target="#modalKurir{{ $o+1 }}" data-toggle="modal">Pilih</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $o++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end /.information__set -->
                    </div>
                    <!-- end /.information_module -->

                    <div class="col-lg-4">
                        <div class="information_module order_summary">
                            <div class="toggle_title">
                                <h4>Order Detail</h4>
                            </div>

                            <ul>
                                <li class="item">
                                    <a href="#" target="_blank">Total Belanja</a>
                                    <span>@currency($total)</span>
                                </li>
                                <li class="item">
                                    <a href="#" target="_blank">Total Ongkir</a>
                                    <span id="totalOngkir">-</span>
                                </li>
                                <li class="total_ammount">
                                    <p>Total</p>
                                    <span id="totalBayar">@currency($total)</span>
                                </li>
                                <li class="total_ammount">
                                    <button type="button" id="bayar" class="btn btn--round btn-primary btn--default" onclick="bayarSekarang()">Bayar Sekarang
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.information_module-->

                    </div>
                </div>
                <!-- end /.col-md-6 -->

                <!-- end /.col-md-6 -->
                <!-- end /.row -->
            </form>
            <!-- end /form -->
        </div>
        <!-- end /.container -->
    </div>
    <!-- end /.dashboard_menu_area -->

    <?php $m = 1; ?>
    @foreach ($order as $key => $val)
    <div class="modal fade rating_modal item_remove_modal" id="modalKurir{{ $m }}" tabindex="-1" role="dialog" aria-labelledby="myModal2">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Pilih Kurir Pengiriman
                        Untuk {{ $val[0]->produk->pelapak->nama_toko }}</h3>
                    {{-- <p>You will not be able to recover this file!</p> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- end /.modal-header -->

                <div class="modal-body">
                    <select name="pilih_kurir" id="pilih_kurir{{ $m }}" class="form-control" onchange="getKurir({{ $m }})">
                        <option>Pilih Kurir</option>
                        <option value="jne">JNE</option>
                        <option value="pos">POS</option>
                        <option value="tiki">TIKI</option>
                    </select>
                    <br>
                    <div id="kurir{{ $m }}" class="custom-radio">

                    </div>
                    <br>
                    <button type="button" id="fixKurir" onclick="fixKurir({{ $m }})" class="btn btn--round btn-danger btn--default" data-dismiss="modal">Simpan
                    </button>
                    <button class="btn btn--round modal_close" data-dismiss="modal">Batal</button>
                </div>
                <!-- end /.modal-body -->
            </div>
        </div>
    </div>
    <?php $m++; ?>
    @endforeach

</section>
<!--================================
                END DASHBOARD AREA
        =================================-->

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
                @foreach($order as $key => $val)
                @foreach($val as $val)
                @foreach($val->pembeli->daftar_alamat as $v)
                @if($val->pembeli->alamat_utama != $v->id_alamat)
                <div class="information_module order_summary">
                    <div class="toggle_title" data-destination="{{ $v->city_id }}">
                        <h5>{{ $v->nama }} | {{ $v->nomor_telepon }}</h5>
                        <h4>{{ $v->alamat_lengkap }}, {{ $v->nama_kota }}, {{ $v->nama_provinsi }}, {{ $v->kode_pos }}</h4>
                        <br>
                        <form action="{{ URL::to('profile/alamat/ubah/utama/'.$v->id_alamat) }}">
                            <button type="submit" class="btn btn--round modal_close">Pilih
                            </button>
                        </form>
                    </div>
                </div>
                @endif
                @endforeach
                @break;
                @endforeach
                @break;
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
                'tujuan': $(`#dataPembeli`).data('destination'),
                'berat': $(`#dataPelapak${n}`).data('berat'),
                'kurir': kurir
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
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
            error: function(error) {
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
                break;
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

        //ulasan
        //1. saya harus tau jumlah pelapak nya
        //2. saya harus tau jumlah barang yang dibeli dari setiap pelapak
        //3. for pertama berdasarkan jumlah pelapak
        //4. for kedua bedasarkan jumlah barang dari setiap pelapak

        for (let index = 1; index <= "{{ $m }}"; index++) {
            for (let j = $(`#dataPelapak${index}`).data('mulai'); j <= $(`#dataPelapak${index}`).data('akhir'); j++) {
                keranjangId.push($(`#data_keranjang${j}`).data('idkeranjang'));
                dataTrxDetail.push({
                    'produk_id': $(`#data_keranjang${j}`).data('idproduk'),
                    'pelapak_id': $(`#data_keranjang${j}`).data('idpelapak'),
                    'kurir': $(`#dataPelapak${index}`).data('kurir'),
                    'service': $(`#dataPelapak${index}`).data('service'),
                    'ongkir': $(`#dataPelapak${index}`).data('ongkir'),
                    'etd': $(`#dataPelapak${index}`).data('etd'),
                    'jumlah': $(`#data_keranjang${j}`).data('jumlah'),
                    'harga_jual': $(`#data_keranjang${j}`).data('hargajual'),
                    'sub_total': parseInt($(`#data_keranjang${j}`).data('hargajual') * $(`#data_keranjang${j}`).data('jumlah') + $(`#dataPelapak${index}`).data('ongkir'))
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
                'idKeranjang': keranjangId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                window.location.href = `/checkout/sukses/${response.kode_transaksi}`;
                // console.log(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function numberFormat(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
    }
</script>
@endpush