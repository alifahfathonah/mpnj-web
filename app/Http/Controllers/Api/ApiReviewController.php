<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Repositories\ReviewRepository;
use Illuminate\Http\Request;

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
}
