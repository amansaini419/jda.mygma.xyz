@extends('emails.layouts.master')

@section('body')
<p>Hi {{ $senderName }},</p>
<p>Here's your two-factor authentication (2FA) code to verify your identity. This verification is required after login to the election system to cast a vote.</p>
<p style="text-align: center; color: maroon; font-size: 22px; font-weight: bold;">Do not share it with anyone.</p>
<div style="text-align: center;">
<p style="padding: 5px; background-color: cyan; border: 2px dashed black; font-size: 30px; text-align: center; width: 150px; border-radius: 10px; font-weight: 600;">{{ $confirmCode }}</p>
</div>
@endsection