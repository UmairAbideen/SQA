@extends('admin.layout.app')

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
                            <a href="{{ route('admin.audit.view') }}" class="btn bg-gradient-success" role="button"
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

                    <div class="d-flex justify-content-end pe-3 pt-4">

                        <a href="{{ route('admin.audit.finding.form', $audits->id) }}" class="btn bg-gradient-success"
                            role="button" aria-pressed="true">+
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
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Rule
                                            Reference</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Finding
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Target
                                            Date</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Finding #
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Level</th>
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
                                            Replies</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($audits->finding as $finding)
                                        <tr class="clickable-row"
                                            data-href="{{ route('admin.audit.finding.reply.view', $finding->id) }}">

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
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0" role="button"
                                                            aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="print">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">print</span>
                                                        </a>
                                                        <a href="{{ asset('storage/' . $finding->attachment) }}"
                                                            target="_blank"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0" role="button"
                                                            aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="download" download>
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">download</span>
                                                        </a>
                                                    @else
                                                        None
                                                    @endif
                                                </div>
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                <div class="d-flex justify-content-center align-items-center mt-3">
                                                    <a href="{{ route('admin.audit.finding.reply.view', $finding->id) }}"
                                                        class="btn bg-gradient-secondary ms-1 px-3 py-2" role="button"
                                                        aria-pressed="true">
                                                        Views
                                                    </a>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">

                                                    <div>
                                                        <a href="" target="_blank"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                            role="button" aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="print">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">print</span>
                                                        </a>
                                                    </div>

                                                    <div>
                                                        <a href="{{ route('admin.audit.finding.edit', $finding->id) }}"
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
                                                                        <a href="{{ route('admin.audit.finding.delete', $finding->id) }}"
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
