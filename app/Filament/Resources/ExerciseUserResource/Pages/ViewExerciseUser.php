<?php

namespace App\Filament\Resources\ExerciseUserResource\Pages;

use App\Filament\Resources\ExerciseUserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewExerciseUser extends ViewRecord
{
    protected static string $resource = ExerciseUserResource::class;
    protected static string $view = 'filament.resources.exercise-user-resource.view-exercise-user';
}
