<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Konfirmasi;
use App\Models\Konsumen;
use App\Models\Transaksi;
use App\Models\Rekening_Admin;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Validator;

class KonfirmasiWebController extends Controller
{
	protected $kode;

	public function __construct()
	{
		$this->kode = null;
	}

	public function index(Request $request)
	{
		return view('web/web_konfirmasi');
	}

	public function data(Request $request, $id_trx)
	{
		$cek = Transaksi::with('pembeli')->where('kode_transaksi', $id_trx)->first();
			return view('web/web_konfirmasi', ['cek' => $cek]);
			// return $cek;
	
	}

	public function simpan(Request $request)
	{
	    $validator = Validator::make($request->except('token'), [
	       'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

	    if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

		$foto = $request->file('bukti_transfer');
		$filename = $foto->getClientOriginalName();

		$simpanKonfirmasi = Konfirmasi::create([
			'kode_transaksi' => $request->kode_transaksi,
			'total_transfer' => $request->total_bayar,
			'rekening_admin_id' => $request->rekening,
			'nama_pengirim' => $request->nama_pengirim,
			'tanggal_transfer' => date('Y-m-d'),
			'bukti_transfer' => $filename
		]);

		if ($simpanKonfirmasi) {
		    Transaksi::where('kode_transaksi', $request->kode_transaksi)->update(['proses_pembayaran' => 'sudah']);
			$folder = 'assets/konfirmasi';
			$foto->move($folder, $filename);
			return redirect()->away('/pesanan');
		}
	}

	public function akun($id)
	{
		$update_status_akun = Konsumen::find($id)->update(['status' => 'aktif']);
		if ($update_status_akun) {
			return redirect('verified');
		}
	}

	public function verified()
	{
		return view('web/web_sukses_konfirmasi');
	}
}
