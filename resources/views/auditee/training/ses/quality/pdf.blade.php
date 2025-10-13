<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AUDIT AUTHORIZATION - Certification</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            color: rgb(50, 50, 50);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 3px;
            vertical-align: top;
        }

        .no-border td {
            border: none;
        }

        .cert-title {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 16px;
            margin: 0;
        }

        .section-heading {
            color: turquoise;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 5px;
            font-size: 12px;
        }

        .header-table td {
            border: 2px solid turquoise;
        }

        .header-logo {
            height: 80px;
        }

        .personal-details-table td {
            font-size: 12px;
        }

        .training-table th,
        .training-table td,
        .scope-table th,
        .scope-table td {
            font-size: 11px;
            text-align: center;
        }
    </style>
    </style>
</head>

<body>

    <!-- Header Box with Logo and Details -->
    <table class="header-table" style="margin-bottom: 15px;">
        <tr>
            <td style="width: 12%; text-align: left; height: 70px;">
                <img src="{{ public_path('assets/img/logos/ses.jpeg') }}" alt="Serene Logo" class="header-logo">
            </td>
            <td style="width: 62%; text-align: center; vertical-align: middle;">
                <p class="cert-title">AUDIT AUTHORIZATION</p>
            </td>

            <td style="width:22%; text-align: right;">
                <div><b>Form No: SES-QA-017</b></div>
                <br>
                <div><b>Issue: 02</b></div>
                <div><b>Revision: 02</b></div>
                <div><b>Date: 01-Oct-2024</b></div>
            </td>
        </tr>
    </table>


    <!-- Personal Details & Training -->
    <table class="no-border" style="margin-bottom: 15px;">
        <tr>
            <!-- Personal Details Left (65%) -->
            <td style="width: 65%; padding-right: 10px;">
                <div class="section-heading">PERSONAL DETAILS</div>
                <table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc;">
                    <tr>
                        <td style="border: 1px solid #ccc;"><strong>Name:</strong></td>
                        <td style="border: 1px solid #ccc;">{{ $record->staff->user->username ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;"><strong>Staff No.:</strong></td>
                        <td style="border: 1px solid #ccc;">{{ $record->staff->user->ses_no ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;"><strong>Designation:</strong></td>
                        <td style="border: 1px solid #ccc;">{{ $record->staff->user->designation ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;"><strong>Authorization No.:</strong></td>
                        <td style="border: 1px solid #ccc;">{{ $record->staff->auth_no }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;"><strong>Authorization Revision No.:</strong></td>
                        <td style="border: 1px solid #ccc;">{{ $record->rev_no ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;"><strong>Authorization Valid until:</strong></td>
                        <td style="border: 1px solid #ccc;">
                            {{ \Carbon\Carbon::parse($record->aml_expiry)->format('d F Y') }}
                        </td>
                    </tr>
                </table>
            </td>

            <!-- Photo + Training Right (35%) -->
            <td style="width: 35%; text-align: center; padding-top:70px;">
                @if (!empty($record->staff->user_image) && file_exists(storage_path('app/public/' . $record->staff->user_image)))
                    <img src="{{ storage_path('app/public/' . $record->staff->user_image) }}" alt="User Image"
                        style="height: 85px; border: 1px solid #999; margin-bottom: 0px;">
                @else
                    <div
                        style="width: 110px; height: 130px; border: 1px solid #999; display:flex; align-items:center; justify-content:center; font-size:10px;">
                        No Image
                    </div>
                @endif
            </td>
        </tr>
    </table>

    <!-- Terms & Conditions Section -->
    <table style="width: 100%; border: 1px solid #ccc; border-collapse: collapse; font-size: 11px;">
        <tbody>
            <tr>
                <td style="border: 1px solid #ccc; padding: 2px;">
                    <div style="margin-top: 30px;">
                        <div style="display: inline-block; width: 32%; text-align: left;">
                            <strong>Date</strong>
                        </div>
                        <div style="display: inline-block; width: 32%; text-align: center;">
                            <strong>Signature of Authorization Holder</strong>
                        </div>
                        <div style="display: inline-block; width: 32%; text-align: right;">
                            <strong>Stamp</strong>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Scope, Limitation & Training Section -->
    <table style="width: 100%; border: 1px solid #ccc; border-collapse: collapse; font-size: 11px; padding-top: 20px;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th style="border: 1px solid #ccc; padding: 6px;" colspan="2">Scope of Audit Authorization</th>
                <th style="border: 1px solid #ccc; padding: 6px;" rowspan="2">Limitation</th>
                <th style="border: 1px solid #ccc; padding: 6px;" colspan="2">Continuation Training Record</th>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ccc; padding: 6px;">Audit Item</th>
                <th style="border: 1px solid #ccc; padding: 6px;">Tick the relevant</th>
                <th style="border: 1px solid #ccc; padding: 6px;">Training</th>
                <th style="border: 1px solid #ccc; padding: 6px;">Validity Date</th>
            </tr>
        </thead>
        <tbody>
            @php
                $trainingMap = [
                    'hf' => 'HF',
                    'op' => 'OP',
                    'cdccl' => 'CDCCL',
                    'ewis' => 'EWIS',
                    'tt' => 'TT',
                    'sms' => 'SMS',
                ];

                $auditItems = ['Product audit', 'Annual scheduled audit', 'Random / spot check'];
                $trainings = $training ?? null;
            @endphp

            @for ($i = 0; $i < max(count($auditItems), count($trainingMap)); $i++)
                <tr>
                    {{-- Scope of Audit Authorization --}}
                    <td style="border: 1px solid #ccc; padding: 6px;">
                        {{ $auditItems[$i] ?? '' }}
                    </td>
                    <td style="border: 1px solid #ccc; padding: 6px;"></td>

                    {{-- Limitation (only once with rowspan) --}}
                    @if ($i === 0)
                        <td style="border: 1px solid #ccc; padding: 6px;"
                            rowspan="{{ max(count($auditItems), count($trainingMap)) }}">
                            <!-- Add Limitation Content Here -->
                        </td>
                    @endif

                    {{-- Training Record --}}
                    @php
                        $key = array_keys($trainingMap)[$i] ?? null;
                        $label = $key ? $trainingMap[$key] : null;
                        $value = $key && $trainings ? $trainings->$key ?? null : null;

                        $isValidDate = false;
                        if ($value) {
                            try {
                                $parsed = \Carbon\Carbon::parse($value);
                                $isValidDate = true;
                            } catch (\Exception $e) {
                                $isValidDate = false;
                            }
                        }
                    @endphp

                    <td style="border: 1px solid #ccc; padding: 6px;">
                        {{ $label ?? '' }}
                    </td>
                    <td style="border: 1px solid #ccc; padding: 6px;">
                        {{ $value ? ($isValidDate ? $parsed->format('d F Y') : $value) : '' }}
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>

    <!-- CHIEF ENGINEER (S&TQA) APPROVAL Section -->
    <div style="page-break-inside: avoid;padding-top: 15px;">
        <table style="width: 100%; border: 1px solid #ccc; border-collapse: collapse; font-size: 11px;">
            <tbody>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 8px;">
                        <!-- Signature/Stamp Row -->
                        <div style="margin-top: 30px;">
                            <div style="display: inline-block; width: 30%; text-align: left;">
                                <strong>Date of Issue</strong>
                            </div>
                            <div style="display: inline-block; width: 34%; text-align: center;">
                                <strong>Signature of Chief Engineer - S&TQA</strong>
                            </div>
                            <div style="display: inline-block; width: 30%; text-align: right;">
                                <strong>Official Stamp</strong>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
