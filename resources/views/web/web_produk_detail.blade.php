@extends('mpnj.layout.main')

@section('title','Market Place PP Nurul Jadid')

@section('content')

<section class="py-3 bg-gray">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ URL::to('produk?kategori='.$produk->kategori->nama_kategori)}}">{{ $produk->kategori->nama_kategori }}</a>
            </li>
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
                            <div> <a href="#"><img src="{{ env('FILES_ASSETS').$produk->foto_produk[0]->foto_produk }}"
                                        id="thumbFoto" alt="{{ $produk->nama_produk }}"></a></div>
                        </div> <!-- slider-product.// -->
                        <div class="thumbs-wrap">
                            @foreach($produk->foto_produk as $img)
                            <a href="#" class="item-thumb"> <img src="{{ env('FILES_ASSETS').$img->foto_produk }}"
                                    alt="{{ $produk->nama_produk }}" id="foto_produk{{ $img->id_foto_produk }}"
                                    onclick="gantiFoto({{ $img->id_foto_produk }})"></a>
                            @endforeach
                        </div> <!-- slider-nav.// -->
                    </article> <!-- gallery-wrap .end// -->
                </div> <!-- card.// -->
            </aside>
            <main class=" col-md-6">
                <article class="product-info-aside">

                    <h2 class="title mt-3">{{ $produk->nama_produk}} </h2>

                    <div class="rating-wrap my-3">
                        <!-- <ul class="rating-stars">
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
                        </ul> -->
                        <!-- <small class="label-rating text">132 reviews</small> -->
                        <small class="label-rating text-success"> <i class="fa fa-clipboard-check"></i>
                            {{$produk->terjual}} orders </small>
                        @if($produk->stok <= 10) <small class="label-rating text-primary"> <i class="fa fa-box"></i>
                            {{$produk->stok}} stok </small>
                            <small class="badge badge-danger blink" id="alertStok"> STOK TERBATAS !!!</small>
                            @else
                            <small class="label-rating text-success"> <i class="fa fa-box"></i> {{$produk->stok}} stok
                            </small>
                            @endif
                    </div> <!-- rating-wrap.// -->

                    <div class="mb-3">
                        @if($produk->diskon == 0)
                        <var class="price h4">@currency($produk->harga_jual) / {{$produk->satuan}}</var>
                        <span class="text">Belum ada diskon</span>
                        @else
                        <var class="price h4">@currency($produk->harga_jual - ($produk->diskon / 100 *
                            $produk->harga_jual)),00 / {{$produk->satuan}}</var>
                        <span class="text">Harga Awal, @currency($produk->harga_jual),00</span>
                        @endif
                    </div> <!-- price-detail-wrap .// -->

                    <p class="text-justify">{!! substr($produk->keterangan,0,450) !!}...</p>
                    <div class="alert alert-warning d-none text-center" role="alert" id="alertMax">
                        <strong>TIDAK BISA MELEBIHIN STOK BARANG</strong>
                    </div>
                    <div class="alert alert-warning d-none text-center" role="alert" id="alertMin">
                        <strong>MINIMAL 1 PESANAN BARANG</strong>
                    </div>
                    <div class="form-row  mt-4">
                        <div class="form-group col-md flex-grow-0">
                            <div class="input-group mb-3 input-spinner">
                                <div class="input-group-append">
                                    <button class="btn btn-light btn-number" type="button" id="button-minus"> -
                                    </button>
                                </div>
                                <input type="text" class="form-control input-number" id="jml" value="1" min="1" max="99"
                                    style="padding: 0%; width: auto">
                                <input type="hidden" class="form-control input-number" id="stok" name="stok"
                                    value="{{$produk->stok}}">
                                <div class="input-group-prepend">
                                    <button class="btn btn-light btn-number" type="button" id="button-plus"> + </button>
                                </div>
                            </div>
                        </div> <!-- col.// -->
                        <div class="form-group col-md">
                            <form action="{{ URL::to('keranjang')}}" method="post">
                                @csrf
                                <input type="hidden" name="id_produk" id="id_produk" value="{{ $produk->id_produk }}">
                                <input type="hidden" name="harga_jual" id="harga_jual"
                                    value="{{ $produk->harga_jual }}">
                                <input type="hidden" class="form-control input-number" id="jumlah" name="jumlah"
                                    value="1">
                                <button type="submit" id="btnKeranjang" class="btn btn-primary"> <i
                                        class="fas fa-shopping-cart"></i> <span class="text">Masukkan
                                        Keranjang</span></button>
                            </form>
                        </div> <!-- col.// -->
                    </div> <!-- row.// -->

                    <div class="form-row">
                        <h2 class="title">Informasi Pelapak</h2>
                        <figure class="itemside">
                            <div class="aside">
                                @if(is_null($produk->user->foto_profil))
                                <div class="icontext mr-4" style="max-width: 300px;">
                                    <span class="icon icon-lg rounded-circle border border-primary">
                                        <i class="fa fa-user text-primary"></i>
                                    </span>
                                    <h6 class="text">
                                        Belum Ada Foto Profil
                                    </h6>
                                </div>
                                @else
                                <img src="{{ url('assets/foto_profil_konsumen/'. $produk->user->foto_profil) }}"
                                    class="icon icon-md rounded-circle">
                                @endif
                            </div>
                            <figcaption class="info">
                                <a href="{{ URL::to('pelapak/'.$produk->user->username )}}"
                                    class="title text-dark">{{ $produk->user->nama_toko }}</a>
                                <p class="text small">Bergabung Sejak <i class="fa fa-clock"></i> :
                                    {{ \Carbon\Carbon::parse($produk->user->created_at)->format('d M, Y') }}</p>
                                <p class="text small">Kurir Tersedia <i class="fa fa-truck"></i> :
                                    @if($kurir->count()==0)
                                    Pelapak Belum Mengisi
                                    @else
                                    @foreach($kurir as $k)
                                    <strong>{{$k->kurir->kurir}}</strong>-
                                    @endforeach
                                    @endif
                                </p>
                                <a href="#" class="btn btn-light">
                                    <i class="fas fa-envelope"></i> <span class="text">Hubungi Pelapak</span>
                                </a>
                                @if($produk->wishlists->where('user_id', Auth::id())->count()==0)
                                <a href="{{ URL::to('wishlist/add/'.$produk->id_produk)}}" class="btn btn-light"
                                    data-original-title="Tambah Ke Wishlist" title="" data-toggle="tooltip"> <i
                                        class="fas fa-heart"></i> </a>
                                @else
                                <a href="{{ URL::to('wishlist/delete/'.$produk->id_produk)}}" class="btn btn-light"
                                    data-original-title="Hapus Wishlist" title="" data-toggle="tooltip"> <i
                                        class="fas fa-heart text-primary"></i> </a>
                                @endif
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
                <p class="text-justify">{!! $produk->keterangan !!}</p>
            </div> <!-- col.// -->

            <aside class="col-md-4">
                <div class="box">
                    <h5 class="title-description">Review</h5>

                    @if (count($review) > 0)
                    <div class="mpnj">
                        @include('web.load.paginate')
                    </div>
                    @else
                    No data found :(
                    @endif

                </div> <!-- box.// -->
            </aside> <!-- col.// -->
        </div> <!-- row.// -->

        <header class="section-heading heading-line">
            <h4 class="title-section text-uppercase">PRODUK LAIN</h4>
        </header>
        <div class="row">
            @foreach($produk_pelapak as $pl)
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div href="{{ URL::to('produk/'.$pl->slug) }}" class="card card-sm card-product-grid shadow-sm">
                    <a href="{{ URL::to('produk/'.$pl->slug) }}" class=""> <img class="card-img-top"
                            src="{{ env('FILES_ASSETS').$pl->foto_produk[0]->foto_produk }}"> </a>
                    <span class="topbar">
                        @if($pl->wishlists->where('user_id', Auth::id())->count()==0)
                        <a href="{{ URL::to('wishlist/add/'.$pl->id_produk)}}" class="float-right"
                            data-original-title="Tambah Ke Wishlist" title="" data-toggle="tooltip"> <i
                                class="fas fa-heart"></i> </a>
                        @else
                        <a href="{{ URL::to('wishlist/delete/'.$pl->id_produk)}}" class="float-right"
                            data-original-title="Hapus Wishlist" title="" data-toggle="tooltip"> <i
                                class="fas fa-heart text-primary"></i>
                        </a>
                        @endif
                    </span>
                    <figcaption class="info-wrap">
                        <div class="namaProduk-rapi">
                            <a href="{{ URL::to('produk/'.$pl->slug) }}" class="title">{{ $pl->nama_produk }}</a>
                        </div>
                        <div class="price mt-1">
                            @if($pl->diskon == 0)
                            <span>
                                <span style="font-size:12px;margin-right:-2px;"></span> <span
                                    style="font-size:14px;">@currency($pl->harga_jual)</span>
                            </span>
                            @else
                            <span style="color: green">
                                <span style="font-size:12px;margin-right:-2px;"></span> <span
                                    style="font-size:14px;">@currency($pl->harga_jual - ($pl->diskon / 100 *
                                    $pl->harga_jual))</span>
                            </span>
                            <span style="color: gray">
                                <strike><span style="font-size:12px;margin-right:-2px;"></span> <span
                                        style="font-size:12px;">@currency($pl->harga_jual)</span></strike>
                            </span>
                            @endif
                        </div> <!-- price-wrap.// -->
                        <div class="row">
                            <div class="col">
                                <ul class="rating-stars">
                                    <li style="width:50%" class="stars-active">
                                        <i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star"
                                            style="font-size:small"></i>
                                        <i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star"
                                            style="font-size:small"></i>
                                        <i class="fa fa-star" style="font-size:small"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star"
                                            style="font-size:small"></i>
                                        <i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star"
                                            style="font-size:small"></i>
                                        <i class="fa fa-star" style="font-size:small"></i>
                                    </li>
                                </ul>
                                <span class="rating-stars" style="font-size:small;">(125)</span>
                            </div> <!-- rating-wrap.// -->

                        </div>
                        <div class="row">
                            <div class="col" style="font-size:small">PAITON {{$pl->kota}}</div>
                            <!-- selesaikan API nya ya -->
                            <div class="text-right col text-success" style="font-size:small;">{{$pl->terjual}} terjual
                            </div>
                        </div>
                    </figcaption>
                </div>
            </div>
            @endforeach
        </div>
    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@endsection

@push('scripts')
<script>
    $(function() {
        $("#button-plus").click(function() {
            let jml = $("#jml").val();
            let stok = $("#stok").val();
            $("#jml").val(parseInt(jml) + 1);
            $("#jumlah").val($("#jml").val());
            if (parseInt(jml) >= parseInt(stok)) {
                $('#alertMax').removeClass('d-none');
                setTimeout(function(){ $('#alertMax').addClass('d-none');}, 1000);
                $("#jml").val(parseInt(jml) - 1 + 1);
                $("#jumlah").val($("#jml").val());
            }
        });

        $("#button-minus").click(function() {
            let jml = $("#jml").val();
            let stok = $("#stok").val();
            $("#jml").val(parseInt(jml) - 1);
            $("#jumlah").val($("#jml").val());
            if (parseInt(jml) <= 1) {
                $('#alertMin').removeClass('d-none');
                setTimeout(function(){ $('#alertMin').addClass('d-none');}, 1000);
                $("#jml").val(1);
                $("#jumlah").val($("#jml").val());
            }
        });

        $("#jml").on('input', function() {
            let jml = $("#jml").val();
            let stok = $("#stok").val();
            // alert($("#jml").val());
            $("#jumlah").val($("#jml").val());
            if (parseInt(jml) > parseInt(stok)) {
                $('#alertMax').removeClass('d-none');
                setTimeout(function(){ $('#alertMax').addClass('d-none');}, 1000);
                $("#jml").val($("#stok").val());
                $("#jumlah").val($("#jml").val());
            }
            if (parseInt(jml) < 1) {
                $('#alertMin').removeClass('d-none');
                setTimeout(function(){ $('#alertMin').addClass('d-none');}, 1000);
                $("#jml").val(1);
                $("#jumlah").val($("#jml").val());
            }
            if (isNaN(jml)) {
                $("#jml").val(1);
                $("#jumlah").val($("#jml").val());
            }
        });

        $('#jml').blur(function() {
            if (!this.value) { // zero-length string
                $("#jml").val(1);
                $("#jumlah").val($("#jml").val());
            }
        });

        if ($("#stok").val() == 0) {
            $("#alertStok").text("STOK HABIS!!!");
            $("#jml").val($("#stok").val());
            $("#jumlah").val($("#jml").val());
            $("#btnKeranjang").attr("disabled", true);
        }
    });

    function gantiFoto(id) {
        let src = $("#foto_produk" + id).attr('src');
        $("#thumbFoto").attr('src', src);
    };
</script>
@endpush