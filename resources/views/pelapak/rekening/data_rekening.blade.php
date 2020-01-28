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
                        <form action="/administrator/produk/simpan" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="upload_modules">
                                <div class="modules__title">
                                    <h3>Item Name &amp; Description</h3>
                                </div>
                                <div class="modules__content">
                                    <a href="/administrator/rekening/tambah" class="btn btn-primary btn-sm">Tambah</a> <br> <br>
                                    <table id="tbl" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Nomor Rekening</th>
                                            <th>Nama Bank</th>
                                            <th>Atas Nama</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($rekening as $r)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $r->nomor_rekening }}</td>
                                                <td>{{ $r->nama_bank }}</td>
                                                <td>{{ $r->atas_nama }}</td>
                                                <td>
                                                    <a href="/administrator/rekening/edit/{{ $r->id_rekening }}" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="/administrator/rekening/hapus/{{ $r->id_rekening }}" class="btn btn-danger btn-sm">Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#tbl").DataTable();
        })
    </script>
@endpush
