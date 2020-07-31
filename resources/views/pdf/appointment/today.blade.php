<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $page_title ?? 'Patient List' }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <!--begin::Fonts-->
    <style type="text/css">
        body{
            font-family: Poppins, Helvetica, "sans-serif";
            font-size: 18px;
        }
        table.header{
            width: 100%;
        }
        table.table {
            border-collapse: collapse;
            border-spacing: 0;
        }
        table.table th{
            color: #221f72;
        }
        table.table, th, td {
            border: none;
        }

        table.table {
            width: 100%;
            display: table;
        }

        table.table.bordered > thead > tr,
        table.table.bordered > tbody > tr {
            border-bottom: 1px solid #d0d0d0;
        }

        table.table.striped > tbody > tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        table.table > tbody > tr td:last-child {
            border-left: 2px solid #0a6aa1 !important;
        }
        thead {
            border-bottom: 1px solid #221f72;
        }

        td, th {
            padding: 15px 5px;
            display: table-cell;
            text-align: left;
            vertical-align: middle;
            border-radius: 2px;
        }

        td span {
            font-size: 16px;
            color: #0e6662;
        }


    </style>
</head>
<!--end::Head-->
<!--begin::Body-->
<body>
    <table class="header">
        <tbody>
        <tr>
            <td><h1 class="heading">{{ $page_title }}</h1></td>
            <td style="text-align: right">
                <h2><small style="color: #80808F">{{ $date }}</small></h2>

                <div>
                    <ul style="list-style:none;">
                        <li>
                            <strong>Single: </strong> {{ count($appointments->where('appointmentable_type', 'App\User')) }} Appointments
                        </li>
                        <li>
                            <strong>Family: </strong> {{ count($appointments->where('appointmentable_type', 'App\Family')) }} Appointments
                        </li>
                        <li>
                            <strong>Total: </strong> {{ $total }} Appointments
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div>


    </div>
    <table class="table striped">
        <thead>
        <tr>
            <th>Appt. Details</th>
            <th>Status & Type</th>
            <th>Patient Details</th>
            <th>Contact Details</th>
            <th style="width: 190px">Signature</th>
        </tr>
        </thead>
        <tbody>
        @forelse($appointments as $appointment)
            @if(class_basename($appointment->appointmentable_type) == 'User')
                <tr>
                    <td>
                        <div>{{ $appointment->reference }}</div>
                        <span>{{ class_basename($appointment->appointmentable)}} Appointment</span>
                    </td>
                    <td>
                        <div>{{ \App\Appointment::APPOINTMENT_TYPES($appointment->type ) }}</div>
                        <span class="label label-inline label-lg font-weight-bolder label-light-success">{{ $appointment->status->title }}</span>
                    </td>
                    <td>
                        <div>{{ $appointment->appointmentable->profile->fullname }}</div>
                        <span>{{ $appointment->appointmentable->profile->id_number }}</span>
                    </td>
                    <td>
                        <div>{{ $appointment->appointmentable->profile->cell_number }}</div>
                        <span>{{ $appointment->appointmentable->email }}</span>
                    </td>
                    <td>

                    </td>
                </tr>
            @elseif(class_basename($appointment->appointmentable_type) == 'Family')
                @foreach( $appointment->familyAppointments as $family_appointment )
                    <tr>
                        <td>
                            <div>{{ $appointment->reference }}</div>
                            <span>{{ $appointment->appointmentable->name}}</span>
                        </td>
                        <td>
                            <div>{{ $appointment->type }}</div>
                            <span>{{ $family_appointment->status->title }}</span>
                        </td>
                        <td>
                            <div>{{ $family_appointment->user->profile->fullname }}</div>
                            <span>{{ $family_appointment->user->profile->id_number }}</span>
                        </td>
                        <td>
                            <div>{{ $family_appointment->user->profile->cell_number }}</div>
                            <span>{{ $family_appointment->user->email }}</span>
                        </td>
                        <td>

                        </td>
                    </tr>
                @endforeach
            @endif
        @empty
            <tr>
                <td colspan="5" style="padding:50px;text-align: center"> List is Empty</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>
