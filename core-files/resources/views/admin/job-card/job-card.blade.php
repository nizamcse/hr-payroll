<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Card</title>
    <style>
        *, ::after, ::before {
            box-sizing: border-box;
        }
        .heading {
            font-size: large;
            font-weight: bold;
        }
        .margin-top {
            margin-top: 5px;
        }
        .text-align-center{
            text-align: center;
        }
        .text-small tbody {
            font-size: small;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        table th{
            text-align: left;
        }

        .tbl-bordar-dash th,
        .tbl-bordar-dash td{
            border-top: 1px dashed #000000;
        }

        .tbl-outer-bordar-dash {
            border: 1px dashed #000000;
        }


    </style>
</head>

<body>
<table class="text-align-center">
    <tr>
        <td>
            <span class="heading">HONG KONG FASHIONS LIMITED</span><br>
            <span>4 No Hazi Dudu Mia Road, Pagar, Tongi, Gazipur</span><br>
            <span class="heading">Job Card</span>
        </td>
    </tr>
</table>
<table class="tbl-outer-bordar-dash text-small">
    <tr>
        <td><strong>ID.</strong></td>
        <td>:</td>
        <td>{{ $employee->id }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>Branch</strong></td>
        <td>:</td>
        <td>{{ $employee->branch->name }}</td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td>:</td>
        <td>{{ $employee->name }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>Section</strong></td>
        <td>:</td>
        <td>{{ $employee->section->name }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>Line</strong></td>
        <td>:</td>
        <td>{{ $employee->line->name }}</td>
    </tr>
    <tr>
        <td><strong>Date of Join</strong></td>
        <td>:</td>
        <td>{{ $employee->joining_date }}</td>
        <td><strong>Line</strong></td>
        <td>:</td>
        <td>{{ $employee->line->name }}</td>
        <td><strong>Designation</strong></td>
        <td>:</td>
        <td>{{ $employee->designation->name }}</td>
    </tr>
</table>

<table class="tbl-bordar-dash margin-top text-small">
    <tr>
        <th>SI#</th>
        <th>Date</th>
        <th>In-Time</th>
        <th>Out-Time</th>
        <th>Total HR</th>
        <th>OT</th>
        <th>In Status</th>
        <th>Out Status</td>
    </tr>
    @foreach($days as $day)
        <tr>
            <td scope="row">1</td>
            <td>{{ $day['main_date'] }}</td>
            <td>{{ $day['attendance']->in_time ?? null }}</td>
            <td>{{ $day['attendance']->exit_time ?? null }}</td>
            <td>{{ $day['attendance']->measurement_quantity ?? null }}</td>
            <td>{{ $day['attendance']->overtime ?? null }}</td>
            <td>{{ $day['attendance']->in_status ?? null }}</td>
            <td>{{ $day['attendance']->out_status ?? null }}</td>
        </tr>
    @endforeach
</table>
<table class="tbl-outer-bordar-dash margin-top text-small">
    <tr>
        <td><strong>Days In Month</strong></td>
        <td>:</td>
        <td>6 Days</td>
        <td><strong>Present</strong></td>
        <td>:</td>
        <td>5 Days</td>
        <td><strong>Regular Over Time</strong></td>
        <td>:</td>
        <td>08:00:00 Hour(s)</td>
    </tr>
    <tr>
        <td><strong>Late</strong></td>
        <td>:</td>
        <td>1 Days</td>
        <td><strong>Holiday</strong></td>
        <td>:</td>
        <td>0 Days</td>
        <td><strong>Holiday Over Time</strong></td>
        <td>:</td>
        <td>00:00:00 Hour(s)</td>
    </tr>
    <tr>
        <td><strong>Absent</strong></td>
        <td>:</td>
        <td>0 Days</td>
        <td><strong>Offday</strong></td>
        <td>:</td>
        <td>1 Days</td>
        <td><strong>Offday Over Time</strong></td>
        <td>:</td>
        <td>00:00:00 Hour(s)</td>
    </tr>
    <tr>
        <td><strong>Before DOJ Days</strong></td>
        <td>:</td>
        <td>0 Days</td>
        <td><strong>Leave</strong></td>
        <td>:</td>
        <td>0 Days</td>
        <td><strong>Total Over Time</strong></td>
        <td>:</td>
        <td>08:00:00 Hour(s)</td>
    </tr>
</table>
<br>
<br>
<br>
----------------<br>
Prepared by

</body>

</html>