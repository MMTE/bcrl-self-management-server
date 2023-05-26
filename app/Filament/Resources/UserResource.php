<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $modelLabel = 'کاربر';
    protected static ?string $pluralModelLabel = 'کاربران';
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')->label('نام'),
                Forms\Components\TextInput::make('last_name')->label('نام خانوادگی'),
                Forms\Components\TextInput::make('phone')->label('موبایل'),
                Select::make('role')
                    ->label('نقش کاربری')
                    ->options([
                        'admin' => 'مدیر سایت',
                        'user' => 'کاربر',
                    ])
                    ->default('disabled')
                    ->preload(),
                Forms\Components\TextInput::make('email')->email()->label('ایمیل'),
                Select::make('status')
                    ->label('وضعیت کاربر')
                    ->options([
                        'disabled' => 'غیر فعال',
                        'active' => 'فعال',
                        'suspended' => 'معلق',
                    ])
                    ->default('disabled')
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')->label('نام')->sortable(),
                Tables\Columns\TextColumn::make('last_name')->label('نام خانوادگی')->sortable(),
                Tables\Columns\TextColumn::make('phone')->label('موبایل')->sortable(),
                Tables\Columns\TextColumn::make('role')->label('نفش کاربری')->sortable(),
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
            'index' => Pages\ListUsers::route('/'),
            'view' => Pages\ViewUser::route('/{record}'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
