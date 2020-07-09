@component('mail::message')
# Thokozani bogogo nomkhulu.

Welcome {{ $user->profile->fullname }} to the {{ config('app.name') }} community.

Thank you for completing your registration on our online booking system, telephonically. We are glad to have been able to assist you in the registration process.
You are one step closer to experiencing the world of African Indigenous Science.

We look forward to joining you on your journey to full spiritual liberation.

@component('mail::panel')
    <a href="{{$url}}" class="button button-blue" style="margin-right: 10px">Set Password</a>
@endcomponent

Makwande,<br>
{{ config('app.name') }}
@endcomponent
