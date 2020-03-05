@extends('mpnj.layout.main')

@section('title','Login')
    

@section('content')

  {{-- <section class="my-5">
      <div class="row mt-2 justify-content-center">
        <h1 class="text-danger">Selamat Datang Di MPNJ, Silahkan Login</h1>
    </div>
    <div class="row">
        <div class="col-md-8">

            @if(session('loginError'))
            <div class="alert alert-danger" role="alert">
                <span class="alert_icon lnr lnr-warning"></span>
                {{ session('loginError') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                </button>
            </div>
        @endif
            
           <div class="card justify-content-center">
        <div class="card-body">
            <form action="{{ route('login') }}" method="POST">
                @csrf
            <div class="form-group">
               <label for="username">Username</label>
               <input id="username" name="username" class="form-control form-control-alternative" placeholder="Masukkan Username" type="Username">
            </div> <!-- form-group// -->
            <div class="form-group">
              <a class="float-right text-info" href="{{ URL::to('password/reset') }}">Lupa Password</a>
       
              <label for="pass">Password</label>
              <input id="pass" name="password" class="form-control  form-control-alternative" placeholder="Masukkan Password" type="password">
            </div> <!-- form-group// --> 
            <div class="form-group"> 
              
            </div> <!-- form-group form-check .// -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"> Login  </button>
            </div> <!-- form-group// -->    
        </form>
        <a href="{{ URL::to('register') }}" class="text-center text-info">Belum punya akun,register</a>
        
        </div> <!-- card-body.// -->
      </div> <!-- card .// -->
    </div>
</div>

</div>
</div>
s
</section> --}}

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
</div>
<!--================================
            END LOGIN AREA
    =================================-->
@endsection
