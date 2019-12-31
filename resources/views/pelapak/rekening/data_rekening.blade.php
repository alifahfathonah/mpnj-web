@extends('pelapak.master')

@section('title')
    Data Rekening
@endsection

@section('konten')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Rekening
                    </h3>
                </div>
                <div class="card-body pad table-responsive">
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
