<?php

namespace App\Livewire;

use App\Services\LoginService;
use App\Services\VoterService;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Login extends Component
{
    public string $mdcNumber = '';
    public string $confirmCode = '';

    #[Locked]
    public bool $loginSuccess = false;

    private LoginService $loginService;
    private VoterService $voterService;

    public function render()
    {
        return view('livewire.login');
    }

    public function boot()
    {
        $this->loginService = app()->make(LoginService::class);
        $this->voterService = app()->make(VoterService::class);
    }

    public function voterLogin()
    {
        if($this->loginSuccess){
            $this->validate([
                'mdcNumber' => 'required|exists:voters,mdc_number',
                'confirmCode' => 'required|digits:6',
            ]);

            $voter = $this->loginService->check2fa($this->mdcNumber, $this->confirmCode);

            if(!$voter)
            {
                $this->addError('confirmCode', 'Invalid or Expired 2FA Code');
                return;
            }

            $this->voterService->login($voter, $this->confirmCode);

            $this->dispatch('alert', [
                'type' => 'success',
                'title' => 'Log In',
                'message' => 'You have successfully log in.'
            ]);

            //sleep(5);

            $this->redirect('/');
        }
        else{
            $this->resendCode();
        }

    }

    public function resendCode()
    {
        $this->validate([
            'mdcNumber' => 'required|exists:voters,mdc_number',
        ]);

        $voter = $this->loginService->checkLogin($this->mdcNumber);

        if(!$voter)
        {
            $this->addError('loginCode', 'Invalid MDC Number');
            return;
        }

        $this->voterService->send2faCode($voter);
        $this->loginSuccess = true;

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => '2FA Code',
            'message' => 'Check your email address and mobile for 2FA Code.'
        ]);
    }
}
