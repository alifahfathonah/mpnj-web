<?php

namespace App\Http\Resources;

use App\Models\Produk;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailProdukResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $id
     * @return array
     */
    public function toArray($request, $id)
    {
        if (Produk::where('id_produk', $id)->exists()) {
            return [
                'id_produk' => $this->id_produk,
                'nama_produk' => $this->nama_produk,
                'harga' => $this->harga_jual,
                'diskon' => $this->diskon,
                'kategori' => new KategoriResource($this->kategori),
                'kategori' => [
                    'id_kategori' => $this->kategori->id_kategori_produk,
                    'nama_kategori' => $this->kategori->nama_kategori,
                ],
            ];
        } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
        }
    }
}
