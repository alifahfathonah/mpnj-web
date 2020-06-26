<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Rekening_Admin;
use App\Repositories\BankRepository;

class ApiBankController extends Controller
{

    private $bankRepository;

    public function __construct(BankRepository $bankRepository)
    {
        $this->bankRepository = $bankRepository;
    }

    public function index()
    {
        $bank = $this->bankRepository->dataBank();
        return $bank;
        $banks = $this->bankRepository->dataBank();
        return response()->json([
            'pesan' => 'Sukses!',
            'data' => $banks
        ], 200);
    }

    public function rekAdmin($id_bank)
    {
        $data = Rekening_Admin::where('bank_id', $id_bank)->get();
        if (count($data) > 0) {
            $rek = $this->bankRepository->dataRek($id_bank);
            $res['data'] = $rek;
            return response()->json($res);
        } else {
            $res2['pesan'] = "Gagal!";
            $res2['data'] = [];
            return response()->json($res2);
        };
    }
}
