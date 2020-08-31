<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Print Table</title>
        <meta charset="UTF-8">
        <meta name=description content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet">
        <style>
            body {margin: 20px}
        </style>
    </head>
    <body class="bg-white">
        <div class="row">
            <div class="col-xs-6"><img src="{{ asset('system/images/umsamo-logo-color.png') }}" alt="" width="150px"></div>
            <div class="col-xs-6">{!! count($data)==1?count($data)." Appointment":count($data)." Appointments" !!}</div>
        </div>
        <table class="table table-borderless table-striped">
            <thead>
            <tr>
                <th class="text-uppercase text-muted">Reference & Status</th>
                <th class="text-uppercase text-muted">Date & Type</th>
                <th class="text-uppercase text-muted">Scheduled By</th>
                <th class="text-uppercase text-muted">Contact Details</th>
                <th class="text-uppercase text-muted">Signature</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $row)
                <tr>
                    <td><span class="font-weight-boldest d-block">{!! $row['Reference'] !!}</span>{!! $row['Status'] !!}</td>
                    <td><span class="d-block font-weight-boldest">{!! $row['Scheduled For'] !!}</span> {!! $row['Type'] !!}</td>
                    <td><span class="d-block font-weight-boldest">{!! $row['Full Name'] !!}</span> {!! $row['ID No.'] !!}</td>
                    <td><span class="d-block font-weight-boldest">{!! $row['Cell No.'] !!}</span> {!! $row['Email'] !!}</td>
                    <td>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>
