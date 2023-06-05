<?php

namespace App\Console;

use App\Helpers\Utility;
use App\Models\SmsLog;
use App\Models\User;
use App\Repositories\LoginRepo;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            // get all users
            $users = User::all();
            // iterate users and send their reminders
            foreach ($users as $user) {
                // check if user has set the reminder option
                if ($user->reminders == null) continue;

                $now = Carbon::now();
                $days = $user->reminders['days'];
                $hours = $user->reminders['hours'];
                $todayWeekDayNumber = Utility::getCarbonConstantInCustomStandard($now->weekday());

                if (in_array($todayWeekDayNumber, $days)) {
                    // today is reminder day
                    foreach ($hours as $hour) {
                        // check if reminder is already sent
                        $SmsLog = SmsLog::where('user_id', 2)->where('type', 'exercise-reminder')->first();
                        if ($SmsLog && $SmsLog->details && ($SmsLog->details['reminder_hour'] == $hour)) continue; else {

                            $t_hour = Carbon::make(new Carbon($hour))->setDate($now->year, $now->month, $now->day);
                            // send reminder if it's the time
                            if ($t_hour <= $now) {
                                // send sms
                                LoginRepo::sendReminderSMS($user->phone);

                                // save the log
                                $SmsLog = new SmsLog();
                                $SmsLog->user_id = $user->id;
                                $SmsLog->type = 'exercise-reminder';
                                $SmsLog->details = ['reminder_hour' => $hour];
                                $SmsLog->save();
                            }
                        }
                    }
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
