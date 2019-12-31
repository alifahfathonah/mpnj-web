@extends('pelapak.master')

@section('title')
    Tambah Data Produk
@endsection

@section('konten')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        Tambah Data Produk
                    </h3>
                </div>
                <div class="card-body">
                    <form action="/administrator/produk/simpan" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Pilih Foto</label>
                            <div class="needsclick dropzone" id="document-dropzone"></div>
                        </div>
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" name="nama_produk" id="nama_produk" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" id="kategori" class="form-control form-control-sm">
                                @foreach ($kategori as $k)
                                <option value="{{ $k->id_kategori_produk }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Satuan</label>
                                    <input type="text" name="satuan" id="satuan" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-3">
                                    <label>Berat</label>
                                    <input type="number" name="berat" id="berat" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-3">
                                    <label>Harga Modal</label>
                                    <input type="number" name="harga_modal" id="harga_modal"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="col-md-3">
                                    <label>Harga Jual</label>
                                    <input type="number" name="harga_jual" id="harga_jual"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Diskon</label>
                                    <input type="number" name="diskon" id="diskon" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label>Stok</label>
                                    <input type="number" name="stok" id="stok" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"
                                    class="form-control form-control-sm"></textarea>
                            </div>
                            {{-- <div class="form-group">
                                <label>Foto</label>
                                <input type="file" name="foto" id="foto" class="form-control form-control-sm">
                            </div> --}}
                            <div class="form-group">
                                <input type="submit" value="Tambah" name="tambah" id="tambah"
                                    class="btn btn-primary btn-sm">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
