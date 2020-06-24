<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PesananRepository;
use Illuminate\Http\Request;

class ApiPesananController extends Controller
{
    private $pesananRepository;

    public function __construct(PesananRepository $pesananRepository)
    {
        $this->pesananRepository = $pesananRepository;
    }

    public function index(Request $request)
    {
        $tab = $request->query('tab');
        $id = $request->query('id');
        $pesanan = $this->pesananRepository->all($id, $tab);
        return $pesanan;
    }
}
