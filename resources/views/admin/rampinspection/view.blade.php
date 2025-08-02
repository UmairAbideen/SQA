@extends('admin.layout.app')

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

                    <div class="d-flex justify-content-end pe-3 pt-4">
                        <a href="{{ route('admin.rampinspection.form') }}" class="btn bg-gradient-success" role="button"
                            aria-pressed="true">+
                            Add New</a>
                    </div>

                    @if (session('status'))
                        <div class="px-3">
                            <div class="alert alert-secondary alert-dismissible text-white fade show" role="alert">
                                <small>{{ session('status') }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="card-body ps-3 pe-2 pb-5 pt-0">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">S No.</th>
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
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Findings
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rampInspections as $rampInspection)
                                        <tr class="clickable-row"
                                            data-href="{{ route('admin.rampinspection.finding.view', $rampInspection->id) }}">
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
                                            <td class="align-middle text-center text-sm">{{ $rampInspection->destination }}
                                            </td>
                                            <td class="align-middle text-center text-sm">{{ $rampInspection->flight_no }}
                                            </td>
                                            <td class="align-middle text-center text-sm">{{ $rampInspection->bay_no }}</td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $rampInspection->inspection_ref_no }}</td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $rampInspection->inspection_type }}</td>
                                            <td class="align-middle text-center text-sm">{{ $rampInspection->inspector }}
                                            </td>
                                            <td class="align-middle text-center text-sm">{{ $rampInspection->status }}</td>

                                            <td>
                                                <div class="d-flex justify-content-center align-items-center mt-3">
                                                    <a href="{{ route('admin.rampinspection.finding.view', $rampInspection->id) }}"
                                                        class="btn bg-gradient-secondary ms-1 px-3 py-2" role="button">
                                                        All ({{ $rampInspection->total_findings }})
                                                    </a>
                                                    <a href="{{ route('admin.rampinspection.finding.view.open', $rampInspection->id) }}"
                                                        class="btn bg-gradient-success ms-1 px-3 py-2" role="button">
                                                        Open ({{ $rampInspection->open_findings }})
                                                    </a>
                                                    <a href="{{ route('admin.rampinspection.finding.view.close', $rampInspection->id) }}"
                                                        class="btn bg-gradient-secondary ms-1 px-3 py-2" role="button">
                                                        Close ({{ $rampInspection->close_findings }})
                                                    </a>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">

                                                    <div>
                                                        <a href="{{ route('admin.rampinspection.edit', $rampInspection->id) }}"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0" role="button"
                                                            aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="update">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">update</span>
                                                        </a>
                                                    </div>

                                                    <div>
                                                        <button type="button" class="btn bg-transparent btn-sm m-0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-delete-{{ $rampInspection->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="delete">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">delete</span>
                                                        </button>

                                                        <!-- Modal Structure -->
                                                        <div class="modal fade" id="modal-delete-{{ $rampInspection->id }}"
                                                            tabindex="-1" role="dialog"
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

                                                                        <a href="{{ route('admin.rampinspection.delete', $rampInspection->id) }}"
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
    </script>
@endsection
