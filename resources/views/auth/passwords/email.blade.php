@extends('mpnj.layout.main')

@section('title','Email')

@section('content')


<div class="container">
  <div class="row my-3 justify-content-center">
    <div class="col-md-7">
      @if(session('emailNotFound'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>{{ session('emailNotFound') }}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @elseif(session('emailSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{ session('emailSuccess') }}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      <div class="card card-lg">
        <div class="card-header">
          <h5 class="card-title">Halo, Selamat Datang</h5>
          <p>Masukkan email anda untuk dapat mereset password akun kamu. Pastikan email anda masukkan adalah email yang terdaftar pada Belanj.id</p>
        </div>
        <div class="card-body">

          <form action="{{ URL::to('password/email') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="Email">Email</label>
              <input id="Email" name="email" class="form-control form-control-alternative" placeholder="Masukkan Email" type="email" required>
            </div> <!-- form-group// -->
            <button type="submit" class="btn btn-success">Submit</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection