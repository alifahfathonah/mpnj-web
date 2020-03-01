@extends('web/web_master')

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
                                <a href="#">Reset Password</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Password Baru</h1>
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

    <section class="login_area section--padding2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <form action="{{ URL::to('password/update') }}" method="POST">
                        @csrf
                        <div class="cardify login">
                            <div class="login--header">
                                <h3>Halo, Selamat Datang</h3>
                                <p>Anda baru saja meminta untuk melakukan pengaturan ulang password, silanhkan isi data password baru anda dibawah ini.</p>
                            </div>
                            <!-- end .login_header -->

                            <div class="login--form">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" name="email" class="text_field" placeholder="Isi email...">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" name="password" class="text_field" placeholder="Isi password baru...">
                                </div>

                                <div class="form-group">
                                    <label for="konfirmasi_password">Konfirmasi Password</label>
                                    <input id="konfirmasi_password" type="password" name="konfirmasi_password" class="text_field" placeholder="Isi ulang password...">
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
    </section>
@endsection

@push('scripts')
    <script>
        $(function () {
            $("#konfirmasi_password").on('keyup', function () {
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