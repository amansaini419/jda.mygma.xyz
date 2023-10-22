<?php

namespace App\Services;

use App\Models\Voter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    private VoterService $voterService;

    public function __construct(VoterService $voterService)
    {
        $this->voterService = $voterService;
    }

    public function checkLogin(string $mdcNumber)
    {
        return Voter::where([
            'mdc_number' => $mdcNumber,
        ])->first();
    }

    public function check2fa(string $mdcNumber, $confirmCode)
    {
        $voter = Voter::where([
            'mdc_number' => $mdcNumber,
            ['confirm_code_date', '>=', Carbon::now()->subMinutes(env('LOGIN_TIME'))],
        ])->first();
        return ($voter && Hash::check($confirmCode, $voter->confirm_code)) ? $voter : false;
    }
}
