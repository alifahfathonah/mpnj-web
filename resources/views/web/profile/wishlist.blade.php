<div class="d-flex justify-content-between mb-3 text-center">
    <h5 class="card-title">Wishlist Anda</h5>
    @if($wishlist->count() > 0 )
    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#berihkanWishlist">Bersihkan Wishlit
        <i class="fa fa-trash" aria-hidden="true"></i>
    </button>
    @else
    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#berihkanWishlist" disabled>Bersihkan Wishlit
        <i class="fa fa-trash" aria-hidden="true"></i>
    </button>
    @endif
</div>
<div class="row">
    @if($wishlist->count() > 0 )
    @foreach($wishlist as $w)
    <div class="col-xl-3 col-lg-3 col-md-4 col-6">
        <div href="{{ URL::to('produk/'.$w->produk->slug) }}" class="card card-sm card-product-grid shadow-sm">
            <a href="{{ URL::to('produk/'.$w->produk->slug) }}" class=""> <img class="card-img-top"
                    src="{{ env('FILES_ASSETS').$w->produk->foto_produk[0]->foto_produk }}"> </a>
            <span class="topbar">
                @if($w->where('user_id', Auth::id())->count()==0)
                <a href="{{ URL::to('wishlist/add/'.$w->produk->id_produk)}}" class="float-right"
                    data-original-title="Tambah Ke Wishlist" title="" data-toggle="tooltip"> <i
                        class="fas fa-heart"></i> </a>
                @else
                <a href="{{ URL::to('wishlist/delete/'.$w->produk->id_produk)}}" class="float-right"
                    data-original-title="Hapus Wishlist" title="" data-toggle="tooltip"> <i
                        class="fas fa-heart text-primary"></i>
                </a>
                @endif
            </span>
            <figcaption class="info-wrap">
                <div class="namaProduk-rapi">
                    <a href="{{ URL::to('produk/'.$w->produk->slug) }}" class="title">{{ $w->produk->nama_produk }}</a>
                </div>
                <div class="price mt-1">
                    @if($w->produk->diskon == 0)
                    <span>
                        <span style="font-size:12px;margin-right:-2px;">Rp</span> <span
                            style="font-size:14px;">@currency($w->produk->harga_jual)</span>
                    </span>
                    @else

                    <span style="color: green">
                        <span style="font-size:12px;margin-right:-2px;">Rp</span> <span
                            style="font-size:14px;">@currency($w->produk->harga_jual - ($w->produk->diskon / 100
                            *
                            $w->produk->harga_jual))</span>
                    </span>
                    <span style="color: gray">
                        <strike><span style="font-size:12px;margin-right:-2px;">Rp</span> <span
                                style="font-size:12px;">@currency($w->produk->harga_jual)</span></strike>
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
                    <div class="col" style="font-size:small">PAITON {{$w->produk->kota}}</div>
                    <!-- selesaikan API nya ya -->
                    <div class="text-right col text-success" style="font-size:small;">{{$w->produk->terjual}}
                        terjual
                    </div>
                </div>
            </figcaption>
        </div>
    </div>
    @endforeach
</div> <!-- card-body.// -->
<div class="modal fade rating_modal item_remove_modal" id="berihkanWishlist" tabindex="-1" role="dialog"
    aria-labelledby="myModal2">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Anda Yakin Ingin Menghapus Data Ini</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- end /.modal-header -->

            <div class="modal-body">
                <form method="GET" id="formHapusAlamat">
                    <a href="{{ URL::to('wishlist/clear/'.Auth::id())}}"
                        class="btn btn--icon btn--round btn-danger">Hapus
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                    <button class="btn--round modal_close btn btn-outline-success" data-dismiss="modal">Batal</button>
                </form>
            </div>
            <!-- end /.modal-body -->
        </div>
    </div>
</div>