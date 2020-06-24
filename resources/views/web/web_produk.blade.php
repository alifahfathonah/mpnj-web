@extends('mpnj.layout.main')

@section('title','Market Place PP Nurul Jadid')

@section('content')

<section class="section-content padding-y">
    <div class="container">
        <!-- ============================  FILTER TOP  ================================= -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2"> Your are here: </div> <!-- col.// -->
                    <nav class="col-md-8">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ URL::to('produk') }}">Semua Produk</a></li>
                        </ol>
                    </nav> <!-- col.// -->
                </div> <!-- row.// -->
                <hr>
                <div class="row">
                    <div class="col-md-2">Filter by</div> <!-- col.// -->
                    <div class="col-md-10">
                        <ul class="list-inline">
                            <li class="list-inline-item mr-3 dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                    id="filterByKategori">Kategori</a>
                                <div class="dropdown-menu">
                                    <a href="{{ URL::to('produk') }}" class="dropdown-item">Semua</a>
                                    @foreach($kategori as $k)
                                    <a href="{{ URL::to('produk?kategori='.strtolower($k->nama_kategori)) }}"
                                        class="dropdown-item">{{ $k->nama_kategori }}</a>
                                    @endforeach
                                </div>
                            </li>
                            @if(app('request')->input('kategori') != '' OR app('request')->input('cari') != '')
                            <label>Filter:</label>
                            <select class="list-inline-item mr-3 dropdown" id="price">
                                <option selected>--Harga Produk--</option>
                                <option value="low" {{ app('request')->input('order') == 'low' ? 'selected' : ''  }}>
                                    Termurah</option>
                                <option value="high" {{ app('request')->input('order') == 'high' ? 'selected' : ''  }}>
                                    Termahal</option>
                                <option value="laris"
                                    {{ app('request')->input('order') == 'laris' ? 'selected' : ''  }}>Terlaris</option>
                            </select>
                            @endif
                        </ul>
                    </div> <!-- col.// -->
                </div> <!-- row.// -->
            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
        <!-- ============================ FILTER TOP END.// ================================= -->
        <div class="row">
            @forelse($produk as $p)
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div href="{{ URL::to('produk/'.$p->slug) }}" class="card card-sm card-product-grid shadow-sm">
                    <a href="{{ URL::to('produk/'.$p->slug) }}" class=""> <img class="card-img-top"
                            src="{{ env('FILES_ASSETS').$p->foto_produk[0]->foto_produk }}"> </a>
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
                            <div class="text-right col text-success" style="font-size:small;">{{$p->terjual}} terjual
                            </div>
                        </div>
                    </figcaption>
                </div>
            </div>
            @empty
            <div class="alert alert-warning col-lg-12 col-sm-12 col-md-12 text-center">
                Pencarian Tidak Ditemukan <a href="{{url::to('/')}}" class="btn btn-warning">Kembali ke Beranda</a>
            </div>
            @endforelse
        </div>

        <nav class="mb-4">
            @if($produk->lastPage() > 1)
            <ul class="pagination center">
                @if($produk->currentPage() != $produk->onFirstPage())
                <li class="page-item"><a class="page-link" href="{{ $produk->previousPageUrl() }}">Previous</a></li>
                @endif
                @for($i = 1; $i <= $produk->lastPage(); $i++)
                    <li class="page-item active"><a
                            class="page-link {{ $i == $produk->currentPage() ? 'current' : '' }}"
                            href="{{ $produk->url($i) }}">{{ $i }}</a></li>
                    @endfor
                    @if($produk->currentPage() != $produk->lastPage())
                    <li class="page-item"><a class="page-link" href="{{ $produk->nextPageUrl()  }}">Next</a></li>
                    @endif
            </ul>
            @endif
        </nav>

        <div class="box text-center">
            <p>Menemukan Yang Anda Cari？</p>
            <a href="" class="btn btn-light">Ya</a>
            <a href="" class="btn btn-light">Tidak</a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    $(function() {
        var urlParams = new URLSearchParams(window.location.search);
        var kategoriParams = urlParams.get('kategori');
        $("#filterByKategori").html(camelCase(kategoriParams));

        $('#price').on('change', function() {
            // let urlParams = new URLSearchParams(window.location.search);
            // let kategoriParams = urlParams.has('kategori');
            let cariParams = urlParams.has('cari');
            let filter = $(this).val();

            if (kategoriParams || cariParams) {
                if (urlParams.has('order')) {
                    let order = urlParams.get('order');
                    var newUrl = location.href.replace(order, filter == 'low' ? ('low') : (filter == 'laris' ? ('laris') : ('high')));
                    // urlParams = newUrl;
                    // alert(newUrl);
                    window.location.href = newUrl;
                } else {
                    window.location.href += '&order=' + filter;
                }
            } else {
                alert('Tidak Bisa Melakukan Sorting');
            }
        });
    });

    function camelCase(str) {
        return str.replace(/(?:^|\s)\w/g, function(match) {
            return match.toUpperCase();
        });
    }
</script>
@endpush