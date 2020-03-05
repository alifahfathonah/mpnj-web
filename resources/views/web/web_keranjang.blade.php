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
                            <a href="{{ URL::to('keranjang') }}">Keranjang</a>
                        </li>
                    </ul>
                </div>
                <h1 class="page-title">Keranjang Belanja Anda</h1>
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
            START SIGNUP AREA
    =================================-->
<section class="section--padding2 bgcolor">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="modules__content">
                        <div class="withdraw_module withdraw_history">
                            <div class="withdraw_table_header">
                                <h3>Daftar Barang dalam Keranjang</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table withdraw__table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Barang</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Sub Harga</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $n = 1;
                                        $total = 0; ?>
                                        @foreach ($keranjang as $key => $val)
                                        <tr id="dataCart">
                                            <td colspan="7">
                                                <h4><strong>{{ $key }}</strong></h4>
                                            </td>
                                        </tr>
                                        @foreach ($val as $k)
                                        <tr id="data_keranjang{{ $k->id_keranjang  }}" data-total="{{ $total += ($k->harga_jual - ($k->produk->diskon / 100 * $k->harga_jual)) * $k->jumlah }}" class="sum" data-subtotal="{{ ($k->harga_jual - ($k->produk->diskon / 100 * $k->harga_jual)) * $k->jumlah  }}" data-hargajual="{{ $k->harga_jual  }}" data-diskon="{{ $k->produk->diskon }}">
                                            <td>
                                                <input type="checkbox" name="check" id="check{{ $k->id_keranjang }}" value="{{ $k->id_keranjang }}" checked="true">
                                            </td>
                                            <td>
                                                <div class="product__description">
                                                    <img src="{{ asset('assets/foto_produk/'.$k->produk->foto_produk[0]->foto_produk) }}" alt="Purchase image" width="100">
                                                    <div class="short_desc">
                                                        <a href="{{ URL::to('produk/'.$k->produk->id_produk) }}">
                                                            <h4>{{ $k->produk->nama_produk }}</h4>
                                                        </a>
                                                        {{-- <p>Nunc placerat mi id nisi inter dum mollis. Praesent phare...</p> --}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $k->produk->kategori->nama_kategori }}</td>
                                            <td class="bold" id="harga{{ $n }}">
                                                @if($k->produk->diskon == 0)
                                                @currency($k->produk->harga_jual)
                                                @else
                                                <strike style="color: red">@currency($k->produk->harga_jual)</strike> | @currency($k->produk->harga_jual - ($k->produk->diskon / 100 * $k->produk->harga_jual))
                                                @endif
                                            </td>
                                            <td style="width: 10%">
                                                <input type="number" name="qty" id="qty{{ $n }}" class="form-control form-control-sm" value="{{ $k->jumlah != 0 ? $k->jumlah : 1 }}">
                                            </td>
                                            <td id="subHarga{{ $n }}">
                                                @if($k->produk->diskon == 0)
                                                @currency($k->harga_jual * $k->jumlah)
                                                @else
                                                @currency(($k->harga_jual - ($k->produk->diskon / 100 * $k->harga_jual)) * $k->jumlah)
                                                @endif
                                            </td>
                                            <td class="pending">
                                                <a href="{{ URL::to('keranjang/hapus/'.$k->id_keranjang) }}">
                                                    <span>Hapus</span>
                                                </a>
                                            </td>
                                        </tr>

                                        <?php $n++; ?>
                                        @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-6 offset-md-6">
                                        <div class="cart_calculation">
                                            {{-- <div class="cart--subtotal">
                                                <p>
                                                    <span>Cart Subtotal</span>$120</p>
                                            </div> --}}
                                            <div class="cart--total">
                                                <p>
                                                    <span>total</span><span id="total">@currency($total)</span></p>
                                            </div>

                                            <a href="{{ URL::to('produk') }}" class="btn btn--round btn--md checkout_link">Lanjut Belanja</a>
                                            <button id="checkout" type="button" class="btn btn--round btn--md checkout_link">Lanjut
                                                Checkout</button>
                                        </div>
                                    </div>
                                    <!-- end .col-md-12 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end .col-md-6 -->
        </div>
        <!-- end .row -->
    </div>
    <!-- end .container -->
</section>
<!--================================
            END SIGNUP AREA
    =================================-->


@endsection

@push('scripts')
<script>
    var totalPrice = 0;

    $(function() {

        var jml = 0;

        //
        // $("#total").html(totalPrice);
        // console.log(totalPrice);

        $("input:checkbox[name=check]").on('click', function() {
            let keranjang_id = [];
            let id = $(this).val();
            let total = 0;
            // $(`#check${id}`).attr('checked', false);
            $("input:checkbox[name=check]:checked").each(function() {
                keranjang_id.push($(this).val());
            });

            // $("input:checkbox[name=check]:not(:checked)").each(function() {
            //     console.log($(this).val());
            // });
            // id = $(this).val();
            keranjang_id.forEach(function(val) {
                total += $(`#data_keranjang${val}`).data('subtotal');
            });

            $("#total").html("Rp. " + numberFormat(parseInt(total)));

            // $.ajax({
            //     url: '/keranjang/hitungTotal',
            //     type: 'POST',
            //     data: {
            //         'id_keranjang': keranjang_id
            //     },
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     success: function(response) {
            //         console.log(response);
            //         // $("#total").html("Rp. " + numberFormat(parseInt(response)));
            //     },
            //     error: function(error) {
            //         console.log(error);
            //     }
            // });
        });

        $("input[name='qty']").change(function(e) {
            // console.log(e.originalEvent.srcElement.value);
            let n = $("input[name='qty']").index(this);
            let qty = $("#qty" + parseInt(n + 1)).val();
            let id_cart = $(`input:checkbox[name=check]:eq(${n})`).val();
            let diskon = $(`.sum:eq(${n})`).data('diskon');

            $.ajax({
                async: true,
                url: '/keranjang/updateJumlah',
                type: 'POST',
                data: {
                    'id_keranjang': id_cart,
                    'qty': qty
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (diskon == 0) {
                        $("#subHarga" + parseInt(n + 1)).html("Rp. " + numberFormat(parseInt(response * qty)));
                        $(`.sum:eq(${n})`).data('subtotal', qty * parseInt(response));
                    } else {
                        $("#subHarga" + parseInt(n + 1)).html("Rp. " + numberFormat(parseInt((response - (diskon / 100 * response)) * qty)));
                        $(`.sum:eq(${n})`).data('subtotal', parseInt((response - (diskon / 100 * response)) * qty));
                    }
                    // (parseInt(response) - parseInt($(`#data_keranjang${parseInt(n+1)}`) / 100 * response)) * qty
                    sumTotal();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        })

        $("#checkout").click(function() {
            let keranjang_id = [];
            $("input:checkbox[name=check]:checked").each(function() {
                keranjang_id.push($(this).val());
            });

            console.log(keranjang_id);

            $.ajax({
                url: '/keranjang/go_checkout',
                type: 'POST',
                data: {
                    'id_keranjang': keranjang_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // $("#total").html("Rp. " + numberFormat(parseInt(response)));
                    window.location.href = '/checkout';
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });

    function numberFormat(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
    }

    function sumTotal() {
        totalPrice = 0;
        $('.sum').each(function(i) {
            if ($('input:checkbox[name="check"]').eq(i).is(':checked') == true) {
                totalPrice += $(this).data('subtotal');
            }
        });
        $("#total").html("Rp. " + numberFormat(totalPrice));
    }
</script>
@endpush