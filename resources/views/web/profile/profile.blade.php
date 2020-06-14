<div class="card">
    @if (session('suksesGantiPassword'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('suksesGantiPassword') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('gagalGantiPassword'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('gagalGantiPassword') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('suksesUbahProfile'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('suksesUbahProfile') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card-body">
        <h4 class="card-title mb-4">Profile</h4>
        @php
        $id = Session::get('id');
        @endphp
        <form action="{{ URL::to('profile/ubah/'.Session::get('role').'/'.Auth::id()) }}"
            method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                @if( Auth::user()->foto_profil == null)
                <div class="icontext mr-4" style="max-width: 300px;">
                    <span class="icon icon-lg rounded-circle border border-primary">
                        <i class="fa fa-user text-primary"></i>
                    </span>
                    <h6 class="text">
                        Belum Ada Foto Profil
                    </h6>
                </div>
                @else
                <img src="{{ asset('assets/foto_profil_konsumen/'.Auth::user()->foto_profil) }}"
                    class="img-md rounded-circle border">
                @endif
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="nama"
                        value="{{ Auth::user()->nama_lengkap }}">
                </div>
                <div class="col form-group">
                    <label>Email</label>
                    <input type="email" id="email" name="email" class="form-control form-control-alternative"
                        placeholder="email" value="{{ Auth::user()->email }}">
                </div> <!-- form-group end.// -->
            </div> <!-- form-row.// -->
            <div class="form-row">
                <div class="col form-group">
                    <label for="no_hp">Nomor HP</label>
                    <input type="text" id="no_hp" name="no_hp" class="form-control form-control-alternative"
                        placeholder="Nomor HP" value="{{ Auth::user()->nomor_hp }}">
                </div>
                <div class="col form-group">
                    <label for="foto">Foto</label>
                    <input type="file" id="foto_profil" name="foto_profil" class="form-control">
                </div>
            </div>

            <button class="btn btn-primary btn-block" type="submit">Simpan</button>
        </form>
    </div> <!-- card-body.// -->
</div>