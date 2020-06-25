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
        $data['wishlist'] = Wishlist::with('user', 'produk')->where('user_id', Auth::id())->get();
        // return $data;
        return view('web.web_profile', $data);
    }

    public function add($id)
    {
        $simpan = Wishlist::create([
            'produk_id' => $id,
            'user_id' => Auth::id()
        ]);

        if ($simpan) {
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $hapus = Wishlist::where([['produk_id', '=', $id], ['user_id', '=', Auth::id()]])->delete();
        if ($hapus) {
            return redirect()->back();
        }
    }
    }
}
