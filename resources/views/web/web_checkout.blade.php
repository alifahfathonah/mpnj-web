@extends('mpnj.layout.main')

@section('title','Market Place PP Nurul Jadid')


@section('content')
<section class="section-content padding-y">
    <div class="container">

        <div class="row">
            <aside class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p><strong>Pilih Alamat Pengiriman</strong> |
                            @if(is_null($pembeli->alamat_fix))
                                <button class="btn btn--md btn--round btn-primary" id="tambahAlamat">Tambah
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            @else
                                <a href="#" class="btn btn-outline-success" data-target="#pilihAlamat" data-toggle="modal">Ubah</a>
                            @endif
                        </p>
                        <hr>
                        <p class="text-center">
                            @if(is_null($pembeli->alamat_fix))
                            <div class="information_module order_summary">
                                <div class="toggle_title">
                                    <p>Anda belum mempunyai data alamat <a href="{{ URL::to('profile/alamat') }}" target="_blank">disini</a> </p>
                                </div>
                            </div>
                            @else
                            <div class="order_summary">
                                <div class="toggle_title" id="dataPembeli"
                                     data-destination="{{ $pembeli->alamat_fix->kecamatan_id }}" data-alamat="{{ $pembeli->alamat_fix->alamat_lengkap }} <br> {{ $pembeli->alamat_fix->nama_kecamatan }}, {{ $pembeli->alamat_fix->nama_kota }}, {{ $pembeli->alamat_fix->nama_provinsi }}, {{ $pembeli->alamat_fix->kode_pos }} <br> {{ $pembeli->alamat_fix->nomor_telepon }}">
                                    <p>{{ $pembeli->alamat_fix->getAlamatLengkapAttribute() }}</p>
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
                            <tr id="dataPelapak{{ $loop->iteration }}" data-origin="{{ $val['alamat']['city_id'] }}"
                                data-berat="{{ $val['total_berat'] }}" data-jumlahbarang="{{ COUNT($val['item']) }}"
                                data-mulai="{{ $n }}"
                                data-ongkir="{{ $val['ongkir'] }}"
                                data-akhir="{{ COUNT($val['item']) == 1 ? $n : $n + COUNT($val['item']) - 1}}">
                                <td colspan="7">
                                    <h4><strong>{{ $val['nama_toko'] }}</strong></h4>
                                </td>
                            </tr>
                            <?php $x++; ?>
                            @foreach ($val['item'] as $k)
                            <tr id="data_keranjang{{ $n }}" data-idproduk="{{ $k['id_produk'] }}"
                                data-hargajual="{{ $k['harga_jual'] }}" data-stok="{{ $k['stok'] }}"
                                data-diskon="{{ $k['diskon'] }}" data-terjual="{{ $k['terjual'] }}"
                                data-jumlah="{{ $k['jumlah'] }}" data-subtotal="{{ $k['jumlah'] * $k['harga_jual'] }}"
                                data-idkeranjang="{{  $k['id_keranjang'] }}" data-idpelapak="{{ $val['id_toko'] }}"
                                data-total="{{ $total += ($k['harga_jual'] - ($k['diskon'] / 100 * $k['harga_jual'])) * $k['jumlah'] }}">
                                <td>
                                    <figure class="itemside">
                                        <div class="aside"><img src="{{ env('FILES_ASSETS').$k['foto'] }}"
                                                class="img-sm"></div>
                                        <figcaption class="info">
                                            <a href="{{ URL::to('produk/'.$k['slug']) }}"
                                                class="title text-dark">{{ $k['nama_produk'] }}</a>
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
                                    <strike style="color: red">@currency($k['harga_jual'])</strike> |
                                    @currency($k['harga_jual'] - ($k['diskon'] / 100 * $k['harga_jual']))
                                    @endif
                                </td>
                                <td>
                                    {{ $k['jumlah'] }}
                                </td>
                                <td id="subHarga{{ $n }}">
                                    @if($k['diskon'] == 0)
                                        @currency($k['harga_jual'] * $k['jumlah'])
                                    @else
                                        @currency(($k['harga_jual'] - ($k['diskon'] / 100 * $k['harga_jual'])) *
                                        $k['jumlah'])
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
{{--                                                <h5 class="my-0" id="kurirDipilih{{ $o+1 }}">Pilih Opsi Pengiriman</h5>--}}
                                                <input type="button" class="btn btn-outline-success"
                                                       data-namatoko="{{ $val['nama_toko'] }}"
                                                       data-row="{{ $loop->iteration }}"
                                                       data-idkeranjang="{{ $k['id_keranjang'] }}"
                                                       name="kurir"
                                                       value="Pilih Kurir">
                                            </div>
                                            <div class="card-body">
                                                <table class="table">
                                                    <tr>
                                                        <th>Kurir</th>
                                                        <th>Service</th>
                                                        <th>Ongkir</th>
                                                        <th>Etd</th>
                                                    </tr>
                                                    <tr id="body{{ $loop->iteration }}">
                                                        <td>{{ is_null($val['kurir']) ? '-' : $val['kurir'] }}</td>
                                                        <td>{{ is_null($val['service']) ? '-' : $val['service'] }}</td>
                                                        <td>@if($val['ongkir'] == 0)
                                                                {{ '-' }}
                                                            @else
                                                                @currency($val['ongkir'])
                                                            @endif
                                                        </td>
                                                        <td>{{ is_null($val['etd']) ? '-' : $val['etd'] }}</td>
                                                    </tr>
                                                </table>
                                            </div>
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
                        <button class="btn btn-primary" id="batal" data-toggle="modal" data-target="#batalCheckout"
                            onclick="batalCheckoutConfirm()"><i class="fa fa-chevron-left"></i> Batal</button>
                        <button class="btn btn-primary float-md-right" id="bayar" onclick="bayarSekarang()">Bayar
                            Sekarang <i class="fa fa-chevron-right"></i></button>
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
                            <dd class="text-right" id="totalOngkir">@currency($ongkir)</dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Total:</dt>
                            <dd class="text-right  h5" id="totalBayar">@currency($total+$ongkir)</dd>
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

