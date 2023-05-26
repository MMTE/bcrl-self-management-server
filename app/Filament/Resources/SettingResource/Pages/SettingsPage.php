<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\Setting;
use App\Models\User;
use Closure;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;

class SettingsPage extends Page
{
    protected static string $resource = SettingResource::class;

    protected static string $view = 'filament.resources.setting-resource.pages.settings-page';

    protected static ?string $title = 'تنظیمات';

    public $feedback_activation_status;
    public $feedback_activation_users;


    public function mount(): void
    {
        $this->feedback_activation_status = Setting::where('key', 'feedback_activation_status')->first();
        $this->feedback_activation_users = Setting::where('key', 'feedback_activation_users')->first();
    }


    protected function getFormSchema(): array
    {
        return [

            Select::make('feedback_activation_status.value')
                ->label('وضعیت انتشار بخش نظرسنجی')
                ->options([
                    'active_for_all_users' => 'فعال برای همه کاربران',
                    'disabled' => 'غیر فعال برای همه کاربران',
                    'active_for_specific_users' => 'فعال سازی برای بعضی کاربران',
                ])
                ->reactive()
                ->preload(),

            Select::make('feedback_activation_users.value')
                ->label('کاربرانی که نظرسنجی برای آن‌ها فعال شده است')
                ->label('کاربران')
                ->multiple()
                ->hidden(fn(Closure $get) => $get('feedback_activation_status.value') !== 'active_for_specific_users')
                ->options(User::all()->pluck('name', 'id')),];

    }

    public function submit(): void
    {
        $this->feedback_activation_status->save();
        $this->feedback_activation_users->save();
        Notification::make()
            ->title('با موفقیت ذخیره شد!')
            ->icon('heroicon-o-cog')
            ->iconColor('success')
            ->send();
    }
}
