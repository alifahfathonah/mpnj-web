@extends('pelapak.master')

@section('title')
Edit Data Rekening
@endsection

@section('konten')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        Edit Data Rekening
                    </h3>
                </div>
                <div class="card-body pad table-responsive">
                    <form action="/administrator/rekening/ubah/{{ $rekening->id_rekening }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Nama Bank</label>
                            <input type="text" name="nama_bank" id="nama_bank" class="form-control form-control-sm" value="{{ $rekening->nama_bank }}">
                        </div>
                        <div class="form-group">
                            <label>Nomor Rekening</label>
                            <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control form-control-sm" value="{{ $rekening->nomor_rekening }}">
                        </div>
                        <div class="form-group">
                            <label>Atas Nama</label>
                            <input type="text" name="atas_nama" id="atas_nama" class="form-control form-control-sm" value="{{ $rekening->atas_nama }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
