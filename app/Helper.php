<?php

if (!function_exists('isUserLogin')) {
    function isUserLogin()
    {
        return (auth()->check() && auth()->user()->email !== 'admin@jda.mygma.xyz') ? true : false;
    }
}

if (!function_exists('setAlertDetails')) {
    function setAlertDetails($type, $message, $title = '')
    {
        return [
            'type' => $type,
            'message' => $message,
            'title' => $title,
        ];
    }
}

