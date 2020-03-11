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
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col" width="120">Jumlah</th>
                                <th scope="col" width="120">Sub Harga</th>
                                <th scope="col" class="text-right" width="200"> </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n = 1;
                            $total = 0; ?>
                            @foreach($keranjang as $key => $val)
                                <tr id="dataCart">
                                    <td colspan="5"><strong>{{ $key }}</strong></td>
                                </tr>
                                @foreach ($val as $k)
                                    <tr id="data_keranjang{{ $k->id_keranjang  }}"
                                        class="sum"
                                        data-total="{{ $total += ($k->harga_jual - ($k->produk->diskon / 100 * $k->harga_jual)) * $k->jumlah }}"
                                        data-subtotal="{{ ($k->harga_jual - ($k->produk->diskon / 100 * $k->harga_jual)) * $k->jumlah  }}"
                                        data-hargajual="{{ $k->harga_jual  }}"
                                        data-diskon="{{ $k->produk->diskon }}">
                                        <td>
                                            <input type="checkbox" name="check" id="check{{ $k->id_keranjang }}" value="{{ $k->id_keranjang }}" checked="true">
                                        </td>
                                        <td>
                                            <figure class="itemside">
                                                <div class="aside"><img src="{{ asset('assets/foto_produk/'.$k->produk->foto_produk[0]->foto_produk) }}" class="img-sm"></div>
                                                <figcaption class="info">
                                                    <a href="{{ URL::to('produk/'.$k->produk->slug) }}" class="title text-dark">{{ $k->produk->nama_produk }}</a>
                                                    <p class="text-muted small">Kategori: {{ $k->produk->kategori->nama_kategori }}</p>
                                                </figcaption>
                                            </figure>
                                        </td>
                                        <td class="bold" id="harga{{ $n }}">
                                            @if($k->produk->diskon == 0)
                                                @currency($k->produk->harga_jual)
                                            @else
                                                <strike style="color: red">@currency($k->produk->harga_jual)</strike> | @currency($k->produk->harga_jual - ($k->produk->diskon / 100 * $k->produk->harga_jual))
                                            @endif
                                        </td>
                                        <td>
                                            <input type="number" name="qty" id="qty{{ $n }}" class="form-control form-control-sm" value="{{ $k->jumlah != 0 ? $k->jumlah : 1 }}">
                                        </td>
                                        <td id="subHarga{{ $n }}">
                                            @if($k->produk->diskon == 0)
                                                @currency($k->harga_jual * $k->jumlah)
                                            @else
                                                @currency(($k->harga_jual - ($k->produk->diskon / 100 * $k->harga_jual)) * $k->jumlah)
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ URL::to('keranjang/hapus/'.$k->id_keranjang) }}" class="btn btn-light"> Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $n++; ?>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>

                        <div class="card-body border-top">
{{--                            <a href="#" class="btn btn-primary float-md-right" id="checkout"> Lanjut Checkout <i class="fa fa-chevron-right"></i> </a>--}}
                            <button class="btn btn-primary float-md-right" id="checkout">Lanjut Checkout <i class="fa fa-chevron-right"></i></button>
                            <a href="{{ URL::to('produk') }}" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Lanjut Belanja </a>
                        </div>
                    </div> <!-- card.// -->

                    <div class="alert alert-success mt-3">
                        <p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks</p>
                    </div>

                </main> <!-- col.// -->
                <aside class="col-md-3">
{{--                    <div class="card mb-3">--}}
{{--                        <div class="card-body">--}}
{{--                            <form>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Have coupon?</label>--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input type="text" class="form-control" name="" placeholder="Coupon code">--}}
{{--                                        <span class="input-group-append">--}}
{{--							                <button class="btn btn-primary">Apply</button>--}}
{{--						                </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div> <!-- card-body.// -->--}}
{{--                    </div>  <!-- card .// -->--}}
                    <div class="card">
                        <div class="card-body">
{{--                            <dl class="dlist-align">--}}
{{--                                <dt>Total price:</dt>--}}
{{--                                <dd class="text-right">USD 568</dd>--}}
{{--                            </dl>--}}
{{--                            <dl class="dlist-align">--}}
{{--                                <dt>Discount:</dt>--}}
{{--                                <dd class="text-right">USD 658</dd>--}}
{{--                            </dl>--}}
                            <dl class="dlist-align">
                                <dt>Total:</dt>
                                <dd class="text-right  h5" id="total">@currency($total)</dd>
                            </dl>
                            <hr>
                            <p class="text-center mb-3">
                                <img src="{{ asset('assets/mpnj/images/misc/payments.png') }}" height="26">
                            </p>

                        </div> <!-- card-body.// -->
                    </div>  <!-- card .// -->
                </aside> <!-- col.// -->
            </div>

        </div> <!-- container .//  -->
    </section>
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
                        console.log(response);
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
            console.log(totalPrice);
            $("#total").html("Rp. " + numberFormat(totalPrice));
        }
    </script>
@endpush