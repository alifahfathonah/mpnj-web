<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Konfirmasi;
use App\Models\Konsumen;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KonfirmasiWebController extends Controller
{
	protected $kode;

	public function __construct()
	{
		$this->kode = null;
	}

	public function data(Request $request, $id_trx)
	{
		$cek['transaksi'] = Transaksi::with('user')->where('kode_transaksi', $id_trx)->first();
		if ($cek['transaksi'] == null) {
			return redirect('/pesanan')->with('trxNull', 'Kode transaksi tidak ditemukan.');
		}

		$cek['rekening_admin'] = Bank::with('rekening_admin')->get();
		if ($cek['transaksi']->status_transaksi != 'batal') {
			if ($cek['transaksi']->proses_pembayaran == 'belum') {
				return view('web/web_konfirmasi', $cek);
			} else if ($cek['transaksi']->proses_pembayaran == 'sudah' || $cek['transaksi']->proses_pembayaran == 'terima') {
				return redirect()->to('/pesanan')->with('message', 'Transaksi Sudah Dibayar');
			} else {
				return redirect()->to('/pesanan')->with('message', 'Pembayaran Anda Ditolak');
			}
		} else {
			return redirect()->to('/pesanan')->with('message', 'Transaksi Sudah Dibatalkan');
		}
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
			'tanggal_transfer' => date('Y-m-d H:i:s'),
			'bukti_transfer' => $filename
		]);

		if ($simpanKonfirmasi) {
			Transaksi::where('kode_transaksi', $request->kode_transaksi)->update(['proses_pembayaran' => 'sudah']);
			$folder = 'assets/foto_bukti_tf';
			$foto->move($folder, $filename);
			return redirect()->to('/pesanan');
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
