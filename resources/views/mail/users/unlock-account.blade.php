@component('mail::message')
# Thokozani bogogo nomkhulu,

Your request to lock your account was a success.
Please keep this email safe and use the button to unlock your account at your convenience.

@component('mail::button', ['url' => $url])
Unlock My Account
@endcomponent

Makwande,<br>
{{ config('app.name') }}
@endcomponent


