<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // or user who is answering
        // an array for users

        $type = $request->get('type');

        if ($type === 'support') {
            $messages = Message::latest()
                ->where('type', $type)
                ->where(function ($query) use ($user) {
                    $query->where('user_id', $user->id)
                        ->orWhere('recipient_id', $user->id);
                })->paginate(20);
        } elseif ($type === 'group') {
            $messages = Message::latest()->where('type', $type)->paginate(20);
        }

        foreach ($messages as $message) {
            $tempUser = User::find($message->user_id);

            $message->_id = $message->id;
            $message->createdAt = $message->created_at;
            $message->user = [
                '_id' => $message->user_id,
                'name' => $tempUser->name,
//                'avatar' => 'https://i.pravatar.cc/140'
            ];
        }
        return $this->handleResponse($messages, 'list of messages.');
    }

    public function store(Request $request)
    {
        $text = $request->get('text');
        $type = $request->get('type');

        $message = new Message();
        $message->text = $text;
        $message->user_id = Auth::id();
        $message->type = $type;
        $message->save();

        return $this->handleResponse(null, 'message stored successfully.');
    }
}
