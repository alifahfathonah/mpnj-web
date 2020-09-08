@extends('mpnj.layout.main')

@section('title','Market Place PP Nurul Jadid')


@section('content')
<section class="section-content padding-y">
    <div class="container">
        <div class="row">
            <main class="col-md-9">
                <div class="card table-responsive">
                    <table class="table table-borderless table-shopping-cart">
                        <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th>#</th>
                                <th scope="col" class="text-dark">Produk</th>
                                <th scope="col" class="text-dark">Harga</th>
                                <th scope="col" class="text-dark" width="120">Jumlah</th>
                                <th scope="col" class="text-dark" width="120">Sub Harga</th>
                                <th scope="col" class="text-right" width="200"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1;
                            $total = 0; ?>
                            @if($data_keranjang->count() > 0)
                            @foreach($data_keranjang as $val)
                            <tr id="dataCart">
                                <td colspan="5"><strong>{{ $val['nama_toko'] }}</strong></td>
                            </tr>
                            @foreach ($val['item'] as $k)
                            <tr id="data_keranjang{{ $k['id_keranjang']  }}" class="sum"
                                data-total="{{ $total += ($k['harga_jual'] - ($k['diskon'] / 100 * $k['harga_jual'])) * $k['jumlah'] }}"
                                data-subtotal="{{ ($k['harga_jual'] - ($k['diskon'] / 100 * $k['harga_jual'])) * $k['jumlah'] }}"
                                data-hargajual="{{ $k['harga_jual']  }}" data-diskon="{{ $k['diskon'] }}"
                                data-stok="{{ $k['stok'] }}" data-jumlah="{{ $k['jumlah'] }}">
                                <td>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="check"
                                            id="check{{ $k['id_keranjang'] }}" value="{{ $k['id_keranjang'] }}"
                                            checked="true">
                                        <div class="custom-control-label"></div>
                                    </label>
                                </td>
                                <td>
                                    <figure class="itemside">
                                        <div class="aside"><img src="{{ env('FILES_ASSETS').$k['foto'] }}"
                                                class="img-sm">
                                        </div>
                                        <figcaption class="info">
                                            <a href="{{ URL::to('produk/'.$k['slug']) }}"
                                                class="title text-dark">{{ $k['nama_produk'] }}</a>
                                            <p class="small" style="color: black">Kategori:
                                                {{ $k['kategori'] }}</p>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td class="bold" id="harga{{ $n }}">
                                    @if($k['diskon'] == 0)
                                    @currency($k['harga_jual'])
                                    @else
                                    <strike style="color: red">@currency($k['harga_jual'])</strike> |
                                    @currency($k['harga_jual'] - ($k['diskon'] / 100 *
                                    $k['harga_jual']))
                                    @endif
                                </td>
                                <td>
                                    <input type="number" name="qty" id="qty{{ $n }}"
                                        class="form-control form-control-sm"
                                        value="{{ $k['jumlah'] != 0 ? $k['jumlah'] : 1 }}">
                                    <small id="stokLebih{{ $n }}" style="color: red;"></small>
                                    @if(session('lebih'))
                                    <small id="stok" style="color: red;">{{ session('lebih') }}</small>
                                    @endif
                                </td>
                                <td id="subHarga{{ $n }}">
                                    @if($k['diskon'] == 0)
                                    @currency($k['harga_jual'] * $k['jumlah'])
                                    @else
                                    @currency(($k['harga_jual'] - ($k['diskon'] / 100 *
                                    $k['harga_jual'])) *
                                    $k['jumlah'])
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ URL::to('keranjang/hapus/'.$k['id_keranjang']) }}"
                                        class="btn btn-light"> Hapus</a>
                                </td>
                            </tr>
                            <?php $n++; ?>
                            @endforeach
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6" style="text-align: center">Tidak ada keranjang</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="card-body border-top">
                        {{--                        <form action="{{ URL::to('checkout') }}" method="post">--}}
                        {{--                            @csrf--}}
                        {{--                            <input type="hidden" name="id_keranjang[]" id="id_keranjang">--}}
                        {{--                            <button class="btn btn-primary float-md-right" type="submit">Lanjut Checkout <i--}}
                        {{--                                        class="fa fa-chevron-right"></i></button>--}}
                        {{--                        </form>--}}
                        <button class="btn btn-primary float-md-right" type="submit" id="bayar">Lanjut Checkout <i
                                class="fa fa-chevron-right"></i></button>
                        <a href="{{ URL::to('produk') }}" class="btn btn-light"> <i class="fa fa-chevron-left"></i>
                            Lanjut Belanja </a>
                    </div>
                </div> <!-- card.// -->
                <div class="alert alert-success mt-3">
                    <p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks
                    </p>
                </div>
            </main> <!-- col.// -->
            <aside class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <dl class="dlist-align">
                            <dt>Total:</dt>
                            <dd class="text-right  h5" id="total">@currency($total)</dd>
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
@endsection

