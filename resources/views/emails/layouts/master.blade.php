<x-mail::message>
<p style="margin-bottom: 30px; text-align: center;">
<img src="{{ Storage::url(env('COMPANY_LOGO')) }}" alt="{{ env('COMPANY_NAME') }}" width="80" />
</p>
<div style="padding: 40px 0;">
@yield('body')
</div>
<p>
Cheers,
<br>
<b>Election Committee</b>
<br><br>
NB:
<br>
Election Starts at <b>{{ $electionStartDate }}</b>, and
<br>
Closes at <b>{{ $electionEndDate }}</b>
</p>
</x-mail::message>
