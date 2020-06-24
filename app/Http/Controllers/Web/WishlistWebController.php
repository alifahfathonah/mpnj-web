<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistWebController extends Controller
{
    public function index()
    {
        // $data['wishlist'] = Wishlist::with('user', 'produk')->where('user_id', Auth::id())->get();
        // return $data;
        return view('web/web_profile');
    }
}
