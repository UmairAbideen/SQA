<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SQI AUTHORIZATION</title>
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
                <p class="cert-title">SQI AUTHORIZATION</p>
            </td>

            <td style="width:22%; text-align: right;">
                <div><b>Form No: SES-QA-025(b)</b></div>
                <br>
                <div><b>Issue: 02</b></div>
                <div><b>Revision: 00</b></div>
                <div><b>Date: 03-Jan-2022</b></div>
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
                        <td style="border: 1px solid #ccc;"><strong>Department/Section:</strong></td>
                        <td style="border: 1px solid #ccc;">{{ $record->staff->user->department ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;"><strong>Authorization No.:</strong></td>
                        <td style="border: 1px solid #ccc;">{{ $record->staff->auth_no ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;"><strong>Initial Authorization Issued on:</strong></td>
                        <td style="border: 1px solid #ccc;">
                            {{ \Carbon\Carbon::parse($record->staff->ini_issue_date)->format('d F Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;"><strong>Authorization Revision Number:</strong></td>
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
            <td style="width: 35%; text-align: center;">
                <img src="{{ public_path('assets/img/team-4.jpg') }}" alt="Passport Photo"
                    style="height: 75px; border: 1px solid #999; margin-bottom: 0px;">

                <div class="section-heading">CONTINUATION TRAINING RECORD</div>

                <table style="width: 100%; border: 1px solid #ccc; border-collapse: collapse;">
                    <thead style="background-color: #f2f2f2;">
                        <tr>
                            <th style="border: 1px solid #ccc; padding: 4px;">Trainings</th>
                            <th style="border: 1px solid #ccc; padding: 4px;">Validity Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $trainings = $training ?? null;
                            $trainingMap = [
                                'hf' => 'Human Factors',
                                'op' => 'OP',
                                'tt' => 'Type Technology',
                                'cdccl' => 'CDCCL',
                                'ewis' => 'EWIS',
                                'sms' => 'SMS',
                            ];
                        @endphp

                        @foreach ($trainingMap as $key => $label)
                            @php
                                $value = $trainings->$key ?? null;
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

                            @if ($value)
                                <tr>
                                    <td style="border: 1px solid #ccc; padding: 4px;">{{ $label }}</td>
                                    <td style="border: 1px solid #ccc; padding: 4px;">
                                        {{ $isValidDate ? $parsed->format('d F Y') : $value }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
    </table>



    <!-- Scope of Authorization Limitation -->
    <div class="section-heading">SCOPE OF AUTHORIZATION LIMITATION</div>

    <table class="scope-table" style="width: 100%; border: 1px solid #ccc; border-collapse: collapse; font-size: 11px;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th style="border: 1px solid #ccc; padding: 6px;">Scope</th>
                <th style="border: 1px solid #ccc; padding: 6px;">Limitation</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #ccc; padding: 6px;">
                    To carry out aircraft components / parts receiving inspection in accordance with approved process
                    and procedures in MOE Section 2.2.
                </td>
                <td style="border: 1px solid #ccc; padding: 6px;">NI</td>
            </tr>
        </tbody>
    </table>



    <!-- Terms & Conditions Section -->
    <div class="section-heading">TERMS & CONDITIONS</div>
    <table style="width: 100%; border: 1px solid #ccc; border-collapse: collapse; font-size: 11px;">
        <tbody>
            <tr>
                <td style="border: 1px solid #ccc; padding: 2px;">
                    <p> <strong>a.</strong> This authorization is valid provided continuation trainings remain valid and
                        the person remains
                        in the active service of SES. <br>
                        <strong>b.</strong> This Authorization does not authorize the holder to perform any other task
                        except as detailed
                        within the Scope of Authorization & Authorization Privileges code. <br>
                        <strong>c.</strong> Your Signature below indicates that you have read and understood these Terms
                        and Conditions,
                        which should be read in conjunction with the latest revision of MOE, associated documents and
                        PCAA regulations.
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
                            Maintenance Organization Exposition (MOE) 3.7.
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
</body>

</html>
