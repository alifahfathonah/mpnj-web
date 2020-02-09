<div class="row">
    <div class="col-lg-12">

        <div class="row">
            <div class="col-md-12">
                <div class="filter-bar clearfix filter-bar2">

                    <div class="pull-right">
                        <div class="filter__option filter--dropdown">
                            <a href="#" class="dropdown-trigger dropdown-toggle" id="drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories
                                <span class="lnr lnr-chevron-down"></span>
                            </a>
                            <ul class="custom_dropdown custom_drop2 dropdown-menu" aria-labelledby="drop1">
                                <li>
                                    <a href="#">Wordpress
                                        <span>35</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Landing Page
                                        <span>45</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Psd Template
                                        <span>13</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Plugins
                                        <span>08</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">HTML Template
                                        <span>34</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Components
                                        <span>78</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="filter__option filter--dropdown" style="margin-right: 30px">
                            <a href="#" id="drop2" class="dropdown-trigger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter By
                                <span class="lnr lnr-chevron-down"></span>
                            </a>
                            <ul class="custom_dropdown dropdown-menu" aria-labelledby="drop2">
                                <li>
                                    <a href="#">Trending items</a>
                                </li>
                                <li>
                                    <a href="#">Popular items</a>
                                </li>
                                <li>
                                    <a href="#">New items </a>
                                </li>
                                <li>
                                    <a href="#">Best seller </a>
                                </li>
                                <li>
                                    <a href="#">Best rating </a>
                                </li>
                            </ul>
                        </div>
                        <div class="filter__option filter--text pull-left">
                            <p>
                                <span></span> Daftar Produk</p>
                        </div>
                    </div>
                    <!-- end /.pull-right -->
                </div>
                <!-- end filter-bar -->
            </div>
            <!-- end /.col-md-12 -->

            @foreach($produk as $p)
                <div class="col-lg-4 col-md-6">
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
                                <p>{{ $p->nama_produk }}</p>
                            </a>
                        </div>
                        <!-- end /.product-desc -->

                        <div class="product-purchase">
                            <div class="price_love">
                                <span>@currency($p->harga_jual)</span>
                            </div>
                            <a href="{{ URL::to('produk?kategori='.strtolower($p->kategori->nama_kategori)) }}">
                                <span class="lnr lnr-book"></span>{{ $p->kategori->nama_kategori }}</a>
                        </div>
                        <!-- end /.product-purchase -->
                    </div>
                </div>
            @endforeach
        </div>
        <!-- end /.row -->

        <div class="pagination-area pagination--right">
            <nav class="navigation pagination" role="navigation">
                <div class="nav-links">
                    <a class="prev page-numbers" href="#">
                        <span class="lnr lnr-arrow-left"></span>
                    </a>
                    <a class="page-numbers current" href="#/">1</a>
                    <a class="page-numbers" href="#">2</a>
                    <a class="page-numbers" href="#">3</a>
                    <a class="next page-numbers" href="#">
                        <span class="lnr lnr-arrow-right"></span>
                    </a>
                </div>
            </nav>
        </div>
    </div>
</div>