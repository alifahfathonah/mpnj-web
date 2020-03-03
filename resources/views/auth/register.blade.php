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
                            <a href="{{ URL::to('/') }}">Home</a>
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
                    @csrf
                    <div class="cardify signup_form">
                        <div class="login--header">
                            <h3>Buat Akun Kamu Sekarang</h3>
                            <p>Tolong isi data dibawah ini dengan benar.
                            </p>
                        </div>
                        <!-- end .login_header -->

                        <div class="login--form">
                            @if(session('registerError'))
                                <div class="alert alert-danger" role="alert">
                                    <span class="alert_icon lnr lnr-warning"></span>
                                    {{ session('registerError') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span class="lnr lnr-cross" aria-hidden="true"></span>
                                    </button>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input id="nama_lengkap" type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="text_field" placeholder="Isi Nama Lengkap...">
                            </div>

                            <div class="form-group">
                                <label for="user_name">Username</label>
                                <input id="user_name" type="text" name="username" value="{{ old('username') }}" class="text_field" placeholder="Isi username...">
                                @if($errors->has('username'))  <small style="color: red">{{ $errors->first('username') }}</small> @endif
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" name="password" class="text_field" placeholder="Isi password...">
                                @if($errors->has('password'))  <small style="color: red">password harus di isi</small> @endif
                            </div>

                            {{-- <div class="form-group">
                                <label for="con_pass">Confirm Password</label>
                                <input id="con_pass" type="text" class="text_field" placeholder="Confirm password">
                            </div> --}}

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" class="text_field" placeholder="Isi email...">
                                @if($errors->has('email'))  <small style="color: red">{{ $errors->first('email') }}</small> @endif
                            </div>

                            <div class="form-group">
                                <label for="nomor_hp">Nomor HP</label>
                                <input id="nomor_hp" type="text" name="nomor_hp" value="{{ old('nomor_hp') }}" class="text_field" placeholder="Isi nomor hp...">
                                @if($errors->has('nomor_hp'))  <small style="color: red">{{ $errors->first('nomor_hp') }}</small> @endif
                            </div>

                            <button class="btn btn--md btn--round register_btn" type="submit">Daftar Sekarang</button>

                            <div class="login_assist">
                                <p>Sudah punya akun ?
                                    <a href="{{ URL::to('login') }}">Masuk</a>
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