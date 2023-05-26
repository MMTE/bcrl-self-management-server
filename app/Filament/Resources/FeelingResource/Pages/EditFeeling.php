<?php

namespace App\Filament\Resources\FeelingResource\Pages;

use App\Filament\Resources\FeelingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeeling extends EditRecord
{
    protected static string $resource = FeelingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
