<?php

use App\Helpers\Utility;
use App\Models\Exam;
use App\Models\ExerciseUser;
use App\Models\Measuring;
use App\Models\Setting;
use App\Models\SmsLog;
use App\Models\User;
use Carbon\Carbon;
use Filament\Notifications\Events\DatabaseNotificationsSent;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Morilog\Jalali\Jalalian;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    if (Auth::check()) {
        return \Illuminate\Support\Facades\Redirect::to('/admin');
    }
    return view('login');
});
