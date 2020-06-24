{{-- <div class="row">
    <h4>cok</h4>
    <form method="post" action="{{ URL::to('profile/alamat/simpan') }}">
@csrf
<div class="form-row">
    <div class="col form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div> <!-- form-group end.// -->
    <div class="col form-group">
        <label>Nomor Telepon</label>
        <input type="tel" name="nomor_telepon" id="phone" class="form-control phone" required>
        <small id="teleponError" style="color: red"></small>
    </div> <!-- form-group end.// -->
</div>
<div class="form-row">
    <div class="col form-group">
        <label>Provinsi</label>
        <select name="provinsi" id="provinsi" class="form-control" required>
            <option id="provinsi_option">-- PILIH PROVINSI --</option>
        </select>
        <input type="hidden" name="nama_provinsi" id="nama_provinsi" class="form-control">
    </div> <!-- form-group end.// -->
    <div class="col form-group">
        <label>Kota</label>
        <select name="kota" id="kota" class="form-control" disabled required>
            <option>-- PILIH KOTA --</option>
        </select>
        <input type="hidden" name="nama_kota" id="nama_kota" class="form-control">
    </div> <!-- form-group end.// -->
    <div class="col form-group">
        <label>Kecamatan</label>
        <select name="kecamatan" id="kecamatan" class="form-control" disabled required>
            <option>-- PILIH Kecamatan --</option>
        </select>
        <input type="hidden" name="nama_kecamatan" id="nama_kecamatan" class="form-control">
    </div>
</div>
<div class="form-row">
    <div class="col form-group">
        <label>Kode Pos</label>
        <input type="text" name="kode_pos" id="kode_pos" class="form-control" required>
        <small id="kodePosError" style="color: red"></small>
    </div> <!-- form-group end.// -->
    <div class="col form-group">
        <label>Alamat Lengkap</label>
        <textarea name="alamat_lengkap" rows="1" class="form-control" required></textarea>
    </div> <!-- form-group end.// -->
</div>
<button type="submit" id="simpan" class="btn btn--round btn-danger btn--default">Simpan</button>
<button class="btn btn--round modal_close" data-dismiss="modal">Batal</button>
</form>
</div> --}}