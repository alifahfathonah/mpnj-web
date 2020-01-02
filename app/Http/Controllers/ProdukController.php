<?php

namespace App\Http\Controllers;

use App\Models\Foto_Produk;
use App\Models\Produk;
use App\Models\Kategori_Produk;
use Illuminate\Http\Request;
use File;

class ProdukController extends Controller
{
    public function index()
    {
        $data['produk'] = Produk::where('pelapak_id', 1)->get();
        return view('pelapak/produk/data_produk', $data);
    }

    public function tambah()
    {
        $data['kategori'] = Kategori_Produk::all();
        return view('pelapak/produk/tambah_produk', $data);
    }

    public function simpan(Request $request)
    {
        // $foto = $request->file('foto');
        // $nama_foto = $foto->getClientOriginalName();
        // $foto->move('assets/foto_produk', $nama_foto);

        $produk = Produk::create([
            'nama_produk' => $request->nama_produk,
            'satuan' => $request->satuan,
            'kategori_produk_id' => $request->kategori,
            'berat' => $request->berat,
            'keterangan' => $request->deskripsi,
            'harga_modal' => $request->harga_modal,
            'harga_jual' => $request->harga_jual,
            'diskon' => $request->diskon,
            'stok' => $request->stok,
            'pelapak_id' => '1'
        ]);

        foreach ($request->document as $file) {
            $foto = Foto_Produk::create([
                'foto_produk' => $file,
                'produk_id' => $produk->id_produk
            ]);
            // $produk->addMedia('assets/temp_foto_produk/'.$file)->toMediaCollection('document');
        }

        return redirect('administrator/produk');
    }

    public function edit($id)
    {
        $data['produk'] = Produk::with('foto_produk')->where('id_produk', $id)->first();
        $data['kategori'] = Kategori_Produk::all();
        return view('pelapak/produk/edit_produk', $data);
    }

    public function ubah(Request $request, $id)
    {
        $produk = Produk::find($id);
        $produk->nama_produk = $request->nama_produk;
        $produk->kategori_produk_id = $request->kategori;
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
            File::delete('assets/foto_produk/' . $produk->foto);
            $nama_foto = $foto->getClientOriginalName();
            $foto->move('assets/foto_produk', $nama_foto);
            $produk->foto = $nama_foto;
        }

        $produk->save();

        return redirect('administrator/produk');
    }

    public function hapus($id)
    {
        $produk = Produk::find($id);
        File::delete('assets/foto_produk/' . $produk->foto);
        $hapus = Produk::where('id_produk', $id)->delete();

        if ($hapus) {
            return redirect('administrator/produk');
        }
    }

    public function upload_foto(Request $request)
    {
        // $path = storage_path('assets/temp_foto_produk');

        // if (!file_exists($path)) {
        //     mkdir($path, 0777, true);
        // }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move('assets/foto_produk', $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function unlink(Request $request)
    {
        File::delete('assets/foto_produk/' . $request->name);
        echo "oke";
    }
}
