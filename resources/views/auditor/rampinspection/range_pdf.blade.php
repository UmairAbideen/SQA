<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Aircraft Inspections Report</title>
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
        <div class="title">Aircraft Inspections Report</div>
        M/s Serene Engineering Services (Pvt.) Ltd., JIAP Karachi

    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Reference No</th>
                <th>Type</th>
                <th>Aircraft Reg</th>
                <th>Aircraft Type</th>
                <th>Flight No</th>
                <th>Arrival</th>
                <th>Destination</th>
                <th>Bay</th>
                <th>Inspector</th>
                <th>Status</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rampInspections as $inspection)
                <tr>
                    <td>{{ $inspection->id }}</td>
                    <td>{{ $inspection->inspection_ref_no }}</td>
                    <td>{{ $inspection->inspection_type }}</td>
                    <td>{{ $inspection->aircraft_reg }}</td>
                    <td>{{ $inspection->aircraft_type }}</td>
                    <td>{{ $inspection->flight_no }}</td>
                    <td>{{ $inspection->arrival_station }}</td>
                    <td>{{ $inspection->destination }}</td>
                    <td>{{ $inspection->bay_no }}</td>
                    <td>{{ $inspection->inspector }}</td>
                    <td>{{ $inspection->status }}</td>
                    <td>{{ \Carbon\Carbon::parse($inspection->date)->format('d-M-Y') }}</td>
                    <td>{{ $inspection->inspection_time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <div class="footer-left">Print Date: {{ now()->format('d/m/Y') }}</div>
        <div class="footer-center">M/s Serene Engineering Services (Pvt.) Ltd., JIAP Karachi</div>
        <div class="footer-right">Page <span class="pagenum"></span></div>
    </div>
</body>

</html>
