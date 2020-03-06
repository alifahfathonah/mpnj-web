@extends('mpnj.layout.main')

@section('title','Market Place PP Nurul Jadid')


@section('content')

<section class="py-3 bg-gray">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ URL::to('kategori/'.$produk->kategori->nama_kategori)}}">{{ $produk->kategori->nama_kategori }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $produk->nama_produk}}</li>
        </ol>
    </div>
</section>

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content bg-white padding-y">
    <div class="container">

        <!-- ============================ ITEM DETAIL ======================== -->
        <div class="row">
            <aside class="col-md-6">
                <div class="card">
                    <article class="gallery-wrap">
                        <div class="img-big-wrap">
                            <div> <a href="#"><img src="{{ asset('assets/foto_produk/'.$produk->foto_produk[0]->foto_produk) }}" id="thumbFoto" alt="{{ $produk->nama_produk }}"></a></div>
                        </div> <!-- slider-product.// -->
                        <div class="thumbs-wrap">
                            @foreach($produk->foto_produk as $img)
                            <a href="#" class="item-thumb"> <img src="{{ asset('assets/foto_produk/'.$img->foto_produk) }}" alt="{{ $produk->nama_produk }}" id="foto_produk{{ $img->id_foto_produk }}" onclick="gantiFoto({{ $img->id_foto_produk }})"></a>
                            @endforeach
                        </div> <!-- slider-nav.// -->
                    </article> <!-- gallery-wrap .end// -->
                </div> <!-- card.// -->
            </aside>
            <main class=" col-md-6">
                <article class="product-info-aside">

                    <h2 class="title mt-3">{{ $produk->nama_produk}} </h2>

                    <div class="rating-wrap my-3">
                        <ul class="rating-stars">
                            <li style="width:80%" class="stars-active">
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>
                            <li>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>
                        </ul>
                        <small class="label-rating text">132 reviews</small>
                        <small class="label-rating text-success"> <i class="fa fa-clipboard-check"></i> {{$produk->terjual}} orders </small>
                    </div> <!-- rating-wrap.// -->

                    <div class="mb-3">
                        @if($produk->diskon == 0)
                        <var class="price h4">@currency ($produk->harga_jual),00</var>
                        <span class="text">Belum ada diskon</span>
                        @else
                        <var class="price h4">@currency($produk->harga_jual - ($produk->diskon / 100 * $produk->harga_jual)),00</var>
                        <span class="text">Harga Awal, @currency($produk->harga_jual),00</span>
                        @endif
                    </div> <!-- price-detail-wrap .// -->

                    <p class="text-justify">{{substr($produk->keterangan,0,450)}}...</p>

                    <div class="form-row  mt-4">
                        <div class="form-group col-md flex-grow-0">
                            <div class="input-group mb-3 input-spinner">
                                <div class="input-group-append">
                                    <button class="btn btn-light btn-number" type="button" id="button-plus" data-type="minus" data-field="quant[1]"> - </button>
                                </div>
                                <input type="text" class="form-control input-number" name="quant[1]" value="1" min="1" max="99">
                                <div class="input-group-prepend">
                                    <button class="btn btn-light btn-number" type="button" id="button-minus" data-type="plus" data-field="quant[1]"> + </button>
                                </div>
                            </div>
                        </div> <!-- col.// -->
                        <div class="form-group col-md">
                            <form action="{{ URL::to('keranjang')}}" method="post">
                                @csrf
                                <input type="hidden" name="id_produk" id="id_produk" value="{{ $produk->id_produk }}">
                                <input type="hidden" name="harga_jual" id="harga_jual" value="{{ $produk->harga_jual }}">
                                <button type="submit" class="btn btn-primary"> <i class="fas fa-shopping-cart"></i> <span class="text">Masukkan Keranjang</span></button>
                            </form>
                        </div> <!-- col.// -->
                    </div> <!-- row.// -->

                    <div class="form-row">
                        <h2 class="title">Informasi Pelapak</h2>
                        <figure class="itemside">
                            <div class="aside"><img src="/assets/foto_profil_konsumen/cMcpYGq5VkchA92.jpg" class="icon icon-md rounded-circle"></div>
                            <figcaption class="info">
                                <a href="{{ URL::to('pelapak/'.$produk->pelapak->username )}}" class="title text-dark">{{ $produk->pelapak->nama_toko }}</a>
                                <p class="text small">Bergabung Sejak : {{ $produk->pelapak->created_at->format("d, M Y") }}</p>
                                <a href="#" class="btn btn-light">
                                    <i class="fas fa-envelope"></i> <span class="text">Hubungi Pelapak</span>
                                </a>
                            </figcaption>
                        </figure>
                    </div>
                </article> <!-- product-info-aside .// -->
            </main> <!-- col.// -->
        </div> <!-- row.// -->

        <!-- ================ ITEM DETAIL END .// ================= -->

    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= SECTION  ========================= -->
