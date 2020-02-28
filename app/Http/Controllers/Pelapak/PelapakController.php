<?php

namespace App\Http\Controllers\Pelapak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PelapakController extends Controller
{
    public function index(Request $request)
    {
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;
        
        $data['transaksi'] = DB::table('transaksi')->distinct()
                ->join('transaksi_detail', 'transaksi_detail.transaksi_id', '=', 'transaksi.id_transaksi')
                ->where('transaksi_detail.pelapak_id', $konsumen_id)
                ->where('transaksi_detail.status_order', 'pending')
                ->get(['id_transaksi','kode_transaksi', 'waktu_transaksi','total_bayar']);

        return view('pelapak/home', $data);
    }
}
