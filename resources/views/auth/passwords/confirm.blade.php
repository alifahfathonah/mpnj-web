@extends('mpnj.layout.main')

@section('title','Konfirmasi Password')

@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <!-- ========================= SECTION CONTENT ========================= -->
                <section class="section-conten padding-y" style="min-height:84vh">

                    <!-- ============================ COMPONENT LOGIN   ================================= -->
                    <div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
                        <div class="card-body">
                            <h4 class="card-title" style="text-align: center">Reset Password</h4>
                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ app('request')->input('id') }}">
                                <div class="form-group">
                                    <input name="password" class="form-control" placeholder="Password Baru" type="password" id="password" required>
                                    <small style="color: red">{{ $errors->first('password') }}</small>
                                </div>
                                <div class="input-group mb-2">
                                    <input name="password_confirmation" class="form-control" placeholder="Confirm Password" type="password"
                                           id="confirm_password" required> <span class="input-group-append">
                                        <a class="btn btn-primary" id="btn-show" style="color: white"> <i class="fa fa-lock" id="icon"></i></a></span>
                                    <small style="color: red">{{ $errors->first('password_confirmation') }}</small>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"> Lanjutkan </button>
                                </div> <!-- form-group// -->
                            </form>
                        </div> <!-- card-body.// -->
                    </div> <!-- card .// -->

                    <!-- <a class="text-center mt-4">Don't have account? <a href="#">Sign up</a></p> -->
                    <br><br>
                    <!-- ============================ COMPONENT LOGIN  END.// ================================= -->

                </section>
                <!-- ========================= SECTION CONTENT END// ========================= -->
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $("#btn-show").click(function() {
                if('password' == $('#password').attr('type')){
                    $('#password').prop('type', 'text');
                    $('#confirm_password').prop('type', 'text');
                    $('#icon').attr('class', 'fa fa-unlock-alt');
                }else{
                    $('#password').prop('type', 'password');
                    $('#confirm_password').prop('type', 'password');
                    $('#icon').attr('class', 'fa fa-lock');
                }
            });

        });
    </script>
@endpush