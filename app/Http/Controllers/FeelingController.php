<?php

namespace App\Http\Controllers;

use App\Models\Feeling;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeelingController extends Controller
{
    public function index()
    {
        $id = Auth::id();

        $feeling = Feeling::where('user_id', $id)->whereDate('created_at', Carbon::today())->first();

        return $this->handleResponse($feeling, 'today submitted mood');
    }

    public function store(Request $request)
    {
        $id = Auth::id();
        $mood = $request->get('feeling');

        $feeling = Feeling::where('user_id', $id)->whereDate('created_at', Carbon::today())->first();

        if (!$feeling) {
            $feeling = new Feeling();
            $feeling->user_id = $id;
        }

        $feeling->feeling = $mood;
        $feeling->save();

        return $this->handleResponse(null, 'Mood saved successfully.');
    }
}
