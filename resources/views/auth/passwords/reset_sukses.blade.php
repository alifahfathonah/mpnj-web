@extends('mpnj.layout.main')

@section('title','Konfirmasi Sukses')

@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <!-- ========================= SECTION CONTENT ========================= -->
                <section class="section-conten padding-y" style="min-height:84vh">

                    <!-- ============================ COMPONENT LOGIN   ================================= -->
                    <div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
                        <div class="card-body">
                            <h4 class="card-title" style="text-align: center">Reset Password Sukses</h4>
                            Terima kasih. Password anda berhasil diperbarui. Anda dapat login menggunakan username dan password baru anda.
                        </div> <!-- card-body.// -->

                        <div class="form-group">
                            <a href="{{ URL::to('login') }}" class="btn btn-primary btn-block">Login</a>
                        </div>
                    </div> <!-- card .// -->

                </section>
                <!-- ========================= SECTION CONTENT END// ========================= -->
            </div>
        </div>

    </div>
@endsection