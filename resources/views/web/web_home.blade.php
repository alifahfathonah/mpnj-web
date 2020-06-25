@extends('mpnj.layout.main')

@section('title','Belanj | Situs Belanja Online Terlengkap, Aman, dan Nyaman')

@section('content')

<div class="container">
    <!-- ========================= SECTION MAIN  ========================= -->
    <section class="section-main padding-y">
        <main class="card">
            <div class="card-body">

                <div class="row">
                    <aside class="col-lg col-md-3 flex-lg-grow-0">
                        <h6>KATEGORI</h6>
                        <nav class="nav-home-aside">
                            <ul class="menu-category">
                                @foreach ($kategori as $k)
                                <li>
                                    <a
                                        href="{{ URL::to('produk?kategori='.strtolower($k->nama_kategori)) }}">{{ $k->nama_kategori }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </nav>
                    </aside> <!-- col.// -->
                    <div class="col-md-9 col-xl-7 col-lg-7">

                        <!-- ================== COMPONENT SLIDER  BOOTSTRAP  ==================  -->
                        <div id="carousel1_indicator" class="slider-home-banner carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach($banner as $key => $bnn)
                                <li data-target="#carousel1_indicator" data-slide-to="{{ $bnn->id }}"
                                    class="{{$key == 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach($banner as $key => $bn)
                                <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                    <img src="{{ url('assets/banner/'.$bn->foto_banner) }}"
                                        alt="Slide {{$bn->nama_banner}}">
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carousel1_indicator" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel1_indicator" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!-- ==================  COMPONENT SLIDER BOOTSTRAP end.// ==================  .// -->

                    </div> <!-- col.// -->
                    <div class="col-md d-none d-lg-block flex-grow-1">
                        <h6 class="bg-green text-center text-white mb-0 p-2">Ketegori Produk Baru</h6>
                        <div class="overflow-auto" style="height:370px">
                            <aside class="special-home-right">
                                @foreach($latestProduk as $lp)
                                @if($lp->latestProduk != null)
                                <div class="card-banner border-bottom">
                                    <div class="py-3" style="width:80%">
                                        <div class="namaProduk-rapi">
                                            <a href="{{ URL::to('produk/'.$lp->latestProduk->slug) }}" class="title">
                                                {{ $lp->latestProduk->nama_produk }}</a>
                                        </div>
                                        <a href="{{ URL::to('produk?kategori='.strtolower($lp->nama_kategori)) }}"
                                            class="btn btn-primary btn-sm">{{$lp->nama_kategori}}</a>
                                    </div>
                                    <img src="{{ env('FILES_ASSETS').$lp->latestProduk->foto_produk[0]->foto_produk }}"
                                        height="80" class="icon icon-md rounded-circle my-auto">
                                </div>
                                @else
                                @endif
                                @endforeach
                            </aside>
                        </div>

                    </div> <!-- col.// -->
                </div> <!-- row.// -->

            </div> <!-- card-body.// -->
        </main> <!-- card.// -->

    </section>
    <!-- ========================= SECTION MAIN END// ========================= -->

    <!-- =============== SECTION DEAL =============== -->
    <section class="padding-bottom">
        <div class="card card-deal">
            <div class="col-heading content-body">
                <header class="section-heading">
                    <h3 class="section-title">Diskon Tertinggi</h3>
                    <p>Hygiene equipments</p>
                </header><!-- sect-heading -->
                <div class="timer">
                    <div><span class="num">04</span>
                        <small>Days</small>
                    </div>
                    <div><span class="num">12</span>
                        <small>Hours</small>
                    </div>
                    <div><span class="num">58</span>
                        <small>Min</small>
                    </div>
                    <div><span class="num">02</span>
                        <small>Sec</small>
                    </div>
                </div>
            </div> <!-- col.// -->
            <div class="row no-gutters items-wrap">
                @foreach($produkDiskon as $pD)
                <div class="col-md col-6">
                    <figure class="card-product-grid card-sm">
                        <a href="#" class="img-wrap">
                            <img src="{{ env('FILES_ASSETS').$pD->foto_produk[0]->foto_produk  }}">
                        </a>
                        <div class="namaProduk-rapi">
                            <a href="{{ URL::to('produk/'.$pD->slug) }}" class="title">{{ $pD->nama_produk }}</a>
                        </div>
                        <span class="badge badge-danger"> -{{$pD->diskon}}% </span>
                    </figure>
                </div>
                @endforeach
            </div>
        </div>

    </section>
    <!-- =============== SECTION DEAL // END =============== -->

    <!-- =============== SECTION ITEMS =============== -->
    <section class="padding-bottom-sm">

        <header class="section-heading heading-line">
            <h4 class="title-section text-uppercase">PRODUK TERBARU</h4>
        </header>

        <div class="row row-sm">
            @foreach($produk as $p)
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div href="{{ URL::to('produk/'.$p->slug) }}" class="card card-sm card-product-grid shadow-sm">
                    <a href="{{ URL::to('produk/'.$p->slug) }}" class=""> <img class="card-img-top"
                            src="{{ env('FILES_ASSETS').$p->foto_produk[0]->foto_produk }}">
                    </a>
                    <span class="topbar">
                        @if($p->wishlists->where('user_id', Auth::id())->count()==0)
                        <a href="{{ URL::to('wishlist/add/'.$p->id_produk)}}" class="float-right"
                            data-original-title="Tambah Ke Wishlist" title="" data-toggle="tooltip"> <i
                                class="fas fa-heart"></i> </a>
                        @else
                        <a href="{{ URL::to('wishlist/delete/'.$p->id_produk)}}" class="float-right"
                            data-original-title="Hapus Wishlist" title="" data-toggle="tooltip"> <i
                                class="fas fa-heart text-primary"></i>
                        </a>
                        @endif
                    </span>
                    <figcaption class="info-wrap">
                        <div class="namaProduk-rapi">
                            <a href="{{ URL::to('produk/'.$p->slug) }}" class="title">{{ $p->nama_produk }}</a>
                        </div>
                        <div class="price mt-1">
                            @if($p->diskon == 0)
                            <span>
                                <span style="font-size:12px;margin-right:-2px;">Rp</span> <span
                                    style="font-size:14px;">@currency($p->harga_jual)</span>
                            </span>
                            @else

                            <span style="color: green">
                                <span style="font-size:12px;margin-right:-2px;">Rp</span> <span
                                    style="font-size:14px;">@currency($p->harga_jual - ($p->diskon / 100 *
                                    $p->harga_jual))</span>
                            </span>
                            <span style="color: gray">
                                <strike><span style="font-size:12px;margin-right:-2px;">Rp</span> <span
                                        style="font-size:12px;">@currency($p->harga_jual)</span></strike>
                            </span>
                            @endif
                        </div> <!-- price-wrap.// -->
                        <div class="row">
                            <div class="col" style="">
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
                            <div class="col" style="font-size:small">PAITON {{$p->kota}}</div>
                            <!-- selesaikan API nya ya -->
                            <div class="text-right col text-success" style="font-size:small;">{{$p->terjual}}
                                terjual
                            </div>
                        </div>
                    </figcaption>
                </div>
            </div>
            @endforeach
        </div> <!-- row.// -->

        <header class="section-heading heading-line">
            <h4 class="title-section text-uppercase">PRODUK TERLARIS</h4>
        </header>

        <div class="row row-sm">
            @foreach($produk as $p)
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="shadow-sm" style="background-color:#35BE32;position: absolute;left: 0;color:#fff;top: .625rem;display: -webkit-box;
                            display: -webkit-flex;display: -moz-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;
                            -webkit-box-direction: normal;
                            -webkit-flex-direction: column;
                            -moz-box-orient: vertical;
                            -moz-box-direction: normal;
                            -ms-flex-direction: column;
                            flex-direction: column;
                            -webkit-box-align: start;
                            -webkit-align-items: flex-start;
                            -moz-box-align: start;
                            -ms-flex-align: start;
                            align-items: flex-start;
                            z-index: 1;padding:5px;font-size:small">Star Teller
                </div>
                <div href="{{ URL::to('produk/'.$p->slug) }}" class="card card-sm card-product-grid shadow-sm">
                    <a href="{{ URL::to('produk/'.$p->slug) }}" class=""> <img class="card-img-top"
                            src="{{ env('FILES_ASSETS').$p->foto_produk[0]->foto_produk }}">
                    </a>
                    <span class="topbar">
                        @if($p->wishlists->where('user_id', Auth::id())->count()==0)
                        <a href="{{ URL::to('wishlist/add/'.$p->id_produk)}}" class="float-right"
                            data-original-title="Tambah Ke Wishlist" title="" data-toggle="tooltip"> <i
                                class="fas fa-heart"></i> </a>
                        @else
                        <a href="{{ URL::to('wishlist/delete/'.$p->id_produk)}}" class="float-right"
                            data-original-title="Hapus Wishlist" title="" data-toggle="tooltip"> <i
                                class="fas fa-heart text-primary"></i>
                        </a>
                        @endif
                    </span>
                    <figcaption class="info-wrap">
                        <div class="namaProduk-rapi">
                            <a href="{{ URL::to('produk/'.$p->slug) }}" class="title">{{ $p->nama_produk }}</a>
                        </div>
                        <div class="price mt-1">
                            @if($p->diskon == 0)
                            <span>
                                <span style="font-size:12px;margin-right:-2px;">Rp</span> <span
                                    style="font-size:14px;">@currency($p->harga_jual)</span>
                            </span>
                            @else

                            <span style="color: green">
                                <span style="font-size:12px;margin-right:-2px;">Rp</span> <span
                                    style="font-size:14px;">@currency($p->harga_jual - ($p->diskon / 100 *
                                    $p->harga_jual))</span>
                            </span>
                            <span style="color: gray">
                                <strike><span style="font-size:12px;margin-right:-2px;">Rp</span> <span
                                        style="font-size:12px;">@currency($p->harga_jual)</span></strike>
                            </span>
                            @endif
                        </div> <!-- price-wrap.// -->
                        <div class="row">
                            <div class="col" style="">
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
                            <div class="col" style="font-size:small">PAITON {{$p->kota}}</div>
                            <!-- selesaikan API nya ya -->
                            <div class="text-right col text-success" style="font-size:small;">{{$p->terjual}}
                                terjual
                            </div>
                        </div>
                    </figcaption>
                </div>
            </div>
            @endforeach
        </div> <!-- row.// -->
    </section>
    <!-- =============== SECTION ITEMS .//END =============== -->

    <article class="my-4">
        <img src="{{ asset('assets/mpnj/images/banners/ad-sm.png') }}" class="w-100">
    </article>
</div>
<!-- container end.// -->
@endsection