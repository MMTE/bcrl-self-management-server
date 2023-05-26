<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Models\User;
use Closure;
use Filament\Tables;
use App\Filament\Resources\MessageResource;
use Filament\Resources\Pages\Page;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ShowUsersChatList extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = MessageResource::class;

    protected static string $view = 'filament.resources.message-resource.pages.show-users-chat-list';

    protected static ?string $title = 'گفتگو با درمانگر';

    protected function getTableQuery(): Builder
    {
        // messages between current admin user and
        return User::whereHas('messages', function ($q) {
            $q->where('type', 'support')->where('user_id','!=',Auth::id());
        });
    }

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn(Model $record): string => MessageResource::getUrl('chat', ['user' => $record]);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->label('نام'),
        ];

    }

}
