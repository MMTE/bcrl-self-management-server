<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResource\Pages;
use App\Filament\Resources\ExamResource\RelationManagers;
use App\Models\Exam;
use App\Models\Question;
use App\Models\User;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $modelLabel = 'آزمون';
    protected static ?string $pluralModelLabel = 'آزمون‌ها';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'آزمون';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->label('عنوان آزمون'),

                Select::make('questions')
                    ->label('سؤالات')
                    ->multiple()
                    ->options(Question::all()->pluck('title', 'id'))
                    ->preload(),

                Select::make('status')
                    ->label('وضغیت انتشار آزمون')
                    ->options([
                        'active_for_all_users' => 'انتشار برای همه کاربران',
                        'disabled' => 'غیر فعال برای همه کاربران',
                        'active_for_specific_users' => 'فعال سازی برای بعضی کاربران',
                    ])
                    ->reactive()
                    ->preload(),

                Select::make('activated_users')
                    ->label('کاربرانی که آزمون برای آن‌ها فعال شده است')
                    ->label('سؤالات')
                    ->multiple()
                    ->hidden(fn(Closure $get) => $get('status') !== 'active_for_specific_users')
                    ->options(User::all()->pluck('name', 'id')),

            ]);
    }

    public static function table(Table $table): Table
    {
        $status_translations = [
            'active_for_all_users' => 'انتشار برای همه کاربران',
            'disabled' => 'غیر فعال برای همه کاربران',
            'active_for_specific_users' => 'فعال سازی برای بعضی کاربران',
        ];

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('عنوان آزمون')->sortable(),
                Tables\Columns\TextColumn::make('c_status')->default(fn(Model $record): string => $status_translations[$record->status])->label('وضعیت انتشار')->sortable(),
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
            'index' => Pages\ListExams::route('/'),
            'create' => Pages\CreateExam::route('/create'),
            'edit' => Pages\EditExam::route('/{record}/edit'),
        ];
    }
}
