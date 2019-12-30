<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $data['produk'] = Produk::where('pelapak_id', 1)->get();
        return view('pelapak/produk/data_produk', $data);
    }

    public function tambah()
    {
        return view('pelapak/produk/tambah_produk');
    }

    public function simpan(Request $request)
    {
        $foto = $request->file('foto');
        $nama_foto = $foto->getClientOriginalName();
        $foto->move('assets/foto_produk', $nama_foto);

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'satuan' => $request->satuan,
            'berat' => $request->berat,
            'keterangan' => $request->deskripsi,
            'harga_modal' => $request->harga_modal,
            'harga_jual' => $request->harga_jual,
            'diskon' => $request->diskon,
            'stok' => $request->stok,
            'foto' => $nama_foto,
            'pelapak_id' => '1'
        ]);

        return redirect('administrator/produk');
    }

    public function edit($id)
    {
        $data['produk'] = Produk::find($id);
        return view ('pelapak/produk/edit_produk', $data);
    }

    public function ubah(Request $request, $id)
    {
        $produk = Produk::find($id);
        $produk->nama_produk = $request->nama_produk;
        $produk->satuan = $request->satuan;
        $produk->berat = $request->berat;
        $produk->keterangan = $request->deskripsi;
        $produk->harga_modal = $request->harga_modal;
        $produk->harga_jual = $request->harga_jual;
        $produk->diskon = $request->diskon;
        $produk->stok = $request->stok;
        $produk->pelapak_id = 1;

        $foto = $request->file('foto');

        if (!empty($foto)) {
            File::delete('assets/foto_produk/'.$produk->foto);
            $nama_foto = $foto->getClientOriginalName();
            $foto->move('assets/foto_produk', $nama_foto);
            $produk->foto = $nama_foto;
        }

        $produk->save();

        return redirect('administrator/produk');
    }
}
