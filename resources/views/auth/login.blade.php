@extends('mpnj.layout.main')

@section('title','Login')
    

@section('content')



@push('scripts')

<link rel="stylesheet" type="text/css" href="{{ url('assets/mpnj/css/main.css ') }} ">
<script src="{{ url('assets/mpnj/js/main.js')}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ url('assets/mpnj/css/material-design-iconic-font.min.css') }}>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
@if(session('loginError'))

<div class="alert alert-danger" role="alert">
    <span class="alert_icon lnr lnr-warning"></span>
    {{ session('loginError') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span class="lnr lnr-cross" aria-hidden="true"></span>
    </button>
</div>
@endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
        <diV>
            <span class="login100-form-title p-b-30 my-2 text-black">Selamat Datang, Silahkan Login!</span>
            <li class="login100-form-title p-b-20 mt-2"><a href="#">
                    <img width="250px" src="{{ asset('assets/mpnj/images/mpnj.jpg') }}"></a></li>
        </div>

        <div class="wrap-input100 validate-input" data-validate="username">
            <input class="input100 font-weight-bold" type="text" name="username">

            <span class="focus-input100" data-placeholder="Masukkan Username"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Enter password">
            <span class="btn-show-pass">
                <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100 font-weight-bold" type="password" name="password" value="">
            <span class="focus-input100" data-placeholder="Masukkan Password"></span>
        </div>

        <div style="margin-top: -20px">
            <a href="{{ URL::to('register') }}" class="text-center text-info">Belum punya akun,register</a>
            <a class="float-right text-info float-right" href="{{ URL::to('password/reset') }}">Lupa Password</a>
        </div>

        <div class="container-login100-form-btn mt-1">
            <div class="wrap-login100-form-btn">

                <div class="login100-form-bgbtn"></div>
                <button class="login100-form-btn" type="submit">
                    LOGIN <i class="fa fa-fw fa-sign-in fa-lg"></i>
            </div>
        </div>


</div>
</form>

</div>
</div>

</div>

<!--================================
            END LOGIN AREA
    =================================-->
@endsection
