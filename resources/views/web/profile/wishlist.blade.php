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
                        <form action="{{ URL::to('keranjang')}}" method="post">
                            @csrf
                            <input type="hidden" name="id_produk" id="id_produk" value="{{ $w->produk->id_produk }}">
                            <input type="hidden" name="harga_jual" id="harga_jual" value="{{ $w->produk->harga_jual }}">
                            <input type="hidden" class="form-control input-number" id="jumlah" name="jumlah" value="1">
                            <button type="submit" id="btnKeranjang" class="btn btn-primary btn-sm" data-toggle="tooltip"
                                title="" data-original-title="Masukkan Keranjang">
                                <i class="fas fa-plus"></i>
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </form>
                    </div>
                    <!-- selesaikan API nya ya -->
                    <a href="{{ URL::to('wishlist/delete/'.$w->produk->id_produk)}}" class="btn btn-danger btn-sm"
                        data-toggle="tooltip" title="" data-original-title="Hapus Wishlist"> <i class="fa fa-times"></i>
                    </a>
                </div>
            </figcaption>
        </div>
    </div>
    @endforeach
    @else
    <article class="container">
        <div class="row no-gutters">
            <aside class="col-md-4 text-center" style="align-self: center">
                <a href="{{ URL::to('/') }}" style="height: 200px; width: 200px">
                    <img src="{{ asset('assets/logo/belanj-hijau.png') }}" style="height: 100px; width: 200px">
                </a>
            </aside> <!-- col.// -->
            <div class="col-md-8">
                <div class="info-main">
                    <h4 class="h5 title mr-5"> Anda Bisa Melihat Wishlist Anda di Sini</h4>
                    <a href="{{ URL::to('produk') }}" class="btn btn-primary btn-block" type="submit">Cari Produk <i
                            class="fa fa-search"></i></a>
                </div> <!-- info-main.// -->
            </div> <!-- col.// -->
        </div> <!-- row.// -->
    </article>
    @endif
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