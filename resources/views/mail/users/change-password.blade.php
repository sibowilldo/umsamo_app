@component('mail::message')
# Thokozani bogogo nomkhulu,

Your password was changed successfully.
If you didn't request this change, click the Lock Account button below immediately to lock your account indefinitely.

@component('mail::button', ['url' => $url])
Lock Account!
@endcomponent

Makwande,<br>
{{ config('app.name') }}
@endcomponent
