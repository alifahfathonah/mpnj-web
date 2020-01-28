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
                                <a href="#">Produk</a>
                            </li>
                            <li class="active">
                                <a href="#">Edit</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Edit Data Produk</h1>
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
                                    <h3>Upload Your Item</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <form action="{{ URL::to('administrator/produk/ubah/'.$produk->id_produk) }}" method="post" enctype="multipart/form-data">
                            <div class="upload_modules">
                                <div class="modules__title">
                                    <h3>Item Name &amp; Description</h3>
                                </div>
                                <div class="modules__content">
                                    @csrf
                                    <div class="form-group">
                                        <label>Pilih Foto</label>
                                        <div class="needsclick dropzone" id="document-dropzone"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Produk</label>
                                        <input type="text" name="nama_produk" id="nama_produk" class="form-control form-control-sm" value="{{ $produk->nama_produk }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select name="kategori" id="kategori" class="form-control form-control-sm">
                                            @foreach ($kategori as $k)
                                                @if ($k->id_kategori_produk == $produk->kategori_produk_id)
                                                    <option value="{{ $k->id_kategori_produk }}" selected>{{ $k->nama_kategori }}</option>
                                                @else
                                                    <option value="{{ $k->id_kategori_produk }}">{{ $k->nama_kategori }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Satuan</label>
                                                <input type="text" name="satuan" id="satuan" class="form-control form-control-sm" value="{{ $produk->satuan }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label>Berat</label>
                                                <input type="number" name="berat" id="berat" class="form-control form-control-sm" value="{{ $produk->berat }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label>Harga Modal</label>
                                                <input type="number" name="harga_modal" id="harga_modal"
                                                       class="form-control form-control-sm" value="{{ $produk->harga_modal }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label>Harga Jual</label>
                                                <input type="number" name="harga_jual" id="harga_jual"
                                                       class="form-control form-control-sm" value="{{ $produk->harga_jual }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Diskon</label>
                                                <input type="number" name="diskon" id="diskon" class="form-control form-control-sm" value="{{ $produk->diskon }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Stok</label>
                                                <input type="number" name="stok" id="stok" class="form-control form-control-sm" value="{{ $produk->stok }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"
                                                      class="form-control form-control-sm">{{ $produk->keterangan }}</textarea>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label>Foto Saat Ini</label> <br>
                                            <img src="{{ asset('assets/foto_produk/'.$produk->foto_produk[0]->foto_produk) }}" alt="{{ $produk->foto }}" width="400">
                                        </div> --}}
                                        {{-- <div class="form-group">
                                            <label>Ganti Foto *</label>
                                            <input type="file" name="foto" id="foto" class="form-control form-control-sm">
                                        </div> --}}
                                        <div class="form-group">
                                            <input type="submit" value="Ubah" name="ubah" id="ubah"
                                                   class="btn btn-primary btn-sm">
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

@push('scripts')
    <script>
        Dropzone.autoDiscover = false;
        $(function() {
            var uploadedDocumentMap = {};
            var upload = new Dropzone("#document-dropzone", {
                clickable: true,
                url: '/administrator/produk/upload_foto',
                method:"post",
                paramName: "file",
                maxFilesize: 2, // MB
                addRemoveLinks: true,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (file, response) {
                    $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                    uploadedDocumentMap[file.name] = response.name
                },
                removedfile: function (file) {
                    file.previewElement.remove()
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    } else {
                        name = uploadedDocumentMap[file.name]
                        $.ajax({
                            url: '/administrator/produk/unlink',
                            type: 'POST',
                            data: {
                                'name': name,
                                'action': 'edit'
                            },
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                            }
                        });
                    }
                    $('form').find('input[name="document[]"][value="' + name + '"]').remove()
                    $('form').find('input[name="uploaded[]"][value="' + name + '"]').remove()
                },
                init: function() {
                    @if(isset($produk) && $produk->foto_produk)
                    var files = {!! json_encode($produk->foto_produk) !!}
                        for (var i in files) {
                            var file = files[i]
                            this.options.addedfile.call(this, file)
                            this.options.thumbnail.call(this, file, 'http://127.0.0.1:8000/assets/foto_produk/'+file.foto_produk);
                            file.previewElement.classList.add('dz-complete')
                            $('form').append('<input type="hidden" name="uploaded[]" value="' +     file.id_foto_produk + '">')
                            console.log(uploadedDocumentMap);
                        }
                    @endif
                }
            });
        });
    </script>
@endpush
