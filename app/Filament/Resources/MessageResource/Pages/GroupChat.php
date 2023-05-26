<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\MessageResource;
use App\Models\Message;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class GroupChat extends Page
{
    protected static string $resource = MessageResource::class;

    protected static string $view = 'filament.resources.message-resource.pages.group-chat';

    protected static ?string $title = 'گروه خودیاری آنلاین';

    public $user;
    public $current_user_id;
    public $messages;
    public $input;

    protected $listeners = ['messagesSend' => 'getMessages'];

    public function mount()
    {
        $this->user = Auth::user();
        $this->current_user_id = Auth::id();
        $this->getMessages();
    }

    public function getMessages()
    {
        $this->messages = Message::where('type', 'group')->get();
    }

    public function submit()
    {
        $this->storeMessage($this->input, 'group', $this->user->id);
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
        $message->recipient_id = null;
        $message->save();
    }
}
