@extends('auditor.layout.app')

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
                            <a href="{{ route('auditor.audit.finding.reply.view', $auditReply->auditFinding->id) }}"
                                class="btn bg-gradient-success" role="button" aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('auditor.audit.finding.reply.update', $auditReply->id) }}"
                            method="post" enctype="multipart/form-data">
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

                                <!-- Status -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="Open"
                                                {{ old('status', $auditReply->status) != 'Close' ? 'selected' : '' }}>
                                                Open
                                            </option>
                                            <option value="Close"
                                                {{ old('status', $auditReply->status) == 'Close' ? 'selected' : '' }}>
                                                Close
                                            </option>
                                        </select>
                                        @error('status')
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
