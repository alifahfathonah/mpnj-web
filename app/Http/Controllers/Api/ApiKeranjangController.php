<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Repositories\KeranjangRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ApiKeranjangController extends Controller
{
    private $keranjangRepository;

    public function __construct(KeranjangRepository $keranjangRepository)
    {
        $this->keranjangRepository = $keranjangRepository;
    }

    public function index(Request $request)
    {
        $role = $request->query('role');
        $id = $request->query('id');
//        $keranjangs = $this->keranjangRepository->all($role, $id);
        $keranjang = Keranjang::orderBy('id_keranjang')
            ->with('produk')
            ->where('pembeli_id', $id)
            ->where('pembeli_type', $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak')
            ->where('status', 'N')
            ->get()
            ->groupBy('produk.pelapak.nama_toko');

        $data['data_keranjang'] = collect();
        $data['pembeli'] = [];
        $data['total'] = 0;
        

        foreach ($keranjang as $key => $value) {
            $item = collect();
            foreach ($value as $val) {
                $data['total'] += ($val->harga_jual - ($val->produk->diskon / 100 * $val->harga_jual)) * $val->jumlah;
                if(count($item)==0){
                    $item->push([
                        'id_keranjang' => $val->id_keranjang,
                        'jumlah' => $val->jumlah,
                        'harga_jual' => $val->harga_jual,
                        'diskon' => $val->produk->diskon,
                        'id_produk' => $val->produk->id_produk,
                        'nama_produk' => $val->produk->nama_produk,
                        'foto' => asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk)
                    ]);
                }else{
                    $item_sama=0;
                    $i=0;
                    foreach($item as $val_asli){
                        if($val->produk->id_produk == $val_asli['id_produk']){
                            $jum_sebelumnya = $item[$i]['jumlah'];
                            $item->splice($i,1);
                            $item->push([
                                'id_keranjang' => $val->id_keranjang,
                                'jumlah' => $jum_sebelumnya+1,
                                'harga_jual' => $val->harga_jual,
                                'diskon' => $val->produk->diskon,
                                'id_produk' => $val->produk->id_produk,
                                'nama_produk' => $val->produk->nama_produk,
                                'foto' => asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk)
                            ]);
                            $item_sama=1;
                            break;
                        }
                        $i++;  
                    }
                    if($item_sama==0){
                        $item->push([
                            'id_keranjang' => $val->id_keranjang,
                            'jumlah' => $val->jumlah,
                            'harga_jual' => $val->harga_jual,
                            'diskon' => $val->produk->diskon,
                            'id_produk' => $val->produk->id_produk,
                            'nama_produk' => $val->produk->nama_produk,
                            'foto' => asset('assets/foto_produk/'.$val->produk->foto_produk[0]->foto_produk)
                        ]);
                    }
                }           
//                $data['pembeli'] = $val['pembeli'];
            }

            $data['data_keranjang']->push([
                    'id_toko' => $keranjang[$key][0]->produk->pelapak->id_pelapak,
                    'nama_toko' => $key,
                    'item' => $item
                ]);
            $data['pembeli'] = $keranjang[$key][0]->pembeli;

        }
        return response()->json($data, 200);
    }

    public function simpan(Request $request)
    {
        $data = array(
            'produk_id' => $request->produk_id,
            'pembeli_id' => $request->pembeli_id,
            'pembeli_type' => $request->pembeli_type == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak',
            'status' => 'N',
            'jumlah' => $request->jumlah,
            'harga_jual' => $request->harga_jual
        );
        $keranjangs = $this->keranjangRepository->create($data);
        if ($keranjangs) {
            return response()->json('sukses', 200);
        } else {
            return response()->json('gagal', 400);
        }
    }

    public function hapus($id)
    {

        $hapus = $this->keranjangRepository->delete($id);
        if ($hapus) {
            return response()->json('sukses', 200);
        } else {
            return response()->json('gagal', 400);
        }
    }

    public function gantiJumlah(Request $request, $id)
    {
        $gantiJumlah = $request->jumlah;
        $ganti = $this->keranjangRepository->updateJumlah($gantiJumlah, $id);
        if ($ganti) {
            return response()->json([
                'jumlah' => $ganti
            ], 200);
        } else {
            return response()->json('gagal', 400);
        }
    }

    public function cekHarga(Request $request)
    {
        $cekHarga = $request->id_keranjang;
        $cek = $this->keranjangRepository->checkPrice($cekHarga, 'id_keranjang');
        if ($cekHarga) {
            return response()->json([
                'total' => $cek
            ], 200);
        } else {
            return response()->json('gagal', 400);
        }
    }
}
