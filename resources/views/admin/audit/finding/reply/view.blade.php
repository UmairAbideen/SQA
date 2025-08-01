@extends('admin.layout.app')

@section('title')
    Audit Finding Reply
@endsection

@section('page-name')
    Audit Finding Reply
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
                            <a href="{{ route('admin.audit.finding.view', $auditFindings->id) }}"
                                class="btn bg-gradient-success" role="button" aria-pressed="true">Go
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
                                        <td class="align-middle text-center text-sm">
                                            {{ $auditFindings->Audit->organization }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $auditFindings->Audit->audit_reference }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $auditFindings->Audit->audit_type }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $auditFindings->Audit->section }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $auditFindings->Audit->location }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ \Carbon\Carbon::parse($auditFindings->Audit->audit_date)->format('d/m/Y') }}
                                        </td>
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

                    <div class="d-flex justify-content-end pe-3 pt-4">
                        <a href="{{ route('admin.audit.finding.reply.form', $auditFindings->id) }}"
                            class="btn bg-gradient-success" role="button" aria-pressed="true">+
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
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Date</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Time</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Reply</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Root Cause
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Corrective
                                            Action</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Preventive
                                            Action</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Reply By
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Attachment
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Attachment
                                            Detail</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Target
                                            Date (After Extension)</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">QA Remarks
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Closed By
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Final
                                            Remarks</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Status
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Closing
                                            Date</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Closing
                                            Remarks</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($auditFindings->reply)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ \Carbon\Carbon::parse($auditFindings->reply->date)->format('d/M/y') }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ \Carbon\Carbon::parse($auditFindings->reply->time)->format('h:i A') }}
                                            </td>
                                            <td class="align-middle text-center text-sm text-wrap">
                                                {{ $auditFindings->reply->reply }}
                                            </td>
                                            <td class="align-middle text-center text-sm text-wrap">
                                                {{ $auditFindings->reply->root_cause }}
                                            </td>
                                            <td class="align-middle text-center text-sm text-wrap">
                                                {{ $auditFindings->reply->corrective_action }}
                                            </td>
                                            <td class="align-middle text-center text-sm text-wrap">
                                                {{ $auditFindings->reply->preventive_action }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $auditFindings->reply->reply_by }}
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div>
                                                        <a href="{{ asset('storage/' . $auditFindings->reply->attachment) }}"
                                                            target="_blank"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0" role="button"
                                                            aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="print">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">print</span>
                                                        </a>
                                                    </div>

                                                    <div>
                                                        <a href="{{ asset('storage/' . $auditFindings->reply->attachment) }}"
                                                            target="_blank"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0" role="button"
                                                            aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="download" download>
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">download</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="align-middle text-center text-sm text-wrap">
                                                {{ $auditFindings->reply->attachment_detail }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ \Carbon\Carbon::parse($auditFindings->reply->target_date_after_extension)->format('d/M/y') }}
                                            </td>
                                            <td class="align-middle text-center text-sm text-wrap">
                                                {{ $auditFindings->reply->qa_remarks }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $auditFindings->reply->closed_by }}
                                            </td>
                                            <td class="align-middle text-center text-sm text-wrap">
                                                {{ $auditFindings->reply->final_remarks }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $auditFindings->reply->status }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ \Carbon\Carbon::parse($auditFindings->reply->closing_date)->format('d/M/y') }}
                                            </td>
                                            <td class="align-middle text-center text-sm text-wrap">
                                                {{ $auditFindings->reply->closing_remarks }}
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
                                                        <a href="{{ route('admin.audit.finding.reply.edit', $auditFindings->reply->id) }}"
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
                                                            data-bs-target="#modal-delete-{{ $auditFindings->reply->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="delete">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">delete</span>
                                                        </button>

                                                        <!-- Modal Structure -->
                                                        <div class="modal fade"
                                                            id="modal-delete-{{ $auditFindings->reply->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="modal-delete-{{ $auditFindings->reply->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h6 class="modal-title font-weight-normal"
                                                                            id="modal-title-default">Reply
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
                                                                        <a href="{{ route('admin.audit.finding.reply.delete', $auditFindings->reply->id) }}"
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
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
