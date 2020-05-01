<output>

    <!-- =========================  COMPONENT TRACKING ========================= -->
    <div class="col-md-12">
        <article class="card">
            <header class="card-header"> My Orders / Tracking </header>
            <div class="card-body">
                <h6>Order ID: {{ $detail->transaksi->kode_transaksi }}</h6>
                <article class="card">
                    <div class="card-body row no-gutters">
                        <div class="col">
                            <strong>Estimasi Pengiriman :</strong> <br> {{ $detail->etd }} hari
                        </div>
                        <div class="col">
                            <strong>Kurir :</strong> <br> {{ $detail->kurir }}
                        </div>
                        <div class="col">
                            <strong>Status:</strong> <br> <div id="status">{{ $detail->status_order }}</div>
                        </div>
                        <div class="col">
                            <strong>Resi :</strong> <br> {{ $detail->resi }}
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <strong>Alamat :</strong> <br> <div id="alamat"></div>
                            </div>
                        </div>
                    </div>
                </article>

                <div class="tracking-wrap" id="trackingHistory">

                </div>


                <hr>
                <ul class="row">
                    <li class="col-md-12">
                        <figure class="itemside  mb-3">
                            <div class="aside"><img src="{{ asset('assets/foto_produk/'.$detail->produk->foto_produk[0]->foto_produk) }}" class="img-sm border"></div>
                            <figcaption class="info align-self-center">
                                <p class="title">{{ $detail->produk->nama_produk }} <br></p>
                                @if($detail->diskon == 0)
                                    <span style="color: black">@currency($detail->harga_jual) x {{ $detail->jumlah }}</span>
                                @else
                                    <strike style="color: red;">{{ $detail->harga_jual }}</strike> | <span>{{ $detail->harga_jual - ($detail->diskon / 100 * $detail->harga_jual) }} x {{ $detail->jumlah }}</span>
                                @endif
                            </figcaption>
                        </figure>
                    </li>
                </ul>

                <a href="#" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Kembali ke Pesanan</a>
            </div> <!-- card-body.// -->
        </article>
    </div>
    <!-- =========================  COMPONENT TRACKING END.// ========================= -->
</output>

@push('scripts')
    <script>
        $(function () {
            $.ajax({
                async: true,
                url: "{{ URL::to('api/gateway/tracking') }}",
                type: 'POST',
                data: {
                    'waybill' : "{{ $detail->resi }}",
                    'courier' : "{{ $detail->kurir }}"
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(xhr) {
                    $("#cekTracking").html('WAIT');
                },
                success: function (response) {
                    $("#cekTracking").html('SUKSES');
                    const res = response.waybill.rajaongkir.result;
                    $("#status").html(res.summary.status)
                    $("#alamat").html(res.details.receiver_name + " " + res.details.receiver_address1 + " " +res.details.receiver_address2 + " " + res.details.receiver_address3 + " " + res.details.receiver_city);
                    res.manifest.forEach(item => {
                       $("#trackingHistory").append(
                           `<div class="step active">
                                <span class="icon"> <i class="fa fa-check"></i> </span>
                                <span class="text">${item.manifest_description} - ${item.manifest_date + " : " + item.manifest_time}</span>
                            </div>`
                       )
                    });

                    console.log(response);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    </script>
@endpush