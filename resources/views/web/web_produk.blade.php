@extends('web.web_master')

@section('web_konten')
@foreach ($produk as $p)
<div class="row">
    <div class="card" style="width: 18rem;">
        <img src="http://localhost:8000/assets/foto_produk/{{ $p->foto_produk[0]->foto_produk }}" class="card-img-top" alt="{{ $p->nama_Produk }}">
        <div class="card-body">
            <h5 class="card-title">{{ $p->nama_produk }}</h5>
            <p class="card-text">{{ $p->keterangan }}</p>
            <a href="/produk/{{ $p->id_produk }}" class="btn btn-primary">Detail</a>
        </div>
    </div>
</div>
@endforeach
@endsection
