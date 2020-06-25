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
        $banks = $this->bankRepository->dataBank();
        return response()->json([
            'pesan' => 'Sukses!',
            'data' => $banks
        ], 200);
    }
}
