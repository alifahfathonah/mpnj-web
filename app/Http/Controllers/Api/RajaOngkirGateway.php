<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class RajaOngkirGateway extends Controller
{
    protected $client, $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->token = env('API_RAJAONGKIR');
    }

    public function ongkir(Request $request)
    {
        $asal = $request->asal;
        $tujuan = $request->tujuan;
        $berat = $request->berat;
        $kurir = $request->kurir;

        $request = $this->client->post('https://api.rajaongkir.com/starter/cost',[
            'form_params' => [
                'origin' => $asal,
                'destination' => $tujuan,
                'weight' => $berat,
                'courier' => $kurir
            ],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'key' => $this->token
            ],
        ])->getBody()->getContents();

        $data['ongkir'] = json_decode($request, false);
        return $data;
    }
}
