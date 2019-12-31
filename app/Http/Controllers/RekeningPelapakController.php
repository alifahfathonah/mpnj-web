<?php

namespace App\Http\Controllers;

use App\Models\Rekening_Pelapak;
use Illuminate\Http\Request;

class RekeningPelapakController extends Controller
{
    public function index()
    {
        $data['rekening'] = Rekening_Pelapak::all();
        return view('pelapak/rekening/data_rekening', $data);
    }
}
