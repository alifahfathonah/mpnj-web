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
                    @php $n = 1; @endphp
                    @foreach($alamat as $a)
                        <table class="ui celled table" style="width:100%;">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $a->nama }} @if ($a->id_alamat == 1) <button class="type pcolorbg">Utama</button> @endif</td>
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
                                    <button class="btn btn--icon btn-sm btn--round btn-secondary" data-target="#modalEdit{{ $n }}" data-toggle="modal">Edit</button>
                                    <form action="" style="float: left">
                                        <button class="btn btn--icon btn-sm btn--round btn-primary">Jadikan Alamat Utama</button>
                                    </form>
                                    <a href="#" class="btn btn--icon btn-sm btn--round btn-danger" data-toggle="modal" data-target="#hapusAlamatConfirm" data-alamatid="{{ $a->id_alamat }}" onclick="hapusAlamat({{ $a->id_alamat }})">Hapus</a>
{{--                                    <button >Hapus</button>--}}
                                </td>
                            </tr>
                        </table>
                        <hr>
                        @php $n++; @endphp
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
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" class="form-control">
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
                        <input type="text" name="kode_pos" id="kode_pos" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat_lengkap" cols="30" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn--round btn-danger btn--default">Simpan</button>
                    <button class="btn btn--round modal_close" data-dismiss="modal">Batal</button>
                </form>
            </div>
            <!-- end /.modal-body -->
        </div>
    </div>
</div>

@php $m = 1; @endphp
@foreach($alamat as $a)
    <div class="modal fade rating_modal item_remove_modal" id="modalEdit{{ $m }}" tabindex="-1" role="dialog" aria-labelledby="myModal2">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Data Alamat</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- end /.modal-header -->

                <div class="modal-body">
                    <form method="post" action="{{ URL::to('profile/alamat/ubah/'.$a->id_alamat) }}">
                        @csrf
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $a->nama }}">
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="text" name="nomor_telepon" class="form-control" value="{{ $a->nomor_telepon }}">
                        </div>
                        <div class="form-group">
                            <label>Provinsi</label>
                            <select name="provinsi" id="editProvinsi{{ $m }}" class="form-control" onchange="editProvinsi({{ $m }})">
                                <option>-- PILIH PROVINSI --</option>
                                @foreach ($provinsi->rajaongkir->results as $p)
                                    @if($p->province_id == $a->provinsi_id)
                                        <option value="{{ $p->province_id }}" selected>{{ $p->province }}</option>
                                    @else
                                        <option value="{{ $p->province_id }}">{{ $p->province }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <input type="hidden" name="nama_provinsi" id="edit_nama_provinsi{{ $m }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Kota</label>
                            <select name="kota" id="editKota{{ $m }}" class="form-control" onchange="editKota({{ $m }})">
                                <option>-- PILIH KOTA --</option>
                                @foreach ($kota->rajaongkir->results as $k)
                                    @if($k->city_id == $a->city_id && $k->province_id == $a->provinsi_id)
                                        <option value="{{ $k->city_id }}" selected>{{ $k->type }} {{ $k->city_name }}</option>
                                     @else
                                        @if($k->province_id == $a->provinsi_id)
                                            <option value="{{ $k->city_id }}">{{ $k->type }} {{ $k->city_name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                            <input type="hidden" name="nama_kota" id="edit_nama_kota{{ $m }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Kode Pos</label>
                            <input type="text" name="kode_pos" id="kode_pos{{ $m }}" class="form-control" value="{{ $a->kode_pos }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat_lengkap" cols="30" rows="10">{{ $a->alamat_lengkap }}</textarea>
                        </div>
                        <button type="submit" class="btn btn--round btn-danger btn--default">Simpan</button>
                        <button class="btn btn--round modal_close" data-dismiss="modal">Batal</button>
                    </form>
                </div>
                <!-- end /.modal-body -->
            </div>
        </div>
    </div>
    @php $m++; @endphp
@endforeach

<div class="modal fade rating_modal item_remove_modal" id="hapusAlamatConfirm" tabindex="-1" role="dialog" aria-labelledby="myModal2">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Anda Yakin Ingin Mengahpus Data Ini</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- end /.modal-header -->

            <div class="modal-body">
                <form method="GET" id="formHapusAlamat">
                    <button type="submit" class="btn btn--round btn-danger btn--default" onclick="submitHapusAlamat()">Hapus</button>
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
           $("#provinsi").on('change', function () {
               $("#nama_provinsi").val($("#provinsi option:selected").html());
               $.ajax({
                   async: true,
                   url: '{{ URL::to('api/gateway/kota?provinsi=') }}'+ `${$(this).val()}`,
                   type: 'GET',
                   success: function(response) {
                       // console.log(response.kota);
                       $("#kota option").remove();
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
               $.ajax({
                   async: true,
                   url: '{{ URL::to('api/gateway/kotaId?id=') }}' + $('#kota').val(),
                   type: 'GET',
                   success: function(response) {
                       // console.log(response.kota);
                       $('#kode_pos').val(response.kota.rajaongkir.results.postal_code);
                   },
                   error: function(error) {
                       console.log(error);
                   }
               });
           });

        });

        function editProvinsi(i) {
            $(`#edit_nama_provinsi${i}`).val($(`#editProvinsi${i} option:selected`).html());
            $.ajax({
                async: true,
                url: '{{ URL::to('api/gateway/kota?provinsi=') }}' + $(`#editProvinsi${i}`).val(),
                type: 'GET',
                success: function(response) {
                    // console.log(response.kota);
                    $(`#editKota${i} option`).remove();
                    response.kota.rajaongkir.results.map(e => {
                        $(`#editKota${i}`).append(`
                            <option value='${e.city_id}'>${e.type} ${e.city_name}</option>
                        `);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function editKota(i) {
            $(`#edit_nama_kota${i}`).val($(`#editKota${i} option:selected`).html());
            $.ajax({
                async: true,
                url: '{{ URL::to('api/gateway/kotaId?id=') }}' + $(`#editKota${i}`).val(),
                type: 'GET',
                success: function(response) {
                    // console.log(response.kota);
                    $(`#kode_pos${i}`).val(response.kota.rajaongkir.results.postal_code);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function hapusAlamat(id) {
            $("#formHapusAlamat").attr('action', '{{ URL::to('profile/alamat/hapus/') }}/' + id);
        }

        function submitHapusAlamat() {
            $("#formHapusAlamat").submit();
        }
    </script>
@endpush