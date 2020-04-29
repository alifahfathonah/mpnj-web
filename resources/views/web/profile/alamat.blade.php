

<div class="row">
    <div class="col-md-12">
        @if (session('alert'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('alert') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        @endif
        <div class="information_module">
            <a class="toggle_title">
                <h4>Data Alamat</h4>
            </a>
            <div class="information__set toggle_module">
                <div class="information_wrapper form--fields table-responsive">
                    <table class="ui celled table" style="width:100%;">
                        <tr>
                            <td colspan="2">
                                <button class="btn btn--md btn--round btn-primary" data-target="#modalAlamat" data-toggle="modal">Tambah
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                                <button class="btn btn--md btn--round btn-primary" data-target="#modalAlamatSantri" data-toggle="modal">Tambah Alamat Santri
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                    </table>
                    @php $n = 1; @endphp
                    @foreach($alamat as $a)
                        <table class="ui celled table" style="width:100%;">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $a->nama }} @if ($a->id_alamat == $a->user->alamat_utama) <button class="type pcolorbg">Utama</button> @endif</td>
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
                                    @if ($a->id_alamat != $a->user->alamat_utama)
                                        <a href="#" class="btn btn--icon btn-sm btn--round btn-primary" data-toggle="modal" data-target="#alamatUtamaConfirm" onclick="alamatUtamaConfirm({{ $a->id_alamat }})">Jadikan Alamat Utama
                                            <i class="fa fa-podcast" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                    <button class="btn btn--icon btn-sm btn--round btn-secondary btnEditALamat" data-id_alamat="{{ $a->id_alamat }}">Edit
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </button>
                                    <a href="#" class="btn btn--icon btn-sm btn--round btn-danger" data-toggle="modal" data-target="#hapusAlamatConfirm" data-alamatid="{{ $a->id_alamat }}" onclick="hapusAlamat({{ $a->id_alamat }})">Hapus
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
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
                            <option id="provinsi_option">-- PILIH PROVINSI --</option>
{{--                            @foreach ($provinsi->rajaongkir->results as $p)--}}
{{--                                <option value="{{ $p->province_id }}">{{ $p->province }}</option>--}}
{{--                            @endforeach--}}
                        </select>
                        <input type="hidden" name="nama_provinsi" id="nama_provinsi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kota</label>
                        <select name="kota" id="kota" class="form-control" disabled>
                            <option>-- PILIH KOTA --</option>
                        </select>
                        <input type="hidden" name="nama_kota" id="nama_kota" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <select name="kecamatan" id="kecamatan" class="form-control" disabled>
                            <option>-- PILIH Kecamatan --</option>
                        </select>
                        <input type="hidden" name="nama_kecamatan" id="nama_kecamatan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="text" name="kode_pos" id="kode_pos" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat_lengkap" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn--round btn-danger btn--default">Simpan</button>
                    <button class="btn btn--round modal_close" data-dismiss="modal">Batal</button>
                </form>
            </div>
            <!-- end /.modal-body -->
        </div>
    </div>
</div>

