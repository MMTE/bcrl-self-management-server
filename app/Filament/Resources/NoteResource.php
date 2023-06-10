<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoteResource\Pages;
use App\Filament\Resources\NoteResource\RelationManagers;
use App\Helpers\Utility;
use App\Models\ExerciseUser;
use App\Models\Note;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Morilog\Jalali\Jalalian;

class NoteResource extends Resource
{
    protected static ?string $model = Note::class;

    protected static ?string $modelLabel = 'یادداشت';
    protected static ?string $pluralModelLabel = 'یادداشت‌ها';
    protected static ?string $navigationIcon = 'heroicon-o-pencil-alt';
    protected static ?string $navigationGroup = 'دفترچه یادداشت';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('text')->label('یادداشت'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('کاربر'),
                TextColumn::make('c_created_at')->label('تاریخ انجام')
                    ->default(fn(Note $record): string => Utility::convertEnglishNumbersToPersian(Jalalian::forge($record->created_at,new \DateTimeZone('Asia/Tehran'))->format('l d F Y - H:i:s'))),
            ])
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListNotes::route('/'),
            'create' => Pages\CreateNote::route('/create'),
            'edit' => Pages\EditNote::route('/{record}/edit'),
        ];
    }
}
