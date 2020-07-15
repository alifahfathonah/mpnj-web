<div class="card">
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#all" data-toggle="tab">Semua</a></li>
            <li class="nav-item"><a class="nav-link" href="#respon" data-toggle="tab">Butuh Direspon</a></li>
            <li class="nav-item"><a class="nav-link" href="#baca" data-toggle="tab">Sudah Dibaca</a></li>
            <li class="nav-item"><a class="nav-link" href="#selesai" data-toggle="tab">Selesai</a></li>
        </ul>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active" id="all">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead class="text">
                            <tr class="small">
                                <th scope="col" width="120">Kode Transaksi</th>
                                <th scope="col">Toko</th>
                                <th scope="col">Product</th>
                                <th scope="col">Komplain</th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($komplain as $k)
                            <tr>
                                <td> <a>{{$k->transaksi->kode_transaksi}}</a> </td>
                                <td>
                                    <figure class="itemside">
                                        <div class="aside"><img
                                                src="{{ asset('assets/foto_toko/'.$k->user->foto_toko) }}"
                                                class="img-xs border">
                                        </div>
                                        <figcaption class="info">
                                            <a href="" class="title text-dark">{{$k->user->nama_toko}}</a>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td>
                                    <figure class="itemside">
                                        <div class="aside"><img
                                                src="{{ env('FILES_ASSETS').$k->produk->foto_produk[0]->foto_produk }}"
                                                class="img-xs border">
                                        </div>
                                        <figcaption class="info">
                                            <a href="" class="title text-dark">{{$k->produk->nama_produk}}</a>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td>
                                    @if ($k->komplain == 'Tidak Sesuai')
                                    <var class="price">Tidak Sesuai Deskripsi</var>
                                    @elseIf($k->komplain == 'Tidak Lengkap')
                                    <var class="price">Produk Tidak Lengkap</var>
                                    @elseIf($k->komplain == 'Rusak')
                                    <var class="price">Produk Rusak</var>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a data-original-title="Save to Wishlist" title="" href="" class="btn btn-light"
                                        data-toggle="tooltip"> <i class="fa fa-heart"></i></a>
                                    <a href="" class="btn btn-light"> Remove</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="respon">
                @if($komplain_respon != null)
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead class="text">
                            <tr class="small">
                                <th scope="col" width="120">Kode Transaksi</th>
                                <th scope="col">Toko</th>
                                <th scope="col">Product</th>
                                <th scope="col">Komplain</th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($komplain_respon as $k)
                            <tr>
                                <td> <a>{{$k->transaksi->kode_transaksi}}</a> </td>
                                <td>
                                    <figure class="itemside">
                                        <div class="aside"><img
                                                src="{{ asset('assets/foto_toko/'.$k->user->foto_toko) }}"
                                                class="img-xs border">
                                        </div>
                                        <figcaption class="info">
                                            <a href="" class="title text-dark">{{$k->user->nama_toko}}</a>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td>
                                    <figure class="itemside">
                                        <div class="aside"><img
                                                src="{{ env('FILES_ASSETS').$k->produk->foto_produk[0]->foto_produk }}"
                                                class="img-xs border">
                                        </div>
                                        <figcaption class="info">
                                            <a href="" class="title text-dark">{{$k->produk->nama_produk}}</a>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td>
                                    @if ($k->komplain == 'Tidak Sesuai')
                                    <var class="price">Tidak Sesuai Deskripsi</var>
                                    @elseIf($k->komplain == 'Tidak Lengkap')
                                    <var class="price">Produk Tidak Lengkap</var>
                                    @elseIf($k->komplain == 'Rusak')
                                    <var class="price">Produk Rusak</var>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a data-original-title="Save to Wishlist" title="" href="" class="btn btn-light"
                                        data-toggle="tooltip"> <i class="fa fa-heart"></i></a>
                                    <a href="" class="btn btn-light"> Remove</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="info-main">
                    <h4 class="h5 title mr-5"> Belum Ada Komplain Direspon</h4>
                </div>
                @endif
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="baca">
                @if($komplain_dibaca != null)
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead class="text">
                            <tr class="small">
                                <th scope="col" width="120">Kode Transaksi</th>
                                <th scope="col">Toko</th>
                                <th scope="col">Product</th>
                                <th scope="col">Komplain</th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($komplain_dibaca as $k)
                            <tr>
                                <td> <a>{{$k->transaksi->kode_transaksi}}</a> </td>
                                <td>
                                    <figure class="itemside">
                                        <div class="aside"><img
                                                src="{{ asset('assets/foto_toko/'.$k->user->foto_toko) }}"
                                                class="img-xs border">
                                        </div>
                                        <figcaption class="info">
                                            <a href="" class="title text-dark">{{$k->user->nama_toko}}</a>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td>
                                    <figure class="itemside">
                                        <div class="aside"><img
                                                src="{{ env('FILES_ASSETS').$k->produk->foto_produk[0]->foto_produk }}"
                                                class="img-xs border">
                                        </div>
                                        <figcaption class="info">
                                            <a href="" class="title text-dark">{{$k->produk->nama_produk}}</a>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td>
                                    @if ($k->komplain == 'Tidak Sesuai')
                                    <var class="price">Tidak Sesuai Deskripsi</var>
                                    @elseIf($k->komplain == 'Tidak Lengkap')
                                    <var class="price">Produk Tidak Lengkap</var>
                                    @elseIf($k->komplain == 'Rusak')
                                    <var class="price">Produk Rusak</var>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a data-original-title="Save to Wishlist" title="" href="" class="btn btn-light"
                                        data-toggle="tooltip"> <i class="fa fa-heart"></i></a>
                                    <a href="" class="btn btn-light"> Remove</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="info-main">
                    <h4 class="h5 title mr-5"> Belum Ada Komplain Dibaca</h4>
                </div>
                @endif
            </div>
            <div class="tab-pane" id="selesai">
                @if($komplain_selesai != null)
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead class="text">
                            <tr class="small">
                                <th scope="col" width="120">Kode Transaksi</th>
                                <th scope="col">Toko</th>
                                <th scope="col">Product</th>
                                <th scope="col">Komplain</th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($komplain_selesai as $k)
                            <tr>
                                <td> <a>{{$k->transaksi->kode_transaksi}}</a> </td>
                                <td>
                                    <figure class="itemside">
                                        <div class="aside"><img
                                                src="{{ asset('assets/foto_toko/'.$k->user->foto_toko) }}"
                                                class="img-xs border">
                                        </div>
                                        <figcaption class="info">
                                            <a href="" class="title text-dark">{{$k->user->nama_toko}}</a>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td>
                                    <figure class="itemside">
                                        <div class="aside"><img
                                                src="{{ env('FILES_ASSETS').$k->produk->foto_produk[0]->foto_produk }}"
                                                class="img-xs border">
                                        </div>
                                        <figcaption class="info">
                                            <a href="" class="title text-dark">{{$k->produk->nama_produk}}</a>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td>
                                    @if ($k->komplain == 'Tidak Sesuai')
                                    <var class="price">Tidak Sesuai Deskripsi</var>
                                    @elseIf($k->komplain == 'Tidak Lengkap')
                                    <var class="price">Produk Tidak Lengkap</var>
                                    @elseIf($k->komplain == 'Rusak')
                                    <var class="price">Produk Rusak</var>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a data-original-title="Save to Wishlist" title="" href="" class="btn btn-light"
                                        data-toggle="tooltip"> <i class="fa fa-heart"></i></a>
                                    <a href="" class="btn btn-light"> Remove</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="info-main">
                    <h4 class="h5 title mr-5"> Belum Ada Komplain Selesai</h4>
                </div>
                @endif
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->
</div>
<!-- /.nav-tabs-custom -->