<?php

namespace App\Repositories;

use App\Models\Bank;
use App\Models\Rekening_Admin;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankRepository
{
    public function dataBank()
    {
        return Bank::orderBy('id_bank')
            ->with('rekening_admin')
            ->get()
            ->map(
                function ($bank) {
                    return [
                        'id_bank' => $bank->id_bank,
                        'nama_bank' => $bank->nama_bank,
                        'rekening' => $bank->rekening_admin->nomor_rekening,
                        'atas_nama' => $bank->rekening_admin->atas_nama_rekening
                    ];
                }
            );
    }

    public function dataRek($id_bank)
    {
        return Rekening_Admin::where('bank_id', $id_bank)
            ->get()
            ->map(
                function ($rek) {
                    return [
                        'id_rekening_admin' => $rek->id_rekening_admin,
                        'nomor_rekening' => $rek->nomor_rekening,
                        'atas_nama' => $rek->atas_nama_rekening
                    ];
                }
            );
    }
}
