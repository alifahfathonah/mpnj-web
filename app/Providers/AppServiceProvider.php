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
            if (Auth::check()) {

                $keranjang = Keranjang::with(['produk', 'user'])
                    ->where('user_id', Auth::id())
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
