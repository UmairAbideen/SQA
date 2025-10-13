@extends('auditee.layout.app')

@section('title')
    Audit Findings
@endsection

@section('page-name')
    Audit Findings
@endsection

@section('active-link-audit')
    active bg-gradient-success
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12 pt-4">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Audit</h6>
                        </div>
                    </div>

                    <div class="card-body ps-3 pe-2 pb-5 pt-4">
                        <div class="d-flex justify-content-end pe-2">
                            <a href="{{ route('auditee.audit.view') }}" class="btn bg-gradient-success" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Organization</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Audit
                                            Reference</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Audit Type
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Section
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Location
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Audit Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($audits)
                                        <tr>
                                            <td class="align-middle text-center text-sm">{{ $audits->organization }}</td>
                                            <td class="align-middle text-center text-sm">{{ $audits->audit_reference }}</td>
                                            <td class="align-middle text-center text-sm">{{ $audits->audit_type }}</td>
                                            <td class="align-middle text-center text-sm">{{ $audits->section }}</td>
                                            <td class="align-middle text-center text-sm">{{ $audits->location }}</td>
                                            <td class="align-middle text-center text-sm">
                                                {{ \Carbon\Carbon::parse($audits->audit_date)->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- -------------------  Findings   -------------------- --}}

                <div class="card my-4 mt-6">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Findings</h6>
                        </div>
                    </div>

                    <div class="row align-items-center px-3 pt-4 pb-5 g-3">
                        {{-- Date Filters + Export --}}
                        <div class="col-12 col-md-10">
                            <div class="row g-2 justify-content-center">

                                {{-- Date From --}}
                                <div class="col-6 col-md-auto">
                                    <div class="input-group input-group-static w-100">
                                        <label class="ms-0 mb-1">From</label>
                                        <input type="date" name="start_date" class="form-control"
                                            value="{{ request('start_date') }}" placeholder="Start Date">
                                    </div>
                                </div>

                                {{-- Date To --}}
                                <div class="col-6 col-md-auto">
                                    <div class="input-group input-group-static w-100">
                                        <label class="ms-0 mb-1">To</label>
                                        <input type="date" name="end_date" class="form-control"
                                            value="{{ request('end_date') }}" placeholder="End Date">
                                    </div>
                                </div>

                                <input type="hidden" id="current_audit_id" value="{{ $audits->id }}">

                                {{-- Export Button --}}
                                <div class="col-12 col-md-auto pt-2 pt-md-3">
                                    <button type="button" class="btn bg-gradient-success btn-sm w-100 w-md-auto"
                                        onclick="exportAuditPdf()">
                                        Export PDF
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Right-Aligned Add & Import Buttons --}}
                        <div class="col-12 col-md-2 d-flex flex-wrap justify-content-center justify-content-md-end gap-2">
                            <button type="button" class="btn bg-gradient-success w-100 w-md-auto" data-bs-toggle="modal"
                                data-bs-target="#modal-import-staff" title="Import Staff & SES">
                                Excel
                            </button>

                            <a href="{{ route('auditee.audit.finding.form', $audits->id) }}"
                                class="btn bg-gradient-success w-100 w-md-auto" role="button" aria-pressed="true">
                                + Add New
                            </a>
                        </div>
                    </div>


                    <!-- Import Modal -->
                    <div class="modal fade" id="modal-import-staff" tabindex="-1" role="dialog"
                        aria-labelledby="modal-import-staff" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title font-weight-normal" id="modal-title-import">
                                        Audit Findings Import / Export
                                    </h6>
                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>

                                <!-- Scrollable modal body -->
                                <div class="modal-body" style="max-height: 75vh; overflow-y: auto;">

                                    {{-- === FINDING IMPORT === --}}
                                    <form action="{{ route('auditee.finding.import') }}" method="post"
                                        enctype="multipart/form-data" class="mb-4">
                                        @csrf
                                        <input type="hidden" name="audit_id" value="{{ $audits->id }}">

                                        <label class="form-label mb-1">Select Excel file to import findings</label>
                                        <div class="d-flex flex-wrap gap-2 pt-2">
                                            <input type="file" name="excel_file" class="btn btn-sm bg-gradient-secondary"
                                                required>
                                            <button type="submit" class="btn bg-gradient-success">
                                                Import
                                            </button>
                                        </div>
                                    </form>

                                    {{-- === FINDING EXPORT === --}}
                                    <div class="row g-2 pt-3 justify-content-start justify-content-md-start">

                                        {{-- Date From --}}
                                        <div class="col-6 col-md-auto">
                                            <div class="input-group input-group-static w-100">
                                                <label class="ms-0 mb-1">From</label>
                                                <input type="date" id="finding_excel_start_date" class="form-control"
                                                    placeholder="Start Date">
                                            </div>
                                        </div>

                                        {{-- Date To --}}
                                        <div class="col-6 col-md-auto">
                                            <div class="input-group input-group-static w-100">
                                                <label class="ms-0 mb-1">To</label>
                                                <input type="date" id="finding_excel_end_date" class="form-control"
                                                    placeholder="End Date">
                                            </div>
                                        </div>

                                        {{-- Export Button --}}
                                        <div class="col-12 col-md-auto pt-2 pt-md-3">
                                            <button type="button" class="btn bg-gradient-success w-100 w-md-auto"
                                                onclick="exportFindingExcel({{ $audits->id }})">
                                                Export Excel
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light btn-sm"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>





                    @if (session('status') || session('error'))
                        <div class="px-3">
                            <div class="alert {{ session('status') ? 'alert-secondary' : 'alert-secondary' }} alert-dismissible text-white fade show"
                                role="alert">
                                <small>{{ session('status') ?? session('error') }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="card-body ps-3 pe-2 pb-5 pt-0">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Rule
                                            Reference</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Finding
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Target
                                            Date</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Finding #
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Level
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Repeated
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Nature
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Auditor
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Status
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Attachment</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Email</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Replies</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($audits->finding as $finding)
                                        <tr class="clickable-row"
                                            data-href="{{ route('auditee.audit.finding.reply.view', $finding->id) }}">

                                            <td class="align-middle text-center text-sm">{{ $finding->rule_reference }}
                                            </td>
                                            <td class="align-middle text-center text-sm text-wrap">
                                                {{ $finding->finding }}</td>

                                            <td class="align-middle text-center text-sm">
                                                {{ \Carbon\Carbon::parse($finding->target_dates)->format('d-m-Y') }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $finding->finding_number }}
                                            </td>

                                            <td class="align-middle text-center text-sm">{{ $finding->finding_level }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $finding->repeated_finding }}</td>
                                            <td class="align-middle text-center text-sm text-wrap">
                                                {{ $finding->nature_of_finding }}</td>

                                            <td class="align-middle text-center text-sm">{{ $finding->auditor }}</td>

                                            <td class="align-middle text-center text-sm">{{ $finding->status }}</td>

                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    @if ($finding->attachment)
                                                        <a href="{{ asset('storage/' . $finding->attachment) }}"
                                                            target="_blank"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                            role="button" aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="print">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">print</span>
                                                        </a>
                                                        <a href="{{ asset('storage/' . $finding->attachment) }}"
                                                            target="_blank"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                            role="button" aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="download" download>
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">download</span>
                                                        </a>
                                                    @else
                                                        None
                                                    @endif
                                                </div>
                                            </td>


                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <button class="btn bg-transparent btn-sm m-0" data-bs-toggle="modal"
                                                        data-bs-target="#emailModal{{ $finding->id }}">
                                                        <span class="material-icons"
                                                            style="font-size: 1.5rem;">email</span>
                                                    </button>
                                                </div>
                                            </td>

                                            <!-- Email Modal -->
                                            <div class="modal fade" id="emailModal{{ $finding->id }}" tabindex="-1"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <form
                                                            action="{{ route('auditee.audit.finding.sendEmail', $finding->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">Send Email for Audit Finding
                                                                    #{{ $finding->finding_number }}</h6>
                                                                <button type="button" class="btn-close text-dark"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="input-group input-group-static mb-4 px-3">
                                                                    <label>To</label>
                                                                    <input type="email" name="to"
                                                                        class="form-control" required>
                                                                </div>

                                                                <div class="input-group input-group-static mb-4 px-3">
                                                                    <label>CC</label>
                                                                    <input type="text" name="cc"
                                                                        class="form-control"
                                                                        placeholder="Separate multiple emails with commas">
                                                                </div>

                                                                <div class="input-group input-group-static mb-4 px-3">
                                                                    <label>BCC</label>
                                                                    <input type="text" name="bcc"
                                                                        class="form-control"
                                                                        placeholder="Separate multiple emails with commas">
                                                                </div>

                                                                <div class="input-group input-group-static mb-4 px-3">
                                                                    <label>Subject</label>
                                                                    <input type="text" name="subject"
                                                                        class="form-control"
                                                                        value="Reminder: Reply Required for Audit Finding #{{ $finding->finding_number }}">
                                                                </div>

                                                                <div class="input-group input-group-static mb-4 px-3">
                                                                    <label>Body</label>
                                                                    <textarea name="body" class="form-control" rows="8">Dear Auditee,

