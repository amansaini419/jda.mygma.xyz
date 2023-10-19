<?php

namespace App\Services;

use App\Mail\Voters\LoginCodeEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class VoterService
{
    public function sendLoginCode($voter/* , User $user */)
    {
        $loginCode = rand(100000, 999999);
        $voter->where('id', $voter->id)
                ->update([
                    'login_code' => $loginCode,
                    'login_code_date' => Carbon::now(),
                ]);

        Mail::to($voter->email)->send(new LoginCodeEmail($voter, $loginCode));
    }
}
