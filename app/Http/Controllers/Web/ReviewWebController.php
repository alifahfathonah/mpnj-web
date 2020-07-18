<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Produk;
use File;
use Illuminate\Support\Facades\Auth;
use ImageResize;
use Illuminate\Support\Facades\Validator;

class ReviewWebController extends Controller
{

    public function index(Request $request, $slug)
    {
        $data['produk'] = Produk::with(['foto_produk', 'kategori', 'user', 'wishlists'])->where('slug', $slug)->first();
        $data['review'] = Review::with(['user', 'produk'])->where('produk_id', $data['produk']->id_produk)->where('user_id', Auth::id())->first();
        return view('web/web_review_produk', $data);
    }

    public function postReview(Request $request)
    {

        $validator = Validator::make($request->except('token'), [
            'foto_review' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        if ($request->hasFile('foto_review')) {

            $foto_review = $request->file('foto_review');
            $name = uniqid() . '_foto_review_' . trim($foto_review->getClientOriginalName());
            $img = ImageResize::make($foto_review);
            $img->resize(100, 100)->save('assets/foto_review/' . $name);

            $review = [
                'user_id' => Auth::id(),
                'produk_id' => $request->id_produk,
                'review' => $request->review,
                'bintang' => $request->bintang,
                'foto_review' => $name
            ];
        } else {
            $review = [
                'user_id' => Auth::id(),
                'produk_id' => $request->id_produk,
                'review' => $request->review,
                'bintang' => $request->bintang
            ];
        }

        $cekReviewer = Review::with(['user', 'produk'])->where('produk_id', $request->id_produk)->where('user_id', Auth::id())->get()->count(1);
        if ($cekReviewer) {
            return redirect()->back()->with('message', 'Anda Sudah Mengulas Produk Ini');
        } else {
            Review::create($review);
            return redirect()->back()->with('message', 'Terimakasih Atas Ulasan Anda');
        }
    }

    public function updateReview(Request $request, $id)
    {

        $validator = Validator::make($request->except('token'), [
            'foto_review' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $foto_review = $request->file('foto_review');
        if ($request->hasFile('foto_review')) {

            $name = uniqid() . '_foto_review_' . trim($foto_review->getClientOriginalName());
            $img = ImageResize::make($foto_review);
            $img->resize(100, 100)->save('assets/foto_review/' . $name);

            $review = [
                'review' => $request->review,
                'bintang' => $request->bintang,
                'foto_review' => $name
            ];

            $foto_review->move('assets/foto_review/', $name);
        } else {
            $review = [
                'review' => $request->review,
                'bintang' => $request->bintang
            ];
        }

        $find = Review::where('produk_id', $request->id_produk)->where('user_id', Auth::id())->first();

        if ($foto_review != null) {
            File::delete('assets/foto_review/' . $find->foto_review);
        }
        $find->update($review);
        return redirect()->back()->with('message', 'Ulasan Diupdate');
    }
}
