<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\sendRegistrationEmail;
use App\Mail\RegistrasiConfirm;
use App\Models\Produk;
use GuzzleHttp\Client;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama_lengkap' => ['required'],
            'username' => ['required','unique:users'],
            'password' => ['required'],
            'nomor_hp' => ['required','min:12','numeric','unique:users'],
            'email' => ['required','email','unique:users']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $request)
    {
        return User::create([
            'nama_lengkap' => $request['nama_lengkap'],
            'username' => $request['username'],
            'password' => $request['password'],
            'nomor_hp' => $request['nomor_hp'],
            'email' => $request['email'],
            'role' => 'konsumen'
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth/register');
    }

    public function register(Request $request)
    {
        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nomor_hp' => $request->nomor_hp,
            'email' => $request->email,
            'role' => 'konsumen'
        ];

        if ($this->validator($data)->fails()) {
            return redirect()
                ->back()
                ->with('registerError', 'Register Error. Pastikan data anda sudah benar')
                ->withInput();
        }

        $simpan = $this->create($data);
        if ($simpan) {
            $credential = $request->only('username','password');
            if (Auth::attempt($credential)) {
                $kirimEmailRegistrasi = Mail::to($request->email)->send(new RegistrasiConfirm($simpan->id_user));
                if ($kirimEmailRegistrasi) {
                    $request->session()->put('role', Auth::user()->role);
                }
            }
            return redirect('/');
        }
    }
}
