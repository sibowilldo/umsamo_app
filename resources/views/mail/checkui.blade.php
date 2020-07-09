@component('mail::message')
# Thokozani bogogo nomkhulu.

{{ $full_name}} you are receiving this email because we received a password reset request for your account.

If you did not request a password reset, no further action is required.

@component('mail::button', ['url' => $url])
    Reset Password
@endcomponent

@component('mail::panel')
    This password reset link will expire in {{ $expire }} minutes.
@endcomponent


Makwande,<br>
{{ config('app.name') }}
@endcomponent
