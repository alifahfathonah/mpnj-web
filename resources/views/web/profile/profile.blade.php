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
        <form action="{{ URL::to('profile/ubah/'.Auth::id()) }}" method="post" enctype="multipart/form-data">
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
                    class="img-md rounded-circle border" data-target="#modalProfil" data-toggle="modal">
                @endif
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="nama"
                        value="{{ Auth::user()->nama_lengkap }}" maxlength="225">
                </div>
                <div class="col form-group">
                    <label>Email</label>
                    <input type="email" id="email" name="email" class="form-control form-control-alternative"
                        placeholder="email" value="{{ Auth::user()->email }}" maxlength="225">
                </div> <!-- form-group end.// -->
            </div> <!-- form-row.// -->
            <div class="form-row">
                <div class="col form-group">
                    <label for="no_hp">Nomor HP</label>
                    <input type="text" id="no_hp" name="no_hp" class="form-control form-control-alternative"
                        placeholder="Nomor HP" value="{{ Auth::user()->nomor_hp }}" maxlength="12">
                </div>
                <div class="col form-group">
                    <label for="foto">Foto</label>
                    <input type="file" id="foto_profil" name="foto_profil" class="form-control">
                    @if($errors->has('foto_profil'))
                    <small style="color: red">{{ $errors->first('foto_profil') }}</small> @endif
                </div>
            </div>

            <button class="btn btn-primary btn-block" type="submit">Simpan</button>
        </form>
    </div> <!-- card-body.// -->
</div>

<div class="modal modal-fullscreen fade" id="modalProfil" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('assets/foto_profil_konsumen/'.Auth::user()->foto_profil) }}"
                    class="img-lg rounded-circle border">
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>