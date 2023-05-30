<?php

namespace App\Filament\Resources\FeelingResource\Pages;

use App\Filament\Resources\FeelingResource;
use App\Models\Feeling;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFeeling extends ViewRecord
{
    protected static string $resource = FeelingResource::class;
    protected static string $view = 'filament.resources.feeling-resource.view-feeling';

    public $feelings;

}
