@extends('mpnj.layout.main')

@section('title','Profil Pengguna')
    

@section('content')


<section class="mb-5" id="profile_konsumen">
<div class="row justify-content-center my-3 text-warning">
	<h3>Profile Konsumen</h3>
</div>

<div class="row">

	<aside class="col-md-3">
		<!--   SIDEBAR   -->
		<ul class="list-group">
			@if(Route::currentRouteName() == 'profile')
			@include('web.profile.profile')
			@elseif(Route::currentRouteName() == 'rekening')
			@include('web.profile.rekening')
			@elseif(Route::currentRouteName() == 'alamat')
			@include('web.profile.alamat')
		   @endif
			{{-- <a class="list-group-item active" href="#"> My order history </a> --}}
			
		</ul>
		<br>

	<a class="btn btn-light btn-block" href="{{ route('keluar') }}"> <i class="fa fa-power-off"></i> <span class="text">Keluar</span> </a> 
		<!--   SIDEBAR .//END   -->
	</aside>
	<main class="col-md-9">
		<article class="card">
		<header class="card-header">
			<strong class="d-inline-block mr-3">Order ID: 6123456789</strong>
			<span>Bergabung: {{ Auth::guard(Session::get('role'))->user()->created_at->format("d, M Y") }}</span>
		</header>
		<div class="card-body">
			<div class="row"> 
				<div class="col-md-8">
					<h6 class="text-muted">Profile</h6>
					<p>{{ Auth::guard(Session::get('role'))->user()->nama_lengkap }} <br>  
					No Telp : {{ Auth::guard(Session::get('role'))->user()->nomor_hp }}<br>
			    	Alamat : {{ Auth::guard(Session::get('role'))->user()->alamat_utama }}
			 		</p>
				</div>
				<div class="col-md-4">
					<h6 class="text-muted">Payment</h6>
					<span class="text-success">
						<i class="fab fa-lg fa-cc-visa"></i>
					    Visa  **** 4216  
					</span>
					<p>Subtotal: $356 <br>
					 Shipping fee:  $56 <br> 
					 <span class="b">Total:  $456 </span>
					</p>
				</div>
			</div> <!-- row.// -->
		</div> <!-- card-body .// -->
		<div class="table-responsive">
		<table class="table table-hover">
			<tbody>
			<tr>
				<td>
					<img src="{{ asset('assets/foto_profil_konsumen/'.Auth::guard(Session::get('role'))->user()->foto_profil) }}" alt="Presenting the broken author avatar :D">
				</td>
				<td> 
				
							<a href="{{ URL::to('profile') }}" class="{{ Route::currentRouteName() == 'profile' ? 'active' : '' }}">Profile</a>
					<br>
					
							<a href="{{ URL::to('profile/alamat') }}" class="{{ Route::currentRouteName() == 'alamat' ? 'active' : '' }}">Alamat</a></li>
					
				</td>
				<td> Seller <br> ABC shop </td>
				<td> <a href="#" class="btn btn-outline-primary">Track order</a> <a href="#" class="btn btn-light"> Details </a> </td>
			</tr>
		</tbody></table>
		</div> <!-- table-responsive .end// -->
		</article> <!-- order-group.// --> 
	</main>
</div> <!-- row.// -->
</section>

@endsection