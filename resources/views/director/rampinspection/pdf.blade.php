<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Aircraft Inspection Report</title>
    <style>
        @page {
            margin: 40px 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 6px 10px;
            border: 1px solid #000;
            text-align: left;
        }

        .footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 30px;
            font-size: 10px;
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .footer-left,
        .footer-center,
        .footer-right {
            display: table-cell;
            vertical-align: middle;
        }

        .footer-left {
            text-align: left;
        }

        .footer-center {
            text-align: center;
        }

        .footer-right {
            text-align: right;
        }

        .pagenum:before {
            content: counter(page);
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="title">Aircraft Inspection Report</div>
        M/s Serene Engineering Services (Pvt.) Ltd., JIAP Karachi

    </div>

    <table style="padding-top: 30px;">
        <tr>
            <th>ID</th>
            <td>{{ $rampInspection->id }}</td>
        </tr>
        <tr>
            <th>Inspection Reference No</th>
            <td>{{ $rampInspection->inspection_ref_no }}</td>
        </tr>
        <tr>
            <th>Inspection Type</th>
            <td>{{ $rampInspection->inspection_type }}</td>
        </tr>
        <tr>
            <th>Aircraft Registration</th>
            <td>{{ $rampInspection->aircraft_reg }}</td>
        </tr>
        <tr>
            <th>Aircraft Type</th>
            <td>{{ $rampInspection->aircraft_type }}</td>
        </tr>
        <tr>
            <th>Flight No</th>
            <td>{{ $rampInspection->flight_no }}</td>
        </tr>
        <tr>
            <th>Arrival Station</th>
            <td>{{ $rampInspection->arrival_station }}</td>
        </tr>
        <tr>
            <th>Destination</th>
            <td>{{ $rampInspection->destination }}</td>
        </tr>
        <tr>
            <th>Bay No</th>
            <td>{{ $rampInspection->bay_no }}</td>
        </tr>
        <tr>
            <th>Inspector</th>
            <td>{{ $rampInspection->inspector }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $rampInspection->status }}</td>
        </tr>
        <tr>
            <th>Inspection Date</th>
            <td>{{ \Carbon\Carbon::parse($rampInspection->date)->format('d-M-Y') }}</td>
        </tr>
        <tr>
            <th>Inspection Time</th>
            <td>{{ $rampInspection->inspection_time }}</td>
        </tr>
    </table>


    <div class="footer">
        <div class="footer-left">Print Date: {{ now()->format('d/m/Y') }}</div>
        <div class="footer-center">M/s Serene Engineering Services (Pvt.) Ltd., JIAP Karachi</div>
        <div class="footer-right">Page <span class="pagenum"></span></div>
    </div>


</body>

</html>
