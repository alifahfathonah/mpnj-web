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
                                <a href="#">Transaksi</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Data Transaksi</h1>
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
                                    <h3>Data Transaksi</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="upload_modules">
                            <div class="modules__title">
                                <h3>Data Transaksi Anda</h3>
                            </div>
                            <div class="modules__content">
                                <table id="tbl" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Kode Transaksi</th>
                                        <th>Waktu Transaksi</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transaksi as $t)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $t->kode_transaksi }}</td>
                                            <td>{{ $t->waktu_transaksi }}</td>
                                            <td>
                                                <a href="{{ URL::to('administrator/transaksi/detail/'.$t->id_transaksi) }}">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection