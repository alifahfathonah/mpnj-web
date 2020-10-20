@extends('mpnj.layout.main')

@section('title','Daftar')

@section('content')
    <br><br>
    <section class="signup_area section--padding2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="card mb-4">
                        <article class="card-body">
                            <header class="mb-4">
                                <center>
                                    <h4 class="card-title">Buat Akun Kamu Sekarang</h4>
                                    <small>Tolong isi data dibawah ini dengan benar.</small>
                                </center>
                            </header>
                            <form action="{{ route('register') }}" method="POST" id="registerForm"
                                  class="form-horizontal">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" placeholder="" name="nama_lengkap"
                                           value="{{ old('nama_lengkap') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" placeholder="" name="username"
                                           value="{{ old('username') }}" required>
                                    <small style="color: red">{{ $errors->first('username') }}</small>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Hp</label>
                                    <input type="text" class="form-control" placeholder="" name="nomor_hp"
                                           value="{{ old('nomor_hp') }}" required>
                                    <small style="color: red">{{ $errors->first('nomor_hp') }}</small>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="" name="email"
                                           value="{{ old('email') }}" required>
                                    <small style="color: red">{{ $errors->first('email') }}</small>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label>Masukkan Lagi Password</label>
                                    <input class="form-control" type="password" name="password_confirmation" required>
                                    <small style="color: red">{{ $errors->first('password') }}</small>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block"> Daftar Sekarang</button>
                                <div class="login_assist">
                                    <br>
                                    <p>Sudah punya akun ?
                                        <a href="/login">Masuk</a>
                                    </p>
                                </div>
                            </form>
                        </article> <!-- card-body end .// -->
                    </div> <!-- card.// -->

                </div>
                <!-- end .col-md-6 -->
            </div>
            <!-- end .row -->
        </div>
        <!-- end .container -->
    </section>
    <br>
@endsection