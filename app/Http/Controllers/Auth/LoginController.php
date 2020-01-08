<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $cek = Konsumen::where([
            'username' => $request->username,
            'password' => $request->password
        ])->get();

        if (count($cek) > 0) {
            // session(['username' => $request->username]);
            $request->session()->put('username', $request->username);
            return redirect('produk');
        } else {
            dd('gagal');
        }
    }

    public function keluar(Request $request)
    {
        $request->session()->forget('username');
        return redirect('produk');
    }
}
