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
                                <a href="index.html">Home</a>
                            </li>
                            <li class="active">
                                <a href="#">Checkout</a>
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
											<?php $o = 0; $n = 1; ?>
                                            @foreach ($order as $key => $val)
                                                <tr id="dataPelapak{{ $val[0]->produk->pelapak->id_pelapak }}"
                                                    data-origin="{{ $val[0]->produk->pelapak->city_id }}"
                                                    data-berat="{{ $berat[$o]->total_berat }}"
                                                    data-jumlahbarang="{{ COUNT($val) }}">
                                                    <td colspan="7">
                                                        <h4><strong>{{ $key }}</strong></h4>
                                                    </td>
                                                </tr>
                                                @foreach ($val as $k)
                                                    <tr id="data_keranjang{{ $n }}" data-idproduk="{{ $k->produk_id }}"
                                                        data-hargajual="{{ $k->harga_jual }}"
                                                        data-jumlah="{{ $k->jumlah }}"
                                                        data-subtotal="{{ $k->jumlah * $k->harga_jual }}">
                                                        <td>
                                                            <div class="product__description">
                                                                <img src="{{ asset('assets/foto_produk/'.$k->produk->foto_produk[0]->foto_produk) }}"
                                                                     alt="Purchase image" width="100">
                                                                <div class="short_desc">
                                                                    <a href="single-product.html">
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
                                                            <div class="dashboard__title pull-left">
                                                                <h5>Pilih Kurir</h5>
                                                            </div>
                                                            <div class="pull-right">
                                                                <a href="#" class="btn btn--md btn--round"
                                                                   data-target="#modalKurir{{ $k->produk->pelapak->id_pelapak }}"
                                                                   data-toggle="modal">Pilih</a>
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
                            @for ($i = 0; $i < 1; $i++)
                                <div class="information_module order_summary">
                                    <div class="toggle_title" id="dataPembeli"
                                         data-destination="{{ $val[$i]->konsumen->city_id}}">
                                        <h4>Informasi Pembeli</h4>
                                    </div>

                                    <ul>
                                        <li class="item">
                                            <a href="single-product.html" target="_blank">Nama</a>
                                            <span>{{ $val[$i]->konsumen->nama_lengkap }}</span>
                                        </li>
                                        <li class="item">
                                            <a href="single-product.html" target="_blank">Alamat</a>
                                            <span>{{ $val[$i]->konsumen->alamat }}</span>
                                        </li>
                                    </ul>
                                </div>
                        @endfor
                        <!-- end /.information_module-->

                            <div class="information_module order_summary">
                                <div class="toggle_title">
                                    <h4>Order Detail</h4>
                                </div>

                                <ul>
                                    <li class="item">
                                        <a href="single-product.html" target="_blank">Total Belanja</a>
                                        <span>@currency($total)</span>
                                    </li>
                                    <li class="item">
                                        <a href="single-product.html" target="_blank">Total Ongkir</a>
                                        <span id="totalOngkir">-</span>
                                    </li>
                                    <li class="total_ammount">
                                        <p>Total</p>
                                        <span id="totalBayar">@currency($total)</span>
                                    </li>
                                    <li class="total_ammount">
                                        <button type="button" id="bayar" class="btn btn--round btn-primary btn--default"
                                                onclick="bayarSekarang()">Bayar Sekarang
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
            <div class="modal fade rating_modal item_remove_modal"
                 id="modalKurir{{ $val[0]->produk->pelapak->id_pelapak }}"
                 tabindex="-1" role="dialog" aria-labelledby="myModal2">
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
                            <select name="pilih_kurir" id="pilih_kurir{{ $m }}" class="form-control"
                                    onchange="getKurir({{ $m }})">
                                <option>Pilih Kurir</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS</option>
                                <option value="tiki">TIKI</option>
                            </select>
                            <br>
                            <div id="kurir{{ $m }}" class="custom-radio">

                            </div>
                            <br>
                            <button type="button" id="fixKurir" onclick="fixKurir({{ $m }})"
                                    class="btn btn--round btn-danger btn--default" data-dismiss="modal">Simpan
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

            for (let index = 1; index <= parseInt("{{ $m }}"); index++) {
                if ($(`#dataPelapak${index}`).data('ongkir') == undefined) {
                    break;
                } else {
                    if (index <= $(`#dataPelapak${index}`).data('jumlahbarang')) {
                        var j = index;
                        var k = index;
                        while (k <= $(`#dataPelapak${index}`).data('jumlahbarang')) {
                            dataTrxDetail.push({
                                'produk_id' : $(`#data_keranjang${j}`).data('idproduk'),
                                'kurir': $(`#dataPelapak${j}`).data('kurir'),
                                'service': $(`#dataPelapak${j}`).data('service'),
                                'ongkir': $(`#dataPelapak${j}`).data('ongkir'),
                                'etd': $(`#dataPelapak${j}`).data('etd'),
                                'jumlah': $(`#data_keranjang${k}`).data('jumlah'),
                                'harga_jual': $(`#data_keranjang${k}`).data('hargajual'),
                                'sub_total': parseInt($(`#data_keranjang${k}`).data('hargajual') * $(`#data_keranjang${k}`).data('jumlah') + $(`#dataPelapak${j}`).data('ongkir'))
                            });
                            k++;
                        }
                    } else {
                        dataTrxDetail.push({
                            'produk_id' : $(`#data_keranjang${index}`).data('idproduk'),
                            'kurir': $(`#dataPelapak${index}`).data('kurir'),
                            'service': $(`#dataPelapak${index}`).data('service'),
                            'ongkir': $(`#dataPelapak${index}`).data('ongkir'),
                            'etd': $(`#dataPelapak${index}`).data('etd'),
                            'jumlah': $(`#data_keranjang${index}`).data('jumlah'),
                            'harga_jual': $(`#data_keranjang${index}`).data('hargajual'),
                            'sub_total': parseInt($(`#data_keranjang${index}`).data('hargajual')) * parseInt($(`#data_keranjang${index}`).data('jumlah')) + parseInt($(`#dataPelapak${index}`).data('ongkir'))
                        });
                    }
                }
            }

            $.ajax({
                async: true,
                url: '/simpanTransaksi',
                type: 'POST',
                data: {
                    'trxDetail': dataTrxDetail,
                    'totalBayar': $("#totalBayar").data('totalbayar')
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    window.location.href = `/sukses/${response.kode_transaksi}`;
                    // console.log(response);
                },
                error: function (error) {
                    console.log(error);
                }
            });

            // console.log(dataTrxDetail);
        }

        function numberFormat(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        }
    </script>
@endpush
