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

        $data['order'] = Transaksi::with('pembeli')
                        ->where('pembeli_id', $konsumen_id)
                        ->where('pembeli_type', $role == 'konsumen' ? Konsumen::class : Pelapak::class)
                        ->get();
        return view('web/web_pesanan', $data);
    }

    public function detail($id_trx)
    {
        $data['detail'] = Transaksi::with('transaksi_detail')
                        ->where('id_transaksi', $id_trx)
                        ->first();

        return view('web/web_pesanan_detail', $data);
    }
}
