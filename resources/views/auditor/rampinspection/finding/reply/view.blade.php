@extends('auditor.layout.app')

@section('title')
    Aircraft Inspection Reply
@endsection

@section('page-name')
    Aircraft Inspection Reply
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
                            <a href="{{ route('auditor.rampinspection.finding.view', $rampInspectionFindings->rampInspection->id) }}"
                                class="btn bg-gradient-success" role="button" aria-pressed="true">Go
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
                                        <td class="align-middle text-center text-sm">
                                            {{ $rampInspectionFindings->rampInspection->aircraft_reg }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ \Carbon\Carbon::parse($rampInspectionFindings->rampInspection->date)->format('d/m/Y') }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ \Carbon\Carbon::parse($rampInspectionFindings->rampInspection->inspection_time)->format('h:i A') }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $rampInspectionFindings->rampInspection->aircraft_type }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $rampInspectionFindings->rampInspection->arrival_station }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $rampInspectionFindings->rampInspection->destination }}</td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $rampInspectionFindings->rampInspection->flight_no }}</td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $rampInspectionFindings->rampInspection->bay_no }}</td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $rampInspectionFindings->rampInspection->inspection_ref_no }}</td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $rampInspectionFindings->rampInspection->inspection_type }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $rampInspectionFindings->rampInspection->inspector }}</td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $rampInspectionFindings->rampInspection->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                {{-- -------------------  Reply   -------------------- --}}

                <div class="card my-4 mt-6">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Reply</h6>
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

                                {{-- Hidden Ramp Finding ID --}}
                                <input type="hidden" id="current_ramp_finding_id"
                                    value="{{ $rampInspectionFindings->id }}">

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

                            <a href="{{ route('auditor.rampinspection.finding.reply.form', $rampInspectionFindings->id) }}"
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
                                    <h6 class="modal-title font-weight-normal">Aircraft Inspection Reply Import / Export</h6>
                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="overflow-auto" style="max-height: 60vh; padding-right: 5px;">

                                        {{-- === REPLY IMPORT === --}}
                                        <form
                                            action="{{ route('auditor.rampinspection.finding.reply.import', $rampInspectionFindings->id) }}"
                                            method="post" enctype="multipart/form-data" class="mb-4">
                                            @csrf
                                            <label class="form-label mb-1">Select Excel file to import Replies</label>
                                            <div class="d-flex flex-wrap gap-2 pt-2">
                                                <input type="file" name="excel_file"
                                                    class="btn btn-sm bg-gradient-secondary" required>
                                                <button type="submit" class="btn bg-gradient-success">Import</button>
                                            </div>
                                        </form>

                                        {{-- === REPLY EXPORT === --}}
                                        <div class="row g-2 pt-2 justify-content-start">
                                            {{-- From --}}
                                            <div class="col-6 col-md-auto">
                                                <div class="input-group input-group-static w-100">
                                                    <label class="ms-0 mb-1">From</label>
                                                    <input type="date" id="reply_excel_start_date"
                                                        class="form-control" placeholder="Start Date">
                                                </div>
                                            </div>

                                            {{-- To --}}
                                            <div class="col-6 col-md-auto">
                                                <div class="input-group input-group-static w-100">
                                                    <label class="ms-0 mb-1">To</label>
                                                    <input type="date" id="reply_excel_end_date" class="form-control"
                                                        placeholder="End Date">
                                                </div>
                                            </div>

                                            {{-- Export Excel --}}
                                            <div class="col-12 col-md-auto pt-2 pt-md-3">
                                                <button type="button" class="btn bg-gradient-success w-100 w-md-auto"
                                                    onclick="exportRampReplyExcel({{ $rampInspectionFindings->id }})">
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
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Date</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Time</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Reply
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Reply By
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Reply By
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Remarks
                                            By
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Status
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Attachment</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Actions
                                        </th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @if ($rampInspectionFindings->rampInspectionReply)
                                        @foreach ($rampInspectionFindings->rampInspectionReply as $reply)
                                            <tr>
                                                <td class="align-middle text-center text-sm">
                                                    {{ \Carbon\Carbon::parse($reply->created_at)->format('d/M/y') }}
                                                </td>

                                                <td class="align-middle text-center text-sm">
                                                    {{ \Carbon\Carbon::parse($reply->created_at)->format('h:i a') }}
                                                </td>

                                                <td class="align-middle text-center text-sm text-wrap">
                                                    {{ $reply->reply }}
                                                </td>

                                                <td class="align-middle text-center text-sm">
                                                    {{ $reply->reply_by }}
                                                </td>

                                                <td class="align-middle text-center text-sm text-wrap">
                                                    {{ $reply->remarks }}
                                                </td>

                                                <td class="align-middle text-center text-sm">
                                                    {{ $reply->remarks_by }}
                                                </td>

                                                <td class="align-middle text-center text-sm">
                                                    {{ $reply->status }}
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        @if ($reply->attachment)
                                                            <a href="{{ asset('storage/' . $reply->attachment) }}"
                                                                target="_blank"
                                                                class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                                title="print">
                                                                <span class="material-icons"
                                                                    style="font-size: 1.5rem;">print</span>
                                                            </a>
                                                            <a href="{{ asset('storage/' . $reply->attachment) }}"
                                                                target="_blank"
                                                                class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                                title="download" download>
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
                                                        <a href="{{ route('auditor.rampinspection.finding.reply.print.pdf', $reply->id) }}"
                                                            target="_blank"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                            title="Print">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">print</span>
                                                        </a>

                                                        <a href="{{ route('auditor.rampinspection.finding.reply.download.pdf', $reply->id) }}"
                                                            target="_blank"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                            title="Download" download>
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">download</span>
                                                        </a>


                                                        <a href="{{ route('auditor.rampinspection.finding.reply.edit', $reply->id) }}"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                            title="update">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">update</span>
                                                        </a>

                                                        <!-- Delete Button with Modal -->
                                                        <button type="button" class="btn bg-transparent btn-sm m-0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-delete-{{ $reply->id }}"
                                                            title="delete">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">delete</span>
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modal-delete-{{ $reply->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="modal-delete-{{ $reply->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h6 class="modal-title font-weight-normal">Reply
                                                                            Deletion</h6>
                                                                        <button type="button" class="btn-close text-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Do you want to remove the document?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="{{ route('auditor.rampinspection.finding.reply.delete', $reply->id) }}"
                                                                            class="btn btn-secondary btn-sm mb-0 ms-1 me-1">Yes</a>
                                                                        <button type="button"
                                                                            class="btn btn-light btn-sm mb-0 ms-1 me-1"
                                                                            data-bs-dismiss="modal">No</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

        function exportRampPdf() {
            const startDate = document.querySelector('input[name="start_date"]').value;
            const endDate = document.querySelector('input[name="end_date"]').value;
            const rampFindingId = document.getElementById('current_ramp_finding_id').value;

            if (!startDate || !endDate) {
                alert("Please select both start and end dates.");
                return;
            }

            const url =
                `/auditor/rampinspection/finding/${rampFindingId}/reply/export/pdf?start_date=${startDate}&end_date=${endDate}`;
            window.open(url, '_blank');
        }

        function exportRampReplyExcel(findingId) {
            const startDate = document.getElementById('reply_excel_start_date').value;
            const endDate = document.getElementById('reply_excel_end_date').value;

            if (!startDate || !endDate) {
                alert("Please select both start and end dates.");
                return;
            }

            const url =
                `/auditor/rampinspection/finding/${findingId}/reply/export/excel?start_date=${startDate}&end_date=${endDate}`;
            window.open(url, '_blank');
        }
    </script>
@endsection
