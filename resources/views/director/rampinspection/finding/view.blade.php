@extends('director.layout.app')

@section('title')
    Aircraft Inspection Findings
@endsection

@section('page-name')
    Aircraft Inspection Findings
@endsection

@section('active-link-ramp')
    active bg-gradient-success
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12 pt-4">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Aircraft Inspection</h6>
                        </div>
                    </div>


                    <div class="card-body ps-3 pe-2 pb-5 pt-4">
                        <div class="d-flex justify-content-end pe-2">
                            <a href="{{ route('director.rampinspection.view') }}" class="btn bg-gradient-success"
                                role="button" aria-pressed="true">Go
                                Back</a>
                        </div>

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Aircraft<br>
                                            Registration</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Date</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Inspection<br>Time</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Aircraft<br>
                                            Type</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Arrival<br>
                                            Station</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Destination</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Flight No.
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Bay No.
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Inspection<br>
                                            Ref. No.</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Inspection<br>
                                            Type</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Inspector<br>Name
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle text-center text-sm">{{ $rampInspection->aircraft_reg }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ \Carbon\Carbon::parse($rampInspection->date)->format('d/m/Y') }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ \Carbon\Carbon::parse($rampInspection->inspection_time)->format('h:i A') }}
                                        </td>
                                        <td class="align-middle text-center text-sm">{{ $rampInspection->aircraft_type }}
                                        </td>
                                        <td class="align-middle text-center text-sm">{{ $rampInspection->arrival_station }}
                                        </td>
                                        <td class="align-middle text-center text-sm">{{ $rampInspection->destination }}</td>
                                        <td class="align-middle text-center text-sm">{{ $rampInspection->flight_no }}</td>
                                        <td class="align-middle text-center text-sm">{{ $rampInspection->bay_no }}</td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $rampInspection->inspection_ref_no }}</td>
                                        <td class="align-middle text-center text-sm">{{ $rampInspection->inspection_type }}
                                        </td>
                                        <td class="align-middle text-center text-sm">{{ $rampInspection->inspector }}</td>
                                        <td class="align-middle text-center text-sm">{{ $rampInspection->status }}</td>
                                    </tr>
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
                        {{-- Centered Date Filters + Export Button --}}
                        <div class="col-12 col-md-10">
                            <div class="row g-2 justify-content-center">
                                {{-- Hidden Ramp Inspection ID --}}
                                <input type="hidden" id="current_ramp_id" value="{{ $rampInspection->id }}">

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

                                {{-- Export PDF Button --}}
                                <div class="col-12 col-md-auto pt-2 pt-md-3">
                                    <button type="button" class="btn bg-gradient-success btn-sm w-100 w-md-auto"
                                        onclick="exportRampPdf()">
                                        Export PDF
                                    </button>
                                </div>
                            </div>
                        </div>


                        {{-- Right-Aligned Import + Add New --}}
                        <div class="col-12 col-md-2 d-flex flex-wrap justify-content-center justify-content-md-end gap-2">
                            <button type="button" class="btn bg-gradient-success w-100 w-md-auto" data-bs-toggle="modal"
                                data-bs-target="#modal-import-staff" title="Import Staff & SES">
                                Excel
                            </button>

                            <a href="{{ route('director.rampinspection.finding.form', $rampInspection->id) }}"
                                class="btn bg-gradient-success w-100 w-md-auto">
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
                                    <h6 class="modal-title font-weight-normal">Aircraft Inspection Finding Import / Export
                                    </h6>
                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="overflow-auto" style="max-height: 60vh; padding-right: 5px;">

                                        {{-- === FINDING IMPORT === --}}
                                        <form
                                            action="{{ route('director.rampinspection.finding.import', $rampInspection->id) }}"
                                            method="post" enctype="multipart/form-data" class="mb-4">
                                            @csrf
                                            <label class="form-label mb-1">Select Excel file to import Findings</label>
                                            <div class="d-flex flex-wrap gap-2 pt-2">
                                                <input type="file" name="excel_file"
                                                    class="btn btn-sm bg-gradient-secondary" required>
                                                <button type="submit" class="btn bg-gradient-success">Import</button>
                                            </div>
                                        </form>

                                        {{-- === FINDING EXPORT === --}}
                                        <div class="row g-2 pt-2 justify-content-start">
                                            {{-- From --}}
                                            <div class="col-6 col-md-auto">
                                                <div class="input-group input-group-static w-100">
                                                    <label class="ms-0 mb-1">From</label>
                                                    <input type="date" id="finding_excel_start_date"
                                                        class="form-control" placeholder="Start Date">
                                                </div>
                                            </div>

                                            {{-- To --}}
                                            <div class="col-6 col-md-auto">
                                                <div class="input-group input-group-static w-100">
                                                    <label class="ms-0 mb-1">To</label>
                                                    <input type="date" id="finding_excel_end_date"
                                                        class="form-control" placeholder="End Date">
                                                </div>
                                            </div>

                                            {{-- Export Excel --}}
                                            <div class="col-12 col-md-auto pt-2 pt-md-3">
                                                <button type="button" class="btn bg-gradient-success w-100 w-md-auto"
                                                    onclick="exportRampFindingExcel({{ $rampInspection->id }})">
                                                    Export Excel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">
                                        Close
                                    </button>
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
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">S No.
                                        </th>

                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Code</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Category
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Finding
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Closed By
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
                                    @foreach ($rampInspection->rampInspectionFinding as $index => $finding)
                                        <tr class="clickable-row"
                                            data-href="{{ route('director.rampinspection.finding.reply.view', $finding->id) }}">

                                            <td class="align-middle text-center text-sm">{{ $index + 1 }}</td>

                                            <td class="align-middle text-center text-sm">{{ $finding->code }}</td>

                                            <td class="align-middle text-center text-sm">{{ $finding->category }}</td>


                                            <td class="align-middle text-center text-sm text-wrap">
                                                {{ $finding->finding }}
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($finding->closed_by))
                                                    None
                                                @else
                                                    {{ $finding->closed_by }}
                                                @endif
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $finding->status }}
                                            </td>

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
                                                            action="{{ route('director.rampinspection.finding.sendEmail', $finding->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">Send Email for Finding
                                                                    #{{ $finding->id }}</h6>
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
                                                                        value="Reminder: Reply Required for Finding #{{ $finding->id }}">
                                                                </div>

                                                                <div class="input-group input-group-static mb-4 px-3">
                                                                    <label>Body</label>
                                                                    <textarea name="body" class="form-control" rows="8">Dear Auditee,

