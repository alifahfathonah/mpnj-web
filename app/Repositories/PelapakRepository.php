<?php

namespace App\Repositories;

use App\Models\Pelapak;

class PelapakRepository
{
    public function all()
    {
        return Pelapak::orderBy('id_pelapak')
        ->with('pelapak')
        ->get()
        ->map(
            function ($pelapaks) {
                return [
                    'username' => $pelapaks->username
                ];
            }
        );
    }
}
