<?php

namespace App\Filament\Resources\VoterResource\Pages;

use App\Filament\Resources\VoterResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVoter extends CreateRecord
{
    protected static string $resource = VoterResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = User::firstOrNew([
            'name' => $data['first_name'],
            'email' => $data['email']
        ]);
        $user->password = uniqid();
        $user->save();
        $data['user_id'] = $user->id;

        return $data;
    }
}
