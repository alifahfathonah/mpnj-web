<?php

namespace App\Http\Controllers\Pelapak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PelapakController extends Controller
{
    public function index()
    {
        return view('pelapak/home');
    }
}
