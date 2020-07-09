@component('mail::message')
# Thokozani bogogo nomkhulu,

You have been invited by family account admin (person’s name and surname) to join online family group. This will enable you to book as a family for either consultation or treatment. Please accept or reject the invitation.

Should you wish to report any concerns regarding this invitation, please contact us immediately.


Umsamo Institute

@component('mail::button', ['url' => ''])
Join Family
@endcomponent

Makwande,<br>
{{ config('app.name') }}
@endcomponent
