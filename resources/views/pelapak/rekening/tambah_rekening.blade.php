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
                            <li class="active">
                                <a href="#">Rekening</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Data Rekening</h1>
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

    <section class="dashboard-area">
    @include('pelapak.master')
    <!-- end /.dashboard_menu_area -->

        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h3>Data Rekening</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <form action="/administrator/rekening/simpan" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="upload_modules">
                                <div class="modules__title">
                                    <h3>Item Name &amp; Description</h3>
                                </div>
                                <div class="modules__content">
                                    <div class="form-group">
                                        <label>Nama Bank</label>
                                        <input type="text" name="nama_bank" id="nama_bank" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Rekening</label>
                                        <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label>Atas Nama</label>
                                        <input type="text" name="atas_nama" id="atas_nama" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection