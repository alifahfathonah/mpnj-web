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
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <a href="/kategori/{{ strtolower($produk->kategori->nama_kategori) }}">{{ $produk->kategori->nama_kategori }}</a>
                        </li>
                        <li class="active">
                            <a href="#">{{ $produk->nama_produk }}</a>
                        </li>
                    </ul>
                </div>
                <h1 class="page-title">{{ $produk->nama_produk }}</h1>
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

<!--============================================
        START SINGLE PRODUCT DESCRIPTION AREA
    ==============================================-->
<section class="single-product-desc">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="item-preview">
                    <div class="item__preview-slider">
                        <div class="prev-slide">
                            <img src="{{ asset('assets/foto_produk/'.$produk->foto_produk[0]->foto_produk) }}" id="thumbnailFoto" alt="{{ $produk->nama_produk }}" width="750" height="430">
                        </div>
                    </div>
                    <!-- end /.item--preview-slider -->

                    <div class="item__preview-thumb">
                        <div class="prev-thumb">
                            <div class="thumb-slider">
                            @foreach($produk->foto_produk as $img)
                                <div class="item-thumb">
                                    <img src="{{ asset('assets/foto_produk/'.$img->foto_produk) }}" alt="{{ $produk->nama_produk }}" id="foto_produk{{ $img->id_foto_produk }}" onclick="gantiFoto({{ $img->id_foto_produk }})">
                                </div>
                            @endforeach
                            </div>
                            <!-- end /.thumb-slider -->

                            <div class="prev-nav thumb-nav">
                                <span class="lnr nav-left lnr-arrow-left"></span>
                                <span class="lnr nav-right lnr-arrow-right"></span>
                            </div>
                            <!-- end /.prev-nav -->
                        </div>

                        <!-- end /.item__action -->
                    </div>
                    <!-- end /.item__preview-thumb-->


                </div>
                <!-- end /.item-preview-->

                <div class="item-info">
                    <div class="item-navigation">
                        <ul class="nav nav-tabs">
                            <li>
                                <a href="#product-details" class="active" aria-controls="product-details" role="tab" data-toggle="tab">Keterangan</a>
                            </li>
                            
                            <li>
                                <a href="#product-review" aria-controls="product-review" role="tab" data-toggle="tab">Reviews
                                    <span>({{ $counts }})</span>
                                    <!-- Count() -->
                                </a>
                            </li>
                            <!-- <li>
                                <a href="#product-support" aria-controls="product-support" role="tab" data-toggle="tab">Support</a>
                            </li>
                            <li>
                                <a href="#product-faq" aria-controls="product-faq" role="tab" data-toggle="tab">item
                                    FAQ</a>
                            </li> -->
                        </ul>
                    </div>
                    <!-- end /.item-navigation -->

                    <div class="tab-content">
                        <div class="fade show tab-pane product-tab active" id="product-details">
                            <div class="tab-content-wrapper">
                                {{ $produk->keterangan }}
                            </div>
                        </div>
                        <!-- end /.tab-content -->
                        <!-- Review -->
                        <div class="fade tab-pane product-tab" id="product-review">
                            <div class="thread thread_review">
                                <ul class="media-list thread-list">
                                   @foreach ($review as $r)
                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="{{ asset('assets/foto_produk/'.$produk->foto_produk[0]->foto_produk) }}" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="clearfix">
                                                    <div class="pull-left">
                                                        <div class="media-heading">
                                                            <a href="author.html">
                                                                <h4>{{ $r->konsumen->nama_lengkap }}</h4>
                                                            </a>
                                                            <span>{{ $r->created_at }}</span>
                                                        </div>
                                                        <div class="rating product--rating">
                                                            <ul>
                                                                <li>
                                                                    <span class="fa fa-star"></span>
                                                                </li>
                                                                <li>
                                                                    <span class="fa fa-star"></span>
                                                                </li>
                                                                <li>
                                                                    <span class="fa fa-star" aria-hidden="true"></span>
                                                                </li>
                                                                <li>
                                                                    <span class="fa fa-star"></span>
                                                                </li>
                                                                <li>
                                                                    <span class="fa fa-star-half-o"></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p>{{ $r->review }}</p>
                                            </div>
                                        </div>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea class="bla" name="reply-comment" placeholder="Write your comment..."></textarea>
                                                    <button class="btn btn--md btn--round">Post Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    @endforeach
                                    <!-- end single comment thread /.comment-->

                                  
                                <!-- end /.comment pagination area -->
                            </div>
                            <!-- end /.comments -->
                        </div>
                        <!-- end /.product-comment -->

                        <!-- end /.product-faq -->
                    </div>
                    <!-- end /.tab-content -->
                </div>
                <!-- end /.item-info -->
            </div>
            <!-- end /.col-md-8 -->

            <div class="col-lg-4">
                <aside class="sidebar sidebar--single-product">
                    <div class="sidebar-card card-pricing">
                        <div class="price">
                            @if($produk->diskon == 0)
                                <h1>
                                    @currency($produk->harga_jual)
                                </h1>
                            @else
                                <h1>
                                    @currency($produk->harga_jual - ($produk->diskon / 100 * $produk->harga_jual))
                                </h1>
                                <strike style="color: red">
                                    <h3 style="color: red">
                                        @currency($produk->harga_jual)
                                    </h3>
                                </strike>
                            @endif
                        </div>
                        {{-- <ul class="pricing-options">
                            <li>
                                <div class="custom-radio">
                                    <input type="radio" id="opt1" class="" name="filter_opt" checked>
                                    <label for="opt1">
                                        <span class="circle"></span>Single Site License –
                                        <span class="pricing__opt">$20.00</span>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-radio">
                                    <input type="radio" id="opt2" class="" name="filter_opt">
                                    <label for="opt2">
                                        <span class="circle"></span>2 Sites License –
                                        <span class="pricing__opt">$40.00</span>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-radio">
                                    <input type="radio" id="opt3" class="" name="filter_opt">
                                    <label for="opt3">
                                        <span class="circle"></span>Multi Site License –
                                        <span class="pricing__opt">$60.00</span>
                                    </label>
                                </div>
                            </li>
                        </ul> --}}
                        <!-- end /.pricing-options -->

                        <div class="purchase-button">
                            {{-- <a href="#" class="btn btn--lg btn--round">Purchase Now</a> --}}
                            <form action="/keranjang" method="post">
                                @csrf
                                <input type="hidden" name="id_produk" id="id_produk" value="{{ $produk->id_produk }}">
                                <input type="hidden" name="harga_jual" id="harga_jual" value="{{ $produk->harga_jual }}">
                                <button type="submit" class="btn btn--lg btn--round cart-btn"><span class="lnr lnr-cart"></span> Tambah ke Keranjang</button>
                            </form>
                            {{-- <a href="#" class="btn btn--lg btn--round cart-btn">
                                <span class="lnr lnr-cart"></span> Tambah ke Keranjang</a> --}}
                        </div>
                        <!-- end /.purchase-button -->
                    </div>
                    <!-- end /.sidebar--card -->

                    <div class="sidebar-card card--metadata">
                        <ul class="data">
                            <li>
                                <p>
                                    <span class="lnr lnr-cart pcolor"></span>Terjual</p>
                                <span>{{ $produk->terjual }}</span>
                            </li>
                            <li>
                                <p>
                                    <span class="lnr lnr-heart scolor"></span>Wishlist</p>
                                <span>{{ $produk->wishlist }}</span>
                            </li>
                            <li>
                                <p>
                                    <span class="lnr lnr-bubble mcolor3"></span>Review
                                </p>
                                <span>0</span>
                            </li>
                        </ul>


                        <div class="rating product--rating">
                            <ul>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                                <li>
                                    <span class="fa fa-star-half-o"></span>
                                </li>
                            </ul>
                            <span class="rating__count">( 26 Ratings )</span>
                        </div>
                        <!-- end /.rating -->
                    </div>
                    <!-- end /.sidebar-card -->

                    <div class="sidebar-card card--product-infos">
                        <div class="card-title">
                            <h4>Informasi Produk</h4>
                        </div>

                        <ul class="infos">
                            <li>
                                <p class="data-label">Diupload</p>
                                <p class="info">{{ $produk->created_at->format('d, M Y') }}</p>
                            </li>
                            <li>
                                <p class="data-label">Diperbarui</p>
                                <p class="info">{{ $produk->updated_at->format('d, M Y') }}</p>
                            </li>
                            <li>
                                <p class="data-label">Kategori</p>
                                <p class="info">{{ $produk->kategori->nama_kategori }}</p>
                            </li>
                        </ul>
                    </div>
                    <!-- end /.aside -->

                    <div class="author-card sidebar-card ">
                        <div class="card-title">
                            <h4>Informasi Penjual</h4>
                        </div>

                        <div class="author-infos">
                            <div class="author_avatar">
                                <img src="{{ asset('assets/images/author-avatar.jpg') }}" alt="Presenting the broken author avatar :D">
                            </div>

                            <div class="author">
                                <h4>{{ $produk->pelapak->nama_toko }}</h4>
                                <p>Bergabung: {{ $produk->pelapak->created_at->format("d, M Y") }}</p>
                            </div>
                            <!-- end /.author -->

                            <div class="social social--color--filled">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-facebook"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-twitter"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-dribbble"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end /.social -->

                            <div class="author-btn">
                                <a href="#" class="btn btn--sm btn--round">Kunjungi</a>
                                <a href="#" class="btn btn--sm btn--round">Kirim Pesan</a>
                            </div>
                            <!-- end /.author-btn -->
                        </div>
                        <!-- end /.author-infos -->


                    </div>
                    <!-- end /.author-card -->
                </aside>
                <!-- end /.aside -->
            </div>
            <!-- end /.col-md-4 -->
        </div>
        <!-- end /.row -->
    </div>
    <!-- end /.container -->
</section>
<!--===========================================
        END SINGLE PRODUCT DESCRIPTION AREA
    ===============================================-->
@endsection

@push('scripts')
    <script>
        function gantiFoto(id) {
            let src = $("#foto_produk"+id).attr('src');
            $("#thumbnailFoto").attr('src', src);
        }
    </script>
@endpush