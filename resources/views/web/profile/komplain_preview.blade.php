<h5 class="card-title">Komplain Anda</h5>
<div class="card">
    <div class="card-body">
        <div class="user-block">
            <img class="icon icon-xs rounded-circle border"
                src="{{ asset('assets/foto_profil_konsumen/'.Auth::user()->foto_profil) }}" alt="user image">
            <span>
                <a href="#" class="price ">{{Auth::user()->nama_lengkap}}</a>
            </span><br>
            <span>Diajukan Pada - {{$komplain->created_at}}</span>
        </div>
        <!-- /.user-block -->
        <article class="card card-product-list">
            <div class="row no-gutters">
                <aside class="col-md-3">
                    <a href="#" class="img-wrap">
                        <img src="{{ env('FILES_ASSETS').$komplain->produk->foto_produk[0]->foto_produk }}">
                    </a>
                </aside> <!-- col.// -->
                <div class="col-md-6">
                    <div class="info-main">
                        <a href="#" class="h5 title"> {{$komplain->produk->nama_produk}} </a>
                        <div class="rating-wrap mb-3">
                            <b>Keluhan</b>
                            <b style="float: right">Produk {{$komplain->komplain}}</b>
                        </div> <!-- rating-wrap.// -->
                        <p> {{$komplain->deskripsi}}</p>
                    </div> <!-- info-main.// -->
                </div> <!-- col.// -->
                <aside class="col-sm-3">
                    <div class="info-aside" style="text-align:center">
                        <img src="{{ asset('assets/foto_toko/'.$komplain->user->foto_toko) }}" class="border img-md">
                        <p class="text-success">{{$komplain->user->nama_toko}}</p>
                        <br>
                        <p>
                            @if($komplain->status == 'Butuh Direspon')
                            <button class="btn btn-danger btn-block" disabled>Menunggu Respon</button>
                            @elseif($komplain->status == 'Sudah Dibaca')
                            <a href="{{URL::to('komplain/update/'.$komplain->id_complain)}}"
                                class="btn btn-primary btn-block"> Selesai</a>
                            @elseif($komplain->status == 'Selesai')
                            <button class="btn btn-info btn-blcok" disabled>Komplain Teratasi</button>
                            @endif
                            {{-- <a href="#" class="btn btn-primary btn-block"> Details </a> --}}
                        </p>
                    </div> <!-- info-aside.// -->
                </aside> <!-- col.// -->
            </div> <!-- row.// -->
        </article>
        <span>*) Jika komplain anda sudah dibaca dan diproses oleh pelapak, silahkan klik tombol <b>Selesai</b> sebagai
            konfirmasi.</span>
    </div> <!-- card-body.// -->
</div>