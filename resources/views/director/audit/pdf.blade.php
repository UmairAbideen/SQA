<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Audit Report</title>
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
        <div class="title">Audit Report</div>
        M/s Serene Engineering Services (Pvt.) Ltd., JIAP Karachi

    </div>

    <table style="padding-top: 30px;">
        <tr>
            <th>ID</th>
            <td>{{ $audit->id }}</td>
        </tr>
        <tr>
            <th>Organization</th>
            <td>{{ $audit->organization }}</td>
        </tr>
        <tr>
            <th>Audit Reference</th>
            <td>{{ $audit->audit_reference }}</td>
        </tr>
        <tr>
            <th>Audit Type</th>
            <td>{{ $audit->audit_type }}</td>
        </tr>
        <tr>
            <th>Section</th>
            <td>{{ $audit->section }}</td>
        </tr>
        <tr>
            <th>Location</th>
            <td>{{ $audit->location }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $audit->status }}</td>
        </tr>
        <tr>
            <th>Audit Date</th>
            <td>{{ \Carbon\Carbon::parse($audit->audit_date)->format('d-M-Y') }}</td>
        </tr>
    </table>

    <div class="footer">
        <div class="footer-left">Print Date: {{ now()->format('d/m/Y') }}</div>
        <div class="footer-center">M/s Serene Engineering Services (Pvt.) Ltd., JIAP Karachi</div>
        <div class="footer-right">Page <span class="pagenum"></span></div>
    </div>


</body>

</html>
