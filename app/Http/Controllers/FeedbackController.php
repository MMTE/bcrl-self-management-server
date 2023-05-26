<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Feedback;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $user_id = Auth::id();
        $data = $request->get('data');

        $feedback = new Feedback();
        $feedback->user_id = $user_id;
        $feedback->data = $data;
        $feedback->save();

        return $this->handleResponse(null, 'feedback saved successfully');
    }


    public function status()
    {
        $id = Auth::id();

        $feedback_activation_status = Setting::where('key', 'feedback_activation_status')->first();
        $feedback_activation_users = Setting::where('key', 'feedback_activation_users')->first();

        $is_activated = false;

        if ($feedback_activation_status->value === "active_for_all_users" || $feedback_activation_status->value === "active_for_specific_users" && in_array($id, $feedback_activation_users->value)) {
            $is_activated = true;
        }

        return $this->handleResponse($is_activated, 'status of feedback section.');
    }

}
