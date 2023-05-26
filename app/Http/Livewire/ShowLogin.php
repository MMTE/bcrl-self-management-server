<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class ShowLogin extends Component
{
    public function render()
    {
        return view('livewire.show-login');
    }

    public $phone;
    public $code;
    public $status;
    public $user;

    public function mount()
    {
        $this->status = null;
    }

    public function submit()
    {
        $this->user = User::where('phone', $this->phone)->first();

        if ($this->status === null) {

            if (!$this->user) {
                $this->user = new User();
                $this->user->phone = $this->phone;
                $this->user->save();
            }

            if ($this->user->status === 'disabled') {
                return dd('your account is disabled. contact support for help.');
            }

            $this->sendCode();

            $this->status = 'verify';

        } elseif ($this->status === 'verify') {
            //check code
            $this->verifyCode();
        }
    }

    public function sendCode()
    {

        // note:: api key can be moved to env
        $api_key = 'kh4ILpM4c_JfHgBBiPK8eTNKhKAno6_gvnBuYQG9O1I=';
        $pattern_code = "g1t4zpsocl8nmdr";
        $fphone = '009810004223';
        $login_code = random_int(1000, 9999);

        $response = Http::get("http://ippanel.com:8080/?apikey=" . $api_key . "&pid=" . $pattern_code . "&fnum=" . $fphone . "&tnum=" . $this->phone . "&p1=verification-code&v1=" . $login_code);

        $verification_code = new VerificationCode();
        $verification_code->phone = $this->phone;
        $verification_code->code = $login_code;
        $verification_code->save();

    }

    public function verifyCode()
    {

        $code = $this->code;
        $phone = $this->phone;

        $verification_code = VerificationCode::where('phone', $phone)->where('code', $code)->latest()->first();

        if ($verification_code) {
            Auth::login($this->user);
            return redirect('/admin');
        } else {
            return dd('کد ورود اشتباه است.');
        }

    }
}
