<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Aircraft Inspection - Finding Report</title>

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
        <div class="title">Aircraft Inspection - Finding Report</div>
        M/s Serene Engineering Services (Pvt.) Ltd., JIAP Karachi
    </div>


    <!-- Ramp Inspection Meta Info -->
    <div class="meta-info">
        <strong>Inspection Ref:</strong> {{ $rampInspection->inspection_ref_no }}<br>
        <strong>Aircraft Reg:</strong> {{ $rampInspection->aircraft_reg }}<br>
        <strong>Aircraft Type:</strong> {{ $rampInspection->aircraft_type }}<br>
        <strong>Flight No:</strong> {{ $rampInspection->flight_no }}<br>
        <strong>Inspector:</strong> {{ $rampInspection->inspector }}<br>
        <strong>Inspection Date:</strong> {{ \Carbon\Carbon::parse($rampInspection->date)->format('d-M-Y') }}
    </div>

    <!-- Finding Details -->
    <table style="padding-top: 30px;">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Code</th>
                <th>Category</th>
                <th>Finding</th>
                <th>Status</th>
                <th>Closed By</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $finding->code }}</td>
                <td>{{ $finding->category }}</td>
                <td>{{ $finding->finding }}</td>
                <td>{{ $finding->status }}</td>
                <td>{{ $finding->closed_by }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-left">Print Date: {{ now()->format('d/m/Y') }}</div>
        <div class="footer-center">M/s Serene Engineering Services (Pvt.) Ltd., JIAP Karachi</div>
        <div class="footer-right">Page <span class="pagenum"></span></div>
    </div>
</body>


</html>