<div class="modal fade" id="modalIdKosong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gagal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Anda harus memilih minimal 1 barang pada keranjang untuk melakukan transaksi.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    var totalPrice = 0;
        $(function () {
            var jml = 0;

            if ('{{ $data_keranjang->count() }}' == 0) {
                $("#checkout").prop('disabled', true);
            }

            var keranjang_id = [];

            $("input:checkbox[name=check]:checked").each(function () {
                keranjang_id.push($(this).val());
            });

            $("input:checkbox[name=check]").on('click', function () {
                // let keranjang_id = [];
                keranjang_id = [];
                let id = $(this).val();
                let total = 0;
                // $(`#check${id}`).attr('checked', false);
                $("input:checkbox[name=check]:checked").each(function () {
                    keranjang_id.push($(this).val());
                });

                keranjang_id.forEach(function (val) {
                    total += $(`#data_keranjang${val}`).data('subtotal');
                });

                $("#total").html("Rp. " + numberFormat(parseInt(total)));

            });

            setTimeout(function(){ $('#stok').addClass('d-none');}, 1000);
            $("input[name='qty']").on('input', function (e) {
                let n = $("input[name='qty']").index(this);
                let qty = $("#qty" + parseInt(n + 1)).val();
                let id_cart = $(`input:checkbox[name=check]:eq(${n})`).val();
                let diskon = $(`.sum:eq(${n})`).data('diskon');
                let stok = $(`#data_keranjang${id_cart}`).data('stok');

                if (qty > stok) {
                    $(this).closest('td').find('input[name="qty"]').val($(`#data_keranjang${id_cart}`).data('jml'));
                    $("#stokLebih" + parseInt(n + 1)).html('Max Stok ' + stok);
                    setTimeout(function () {
                        $("#stokLebih" + parseInt(n + 1)).html('');
                    }, 1000);
                } else if (qty < 1) {
                    // $(this).closest('td').find('input[name="qty"]').val(1);
                    $("#stokLebih" + parseInt(n + 1)).html('Min Pesan 1');
                    setTimeout(function () {
                        $("#stokLebih" + parseInt(n + 1)).html('');
                    }, 1000);
                }
                // let qty = $("#qty" + parseInt(n + 1)).val();
                console.log(stok);
                if (this.value != '') {
                    if (qty <= stok && qty >= 1) {
                        $("#stokLebih" + parseInt(n + 1)).html('');
                        $(`#data_keranjang${id_cart}`).data('jml', qty);
                        updateJumlah(id_cart, qty, diskon, n);
                    }
                }
            });

            $("#bayar").on('click', function () {
                $.ajax({
                    async: true,
                    type: 'POST',
                    url: '{{ URL::to('keranjang/go_checkout') }}',
                    data: {
                        'id_keranjang' : keranjang_id
                    },
                    beforeSend: function() {
                        $.LoadingOverlay("show");
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response, xhr) {
                        $.LoadingOverlay("hide");
                        window.location.href = '{{ URL::to('checkout') }}'
                    },
                    error: function (error) {
                        $.LoadingOverlay("hide");
                        $("#modalIdKosong").modal('show');
                    }
                })
            });

        });

        function updateJumlah(id_cart, qty, diskon, n) {
            $.ajax({
                async: true,
                url: '{{ URL::to('keranjang/updateJumlah') }}',
                type: 'POST',
                data: {
                    'id_keranjang': id_cart,
                    'qty': qty
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (diskon == 0) {
                        $("#subHarga" + parseInt(n + 1)).html("Rp. " + numberFormat(parseInt(response * qty)));
                        $(`.sum:eq(${n})`).data('subtotal', qty * parseInt(response));
                    } else {
                        $("#subHarga" + parseInt(n + 1)).html("Rp. " + numberFormat(parseInt((response - (diskon / 100 * response)) * qty)));
                        $(`.sum:eq(${n})`).data('subtotal', parseInt((response - (diskon / 100 * response)) * qty));
                    }
                    sumTotal();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        function numberFormat(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        }

        function sumTotal() {
            totalPrice = 0;
            $('.sum').each(function (i) {
                if ($('input:checkbox[name="check"]').eq(i).is(':checked') == true) {
                    totalPrice += $(this).data('subtotal');
                }
            });
            console.log(totalPrice);
            $("#total").html("Rp. " + numberFormat(totalPrice));
        }
</script>
@endpush