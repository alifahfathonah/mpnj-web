@extends('mpnj.layout.main')

@section('title','Email')

@section('content')
   

<div class="container">
    <div class="row my-3 justify-content-center">
        <div class="col-md-7">
            
<div class="card card-lg">
    <div class="card-header">
        <h5 class="card-title">Halo, Selamat Datang</h5>
        <p>Masukkan email kamu untuk dapat mereset password akun kamu.</p>
    </div>
    <div class="card-body">
        
        <form action="{{ URL::to('password/email') }}" method="POST">
            @csrf
        <div class="form-group">
           <label for="Email">Email</label>
           <input id="Email" name="email" class="form-control form-control-alternative" placeholder="Masukkan Email" type="email">
        </div> <!-- form-group// -->
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
    </div>
  </div>
    
</div>
</div>
</div>

@endsection
