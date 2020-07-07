@component('mail::message')
# Greetings {{ $fullname }}

You have an appointment coming up in 2 days

@component('mail::button', ['url' => $url])
View Appointment
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
