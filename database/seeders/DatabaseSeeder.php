<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Exercise;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create default setting fields for feedback
        $setting = new Setting();
        $setting->key = 'feedback_activation_status';
        $setting->value = '';
        $setting->save();

        $setting = new Setting();
        $setting->key = 'feedback_activation_status';
        $setting->value = '';
        $setting->save();

        // create default exercises
        $setting = new Exercise();
        $setting->name = 'ماساژ لنفاوی';
        $setting->slug = 'massage';
        $setting->save();

        $exercise = new Exercise();
        $exercise->name = 'بانداژ';
        $exercise->slug = 'bandage';
        $exercise->save();

        $exercise = new Exercise();
        $exercise->name = 'ورزش';
        $exercise->slug = 'exercise';
        $exercise->save();

        $exercise = new Exercise();
        $exercise->name = 'مراقبت از پوست';
        $exercise->slug = 'skin-care';
        $exercise->save();

        // create admin user
        $user = new User();
        $user->first_name = '';
        $user->last_name = 'ادمین';
        $user->phone = '09210418717';
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();
    }
}
