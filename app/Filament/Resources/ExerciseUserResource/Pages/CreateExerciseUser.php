<?php

namespace App\Filament\Resources\ExerciseUserResource\Pages;

use App\Filament\Resources\ExerciseUserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateExerciseUser extends CreateRecord
{
    protected static string $resource = ExerciseUserResource::class;
}
