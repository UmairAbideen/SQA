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
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Final
                                            Remarks</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Closing
                                            Date</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Closing
                                            Remarks</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Closed By
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Status
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($auditFindings->reply)
                                        @foreach ($auditFindings->reply as $reply)
                                            <tr>
                                                <td class="align-middle text-center text-sm">
                                                    {{ \Carbon\Carbon::parse($reply->date)->format('d/M/y') }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ \Carbon\Carbon::parse($reply->time)->format('h:i A') }}
                                                </td>
                                                <td class="align-middle text-center text-sm text-wrap">
                                                    {{ $reply->reply }}
                                                </td>
                                                <td class="align-middle text-center text-sm text-wrap">
                                                    {{ $reply->root_cause }}
                                                </td>
                                                <td class="align-middle text-center text-sm text-wrap">
                                                    {{ $reply->corrective_action }}
                                                </td>
                                                <td class="align-middle text-center text-sm text-wrap">
                                                    {{ $reply->preventive_action }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ $reply->reply_by }}
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        @if ($reply->attachment)
                                                            <a href="{{ asset('storage/' . $reply->attachment) }}"
                                                                target="_blank"
                                                                class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                                title="Print">
                                                                <span class="material-icons"
                                                                    style="font-size: 1.5rem;">print</span>
                                                            </a>
                                                            <a href="{{ asset('storage/' . $reply->attachment) }}"
                                                                target="_blank"
                                                                class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                                title="Download" download>
                                                                <span class="material-icons"
                                                                    style="font-size: 1.5rem;">download</span>
                                                            </a>
                                                        @else
                                                            None
                                                        @endif
                                                    </div>
                                                </td>

                                                <td class="align-middle text-center text-sm text-wrap">
                                                    {{ $reply->attachment_detail ?? 'None' }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ $reply->target_date_after_extension ? \Carbon\Carbon::parse($reply->target_date_after_extension)->format('d/M/y') : 'None' }}
                                                </td>
                                                <td class="align-middle text-center text-sm text-wrap">
                                                    {{ $reply->qa_remarks ?? 'None' }}
                                                </td>
                                                <td class="align-middle text-center text-sm text-wrap">
                                                    {{ $reply->final_remarks ?? 'None' }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ $reply->closing_date ? \Carbon\Carbon::parse($reply->closing_date)->format('d/M/y') : 'None' }}
                                                </td>
                                                <td class="align-middle text-center text-sm text-wrap">
                                                    {{ $reply->closing_remarks ?? 'None' }}
                                                </td>
                                                <td class="align-middle text-center text-sm text-wrap">
                                                    {{ $reply->closed_by ?? 'None' }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ $reply->status ?? 'None' }}
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ route('admin.audit.finding.reply.edit', $reply->id) }}"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0"
                                                            title="Update">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">update</span>
                                                        </a>

                                                        <button type="button" class="btn bg-transparent btn-sm m-0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-delete-{{ $reply->id }}"
                                                            title="Delete">
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
                                                                        <h6 class="modal-title">Delete Reply</h6>
                                                                        <button type="button" class="btn-close text-dark"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"><span
                                                                                aria-hidden="true">×</span></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Do you want to remove this reply?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="{{ route('admin.audit.finding.reply.delete', $reply->id) }}"
                                                                            class="btn btn-secondary btn-sm">Yes</a>
                                                                        <button type="button"
                                                                            class="btn btn-light btn-sm"
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
@endsection
