<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use App\Models\Pelapak;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PesananWebController extends Controller
{
    public function index(Request $request)
    {
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;
//
//        $data['order'] = Transaksi::with('pembeli')
//                        ->where('pembeli_id', $konsumen_id)
//                        ->where('pembeli_type', $role == 'konsumen' ? Konsumen::class : Pelapak::class)
//                        ->get();
        $data['order'] = Transaksi_Detail::get()->where('transaksi.pembeli_id', $konsumen_id)->groupBy('status_order');
        return view('web/web_pesanan', $data);
    }

    public function detail($id_trx)
    {
        $data['detail'] = Transaksi::with(['transaksi_detail' => function ($query) use ($id_trx) {
                            $query->where('id_transaksi_detail', $id_trx);
                        }])
                        ->first();

        return view('web/web_pesanan_detail', $data);
    }
}
