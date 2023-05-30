<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeling extends Model
{
    use HasFactory;

    const STATUS_TRANSLATIONS = [
        1 => 'خیلی خوبم 😍',
        2 => ' خوبم 😊',
        3 => 'بد نیستم 🙂',
        4 => 'بد 🤢',
        5 => 'خیلی بد 🤮'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
