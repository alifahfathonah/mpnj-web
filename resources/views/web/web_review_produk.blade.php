@extends('mpnj.layout.main')

@section('title','Produk | Review')

@section('content')
<br />
<section class="signup_area section--padding2">
    <div class="container">
        <article class="card card-product-list" style="padding: 2%; border-radius: 10px">
            @if ( session()->has('message') )
            <div class="alert alert-secondary alert-dismissable ">{{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif(session('tambahWishlistSukses'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('tambahWishlistSukses') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif(session('hapusWishlistSukses'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('hapusWishlistSukses') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row no-gutters">
                <aside class="col-md-3 my-auto">
                    <a href="{{ URL::to('produk/'.$produk->slug) }}" class="img-wrap">
                        <img src="{{ env('FILES_ASSETS').$produk->foto_produk[0]->foto_produk }}">
                    </a>
                </aside> <!-- col.// -->
                <div class="col-md-6">
                    <div class="info-main">
                        <a href="{{ URL::to('produk/'.$produk->slug) }}" class="h5 title"> {{ $produk->nama_produk}}
                        </a>
                        <form method="post"
                            action="{{ $review != null ? URL::to('review/produk/update/'.$produk->id_produk) : URL::to('review/produk') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">

                            <label>Bintang</label><br>
                            <label class="custom-control custom-radio">
                                <input type="radio" name="bintang" @if($review !=null && $review->bintang == 1)
                                checked="true"
                                checked="false" @else @endif class="custom-control-input" value="1">
                                <div class="custom-control-label text-warning">
                                    <i class="fa fa-star"></i>
                                </div>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" name="bintang" @if($review !=null && $review->bintang == 2)
                                checked="true"
                                checked="false" @else @endif class="custom-control-input" value="2">
                                <div class="custom-control-label text-warning">
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                </div>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" name="bintang" @if($review !=null && $review->bintang == 3)
                                checked="true"
                                checked="false" @else @endif class="custom-control-input" value="3">
                                <div class="custom-control-label text-warning">
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                </div>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" name="bintang" @if($review !=null && $review->bintang == 4)
                                checked="true"
                                checked="false" @else @endif class="custom-control-input" value="4">
                                <div class="custom-control-label text-warning">
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" name="bintang" @if($review !=null && $review->bintang == 5)
                                checked="true"
                                checked="false" @else @endif class="custom-control-input" value="5">
                                <div class="custom-control-label text-warning">
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                </div>
                            </label>

                            <div class="form-group">
                                <textarea name="review" class="form-control" rows="3"
                                    placeholder="Beri komentar Barang yang Sesuai.">{{ $review != null ? $review->review : '' }}
                                    </textarea>
                            </div>
                            <div class="form-group">
                                <label>{{ $review != null && $review->foto_review != null ? 'Ganti Foto Produk' : 'Foto Produk' }}</label><br>
                                <input type="file" name="foto_review" id="foto_review" class="form-control">
                                @if($review != null && $review->foto_review != null)<small>foto review <a
                                        href="{{ asset('assets/foto_review/'.$review->foto_review) }}"
                                        target="_blank">disini</a></small>@endif
                                @if($errors->has('foto_review'))
                                <small style="color: red">{{ $errors->first('foto_review') }}</small> @endif
                            </div>
                            <button type="submit"
                                class="btn btn-danger btn-block">{{ $review != null ? 'Update' : 'Simpan' }}</button>
                        </form>
                    </div> <!-- info-main.// -->
                </div> <!-- col.// -->
                <aside class="col-sm-3">
                    <div class="info-aside" style="text-align:center">
                        <p class="h5 title">{{ Auth::user()->nama_lengkap }}</p>
                        <br />
                        <div class="form-group">
                            <img src="{{ asset('assets/foto_profil_konsumen/'.Auth::user()->foto_profil) }}"
                                class="img-sm rounded-circle border">
                        </div>
                        @if($produk->wishlists->count() > 0)
                        <a href="{{ URL::to('wishlist/delete/'.$produk->id_produk)}}" class="btn btn-light btn-block"
                            data-original-title="Hapus Wishlist" title="" data-toggle="tooltip"> <i
                                class="fas fa-heart text-primary"></i> Hapus Wishlist</a>
                        @else
                        <a href="{{ URL::to('wishlist/add/'.$produk->id_produk)}}" class="btn btn-light btn-block"
                            data-original-title="Tambah Ke Wishlist" title="" data-toggle="tooltip"> <i
                                class="fas fa-heart"></i> Tambah Wishlist</a>
                        @endif
                        </form>
                    </div> <!-- info-aside.// -->
                </aside> <!-- col.// -->
            </div> <!-- row.// -->
        </article>
    </div>
</section>
@endsection