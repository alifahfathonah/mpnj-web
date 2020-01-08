<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class KonsumenWebController extends Controller
{
    protected $client, $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->token = env('API_RAJAONGKIR');
    }

    public function index()
    {
        $request = $this->client->get('https://api.rajaongkir.com/starter/province', [
            'headers' => [
                'key' => $this->token
            ]
        ])->getBody()->getContents();
        $data['provinsi'] = json_decode($request, false);
        return view('auth/register', $data);
    }


}
