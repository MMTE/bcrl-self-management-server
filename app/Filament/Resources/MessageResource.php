<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Filament\Resources\MessageResource\RelationManagers;
use App\Models\Message;
use Filament\Forms;
use Filament\Pages\Actions\Action;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $modelLabel = 'گفتگو';
    protected static ?string $pluralModelLabel = 'گفتگو‌ها';
    protected static ?string $navigationIcon = 'heroicon-o-chat';
    protected static ?string $navigationGroup = 'چت و گفتگو';

//    protected static ?string $navigationGroup = 'آزمون';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ShowUsersChatList::route('/'),
            'chat' => Pages\ChatPage::route('/{user}/chat'),
            'group' => Pages\GroupChat::route('/group-chat'),
//            'index' => Pages\ListMessages::route('/'),
//            'create' => Pages\CreateMessage::route('/create'),
//            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}
