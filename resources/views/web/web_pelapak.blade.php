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
				<div class="row">
					@forelse($produk->sortByDesc('diskon') as $p)
					<div class="col-xl-2 col-lg-3 col-md-4 col-6">
						<div href="{{ URL::to('produk/'.$p->slug) }}" class="card card-sm card-product-grid shadow-sm">
							<a href="{{ URL::to('produk/'.$p->slug) }}" class=""> <img class="card-img-top" src="{{ asset('assets/foto_produk/'.$p->foto_produk[0]->foto_produk) }}"> </a>
							<figcaption class="info-wrap">
								<div class="namaProduk-rapi">
									<a href="{{ URL::to('produk/'.$p->slug) }}" class="title">{{ $p->nama_produk }}</a>
								</div>
								<div class="price mt-1">
									@if($p->diskon == 0)
									<span>
										<span style="font-size:12px;margin-right:-2px;">Rp</span> <span style="font-size:14px;">@currency($p->harga_jual)</span>
									</span>
									@else

									<span style="color: green">
										<span style="font-size:12px;margin-right:-2px;">Rp</span> <span style="font-size:14px;">@currency($p->harga_jual - ($p->diskon / 100 * $p->harga_jual))</span>
									</span>
									<span style="color: gray">
										<strike><span style="font-size:12px;margin-right:-2px;">Rp</span> <span style="font-size:12px;">@currency($p->harga_jual)</span></strike>
									</span>
									@endif
								</div> <!-- price-wrap.// -->
								<div class="row">
									<div class="col" style="">
										<ul class="rating-stars">
											<li style="width:50%" class="stars-active">
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star" style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star" style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i>
											</li>
											<li>
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star" style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star" style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i>
											</li>
										</ul>
										<span class="rating-stars" style="font-size:small;">(125)</span>
									</div> <!-- rating-wrap.// -->

								</div>
								<div class="row">
									<div class="col" style="font-size:small">PAITON {{$p->kota}}</div> <!-- selesaikan API nya ya -->
									<div class="text-right col text-success" style="font-size:small;">{{$p->terjual}} terjual</div>
								</div>
							</figcaption>
						</div>
					</div>
					@empty
					<div class="alert alert-warning col-lg-12 col-sm-12 col-md-12 text-center">
						Pencarian Tidak Ditemukan <a href="{{url::to('/')}}" class="btn btn-warning">Kembali ke Beranda</a>
					</div>
					@endforelse
				</div> <!-- row.// -->
			</div>
			<div class="tab-pane fade @if(app('request')->input('tab') == 'semua') active @endif" id="semua" role="tabpanel" aria-labelledby="nav-contact-tab">
				<div class="row">
					@forelse($produk as $p)
					<div class="col-xl-2 col-lg-3 col-md-4 col-6">
						<div href="{{ URL::to('produk/'.$p->slug) }}" class="card card-sm card-product-grid shadow-sm">
							<a href="{{ URL::to('produk/'.$p->slug) }}" class=""> <img class="card-img-top" src="{{ asset('assets/foto_produk/'.$p->foto_produk[0]->foto_produk) }}"> </a>
							<figcaption class="info-wrap">
								<div class="namaProduk-rapi">
									<a href="{{ URL::to('produk/'.$p->slug) }}" class="title">{{ $p->nama_produk }}</a>
								</div>
								<div class="price mt-1">
									@if($p->diskon == 0)
									<span>
										<span style="font-size:12px;margin-right:-2px;">Rp</span> <span style="font-size:14px;">@currency($p->harga_jual)</span>
									</span>
									@else

									<span style="color: green">
										<span style="font-size:12px;margin-right:-2px;">Rp</span> <span style="font-size:14px;">@currency($p->harga_jual - ($p->diskon / 100 * $p->harga_jual))</span>
									</span>
									<span style="color: gray">
										<strike><span style="font-size:12px;margin-right:-2px;">Rp</span> <span style="font-size:12px;">@currency($p->harga_jual)</span></strike>
									</span>
									@endif
								</div> <!-- price-wrap.// -->
								<div class="row">
									<div class="col" style="">
										<ul class="rating-stars">
											<li style="width:50%" class="stars-active">
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star" style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star" style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i>
											</li>
											<li>
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star" style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star" style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i>
											</li>
										</ul>
										<span class="rating-stars" style="font-size:small;">(125)</span>
									</div> <!-- rating-wrap.// -->

								</div>
								<div class="row">
									<div class="col" style="font-size:small">PAITON {{$p->kota}}</div> <!-- selesaikan API nya ya -->
									<div class="text-right col text-success" style="font-size:small;">{{$p->terjual}} terjual</div>
								</div>
							</figcaption>
						</div>
					</div>
					@empty
					<div class="alert alert-warning col-lg-12 col-sm-12 col-md-12 text-center">
						Pencarian Tidak Ditemukan <a href="{{url::to('/')}}" class="btn btn-warning">Kembali ke Beranda</a>
					</div>
					@endforelse
				</div> <!-- row.// -->
			</div>
		</div>
	</section>
</div>

@endsection