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
							<div class="profile-image float-md-right"> <img
									src="https://bootdey.com/img/Content/avatar/avatar7.png" alt=""> </div>
						</div>
						<div class="col-lg-8 col-md-8 col-12">
							<h4 class="m-t-0 m-b-0"><strong>{{ $pelapak->username }}</strong> Store</h4>
							<span class="job_post">Bergabung : {{ $pelapak->created_at->format("d, M Y") }}</span>

							<div class="mt-2">
								<button class="btn btn-outline-light btn-round"><span class="fa fa-plus"></span>
									Ikuti</button>
								<button class="btn btn-outline-light btn-round"> <span class="fa fa-comments"></span>
									Chat</button>
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
							<td><i class="fas fa-store"></i> Produk : <span
									class="text-primary">{{ $pelapak->produk->count() }}</span></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><i class="fas fa-store"></i> Waktu Pengemasan : <span class="text-primary">Lambat (Lebih
									dari 2 hari)</span></td>
						</tr>
						<tr>
							<td><i class="fas fa-store"></i> Mengikuti : <span class="text-primary">20</span></td>
						</tr>
						<tr>
							<td><i class="fas fa-store"></i> Total Ranting : <span class="text-primary">Lambat (Lebih
									dari 2 hari)</span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="card-banner banner-quote overlay-gradient"
				style="background-image: url('images/banners/banner9.jpg');">
				<div class="card-img-overlay white">
					<h3 class="card-title">An easy way to send request to suppliers</h3>
					<p class="card-text" style="max-width: 400px">Lorem ipsum dolor sit amet, consectetur
						adipisicing elit, sed do eiusmod
						tempor incididunt.</p>
					<a href="" class="btn btn-primary rounded-pill">Learn more</a>
				</div>
			</div>
		</div> <!-- col // -->
		<div class="col-md-4">

			<div class="card card-body">
				<h4 class="title py-3">One Request, Multiple Quotes</h4>
				<form>
					<div class="form-group">
						<input class="form-control" name="" placeholder="What are you looking for?" type="text">
					</div>
					<div class="form-group">
						<div class="input-group">
							<input class="form-control" placeholder="Quantity" name="" type="text">

							<select class="custom-select form-control">
								<option>Pieces</option>
								<option>Litres</option>
								<option>Tons</option>
								<option>Gramms</option>
							</select>
						</div>
					</div>
					<div class="form-group text-muted">
						<p>Select template type:</p>
						<label class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="option1">
							<div class="form-check-label">Request price</div>
						</label>
						<label class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="option2">
							<div class="form-check-label">Request a sample</div>
						</label>
					</div>
					<div class="form-group">
						<button class="btn btn-warning">Request for quote</button>
					</div>
				</form>
			</div>

		</div> <!-- col // -->
	</div> <!-- row // -->
</div>

<section class="section-content padding-y bg-white">
	<nav class="navbar navbar-main navbar-expand-lg border-bottom">
		<!-- <div class="container"> -->
		<div class="col-md-12">
			<h4>Pilih Produk</h4>
			<nav style="width: 100%">
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					<a class="nav-item nav-link @if(app('request')->input('tab') == 'semua') active @else active @endif"
						id="nav-home-tab" data-toggle="tab" href="#hangat" role="tab" aria-controls="nav-home"
						aria-selected="true">Produk Baru</a>
					<a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#diskon" role="tab"
						aria-controls="nav-home" aria-selected="true">Produk Diskon</a>
					<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#semua" role="tab"
						aria-controls="nav-profile" aria-selected="false">Semua Produk</a>
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
			<div class="tab-pane fade show @if(app('request')->input('tab') == 'hangat') active @else active @endif"
				id="hangat" role="tabpanel" aria-labelledby="nav-home-tab">
				<div class="row">
					@forelse($produk->sortByDesc('id_produk') as $p)
					<div class="col-xl-2 col-lg-3 col-md-4 col-6">
						<div href="{{ URL::to('produk/'.$p->slug) }}" class="card card-sm card-product-grid shadow-sm">
							<a href="{{ URL::to('produk/'.$p->slug) }}" class=""> <img class="card-img-top"
									src="{{ asset('assets/foto_produk/'.$p->foto_produk[0]->foto_produk) }}"> </a>
							<figcaption class="info-wrap">
								<div class="namaProduk-rapi">
									<a href="{{ URL::to('produk/'.$p->slug) }}" class="title">{{ $p->nama_produk }}</a>
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
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star"
													style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star"
													style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i>
											</li>
											<li>
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star"
													style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star"
													style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i>
											</li>
										</ul>
										<span class="rating-stars" style="font-size:small;">(125)</span>
									</div> <!-- rating-wrap.// -->

								</div>
								<div class="row">
									<div class="col" style="font-size:small">PAITON {{$p->kota}}</div>
									<!-- selesaikan API nya ya -->
									<div class="text-right col text-success" style="font-size:small;">{{$p->terjual}}
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
						<div href="{{ URL::to('produk/'.$p->slug) }}" class="card card-sm card-product-grid shadow-sm">
							<a href="{{ URL::to('produk/'.$p->slug) }}" class=""> <img class="card-img-top"
									src="{{ asset('assets/foto_produk/'.$p->foto_produk[0]->foto_produk) }}"> </a>
							<figcaption class="info-wrap">
								<div class="namaProduk-rapi">
									<a href="{{ URL::to('produk/'.$p->slug) }}" class="title">{{ $p->nama_produk }}</a>
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
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star"
													style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star"
													style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i>
											</li>
											<li>
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star"
													style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star"
													style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i>
											</li>
										</ul>
										<span class="rating-stars" style="font-size:small;">(125)</span>
									</div> <!-- rating-wrap.// -->

								</div>
								<div class="row">
									<div class="col" style="font-size:small">PAITON {{$p->kota}}</div>
									<!-- selesaikan API nya ya -->
									<div class="text-right col text-success" style="font-size:small;">{{$p->terjual}}
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
						<div href="{{ URL::to('produk/'.$p->slug) }}" class="card card-sm card-product-grid shadow-sm">
							<a href="{{ URL::to('produk/'.$p->slug) }}" class=""> <img class="card-img-top"
									src="{{ asset('assets/foto_produk/'.$p->foto_produk[0]->foto_produk) }}"> </a>
							<figcaption class="info-wrap">
								<div class="namaProduk-rapi">
									<a href="{{ URL::to('produk/'.$p->slug) }}" class="title">{{ $p->nama_produk }}</a>
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
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star"
													style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star"
													style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i>
											</li>
											<li>
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star"
													style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i> <i class="fa fa-star"
													style="font-size:small"></i>
												<i class="fa fa-star" style="font-size:small"></i>
											</li>
										</ul>
										<span class="rating-stars" style="font-size:small;">(125)</span>
									</div> <!-- rating-wrap.// -->

								</div>
								<div class="row">
									<div class="col" style="font-size:small">PAITON {{$p->kota}}</div>
									<!-- selesaikan API nya ya -->
									<div class="text-right col text-success" style="font-size:small;">{{$p->terjual}}
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

@endsection