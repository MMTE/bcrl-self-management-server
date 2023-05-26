<?php

namespace App\Filament\Resources\MeasuringResource\Pages;

use App\Filament\Resources\MeasuringResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMeasuring extends ViewRecord
{
    protected static string $resource = MeasuringResource::class;
    protected static string $view = 'filament.resources.measuring-resource.view-measuring';

}
