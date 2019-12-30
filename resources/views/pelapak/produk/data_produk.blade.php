@extends('pelapak.master')

@section('title')
    Data Produk
@endsection

@section('konten')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Produk
                    </h3>
                </div>
                <div class="card-body pad table-responsive">
                    <a href="/administrator/produk/add" class="btn btn-primary btn-sm">Tambah</a> <br> <br>
                    <table id="tbl" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->nama_produk }}</td>
                                    <td>{{ $p->kategori->nama_kategori }}</td>
                                    <td>
                                        <a href="/administrator/produk/edit/{{ $p->id_produk }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="/administrator/produk/hapus/{{ $p->id_produk }}" class="btn btn-danger btn-sm">Hapus</a>
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
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#tbl").DataTable();
        })
    </script>
@endpush
