<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseUser extends Model
{
    use HasFactory;

    protected $table = 'exercise_user';


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
