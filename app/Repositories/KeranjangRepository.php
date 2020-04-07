<?php

namespace App\Repositories;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeranjangRepository
{
    public function all($role, $id)
    {
        return Keranjang::orderBy('id_keranjang')
            ->with('pembeli', 'produk')
            ->where('pembeli_id', $id)
            ->where('pembeli_type', $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak')
            ->where('status', 'N')
            ->get()
            ->map(
                function ($keranjangs) {
                    return [
                        'id_keranjang' => $keranjangs->id_keranjang,
                        'pembeli' => [
                            'pembeli_id' => $keranjangs->pembeli->getKey(),
                            'username' => $keranjangs->pembeli->username
                        ],
                        'produk' => [
                            'produk_id' => $keranjangs->produk->id_produk,
                            'nama_produk' => $keranjangs->produk->nama_produk,
                            'pelapak' => $keranjangs->produk->pelapak->nama_toko
                        ],
                        'status' => $keranjangs->status,
                        'jumlah' => $keranjangs->jumlah,
                        'harga_jual' => $keranjangs->harga_jual
                    ];
                }
            )
            ->groupBy('produk.pelapak');
    }

    public function create($data)
    {
        return Keranjang::create($data);
    }

    public function delete($id)
    {
        return Keranjang::where('id_keranjang', $id)->delete();
    }

    public function updateJumlah($jumlah, $id)
    {
        $keranjang = Keranjang::find($id);
        $keranjang->jumlah = $jumlah;
        $updateJumlah = $keranjang->save();
        if ($updateJumlah) {
            return $keranjang->jumlah * $keranjang->harga_jual;
        }
    }

    public function checkPrice($id_keranjang)
    {
        $keranjang = Keranjang::whereIn('id_keranjang', $id_keranjang)->sum(DB::raw('jumlah * harga_jual'));
        return $keranjang;
    }

    public function goCheckOut($id_keranjang, $role, $id)
    {
        $update = Keranjang::whereIn('id_keranjang', $id_keranjang)->update(['status' => 'Y']);
        if ($update) {
            $keranjang = Keranjang::with('pembeli', 'produk')
                ->where('pembeli_id', $id)
                ->where('pembeli_type', $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak')
                ->where('status', 'Y')
                ->get()
                ->groupBy('produk.pelapak.nama_toko');

            $data['data_keranjang'] = collect();
            $data['pembeli'] = [];
            $data['total'] = 0;

            foreach ($keranjang as $key => $value) {
                $item = collect();
                foreach ($value as $val) {
                    $data['total'] += ($val->harga_jual - ($val->produk->diskon / 100 * $val->harga_jual)) * $val->jumlah;
                    $item->push([
                        'id_keranjang' => $val->id_keranjang,
                        'jumlah' => $val->jumlah,
                        'harga_jual' => $val->harga_jual,
                        'diskon' => $val->produk->diskon,
                        'id_produk' => $val->produk->id_produk,
                        'nama_produk' => $val->produk->nama_produk,
                        'foto' => asset('assets/foto_produk/' . $val->produk->foto_produk[0]->foto_produk)
                    ]);
                }

                $data['data_keranjang']->push([
                    'id_toko' => $keranjang[$key][0]->produk->pelapak->id_pelapak,
                    'nama_toko' => $key,
                    'item' => $item
                ]);
                $data['pembeli'] = $keranjang[$key][0]->pembeli;
            }
            return $data;
        }
    }
}
