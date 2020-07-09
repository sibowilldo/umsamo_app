@component('mail::message')
# Thokozani bogogo nomkhulu,

This message serves as confirmation for your appointment with us, which has been scheduled for <strong>{{ $appointment_date }}
</strong>.

The gates will open at 07h00 and close at 11h00 – no one will be allowed in after this time.
Please ensure you <strong>bring along a legal form of identification</strong>.
Any and all requirements for rituals and ceremonies will be available at our premises. Fresh Food and drink will be on sale.

Please inform should you require any documentation for your employer in regards to your visit to us.

## Appointment Reference
@component('mail::panel')
{{ $appointment_reference }}
@endcomponent

Makwande,<br>
{{ config('app.name') }}
@endcomponent
