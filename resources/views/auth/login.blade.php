@extends('mpnj.layout.main')

@section('title','Login')


@section('content')


<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <!-- ========================= SECTION CONTENT ========================= -->
            <section class="section-conten padding-y" style="min-height:84vh">

                <!-- ============================ COMPONENT LOGIN   ================================= -->
                <div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center">Login</h4>
                        @if(session('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="alert_icon lnr lnr-warning"></span>
                            {{ session('loginError') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fas fa-times h6" aria-hidden="true"></span>
                            </button>
                        </div>
                        @endif
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input name="username" class="form-control" placeholder="Username" type="text" required>
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <input name="password" class="form-control" placeholder="Password" type="password" required>
                            </div> <!-- form-group// -->

                            <!-- <div class="form-group">
          	<a href="#" class="float-right">Forgot password?</a> 
            <label class="float-left custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input" checked=""> <div class="custom-control-label"> Remember </div> </label>
          </div> form-group form-check .// -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"> Login </button>
                            </div> <!-- form-group// -->
                            <div class="mt-2">
                                <a href="{{ URL::to('register') }}" class="text-center">Belum punya akun,register</a>
                                <a class="float-right float-right" href="{{ URL::to('password/reset') }}">Lupa Password</a>
                            </div>
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

<!--================================
            END LOGIN AREA
    =================================-->
@endsection
@push('scripts')
<script>
    $(function() {
        $("#btn-show").click(function() {
            if('password' == $('#password').attr('type')){
                $('#password').prop('type', 'text');
                $('#icon').attr('class', 'fa fa-unlock-alt');
            }else{
                $('#password').prop('type', 'password');
                $('#icon').attr('class', 'fa fa-lock');
            }
        });

    });
</script>
@endpush