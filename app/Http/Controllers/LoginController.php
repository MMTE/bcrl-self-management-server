<?php

namespace App\Http\Controllers;

use App\Helpers\Utility;
use App\Models\User;
use App\Models\VerificationCode;
use App\Repositories\LoginRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $phone = $request->get('phone');
        $phone = Utility::convertPersianNumbersToEnglish($phone);

        $user = User::where('phone', $phone)->first();
        if (!$user) {
            $user = User::create([
                'phone' => $phone,
            ]);
            return $this->handleError('your account is disabled. contact support for help.', 403);
        }

        if ($user->status == 'disabled') {
            return $this->handleError('your account is disabled. contact support for help.', 403);
        }

        $login_code = random_int(1000, 9999);

        if (!$request->has('is_verification')) {
            LoginRepo::sendVerificationSMS($login_code, $phone);

            $verification_code = new VerificationCode();
            $verification_code->phone = $phone;
            $verification_code->code = $login_code;
            $verification_code->save();

            return $this->handleResponse(
                [
                    'ask_for_name' => (empty($user->first_name) && empty($user->last_name)),
                    'ask_for_age' => (empty($user->age)),
                ]
                , 'login sms code sent to user successfully.');

        } else {

            $code = $request->get('code');
            $code = Utility::convertPersianNumbersToEnglish($code);

            $first_name = $request->get('first_name');
            $last_name = $request->get('last_name');

            $age = $request->get('age');
            $age = Utility::convertPersianNumbersToEnglish($age);

            $verification_code = VerificationCode::where('phone', $phone)->where('code', $code)->latest()->first();

            if ($verification_code) {

                $token = $user->createToken(random_int(1, 10000))->plainTextToken;

                if (!empty($first_name) || !empty($last_name)) {
                    $user->first_name = $first_name;
                    $user->last_name = $last_name;
                    $user->age = $age;
                    $user->save();
                }

                return $this->handleResponse([
                    'token' => $token
                ], 'verification code was correct. security token has been attached.');
            }

            return $this->handleError('code is wrong!', 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->handleResponse(null, ['this login token has been deleted. please logout and login again']);
    }
}
