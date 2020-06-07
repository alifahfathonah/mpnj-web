<style>
    ul.timeline {
        list-style-type: none;
        position: relative;
    }
    ul.timeline:before {
        content: ' ';
        background: green;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }
    ul.timeline > li {
        margin: 20px 0;
        padding-left: 20px;
    }
    ul.timeline > li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid green;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }
</style>
    <div class="col-md-12">
        <article class="card">
            <header class="card-header"> Tracking </header>
            <div class="card-body">
                <h6>ID Pesanan: {{ $detail->id_transaksi_detail }}</h6>
                <article class="card">
                    <div class="card-body row no-gutters">
                        <div class="col">
                            <strong>Estimasi Pengiriman:</strong> <br>{{ $detail->etd }} hari
                        </div>
                        <div class="col">
                            <strong>Kurir:</strong> <br> {{ $detail->kurir }} | {{ $detail->service }}
                        </div>
                        <div class="col">
                            <strong>Status:</strong> <br> <span id="status"></span>
                        </div>
                        <div class="col">
                            <strong>Resi #:</strong> <br> {{ $detail->resi }}
                        </div>
                    </div>
                </article>

                <br>

                <ul class="timeline" id="timeline">

                </ul>

                <button class="btn btn-outline-success" onclick="self.history.back()"> <i class="fa fa-chevron-left"></i> Back to orders</button>
            </div> <!-- card-body.// -->
        </article>
    </div>

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
                success: function (response) {
                    const res = response.waybill.rajaongkir.result;
                    $("#status").html(res.summary.status)
                    // $("#alamat").html(res.details.receiver_name + " " + res.details.receiver_address1 + " " +res.details.receiver_address2 + " " + res.details.receiver_address3 + " " + res.details.receiver_city);
                    res.manifest.slice().reverse().forEach(item => {
                       $("#timeline").append(
                           `<li>
                                <p class="float-right">${item.manifest_date + " : " + item.manifest_time}</p>
                                <p>${item.manifest_description}</p>
                            </li>`
                       )
                    });

                    console.log(res.manifest.length);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    </script>
@endpush