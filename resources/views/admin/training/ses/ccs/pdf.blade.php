<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Component Maintenance Authorization</title>
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
                <p class="cert-title">Component Maintenance Authorization</p>
            </td>

            <td style="width:22%; text-align: right;">
                <div><b>Form No: SES-QA-059</b></div>
                <br>
                <div><b>Issue: 03</b></div>
                <div><b>Revision: 00</b></div>
                <div><b>Date: 30-Sep-2022</b></div>
            </td>
        </tr>
    </table>


    <!-- Personal Details & Training -->
    <table class="no-border" style="width: 100%; margin-bottom: 15px;">
        <tr>
            <!-- Text on the left -->
            <td style="width: 65%; vertical-align: top; padding-right: 10px;">
                <div class="section-heading">CERTIFICATION STATEMENT</div>
                <p style="text-align: justify; font-size: 13px; line-height: 1.6;">
                    This is to certify that <strong>Mr./Ms. {{ $record->staff->user->username ?? 'N/A' }}</strong>,
                    bearing SES No: <strong>{{ $record->staff->user->ses_no ?? 'N/A' }}</strong> and
                    Authorization Number: <strong>{{ $record->staff->auth_no ?? 'N/A' }}</strong>,
                    initially issued on:
                    <strong>{{ \Carbon\Carbon::parse($record->staff->ini_issue_date)->format('d F Y') ?? 'N/A' }}</strong>,
                    Authorization Revision Number: <strong>{{ $record->rev_no ?? 'N/A' }}</strong>,
                    Revision Date:
                    <strong>{{ \Carbon\Carbon::parse($record->updated_at)->format('d F Y') ?? 'N/A' }}</strong>,
                    after fulfilling all the regulatory requirements and internal company procedural requirements as
                    laid down in SES Approved MOE and SES-QA-SPM, is hereby considered eligible for the issuance of this
                    <strong>Component Maintenance Authorization (CMA)</strong> to carry out and certify the tasks, as
                    specified in
                    <strong>“Scope of Authorization”</strong> and <strong>“Limitations on Authorization”</strong> in
                    para A (overleaf),
                    subject to the following conditions.
                </p>
            </td>

            <!-- Photo on the right -->
            <td style="width: 35%; text-align: center; padding-top: 65px">
                <img src="{{ public_path('assets/img/team-4.jpg') }}" alt="Passport Photo"
                    style="height: 100px; border: 1px solid #999; margin-bottom: 5px;">
            </td>
        </tr>
    </table>


    <!-- Authorization Validity Note -->
    <table>
        <tr>
            <td style="border: 1px solid #ccc;"><strong>Authorization Valid Until:</strong></td>
            <td style="border: 1px solid #ccc;">
                {{ \Carbon\Carbon::parse($record->aml_expiry)->format('d M Y') }}
                (DUE TO “{{ $record->due_to ?? 'N/A' }}” Training)
            </td>
        </tr>
    </table>



    <!-- Continuation Training Table -->
    <div class="section-heading">CONTINUATION TRAINING RECORD</div>
    <table style="width: 100%; border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th style="border: 1px solid #ccc; padding: 4px;">Training</th>
                <th style="border: 1px solid #ccc; padding: 4px;">Validity Date</th>
                <th style="border: 1px solid #ccc; padding: 4px;">Certification</th>
                <th style="border: 1px solid #ccc; padding: 4px;">Type</th>
                <th style="border: 1px solid #ccc; padding: 4px;">Validity Date</th>
            </tr>
        </thead>
        <tbody>
            @php
                $trainings = $training ?? null;

                $trainingRows = [
                    'hf' => ['label' => 'HF', 'type' => 'Specialized Activity Certification'],
                    'op' => ['label' => 'OP', 'type' => ''],
                    'tt' => ['label' => 'TT', 'type' => ''],
                    'cdccl' => ['label' => 'CDCCL', 'type' => ''],
                    'ewis' => ['label' => 'EWIS', 'type' => ''],
                    'sms' => ['label' => 'SMS', 'type' => ''],
                ];
            @endphp

            @foreach ($trainingRows as $key => $data)
                @php
                    $value = $trainings->$key ?? null;
                    $isValidDate = false;
                    $formattedDate = '';

                    if ($value) {
                        try {
                            $parsed = \Carbon\Carbon::parse($value);
                            $formattedDate = $parsed->format('d M Y');
                            $isValidDate = true;
                        } catch (\Exception $e) {
                            $formattedDate = $value;
                        }
                    }
                @endphp

                @if ($value)
                    <tr>
                        <td style="border: 1px solid #ccc; padding: 4px;">{{ $data['label'] }}</td>
                        <td style="border: 1px solid #ccc; padding: 4px;">{{ $formattedDate }}</td>
                        <td style="border: 1px solid #ccc; padding: 4px;">{{ $data['type'] }}</td>
                        <td style="border: 1px solid #ccc; padding: 4px;"></td>
                        <td style="border: 1px solid #ccc; padding: 4px;">{{ $data['type'] ? $formattedDate : '' }}
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>



    <!-- Terms & Conditions Section -->
    <div class="section-heading">TERMS & CONDITIONS</div>
    <table style="width: 100%; border: 1px solid #ccc; border-collapse: collapse; font-size: 11px;">
        <tbody>
            <tr>
                <td style="border: 1px solid #ccc; padding: 2px;">
                    <p> <strong>a.</strong> This Authorization is only valid till the holder of this CMA is employed
                        with SES, staying within
                        the limits of appropriate scope of approval and shop area defined for this particular CMA. <br>
                        <strong>b.</strong> The privileges of this CMA shall become invalid unless the holder has
                        appropriate current
                        required certifications and / or trainings as prescribed in relevant regulations and mentioned
                        above. <br>
                        <strong>c.</strong> This CMA may be revoked, suspended / withdrawn or the terms of the approval
                        may be varied if the
                        conditions prescribed for the approval are not maintained. <br>
                        <strong>d.</strong> Your Signature below indicates that you have read and understood the
                        conditions, which should be
                        read in conjunction with the latest revision of SES MOE, SES-QA-SPM and PCAA regulations.
                    </p>
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

    <!-- CHIEF ENGINEER (S&TQA) APPROVAL Section -->
    <div style="page-break-inside: avoid;">
        <div class="section-heading">CHIEF ENGINEER (S&TQA) APPROVAL</div>

        <table style="width: 100%; border: 1px solid #ccc; border-collapse: collapse; font-size: 11px;">
            <tbody>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 8px;">
                        <p>
                            This is to certify that the above person has meet the requirement of Quality Systems
                            procedure in all aspects.
                            This Certification Authorization is granted in accordance with the provision of SES
                            Maintenance Organization Exposition (MOE) 3.4.
                        </p>

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

    <!-- Scope of Authorization Section -->
    <div style="page-break-inside: avoid;">
        <div class="section-heading">SCOPE OF AUTHORIZATION</div>

        <table style="width: 100%; border: 1px solid #ccc; border-collapse: collapse; font-size: 11px;">
            <thead style="background-color: #f2f2f2;">
                <tr>
                    <th style="border: 1px solid #ccc; padding: 6px;">S. No.</th>
                    <th style="border: 1px solid #ccc; padding: 6px;">Rating(s)</th>
                    <th style="border: 1px solid #ccc; padding: 6px;">Scope of Authorization (CCL Codes)</th>
                    <th style="border: 1px solid #ccc; padding: 6px;">Limited to</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $scopeEntries = json_decode($record->scope, true);
                @endphp

                @if (is_array($scopeEntries) && count($scopeEntries))
                    @foreach ($scopeEntries as $index => $entry)
                        <tr>
                            <td style="border: 1px solid #ccc; padding: 6px;">{{ $index + 1 }}</td>
                            <td style="border: 1px solid #ccc; padding: 6px;">
                                <strong>{{ $entry['rating'] ?? 'N/A' }}</strong>
                            </td>
                            <td style="border: 1px solid #ccc; padding: 6px;">{{ $entry['scope'] ?? 'N/A' }}</td>
                            <td style="border: 1px solid #ccc; padding: 6px;">{{ $entry['limited_to'] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" style="border: 1px solid #ccc; padding: 6px; text-align: center;">No scope
                            data available.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>