@foreach($alamat as $a)
    <div class="modal fade rating_modal item_remove_modal" id="modalAlamatSantri" tabindex="-1" role="dialog" aria-labelledby="myModal2">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Data Alamat Santri</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- end /.modal-header -->

                <div class="modal-body">
                    <form method="post" action="{{ URL::to('profile/alamat/simpan') }}">
                        @csrf
                        <div class="form-group">
                            <label>Alamat</label>
                            <h3>Pondok Pesantren Nurul Jadid</h3>
                            <h4>Jl. Kyai Haji. Jl. KH. Zaini Mun'im, Dusun Tj. Lor, Karanganyar, Kec. Paiton</h4>
                        </div>
                        <div class="form-group">
                            <label>Nama Santri</label>
                            <input type="text" name="nama" class="form-control" value="{{ $a->nama }}">
                        </div>
                        <input type="hidden" name="nama_provinsi" class="form-control" value="Jawa Timur">
                        <input type="hidden" name="nama_kota" class="form-control" value="Kabupaten Probolinggo">
                        <input type="hidden" name="nama_kecamatan" class="form-control" value="Paiton">
                        <input type="hidden" name="kode_pos" class="form-control" value="67291">
                        <input type="hidden" name="alamat_lengkap" class="form-control" value="Jl. Kyai Haji. Jl. KH. Zaini Mun'im, Dusun Tj. Lor, Karanganyar, Kec. Paiton">
                        <input type="hidden" name="provinsi" class="form-control" value="11">
                        <input type="hidden" name="kota" class="form-control" value="369">
                        <input type="hidden" name="kecamatan" class="form-control" value="5155">
                        <input type="hidden" name="santri" class="form-control" value="Y">

                        <div class="form-group">
                            <label>Wilayah</label>
                            <select name="wilayah" class="form-control">
                                <option value="Sunan Gunung Jati (A)" {{ ($a->wilayah == 'Sunan Gunung Jati (A)' ? 'selected' : '') }}>Sunan Gunung Jati (A)</option>
                                <option value="Sunan Ampel (B)" {{ ($a->wilayah == 'Sunan Ampel (B)' ? 'selected' : '') }}>Sunan Ampel (B)</option>
                                <option value="Sunan Drajat (C)" {{ ($a->wilayah == 'Sunan Drajat (C)' ? 'selected' : '') }}>Sunan Drajat (C)</option>
                                <option value="Sunan Kalijaga (D)" {{ ($a->wilayah == 'Sunan Kalijaga (D)' ? 'selected' : '') }}>Sunan Kalijaga (D)</option>
                                <option value="Sunan Kudus (E)" {{ ($a->wilayah == 'Sunan Kudus (E)' ? 'selected' : '') }}>Sunan Kudus (E)</option>
                                <option value="Sunan Muria (F)" {{ ($a->wilayah == 'Sunan Muria (F)' ? 'selected' : '') }}>Sunan Muria (F)</option>
                                <option value="Jalaluddin Rumi (G)" {{ ($a->wilayah == 'Jalaluddin Rumi (G)' ? 'selected' : '') }}>Jalaluddin Rumi (G)</option>
                                <option value="Nurus Shoba (H)" {{ ($a->wilayah == 'Nurus Shoba (H)' ? 'selected' : '') }}>Nurus Shoba (H)</option>
                                <option value="Fatimatuz zahroh (I)" {{ ($a->wilayah == 'Fatimatuz zahroh (I)' ? 'selected' : '') }}>Fatimatuz zahroh (I)</option>
                                <option value="Al-Amiri (J)" {{ ($a->wilayah == 'Al-Amiri (J)' ? 'selected' : '') }}>Al-Amiri (J)</option>
                                <option value="Zaid bin Tsabit (K)" {{ ($a->wilayah == 'Zaid bin Tsabit (K)' ? 'selected' : '') }}>Zaid bin Tsabit (K)</option>
                                <option value="Maulana Malik Ibrahim (M)" {{ ($a->wilayah == 'Maulana Malik Ibrahim (M)' ? 'selected' : '') }}>Maulana Malik Ibrahim (M)</option>
                                <option value="Sunan Bonang (N)" {{ ($a->wilayah == 'Sunan Bonang (N)' ? 'selected' : '') }}>Sunan Bonang (N)</option>
                                <option value="Wilayah Az Zainiyah (Dalbar)" {{ ($a->wilayah == 'Wilayah Az Zainiyah (Dalbar)' ? 'selected' : '') }}>Wilayah Az Zainiyah (Dalbar)</option>
                                <option value="Wilayah Al Hasyimiyah (Daltim)" {{ ($a->wilayah == 'Wilayah Al Hasyimiyah (Daltim)' ? 'selected' : '') }}>Wilayah Al Hasyimiyah (Daltim)</option>
                                <option value="Wilayah Al Mawaddah" {{ ($a->wilayah == 'Wilayah Al Mawaddah' ? 'selected' : '') }}>Wilayah Al Mawaddah</option>
                                <option value="Wilayah Al Latifiyah" {{ ($a->wilayah == 'Wilayah Al Latifiyah' ? 'selected' : '') }}>Wilayah Al Latifiyah</option>
                                <option value="Wilayah Fatimatus Zahro " {{ ($a->wilayah == 'Wilayah Fatimatus Zahro ' ? 'selected' : '') }}>Wilayah Fatimatus Zahro </option>
                                <option value="Wilayah An-Nafi’iyah (Asrama Stikes)" {{ ($a->wilayah == 'Wilayah An-Nafi’iyah (Asrama Stikes)' ? 'selected' : '') }}>Wilayah An-Nafi’iyah (Asrama Stikes)</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label>Kamar</label>
                        <select name="kamar" class="form-control" readonly>
                            <option value="1" {{ ($a->kamar == '1' ? 'selected' : '') }}>1</option>
                            <option value="2" {{ ($a->kamar == '2' ? 'selected' : '') }}>2</option>
                            <option value="3" {{ ($a->kamar == '3' ? 'selected' : '') }}>3</option>
                            <option value="4" {{ ($a->kamar == '4' ? 'selected' : '') }}>4</option>
                            <option value="5" {{ ($a->kamar == '5' ? 'selected' : '') }}>5</option>
                            <option value="6" {{ ($a->kamar == '6' ? 'selected' : '') }}>6</option>
                            <option value="7" {{ ($a->kamar == '7' ? 'selected' : '') }}>7</option>
                            <option value="8" {{ ($a->kamar == '8' ? 'selected' : '') }}>8</option>
                            <option value="9" {{ ($a->kamar == '9' ? 'selected' : '') }}>9</option>
                            <option value="10" {{ ($a->kamar == '10' ? 'selected' : '') }}>10</option>
                            <option value="11" {{ ($a->kamar == '11' ? 'selected' : '') }}>11</option>
                            <option value="12" {{ ($a->kamar == '12' ? 'selected' : '') }}>12</option>
                            <option value="13" {{ ($a->kamar == '13' ? 'selected' : '') }}>13</option>
                            <option value="14" {{ ($a->kamar == '14' ? 'selected' : '') }}>14</option>
                            <option value="15" {{ ($a->kamar == '15' ? 'selected' : '') }}>15</option>
                            <option value="16" {{ ($a->kamar == '16' ? 'selected' : '') }}>16</option>
                            <option value="17" {{ ($a->kamar == '17' ? 'selected' : '') }}>17</option>
                            <option value="18" {{ ($a->kamar == '18' ? 'selected' : '') }}>18</option>
                            <option value="19" {{ ($a->kamar == '19' ? 'selected' : '') }}>19</option>
                            <option value="20" {{ ($a->kamar == '20' ? 'selected' : '') }}>20</option>
                            <option value="21" {{ ($a->kamar == '21' ? 'selected' : '') }}>21</option>
                            <option value="22" {{ ($a->kamar == '22' ? 'selected' : '') }}>22</option>
                            <option value="23" {{ ($a->kamar == '23' ? 'selected' : '') }}>23</option>
                            <option value="24" {{ ($a->kamar == '24' ? 'selected' : '') }}>24</option>
                            <option value="25" {{ ($a->kamar == '25' ? 'selected' : '') }}>25</option>
                            <option value="26" {{ ($a->kamar == '26' ? 'selected' : '') }}>26</option>
                            <option value="27" {{ ($a->kamar == '27' ? 'selected' : '') }}>27</option>
                            <option value="28" {{ ($a->kamar == '28' ? 'selected' : '') }}>28</option>
                            <option value="29" {{ ($a->kamar == '29' ? 'selected' : '') }}>29</option>
                            <option value="30" {{ ($a->kamar == '30' ? 'selected' : '') }}>30</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn--round btn-success btn--default">Simpan</button>
                        <button class="btn btn--round modal_close" data-dismiss="modal">Batal</button>
                    </form>
                </div>
                <!-- end /.modal-body -->
            </div>
        </div>
    </div>
