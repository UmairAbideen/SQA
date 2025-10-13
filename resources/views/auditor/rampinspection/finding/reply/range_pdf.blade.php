<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Aircraft Inspection - Replies Report</title>

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
        <div class="title">Aircraft Inspection - Replies Report</div>
        M/s Serene Engineering Services (Pvt.) Ltd., JIAP Karachi
    </div>

    <div style="margin-bottom: 20px;">
        <strong>Inspection Ref:</strong> {{ $rampInspection->inspection_ref_no ?? 'N/A' }}<br>
        <strong>Aircraft Reg:</strong> {{ $rampInspection->aircraft_reg ?? 'N/A' }}<br>
        <strong>Date:</strong> {{ \Carbon\Carbon::parse($rampInspection->inspection_date)->format('d-M-Y') }}<br>
    </div>

    <div style="margin-bottom: 20px;">
        <strong>Finding:</strong> {{ $finding->finding }}<br>
        <strong>Category:</strong> {{ $finding->category }}<br>
        <strong>Target Date:</strong> {{ \Carbon\Carbon::parse($finding->target_date)->format('d-M-Y') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Reply</th>
                <th>Reply Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($replies as $index => $reply)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $reply->reply }}</td>
                    <td>{{ \Carbon\Carbon::parse($reply->date)->format('d-M-Y') }}</td>
                    <td>{{ $reply->status ?? 'N/A' }}</td>
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
