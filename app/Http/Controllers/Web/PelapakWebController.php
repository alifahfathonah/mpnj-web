<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Pelapak;
use Illuminate\Http\Request;

class PelapakWebController extends Controller
{
    public function index(Request $request, $username)
    {
//        $data['user'] = $request->query('user');
        $data['pelapak'] = Pelapak::where('username', $username)->first();
        $data['produk'] = $data['pelapak']['produk'];
        return view('web/web_pelapak', $data, ['user' => $username]);
    }

    public function produk($username)
    {
        $data['pelapak'] = Pelapak::where('username', $username)->first();
        $data['produk'] = $data['pelapak']['produk'];
        return view('web/web_pelapak', ['user' => $username], $data);
    }
}
