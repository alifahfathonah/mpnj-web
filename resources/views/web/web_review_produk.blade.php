@extends('mpnj.layout.main')

@section('title','Market Place PP Nurul Jadid')

@section('content')
<br />
<section class="signup_area section--padding2">
    <div class="container">
        <article class="card card-product-list">
            @if ( session()->has('message') )
            <div class="alert alert-secondary alert-dismissable mr-5 ml-5 mt-2">{{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row no-gutters">
                <aside class="col-md-3 my-auto">
                    <a href="#" class="img-wrap">
                        <img src="{{ asset('assets/foto_produk/'.$produk->foto_produk[0]->foto_produk) }}">
                    </a>
                </aside> <!-- col.// -->
                <div class="col-md-6">
                    <div class="info-main">
                        <a href="#" class="h5 title"> {{ $produk->nama_produk}} </a>
                        <form method="post" action="{{ $review != null ? URL::to('review/produk/update/'.$produk->id_produk) : URL::to('review/produk') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">

                            <label>Bintang</label><br>
                            <label class="custom-control custom-radio">
                                <input type="radio" name="bintang" @if($review != null && $review->bintang == 1) checked="true"
                                       checked="false" @else @endif class="custom-control-input" value="1">
                                <div class="custom-control-label text-warning">
                                    <i class="fa fa-star"></i>
                                </div>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" name="bintang" @if($review != null && $review->bintang == 2) checked="true"
                                       checked="false" @else @endif class="custom-control-input" value="2">
                                <div class="custom-control-label text-warning">
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                </div>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" name="bintang" @if($review != null && $review->bintang == 3) checked="true"
                                       checked="false" @else @endif class="custom-control-input" value="3">
                                <div class="custom-control-label text-warning">
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                </div>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" name="bintang" @if($review != null && $review->bintang == 4) checked="true"
                                       checked="false" @else @endif class="custom-control-input" value="4">
                                <div class="custom-control-label text-warning">
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" name="bintang" @if($review != null && $review->bintang == 5) checked="true"
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
                                @if($review != null && $review->foto_review != null)<small>foto review <a href="{{ asset('assets/foto_review/'.$review->foto_review) }}" target="_blank">disini</a></small>@endif
                            </div>
                            <button type="submit" class="btn btn-danger btn-block">{{ $review != null ? 'Update' : 'Simpan' }}</button>
                        </form>
                    </div> <!-- info-main.// -->
                </div> <!-- col.// -->
                <aside class="col-sm-3">
                    <div class="info-aside" style="text-align:center">
                        <p class="h5 title">{{ Auth::guard(Session::get('role'))->user()->nama_lengkap }}</p>
                        <br />
                        <div class="form-group">
                            <img src="{{ asset('assets/foto_profil_konsumen/'.Auth::guard(Session::get('role'))->user()->foto_profil) }}"
                                class="img-sm rounded-circle border">
                        </div>
                        {{-- @if($review != null )
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                        @else
                        <button type="submit" class="btn btn-primary btn-block">Send</button>
                        @endif --}}
                        <button class="btn btn-light btn-block"><i class="fa fa-heart"></i>
                            <span class="text">Wishlist</span>
                        </button>
                        </form>
                    </div> <!-- info-aside.// -->
                </aside> <!-- col.// -->
            </div> <!-- row.// -->
        </article>
    </div>
</section>
@endsection