You are requested to provide a reply for the following finding at the earliest convenience.

Finding No: {{ $finding->id }}
Code: {{ $finding->code }}
Category: {{ $finding->category }}
Finding: {{ $finding->finding }}
Inspection Ref: {{ $finding->rampInspection->inspection_ref_no }}
Aircraft: {{ $finding->rampInspection->aircraft_reg }} ({{ $finding->rampInspection->aircraft_type }})
Flight No: {{ $finding->rampInspection->flight_no }}

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
                                                    <a href="{{ route('director.rampinspection.finding.reply.view', $finding->id) }}"
                                                        class="btn bg-gradient-secondary px-3 py-2" role="button"
                                                        aria-pressed="true">
                                                        View
                                                    </a>
                                                </div>
                                            </td>


                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div>
                                                        <a href="{{ route('director.rampinspection.finding.print.pdf', $finding->id) }}"
                                                            target="_blank"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                            role="button" aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="Print Finding">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">print</span>
                                                        </a>
                                                    </div>

                                                    <div>
                                                        <a href="{{ route('director.rampinspection.finding.download.pdf', $finding->id) }}"
                                                            target="_blank"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                            role="button" aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="Download Finding" download>
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">download</span>
                                                        </a>
                                                    </div>


                                                    <div>
                                                        <a href="{{ route('director.rampinspection.finding.edit', $finding->id) }}"
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
                                                                        <p>Do you want to remove the document?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <!-- Yes Button with Tooltip -->
                                                                        <a href="{{ route('director.rampinspection.finding.delete', $finding->id) }}"
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

        function exportRampPdf() {
            const startDate = document.querySelector('input[name="start_date"]').value;
            const endDate = document.querySelector('input[name="end_date"]').value;
            const rampId = document.getElementById('current_ramp_id').value;

            if (!startDate || !endDate) {
                alert("Please select both start and end dates.");
                return;
            }

            const url = `/director/rampinspection/${rampId}/finding/export/pdf?start_date=${startDate}&end_date=${endDate}`;
            window.open(url, '_blank');
        }

        function exportRampFindingExcel(rampId) {
            const startDate = document.getElementById('finding_excel_start_date').value;
            const endDate = document.getElementById('finding_excel_end_date').value;

            if (!startDate || !endDate) {
                alert("Please select both start and end dates.");
                return;
            }

            const url =
                `/director/rampinspection/${rampId}/finding/export/excel?start_date=${startDate}&end_date=${endDate}`;
            window.open(url, '_blank');
        }
    </script>
@endsection
