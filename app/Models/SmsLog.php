<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'details'];

    protected $casts = [
        'details' => 'array',
    ];

}
