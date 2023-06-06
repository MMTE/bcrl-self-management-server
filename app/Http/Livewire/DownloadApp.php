<?php

namespace App\Http\Livewire;

use App\Helpers\Utility;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Livewire\Component;
use PHPUnit\TextUI\Help;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class DownloadApp extends Component
{
    protected $rules = [
        'phone' => 'required|numeric',
    ];

    public $showDownloadBox = false;
    public $phone = "";

    public function show()
    {
        $this->showDownloadBox = !$this->showDownloadBox;
    }

    public function download()
    {
        $this->phone = Utility::convertPersianNumbersToEnglish($this->phone);
        $this->validate();

        if (Str::length($this->phone) < 11){
            $this->addError('phone', 'لطفا شماره موبایل را درست وارد کنید.مثلا ۰۹۱۲۲۲۳۳۴۴۴');
        }

        $user = User::where('phone', $this->phone)->first();

        if (!$user) {
            $user = User::create([
                'phone' => $this->phone,
            ]);
            return $this->addError('phone', 'اکانت کاربری شما فعال نشده است. از ادمین بخواهید تا اکانت شما را فعال کند تا بتوانید دانلود را انجام دهید.');
        }

        return Redirect::to('https://lymphedema-app.s3.ir-thr-at1.arvanstorage.ir/%D8%A7%D8%AF%D9%85-%D9%84%D9%86%D9%81%D8%A7%D9%88%DB%8C.apk');
    }

    public function render()
    {
        return view('livewire.download-app');
    }


}
