@component('mail::message')
<h1>We have received your request to reset your account password</h1>
<p>You can use the following code to recover your account:</p>

@component('mail::panel')
{{ $code }}
<br>
<a href="{{ URL::to('/') }}/reset/password/code/{{ Crypt::encrypt($email) }}/{{ Crypt::encrypt($code) }}" style="font-size:15px;text-decoration: none;font-family: sans-serif;font-style: italic;">click me to reset password </a>
@endcomponent

<p>The allowed duration of the code is one hour from the time the message was sent</p>
@endcomponent