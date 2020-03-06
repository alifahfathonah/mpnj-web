@extends('mpnj.layout.main')

@section('title','Reset Password')

@section('content')

<div class="container">
    <div class="row my-3 justify-content-center">
        <div class="col-md-7">

            <div class="card card-lg">
                <div class="card-header">
                    <h5 class="card-title">Halo, Selamat Datang</h5>
                    <p>Anda baru saja meminta untuk melakukan pengaturan ulang password, silanhkan isi data password baru anda dibawah ini..</p>
                </div>
                <div class="card-body">
                    <form action="{{ URL::to('password/update') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" class="form-control form-control-alternative" placeholder="Masukkan Email" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" name="password" class="form-control form-control-alternative" placeholder="Masukkan Passwords" required>
                            </div>

                            <div class="form-group">
                                <label for="konfirmasi_password">Konfirmasi Password</label>
                                <input id="konfirmasi_password" type="password" name="konfirmasi_password" class="form-control form-control-alternative" placeholder="Konfirmasi Password" required>
                                <small id="pwd_not_match" style="color: red; display: none">Password Tidak Cocok</small>
                            </div>

                            <button class="btn btn--md btn--round" type="submit">Lanjut</button>

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

    @endsection

    @push('scripts')
    <script>
        $(function() {
            $("#konfirmasi_password").on('keyup', function() {
                let password = $("#password").val();

                if (password != $(this).val()) {
                    $("#pwd_not_match").css("display", "");
                } else {
                    $("#pwd_not_match").css("display", "none");
                }
            });
        });
    </script>
    @endpush