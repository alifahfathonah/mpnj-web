@extends('mpnj.layout.main')

@section('title','User')


@section('content')
    <section class="mb-5" id="profile_konsumen">
        <br>
        <div class="container">
            @if(session('emailVerified'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('emailVerified') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif(session('hasVerified'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('hasVerified') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <aside class="col-md-3">
                    <!--   SIDEBAR   -->

                    <div class="list-group">
                        <a href="{{ URL::to('profile') }}"
                           class="{{ Route::currentRouteName() == 'profile' ? 'active' : '' }} list-group-item list-group-item-action">Profil</a>
                        <a href="{{ URL::to('profile/alamat') }}"
                           class="{{ Route::currentRouteName() == 'alamat' ? 'active' : '' }} list-group-item list-group-item-action">Alamat</a>
                        <a href="{{ URL::to('pesanan') }}"
                           class="{{ Route::currentRouteName() == 'pesanan' ? 'active' : '' }} list-group-item list-group-item-action">Transaksi</a>
                        <a href="#" class="list-group-item list-group-item-action" data-target="#modalPassword"
                           data-toggle="modal">Ganti Password</a>
                    </div>

                    <a class="btn btn-light btn-block" href="{{ route('keluar') }}"> <i class="fa fa-power-off"></i>
                        <span class="text">Keluar</span> </a>
                    <!--   SIDEBAR .//END   -->
                </aside>
                <main class="col-md-9">
                    <article class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <h6 class="text-muted">Profile</h6>
                                    <p>{{ Auth::guard(Session::get('role'))->user()->nama_lengkap }} <br>
                                    No Telp : {{ Auth::guard(Session::get('role'))->user()->nomor_hp }}<br>
                                    Alamat : {{ Auth::guard(Session::get('role'))->user()->alamat_utama }}
                                     </p> --}}
                                    @if(Route::currentRouteName() == 'profile')
                                        @include('web.profile.profile')
                                    @elseif(Route::currentRouteName() == 'rekening')
                                        @include('web.profile.rekening')
                                    @elseif(Route::currentRouteName() == 'alamat')
                                        @include('web.profile.alamat')
                                    @elseif(Route::currentRouteName() == 'pesanan')
                                        @include('web.profile.pesanan')
                                    @elseif(Route::currentRouteName() == 'pesananDetail')
                                        @include('web.profile.pesanan_detail')
                                    @elseif(Route::currentRouteName() == 'tracking')
                                        @include('web.profile.tracking')
                                    @endif
                                </div>
                            </div>
                        </div> <!-- row.// -->
                    </article> <!-- order-group.// -->
                </main>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modalPassword" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ganti Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                @php
                $id = Session::get('id');
                $role = Session::get('role');
                @endphp
                    <form action="{{ URL::to('profile/gantipassword/'.Auth::id()) }}" method="post">
                        @csrf
                        <div class="form-group mb-0">
                            <input type="text" name="passwordlama" class="form-control" id="passwordlama" placeholder="Password Lama" required>
                            <br>
                            <input type="text" name="passwordbaru" class="form-control" id="passwordbaru" placeholder="Password Baru" required>
                            <!-- <br>
                            <input type="input" name="konfir" class="form-control" id="konfir" placeholder="Konfirmasi"> -->
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
