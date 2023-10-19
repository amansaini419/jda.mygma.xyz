<?php

namespace App\Filament\Resources\VoterResource\Pages;

use App\Filament\Resources\VoterResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVoter extends ViewRecord
{
    protected static string $resource = VoterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
