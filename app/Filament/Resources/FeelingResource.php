<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeelingResource\Pages;
use App\Filament\Resources\FeelingResource\RelationManagers;
use App\Helpers\Utility;
use App\Models\ExerciseUser;
use App\Models\Feeling;
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

class FeelingResource extends Resource
{
    protected static ?string $model = Feeling::class;

    protected static ?string $modelLabel = 'خلق و خو';

    protected static ?string $pluralModelLabel = 'خلق و خو';
    protected static ?string $navigationGroup = 'خلق و خو';

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

        $status_translations = [
            1 => 'خیلی خوبم 😍',
            2 => ' خوبم 😊',
            3 => 'بد نیستم 🙂',
            4 => 'بد 🤢',
            5 => 'خیلی بد 🤮'
        ];

        return $table
            ->columns([
                TextColumn::make('user.name')->label('کاربر'),

                Tables\Columns\TextColumn::make('c_feeling')->default(fn(Model $record): string => $status_translations[$record->feeling])->label('وضعیت')->sortable(),

                TextColumn::make('c_created_at')->label('تاریخ انجام')
                    ->default(fn(Feeling $record): string => Utility::convertEnglishNumbersToPersian(Jalalian::forge($record->created_at)->format('l d F Y - H:i:s'))),


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
            'index' => Pages\ListFeelings::route('/'),
            'create' => Pages\CreateFeeling::route('/create'),
            'edit' => Pages\EditFeeling::route('/{record}/edit'),
        ];
    }
}
