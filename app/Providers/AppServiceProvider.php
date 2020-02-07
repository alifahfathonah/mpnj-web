<?php

namespace App\Providers;

use App\Models\Kategori_Produk;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('currency', function($expression) {
            return "Rp. <?php echo number_format($expression, 0, ', ', '.'); ?>";
        });

        view()->composer('*', function ($view)
        {
            if (Session::has('id')) {
                $role = Session::get('role');
                $id = Session::get('id');
                if (Session::has('id')) {
                    $konsumen_id = Auth::guard($role)->user()->$id;
                }

                $keranjang = Keranjang::with(['produk', 'pembeli'])
                    ->where('pembeli_id', $konsumen_id)
                    ->where('pembeli_type', $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak')
                    ->where('status', 'N')
                    ->limit(2)
                    ->get();

                //...with this variable
                $view->with('cart', $keranjang);
            }
            $kategori = Kategori_Produk::Select('id_kategori_produk', 'nama_kategori')->get();
            $view->with('kategori', $kategori);
        });
    }
}
