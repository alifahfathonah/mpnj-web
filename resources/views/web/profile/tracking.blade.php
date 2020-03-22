<output>

    <!-- =========================  COMPONENT TRACKING ========================= -->
    <article class="card">
        <header class="card-header"> My Orders / Tracking </header>
        <div class="card-body">
            <h6>Order ID: <button id="cekTracking" class="btn"></button></h6>
            <article class="card">
                <div class="card-body row no-gutters">
                    <div class="col">
                        <strong>Delivery Estimate time:</strong> <br>16:40, 12 nov 2018
                    </div>
                    <div class="col">
                        <strong>Shipping company:</strong> <br> Fedex, | <i class="fa fa-phone"></i> +123467890
                    </div>
                    <div class="col">
                        <strong>Status:</strong> <br> Picked by the courier
                    </div>
                    <div class="col">
                        <strong>Tracking #:</strong> <br> 98765432123
                    </div>
                </div>
            </article>

            <div class="tracking-wrap">
                <div class="step active">
                    <span class="icon"> <i class="fa fa-check"></i> </span>
                    <span class="text">Order confirmed</span>
                </div> <!-- step.// -->
                <div class="step active">
                    <span class="icon"> <i class="fa fa-user"></i> </span>
                    <span class="text"> Picked by courier</span>
                </div> <!-- step.// -->
                <div class="step">
                    <span class="icon"> <i class="fa fa-truck"></i> </span>
                    <span class="text"> On the way </span>
                </div> <!-- step.// -->
                <div class="step">
                    <span class="icon"> <i class="fa fa-box"></i> </span>
                    <span class="text">Ready for pickup</span>
                </div> <!-- step.// -->
            </div>


            <hr>
            <ul class="row">
                <li class="col-md-4">
                    <figure class="itemside  mb-3">
                        <div class="aside"><img src="bootstrap-ecommerce-html/images/items/1.jpg" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title">Just name of title or <br> some name goes here</p>
                            <span class="text-muted">$145 </span>
                        </figcaption>
                    </figure>
                </li>
                <li class="col-md-4">
                    <figure class="itemside  mb-3">
                        <div class="aside"><img src="bootstrap-ecommerce-html/images/items/2.jpg" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title">Great demo product title <br> or name goes here</p>
                            <span class="text-muted">$250 </span>
                        </figcaption>
                    </figure>
                </li>
                <li class="col-md-4">
                    <figure class="itemside mb-3">
                        <div class="aside"><img src="bootstrap-ecommerce-html/images/items/3.jpg" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title">Another demo product title <br> or name goes here</p>
                            <span class="text-muted">$145 </span>
                        </figcaption>
                    </figure>
                </li>
            </ul>


            <p><strong>Note: </strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            <a href="#" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Back to orders</a>
        </div> <!-- card-body.// -->
    </article>
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
                  'waybill' : "{{ $resi }}",
                  'courier' : "{{ $kurir }}"
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(xhr) {
                  $("#cekTracking").html('WAIT');
                },
                success: function (response) {
                    $("#cekTracking").html('SUKSES');
                    console.log(response);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    </script>
@endpush