<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReports extends ListRecords
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            ReportResource\Widgets\ReportIntro::class,
        ];
    }


    protected function getActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
