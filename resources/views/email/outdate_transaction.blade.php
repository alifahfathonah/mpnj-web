<!DOCTYPE html>
<html>
<head>
	<title>Pembatalan Transaksi</title>
	<link href="{{ url('assets/mpnj/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
	<p style="text-align: justify;">
		Halo {{ $data->user->nama_lengkap }}, kami memberitahukan jika transaksi anda dengan nomor transaksi {{ $data->kode_transaksi }} kami batalkan karena anda tidak melakukan pembayaran pada waktu yang telah ditentukan.
	</p>

	<br>

	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body p-0">
						<div class="row p-5">
							<div class="col-md-6">
								<img src="http://belanj.id/assets/logo/belaNJ-hijau.png">
							</div>

							<div class="col-md-6 text-right">
								<p class="font-weight-bold mb-1">Kode Transaksi: {{ $data->kode_transaksi }}</p>
								<p class="text-muted">Waktu Transaksi: {{ $data->waktu_transaksi }}</p>
								<p class="text-muted">Batas Pembayaran: {{ $data->batas_transaksi }}</p>
							</div>
						</div>

						<hr class="my-5">

						<div class="row pb-5 p-5">
							<div class="col-md-6">
								<p class="font-weight-bold mb-4">Oleh</p>
								<p class="mb-1">{!! $data->to !!}</p>
							</div>
							
							<!-- <hr class="my-5">

							<div class="col-md-6 text-right">
								<p class="font-weight-bold mb-4">Payment Details</p>
								<p class="mb-1"><span class="text-muted">VAT: </span> 1425782</p>
								<p class="mb-1"><span class="text-muted">VAT ID: </span> 10253642</p>
								<p class="mb-1"><span class="text-muted">Payment Type: </span> Root</p>
								<p class="mb-1"><span class="text-muted">Name: </span> John Doe</p>
							</div> -->
						</div>

						<div class="row p-5">
							<div class="col-md-12">
								<table class="table">
									<thead>
										<tr>
											<th class="border-0 text-uppercase small font-weight-bold">Produk</th>
											<th class="border-0 text-uppercase small font-weight-bold">Jumlah</th>
											<th class="border-0 text-uppercase small font-weight-bold">Harga</th>
											<th class="border-0 text-uppercase small font-weight-bold">Kurir</th>
											<th class="border-0 text-uppercase small font-weight-bold">Sub Total</th>
										</tr>
									</thead>
									<tbody>
										@foreach($data->transaksi_detail as $t)
										<tr>
											<td>{{ $t->produk->nama_produk }}</td>
											<td>{{ $t->jumlah }}</td>
											<td>
												@if($t->diskon == 0)
													@currency($t->harga_jual)
												@else
													<strike>@currency($t->harga_jual)</strike> | @currency($t->harga_jual - ($t->diskon / 100 * $t->harga_jual))
												@endif
											</td>
											<td>
												{{ $t->kurir }}, {{ $t->service }}, {{ $t->ongkir }}
											</td>
											<td>
												@if($t->diskon == 0)
													@currency(($t->harga_jual * $t->jumlah) + $t->ongkir)
												@else
													@currency(($t->harga_jual - ($t->diskon / 100 * $t->harga_jual)) * $t->jumlah + $t->ongkir) 
												@endif
											</td>
										</tr>
										@endforeach										
									</tbody>
								</table>
							</div>
						</div>
						
						<hr class="my-5">

						<div class="d-flex flex-row-reverse bg-dark text-white p-4">
							<div class="py-3 px-5 text-right">
								<div class="mb-2">Total</div>
								<div class="h2 font-weight-light">@currency($data->total_bayar)</div>
							</div>

							<!-- <div class="py-3 px-5 text-right">
								<div class="mb-2">Discount</div>
								<div class="h2 font-weight-light">10%</div>
							</div>

							<div class="py-3 px-5 text-right">
								<div class="mb-2">Sub - Total amount</div>
								<div class="h2 font-weight-light">$32,432</div>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="text-light mt-5 mb-5 text-center small">by : <a class="text-light" target="_blank" href="http://belanj.id">belanj.id</a></div>

	</div>
</body>
</html>