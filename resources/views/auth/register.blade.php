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
                            <a href="#">Daftar</a>
                        </li>
                    </ul>
                </div>
                <h1 class="page-title">Daftar</h1>
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

<!--================================
            START SIGNUP AREA
    =================================-->
<section class="signup_area section--padding2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <form action="{{ route('daftarSimpan') }}" method="POST">
                    <div class="cardify signup_form">
                        <div class="login--header">
                            <h3>Buat Akun Kamu Sekarang</h3>
                            <p>Tolong isi data dibawah ini dengan benar.
                            </p>
                        </div>
                        <!-- end .login_header -->

                        <div class="login--form">

                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input id="nama_lengkap" type="text" name="nama_lengkap" class="text_field" placeholder="Isi Nama Lengkap...">
                            </div>

                            <div class="form-group">
                                <label for="user_name">Username</label>
                                <input id="user_name" type="text" name="username" class="text_field" placeholder="Isi username...">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="text" name="password" class="text_field" placeholder="Isi password...">
                            </div>

                            {{-- <div class="form-group">
                                <label for="con_pass">Confirm Password</label>
                                <input id="con_pass" type="text" class="text_field" placeholder="Confirm password">
                            </div> --}}

                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <select name="provinsi" id="provinsi" class="text_field">
                                    @foreach ($provinsi->rajaongkir->results as $p)
                                    <option value="{{ $p->province_id }}">{{ $p->province }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kota">Kota</label>
                                <select name="kota" id="kota" class="text_field">

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="10" class="text_field"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="kode_pos">Kode Pos</label>
                                <input id="kode_pos" type="text" name="kode_pos" class="text_field" placeholder="Isi kode pos...">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" class="text_field" placeholder="Isi email...">
                            </div>

                            <div class="form-group">
                                <label for="nomor_hp">Nomor HP</label>
                                <input id="nomor_hp" type="text" name="nomor_hp" class="text_field" placeholder="Isi nomor hp...">
                            </div>

                            <button class="btn btn--md btn--round register_btn" type="submit">Daftar Sekarang</button>

                            <div class="login_assist">
                                <p>Sudah punya akun ?
                                    <a href="/login">Masuk</a>
                                </p>
                            </div>
                        </div>
                        <!-- end .login--form -->
                    </div>
                    <!-- end .cardify -->
                </form>
            </div>
            <!-- end .col-md-6 -->
        </div>
        <!-- end .row -->
    </div>
    <!-- end .container -->
</section>
<!--================================
            END SIGNUP AREA
    =================================-->
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

                // $.get('https://api.rajaongkir.com/starter/city?province=5', {
                //     header: [
                //         'key : c506cdfc35a33e3d47fb068b799c0630'
                //     ]
                // }, (response) => {
                //     console.log(response);
                // })
                $.ajax({
                    // url: "https://api.rajaongkir.com/starter/city?province=5",
                    url: `kotaByProvinsiId/${provinsiId}`,
                    type: 'GET',
                    // format: 'json',
                    // dataType: 'json',
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