<div class="modal fade rating_modal item_remove_modal" id="modalPilihKurir" tabindex="-1" role="dialog"
     aria-labelledby="myModal2">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="title">Pilih Kurir</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- end /.modal-header -->

            <div class="modal-body">
                <select name="pilih_kurir" id="pilih_kurir" class="form-control">
                    <option>Pilih Kurir</option>
                    <option value="jne">JNE</option>
                    <option value="pos">POS</option>
                    <option value="tiki">TIKI</option>
                </select>
                <br>
                <div id="kurir" class="custom-radio"></div>
            </div>
            <!-- end /.modal-body -->
        </div>
    </div>
</div>

<div class="modal fade rating_modal item_remove_modal" id="batalCheckout" tabindex="-1" role="dialog"
    aria-labelledby="myModal2">
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
                    <button type="submit" class="btn btn--round btn-danger btn--default"
                        onclick="submitBatalCheckout()">Ya, Lanjutkan</button>
                    <button class="btn btn--round modal_close" data-dismiss="modal">Batal</button>
                </form>
            </div>
            <!-- end /.modal-body -->
        </div>
    </div>
</div>

<div class="modal fade rating_modal item_remove_modal" id="pilihAlamat" tabindex="-1" role="dialog"
    aria-labelledby="myModal2">
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
                @if(count($pembeli->daftar_alamat) > 0)
                    @foreach($pembeli->daftar_alamat as $v)
                        <div class="card border-success">
                            <div class="card-body text-success" data-destination="{{ $v->kecamatan_id }}">
                                <p class="card-text">
                                    {{ $v->nama }} <br> {{ $v->nomor_telepon }}, {{ $v->alamat_lengkap }}, {{ $v->nama_kota }}, {{ $v->nama_provinsi }}, {{ $v->kode_pos }}
                                </p>
                                <form action="{{ URL::to('profile/alamat/ubah/utama/'.$v->id_alamat) }}">
                                    <button type="submit" class="btn btn-outline-success">Pilih
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="information_module order_summary">
                        <div class="toggle_title">
                            Anda tidak memiliki alamat
                        </div>
                    </div>
                @endif
            </div>
            <!-- end /.modal-body -->
        </div>
    </div>
</div>

