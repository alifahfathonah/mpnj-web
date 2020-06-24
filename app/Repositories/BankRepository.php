<?php

namespace App\Repositories;

use App\Models\Bank;

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
                        'rekening' => $bank->rekening_admin->nomor_rekening
                    ];
                }
            );
    }
}
