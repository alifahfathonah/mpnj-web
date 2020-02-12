<?php

namespace App\Http\Controllers;

use App\Models\Foto_Produk;
use App\Models\Produk;
use App\Models\Kategori_Produk;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
use ImageResize;
use Illuminate\Support\Facades\Session;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;

        $data['produk'] = Produk::where('pelapak_id', $konsumen_id)->orderBy('id_produk', 'DESC')->get();
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

        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;

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
            'pelapak_id' => $konsumen_id,
            'slug' => Str::slug($request->nama_produk)
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
        $role = Session::get('role');
        $pelapak_id = Session::get('id');
        $konsumen_id = $request->user($role)->$pelapak_id;

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
        $produk->pelapak_id = $konsumen_id;
        $produk->slug = Str::slug($request->nama_produk);

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
        $hapusFoto = Foto_Produk::where('produk_id', $id)->get();
        if ($hapusFoto) {
            foreach ($hapusFoto as $hapusFoto) {
                File::delete('assets/foto_produk/' . $hapusFoto->foto_produk);
            }
            $hapusFotoDb = Foto_Produk::where('produk_id', $id)->delete();
            if ($hapusFotoDb) {
                $hapus = Produk::where('id_produk', $id)->delete();
                if ($hapus) {
                    return redirect('administrator/produk');
                }
            }
        }
//        $produk = Produk::find($id);
//        $hapus = Produk::where('id_produk', $id)->delete();
//
//        if ($hapus) {
//            $hapusFoto = Foto_Produk::select('foto_produk')->where('produk_id', $produk->id_produk)->get();

//            return redirect('administrator/produk');
//        }
    }

    public function upload_foto(Request $request)
    {
        // $path = storage_path('assets/temp_foto_produk');

        // if (!file_exists($path)) {
        //     mkdir($path, 0777, true);
        // }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $img = ImageResize::make($file->path());
        // --------- [ Resize Image ] ---------------
        $img->resize(150, 200)->save('assets/foto_produk/'.$name);

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
