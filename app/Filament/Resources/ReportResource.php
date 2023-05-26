<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Filament\Resources\ReportResource\RelationManagers;
use App\Filament\Resources\ReportResource\Widgets\ReportIntro;
use App\Helpers\Utility;
use App\Models\Measuring;
use App\Models\Report;
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

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $modelLabel = 'عملکرد هفتگی';
    protected static ?string $pluralModelLabel = 'عملکرد هفتگی';
    protected static ?string $navigationGroup = 'تمارین';


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
                TextColumn::make('c_created_at')->label('تاریخ ثبت')
                    ->default(fn(Report $record): string => Utility::convertEnglishNumbersToPersian(Jalalian::forge($record->created_at)->format('l d F Y - H:i:s'))),
                TextColumn::make('c_updated_at')->label('تاریخ به روزرسانی')->default(fn(Report $record): string => Utility::convertEnglishNumbersToPersian(Jalalian::forge($record->updated_at)->format('l d F Y - H:i:s'))),
            ])
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()->url(fn(Model $record): string => ReportResource::getUrl('view', $record)),
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
            'index' => Pages\ListReports::route('/'),
            'view' => Pages\ViewReport::route('/{record}'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ReportIntro::class,
        ];
    }

}
