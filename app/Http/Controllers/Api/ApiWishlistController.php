<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Repositories\WishlistRepository;
use Illuminate\Http\Request;

class ApiWishlistController extends Controller
{
    private $wishlistRepository;

    public function __construct(WishlistRepository $wishlistRepository)
    {
        $this->wishlistRepository = $wishlistRepository;
    }

    public function index($id_user)
    {
        $data = Wishlist::where('user_id', $id_user)->get();
        if (count($data) > 0) {
            $wish = $this->wishlistRepository->dataWishlist($id_user);
            $res['data'] = $wish;
            return response()->json($res);
        } else {
            $res1['pesan'] = "Data Kosong!";
            $res1['data'] = [];
            return response()->json($res1);
        }
    }

    public function add(Request $request, $id_user)
    {
        $data = [
            'user_id' => $id_user,
            'produk_id' => $request->id_produk
        ];
        $simpan = Wishlist::create($data);
        if ($simpan) {
            $res['pesan'] = "Sukses Cok!";
            $res['data'] = $data;
            return response()->json($res);
        } else {
            $res1['pesan'] = "Gagal Cok!";
            $res1['data'] = [];
            return response()->json($res1);
        }
    }

    public function delete(Request $request, $id_user)
    {
        $find = Wishlist::where([['produk_id', '=', $request->id_produk], ['user_id', '=', $id_user]])->first();
        if ($find == true) {
            $find->delete();
            $res['pesan'] = "Sukses Cok!";
            // $res['data'] = $find;
            return response()->json($res);
        } else {
            $res1['pesan'] = "Gagal Cok!";
            return response()->json($res1);
        }
    }
}
