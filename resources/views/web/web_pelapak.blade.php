@extends('mpnj.layout.main')

@section('title','Market Place PP Nurul Jadid')

@section('content')

<div class="container profile-page bg-white">
	<div class="row">
		<div class="col-xl-4 col-lg-7 col-md-12 mt-5">
			<div class="card-pelapak profile-header bg-dark">
				<div class="body">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-12">
							<div class="profile-image float-md-right"> <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt=""> </div>
						</div>
						<div class="col-lg-8 col-md-8 col-12">
							<h4 class="m-t-0 m-b-0"><strong>{{ $pelapak->username }}</strong> Store</h4>
							<span class="job_post">Bergabung : {{ $pelapak->created_at->format("d, M Y") }}</span>

							<div class="mt-2">
								<button class="btn btn-outline-light btn-round">Ikuti</button>
								<button class="btn btn-outline-light btn-round btn-simple">Ikuti</button>
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
							<td><i class="fas fa-store"></i> Produk : <span class="text-primary">{{ $pelapak->produk->count() }}</span></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><i class="fas fa-store"></i> Waktu Pengemasan : <span class="text-primary">Lambat (Lebih dari 2 hari)</span></td>
						</tr>
						<tr>
							<td><i class="fas fa-store"></i> Mengikuti : <span class="text-primary">20</span></td>
						</tr>
						<tr>
							<td><i class="fas fa-store"></i> Total Ranting : <span class="text-primary">Lambat (Lebih dari 2 hari)</span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<section class="section-content padding-y bg-white">
	<nav class="navbar navbar-main navbar-expand-lg border-bottom">
		<!-- <div class="container"> -->
		<div class="col-md-12">
			<h4>Pilih Produk</h4>
			<nav style="width: 100%">
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					<a class="nav-item nav-link @if(app('request')->input('tab') == 'semua') active @else active @endif" id="nav-home-tab" data-toggle="tab" href="#hangat" role="tab" aria-controls="nav-home" aria-selected="true">Produk Baru</a>
					<a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#diskon" role="tab" aria-controls="nav-home" aria-selected="true">Produk Diskon</a>
					<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#semua" role="tab" aria-controls="nav-profile" aria-selected="false">Semua Produk</a>
				</div>
			</nav>
		</div>
	</nav>
</section>

<div class="container">
	<section class="padding-bottom-sm">

		<header class="section-heading heading-line">
			<h5 class="title-section text-uppercase">Produk</h5>
		</header>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show @if(app('request')->input('tab') == 'hangat') active @else active @endif" id="hangat" role="tabpanel" aria-labelledby="nav-home-tab">
				<div class="row row-sm">
					@foreach($produk->sortByDesc('id_produk') as $pl)
					<div class="col-xl-2 col-lg-3 col-md-4 col-6">
						<div href="{{ URL::to('produk/'.$pl->slug) }}" class="card card-sm card-product-grid">
							<a class="img-wrap"> <img src="{{ asset('assets/foto_produk/'.$pl->foto_produk[0]->foto_produk) }}"> </a>
							<figcaption class="info-wrap">
								<a href="{{ URL::to('produk/'.$pl->slug) }}" class="title">{{ $pl->nama_produk }}</a>
								<div class="price-wrap">
									@if($pl->diskon == 0)
									@currency($pl->harga_jual)
									@else
									<strike style="color: red">
										@currency($pl->harga_jual)
									</strike> @currency($pl->harga_jual - ($pl->diskon / 100 * $pl->harga_jual))
									@endif
								</div>
							</figcaption>
						</div>
					</div> <!-- col.// -->
					@endforeach
				</div> <!-- row.// -->
			</div>
			<div class="tab-pane fade @if(app('request')->input('tab') == 'diskon') active @endif" id="diskon" role="tabpanel" aria-labelledby="nav-profile-tab">
				<div class="row row-sm">
					@foreach($produk->sortByDesc('diskon') as $pl)
					<div class="col-xl-2 col-lg-3 col-md-4 col-6">
						<div href="{{ URL::to('produk/'.$pl->slug) }}" class="card card-sm card-product-grid">
							<a class="img-wrap"> <img src="{{ asset('assets/foto_produk/'.$pl->foto_produk[0]->foto_produk) }}"> </a>
							<figcaption class="info-wrap">
								<a href="{{ URL::to('produk/'.$pl->slug) }}" class="title">{{ $pl->nama_produk }}</a>
								<div class="price-wrap">
									@if($pl->diskon == 0)
									@currency($pl->harga_jual)
									@else
									<strike style="color: red">
										@currency($pl->harga_jual)
									</strike> @currency($pl->harga_jual - ($pl->diskon / 100 * $pl->harga_jual))
									@endif
								</div>
							</figcaption>
						</div>
					</div> <!-- col.// -->
					@endforeach
				</div> <!-- row.// -->
			</div>
			<div class="tab-pane fade @if(app('request')->input('tab') == 'semua') active @endif" id="semua" role="tabpanel" aria-labelledby="nav-contact-tab">
				<div class="row row-sm">
					@foreach($produk as $pl)
					<div class="col-xl-2 col-lg-3 col-md-4 col-6">
						<div href="{{ URL::to('produk/'.$pl->slug) }}" class="card card-sm card-product-grid">
							<a class="img-wrap"> <img src="{{ asset('assets/foto_produk/'.$pl->foto_produk[0]->foto_produk) }}"> </a>
							<figcaption class="info-wrap">
								<a href="{{ URL::to('produk/'.$pl->slug) }}" class="title">{{ $pl->nama_produk }}</a>
								<div class="price-wrap">
									@if($pl->diskon == 0)
									@currency($pl->harga_jual)
									@else
									<strike style="color: red">
										@currency($pl->harga_jual)
									</strike> @currency($pl->harga_jual - ($pl->diskon / 100 * $pl->harga_jual))
									@endif
								</div>
							</figcaption>
						</div>
					</div> <!-- col.// -->
					@endforeach
				</div> <!-- row.// -->
			</div>
		</div>
	</section>
</div>

@endsection