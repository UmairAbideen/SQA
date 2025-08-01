<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Aircraft Certifying Staff - Certification</title>
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
                <p class="cert-title">Certification Authorization</p>
            </td>

            <td style="width:22%; text-align: right;">
                <div><b>Form No: SES-QA-011</b></div>
                <br>
                <div><b>Issue: 03</b></div>
                <div><b>Revision: 04</b></div>
                <div><b>Date: 15-Dec-2023</b></div>
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
                        <td style="border: 1px solid #ccc;"><strong>Department:</strong></td>
                        <td style="border: 1px solid #ccc;">{{ $record->staff->user->department ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;"><strong>AML No.:</strong></td>
                        <td style="border: 1px solid #ccc;">{{ $record->aml_no }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;"><strong>Category of AML:</strong></td>
                        <td style="border: 1px solid #ccc;">{{ $record->cat }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;"><strong>AML Valid until:</strong></td>
                        <td style="border: 1px solid #ccc;">
                            {{ \Carbon\Carbon::parse($record->aml_expiry)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;"><strong>Authorization No.:</strong></td>
                        <td style="border: 1px solid #ccc;">{{ $record->staff->auth_no }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;"><strong>Initial Authorization Issued on:</strong></td>
                        <td style="border: 1px solid #ccc;">
                            {{ \Carbon\Carbon::parse($record->staff->ini_issue_date)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;"><strong>Authorization Revision No.:</strong></td>
                        <td style="border: 1px solid #ccc;">{{ $record->rev_no ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;"><strong>Authorization Valid until:</strong></td>
                        <td style="border: 1px solid #ccc;">
                            {{ \Carbon\Carbon::parse($record->aml_expiry)->format('d F Y') }} (AML Expiry)</td>
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
                                'hf' => 'HF',
                                'op' => 'OP',
                                'tt' => 'TT',
                                'cdccl' => 'CDCCL',
                                'ewis' => 'EWIS',
                                'sms' => 'SMS',
                                'al' => 'AL',
                                'at_1' => 'AT-1',
                                'at_2' => 'AT-2',
                                'at_3' => 'AT-3',
                                'at_4' => 'AT-4',
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
                <th>AIRCRAFT</th>
                <th>CATEGORY</th>
                <th>SCOPE OF AUTHORIZATION CODES</th>
                <th>AUTHORIZATION PRIVILEGE CODES</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>B737-600/700/800/900 (CFM-56)</td>
                <td>B1</td>
                <td>B1-05, B1-06, B1-07, B1-08 & B1-09</td>
                <td>AF-E&A, ENG-E&A, BITE-A/V, EGR, DR, DE & INCI</td>
            </tr>
            <tr>
                <td>A330 (CF6-80E)</td>
                <td>B1</td>
                <td>A1-04, A1-05, A1-06, A1-07 & A1-08</td>
                <td>AF-E&A, ENG-E&A, BITE-A/V, EGR, DR, DE & INCI</td>
            </tr>
        </tbody>
    </table>


    <!-- Terms & Conditions Section -->
    <div class="section-heading">TERMS & CONDITIONS</div>
    <table style="width: 100%; border: 1px solid #ccc; border-collapse: collapse; font-size: 11px;">
        <tbody>
            <tr>
                <td style="border: 1px solid #ccc; padding: 2px;">
                    <p> <strong>a.</strong> This authorization is valid provided AML & continuation trainings remain
                        valid and the person
                        remains in the active service of SES. <br>
                        <strong>b.</strong> This Authorization does not authorize the holder to certify any other
                        maintenance task except
                        as detailed within the Scope of Authorization. <br>
                        <strong>c.</strong> All Certification documentation must be supported by Signature and
                        Authorization stamp. <br>
                        <strong>d.</strong> Your Signature below indicates that you have read and understood these Terms
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
                            This is to certify that the above person has met the requirement of Quality System
                            procedures in
                            all aspects.<br>
                            This Certification Authorization is granted in accordance with the provision of SES
                            Maintenance
                            Organization Exposition (MOE) 3.4.
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
                    <td style="border: 1px solid #ccc; padding: 6px;">AF</td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform maintenance on Airframe Systems
                        excluding
                        Electrical System and Avionics LRUs</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;">ENG</td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform maintenance on Engine excluding
                        Electrical
                        System and Avionics LRUs</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;">AF-E&A</td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform maintenance on Airframe Systems
                        including
                        Electrical System and Avionics LRUs</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;">ENG-E&A</td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform maintenance on Engine including
                        Electrical
                        System and Avionics LRUs</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;">AF-E/AV</td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform maintenance on Airframe Electrical
                        System
                        and Avionics LRUs</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;">ENG-E/AV</td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform maintenance on Engine Electrical System
                        and
                        Avionics LRUs</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;">BITE-A/V</td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform only Simple Test on Avionic Systems
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;">A/V & Elec</td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform maintenance on Avionic Systems and
                        Electrical Systems</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;">EGR</td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform Engine Ground Run-Up</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;">DR</td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform Defect Rectification</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;">MDR</td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform Minor Defect Rectification</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;">DE</td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform Dent Evaluation</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;">BSI</td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform Borescope Inspection</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 6px;">INCI</td>
                    <td style="border: 1px solid #ccc; padding: 6px;">To perform Incoming Inspection</td>
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
                    <td style="border: 1px solid #ccc; padding: 6px;"><strong>A1-01</strong></td>
                    <td style="border: 1px solid #ccc; padding: 6px;">A330-200 (CF6-80E) up to Daily Check</td>
                    <td style="border: 1px solid #ccc; padding: 6px;"><strong>B1-01</strong></td>
                    <td style="border: 1px solid #ccc; padding: 6px;">B737-800 (CFM56) up to Daily Check</td>
                </tr>
                <tr>
                    <td><strong>A1-02</strong></td>
                    <td>A330-200 (CF6-80E) up to 1000 FH/ 200 FC/ 03 Months</td>
                    <td><strong>B1-02</strong></td>
                    <td>B737-800 (CFM56) up to 2400 FH / 1440 FC / 240 Days</td>
                </tr>
                <tr>
                    <td><strong>A1-03</strong></td>
                    <td>A330-200 (CF6-80E) up to 4400 FH/ 2200 FC/ 01 Year</td>
                    <td><strong>B1-03</strong></td>
                    <td>B737-800 (CFM56) up to 4800 FH / 2880 FC / 480 Days</td>
                </tr>
                <tr>
                    <td><strong>A1-04</strong></td>
                    <td>A330-200 (CF6-80E) up to 12000 FH/ 3000 FC/ 730 Days</td>
                    <td><strong>B1-04</strong></td>
                    <td>B737-800 (CFM56) up to 7200 FH / 4320 FC / 720 Days</td>
                </tr>
                <tr>
                    <td><strong>A1-05</strong></td>
                    <td>A330-200 task cards mentioned in MOE 5.6.2 (group A)</td>
                    <td><strong>B1-05</strong></td>
                    <td>B737-800 (CFM56) up to 10200 FH / 6120 FC / 1020 Days</td>
                </tr>
                <tr>
                    <td><strong>A1-06</strong></td>
                    <td>A330-200 task cards mentioned in MOE 5.6.2 (group B)</td>
                    <td><strong>B1-06</strong></td>
                    <td>B737-800 task cards mentioned in MOE 5.6.1 (group A)</td>
                </tr>
                <tr>
                    <td><strong>A1-07</strong></td>
                    <td>A330-200 task cards mentioned in MOE 5.6.2 (group C)</td>
                    <td><strong>B1-07</strong></td>
                    <td>B737-800 task cards mentioned in MOE 5.6.1 (group B)</td>
                </tr>
                <tr>
                    <td><strong>A1-08</strong></td>
                    <td>A330-200 task cards mentioned in MOE 5.6.2 (group D)</td>
                    <td><strong>B1-08</strong></td>
                    <td>B737-800 task cards mentioned in MOE 5.6.1 (group C)</td>
                </tr>
                <tr>
                    <td><strong>A1-09</strong></td>
                    <td>A330-200 task cards mentioned in MOE 5.6.2 (group AR)</td>
                    <td><strong>B1-09</strong></td>
                    <td>B737-800 task cards mentioned in MOE 5.6.1 (group D)</td>
                </tr>
                <tr>
                    <td><strong>A1-10</strong></td>
                    <td>A330-200 task cards mentioned in MOE 5.6.2 (group AR1)</td>
                    <td><strong>B2-01</strong></td>
                    <td>B737-300 (CFM56) up to Daily Check</td>
                </tr>
                <tr>
                    <td><strong>A2-01</strong></td>
                    <td>A319/A320/A321 (CFM56) up to Daily Check</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong>A2-02</strong></td>
                    <td>A320 (V2500) up to Daily Check</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
