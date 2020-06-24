@component('mail::message')
# Welcome {{ $user->profile->fullname }}

The body of your message.

@component('mail::button', ['url' => $url])
Set Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
