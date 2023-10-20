<?php

if (!function_exists('isUserLogin')) {
    function isUserLogin()
    {
        return (auth()->check() && auth()->user()->email !== 'admin@jda.mygma.xyz') ? true : false;
    }
}