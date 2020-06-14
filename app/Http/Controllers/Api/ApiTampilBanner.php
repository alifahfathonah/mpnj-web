<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        $banners = $this->bannerRepository->dataBanner();
        return $banners;
    }
}
