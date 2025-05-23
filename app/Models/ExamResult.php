<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;

    protected $casts = [
        'result' => 'array',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Exam()
    {
        return $this->belongsTo(Exam::class);
    }

}
