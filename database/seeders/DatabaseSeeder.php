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
        $setting->key = 'ماساژ لنفاوی';
        $setting->value = 'massage';
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
    }
}
