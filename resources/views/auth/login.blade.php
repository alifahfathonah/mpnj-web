@extends('mpnj.layout.main')

@section('title','Login')
    

@section('content')


{{-- 
<div class="container">
    <div class="row my-3 justify-content-center">
        <div class="col-md-7">
            
<div class="card card-lg">
    <div class="card-header">
        <h5 class="card-title"> Selamat Datang, Silahkan Login</h5>
    </div>
    <div class="card-body">
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
        <div class="form-group">
           <label for="username">Username</label>
           <input id="username" name="username" class="form-control form-control-alternative" placeholder="Masukkan Username" type="text">
        </div> <!-- form-group// -->
        <div class="form-group">
          <label for="pass">Password</label>
          <input id="pass" name="password" class="form-control  form-control-alternative" placeholder="Masukkan Password" type="password">
        </div>
       
        <a href="{{ URL::to('register') }}" class="text-center text-info">Belum punya akun,register</a>
        <a class="float-right text-info float-right" href="{{ URL::to('password/reset') }}">Lupa Password</a>
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
    
</div>
</div>
</div> --}}

<link rel="stylesheet" type="text/css" href="{{ url('assets/mpnj/css/main.css ') }} ">
<script src="{{ url('assets/mpnj/js/main.js')}}"></script>

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
            <span class="login100-form-title p-b-30 my-2 font-weight-bold">Login MPNJ</span>
            <li class="login100-form-title p-b-20 mt-2"><a href="#">
                    <img width="100px" src="{{ url('assets/mpnj/images/nj.png') }}"></a></li>
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
                    LOGIN <i class="fa fa-sign-in" aria-hidden="true"></i>
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
