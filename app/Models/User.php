<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'status',
        'phone',
        'age',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'reminders' => 'array',
    ];

    const DAYS = [
        0 => 'شنبه',
        1 => 'یک‌شنبه',
        2 => 'دوشنبه',
        3 => 'سه‌شنبه',
        4 => 'چهار‌شنبه',
        5 => 'پنج‌شنبه',
        6 => 'جمعه',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->first_name . ' ' . $this->last_name,
            set: fn($value) => $this->first_name = $value,
        );
    }

    public function canAccessFilament(): bool
    {
        return $this->role == 'admin';
    }


    public function messages()
    {
        return $this->hasMany(Message::class);
    }


    public function Feelings()
    {
        return $this->hasMany(Feeling::class);
    }

//    public function supportMessages()
//    {
//        return $this->hasMany(Message::class)
//            ->where('type', 'support')
//            ->where('recipient_id', '=', $this->id)
//            ->orWhere('recipient_id', '=', null);
//    }

}
