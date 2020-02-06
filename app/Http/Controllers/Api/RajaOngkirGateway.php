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

    public function provinsi()
    {
//        $response = $this->client->get('http://guzzlephp.org');
        $request = $this->client->get('https://api.rajaongkir.com/starter/province', [
            'headers' => [
                'key' => $this->token
            ]
        ])->getBody()->getContents();
        $data['provinsi'] = json_decode($request, false);
        return $data;
    }

    public function kota(Request $request)
    {
        $id = $request->query('provinsi');
//        $response = $this->client->get('http://guzzlephp.org');
        $request = $this->client->get('https://api.rajaongkir.com/starter/city?province='.$id, [
            'headers' => [
                'key' => $this->token
            ]
        ])->getBody()->getContents();
        $data['kota'] = json_decode($request, false);
        return $data;
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
