<?php

namespace App\Http\Livewire;

use App\Helpers\Utility;
use App\Models\User;
use App\Models\VerificationCode;
use App\Repositories\LoginRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
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
    protected $rules = [
        'phone' => 'required|numeric',
    ];

    public function mount()
    {
        $this->status = null;
    }

    public function submit()
    {
        $this->phone = Utility::convertPersianNumbersToEnglish($this->phone);
        $this->validate();

        if (Str::length($this->phone) < 11) {
            $this->addError('phone', 'لطفا شماره موبایل را درست وارد کنید.مثلا ۰۹۱۲۲۲۳۳۴۴۴');
        }

        $this->user = User::where('phone', $this->phone)->first();

        if ($this->status == null) {

            if (!$this->user) {
                $this->user = new User();
                $this->user->phone = $this->phone;
                $this->user->save();
                return $this->addError('phone', 'اکانت کاربری شما فعال نشده است. از ادمین بخواهید تا اکانت شما را فعال کند تا بتوانید وارد شوید.');
            }

            $this->sendCode();

            $this->status = 'verify';

        } elseif ($this->status == 'verify') {
            //check code
            $this->verifyCode();
        }
    }

    public function sendCode()
    {
        $login_code = random_int(1000, 9999);
        LoginRepo::sendVerificationSMS($login_code, $this->phone);

        $verification_code = new VerificationCode();
        $verification_code->phone = $this->phone;
        $verification_code->code = $login_code;
        $verification_code->save();
    }

    public function verifyCode()
    {
        $this->code = Utility::convertPersianNumbersToEnglish($this->code);

        $code = $this->code;
        $phone = $this->phone;

        $verification_code = VerificationCode::where('phone', $phone)->where('code', $code)->latest()->first();

        if ($verification_code) {
            Auth::login($this->user);
            return redirect('/admin');
        } else {
            return $this->addError('phone', 'کد ورود اشتباه است!');
        }

    }
}