<section class="section-name padding-y bg">
    <div class="container">

        <div class="row">
            <div class="col-md-8">
                <h5 class="title-description">Deskripsi Lengkap</h5>
                <p class="text-justify">{{$produk->keterangan}}</p>
            </div> <!-- col.// -->

            <aside class="col-md-4">
                <div class="box">
                    <h5 class="title-description">Review</h5>
                    <article class="media mb-3">
                        <a href="#"><img class="img-sm mr-3" src="/assets/foto_profil_konsumen/cMcpYGq5VkchA92.jpg"></a>
                        <div class="media-body">
                            <h6 class="mt-0"><a href="#">Ahmad Usama Oyo</a></h6>
                            <p class="mb-2"> Produk ini sangat sesuai dengan deskripsi. Enak Mantap</p>
                        </div>
                    </article>
                    <article class="media mb-3">
                        <a href="#"><img class="img-sm mr-3" src="/assets/foto_profil_konsumen/cMcpYGq5VkchA92.jpg"></a>
                        <div class="media-body">
                            <h6 class="mt-0"><a href="#">Ahmad Usama Oyo</a></h6>
                            <p class="mb-2"> Produk ini sangat sesuai dengan deskripsi. Enak Mantap</p>
                        </div>
                    </article>
                    <div class="form-group">
                        <form method="POST">
                            <label for="exampleFormControlTextarea1">Beri Review Anda</label>
                            <textarea class="form-control mb-2" id="exampleFormControlTextarea1" rows="3"></textarea>
                            <button type="button" class="btn btn-primary btn-sm btn-block">Kirim Komentar</button>
                        </form>
                    </div>
                </div> <!-- box.// -->
            </aside> <!-- col.// -->
        </div> <!-- row.// -->

        <h5 class="title">Produk Lain Pelapak</h5>
        <div class="row">
            @foreach($produk_pelapak as $pl)
            <div class="col-md-3">
                <figure class="card card-product-grid">
                    <div class="img-wrap">
                        <img src="{{ asset('assets/foto_produk/'.$pl->foto_produk[0]->foto_produk) }}" alt="Product Image">
                    </div> <!-- img-wrap.// -->
                    <figcaption class="info-wrap">
                        <a href="{{ URL::to('produk/'.$pl->id_produk) }}" class="title mb-2">{{ $pl->nama_produk }}</a>
                        <div class="price-wrap">
                            @if($pl->diskon == 0)
                            @currency($pl->harga_jual)
                            @else
                            <strike style="color: red">
                                @currency($pl->harga_jual)
                            </strike> @currency($pl->harga_jual - ($pl->diskon / 100 * $pl->harga_jual))
                            @endif
                        </div> <!-- price-wrap.// -->
                        <p class="text">{{ $pl->pelapak->nama_toko }}</p>
                        <hr>
                        <a href="{{ URL::to('produk/'.$pl->id_produk) }}" class="btn btn-outline-primary"> <i class="fa fa-angle-double-right"></i> Detail Produk </a>
                    </figcaption>
                </figure>
            </div>
            @endforeach
        </div>
    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@endsection

@push('scripts')
<script>
    function gantiFoto(id) {
        let src = $("#foto_produk" + id).attr('src');
        $("#thumbFoto").attr('src', src);
    };
    $('.btn-number').click(function(e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function() {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Maaf, minimum order 1 item');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Maaf, maksimum order 99 item');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".input-number").keydown(function(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>
@endpush