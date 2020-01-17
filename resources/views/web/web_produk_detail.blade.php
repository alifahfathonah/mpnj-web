@extends('web.web_master')

@section('web_konten')
<!--================================
        START BREADCRUMB AREA
    =================================-->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb">
                    <ul>
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <a href="/kategori/{{ strtolower($produk->kategori->nama_kategori) }}">{{ $produk->kategori->nama_kategori }}</a>
                        </li>
                        <li class="active">
                            <a href="#">{{ $produk->nama_produk }}</a>
                        </li>
                    </ul>
                </div>
                <h1 class="page-title">{{ $produk->nama_produk }}</h1>
            </div>
            <!-- end /.col-md-12 -->
        </div>
        <!-- end /.row -->
    </div>
    <!-- end /.container -->
</section>
<!--================================
        END BREADCRUMB AREA
    =================================-->

<!--============================================
        START SINGLE PRODUCT DESCRIPTION AREA
    ==============================================-->
<section class="single-product-desc">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="item-preview">
                    <div class="item__preview-slider">
                        <div class="prev-slide">
                            <img src="{{ asset('assets/foto_produk/'.$produk->foto_produk[0]->foto_produk) }}" alt="Keep calm this isn't the end of the world, the preview is just missing." width="750" height="430">
                        </div>
                        {{-- <div class="prev-slide">
                            <img src="images/itprv.jpg"
                                alt="Keep calm this isn't the end of the world, the preview is just missing.">
                        </div>
                        <div class="prev-slide">
                            <img src="images/itprv.jpg"
                                alt="Keep calm this isn't the end of the world, the preview is just missing.">
                        </div>
                        <div class="prev-slide">
                            <img src="images/itprv.jpg"
                                alt="Keep calm this isn't the end of the world, the preview is just missing.">
                        </div>
                        <div class="prev-slide">
                            <img src="images/itprv.jpg"
                                alt="Keep calm this isn't the end of the world, the preview is just missing.">
                        </div>
                        <div class="prev-slide">
                            <img src="images/itprv.jpg"
                                alt="Keep calm this isn't the end of the world, the preview is just missing.">
                        </div>
                        <div class="prev-slide">
                            <img src="images/itprv.jpg"
                                alt="Keep calm this isn't the end of the world, the preview is just missing.">
                        </div>
                        <div class="prev-slide">
                            <img src="images/itprv.jpg"
                                alt="Keep calm this isn't the end of the world, the preview is just missing.">
                        </div>
                        <div class="prev-slide">
                            <img src="images/itprv.jpg"
                                alt="Keep calm this isn't the end of the world, the preview is just missing.">
                        </div>
                        <div class="prev-slide">
                            <img src="images/itprv.jpg"
                                alt="Keep calm this isn't the end of the world, the preview is just missing.">
                        </div> --}}
                    </div>
                    <!-- end /.item--preview-slider -->

                    <div class="item__preview-thumb">
                        <div class="prev-thumb">
                            <div class="thumb-slider">
                                <div class="item-thumb">
                                    <img src="images/thumb1.jpg" alt="This is the thumbnail of the item">
                                </div>
                                <div class="item-thumb">
                                    <img src="images/thumb2.jpg" alt="This is the thumbnail of the item">
                                </div>
                                <div class="item-thumb">
                                    <img src="images/thumb3.jpg" alt="This is the thumbnail of the item">
                                </div>
                                <div class="item-thumb">
                                    <img src="images/thumb4.jpg" alt="This is the thumbnail of the item">
                                </div>
                                <div class="item-thumb">
                                    <img src="images/thumb5.jpg" alt="This is the thumbnail of the item">
                                </div>
                                <div class="item-thumb">
                                    <img src="images/thumb1.jpg" alt="This is the thumbnail of the item">
                                </div>
                                <div class="item-thumb">
                                    <img src="images/thumb2.jpg" alt="This is the thumbnail of the item">
                                </div>
                                <div class="item-thumb">
                                    <img src="images/thumb3.jpg" alt="This is the thumbnail of the item">
                                </div>
                                <div class="item-thumb">
                                    <img src="images/thumb4.jpg" alt="This is the thumbnail of the item">
                                </div>
                                <div class="item-thumb">
                                    <img src="images/thumb5.jpg" alt="This is the thumbnail of the item">
                                </div>
                            </div>
                            <!-- end /.thumb-slider -->

                            <div class="prev-nav thumb-nav">
                                <span class="lnr nav-left lnr-arrow-left"></span>
                                <span class="lnr nav-right lnr-arrow-right"></span>
                            </div>
                            <!-- end /.prev-nav -->
                        </div>

                        <div class="item-action">
                            <div class="action-btns">
                                <a href="#" class="btn btn--round btn--lg">Live Preview</a>
                                <a href="#" class="btn btn--round btn--lg btn--icon">
                                    <span class="lnr lnr-heart"></span>Add To Favorites</a>
                            </div>
                        </div>
                        <!-- end /.item__action -->
                    </div>
                    <!-- end /.item__preview-thumb-->


                </div>
                <!-- end /.item-preview-->

                <div class="item-info">
                    <div class="item-navigation">
                        <ul class="nav nav-tabs">
                            <li>
                                <a href="#product-details" class="active" aria-controls="product-details" role="tab" data-toggle="tab">Item Details</a>
                            </li>
                            <li>
                                <a href="#product-comment" aria-controls="product-comment" role="tab" data-toggle="tab">Comments </a>
                            </li>
                            <li>
                                <a href="#product-review" aria-controls="product-review" role="tab" data-toggle="tab">Reviews
                                    <span>(35)</span>
                                </a>
                            </li>
                            <li>
                                <a href="#product-support" aria-controls="product-support" role="tab" data-toggle="tab">Support</a>
                            </li>
                            <li>
                                <a href="#product-faq" aria-controls="product-faq" role="tab" data-toggle="tab">item
                                    FAQ</a>
                            </li>
                        </ul>
                    </div>
                    <!-- end /.item-navigation -->

                    <div class="tab-content">
                        <div class="fade show tab-pane product-tab active" id="product-details">
                            <div class="tab-content-wrapper">
                                {{ $produk->keterangan }}
                            </div>
                        </div>
                        <!-- end /.tab-content -->

                        <div class="fade tab-pane product-tab" id="product-comment">
                            <div class="thread">
                                <ul class="media-list thread-list">
                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m1.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="media-heading">
                                                        <a href="author.html">
                                                            <h4>Themexylum</h4>
                                                        </a>
                                                        <span>9 Hours Ago</span>
                                                    </div>
                                                    <span class="comment-tag buyer">Purchased</span>
                                                    <a href="#" class="reply-link">Reply</a>
                                                </div>
                                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut
                                                    sceleris que the mattis, leo quam aliquet congue placerat mi id nisi
                                                    interdum mollis. </p>
                                            </div>
                                        </div>

                                        <!-- nested comment markup -->
                                        <ul class="children">
                                            <li class="single-thread depth-2">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="media-heading">
                                                            <h4>AazzTech</h4>
                                                            <span>6 Hours Ago</span>
                                                        </div>
                                                        <span class="comment-tag author">Author</span>
                                                        <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra,
                                                            justo ut sceleris que the mattis, leo quam aliquet congue
                                                            placerat mi id nisi interdum mollis. </p>
                                                    </div>
                                                </div>

                                            </li>
                                            <li class="single-thread depth-2">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="images/m1.png" alt="Commentator Avatar">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="media-heading">
                                                            <h4>Themexylum</h4>
                                                            <span>9 Hours Ago</span>
                                                        </div>
                                                        <span class="comment-tag buyer">Purchased</span>
                                                        <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra,
                                                            justo ut sceleris que the mattis, leo quam aliquet congue
                                                            placerat mi id nisi interdum mollis. </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea class="bla" name="reply-comment" placeholder="Write your comment..."></textarea>
                                                    <button class="btn btn--md btn--round">Post Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->

                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m3.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="media-heading">
                                                        <a href="author.html">
                                                            <h4>Themexylum</h4>
                                                        </a>
                                                        <span>9 Hours Ago</span>
                                                    </div>
                                                    <a href="#" class="reply-link">Reply</a>
                                                </div>
                                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut
                                                    sceleris que the mattis, leo quam aliquet congue placerat mi id nisi
                                                    interdum mollis. </p>
                                            </div>
                                        </div>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea name="reply-comment" placeholder="Write your comment..."></textarea>
                                                    <button class="btn btn--sm btn--round">Post Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->

                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m4.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="media-heading">
                                                        <a href="author.html">
                                                            <h4>Themexylum</h4>
                                                        </a>
                                                        <span>9 Hours Ago</span>
                                                    </div>
                                                    <a href="#" class="reply-link">Reply</a>
                                                </div>
                                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut
                                                    sceleris que the mattis, leo quam aliquet congue placerat mi id nisi
                                                    interdum mollis. </p>
                                            </div>
                                        </div>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea name="reply-comment" placeholder="Write your comment..."></textarea>
                                                    <button class="btn btn--sm btn--round">Post Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->

                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m5.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="media-heading">
                                                        <a href="author.html">
                                                            <h4>Themexylum</h4>
                                                        </a>
                                                        <span>9 Hours Ago</span>
                                                    </div>
                                                    <a href="#" class="reply-link">Reply</a>
                                                </div>
                                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut
                                                    sceleris que the mattis, leo quam aliquet congue placerat mi id nisi
                                                    interdum mollis. </p>
                                            </div>
                                        </div>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea name="reply-comment" placeholder="Write your comment..."></textarea>
                                                    <button class="btn btn--sm btn--round">Post Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->
                                </ul>
                                <!-- end /.media-list -->

                                <div class="pagination-area pagination-area2">
                                    <nav class="navigation pagination" role="navigation">
                                        <div class="nav-links">
                                            <a class="page-numbers current" href="#">1</a>
                                            <a class="page-numbers" href="#">2</a>
                                            <a class="page-numbers" href="#">3</a>
                                            <a class="next page-numbers" href="#">
                                                <span class="lnr lnr-arrow-right"></span>
                                            </a>
                                        </div>
                                    </nav>
                                </div>
                                <!-- end /.comment pagination area -->

                                <div class="comment-form-area">
                                    <h4>Leave a comment</h4>
                                    <!-- comment reply -->
                                    <div class="media comment-form">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/m7.png" alt="Commentator Avatar">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <form action="#" class="comment-reply-form">
                                                <textarea name="reply-comment" placeholder="Write your comment..."></textarea>
                                                <button class="btn btn--sm btn--round">Post Comment</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- comment reply -->
                                </div>
                                <!-- end /.comment-form-area -->
                            </div>
                            <!-- end /.comments -->
                        </div>
                        <!-- end /.product-comment -->

                        <div class="fade tab-pane product-tab" id="product-review">
                            <div class="thread thread_review">
                                <ul class="media-list thread-list">
                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m1.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="clearfix">
                                                    <div class="pull-left">
                                                        <div class="media-heading">
                                                            <a href="author.html">
                                                                <h4>Themexylum</h4>
                                                            </a>
                                                            <span>9 Hours Ago</span>
                                                        </div>
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
                                                        </div>
                                                        <span class="review_tag">support</span>
                                                    </div>
                                                    <a href="#" class="reply-link">Reply</a>
                                                </div>
                                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut
                                                    sceleris que the mattis, leo quam aliquet congue placerat mi id nisi
                                                    interdum mollis.</p>
                                            </div>
                                        </div>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea class="bla" name="reply-comment" placeholder="Write your comment..."></textarea>
                                                    <button class="btn btn--md btn--round">Post Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->

                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m4.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="clearfix">
                                                    <div class="pull-left">
                                                        <div class="media-heading">
                                                            <a href="author.html">
                                                                <h4>Codepoet_Biplob</h4>
                                                            </a>
                                                            <span>9 Hours Ago</span>
                                                        </div>
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
                                                        </div>
                                                        <span class="review_tag">code quality</span>
                                                    </div>
                                                    <a href="#" class="reply-link">Reply</a>
                                                </div>
                                                <p>Awesome theme. All in one Business Website Solutions.</p>
                                            </div>
                                        </div>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea class="bla" name="reply-comment" placeholder="Write your comment..."></textarea>
                                                    <button class="btn btn--md btn--round">Post Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->

                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m5.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="clearfix">
                                                    <div class="pull-left">
                                                        <div class="media-heading">
                                                            <a href="author.html">
                                                                <h4>PaglaGhora</h4>
                                                            </a>
                                                            <span>9 Hours Ago</span>
                                                        </div>
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
                                                        </div>
                                                        <span class="review_tag">design quality</span>
                                                    </div>
                                                    <a href="#" class="reply-link">Reply</a>
                                                </div>
                                                <p>Best theme ever....</p>
                                            </div>
                                        </div>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea class="bla" name="reply-comment" placeholder="Write your comment..."></textarea>
                                                    <button class="btn btn--md btn--round">Post Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->

                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m6.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="clearfix">
                                                    <div class="pull-left">
                                                        <div class="media-heading">
                                                            <a href="author.html">
                                                                <h4>Hearingorg</h4>
                                                            </a>
                                                            <span>12 days Ago</span>
                                                        </div>
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
                                                        </div>
                                                        <span class="review_tag">support</span>
                                                    </div>
                                                    <a href="#" class="reply-link">Reply</a>
                                                </div>
                                                <p>Very helpful support - above and beyond is my experience and I have
                                                    purchased
                                                    this theme many times for my clients.</p>
                                            </div>
                                        </div>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea class="bla" name="reply-comment" placeholder="Write your comment..."></textarea>
                                                    <button class="btn btn--md btn--round">Post Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->

                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m7.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="clearfix">
                                                    <div class="pull-left">
                                                        <div class="media-heading">
                                                            <a href="author.html">
                                                                <h4>ecom1206</h4>
                                                            </a>
                                                            <span>5 Hours Ago</span>
                                                        </div>
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
                                                        </div>
                                                        <span class="review_tag">code quality</span>
                                                    </div>
                                                    <a href="#" class="reply-link">Reply</a>
                                                </div>
                                                <p>Awesome theme. All in one Business Website Solutions.</p>
                                            </div>
                                        </div>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea class="bla" name="reply-comment" placeholder="Write your comment..."></textarea>
                                                    <button class="btn btn--md btn--round">Post Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->

                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m8.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="clearfix">
                                                    <div class="pull-left">
                                                        <div class="media-heading">
                                                            <a href="author.html">
                                                                <h4>Mr.Mango</h4>
                                                            </a>
                                                            <span>1 month day</span>
                                                        </div>
                                                        <div class="rating product--rating">
                                                            <ul>
                                                                <li>
                                                                    <span class="fa fa-star"></span>
                                                                </li>
                                                                <li>
                                                                    <span class="fa fa-star"></span>
                                                                </li>
                                                                <li>
                                                                    <span class="fa fa-star-o" aria-hidden="true"></span>
                                                                </li>
                                                                <li>
                                                                    <span class="fa fa-star-o" aria-hidden="true"></span>
                                                                </li>
                                                                <li>
                                                                    <span class="fa fa-star-o" aria-hidden="true"></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <span class="review_tag">design quality</span>
                                                    </div>
                                                    <a href="#" class="reply-link">Reply</a>
                                                </div>
                                                <p>Retina logo won't work retina logo won't work</p>
                                            </div>
                                        </div>

                                        <!-- nested comment markup -->
                                        <ul class="children">
                                            <li class="single-thread depth-2">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="media-heading">
                                                            <h4>AazzTech</h4>
                                                            <span>6 Hours Ago</span>
                                                        </div>
                                                        <span class="comment-tag author">Author</span>
                                                        <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra,
                                                            justo ut sceleris que the mattis, leo quam aliquet congue
                                                            placerat mi id nisi interdum mollis. </p>
                                                    </div>
                                                </div>

                                            </li>
                                        </ul>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea class="bla" name="reply-comment" placeholder="Write your comment..."></textarea>
                                                    <button class="btn btn--md btn--round">Post Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->

                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m6.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="clearfix">
                                                    <div class="pull-left">
                                                        <div class="media-heading">
                                                            <a href="author.html">
                                                                <h4>Hearingorg</h4>
                                                            </a>
                                                            <span>12 days Ago</span>
                                                        </div>
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
                                                        </div>
                                                        <span class="review_tag">support</span>
                                                    </div>
                                                    <a href="#" class="reply-link">Reply</a>
                                                </div>
                                                <p>Very helpful support - above and beyond is my experience and I have
                                                    purchased
                                                    this theme many times for my clients.</p>
                                            </div>
                                        </div>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea class="bla" name="reply-comment" placeholder="Write your comment..."></textarea>
                                                    <button class="btn btn--md btn--round">Post Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->

                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m9.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="clearfix">
                                                    <div class="pull-left">
                                                        <div class="media-heading">
                                                            <a href="author.html">
                                                                <h4>Tueld</h4>
                                                            </a>
                                                            <span>23 Minutes Ago</span>
                                                        </div>
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
                                                        </div>
                                                        <span class="review_tag">code quality</span>
                                                    </div>
                                                    <a href="#" class="reply-link">Reply</a>
                                                </div>
                                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut
                                                    sceleris que the mattis, leo quam aliquet congue placerat mi id nisi
                                                    interdum mollis. </p>
                                            </div>
                                        </div>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea class="bla" name="reply-comment" placeholder="Write your comment..."></textarea>
                                                    <button class="btn btn--md btn--round">Post Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->

                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m3.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="clearfix">
                                                    <div class="pull-left">
                                                        <div class="media-heading">
                                                            <a href="author.html">
                                                                <h4>Living Potato</h4>
                                                            </a>
                                                            <span>3 months ago</span>
                                                        </div>
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
                                                        </div>
                                                        <span class="review_tag">customization</span>
                                                    </div>
                                                    <a href="#" class="reply-link">Reply</a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea class="bla" name="reply-comment" placeholder="Write your comment..."></textarea>
                                                    <button class="btn btn--md btn--round">Post Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->

                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m6.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="clearfix">
                                                    <div class="pull-left">
                                                        <div class="media-heading">
                                                            <a href="author.html">
                                                                <h4>Visual-Eggs</h4>
                                                            </a>
                                                            <span>125 years ago</span>
                                                        </div>
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
                                                        </div>
                                                        <span class="review_tag">support</span>
                                                    </div>
                                                    <a href="#" class="reply-link">Reply</a>
                                                </div>
                                                <p>This is the finest art in the history of whateverland. Pastor: No
                                                    it's
                                                    a witchcraft.</p>
                                            </div>
                                        </div>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea class="bla" name="reply-comment" placeholder="Write your comment..."></textarea>
                                                    <button class="btn btn--md btn--round">Post Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->
                                </ul>
                                <!-- end /.media-list -->

                                <div class="pagination-area pagination-area2">
                                    <nav class="navigation pagination " role="navigation">
                                        <div class="nav-links">
                                            <a class="page-numbers current" href="#">1</a>
                                            <a class="page-numbers" href="#">2</a>
                                            <a class="page-numbers" href="#">3</a>
                                            <a class="next page-numbers" href="#">
                                                <span class="lnr lnr-arrow-right"></span>
                                            </a>
                                        </div>
                                    </nav>
                                </div>
                                <!-- end /.comment pagination area -->
                            </div>
                            <!-- end /.comments -->
                        </div>
                        <!-- end /.product-comment -->

                        <div class="fade tab-pane product-tab" id="product-support">
                            <div class="support">
                                <div class="support__title">
                                    <h3>Contact the Author</h3>
                                </div>
                                <div class="support__form">
                                    <div class="usr-msg">
                                        <p>Please
                                            <a href="login.html">sign in</a> to contact this author.</p>

                                        <form action="#" class="support_form">
                                            <div class="form-group">
                                                <label for="subj">Support Subject:</label>
                                                <input type="text" id="subj" class="text_field" placeholder="Enter your subject">
                                            </div>

                                            <div class="form-group">
                                                <label for="supmsg">Support Query: </label>
                                                <textarea class="text_field" id="supmsg" name="supmsg">Enter your text...</textarea>
                                            </div>
                                            <button type="submit" class="btn btn--lg btn--round">Submit Now</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end /.product-support -->

                        <div class="fade tab-pane product-tab" id="product-faq">
                            <div class="tab-content-wrapper">
                                <div class="panel-group accordion" role="tablist" id="accordion">
                                    <div class="panel accordion__single" id="panel-one">
                                        <div class="single_acco_title">
                                            <h4>
                                                <a data-toggle="collapse" href="#collapse1" class="collapsed" aria-expanded="false" data-target="#collapse1" aria-controls="collapse1">
                                                    <span>How to write the changelog for theme updates?</span>
                                                    <i class="lnr lnr-chevron-down indicator"></i>
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="collapse1" class="panel-collapse collapse" aria-labelledby="panel-one" data-parent="#accordion">
                                            <div class="panel-body">
                                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut
                                                    sceleris que the mattis, leo quam aliquet congue placerat mi id nisi
                                                    interdum mollis. Aliquip placeat salvia cillum iphone. Seitan
                                                    aliquip
                                                    quis cardigan american apparel, butcher. Nunc placerat mi id nisi
                                                    interdum mollis. Praesent pharetra, justo ut sceleris que the
                                                    mattis,
                                                    leo quam aliquet congue placerat mi id nisi interdum mollis. Aliquip
                                                    placeat salvia cillum iphone. Seitan aliquip quis cardigan american
                                                    apparel, butcher .</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end /.accordion__single -->
                                    <div class="panel accordion__single" id="panel-two">
                                        <div class="single_acco_title">
                                            <h4>
                                                <a data-toggle="collapse" href="#collapse2" class="collapsed" aria-expanded="false" data-target="#collapse2" aria-controls="collapse2">
                                                    <span>Why do I need to login to purchase an item on DigiPro?</span>
                                                    <i class="lnr lnr-chevron-down indicator"></i>
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="collapse2" class="panel-collapse collapse" aria-labelledby="panel-two" data-parent="#accordion">
                                            <div class="panel-body">
                                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut
                                                    sceleris que the mattis, leo quam aliquet congue placerat mi id nisi
                                                    interdum mollis. Aliquip placeat salvia cillum iphone. Seitan
                                                    aliquip
                                                    quis cardigan american apparel, butcher. Nunc placerat mi id nisi
                                                    interdum mollis. Praesent pharetra, justo ut sceleris que the
                                                    mattis,
                                                    leo quam aliquet congue placerat mi id nisi interdum mollis. Aliquip
                                                    placeat salvia cillum iphone. Seitan aliquip quis cardigan american
                                                    apparel, butcher .</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end /.accordion__single -->
                                    <div class="panel accordion__single" id="panel-three">
                                        <div class="single_acco_title">
                                            <h4>
                                                <a data-toggle="collapse" href="#collapse3" class="collapsed" aria-expanded="false" data-target="#collapse3" aria-controls="collapse3">
                                                    <span>How to create an account on DigiPro?</span>
                                                    <i class="lnr lnr-chevron-down indicator"></i>
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="collapse3" class="panel-collapse collapse" aria-labelledby="panel-three" data-parent="#accordion">
                                            <div class="panel-body">
                                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut
                                                    sceleris que the mattis, leo quam aliquet congue placerat mi id nisi
                                                    interdum mollis. Aliquip placeat salvia cillum iphone. Seitan
                                                    aliquip
                                                    quis cardigan american apparel, butcher. Nunc placerat mi id nisi
                                                    interdum mollis. Praesent pharetra, justo ut sceleris que the
                                                    mattis,
                                                    leo quam aliquet congue placerat mi id nisi interdum mollis. Aliquip
                                                    placeat salvia cillum iphone. Seitan aliquip quis cardigan american
                                                    apparel, butcher .</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end /.accordion__single -->
                                    <div class="panel accordion__single" id="panel-four">
                                        <div class="single_acco_title">
                                            <h4>
                                                <a data-toggle="collapse" href="#collapse4" class="collapsed" aria-expanded="false" data-target="#collapse4" aria-controls="collapse4">
                                                    <span>How to write the changelog for theme updates?</span>
                                                    <i class="lnr lnr-chevron-down indicator"></i>
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="collapse4" class="panel-collapse collapse" aria-labelledby="panel-four" data-parent="#accordion">
                                            <div class="panel-body">
                                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut
                                                    sceleris que the mattis, leo quam aliquet congue placerat mi id nisi
                                                    interdum mollis. Aliquip placeat salvia cillum iphone. Seitan
                                                    aliquip
                                                    quis cardigan american apparel, butcher. Nunc placerat mi id nisi
                                                    interdum mollis. Praesent pharetra, justo ut sceleris que the
                                                    mattis,
                                                    leo quam aliquet congue placerat mi id nisi interdum mollis. Aliquip
                                                    placeat salvia cillum iphone. Seitan aliquip quis cardigan american
                                                    apparel, butcher .</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end /.accordion__single -->
                                    <div class="panel accordion__single" id="panel-five">
                                        <div class="single_acco_title">
                                            <h4>
                                                <a data-toggle="collapse" href="#collapse5" class="collapsed" aria-expanded="false" data-target="#collapse5" aria-controls="collapse5">
                                                    <span>Do you recommend using a download manager software?</span>
                                                    <i class="lnr lnr-chevron-down indicator"></i>
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="collapse5" class="panel-collapse collapse" aria-labelledby="panel-five" data-parent="#accordion">
                                            <div class="panel-body">
                                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut
                                                    sceleris que the mattis, leo quam aliquet congue placerat mi id nisi
                                                    interdum mollis. Aliquip placeat salvia cillum iphone. Seitan
                                                    aliquip
                                                    quis cardigan american apparel, butcher. Nunc placerat mi id nisi
                                                    interdum mollis. Praesent pharetra, justo ut sceleris que the
                                                    mattis,
                                                    leo quam aliquet congue placerat mi id nisi interdum mollis. Aliquip
                                                    placeat salvia cillum iphone. Seitan aliquip quis cardigan american
                                                    apparel, butcher .</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end /.accordion__single -->
                                    <div class="panel accordion__single" id="panel-six">
                                        <div class="single_acco_title">
                                            <h4>
                                                <a data-toggle="collapse" href="#collapse6" class="collapsed" aria-expanded="false" data-target="#collapse6" aria-controls="collapse6">
                                                    <span>How to purchase an item on DigiPro?</span>
                                                    <i class="lnr lnr-chevron-down indicator"></i>
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="collapse6" class="panel-collapse collapse" aria-labelledby="panel-six" data-parent="#accordion">
                                            <div class="panel-body">
                                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut
                                                    sceleris que the mattis, leo quam aliquet congue placerat mi id nisi
                                                    interdum mollis. Aliquip placeat salvia cillum iphone. Seitan
                                                    aliquip
                                                    quis cardigan american apparel, butcher. Nunc placerat mi id nisi
                                                    interdum mollis. Praesent pharetra, justo ut sceleris que the
                                                    mattis,
                                                    leo quam aliquet congue placerat mi id nisi interdum mollis. Aliquip
                                                    placeat salvia cillum iphone. Seitan aliquip quis cardigan american
                                                    apparel, butcher .</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end /.accordion__single -->
                                </div>
                                <!-- end /.accordion -->
                            </div>

                        </div>
                        <!-- end /.product-faq -->
                    </div>
                    <!-- end /.tab-content -->
                </div>
                <!-- end /.item-info -->
            </div>
            <!-- end /.col-md-8 -->

            <div class="col-lg-4">
                <aside class="sidebar sidebar--single-product">
                    <div class="sidebar-card card-pricing">
                        <div class="price">
                            <h1>
                                @currency($produk->harga_jual)
                            </h1>
                        </div>
                        {{-- <ul class="pricing-options">
                            <li>
                                <div class="custom-radio">
                                    <input type="radio" id="opt1" class="" name="filter_opt" checked>
                                    <label for="opt1">
                                        <span class="circle"></span>Single Site License –
                                        <span class="pricing__opt">$20.00</span>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-radio">
                                    <input type="radio" id="opt2" class="" name="filter_opt">
                                    <label for="opt2">
                                        <span class="circle"></span>2 Sites License –
                                        <span class="pricing__opt">$40.00</span>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-radio">
                                    <input type="radio" id="opt3" class="" name="filter_opt">
                                    <label for="opt3">
                                        <span class="circle"></span>Multi Site License –
                                        <span class="pricing__opt">$60.00</span>
                                    </label>
                                </div>
                            </li>
                        </ul> --}}
                        <!-- end /.pricing-options -->

                        <div class="purchase-button">
                            {{-- <a href="#" class="btn btn--lg btn--round">Purchase Now</a> --}}
                            <form action="/keranjang" method="post">
                                @csrf
                                <input type="hidden" name="id_produk" id="id_produk" value="{{ $produk->id_produk }}">
                                <input type="hidden" name="harga_jual" id="harga_jual" value="{{ $produk->harga_jual }}">
                                <button type="submit" class="btn btn--lg btn--round cart-btn"><span class="lnr lnr-cart"></span> Tambah ke Keranjang</button>
                            </form>
                            {{-- <a href="#" class="btn btn--lg btn--round cart-btn">
                                <span class="lnr lnr-cart"></span> Tambah ke Keranjang</a> --}}
                        </div>
                        <!-- end /.purchase-button -->
                    </div>
                    <!-- end /.sidebar--card -->

                    <div class="sidebar-card card--metadata">
                        <ul class="data">
                            <li>
                                <p>
                                    <span class="lnr lnr-cart pcolor"></span>Terjual</p>
                                <span>{{ $produk->terjual }}</span>
                            </li>
                            <li>
                                <p>
                                    <span class="lnr lnr-heart scolor"></span>Wishlist</p>
                                <span>{{ $produk->wishlist }}</span>
                            </li>
                            <li>
                                <p>
                                    <span class="lnr lnr-bubble mcolor3"></span>Review
                                </p>
                                <span>0</span>
                            </li>
                        </ul>


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
                            <span class="rating__count">( 26 Ratings )</span>
                        </div>
                        <!-- end /.rating -->
                    </div>
                    <!-- end /.sidebar-card -->

                    <div class="sidebar-card card--product-infos">
                        <div class="card-title">
                            <h4>Informasi Produk</h4>
                        </div>

                        <ul class="infos">
                            <li>
                                <p class="data-label">Diupload</p>
                                <p class="info">{{ $produk->created_at->format('d, M Y') }}</p>
                            </li>
                            <li>
                                <p class="data-label">Diperbarui</p>
                                <p class="info">{{ $produk->updated_at->format('d, M Y') }}</p>
                            </li>
                            <li>
                                <p class="data-label">Kategori</p>
                                <p class="info">{{ $produk->kategori->nama_kategori }}</p>
                            </li>
                        </ul>
                    </div>
                    <!-- end /.aside -->

                    <div class="author-card sidebar-card ">
                        <div class="card-title">
                            <h4>Informasi Penjual</h4>
                        </div>

                        <div class="author-infos">
                            <div class="author_avatar">
                                <img src="{{ asset('assets/images/author-avatar.jpg') }}" alt="Presenting the broken author avatar :D">
                            </div>

                            <div class="author">
                                <h4>{{ $produk->pelapak->nama_toko }}</h4>
                                <p>Bergabung: {{ $produk->pelapak->created_at->format("d, M Y") }}</p>
                            </div>
                            <!-- end /.author -->

                            <div class="social social--color--filled">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-facebook"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-twitter"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-dribbble"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end /.social -->

                            <div class="author-btn">
                                <a href="#" class="btn btn--sm btn--round">Kunjungi</a>
                                <a href="#" class="btn btn--sm btn--round">Kirim Pesan</a>
                            </div>
                            <!-- end /.author-btn -->
                        </div>
                        <!-- end /.author-infos -->


                    </div>
                    <!-- end /.author-card -->
                </aside>
                <!-- end /.aside -->
            </div>
            <!-- end /.col-md-4 -->
        </div>
        <!-- end /.row -->
    </div>
    <!-- end /.container -->
</section>
<!--===========================================
        END SINGLE PRODUCT DESCRIPTION AREA
    ===============================================-->
@endsection