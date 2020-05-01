@foreach ($review as $r)
<article class="media mb-3">
    <img class="img-sm mr-3" src="{{ asset('assets/foto_profil_konsumen/'.$r->konsumen->foto_profil) }}">
    <div class="media-body">
        <h6 class="mt-0">{{ $r->konsumen->nama_lengkap }}</h6>
        <div class="small">{{ $r->updated_at->format('d M Y') }}</div>
        <div class="rating-wrap my-3">
            <ul class="rating-stars">
                <li style="width:80%" class="stars-active">
                    @for($i = 1; $i <= $r->bintang; $i++)
                        <i class="fa fa-star"></i>
                        @endfor
                </li>
                <li>
                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                </li>
            </ul>
        </div>
        <p class="mb-">{{ $r->review}}</p>
</article>

@endforeach


<nav>
    {!! $review->render() !!}
</nav>



@push('scripts')
<script type="text/javascript">
    $(function () {
        $('body').on('click', '.pagination a', function (e) {
            e.preventDefault();
            $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 10000;" src="https://i.imgur.com/v3KWF05.gif />');
            var url = $(this).attr('href');
            window.history.pushState("", "", url);
            loadBooks(url);
        });

        function loadBooks(url) {
            $.ajax({
                url: url
            }).done(function (data) {
                $('.mpnj').html(data);
            }).fail(function () {
                console.log("Failed to load data!");
            });
        }
    });
</script>
@endpush