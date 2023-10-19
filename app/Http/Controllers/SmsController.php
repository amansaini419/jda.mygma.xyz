<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsController extends Controller
{
    public static function send($countryCode, $mobileNumber, $content)
    {
        $query = array(
			"clientid" => env('HUBTEL_CLIENT_ID'),
			"clientsecret" => env('HUBTEL_CLIENT_SECRET'),
			"from" => env('HUBTEL_SENDER_NICKNAME'),
			"to" => $countryCode . (int)$mobileNumber,
			"content" => $content
		);

		$curl = curl_init();

		curl_setopt_array($curl, [
			CURLOPT_URL => "https://smsc.hubtel.com/v1/messages/send?" . http_build_query($query),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "GET",
		]);

		/* $response = curl_exec($curl);
		$error = curl_error($curl); */
        curl_exec($curl);
		curl_close($curl);
    }
}
