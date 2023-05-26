<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Report extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function getCreatedAtWeekNumber(): Attribute
    {
        return Attribute::make(
            get: fn() => Jalalian::fromDateTime($this->created_at)->getWeekOfMonth(),
        );
    }

}
