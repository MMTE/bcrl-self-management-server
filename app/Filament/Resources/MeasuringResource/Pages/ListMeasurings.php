<?php

namespace App\Filament\Resources\MeasuringResource\Pages;

use App\Filament\Resources\MeasuringResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMeasurings extends ListRecords
{
    protected static string $resource = MeasuringResource::class;

    protected function getActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
