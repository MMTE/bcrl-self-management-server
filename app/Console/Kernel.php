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
            $users = User::whereNotNull('reminders')->get();

            foreach ($users as $user) {
                $now = Carbon::now();

                $days = $user->reminders['days'];
                $reminderHours = $user->reminders['hours'];

                $todayWeekDayNumber = Utility::getCarbonConstantInCustomStandard($now->setTimezone('Asia/Tehran')->weekday());
                if (!in_array($todayWeekDayNumber, $days)) continue;

                foreach ($reminderHours as $reminder) {

                    $SmsLogs = SmsLog::where('user_id', 2)
                        ->where('type', 'exercise-reminder')
                        ->whereDate('created_at', $now->toDateString())
                        ->get();

                    $already_sent = false;

                    foreach ($SmsLogs as $SmsLog) {
                        if ($SmsLog && $SmsLog->details && $SmsLog->details['reminder_hour'] == $reminder && $SmsLog->details['day'] == $todayWeekDayNumber) $already_sent = true;
                    }

                    if ($already_sent) continue;

                    $due_hour = Carbon::make(new Carbon($reminder))->setDate($now->year, $now->month, $now->day);

                    if ($due_hour > $now) continue;
                    if ($due_hour->diffInHours($now) >= 3) continue;

                    SmsLog::create([
                        'user_id' => $user->id,
                        'type' => 'exercise-reminder',
                        'details' => [
                            'reminder_hour' => $reminder,
                            'day' => $todayWeekDayNumber
                        ]
                    ]);
                    LoginRepo::sendReminderSMS($user->phone);
                    Http::post('https://api.pushover.net/1/messages.json', [
                        'token' => 'ag5id77r2miivse7r7tnfwe6vz5eow',
                        'user' => 'u2x8b62ws1eok9ofda8quvu6iyhueu',
                        'message' => 'یادآوری ارسال شد برای ' . $user->phone,
                    ]);
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