<div class="modal fade rating_modal item_remove_modal" id="modalAlamat" tabindex="-1" role="dialog"
     aria-labelledby="myModal2">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Data Alamat</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- end /.modal-header -->

            <div class="modal-body">
                <form method="post" action="{{ URL::to('profile/alamat/simpan') }}">
                    @csrf
                    <div class="form-row">
                        <div class="col form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div> <!-- form-group end.// -->
                        <div class="col form-group">
                            <label>Nomor Telepon</label>
                            <input type="tel" name="nomor_telepon" id="phone" class="form-control phone" required>
                            <small id="teleponError" style="color: red"></small>
                        </div> <!-- form-group end.// -->
                    </div>
                    <div class="form-row">
                        <div class="col form-group">
                            <label>Provinsi</label>
                            <select name="provinsi" id="provinsi" class="form-control" required>
                                <option id="provinsi_option">-- PILIH PROVINSI --</option>
                            </select>
                            <input type="hidden" name="nama_provinsi" id="nama_provinsi" class="form-control">
                        </div> <!-- form-group end.// -->
                        <div class="col form-group">
                            <label>Kota</label>
                            <select name="kota" id="kota" class="form-control" disabled required>
                                <option>-- PILIH KOTA --</option>
                            </select>
                            <input type="hidden" name="nama_kota" id="nama_kota" class="form-control">
                        </div> <!-- form-group end.// -->
                        <div class="col form-group">
                            <label>Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="form-control" disabled required>
                                <option>-- PILIH Kecamatan --</option>
                            </select>
                            <input type="hidden" name="nama_kecamatan" id="nama_kecamatan" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col form-group">
                            <label>Kode Pos</label>
                            <input type="text" name="kode_pos" id="kode_pos" class="form-control" required>
                            <small id="kodePosError" style="color: red"></small>
                        </div> <!-- form-group end.// -->
                        <div class="col form-group">
                            <label>Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" rows="1" class="form-control" required></textarea>
                        </div> <!-- form-group end.// -->
                    </div>
                    <button type="submit" id="simpan" class="btn btn--round btn-danger btn--default">Simpan</button>
                    <button class="btn btn--round modal_close" data-dismiss="modal">Batal</button>
                </form>
            </div>
            <!-- end /.modal-body -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
       $("#dataPembeli").data('destination') == undefined ? $("#bayar").prop('disabled', true) : $("#bayar").prop('disabled', false);
        {{--console.log('@json($id_keranjang[0])');--}}
        let input = document.querySelector('#phone');
        var n;
        var id_keranjang = [];

        var iti = intlTelInput(input, {
            initialCountry: "id",
            allowDropdown: true,
            utilsScript: "{{ url('assets/mpnj/js/utils.js') }}"
        });

        $("#phone").on('keyup', function () {
            if (iti.isValidNumber()) {
                $("#simpan").prop('disabled', false)
                $("#teleponError").html('')
            } else {
                $("#simpan").prop('disabled', true);
                $("#teleponError").html('Nomor telepon tidak valid')
            }
        });

        $("#kode_pos").on('keyup', function () {
            if ($(this).val().length > 5 || !$.isNumeric($(this).val())) {
                $("#kodePosError").html('Kode pos tidak valid');
                $("#simpan").prop('disabled', true);
            } else {
                $("#kodePosError").html('');
                $("#simpan").prop('disabled', false);
            }
        });

        $("#tambahAlamat").on('click', function () {
            $.ajax({
                async: true,
                url: '{{ URL::to('api/gateway/provinsi') }}',
                type: 'GET',
                success: function (response) {
                    $("#provinsi option").remove();
                    $("#modalAlamat").modal('show');
                    response.provinsi.rajaongkir.results.map(e => {
                        $("#provinsi").append(`
                                <option value='${e.province_id}'>${e.province}</option>
                            `);
                    });
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });

        $("#provinsi").on('change', function () {
            $("#nama_provinsi").val($("#provinsi option:selected").html());
            $("#kota").prop('disabled', true);
            $("#kota option").remove();
            $("#kota").append(`
                    <option>-- PILIH KOTA --</option>
               `);
            $("#kecamatan option").remove();
            $("#kecamatan").prop('disabled', true);
            $("#kecamatan").append(`
                    <option>-- PILIH Kecamatan --</option>
               `);
            $.ajax({
                async: true,
                url: '{{ URL::to('api/gateway/kota?provinsi=') }}' + `${$(this).val()}`,
                type: 'GET',
                success: function (response) {
                    $("#kota option").remove();
                    response.kota.rajaongkir.results.map(e => {
                        $("#kota").append(`
                                <option value='${e.city_id}'>${e.type} ${e.city_name}</option>
                            `);
                    });
                    $("#kota").prop('disabled', false);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });

        $("#kota").on('change', function () {
            $("#nama_kota").val($("#kota option:selected").html());
            $("#kecamatan").prop('disabled', true);
            $.ajax({
                async: true,
                url: '{{ URL::to('api/gateway/kecamatan?id=') }}' + $('#kota').val(),
                type: 'GET',
                success: function (response) {
                    $("#kecamatan option").remove();
                    response.kecamatan.rajaongkir.results.map(e => {
                        $("#kecamatan").append(`
                                <option value='${e.subdistrict_id}'>${e.subdistrict_name}</option>
                           `);
                    });
                    $("#kecamatan").prop('disabled', false);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });

        $("#kecamatan").on('change', function () {
            $("#nama_kecamatan").val($("#kecamatan option:selected").html());
        });

        $("input[name = 'kurir']").on('click', function () {
            id_keranjang = [];
            $('.ok').remove();
            $('#pilih_kurir option').eq(0).prop('selected', true);
            n = $(this).data('row');
            for (let i = $(`#dataPelapak${$(this).data('row')}`).data('mulai'); i <= $(`#dataPelapak${$(this).data('row')}`).data('akhir'); i++) {
                id_keranjang.push($(`#data_keranjang${i}`).data('idkeranjang'));
            }
            // console.log($(`#dataPelapak${$(this).data('row')}`).data('jumlahbarang'));
            $("#title").html("Pilih Kurir untuk "+$(this).data('namatoko'));
            $("#modalPilihKurir").modal('show');
        });

        $("#pilih_kurir").on('change', function () {
            console.log(id_keranjang)
            $.ajax({
                url: '{{URL::to('api/ongkir')}}',
                type: 'POST',
                data: {
                    'asal': $(`#dataPelapak${n}`).data('origin'),
                    'origin_type': 'city',
                    'tujuan': $(`#dataPembeli`).data('destination'),
                    'destinationType': 'subdistrict ',
                    'berat': $(`#dataPelapak${n}`).data('berat'),
                    'kurir': $(this).val()
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $.LoadingOverlay("show");
                },
                success: function(response) {
                    $.LoadingOverlay("hide");
                    $('.ok').remove();
                    response.ongkir.rajaongkir.results[0].costs.map(e => {
                        $("#kurir").append(`
                            <div class="ok">
                                <input type="radio" name="ongkir" data-service="${e.service}" data-ongkir="${e.cost[0].value}" data-etd="${e.cost[0].etd}">
                                <label for="${e.service}">
                                <span class="circle"></span>${e.service} - Rp. ${numberFormat(e.cost[0].value)} - ${e.cost[0].etd}  hari</label>
                                <br>
                            </div>
                        `);
                    });
                    $("input[name='ongkir']").on('click', function () {
                        let kurir = $("#pilih_kurir").val();
                        let service = $(this).data('service');
                        let ongkir = $(this).data('ongkir');
                        let etd = $(this).data('etd');
                        $.ajax({
                            url: '{{ URL::to('checkout/simpanKurir') }}',
                            type: 'POST',
                            data: {
                                'kurir' : kurir,
                                'service': service,
                                'ongkir': ongkir,
                                'etd': etd,
                                'id_keranjang': id_keranjang
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                $.LoadingOverlay("show");
                            },
                            success: function (response) {
                                $.LoadingOverlay("hide");
                                $("#modalPilihKurir").modal('hide');
                                $(`#dataPelapak${n}`).data('ongkir', ongkir);
                                $(`#body${n} td`).eq(0).html(kurir);
                                $(`#body${n} td`).eq(1).html(service);
                                $(`#body${n} td`).eq(2).html(numberFormat(ongkir));
                                $(`#body${n} td`).eq(3).html(etd);
                                hitungOngkir();
                            },
                            error: function (error) {
                                console.log(error)
                            }
                        })
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            })
        });

        $(window).bind('beforeunload', function () {
            return 'Anda yakin akan mereload halaman ? semua data yang tersimpan sebelumnya akan hilang.';
        });

    });

    function hitungOngkir() {
        let ko = 0;
        for (let index = 1; index <= parseInt("{{ $m }}"); index++) {
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
        $(window).unbind('beforeunload');
        $.ajax({
            async: true,
            url: "{{ URL::to('checkout/simpanTransaksi') }}",
            type: 'POST',
            data: {
                'totalBayar': $("#totalBayar").data('totalbayar'),
                'to': $("#dataPembeli").data('destination') == undefined ? '' : $("#dataPembeli").data('alamat'),
                'id_keranjang': '@json($id_keranjang)'
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            success: function(response) {
                $.LoadingOverlay("hide");
                window.location.href = `{{URL::to('checkout/sukses')}}/${response.kode_transaksi}`;
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

    function batalCheckoutConfirm() {
        $("#formBatalCheckout").attr('action', '{{ URL::to('checkout/batal')}}');
    }

    function submitBatalCheckout() {
        $("#formBatalCheckout").submit();
    }
</script>
@endpush