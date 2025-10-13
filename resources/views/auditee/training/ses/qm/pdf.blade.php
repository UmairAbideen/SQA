<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>QUALIFYING MECHANIC AUTHORIZATION</title>
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
                <p class="cert-title">QUALIFYING MECHANIC AUTHORIZATION</p>
            </td>

            <td style="width:22%; text-align: right;">
                <div><b>Form No: SES-QA-025(a)</b></div>
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
            <!-- PERSONAL DETAILS -->
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
                        <td style="border: 1px solid #ccc;">{{ $record->staff->auth_no }}</td>
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
                            {{ \Carbon\Carbon::parse($record->auth_date)->format('d F Y') ?? 'N/A' }}
                        </td>
                    </tr>
                </table>
            </td>

            <!-- CONTINUATION TRAINING RECORD -->
            <td style="width: 35%; text-align: center;">
                @if (!empty($record->staff->user_image) && file_exists(storage_path('app/public/' . $record->staff->user_image)))
                    <img src="{{ storage_path('app/public/' . $record->staff->user_image) }}" alt="User Image"
                        style="height: 85px; border: 1px solid #999; margin-bottom: 0px;">
                @else
                    <div
                        style="width: 110px; height: 130px; border: 1px solid #999; display:flex; align-items:center; justify-content:center; font-size:10px;">
                        No Image
                    </div>
                @endif
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




    <!-- Scope of Authorization -->
    <div class="section-heading">SCOPE OF AUTHORIZATION</div>
    <table class="scope-table">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>AIRCRAFT TYPE</th>
                <th>Rating or Components (i.e. C4 or C14 or A1)</th>
                <th>SCOPE OF AUTHORIZATION CODES</th>
                <th>AUTHORIZATION PRIVILEGE CODES</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="height: 40px;"></td>
                <td></td>
                <td></td>
                <td></td>
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
                        the person remains in the active service of SES. <br>
                        <strong>b.</strong> This Authorization does not authorize the holder to perform any other
                        maintenance task except as
                        detailed within the Scope of Authorization & Authorization Privileges code. <br>
                        <strong>c.</strong> Your Signature below indicates that you have read and understood these Terms
                        and Conditions,
                        which should be read in conjunction with the latest revision of MOE, associated documents and
                        PCAA
                        regulations. <br>
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
                            Maintenance Organization Exposition (MOE) 3.8.
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


    <!-- Authorization Privilege Codes Section -->
    <div style="page-break-inside: avoid;">
        <div class="section-heading">AUTHORIZATION PRIVILEGES CODES</div>

        <table style="width: 100%; border: 1px solid #ccc; border-collapse: collapse; font-size: 11px;">
            <thead style="background-color: #f2f2f2;">
                <tr>
                    <th style="border: 1px solid #ccc; padding: 6px; width: 20%;">Code</th>
                    <th style="border: 1px solid #ccc; padding: 6px;">Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;"><strong>TOW</strong></td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform Towing activities</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;"><strong>PB</strong></td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform Push Back activities</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;"><strong>HS COMM</strong></td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform Communication on Headset with Cockpit
                        Crew</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;"><strong>Fueling</strong></td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform Aircraft Fueling</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;"><strong>APU</strong></td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform APU Starting and shutdown activities
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;"><strong>MRS</strong></td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform Marshalling during Towing</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;"><strong>Door</strong></td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform Door Opening & Closing activities</td>
                </tr>
            </tbody>
        </table>
    </div>



    <!-- Scope of Authorization Section -->
    <div style="page-break-inside: avoid;">
        <div class="section-heading">SCOPE OF AUTHORIZATION</div>

        <table style="width: 100%; border: 1px solid #ccc; border-collapse: collapse; font-size: 11px;">
            <tbody>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;"><strong>D1-01</strong></td>
                    <td style="border: 1px solid #ccc; padding: 6px;">
                        To sign off maintenance activities in “MECH” Block under supervision of certifying staff on
                        B737-800 (CFM56-7B)
                    </td>
                    <td style="border: 1px solid #ccc; padding: 6px;"><strong>E1-01</strong></td>
                    <td style="border: 1px solid #ccc; padding: 6px;">
                        To sign off Borescope inspection activities on CFM56-7B series engine i.a.w applicable
                        maintenance data
                    </td>
                </tr>
                <tr>
                    <td><strong>D1-02</strong></td>
                    <td>To sign off maintenance activities in “MECH” Block under supervision of certifying staff on
                        A330-200 (CF6-80E)</td>
                    <td><strong>E1-02</strong></td>
                    <td>To sign off Borescope inspection activities on CF6-80E1 series engine i.a.w applicable
                        maintenance data</td>
                </tr>
                <tr>
                    <td><strong>D1-03</strong></td>
                    <td>To sign off maintenance activities in “MECH” Block under supervision of certifying staff on
                        A319/A320/A321 (CFM56)</td>
                    <td><strong>E1-03</strong></td>
                    <td>To sign off Borescope inspection activities on V2500 series engine i.a.w applicable maintenance
                        data</td>
                </tr>
                <tr>
                    <td><strong>D1-04</strong></td>
                    <td>To sign off maintenance activities in “MECH” Block under supervision of certifying staff on A320
                        (V2500)</td>
                    <td><strong>E1-04</strong></td>
                    <td>To sign off Borescope inspection activities on CFM56-3C series engine i.a.w applicable
                        maintenance data</td>
                </tr>
                <tr>
                    <td><strong>D1-05</strong></td>
                    <td>To sign off maintenance activities in “MECH” Block under supervision of certifying staff on
                        B737-300 (CFM56)</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong>D1-06</strong></td>
                    <td>To sign off Component maintenance activities in “MECH” Block under supervision of Component
                        certifying staff</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
