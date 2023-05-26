<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return $this->handleResponse($user->reminders ?: [
            'days' => [],
            'hours' => [
                'first' => '',
                'second' => ''
            ]
        ], 'reminders date and time');
    }

    public function store(Request $request)
    {
        $reminders = $request->get('reminders');

        $user = Auth::user();
        $user->reminders = $reminders;
        $user->save();

        return $this->handleResponse([], 'reminders saved successfully');
    }
}
