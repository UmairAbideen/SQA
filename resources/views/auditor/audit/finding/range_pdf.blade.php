<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Audit - Findings Report</title>
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
        <div class="title">Audit - Findings Report</div>
        M/s Serene Engineering Services (Pvt.) Ltd., JIAP Karachi
    </div>

    <!-- Audit Meta Information -->
    <div style="margin-bottom: 20px;">
        <strong>Audit Reference:</strong> {{ $audit->audit_reference }}<br>
        <strong>Section:</strong> {{ $audit->section }}<br>
        <strong>Location:</strong> {{ $audit->location }}<br>
        <strong>Audit Date:</strong> {{ \Carbon\Carbon::parse($audit->audit_date)->format('d-M-Y') }}
    </div>

    <!-- Findings Table -->
    <table>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Level</th>
                <th>Rule Ref</th>
                <th>Finding</th>
                <th>Target Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if ($findings->isNotEmpty())
                @foreach ($findings as $index => $finding)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $finding->finding_level }}</td>
                        <td>{{ $finding->rule_reference }}</td>
                        <td>{{ $finding->finding }}</td>
                        <td>{{ \Carbon\Carbon::parse($finding->target_dates)->format('d-M-Y') }}</td>
                        <td>{{ $finding->status }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">No findings available in the selected date range.</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-left">Print Date: {{ now()->format('d/m/Y') }}</div>
        <div class="footer-center">M/s Serene Engineering Services (Pvt.) Ltd., JIAP Karachi</div>
        <div class="footer-right">Page <span class="pagenum"></span></div>
    </div>



    <div class="footer">
        <div class="footer-left">Print Date: {{ now()->format('d/m/Y') }}</div>
        <div class="footer-center">M/s Serene Engineering Services (Pvt.) Ltd., JIAP Karachi</div>
        <div class="footer-right">Page <span class="pagenum"></span></div>
    </div>
</body>

</html>
