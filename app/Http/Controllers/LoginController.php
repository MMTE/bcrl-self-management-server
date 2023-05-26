<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $phone = $request->get('phone');
        $user = User::where('phone', $phone)->first();

        if (!$user) {
            $user = new User();
            $user->phone = $phone;
            $user->save();
        }

        if ($user->status == 'disabled') {
            return $this->handleError('your account is disabled. contact support for help.', 403);
        }

        // note:: api key can be moved to env
        $api_key = 'kh4ILpM4c_JfHgBBiPK8eTNKhKAno6_gvnBuYQG9O1I=';
        $pattern_code = "g1t4zpsocl8nmdr";
        $fphone = '009810004223';
        $login_code = random_int(1000, 9999);

        if (!$request->has('is_verification')) {

            $response = Http::get("http://ippanel.com:8080/?apikey=" . $api_key . "&pid=" . $pattern_code . "&fnum=" . $fphone . "&tnum=" . $phone . "&p1=verification-code&v1=" . $login_code);

            $verification_code = new VerificationCode();
            $verification_code->phone = $phone;
            $verification_code->code = $login_code;
            $verification_code->save();


            return $this->handleResponse(null, 'login sms code sent to user successfully.');

        } else {

            $code = $request->get('code');

            $verification_code = VerificationCode::where('phone', $phone)->where('code', $code)->latest()->first();

            if ($verification_code) {
                $token = $user->createToken(random_int(1, 10000))->plainTextToken;
                return $this->handleResponse([
                    'token' => $token
                ], 'verification code was correct. security token has been attached.');
            } else {
                return $this->handleError('code is wrong!', 401);
            }

        }

    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->handleResponse(null, ['this login token has been deleted. please logout and login again']);

    }

}
