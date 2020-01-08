@extends('web.web_master')

@section('web_konten')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Daftar
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" id="username" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" id="" cols="30" rows="10" class="form-control form-control-sm"></textarea>
                </div>
                <div class="form-group">
                    <label>Kode Pos</label>
                    <input type="text" name="kode_pos" id="kode_pos" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label>Provinsi</label>
                    <select name="provinsi" id="provinsi" class="form-control form-control-sm">
                        @foreach ($provinsi->rajaongkir->results as $p)
                            <option value="{{ $p->province_id }}">{{ $p->province }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Kota</label>
                    <select name="kota" id="kota" class="form-control form-control-sm">

                    </select>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label>Nomor HP</label>
                    <input type="text" name="nomor_hp" id="nomor_hp" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control form-control-sm">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#provinsi").on('change', function() {
                let provinsiId = $(this).val();
                // var settings = {
                //     "async": true,
                //     "crossDomain": true,
                //     "url": "https://api.rajaongkir.com/starter/city?province=5",
                //     "method": "GET",
                //     "dataType": "jsonp",
                //     "header": {
                //         "key": "c506cdfc35a33e3d47fb068b799c0630"
                //     }
                // }
                // $.ajax(settings).done(function (response) {
                //     console.log(response);
                // });


                $.ajax({
                    // url: "https://api.rajaongkir.com/starter/city?province=5",
                    url: `kotaByProvinsiId/${provinsiId}`,
                    type: 'GET',
                    dataType: "json",
                    headers: {
                        'key': 'c506cdfc35a33e3d47fb068b799c0630',
                        'Access-Control-Allow-Headers': '*'
                    },
                    success: function(response) {
                        // console.log(response);
                        response.rajaongkir.results.map(e => {
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
        })
    </script>
@endpush
