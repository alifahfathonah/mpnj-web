<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Models\Review;

class ReviewWebController extends Controller
{
    public function postReview($id_produk){
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;

        $review = Review::create([
            'konsumen_id' => $konsumen_id,
            'produk_id' => $request->produk,
            'review' => $request->review,
            'bintang' => $request->bintang,
            'foto' => $request->foto
        ]);
    }
}
