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
        $this->middleware('guest:konsumen')->except('keluar');
    }
    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $credential = $request->only('username','password');

        if (Auth::guard('konsumen')->attempt($credential)) {
            $request->session()->put('role', 'konsumen');
            $request->session()->put('id', 'id_konsumen');
            return redirect('produk');
        } else {
            if (Auth::guard('pelapak')->attempt($credential)) {
                $request->session()->put('role', 'pelapak');
                $request->session()->put('id', 'id_pelapak');
                return redirect('produk');
            }
        }
    }

//    public function login(Request $request)
//    {
//        $cek = Konsumen::where([
//            'username' => $request->username,
//            'password' => $request->password
//        ])->get();
//
//        if (count($cek) > 0) {
//            // session(['username' => $request->username]);
//            $request->session()->put('id', $cek[0]->id_konsumen);
//            $request->session()->put('role', 'konsumen');
//            $request->session()->put('username', $request->username);
//            return redirect('produk');,

//        } else {
//            $cekPelapak = Pelapak::where([
//	            'username' => $request->username,
//	            'password' => $request->password
//            ])->get();
//            if (count($cekPelapak) > 0) {
//	            $request->session()->put('id', $cekPelapak[0]->id_pelapak);
//	            $request->session()->put('role', 'pelapak');
//	            $request->session()->put('username', $request->username);
//	            return redirect('produk');
//            }
//        }
//    }

    public function keluar(Request $request)
    {
        $role = Session::get('role');
        Session::forget('role');
        Session::forget('id');
        Auth::guard($role)->logout();
        return redirect('/produk');
    }
}
