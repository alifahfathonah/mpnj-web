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
        $request = $this->client->get('https://pro.rajaongkir.com/api/province', [
            'headers' => [
                'key' => $this->token
            ]
        ])->getBody()->getContents();
        $data['provinsi'] = json_decode($request, false);
        return $data;
    }

    public function semuaKota()
    {
//        $response = $this->client->get('http://guzzlephp.org');
        $request = $this->client->get('https://pro.rajaongkir.com/api/city?city', [
            'headers' => [
                'key' => $this->token
            ]
        ])->getBody()->getContents();
        $data['kota'] = json_decode($request, false);
        return $data;
    }

    public function kota(Request $request)
    {
        $id = $request->query('provinsi');
//        $response = $this->client->get('http://guzzlephp.org');
        $request = $this->client->get('https://pro.rajaongkir.com/api/city?province='.$id, [
            'headers' => [
                'key' => $this->token
            ]
        ])->getBody()->getContents();
        $data['kota'] = json_decode($request, false);
        return $data;
    }

    public function kotaId(Request $request)
    {
        $id = $request->query('id');
//        $response = $this->client->get('http://guzzlephp.org');
        $request = $this->client->get('https://pro.rajaongkir.com/api/city?id='.$id, [
            'headers' => [
                'key' => $this->token
            ]
        ])->getBody()->getContents();
        $data['kota'] = json_decode($request, false);
        return $data;
    }

    public function kecamatan(Request $request)
    {
        $id = $request->query('id');
//        $response = $this->client->get('http://guzzlephp.org');
        $request = $this->client->get('https://pro.rajaongkir.com/api/subdistrict?city='.$id, [
            'headers' => [
                'key' => $this->token
            ]
        ])->getBody()->getContents();
        $data['kecamatan'] = json_decode($request, false);
        return $data;
    }

    public function kecamatanId(Request $request)
    {
        $id = $request->query('id');
//        $response = $this->client->get('http://guzzlephp.org');
        $request = $this->client->get('https://pro.rajaongkir.com/api/subdistrict?id='.$id, [
            'headers' => [
                'key' => $this->token
            ]
        ])->getBody()->getContents();
        $data['kecamatan'] = json_decode($request, false);
        return $data;
    }

    public function ongkir(Request $request)
    {
        $asal = $request->asal;
        $originType = $request->origin_type;
        $tujuan = $request->tujuan;
        $destinationType = $request->destinationType;
        $berat = $request->berat;
        $kurir = $request->kurir;

        $request = $this->client->post('https://pro.rajaongkir.com/api/cost',[
            'form_params' => [
                'origin' => $asal,
                'originType' => $originType,
                'destination' => $tujuan,
                'destinationType' => $destinationType,
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
