<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id_produk' => $this->id_produk,
            'nama_produk' => $this->nama_produk,
            'harga' => $this->harga_jual,
            'diskon' => $this->diskon,
            'foto'  => $this->foto,
            'kategori' => new KategoriResource($this->kategori),
            'kategori' => [
                'id_kategori' => $this->kategori->id_kategori_produk,
                'nama_kategori' => $this->kategori->nama_kategori,
            ],
        ];
    }
}
