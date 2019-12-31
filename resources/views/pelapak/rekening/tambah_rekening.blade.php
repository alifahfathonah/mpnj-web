@extends('pelapak.master')

@section('title')
Tambah Data Rekening
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
                    <form action="/administrator/rekening/simpan" method="post">
                        @csrf
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
