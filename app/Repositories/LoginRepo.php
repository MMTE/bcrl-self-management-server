<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class LoginRepo
{
    public static function sendVerificationSMS($login_code, $receptor)
    {
        $api_key = env('KAVENEGAR_API_KEY');

        $res = Http::get('https://api.kavenegar.com/v1/' . $api_key . '/verify/lookup.json',
            [
                "receptor" => $receptor,
                "token" => $login_code,
                "template" => 'login',
            ]);

        return $res->json();
    }
}
