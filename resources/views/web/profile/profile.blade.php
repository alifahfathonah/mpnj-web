<div class="row my-1">
    <div class="col-md-10">
        <h3 >Informasi Pribadi</h3>
        @php
            $id = Session::get('id');
        @endphp
        <br>
        <form action="{{ URL::to('profile/ubah/'.Session::get('role').'/'.Auth::guard('konsumen')->user()->$id) }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nama_lengkap">Nama</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control form-control-alternative" placeholder="nama" value="{{ Auth::guard(Session::get('role'))->user()->nama_lengkap }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control form-control-alternative" placeholder="email" value="{{ Auth::guard(Session::get('role'))->user()->email }}">
            </div>

            <div class="form-group">
                <label for="no_hp">Nomor HP</label>
                <input type="text" id="no_hp" name="no_hp" class="form-control form-control-alternative" placeholder="Nomor HP" value="{{ Auth::guard(Session::get('role'))->user()->nomor_hp }}">
            </div>

            <div class="form-group">
                <label for="cover_photo" class="upload_btn">
                    <label for="foto">Foto</label>
                    <input type="file" id="foto_profil" name="foto_profil" class="form-control">
                </label>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</div>