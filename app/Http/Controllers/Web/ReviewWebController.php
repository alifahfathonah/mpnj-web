<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Session;

class ReviewWebController extends Controller
{
    public function postReview(Request $request){
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;

        $review = [
            'konsumen_id' => $konsumen_id,
            'produk_id' => $request->id_produk,
            'review' => $request->review,
            'bintang' => $request->bintang,
            // 'foto' => $request->foto
        ];

        $simpan = Review::create($review);
        if ($simpan) {
            return redirect()->back();
        }
    }
}
