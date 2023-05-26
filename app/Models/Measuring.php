<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Measuring extends Model
{
    use HasFactory;

    protected $casts = [
        'measurements' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function submittedWeekNo(): Attribute
    {
        return Attribute::make(
            get: fn() => Jalalian::fromDateTime($this->created_at)->getWeekOfMonth(),
        );
    }


}
