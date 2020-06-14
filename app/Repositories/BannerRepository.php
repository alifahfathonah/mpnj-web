<?php

namespace App\Repositories;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerRepository
{
    public function dataBanner()
    {
        return Banner::orderBy('id_banner')
            ->where('status', 'Y')
            ->get()
            ->map(
                function ($banner) {
                    return [
                        'nama_banner' => $banner->nama_banner,
                        'status' => $banner->status,
                        'foto_banner' => $banner->foto_banner,
                        'id_banner' => $banner->id_banner
                    ];
                }
            );
    }
}
