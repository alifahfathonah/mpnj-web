<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Repositories\BannerRepository;
use Illuminate\Http\Request;

class ApiTampilBanner extends Controller
{
    private $bannerRepository;

    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function index()
    {
        $data = Banner::orderBy('id_banner')
            ->where('status', 'Y')
            ->get();
        if (count($data) > 0) {
            $banners = $this->bannerRepository->dataBanner();
            $res['data'] = $banners;
            return response()->json($res);
        } else {
            $res1['pesan'] = "Data Kosong!";
            $res1['data'] = [];
            return response()->json($res1);
        }
        // return $banners;
    }
}
