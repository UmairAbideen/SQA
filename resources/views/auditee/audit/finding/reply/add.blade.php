@extends('auditee.layout.app')

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
                            <h6 class="text-white text-capitalize ps-3">Create Audit Reply</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('auditee.audit.finding.reply.view', $auditFinding->id) }}"
                                class="btn bg-gradient-success" role="button" aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('auditee.audit.finding.reply.create') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="is_draft" id="is_draft" value="no">

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
                                            value="{{ old('date') }}">
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
                                            value="{{ old('time') }}">
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
                                            value="{{ old('reply') }}">
                                        @error('reply')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Root Cause -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Root Cause</label>
                                        <textarea name="root_cause" class="form-control" rows="1">{{ old('root_cause') }}</textarea>
                                        @error('root_cause')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Corrective Action -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Corrective Action</label>
                                        <textarea name="corrective_action" class="form-control" rows="1">{{ old('corrective_action') }}</textarea>
                                        @error('corrective_action')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Preventive Action -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Preventive Action</label>
                                        <textarea name="preventive_action" class="form-control" rows="1">{{ old('preventive_action') }}</textarea>
                                        @error('preventive_action')
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
                                    </div>
                                </div>

                                <!-- Attachment Detail -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Attachment Detail</label>
                                        <textarea name="attachment_detail" class="form-control" rows="1">{{ old('attachment_detail') }}</textarea>
                                        @error('attachment_detail')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Hidden Field-->
                                <div class="col-md-6 px-3">
                                    <input type="hidden" name="finding_id" value="{{ $auditFinding->id }}">
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn bg-gradient-success"
                                        onclick="setDraftStatus('no')">Submit</button>

                                    <button type="submit" class="btn bg-gradient-secondary"
                                        onclick="setDraftStatus('yes')">Save as Draft</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function setDraftStatus(value) {
            document.getElementById('is_draft').value = value;
        }
    </script>
@endsection
