<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;

class ApiBankController extends Controller
{
    public function index()
    {
        $kategori = Bank::all();
        return response()->json($kategori, 200);
    }
}
