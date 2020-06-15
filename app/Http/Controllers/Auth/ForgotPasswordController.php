<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegistrasiConfirm;
use App\Mail\ResetPassword;
use App\Models\Konsumen;
use App\Models\Password_Reset;
use App\Models\Pelapak;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request)
    {
        $cek = User::whereEmail($request->email)->first();
        if ($cek != '') {
            $url = URL::temporarySignedRoute('password.confirm', now()->addMinutes(30), ['id' => $cek->id_user]);
            Mail::to($request->email)->send(new ResetPassword($url, $cek));
            return view('auth/passwords/email_exist');
        }

        return redirect()->back()->withInput();
    }
}
