<?php

namespace App\Repositories;

use App\Models\Bank;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankRepository
{
    public function all()
    {
        return Bank::orderBy('id_bank')
            ->with('rekening_admin')
            ->get()
            ->map(
                function ($bank) {
                    return [
                        'id_bank' => $bank->id_bank,
                        'nama_bank' => $bank->nama_bank,
                        'rekening_admin' => [
                            'id_rekening_admin' => $bank->rekening_admin->getKey(),
                            'nomor_rekening' => $bank->rekening_admin->nomor_rekening,
                            'atas_nama_rekening' =>  $bank->rekening_admin->atas_nama_rekening
                        ]
                    ];
                }
            );
    }
}
