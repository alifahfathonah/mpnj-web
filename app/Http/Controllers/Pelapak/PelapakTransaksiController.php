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
//
//        $data['transaksi'] = Transaksi::with(['transaksi_detail' => function($query) {
//            $query->whereExist('pelapak_id', 1);
//        }])->get();
//        $data = Transaksi::join('transaksi_detail', 'transaksi_detail.transaksi_id', '=', 'transaksi.id_transaksi')
//                ->where('transaksi_detail.pelapak_id', 1)->distinct('kode_transaksi')->get();
        $data['transaksi'] = DB::table('transaksi')->distinct()
                ->join('transaksi_detail', 'transaksi_detail.transaksi_id', '=', 'transaksi.id_transaksi')
                ->where('transaksi_detail.pelapak_id', $konsumen_id)
                ->get(['id_transaksi','kode_transaksi', 'waktu_transaksi','total_bayar']);
        return view('pelapak/transaksi/data_transaksi', $data);
//        return $data;
    }

    public function detail(Request $request, $id_transaksi)
    {
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;

//        $data['transaksi'] = Transaksi::with(['transaksi_detail' => function($q) {
//            $q->where(['pelapak_id' => 1, 'transaksi_id' => 2]);
//        }])->first();
//        $ok = Transaksi::find(2);
        $data['transaksi'] = Transaksi::find($id_transaksi)->transaksi_detail()->where('pelapak_id', $konsumen_id)->get();

        return view('pelapak/transaksi/detail_transaksi', $data);
//        return $data['transaksi'];
    }

    public function update_status($id, $status)
    {
        $update = Transaksi_Detail::find($id)->update(['status_order' => $status]);
        if ($update) {
            return redirect('administrator/transaksi/detail/'.$id);
        }
    }
}
