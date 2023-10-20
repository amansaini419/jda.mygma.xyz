<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected function login()
    {
        return view('pages.login');
    }

    protected function logout(){
        Session::flush();
        Auth::logout();
        return to_route('login');
    }
}
