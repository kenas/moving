@component('mail::message')

<h1>Hello,</h1>

<p>This is an automatic message to confirm that we received your email. We will be in touch with you shortly.</p>
<br>
<br>
<strong>Your Subject:</strong>
<p>{{ $data['subject'] }}</p>
<br>
<strong>Your message:</strong>
<i>{{ $data['content'] }}</i>
<br>
<br>
Kind regards,<br>
{{ config('app.name') }}<br>
www.movingwell.com
@endcomponent