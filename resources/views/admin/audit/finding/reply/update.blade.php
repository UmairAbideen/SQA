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
                            <h6 class="text-white text-capitalize ps-3">Update Audit Reply</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('admin.audit.finding.reply.view', $auditReply->auditFinding->id) }}"
                                class="btn bg-gradient-success" role="button" aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3'  action="{{ route('admin.audit.finding.reply.update', $auditReply->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            @if (session('status'))
                                <div class="alert alert-secondary alert-dismissible text-white fade show" role="alert">
                                    <small>{{ session('status') }}</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="row">

                                <!-- Date -->
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Date</label>
                                        <input type="date" name="date" class="form-control"
                                            value="{{ old('date', $auditReply->date) }}">
                                        @error('date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Time -->
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Time</label>
                                        <input type="time" name="time" class="form-control"
                                            value="{{ old('time', $auditReply->time) }}">
                                        @error('time')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Reply -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Reply</label>
                                        <input type="text" name="reply" class="form-control"
                                            value="{{ old('reply', $auditReply->reply) }}">
                                        @error('reply')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Root Cause -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Root Cause</label>
                                        <textarea name="root_cause" class="form-control" rows="1">{{ old('root_cause', $auditReply->root_cause) }}</textarea>
                                        @error('root_cause')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Corrective Action -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Corrective Action</label>
                                        <textarea name="corrective_action" class="form-control" rows="1">{{ old('corrective_action', $auditReply->corrective_action) }}</textarea>
                                        @error('corrective_action')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Preventive Action -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Preventive Action</label>
                                        <textarea name="preventive_action" class="form-control" rows="1">{{ old('preventive_action', $auditReply->preventive_action) }}</textarea>
                                        @error('preventive_action')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Reply By -->
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Reply By</label>
                                        <input type="text" name="reply_by" class="form-control"
                                            value="{{ old('reply_by', $auditReply->reply_by) }}">
                                        @error('reply_by')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <hr>

                                <!-- Attachment -->
                                <div class="col-md-6 px-3">
                                    <div class="align-self-center my-4">
                                        <input type="file" name="attachment" class="btn btn-sm bg-gradient-secondary">
                                        @error('attachment')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                        <!-- Display current attachment -->
                                        {{-- @if ($auditReply->attachment)
                                            <p class="mt-2"><a
                                                    href="{{ asset('path/to/attachments/' . $auditReply->attachment) }}"
                                                    target="_blank">View Current Attachment</a></p>
                                        @endif --}}
                                    </div>
                                </div>

                                <!-- Attachment Detail -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Attachment Detail</label>
                                        <textarea name="attachment_detail" class="form-control" rows="1">{{ old('attachment_detail', $auditReply->attachment_detail) }}</textarea>
                                        @error('attachment_detail')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Target Date After Extension -->
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Target Date (After Extension)</label>
                                        <input type="date" name="target_date_after_extension" class="form-control"
                                            value="{{ old('target_date_after_extension', $auditReply->target_date_after_extension) }}">
                                        @error('target_date_after_extension')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- QA Remarks -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>QA Remarks</label>
                                        <textarea name="qa_remarks" class="form-control" rows="1">{{ old('qa_remarks', $auditReply->qa_remarks) }}</textarea>
                                        @error('qa_remarks')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Closed By -->
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Closed By</label>
                                        <input type="text" name="closed_by" class="form-control"
                                            value="{{ old('closed_by', $auditReply->closed_by) }}">
                                        @error('closed_by')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Final Remarks -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Final Remarks</label>
                                        <textarea name="final_remarks" class="form-control" rows="1">{{ old('final_remarks', $auditReply->final_remarks) }}</textarea>
                                        @error('final_remarks')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Status</label>
                                        <input type="text" name="status" class="form-control"
                                            value="{{ old('status', $auditReply->status) }}">
                                        @error('status')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Closing Date -->
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Closing Date</label>
                                        <input type="date" name="closing_date" class="form-control"
                                            value="{{ old('closing_date', $auditReply->closing_date) }}">
                                        @error('closing_date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Closing Remarks -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Closing Remarks</label>
                                        <textarea name="closing_remarks" class="form-control" rows="1">{{ old('closing_remarks', $auditReply->closing_remarks) }}</textarea>
                                        @error('closing_remarks')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="mt-3">
                                    <button type="submit" class="btn bg-gradient-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
