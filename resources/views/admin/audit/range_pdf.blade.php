<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Audits Report</title>
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
        <div class="title">Audits Report</div>
        M/s Serene Engineering Services (Pvt.) Ltd., JIAP Karachi

    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Organization</th>
                <th>Audit Ref</th>
                <th>Type</th>
                <th>Section</th>
                <th>Location</th>
                <th>Status</th>
                <th>Audit Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($audits as $audit)
                <tr>
                    <td>{{ $audit->id }}</td>
                    <td>{{ $audit->organization }}</td>
                    <td>{{ $audit->audit_reference }}</td>
                    <td>{{ $audit->audit_type }}</td>
                    <td>{{ $audit->section }}</td>
                    <td>{{ $audit->location }}</td>
                    <td>{{ $audit->status }}</td>
                    <td>{{ \Carbon\Carbon::parse($audit->audit_date)->format('d-M-Y') }}</td>
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
