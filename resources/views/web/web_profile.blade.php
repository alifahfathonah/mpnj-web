@extends('mpnj.layout.main')

@section('title','Profil Pengguna')


@section('content')


	<section class="mb-5" id="profile_konsumen">
		<div class="row justify-content-center my-3 text-warning">
			<h3>Profile Konsumen</h3>
		</div>

		<div class="container">
			<div class="row">

				<aside class="col-md-3">
					<!--   SIDEBAR   -->

					<div class="list-group">
						<a href="{{ URL::to('profile') }}" class="{{ Route::currentRouteName() == 'profile' ? 'active' : '' }} list-group-item list-group-item-action">Profil</a>
						<a href="{{ URL::to('profile/alamat') }}" class="{{ Route::currentRouteName() == 'alamat' ? 'active' : '' }} list-group-item list-group-item-action">Alamat</a>
						<a href="{{ URL::to('pesanan') }}" class="{{ Route::currentRouteName() == 'pesanan' ? 'active' : '' }} list-group-item list-group-item-action">Transaksi</a>
					</div>

					<a class="btn btn-light btn-block" href="{{ route('keluar') }}"> <i class="fa fa-power-off"></i> <span class="text">Keluar</span> </a>
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
			</div> <!-- card-body .// -->
			{{--				<div class="table-responsive">--}}
			{{--					--}}{{-- <table class="table table-hover">--}}
			{{--                        <tbody>--}}
			{{--                        <tr>--}}
			{{--                            <td>--}}
			{{--                                <img width="200px" src="{{ asset('assets/foto_profil_konsumen/'.Auth::guard(Session::get('role'))->user()->foto_profil) }}" alt="Presenting the broken author avatar :D">--}}
			{{--                            </td>--}}
			{{--                            <td> Seller <br> ABC shop </td>--}}
			{{--                            <td> <a href="#" class="btn btn-outline-primary">Track order</a> <a href="#" class="btn btn-light"> Details </a> </td>--}}
			{{--                        </tr>--}}
			{{--                    </tbody></table> --}}
			{{--				</div> <!-- table-responsive .end// -->--}}
			</article> <!-- order-group.// -->
			</main>
		</div>
		</div>
	</section>

@endsection