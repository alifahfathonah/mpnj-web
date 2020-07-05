<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Repositories\ReviewRepository;
use Illuminate\Http\Request;
use File;

class ApiReviewController extends Controller
{
    private $reviewRepository;
    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function getReview(Request $request, $id_produk)
    {
        $data = Review::where('produk_id', $id_produk)->get();
        if (count($data) > 0) {
            $review = $this->reviewRepository->findById($id_produk);
            $res['data'] = $review;
            return response()->json($res);
        } else {
            $res2['pesan'] = "Gagal!";
            $res2['data'] = [];
            return response()->json($res2);
        };
    }

    public function simpan(Request $request)
    {
        $file = $request->file('file');
        $name = uniqid() . '_foto_review_' . trim($file->getClientOriginalName());

        $review = [
            'user_id' => $request->id_user,
            'produk_id' => $request->id_produk,
            'review' => $request->review,
            'bintang' => $request->bintang,
            'foto_review' => $name
        ];

        $simpanReview = Review::create($review);

        if ($simpanReview) {
            $file->move('assets/foto_review/', $name);
            $res['pesan'] = "Sukses Review!";
            $res['data'] = $simpanReview;

            return response()->json($res, 201);
        } else {
            $res2['pesan'] = "Gagal Review!";
            return response()->json($res2);
        }
    }

    public function update(Request $request, $id_user, $id_produk)
    {
        $file = $request->file('file');
        if ($request->hasFile('file')) {

            $name = uniqid() . '_foto_review_' . trim($file->getClientOriginalName());

            $review = [
                'review' => $request->review,
                'bintang' => $request->bintang,
                'foto_review' => $name
            ];

            $file->move('assets/foto_review/', $name);
        } else {
            $review = [
                'review' => $request->review,
                'bintang' => $request->bintang
            ];
        }

        $find = Review::where('user_id', $id_user)->where('produk_id', $id_produk)->first();

        if ($file != null) {
            File::delete('assets/foto_review/', $find->foto_review);
        }
        $updateReview = $find->update($review);
        if ($updateReview) {
            // $file->move('assets/foto_review/', $name);
            $res['pesan'] = "Sukses Review!";
            $res['data'] = $review;

            return response()->json($res, 201);
        } else {
            $res2['pesan'] = "Gagal Review!";
            return response()->json($res2);
        }
    }
}
