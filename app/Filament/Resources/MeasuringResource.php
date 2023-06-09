<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeasuringResource\Pages;
use App\Filament\Resources\MeasuringResource\RelationManagers;
use App\Helpers\Utility;
use App\Models\Measuring;
use Filament\Forms;
use Filament\Forms\Components\KeyValue;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\View\View;
use Morilog\Jalali\Jalalian;

class MeasuringResource extends Resource
{
    protected static ?string $model = Measuring::class;
    protected static ?string $modelLabel = 'اندازه مچ';
    protected static ?string $pluralModelLabel = 'اندازه‌های مچ';
    protected static ?string $navigationIcon = 'heroicon-o-hand';
    protected static ?string $navigationGroup = 'شدت ادم لنفاوی';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                KeyValue::make('measurements')
                    ->label('مقادیر')
                    ->disableAddingRows()
                    ->disableDeletingRows()
                    ->disableEditingKeys()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('کاربر'),
                TextColumn::make('c_created_at')->label('تاریخ ثبت')
                    ->default(fn(Measuring $record): string => Utility::convertEnglishNumbersToPersian(Jalalian::forge($record->created_at)->format('l d F Y - H:i:s'))),
                TextColumn::make('c_updated_at')->label('تاریخ به روزرسانی')->default(fn(Measuring $record): string => Utility::convertEnglishNumbersToPersian(Jalalian::forge($record->updated_at)->format('l d F Y - H:i:s'))),
            ])
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()->url(fn(Model $record): string => MeasuringResource::getUrl('view', $record)),
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
            'index' => Pages\ListMeasurings::route('/'),
            'create' => Pages\CreateMeasuring::route('/create'),
            'view' => Pages\ViewMeasuring::route('/{record}'),
            'edit' => Pages\EditMeasuring::route('/{record}/edit'),
        ];
    }
}
