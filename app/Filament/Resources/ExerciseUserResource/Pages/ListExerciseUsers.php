<?php

namespace App\Filament\Resources\ExerciseUserResource\Pages;

use App\Filament\Resources\ExerciseUserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExerciseUsers extends ListRecords
{
    protected static string $resource = ExerciseUserResource::class;

    protected function getActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
