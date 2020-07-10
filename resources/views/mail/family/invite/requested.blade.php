@component('mail::message')
# Thokozani bogogo nomkhulu,

You have been invited by family account admin {{ $sender->profile->fullname }} to join online family group "{{ $family->name }}".
This will enable you to book as a family for either consultation or treatment.

You may accept or safely ignore this invitation.

Should you wish to report any concerns regarding this invitation, please contact us immediately.

@component('mail::button', ['url' => $accept_url])
Join Family
@endcomponent

<em>If you believe this was sent in error, no further action required!</em>

Makwande,<br>
{{ config('app.name') }}
@endcomponent
