<?php

namespace App\Filament\Resources\ExamResultResource\Pages;

use App\Filament\Resources\ExamResultResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewExamResult extends ViewRecord
{
    protected static string $resource = ExamResultResource::class;
    protected static string $view = 'filament.resources.exam-result-resource.view-exam-result';

}
