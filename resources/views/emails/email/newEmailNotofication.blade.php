@component('mail::message')
Hello from {{ $data['email'] }}

<p>Someone send you email via your website movingwell.com</p>
<hr>
<br>
<br>
{{ $data['content'] }}

@component('mail::button', ['url' => 'mailto:'.$data['email'].''])

Reply
@endcomponent
<small>Please use the button reply if you have set up your email client.</small>

Kind regards,<br>
{{ config('app.name') }}
@endcomponent