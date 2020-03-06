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
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kategori</a>
                                <div class="dropdown-menu">
                                    @foreach($kategori as $k)
                                    <a href="{{ URL::to('produk?kategori='.strtolower($k->nama_kategori)) }}" class="dropdown-item">{{ $k->nama_kategori }}</a>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </div> <!-- col.// -->
                </div> <!-- row.// -->
            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
        <!-- ============================ FILTER TOP END.// ================================= -->

        <header class="mb-3">
            <div class="form-inline filter__option filter--select" style="
                                    @if(app('request')->input('kategori') != '' OR app('request')->input('cari') != '')
                                        display: inline-block;
                                    @else
                                        display: none;
                                    @endif
                                ">
                <select class="mr-2 form-control" id="price">
                    <option selected>--Harga Produk--</option>
                    <option value="low" {{ app('request')->input('order') == 'low' ? 'selected' : ''  }}>Termurah</option>
                    <option value="high" {{ app('request')->input('order') == 'high' ? 'selected' : ''  }}>Termahal</option>
                </select>
            </div>
        </header><!-- sect-heading -->
        <div class="row">
            @foreach($produk as $p)
            <div class="col-md-3">
                <figure class="card card-product-grid">
                    <div class="img-wrap">
                        <img src="{{ asset('assets/foto_produk/'.$p->foto_produk[0]->foto_produk) }}" alt="Product Image">
                    </div> <!-- img-wrap.// -->
                    <figcaption class="info-wrap">
                        <a href="{{ URL::to('produk/'.$p->id_produk) }}" class="title mb-2">{{ $p->nama_produk }}</a>
                        <div class="price-wrap">
                            @if($p->diskon == 0)
                            @currency($p->harga_jual)
                            @else
                            <strike style="color: red">
                                @currency($p->harga_jual)
                            </strike> @currency($p->harga_jual - ($p->diskon / 100 * $p->harga_jual))
                            @endif
                        </div> <!-- price-wrap.// -->
                        <a href="{{ URL::to('pelapak/'.$p->pelapak->username )}}" class="title text-dark">{{ $p->pelapak->nama_toko }}</a>
                        <hr>
                        <a href="{{ URL::to('produk/'.$p->id_produk) }}" class="btn btn-outline-primary"> <i class="fa fa-angle-double-right"></i> Detail Produk </a>
                    </figcaption>
                </figure>
            </div>
            @endforeach
        </div>

        <nav class="mb-4">
            @if($produk->lastPage() > 1)
            <ul class="pagination center">
                @if($produk->currentPage() != $produk->onFirstPage())
                <li class="page-item"><a class="page-link" href="{{ $produk->previousPageUrl() }}">Previous</a></li>
                @endif
                @for($i = 1; $i <= $produk->lastPage(); $i++)
                    <li class="page-item active"><a class="page-link {{ $i == $produk->currentPage() ? 'current' : '' }}" href="{{ $produk->url($i) }}">{{ $i }}</a></li>
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
        $('#price').on('change', function() {
            let urlParams = new URLSearchParams(window.location.search);
            let kategoriParams = urlParams.has('kategori');
            let cariParams = urlParams.has('cari');

            if (kategoriParams) {
                if (urlParams.has('order')) {
                    let order = urlParams.get('order');
                    var newUrl = location.href.replace(order, order == 'low' ? 'high' : 'low');
                    // urlParams = newUrl;
                    // alert(newUrl);
                    window.location.href = newUrl;
                } else {
                    window.location.href += '&order=' + $(this).val();
                }
                // let newUrl = window.location.href += '&order='+$(this).val();
            } else if (cariParams) {
                if (urlParams.has('order')) {
                    let order = urlParams.get('order');
                    var newUrl = location.href.replace(order, order == 'low' ? 'high' : 'low');
                    // urlParams = newUrl;
                    // alert(newUrl);
                    window.location.href = newUrl;
                } else {
                    window.location.href += '&order=' + $(this).val();
                }
            } else {
                alert('Tidak Bisa Melakukan Sorting');
            }
        });
    });
</script>
@endpush