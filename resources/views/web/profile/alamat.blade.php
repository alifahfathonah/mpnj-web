<div class="row">
    <div class="col-md-12">
        <div class="information_module">
            <a class="toggle_title">
                <h4>Data Alamat</h4>
            </a>
            <div class="information__set toggle_module">
                <div class="information_wrapper form--fields table-responsive">
                    <table class="ui celled table" style="width:100%;">
                        <tr>
                            <td colspan="2">
                                <button class="btn btn--md btn--round" data-target="#modalAlamat" data-toggle="modal">Tambah</button>
                            </td>
                        </tr>
                    </table>
                    @foreach($alamat as $a)
                        <table class="ui celled table" style="width:100%;">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $a->nama }} @if ($a->id_alamat == 1) <button class="type pcolorbg">Utama</button> @else '' @endif</td>
                            </tr>
                            <tr>
                                <th>Nomor Hp</th>
                                <td>{{ $a->nomor_telepon }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $a->alamat_lengkap }}, {{ $a->nama_kota }}, {{ $a->nama_provinsi }}, {{ $a->kode_pos }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button class="btn btn--icon btn-sm btn--round btn-secondary">Edit</button>
                                    <form action="" style="float: left">
                                        <button class="btn btn--icon btn-sm btn--round btn-primary">Jadikan Alamat Utama</button>
                                    </form>
                                    <button class="btn btn--icon btn-sm btn--round btn-danger">Hapus</button>
                                </td>
                            </tr>
                        </table>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade rating_modal item_remove_modal" id="modalAlamat" tabindex="-1" role="dialog" aria-labelledby="myModal2">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Data Alamat</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- end /.modal-header -->

            <div class="modal-body">
                <form method="post" action="{{ URL::to('profile/alamat/simpan') }}">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Provinsi</label>
                        <select name="provinsi" id="provinsi" class="form-control">
                            <option>-- PILIH PROVINSI --</option>
                            @foreach ($provinsi->rajaongkir->results as $p)
                                <option value="{{ $p->province_id }}">{{ $p->province }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="nama_provinsi" id="nama_provinsi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kota</label>
                        <select name="kota" id="kota" class="form-control">
                            <option>-- PILIH KOTA --</option>
                        </select>
                        <input type="hidden" name="nama_kota" id="nama_kota" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="text" name="kode_pos" id="kode_pos" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn--round btn-danger btn--default">Simpan</button>
                    <button class="btn btn--round modal_close" data-dismiss="modal">Batal</button>
                </form>
            </div>
            <!-- end /.modal-body -->
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {
           var provinsi = false;
           $("#provinsi").on('change', function () {
               $("#nama_provinsi").val($("#provinsi option:selected").html());
               $.ajax({
                   url: '{{ URL::to('api/gateway/kota?provinsi=') }}'+ `${$(this).val()}`,
                   type: 'GET',
                   success: function(response) {
                       // console.log(response.kota);
                       response.kota.rajaongkir.results.map(e => {
                           $("#kota").append(`
                                <option value='${e.city_id}'>${e.type} ${e.city_name}</option>
                            `);
                       });
                   },
                   error: function(error) {
                       console.log(error);
                   }
               });
           });

           $("#kota").on('change', function () {
               $("#nama_kota").val($("#kota option:selected").html());
           });
        });
    </script>
@endpush