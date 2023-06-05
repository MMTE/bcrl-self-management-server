<?php

namespace App\Filament\Resources\FeedbackResource\Pages;

use App\Filament\Resources\FeedbackResource;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions;
use Filament\Resources\Form;
use Filament\Resources\Pages\ViewRecord;

class ViewFeedback extends ViewRecord
{
    protected static string $resource = FeedbackResource::class;

    protected static string $view = 'filament.resources.feedback-resource.view-feedback';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('data')->schema([
                    TextInput::make('question')->label('سؤال'),
                    Repeater::make('options')->schema([
                        TextInput::make('value')->label(''),
                    ]),
                ]),
            ]);
    }

}
