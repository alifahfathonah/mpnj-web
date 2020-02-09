<div class="row">
    <div class="col-md-4 col-sm-4">
        <div class="author-info mcolorbg4">
            <p>Total Produk</p>
            <h3>{{ COUNT($produk) }}</h3>
        </div>
    </div>
    <!-- end /.col-md-4 -->

    <div class="col-md-4 col-sm-4">
        <div class="author-info pcolorbg">
            <p>Total sales</p>
            <h3>36,957</h3>
        </div>
    </div>
    <!-- end /.col-md-4 -->

    <div class="col-md-4 col-sm-4">
        <div class="author-info scolorbg">
            <p>Total Ratings</p>
            <div class="rating product--rating">
                <ul>
                    <li>
                        <span class="fa fa-star"></span>
                    </li>
                    <li>
                        <span class="fa fa-star"></span>
                    </li>
                    <li>
                        <span class="fa fa-star"></span>
                    </li>
                    <li>
                        <span class="fa fa-star"></span>
                    </li>
                    <li>
                        <span class="fa fa-star-half-o"></span>
                    </li>
                </ul>
                <span class="rating__count">(26)</span>
            </div>
        </div>
    </div>
    <!-- end /.col-md-4 -->

    <div class="col-md-12 col-sm-12">
        <div class="author_module">
            <img src="{{ asset('assets/images/authcvr.jpg') }}" alt="author image">
        </div>

        <div class="author_module about_author">
            <h2>About
                <span>{{ $pelapak->username }}</span>
            </h2>
            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattisleo
                quam aliquet congue. Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo
                ut scelerisque the mattisleo quam aliquet congue. Nunc placerat mi id nisi interdum mollis.
                Prae sent pharetra, justo ut scelerisque the mattisleo quam aliquet congue.</p>
            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattisleo
                quam aliquet congue. Nunc placerat mi id nisi interdum mollis. Praesent pharetra.</p>
        </div>
    </div>
</div>
<!-- end /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="product-title-area">
            <div class="product__title">
                <h2>Produk Terbaru</h2>
            </div>

            <a href="{{ URL::to('pelapak/'.$pelapak->username.'/produk') }}" class="btn btn--sm">Lihat Semua Produk</a>
        </div>
        <!-- end /.product-title-area -->
    </div>
    <!-- end /.col-md-12 -->

    <!-- start .col-md-4 -->
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
<!-- end /.col-md-4 -->
</div>
<!-- end /.row -->