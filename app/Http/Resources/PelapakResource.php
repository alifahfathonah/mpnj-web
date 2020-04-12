<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PelapakResource extends JsonResource
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
            'id_pelapak' => $this->id_user,
            'username' => $this->username,
            'status_official' => $this->status_official,
            'nama_toko' => $this->nama_toko,
            'alamat_toko' => $this->alamat_toko,
            'provinsi_id' => $this->provinsi_id,
            'city_id' => $this->city_id,
            'alamat' => $this->alamat,
            'kode_pos' => $this->kode_pos,
            'nomor_hp' => $this->nomor_hp,
            'email' => $this->email,
            'rating' => $this->rating,
            'saldo' => $this->saldo,
            'status'=> $this->status,
        ];
    }
}
