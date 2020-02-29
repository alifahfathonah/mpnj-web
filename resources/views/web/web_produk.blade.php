@extends('web.web_master')

@section('web_konten')
    <section class="search-wrapper">
        <div class="search-area2 bgimage">
            <div class="bg_image_holder" style="background-image: url({{ asset('assets/images/search.jpg') }}); opacity: 1;">
                <img src="images/search.jpg" alt="images/search.jpg">
            </div>
            <div class="container content_above">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="search">
                            <div class="search__title">
                                <h3>
                                    Temukan Barang Barang Terbaik yang Anda Cari Disini!!!
                                </h3>
                            </div>
                            <div class="search__field">
                                <form action="{{ URL::to('/produk') }}">
                                    <div class="field-wrapper">
                                        <input class="relative-field rounded" name="cari" type="text" placeholder="Cari Produk Disini">
                                        <button class="btn btn--round" type="submit">Search</button>
                                    </div>
                                </form>
                            </div>
                            <div class="breadcrumb">
                                <ul>
                                    <li>
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="active">
                                        <a href="#">Semua Produk</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.search-area2 -->
    </section>

    <div class="filter-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="filter-bar filter--bar2">
                        <div class="pull-right">
                            <div class="filter__option filter--text pull-left">
{{--                                <a href="#">New Products</a>--}}
{{--                                <a href="#">Popular Products</a>--}}
                            </div>
                            <div class="filter__option filter--select">
                                <div class="select-wrap">
                                    <select name="price" id="price">
                                        <option selected>-- Sorting Harga --</option>
                                        <option value="high" {{ app('request')->input('order') == 'high' ? 'selected' : ''  }}>Tinggi ke Rendah</option>
                                        <option value="low" {{ app('request')->input('order') == 'low' ? 'selected' : ''  }}>Rendah ke Tinggi</option>
                                    </select>
                                    <span class="lnr lnr-chevron-down"></span>
                                </div>
                            </div>
{{--                            <div class="filter__option filter--select">--}}
{{--                                <div class="select-wrap">--}}
{{--                                    <select name="price">--}}
{{--                                        <option value="12">12 Items per page</option>--}}
{{--                                        <option value="15">15 Items per page</option>--}}
{{--                                        <option value="25">25 Items per page</option>--}}
{{--                                    </select>--}}
{{--                                    <span class="lnr lnr-chevron-down"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="filter__option filter--layout">--}}
{{--                                <a href="category-grid.html">--}}
{{--                                    <div class="svg-icon">--}}
{{--                                        <img class="svg" src="{{ asset('assets/images/svg/grid.svg') }}" alt="it's just a layout control folks!">--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <a href="category-list.html">--}}
{{--                                    <div class="svg-icon">--}}
{{--                                        <img class="svg" src="{{ asset('assets/images/svg/list.svg') }}" alt="it's just a layout control folks!">--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <!-- end filter-bar -->
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end filter-bar -->
        </div>
    </div>

    <section class="products section--padding2">
        <!-- start container -->
        <div class="container">
            <!-- start .row -->
            <div class="row">
                <!-- start .col-md-3 -->
                <div class="col-lg-3">
                    <!-- start aside -->
                    <aside class="sidebar product--sidebar">
                        <div class="sidebar-card card--category">
                            <a class="card-title" href="#collapse1" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                <h4>Kategori
                                    <span class="lnr lnr-chevron-down"></span>
                                </h4>
                            </a>
                            <div class="collapse show collapsible-content" id="collapse1">
                                <ul class="card-content">
                                    @foreach($kategori as $k)
                                        <li>
                                            <a href="{{ URL::to('produk?kategori='.strtolower($k->nama_kategori)) }}">
                                                <span class="lnr lnr-chevron-right"></span>{{ $k->nama_kategori }}
                                                <span class="item-count">0</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- end /.collapsible_content -->
                        </div>
                        <!-- end /.sidebar-card -->
                    </aside>
                    <!-- end aside -->
                </div>
                <!-- end /.col-md-3 -->

                <!-- start col-md-9 -->
                <div class="col-lg-9">
                    <div class="row">
                        @foreach($produk as $p)
                            <div class="col-lg-4 col-md-6">
                                <!-- start .single-product -->
                                <div class="product product--card product--card-small">

                                    <div class="product__thumbnail">
                                        <img src="{{ asset('assets/foto_produk/'.$p->foto_produk[0]->foto_produk) }}" alt="Product Image" height="270px">
                                        <div class="prod_btn">
                                            <a href="{{ URL::to('produk/'.$p->id_produk) }}" class="transparent btn--sm btn--round">Detail</a>
                                        </div>
                                        <!-- end /.prod_btn -->
                                    </div>
                                    <!-- end /.product__thumbnail -->

                                    <div class="product-desc">
                                        <a href="{{ URL::to('produk/'.$p->id_produk) }}" class="product_title">
                                            <p class="font-weight-bold ">{{ $p->nama_produk }}</p>
                                        </a>
                                    </div>
                                    <!-- end /.product-desc -->

                                    <div class="product-purchase">
                                        <div class="price_love">
                                            @if($p->diskon == 0)
                                                <span class="font-weight-bold ">@currency($p->harga_jual)</span>
                                            @else
                                                <span class="font-weight-bold ">
                                                    <strike><p class="text-danger font-weight-bold">@currency($p->harga_jual)</p></strike> @currency($p->harga_jual - ($p->diskon / 100 * $p->harga_jual))
                                                </span>
                                            @endif
                                        </div>
                                        <div class="sell">
                                            <p>
                                                <span class="fa fa-cart-arrow-down"></span>
                                                <span>{{ $p->terjual }}</span>
                                            </p>
                                        </div>
{{--                                        <a href="{{ URL::to('produk?kategori='.strtolower($p->kategori->nama_kategori)) }}">--}}
{{--                                            <span class="lnr lnr-book"></span>{{ $p->kategori->nama_kategori }}--}}
{{--                                        </a>--}}
                                    </div>
                                    <!-- end /.product-purchase -->
                                </div>
                                <!-- end /.single-product -->
                            </div>
                        @endforeach
                        <!-- end /.col-md-4 -->

                    </div>
                    {{ $produk->links() }}
                </div>
                <!-- end /.col-md-9 -->
            </div>
            <!-- end /.row -->

{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="pagination-area categorised_item_pagination">--}}
{{--                        <nav class="navigation pagination" role="navigation">--}}
{{--                            @if($produk->lastPage() > 1)--}}
{{--                                <div class="nav-links page-number">--}}
{{--                                    @if($produk->currentPage() != $produk->onFirstPage())--}}
{{--                                        <a class="prev page-numbers" href="{{ $produk->previousPageUrl() }}">--}}
{{--                                            <span class="lnr lnr-arrow-left"></span>--}}
{{--                                        </a>--}}
{{--                                    @endif--}}
{{--                                    @for($i = 1; $i <= $produk->lastPage(); $i++)--}}
{{--                                        <a class="page-numbers {{ $i == $produk->currentPage() ? 'current' : '' }}" href="{{ $produk->url($i) }}">{{ $i }}</a>--}}
{{--                                    @endfor--}}
{{--                                    @if($produk->currentPage() != $produk->lastPage())--}}
{{--                                        <a class="next page-numbers" href="{{ $produk->nextPageUrl()  }}">--}}
{{--                                            <span class="lnr lnr-arrow-right"></span>--}}
{{--                                        </a>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </nav>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- end /.row -->
        </div>
        <!-- end /.container -->

    </section>
@endsection

@push('scripts')
    <script>
        $(function () {
           $('#price').on('change', function () {
               let urlParams = new URLSearchParams(window.location.search);
               let kategoriParams = urlParams.has('kategori');

               if (kategoriParams) {
                   if (urlParams.has('order')) {
                       let order = urlParams.get('order');
                       var newUrl = location.href.replace(order, order == 'low' ? 'high' : 'low');
                       // urlParams = newUrl;
                       // alert(newUrl);
                       window.location.href = newUrl;
                   } else {
                       window.location.href += '&order='+$(this).val();
                   }
                   // let newUrl = window.location.href += '&order='+$(this).val();
               } else {
                   alert('Tidak Bisa Melakukan Sorting');
               }
           });
        });
    </script>
@endpush