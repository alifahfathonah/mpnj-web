<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Kategori_Produk;
use App\Models\Produk;
use DB;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukWebController extends Controller
{
    public function index(Request $request)
    {
        $nama_produk = $request->query('cari');

        if ($nama_produk != '') {
            $data['produk'] = Produk::with(['foto_produk', 'kategori', 'user'])->where('nama_produk', 'like', '%' . $nama_produk . '%')->get();
        } else {
            $data['produk'] = Produk::with(['foto_produk', 'kategori', 'user'])->get();
        }

        $data['latestProduk']  =  Kategori_Produk::with(['latestProduk' => function ($query) {
            $query->with(['foto_produk'])->latest('id_produk')->get();
        }])->latest('id_kategori_produk')->get();
        $data['kategori'] = Kategori_Produk::select('id_kategori_produk', 'nama_kategori')->get();
        $data['produkDiskon'] = Produk::with(['foto_produk', 'kategori', 'user'])->where('diskon', '!=', 0)->orderBy('diskon', 'desc')->take(5)->get();
        return view('web/web_home', $data);
    }

    public function produk(Request $request)
    {
        $kategori = $request->query('kategori');
        $nama_produk = $request->query('cari');
        $order = $request->query('order');

        if ($kategori != '') {
            $data['produk'] = Produk::with(['foto_produk', 'kategori', 'user'])->when($kategori != '', function ($query) use ($kategori) {
                $query->whereHas('kategori', function ($query) use ($kategori) {
                    $query->where('nama_kategori', $kategori != '' ? $kategori : '');
                });
            })->orderBy($order == 'laris' ? 'terjual' : DB::raw('harga_jual - (diskon / 100 * harga_jual)'), $order == 'high' ? ('DESC') : ($order == 'laris' ? ('DESC') : ('ASC')))->paginate(12);
            // })->orderBy('harga_jual', $order == 'high' ? 'DESC' : 'ASC')->orderBy('terjual', $order == 'laris' , 'DESC')->paginate(12);
        } else if ($nama_produk != '') {
            $data['produk'] = Produk::with(['foto_produk', 'kategori', 'user'])->where('nama_produk', 'like', '%' . $nama_produk . '%')->orderBy(DB::raw('harga_jual - (diskon / 100 * harga_jual)'), $order == 'high' ? 'DESC' : 'ASC')->paginate(12);
        } else {
            $data['produk'] = Produk::with(['foto_produk', 'kategori', 'user'])->paginate(12);
        }
        $data['kategori'] = Kategori_Produk::Select('id_kategori_produk', 'nama_kategori')->get();
        return view('web/web_produk', $data);
    }

    public function popular(Request $request)
    {
        $data['produk'] = Produk::with(['foto_produk', 'kategori', 'pelapak'])->orderBy('terjual', 'DESC')->paginate(12);

        $data['kategori'] = Kategori_Produk::Select('id_kategori_produk', 'nama_kategori')->get();
        return view('web/web_produk', $data);
    }

    public function produkId(Request $request, $slug)
    {
        $data['produk'] = Produk::with(['foto_produk', 'kategori', 'user'])->where('slug', $slug)->first();
        $data['produk_pelapak'] = Produk::with(['foto_produk', 'kategori', 'user'])->where('user_id', $data['produk']->user->id_user)->get();

        $data['review'] = Review::with('user')->where('produk_id', $data['produk']->id_produk)->paginate(2);
        $data['counts'] = $data['review']->total();


        if ($request->ajax()) {
            return view('web.load.paginate', $data);
        }

        return view('web/web_produk_detail', $data);
    }
}
