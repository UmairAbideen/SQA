@extends('auditee.layout.app')

@section('title')
    Aircraft Inspection
@endsection

@section('page-name')
    Aircraft Inspection
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

                    <div class="row align-items-center px-3 pt-4 pb-5 g-3">
                        {{-- Centered Date Filters + Export Button --}}
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
                            {{-- <button type="button" class="btn bg-gradient-success w-100 w-md-auto" data-bs-toggle="modal"
                                data-bs-target="#modal-import-staff" title="Import Staff & SES">
                                Excel
                            </button> --}}

                            {{-- <a href="{{ route('auditee.rampinspection.form') }}"
                                class="btn bg-gradient-success w-100 w-md-auto">
                                + Add New
                            </a> --}}
                        </div>
                    </div>



                    <!-- Import Modal -->
                    <div class="modal fade" id="modal-import-staff" tabindex="-1" role="dialog"
                        aria-labelledby="modal-import-staff" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title font-weight-normal">Aircraft Inspection Import / Export</h6>
                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="overflow-auto" style="max-height: 60vh; padding-right: 5px;">

                                        {{-- === RAMP INSPECTION IMPORT === --}}
                                        <form action="{{ route('auditee.rampinspection.import') }}" method="post"
                                            enctype="multipart/form-data" class="mb-4">
                                            @csrf
                                            <label class="form-label mb-1">Select Excel file to import Ramp
                                                Inspections</label>
                                            <div class="d-flex flex-wrap gap-2 pt-2">
                                                <input type="file" name="excel_file"
                                                    class="btn btn-sm bg-gradient-secondary" required>
                                                <button type="submit" class="btn bg-gradient-success">Import</button>
                                            </div>
                                        </form>

                                        {{-- === RAMP INSPECTION EXPORT === --}}
                                        <div class="row g-2 pt-2 justify-content-start">
                                            {{-- From --}}
                                            <div class="col-6 col-md-auto">
                                                <div class="input-group input-group-static w-100">
                                                    <label class="ms-0 mb-1">From</label>
                                                    <input type="date" id="ramp_excel_start_date" class="form-control"
                                                        placeholder="Start Date">
                                                </div>
                                            </div>

                                            {{-- To --}}
                                            <div class="col-6 col-md-auto">
                                                <div class="input-group input-group-static w-100">
                                                    <label class="ms-0 mb-1">To</label>
                                                    <input type="date" id="ramp_excel_end_date" class="form-control"
                                                        placeholder="End Date">
                                                </div>
                                            </div>

                                            {{-- Export Excel --}}
                                            <div class="col-12 col-md-auto pt-2 pt-md-3">
                                                <button type="button" class="btn bg-gradient-success w-100 w-md-auto"
                                                    onclick="exportRampExcel()">
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
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Flight
                                            No.
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
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Findings
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rampInspections as $rampInspection)
                                        <tr class="clickable-row"
                                            data-href="{{ route('auditee.rampinspection.finding.view', $rampInspection->id) }}">
                                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>

                                            <td class="align-middle text-center text-sm">
                                                {{ $rampInspection->aircraft_reg }}
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                {{ \Carbon\Carbon::parse($rampInspection->date)->format('d/m/Y') }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ \Carbon\Carbon::parse($rampInspection->inspection_time)->format('h:i A') }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $rampInspection->aircraft_type }}</td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $rampInspection->arrival_station }}</td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $rampInspection->destination }}
                                            </td>
                                            <td class="align-middle text-center text-sm">{{ $rampInspection->flight_no }}
                                            </td>
                                            <td class="align-middle text-center text-sm">{{ $rampInspection->bay_no }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $rampInspection->inspection_ref_no }}</td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $rampInspection->inspection_type }}</td>
                                            <td class="align-middle text-center text-sm">{{ $rampInspection->inspector }}
                                            </td>
                                            <td class="align-middle text-center text-sm">{{ $rampInspection->status }}
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center align-items-center mt-3">
                                                    <a href="{{ route('auditee.rampinspection.finding.view', $rampInspection->id) }}"
                                                        class="btn bg-gradient-secondary ms-1 px-3 py-2" role="button">
                                                        All ({{ $rampInspection->total_findings }})
                                                    </a>
                                                    <a href="{{ route('auditee.rampinspection.finding.view.open', $rampInspection->id) }}"
                                                        class="btn bg-gradient-success ms-1 px-3 py-2" role="button">
                                                        Open ({{ $rampInspection->open_findings }})
                                                    </a>
                                                    <a href="{{ route('auditee.rampinspection.finding.view.close', $rampInspection->id) }}"
                                                        class="btn bg-gradient-secondary ms-1 px-3 py-2" role="button">
                                                        Close ({{ $rampInspection->close_findings }})
                                                    </a>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">

                                                    <div>
                                                        <a href="{{ route('auditee.rampinspection.print.pdf', $rampInspection->id) }}"
                                                            target="_blank"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                            role="button" aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="print">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">print</span>
                                                        </a>
                                                    </div>

                                                    <div>
                                                        <a href="{{ route('auditee.rampinspection.download.pdf', $rampInspection->id) }}"
                                                            target="_blank"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                            role="button" aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="download" download>
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">download</span>
                                                        </a>
                                                    </div>

                                                    {{-- <div>
                                                        <a href="{{ route('auditee.rampinspection.edit', $rampInspection->id) }}"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                            role="button" aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="update">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">update</span>
                                                        </a>
                                                    </div> --}}

                                                    {{-- <div>
                                                        <button type="button" class="btn bg-transparent btn-sm m-0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-delete-{{ $rampInspection->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="delete">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">delete</span>
                                                        </button>

                                                        <!-- Modal Structure -->
                                                        <div class="modal fade"
                                                            id="modal-delete-{{ $rampInspection->id }}" tabindex="-1"
                                                            role="dialog"
                                                            aria-labelledby="modal-delete-{{ $rampInspection->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h6 class="modal-title font-weight-normal"
                                                                            id="modal-title-default">Aircraft Inpection
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

                                                                        <a href="{{ route('auditee.rampinspection.delete', $rampInspection->id) }}"
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
                                                    </div> --}}
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

            if (!startDate || !endDate) {
                alert('Please select both Start Date and End Date.');
                return;
            }

            const url = `{{ route('auditee.rampinspection.range.pdf') }}?start_date=${startDate}&end_date=${endDate}`;
            window.open(url, '_blank');
        }

        function exportRampExcel() {
            const startDate = document.getElementById('ramp_excel_start_date').value;
            const endDate = document.getElementById('ramp_excel_end_date').value;

            if (!startDate || !endDate) {
                alert("Please select both start and end dates.");
                return;
            }

            const url = `/auditee/rampinspection/export/excel?start_date=${startDate}&end_date=${endDate}`;
            window.open(url, '_blank');
        }
    </script>
@endsection
