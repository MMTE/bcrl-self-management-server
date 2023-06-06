<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\ExerciseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ExerciseUserController extends Controller
{
    public function store(Request $request)
    {
        $slug = $request->get('slug');
        $exercise = Exercise::where('slug', $slug)->first();

        if (!$exercise) {
            return $this->handleError('exercise was not found.');
        }

        $practice = new ExerciseUser();
        $practice->user_id = Auth::id();
        $practice->exercise_id = $exercise->id;
        $practice->save();

        return $this->handleResponse(null, 'exercise report submitted successfully.');
    }
}
