<?php

namespace App\Services;

use App\Http\Controllers\SmsController;
use App\Mail\Voters\ConfirmCodeEmail;
use App\Mail\Voters\LoginCodeEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class VoterService
{
    public function sendLoginCode($voter/* , User $user */)
    {
        $loginCode = rand(100000, 999999);
        $voter->where('id', $voter->id)
                ->update([
                    'login_code' => Hash::make($loginCode),
                    'login_code_date' => Carbon::now(),
                ]);

        Mail::to($voter->email)->send(new LoginCodeEmail($voter, $loginCode));

        $message = "Hello $voter->first_name,\nYour OTP to verify your identity to cast your vote is $loginCode.\nDo not share it with anyone.";
        SmsController::send($voter->country_code, $voter->mobile_number, $message);
    }

    public function send2faCode($voter)
    {
        $confirmCode = rand(100000, 999999);
        $voter->where('id', $voter->id)
                ->update([
                    'confirm_code' => Hash::make($confirmCode),
                    'confirm_code_date' => Carbon::now(),
                ]);

        User::where('id', $voter->user_id)
                ->update([
                    'password' => Hash::make($confirmCode),
                ]);

        // Mail::to($voter->email)->send(new ConfirmCodeEmail($voter, $confirmCode));

        $message = "Hello $voter->first_name,\nYour 2FA to verify your identity to cast your vote is $confirmCode.\nDo not share it with anyone.";
        SmsController::send($voter->country_code, $voter->mobile_number, $message);
        Mail::to($voter->email)->send(new LoginCodeEmail($voter, $confirmCode));

        $message = "Hello $voter->first_name,\nYour OTP to verify your identity to cast your vote is $confirmCode.\nDo not share it with anyone.";
        SmsController::send($voter->country_code, $voter->mobile_number, $message);
    }

    public function login($voter, $confirmCode)
    {
        $user = User::where('id', $voter->user_id)
                        ->first();

        $credentials = [
            'email' => $user->email,
            'password' => $confirmCode,
        ];

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
    }
}
