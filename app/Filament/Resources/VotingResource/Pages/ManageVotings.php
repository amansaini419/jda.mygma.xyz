<?php

namespace App\Filament\Resources\VotingResource\Pages;

use App\Filament\Resources\VotingResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVotings extends ManageRecords
{
    protected static string $resource = VotingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
