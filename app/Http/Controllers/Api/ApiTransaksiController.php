<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use App\Repositories\TransaksiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ApiTransaksiController extends Controller
{
    private $transaksiRepository;

    public function __construct(TransaksiRepository $transaksiRepository)
    {
        $this->transaksiRepository = $transaksiRepository;
    }

    public function index(Request $request)
    {
        $id = $request->query('id');
//        $keranjangs = $this->keranjangRepository->all($role, $id);
        $keranjang = Keranjang::orderBy('id_keranjang')
            ->with('produk')
            ->where('user_id', $id)
            ->where('status', 'Y')
            ->get()
            ->groupBy('produk.user.nama_toko');

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
                'id_toko' => $keranjang[$key][0]->produk->user->id_user,
                'nama_toko' => $key,
                'item' => $item
            ]);
            $data['pembeli'] = $keranjang[$key][0]->user;

        }
        return response()->json($data, 200);
    }

    public function simpan(Request $request)
    {
        $role = Session::get('role');
        //$id = Session::get('id');
        //$konsumen_id = $request->user($role)->$id;

        $data = array(
            'pembeli_id' => $request->pembeli_id,
            'pembeli_type' => $request->$role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak',
            'kode_transaksi' => time(),
            'waktu_transaksi' => date('Y-m-d H:i:s'),
            'total_bayar' => $request->total_bayar
        );

        $transaksi = $this->transaksiRepository->create($data);
        if ($transaksi) {
            // foreach ($request->trxDetail as $detail) {
            //     $detail['transaksi_id'] = $transaksi->id_transaksi;
            //     Transaksi_Detail::create($detail);
            // }
            return response()->json(
                [
                    'kode_transaksi' => $transaksi->kode_transaksi,
                    'total_bayar' => $transaksi->total_bayar
                ],
                200
            );
        } else {
            return response()->json('gagal', 400);
        }
    }
}
