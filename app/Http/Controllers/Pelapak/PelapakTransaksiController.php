<?php

namespace App\Http\Controllers\Pelapak;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PelapakTransaksiController extends Controller
{
    public function index(Request $request)
    {
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;

        $data['transaksi'] = Transaksi::with(['transaksi_detail' => function($q) use ($konsumen_id) {
            $q->where('pelapak_id', $konsumen_id);
        }])->get();
        return view('pelapak/transaksi/data_transaksi', $data);
//        return $data['transaksi'];
    }

    
}
