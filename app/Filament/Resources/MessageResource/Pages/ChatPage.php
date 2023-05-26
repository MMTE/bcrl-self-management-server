<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\MessageResource;
use App\Models\Message;
use App\Models\User;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatPage extends Page
{

    protected static string $resource = MessageResource::class;

    protected static string $view = 'filament.resources.message-resource.pages.chat-page';

    protected static ?string $title = '';

    public User $user;
    public $current_user_id;
    public $messages;
    public $input;

    protected $listeners = ['messagesSend' => 'getMessages'];

    public function mount()
    {
        $this->current_user_id = Auth::id();
        $this->getMessages();
    }

    public function getMessages()
    {
        $this->messages = Message::where('type', 'support')
            ->where('user_id', $this->user->id)
            ->orWhere('recipient_id', $this->user->id)
            ->get();
    }

    public function submit()
    {
        $this->storeMessage($this->input, 'support', $this->user->id);
        $this->emit('messagesSend');
        $this->input = "";
    }

    // this function can be moved to a repository as it has used in MessageController too.
    private function storeMessage($text, $type, $recipient_id)
    {
        $message = new Message();
        $message->text = $text;
        $message->user_id = Auth::id();
        $message->type = $type;
        $message->recipient_id = $recipient_id;
        $message->save();
    }

}
