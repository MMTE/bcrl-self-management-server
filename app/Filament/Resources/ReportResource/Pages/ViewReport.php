<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewReport extends ViewRecord
{
    protected static string $resource = ReportResource::class;
    protected static string $view = 'filament.resources.report-resource.view-report';

}
