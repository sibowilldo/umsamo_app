@component('mail::message')
Thokozani bogogo nomkhulu,

This message serves as a reminder for your appointment with us, which has been scheduled for {{ $date_time }}.

The gates will open at 07h00 and close at 11h00 – no one will be allowed in after this time.
@component('mail::panel')
    Please ensure you bring along a legal form of identification.
@endcomponent
Any and all requirements for rituals and ceremonies will be available at our premises. Fresh Food and drink will be on sale.

Please inform should you require any documentation for your employer in regards to your visit to us.

@component('mail::button', ['url' => $url])
View Appointment
@endcomponent

Makwande,<br>
{{ config('app.name') }}
@endcomponent