@endforeach

<div class="modal fade rating_modal item_remove_modal" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModal2">
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
                <form method="post" action="{{ URL::to('profile/alamat/ubah/') }}">
                    @csrf
                    <input type="hidden" name="edit_id_alamat" id="edit_id_alamat">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" id="editNama" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" id="editNomorTelepon" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>Provinsi</label>
                        <select name="provinsi" id="editProvinsi" class="form-control">
                            <option>-- Loading --</option>
                        </select>
                        <input type="hidden" name="nama_provinsi" id="edit_nama_provinsi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kota</label>
                        <select name="kota" id="editKota" class="form-control">
                            <option>-- Loading --</option>
                        </select>
                        <input type="hidden" name="nama_kota" id="edit_nama_kota" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <select name="kecamatan" id="editKecamatan" class="form-control">
                            <option>-- Loading --</option>
                        </select>
                        <input type="hidden" name="nama_kecamatan" id="edit_nama_kecamatan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="text" name="kode_pos" id="editKodePos" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat_lengkap" class="form-control" cols="30" rows="10" id="editAlamatLengkap"></textarea>
                    </div>
                    <button type="submit" class="btn btn--round btn-success btn--default">Simpan</button>
                    <button class="btn btn--round modal_close" data-dismiss="modal">Batal</button>
                </form>
            </div>
            <!-- end /.modal-body -->
        </div>
    </div>
