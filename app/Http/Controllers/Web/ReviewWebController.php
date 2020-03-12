<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use File;
use ImageResize;
use Illuminate\Support\Facades\Session;

class ReviewWebController extends Controller
{
    public function postReview(Request $request){
        $role = Session::get('role');
        $id = Session::get('id');
        $konsumen_id = $request->user($role)->$id;

        if ($request->hasFile('foto_review')) {
            $foto_review = $request->file('foto_review');
            $name = uniqid() . '_foto_review_' . trim($foto_review->getClientOriginalName());

            $img = ImageResize::make($foto_review);
            // --------- [ Resize Image ] ---------------
            $img->resize(100, 100)->save('assets/foto_review/'.$name);

            $review = [
                'konsumen_id' => $konsumen_id,
                'produk_id' => $request->id_produk,
                'review' => $request->review,
                'bintang' => $request->bintang,
                'foto_review' => $name
            ];
        } else {
            $review = [
                'konsumen_id' => $konsumen_id,
                'produk_id' => $request->id_produk,
                'review' => $request->review,
                'bintang' => $request->bintang
            ];
        }

        $simpan = Review::create($review);
        if ($simpan) {
            return redirect()->back();
        }
    }
}
