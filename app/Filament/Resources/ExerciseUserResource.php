<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExerciseUserResource\Pages;
use App\Filament\Resources\ExerciseUserResource\RelationManagers;
use App\Helpers\Utility;
use App\Models\ExerciseUser;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Morilog\Jalali\Jalalian;

class ExerciseUserResource extends Resource
{
    protected static ?string $model = ExerciseUser::class;
    protected static ?string $modelLabel = 'تمرین کاربر';
    protected static ?string $pluralModelLabel = 'تمارین کاربران';
    protected static ?string $navigationGroup = 'تمارین';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-check';

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
                TextColumn::make('user.name')->label('کاربر'),
                TextColumn::make('exercise.name')->label('تمرین'),
                TextColumn::make('c_created_at')->label('تاریخ انجام')
                    ->default(fn(ExerciseUser $record): string => Utility::convertEnglishNumbersToPersian(Jalalian::forge($record->created_at)->format('l d F Y - H:i:s'))),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->url(fn(Model $record): string => ExerciseUserResource::getUrl('view', $record)),
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
            'index' => Pages\ListExerciseUsers::route('/'),
            'create' => Pages\CreateExerciseUser::route('/create'),
            'view' => Pages\ViewExerciseUser::route('/{record}'),
            'edit' => Pages\EditExerciseUser::route('/{record}/edit'),
        ];
    }
}