You are requested to provide a reply for the following finding:

Finding No: {{ $finding->finding_number }}
Level: {{ $finding->finding_level }}
Nature: {{ $finding->nature_of_finding }}
Finding: {{ $finding->finding }}
Audit Ref: {{ $finding->audit->audit_reference }}
Audit Type: {{ $finding->audit->audit_type }}
Section: {{ $finding->audit->section }}
Location: {{ $finding->audit->location }}
Audit Date: {{ $finding->audit->audit_date }}

Best regards,
Quality Assurance
Serene Eng. Services
</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn bg-gradient-success">Send Email</button>
                                                                <button type="button" class="btn btn-light btn-sm"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                            <td class="align-middle text-center text-sm">
                                                <div class="d-flex justify-content-center align-items-center mt-3">
                                                    <a href="{{ route('auditee.audit.finding.reply.view', $finding->id) }}"
                                                        class="btn bg-gradient-secondary ms-1 px-3 py-2" role="button"
                                                        aria-pressed="true">
                                                        View
                                                    </a>
                                                </div>
                                            </td>


                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div>
                                                        <a href="{{ route('auditee.audit.finding.print.pdf', $finding->id) }}"
                                                            target="_blank"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                            role="button" aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="print findings">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">print</span>
                                                        </a>
                                                    </div>

                                                    <div>
                                                        <a href="{{ route('auditee.audit.finding.download.pdf', $finding->id) }}"
                                                            target="_blank"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                            role="button" aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="download findings" download>
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">download</span>
                                                        </a>
                                                    </div>

                                                    <div>
                                                        <a href="{{ route('auditee.audit.finding.edit', $finding->id) }}"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                            role="button" aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="update">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">update</span>
                                                        </a>
                                                    </div>

                                                    <div>
                                                        <button type="button" class="btn bg-transparent btn-sm m-0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-delete-{{ $finding->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="delete">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">delete</span>
                                                        </button>

                                                        <!-- Modal Structure -->
                                                        <div class="modal fade" id="modal-delete-{{ $finding->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="modal-delete-{{ $finding->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h6 class="modal-title font-weight-normal"
                                                                            id="modal-title-default">Finding
                                                                            Deletion
                                                                        </h6>
                                                                        <button type="button" class="btn-close text-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Do you want to remove the record?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <!-- Yes Button with Tooltip -->
                                                                        <a href="{{ route('auditee.audit.finding.delete', $finding->id) }}"
                                                                            class="btn btn-secondary btn-sm mb-0 ms-1 me-1"
                                                                            role="button" aria-pressed="true"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="top"
                                                                            title="Confirm deletion">Yes</a>

                                                                        <!-- No Button inside Modal -->
                                                                        <button type="button"
                                                                            class="btn btn-light btn-sm mb-0 ms-1 me-1"
                                                                            data-bs-dismiss="modal"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="top"
                                                                            title="Cancel deletion">No</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- To make rows cilckable and prevent icons link to be effected --}}
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "responsive": true,
            });
        });

        $(document).ready(function() {
            var table = $('#myTable').DataTable();

            // Add Bootstrap spacing classes
            $('#myTable_length').addClass('mt-0 mb-2 ms-2'); // entries
            $('#myTable_filter').addClass('mt-0 mb-2 me-2'); // Search box
            $('#myTable_paginate').addClass('mt-3 me-2'); // Pagination
            $('#myTable_info').addClass('mt-3 ms-3'); // Info text
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.clickable-row').forEach(function(row) {
                row.addEventListener('click', function(e) {
                    // Prevent row click if a link or button inside was clicked
                    if (e.target.closest('a') || e.target.closest('button') || e.target.closest(
                            '.material-icons')) {
                        return;
                    }

                    // Otherwise, navigate to row's href
                    window.location = this.dataset.href;
                });
            });
        });

        function exportAuditPdf() {
            const startDate = document.querySelector('input[name="start_date"]').value;
            const endDate = document.querySelector('input[name="end_date"]').value;
            const auditId = document.getElementById('current_audit_id').value;

            if (!startDate || !endDate) {
                alert("Please select both start and end dates.");
                return;
            }

            const url = `/auditee/audit/${auditId}/finding/export/pdf?start_date=${startDate}&end_date=${endDate}`;
            window.open(url, '_blank');
        }

        function exportFindingExcel(auditId) {
            const startDate = document.getElementById('finding_excel_start_date').value;
            const endDate = document.getElementById('finding_excel_end_date').value;

            if (!startDate || !endDate) {
                alert("Please select both start and end dates.");
                return;
            }

            const url = `/auditee/audit/${auditId}/finding/export/excel?start_date=${startDate}&end_date=${endDate}`;
            window.open(url, '_blank');
        }
    </script>
@endsection
