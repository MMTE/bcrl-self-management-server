<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Filament\Resources\FeedbackResource\RelationManagers;
use App\Helpers\Utility;
use App\Models\Feedback;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Morilog\Jalali\Jalalian;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $modelLabel = 'نظر';

    protected static ?string $pluralModelLabel = 'نظرات';
    protected static ?string $navigationGroup = 'نظرسنجی';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-check';
    protected static ?int $navigationSort = 10;


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('کاربر'),
                TextColumn::make('c_created_at')->label('تاریخ ثبت')
                    ->default(fn(Feedback $record): string => Utility::convertEnglishNumbersToPersian(Jalalian::forge($record->created_at)->format('l d F Y - H:i:s'))),
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
            'index' => Pages\ListFeedback::route('/'),
            'view' => Pages\ViewFeedback::route('/{record}'),
            'create' => Pages\CreateFeedback::route('/create'),
            'edit' => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }
}
