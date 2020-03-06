@extends('mpnj.layout.main')

@section('title','Market Place PP Nurul Jadid')


@section('content')
    
<div class="container profile-page bg-white">
    <div class="row">
        <div class="col-xl-4 col-lg-7 col-md-12 mt-5">
            <div class="card profile-header bg-dark">
                <div class="body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="profile-image float-md-right"> <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt=""> </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-12">
                            <h4 class="m-t-0 m-b-0"><strong>Indra</strong> Store</h4>
                            <span class="job_post">Aktif 2 menit yang lalu</span>
                            
                            <div class="mt-2">
                                    <button class="btn btn-outline-light btn-round">Follow</button>
                                    <button class="btn btn-outline-light btn-round btn-simple">Message</button>
                                </div>               
                        </div> 
                    </div>
                </div>                    
            </div>
        </div>
        
        
        <div class="col-xl-8 col-lg-7 col-md-12 mt-5">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                        <td><i class="fas fa-store"></i> Produk : <span class="text-primary">114</span></td>
                        <td><i class="fas fa-store"></i> Waktu Pengemasan : <span class="text-primary">Lambat (Lebih dari 2 hari)</span></td>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        
                        <td><i class="fas fa-store"></i> Waktu Pengemasan : <span class="text-primary">Lambat (Lebih dari 2 hari)</span></td>
                        <td><i class="fas fa-store"></i> Waktu Pengemasan : <span class="text-primary">Lambat (Lebih dari 2 hari)</span></td>
                        </tr>
                        <tr>
                        <td><i class="fas fa-store"></i> Mengikuti : <span class="text-primary">20</span></td>
                        <td><i class="fas fa-store"></i> Waktu Pengemasan : <span class="text-primary">Lambat (Lebih dari 2 hari)</span></td>
                        </tr>
                        <tr>
                        <td><i class="fas fa-store"></i> Total Ranting : <span class="text-primary">Lambat (Lebih dari 2 hari)</span></td>
                        <td><i class="fas fa-store"></i> Waktu Pengemasan : <span class="text-primary">Lambat (Lebih dari 2 hari)</span></td>
                        </tr>
                    </tbody>
                    </table>
            </div>
        </div>
	</div>
</div>

<section class="section-content padding-y bg-white">
<nav class="navbar navbar-main navbar-expand-lg border-bottom">
  <div class="container">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="main_nav">
      <ul class="navbar-nav">
        <li class="nav-item">
           <a class="nav-link" href="#">Halaman Utama</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Semua Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Midnight Sale</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Sedang Diskon</a>
        </li>
      </ul>
    </div> <!-- collapse .// -->
  </div> <!-- container .// -->
</nav>
</section>
@endsection