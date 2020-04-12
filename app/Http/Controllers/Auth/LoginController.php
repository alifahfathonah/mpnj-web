<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use App\Models\Pelapak;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        $this->middleware('guest')->except('keluar');
    }
    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $credential = $request->only('username','password');

        if (Auth::attempt($credential)) {
            $request->session()->put('role', Auth::user()->role);
            return redirect('produk');
        }
        
        return redirect()->back()->with('loginError', 'Login error, periksa kembali data login anda');
    }


    public function keluar(Request $request)
    {
        Auth::logout();
        return redirect('/produk');
    }
}
