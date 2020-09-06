@extends('mpnj.layout.main')

@section('title','Market Place PP Nurul Jadid')

@section('content')

<section class="section-content padding-y">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="card-banner overlay-gradient mb-3"
					style="min-height:300px; background-image: url({{ asset('assets/foto_toko/'.$pelapak->foto_toko) }}); border-radius: 10px;">
					<div class="card-img-overlay white d-flex align-items-center">
						<div class="row px-md-5 px-5 d-flex align-items-center">
							<div class="col-lg-4 col-md-4 col-12">
								@if( $pelapak->foto_profil == null)
								<div class="icontext mr-4" style="max-width: 300px;">
									<span class="icon icon-lg rounded-circle border border-white">
										<i class="fa fa-user text-white"></i>
									</span>
								</div>
								@else
								<div class="profile-image float-md-right"> <img
										src="{{ asset('assets/foto_profil_konsumen/'.$pelapak->foto_profil) }}"
										alt="foto_profil" class="img-md rounded-circle border">
								</div>
								@endif
							</div>
							<div class="col-lg-8 col-md-8 col-12">
								<h4 class="m-t-0 m-b-0"><strong>{{ $pelapak->nama_toko }}</strong> Store</h4>
								<span class="job_post">Bergabung : {{ $pelapak->created_at->format("d, M Y") }}</span>
								<div class="mt-2">
									<button class="btn btn-outline-light btn-round"><span class="fa fa-plus"></span>
										Ikuti</button>
									<button class="btn btn-outline-light btn-round"> <span
											class="fa fa-comments"></span>
										Chat</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- col // -->
			<div class="col-md-4">
				<!-- ============================ COMPONENT BANNER 8  ================================= -->
				<div class="card-banner overlay-gradient mb-3"
					style="min-height:300px;background-image: url({{ asset('assets/foto_toko/'.$pelapak->foto_toko) }}); border-radius: 10px;">
					<div class="card-img-overlay ">
						<div class="table-responsive ">
							<table class="table table-borderless text-white">
								<thead>
									<tr>
										<td><i class="fas fa-store"></i> Produk : <span
												class="text">{{ $pelapak->produk->count() }}</span></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><i class="fas fa-clock"></i> Waktu Pengemasan : <span class="text">Lambat
												(Lebih
												dari 2 hari)</span></td>
									</tr>
									<tr>
										<td><i class="fas fa-users"></i> Mengikuti : <span class="text">20</span>
										</td>
									</tr>
									<tr>
										<td><i class="fas fa fa-star"></i> Total Ranting : <span class="text">Lambat
												(Lebih
												dari 2 hari)</span></td>
									</tr>
									<tr>
										<td><i class="fas fa fa-truck"></i> Kurir Tersedia : <span class="text">
												@if($kurir->count()==0)
												Pelapak Belum Mengisi
												@else
												@foreach($kurir as $k)
												<strong>{{$k->kurir}}</strong>-
												@endforeach
												@endif</span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- ============================ COMPONENT BANNER 8  END .// ================================= -->
			</div>
		</div> <!-- row // -->
		<div class="card mb-3" style=" border-radius: 10px;">
			<div class="card-body">
				<h4>Pilih Produk</h4>
				<div class="nav btn-group " id="nav-tab" role="tablist">
					<a class="btn btn-outline-primary nav-link @if(app('request')->input('tab') == 'semua') active @else active @endif"
						id="nav-home-tab" data-toggle="tab" href="#hangat" role="tab" aria-controls="nav-home"
						aria-selected="true" type="button">Baru</a>
					<a class="btn btn-outline-primary nav-link" id="nav-home-tab" data-toggle="tab" href="#diskon"
						role="tab" aria-controls="nav-home" aria-selected="true" type="button">Diskon</a>
					<a class="btn btn-outline-primary  nav-link" id="nav-profile-tab" data-toggle="tab" href="#semua"
						role="tab" aria-controls="nav-profile" aria-selected="false" type="button">Semua</a>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<section class="padding-bottom-sm">

			<header class="section-heading heading-line">
				<h5 class="title-section text-uppercase">Produk</h5>
			</header>
			<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show @if(app('request')->input('tab') == 'hangat') active @else active @endif"
					id="hangat" role="tabpanel" aria-labelledby="nav-home-tab">
					<div class="row">
						@forelse($produk->sortByDesc('id_produk') as $p)
						<div class="col-xl-2 col-lg-3 col-md-4 col-6">
							<div href="{{ URL::to('produk/'.$p->slug) }}"
								class="card card-sm card-product-grid shadow-sm">
								<a href="{{ URL::to('produk/'.$p->slug) }}" class=""> <img class="card-img-top"
										src="{{ asset('assets/foto_produk/'.$p->foto_produk[0]->foto_produk) }}"> </a>
								<figcaption class="info-wrap">
									<div class="namaProduk-rapi">
										<a href="{{ URL::to('produk/'.$p->slug) }}"
											class="title">{{ $p->nama_produk }}</a>
									</div>
									<div class="price mt-1">
										@if($p->diskon == 0)
										<span>
											<span style="font-size:12px;margin-right:-2px;">Rp</span> <span
												style="font-size:14px;">@currency($p->harga_jual)</span>
										</span>
										@else

										<span style="color: green">
											<span style="font-size:12px;margin-right:-2px;">Rp</span> <span
												style="font-size:14px;">@currency($p->harga_jual - ($p->diskon / 100 *
												$p->harga_jual))</span>
										</span>
										<span style="color: gray">
											<strike><span style="font-size:12px;margin-right:-2px;">Rp</span> <span
													style="font-size:12px;">@currency($p->harga_jual)</span></strike>
										</span>
										@endif
									</div> <!-- price-wrap.// -->
									<div class="row">
										<div class="col" style="">
											<ul class="rating-stars">
												<li style="width:50%" class="stars-active">
													<i class="fa fa-star" style="font-size:small"></i> <i
														class="fa fa-star" style="font-size:small"></i>
													<i class="fa fa-star" style="font-size:small"></i> <i
														class="fa fa-star" style="font-size:small"></i>
													<i class="fa fa-star" style="font-size:small"></i>
												</li>
												<li>
													<i class="fa fa-star" style="font-size:small"></i> <i
														class="fa fa-star" style="font-size:small"></i>
													<i class="fa fa-star" style="font-size:small"></i> <i
														class="fa fa-star" style="font-size:small"></i>
													<i class="fa fa-star" style="font-size:small"></i>
												</li>
											</ul>
											<span class="rating-stars" style="font-size:small;">(125)</span>
										</div> <!-- rating-wrap.// -->

									</div>
									<div class="row">
										<div class="col" style="font-size:small">PAITON {{$p->kota}}</div>
										<!-- selesaikan API nya ya -->
										<div class="text-right col text-success" style="font-size:small;">
											{{$p->terjual}}
											terjual</div>
									</div>
								</figcaption>
							</div>
						</div>
						@empty
						<div class="alert alert-warning col-lg-12 col-sm-12 col-md-12 text-center">
							Produk Tidak Ada
						</div>
						@endforelse
					</div> <!-- row.// -->
				</div>
				<div class="tab-pane fade @if(app('request')->input('tab') == 'diskon') active @endif" id="diskon"
					role="tabpanel" aria-labelledby="nav-profile-tab">
					<div class="row">
						@forelse($produk->sortByDesc('diskon') as $p)
						@if($p->diskon != 0)
						<div class="col-xl-2 col-lg-3 col-md-4 col-6">
							<div href="{{ URL::to('produk/'.$p->slug) }}"
								class="card card-sm card-product-grid shadow-sm">
								<a href="{{ URL::to('produk/'.$p->slug) }}" class=""> <img class="card-img-top"
										src="{{ asset('assets/foto_produk/'.$p->foto_produk[0]->foto_produk) }}"> </a>
								<figcaption class="info-wrap">
									<div class="namaProduk-rapi">
										<a href="{{ URL::to('produk/'.$p->slug) }}"
											class="title">{{ $p->nama_produk }}</a>
									</div>
									<div class="price mt-1">

										<span style="color: green">
											<span style="font-size:12px;margin-right:-2px;">Rp</span> <span
												style="font-size:14px;">@currency($p->harga_jual - ($p->diskon / 100 *
												$p->harga_jual))</span>
										</span>
										<span style="color: gray">
											<strike><span style="font-size:12px;margin-right:-2px;">Rp</span> <span
													style="font-size:12px;">@currency($p->harga_jual)</span></strike>
										</span>

									</div> <!-- price-wrap.// -->
									<div class="row">
										<div class="col" style="">
											<ul class="rating-stars">
												<li style="width:50%" class="stars-active">
													<i class="fa fa-star" style="font-size:small"></i> <i
														class="fa fa-star" style="font-size:small"></i>
													<i class="fa fa-star" style="font-size:small"></i> <i
														class="fa fa-star" style="font-size:small"></i>
													<i class="fa fa-star" style="font-size:small"></i>
												</li>
												<li>
													<i class="fa fa-star" style="font-size:small"></i> <i
														class="fa fa-star" style="font-size:small"></i>
													<i class="fa fa-star" style="font-size:small"></i> <i
														class="fa fa-star" style="font-size:small"></i>
													<i class="fa fa-star" style="font-size:small"></i>
												</li>
											</ul>
											<span class="rating-stars" style="font-size:small;">(125)</span>
										</div> <!-- rating-wrap.// -->

									</div>
									<div class="row">
										<div class="col" style="font-size:small">PAITON {{$p->kota}}</div>
										<!-- selesaikan API nya ya -->
										<div class="text-right col text-success" style="font-size:small;">
											{{$p->terjual}}
											terjual</div>
									</div>
								</figcaption>
							</div>
						</div>
						@endif
						@empty
						<div class="alert alert-warning col-lg-12 col-sm-12 col-md-12 text-center">
							Produk Tidak Ada
						</div>
						@endforelse
					</div> <!-- row.// -->
				</div>
				<div class="tab-pane fade @if(app('request')->input('tab') == 'semua') active @endif" id="semua"
					role="tabpanel" aria-labelledby="nav-contact-tab">
					<div class="row">
						@forelse($produk as $p)
						<div class="col-xl-2 col-lg-3 col-md-4 col-6">
							<div href="{{ URL::to('produk/'.$p->slug) }}"
								class="card card-sm card-product-grid shadow-sm">
								<a href="{{ URL::to('produk/'.$p->slug) }}" class=""> <img class="card-img-top"
										src="{{ asset('assets/foto_produk/'.$p->foto_produk[0]->foto_produk) }}"> </a>
								<figcaption class="info-wrap">
									<div class="namaProduk-rapi">
										<a href="{{ URL::to('produk/'.$p->slug) }}"
											class="title">{{ $p->nama_produk }}</a>
									</div>
									<div class="price mt-1">
										@if($p->diskon == 0)
										<span>
											<span style="font-size:12px;margin-right:-2px;">Rp</span> <span
												style="font-size:14px;">@currency($p->harga_jual)</span>
										</span>
										@else

										<span style="color: green">
											<span style="font-size:12px;margin-right:-2px;">Rp</span> <span
												style="font-size:14px;">@currency($p->harga_jual - ($p->diskon / 100 *
												$p->harga_jual))</span>
										</span>
										<span style="color: gray">
											<strike><span style="font-size:12px;margin-right:-2px;">Rp</span> <span
													style="font-size:12px;">@currency($p->harga_jual)</span></strike>
										</span>
										@endif
									</div> <!-- price-wrap.// -->
									<div class="row">
										<div class="col" style="">
											<ul class="rating-stars">
												<li style="width:50%" class="stars-active">
													<i class="fa fa-star" style="font-size:small"></i> <i
														class="fa fa-star" style="font-size:small"></i>
													<i class="fa fa-star" style="font-size:small"></i> <i
														class="fa fa-star" style="font-size:small"></i>
													<i class="fa fa-star" style="font-size:small"></i>
												</li>
												<li>
													<i class="fa fa-star" style="font-size:small"></i> <i
														class="fa fa-star" style="font-size:small"></i>
													<i class="fa fa-star" style="font-size:small"></i> <i
														class="fa fa-star" style="font-size:small"></i>
													<i class="fa fa-star" style="font-size:small"></i>
												</li>
											</ul>
											<span class="rating-stars" style="font-size:small;">(125)</span>
										</div> <!-- rating-wrap.// -->

									</div>
									<div class="row">
										<div class="col" style="font-size:small">PAITON {{$p->kota}}</div>
										<!-- selesaikan API nya ya -->
										<div class="text-right col text-success" style="font-size:small;">
											{{$p->terjual}}
											terjual</div>
									</div>
								</figcaption>
							</div>
						</div>
						@empty
						<div class="alert alert-warning col-lg-12 col-sm-12 col-md-12 text-center">
							Produk Tidak Ada
						</div>
						@endforelse
					</div> <!-- row.// -->
				</div>
			</div>
		</section>
	</div>
</section>

@endsection