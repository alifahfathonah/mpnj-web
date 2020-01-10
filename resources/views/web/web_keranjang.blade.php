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
                            <a href="#">Keranjang</a>
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
                                            <th><input type="checkbox" name="pilih" id="pilih"></th>
                                            <th>Barang</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Sub Harga</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($keranjang as $k)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="check" id="check">
                                            </td>
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
                                            <td>{{ $k->produk->kategori->nama_kategori }}</td>
                                            <td class="bold" id="harga{{ $loop->iteration }}">
                                                @currency($k->produk->harga_jual)
                                            </td>
                                            <td style="width: 10%"><input type="number" name="qty" id="qty{{ $loop->iteration }}"
                                                    class="form-control form-control-sm" value="1"
                                                    onchange="ubahSubTotal({{ $loop->iteration }})"></td>
                                            <td id="subHarga{{ $loop->iteration }}">@currency($k->produk->harga_jual)</td>
                                            <td class="pending">
                                                <a href="/keranjang/hapus/{{ $k->id_keranjang }}">
                                                    <span>Hapus</span>
                                                </a>
                                            </td>
                                        </tr>
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

                                            <a href="checkout.html" class="btn btn--round btn--md checkout_link">Lanjut
                                                Checkout</a>
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
    function ubahSubTotal(n) {
            let qty = $("#qty"+n).val();
            var m = $("#harga"+n).html();
            var split = m.split("Rp. ");
            var p = split[1].replace('.','');

            $("#subHarga"+n).html("Rp. " + numberFormat(qty * p));
        }

        function numberFormat(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        }
</script>
@endpush
