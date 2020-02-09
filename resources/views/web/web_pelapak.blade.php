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
                                <a href="index.html">Home</a>
                            </li>
                            <li class="active">
                                <a href="#">Pelapak</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Profile Pelapak {{ $user }}</h1>
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

    <section class="author-profile-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <aside class="sidebar sidebar_author">
                        <div class="author-card sidebar-card">
                            <div class="author-infos">
                                <div class="author_avatar">
                                    <img src="{{ asset('assets/images/author-avatar.jpg') }}" alt="Presenting the broken author avatar :D">
                                </div>

                                <div class="author">
                                    <h4>{{ $pelapak->username }}</h4>
                                    <p>Bergabung : {{ $pelapak->created_at->format("d, M Y") }}</p>
                                </div>
                                <!-- end /.author -->

                                <div class="author-badges">
                                    <ul class="list-unstyled">
                                        <li>
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Diamnond Author">
                                                <img src="{{ asset('assets/images/svg/author_rank_diamond.svg') }}" alt="" class="svg">
                                            </span>
                                        </li>
                                        <li>
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Has sold more than $10k">
                                                <img src="{{ asset('assets/images/svg/author_level_3.svg') }}" alt="" class="svg">
                                            </span>
                                        </li>
                                        <li>
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Referred 10+ members">
                                                <img src="{{ asset('assets/images/svg/affiliate_level_1.svg') }}" alt="" class="svg">
                                            </span>
                                        </li>
                                        <li>
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Has Collected 2+ Items">
                                                <img src="{{ asset('assets/images/svg/collection_level_1.svg') }}" alt="" class="svg">
                                            </span>
                                        </li>
                                        <li>
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Exclusive Author">
                                                <img src="{{ asset('assets/images/svg/exclusive_author.svg') }}" alt="" class="svg">
                                            </span>
                                        </li>
                                        <li>
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Weekly Featured Author">
                                                <img src="{{ asset('assets/images/svg/featured_author.svg') }}" alt="" class="svg">
                                            </span>
                                        </li>
                                        <li>
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Member for 2 Year">
                                                <img src="{{ asset('assets/images/svg/members_years.svg') }}" alt="" class="svg">
                                            </span>
                                        </li>
                                        <li>
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="The seller is recommended by authority">
                                                <img src="{{ asset('assets/images/svg/recommended.svg') }}" alt="" class="svg">
                                            </span>
                                        </li>
                                        <li>
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Won a contest">
                                                <img src="{{ asset('assets/images/svg/contest_winner.svg') }}" alt="" class="svg">
                                            </span>
                                        </li>
                                        <li>
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Helped to resolve copyright issues">
                                                <img src="{{ asset('assets/images/svg/copyright.svg') }}" alt="" class="svg">
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- end /.author-badges -->

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
                                    <a href="#" class="btn btn--md btn--round">Follow</a>
                                </div>
                                <!-- end /.author-btn -->
                            </div>
                            <!-- end /.author-infos -->


                        </div>
                        <!-- end /.author-card -->

                        <div class="sidebar-card author-menu">
                            <ul>
                                <li>
                                    <a href="{{ URL::to('pelapak/'.$pelapak->username) }}" class="{{ Route::currentRouteName() == 'halaman_pelapak' ? 'active' : '' }}">Profile</a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('pelapak/'.$pelapak->username.'/produk') }}" class="{{ Route::currentRouteName() == 'halaman_produk_pelapak' ? 'active' : '' }}">Produk</a>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.author-menu -->

                        <div class="sidebar-card freelance-status">
                            <div class="custom-radio">
                                <input type="radio" id="opt1" class="" name="filter_opt" checked="">
                                <label for="opt1">
                                    <span class="circle"></span>Available for Freelance work</label>
                            </div>
                        </div>
                        <!-- end /.author-card -->

                        <div class="sidebar-card message-card">
                            <div class="card-title">
                                <h4>Product Information</h4>
                            </div>

                            <div class="message-form">
                                <form action="#">
                                    <div class="form-group">
                                        <textarea name="message" class="text_field" id="author-message" placeholder="Your message..."></textarea>
                                    </div>

                                    <div class="msg_submit">
                                        <button type="submit" class="btn btn--md btn--round">send message</button>
                                    </div>
                                </form>
                                <p> Please
                                    <a href="#">sign in</a> to contact this author.</p>
                            </div>
                            <!-- end /.message-form -->
                        </div>
                        <!-- end /.freelance-status -->
                    </aside>
                </div>
                <!-- end /.sidebar -->

                <div class="col-lg-8 col-md-12">
                    @if(Route::currentRouteName() == 'halaman_pelapak')
                        @include('web.pelapak.overview')
                    @elseif(Route::currentRouteName() == 'halaman_produk_pelapak')
                        @include('web.pelapak.produk')
                    @endif
                </div>
                <!-- end /.col-md-8 -->

            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
@endsection