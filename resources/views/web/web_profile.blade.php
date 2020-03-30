@extends('mpnj.layout.main')

@section('title','Profil Pengguna')


@section('content')


<section class="mb-5" id="profile_konsumen">
	<br>
	<div class="container">
		<div class="row">

			<aside class="col-md-3">
				<!--   SIDEBAR   -->

				<div class="list-group">
					<a href="{{ URL::to('profile') }}"
						class="{{ Route::currentRouteName() == 'profile' ? 'active' : '' }} list-group-item list-group-item-action">Profil</a>
					<a href="{{ URL::to('profile/alamat') }}"
						class="{{ Route::currentRouteName() == 'alamat' ? 'active' : '' }} list-group-item list-group-item-action">Alamat</a>
					<a href="{{ URL::to('pesanan') }}"
						class="{{ Route::currentRouteName() == 'pesanan' ? 'active' : '' }} list-group-item list-group-item-action">Transaksi</a>
					<a href="#" class="list-group-item list-group-item-action" data-target="#modalKonfirmasi"
						data-toggle="modal">Konfirmasi</a>
				</div>

				<a class="btn btn-light btn-block" href="{{ route('keluar') }}"> <i class="fa fa-power-off"></i> <span
						class="text">Keluar</span> </a>
				<!--   SIDEBAR .//END   -->
			</aside>
			<main class="col-md-9">
				<article class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								{{-- <h6 class="text-muted">Profile</h6>
                                    <p>{{ Auth::guard(Session::get('role'))->user()->nama_lengkap }} <br>
								No Telp : {{ Auth::guard(Session::get('role'))->user()->nomor_hp }}<br>
								Alamat : {{ Auth::guard(Session::get('role'))->user()->alamat_utama }}
								</p> --}}
								@if(Route::currentRouteName() == 'profile')
								@include('web.profile.profile')
								@elseif(Route::currentRouteName() == 'rekening')
								@include('web.profile.rekening')
								@elseif(Route::currentRouteName() == 'alamat')
								@include('web.profile.alamat')
								@elseif(Route::currentRouteName() == 'pesanan')
								@include('web.profile.pesanan')
								@elseif(Route::currentRouteName() == 'pesananDetail')
								@include('web.profile.pesanan_detail')
								@endif
							</div>
						</div>
					</div> <!-- row.// -->
				</article> <!-- order-group.// -->
			</main>
		</div>
	</div>
</section>

<div class="modal fade" id="modalKonfirmasi" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Masukkan Kode Transaksi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<form action="{{ route('cek') }}">
					<div class="form-group mb-0">
						<input type="input" name="kodeTransaksi" class="form-control" id="kodeTransaksi"
							placeholder="Kode Transaksi">
						<label for="exampleInputEmail1" class="mb-0">Salin Kode Transaksi Anda Disini</label>
					</div>
					<button type="submit" class="btn btn-primary">Kirim</button>
				</form>
			</div>
			<div class="modal-footer">

			</div>
		</div>
	</div>
</div>

@endsection