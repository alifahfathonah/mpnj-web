@extends('mpnj.layout.main')

@section('title','Login')
    

@section('content')

  <section class="my-5">
      <div class="row mt-2 justify-content-center">
        <h1 class="text-danger">Selamat Datang Di MPNJ, Silahkan Login</h1>
    </div>
    <div class="row">
        <div class="col-md-8">
            
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
              <input id="pass" class="form-control  form-control-alternative" placeholder="Masukkan Password" type="password">
            </div> <!-- form-group// --> 
            <div class="form-group"> 
              {{-- <label class="custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input" checked=""> <div class="custom-control-label"> Remember </div> </label> --}}
            </div> <!-- form-group form-check .// -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"> Login  </button>
            </div> <!-- form-group// -->    
        </form>
        <a href="{{ URL::to('register') }}" class="text-center text-info">Belum punya akun,register</a>
        {{-- <p class="text-center">New here? <a href="">Sign up</a></p> --}}
        </div> <!-- card-body.// -->
      </div> <!-- card .// -->
    </div>
</div>

</div>
</div>

</section>
    
<!--================================
            END LOGIN AREA
    =================================-->
@endsection
