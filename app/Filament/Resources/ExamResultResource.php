<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResultResource\Pages;
use App\Filament\Resources\ExamResultResource\RelationManagers;
use App\Helpers\Utility;
use App\Models\ExamResult;
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

class ExamResultResource extends Resource
{
    protected static ?string $model = ExamResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'آزمون';
    protected static ?string $modelLabel = 'نتیجه آزمون';
    protected static ?string $pluralModelLabel = 'نتایج آزمون‌ها';
    protected static ?int $navigationSort = 3;
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
                TextColumn::make('exam.title')->label('آزمون'),
                TextColumn::make('c_created_at')->label('تاریخ انجام')
                    ->default(fn(ExamResult $record): string => Utility::convertEnglishNumbersToPersian(Jalalian::forge($record->created_at)->format('l d F Y - H:i:s'))),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->url(fn(Model $record): string => ExamResultResource::getUrl('view', $record)),
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
            'index' => Pages\ListExamResults::route('/'),
            'create' => Pages\CreateExamResult::route('/create'),
            'view' => Pages\ViewExamResult::route('{record}'),
            'edit' => Pages\EditExamResult::route('/{record}/edit'),
        ];
    }
}
