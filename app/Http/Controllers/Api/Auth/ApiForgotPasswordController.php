<?php


namespace App\Http\Controllers\Api\Auth;


use App\Mail\ResetPassword;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class ApiForgotPasswordController
{
    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request)
    {
        $cek = User::whereEmail($request->email)->first();
        if (!is_null($cek)) {
            $url = URL::temporarySignedRoute('password.confirm', now()->addMinutes(30), ['id' => $cek->id_user]);
            Mail::to($request->email)->send(new ResetPassword($url, $cek));
            return response()->json(["pesan" => "Sukses. Email konfirmasi telah dikirimkan ke email anda. Silahkan cek email (spam) anda untuk melanjutkan proses."]);
        } else {
            return response()->json(["pesan" => "Email tidak ditemukan"]);
        }
    }
}