</div>

<div class="modal fade rating_modal item_remove_modal" id="hapusAlamatConfirm" tabindex="-1" role="dialog" aria-labelledby="myModal2">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Anda Yakin Ingin Menghapus Data Ini</h3>
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

<div class="modal fade rating_modal item_remove_modal" id="alamatUtamaConfirm" tabindex="-1" role="dialog" aria-labelledby="myModal2">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Anda Yakin Ingin Manjadikan Alamat ini Menjadi Alamat Utama ?</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- end /.modal-header -->

            <div class="modal-body">
                <form method="GET" id="formAlamatUtama">
                    <button type="submit" class="btn btn--round btn-danger btn--default" onclick="submitAlamatUtama()">Ya, Lanjutkan</button>
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
            $("#provinsi").one('click', function () {
                $.ajax({
                    async: true,
                    url: '{{ URL::to('api/gateway/provinsi') }}',
                    type: 'GET',
                    success: function(response) {
                        response.provinsi.rajaongkir.results.map(e => {
                            $("#provinsi").append(`
                                <option value='${e.province_id}'>${e.province}</option>
                            `);
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

           $("#provinsi").on('change', function () {
               $("#nama_provinsi").val($("#provinsi option:selected").html());
               $("#kota").prop('disabled', true);
               $("#kota option").remove();
               $("#kota").append(`
                    <option>-- PILIH KOTA --</option>
               `);
               $("#kecamatan option").remove();
               $("#kecamatan").prop('disabled', true);
               $("#kecamatan").append(`
                    <option>-- PILIH Kecamatan --</option>
               `);
               $.ajax({
                   async: true,
                   url: '{{ URL::to('api/gateway/kota?provinsi=') }}'+ `${$(this).val()}`,
                   type: 'GET',
                   success: function(response) {
                       $("#kota option").remove();
                       response.kota.rajaongkir.results.map(e => {
                           $("#kota").append(`
                                <option value='${e.city_id}'>${e.type} ${e.city_name}</option>
                            `);
                       });
                       $("#kota").prop('disabled', false);
                   },
                   error: function(error) {
                       console.log(error);
                   }
               });
           });

           $("#kota").on('change', function () {
               $("#nama_kota").val($("#kota option:selected").html());
               $("#kecamatan").prop('disabled', true);
               $.ajax({
                   async: true,
                   url: '{{ URL::to('api/gateway/kecamatan?id=') }}' + $('#kota').val(),
                   type: 'GET',
                   success: function(response) {
                       $("#kecamatan option").remove();
                       response.kecamatan.rajaongkir.results.map(e => {
                           $("#kecamatan").append(`
                                <option value='${e.subdistrict_id}'>${e.subdistrict_name}</option>
                           `);
                       });
                       $("#kecamatan").prop('disabled', false);
                   },
                   error: function(error) {
                       console.log(error);
                   }
               });
           });

            $("#kecamatan").on('change', function () {
                $("#nama_kecamatan").val($("#kecamatan option:selected").html());
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

        function editKecamatan(i) {
            $(`#edit_nama_kecamatan${i}`).val($(`#editKecamatan${i} option:selected`).html());
        }

        function hapusAlamat(id) {
            $("#formHapusAlamat").attr('action', '{{ URL::to('profile/alamat/hapus/') }}/' + id);
        }

        function submitHapusAlamat() {
            $("#formHapusAlamat").submit();
        }

        function alamatUtamaConfirm(id) {
            $("#formAlamatUtama").attr('action', '{{ URL::to('profile/alamat/ubah/utama') }}/' + id);
        }

        function submitAlamatUtama() {
            $("#formAlamatUtama").submit();
        }
    </script>
@endpush
