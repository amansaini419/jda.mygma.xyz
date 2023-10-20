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

    public function checkLogin(string $mdcNumber, $loginCode)
    {
        $voter = Voter::where([
            'mdc_number' => $mdcNumber,
            //'login_code' => $loginCode,
            ['login_code_date', '>=', Carbon::now()->subMinutes(env('LOGIN_TIME'))],
        ])->first();
        return ($voter && Hash::check($loginCode, $voter->login_code)) ? $voter : false;
    }

    public function check2fa(string $mdcNumber, $loginCode, $confirmCode)
    {
        $voter = Voter::where([
            'mdc_number' => $mdcNumber,
            /* 'login_code' => $loginCode,
            'confirm_code' => $confirmCode, */
            ['confirm_code_date', '>=', Carbon::now()->subMinutes(env('LOGIN_TIME'))],
        ])->first();
        return ($voter && Hash::check($loginCode, $voter->login_code) && Hash::check($confirmCode, $voter->confirm_code)) ? $voter : false;
    }
}
