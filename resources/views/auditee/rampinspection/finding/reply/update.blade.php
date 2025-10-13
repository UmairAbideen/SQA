@extends('auditee.layout.app')

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
                            <h6 class="text-white text-capitalize ps-3">Update Aircraft Inspection Reply</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('auditee.rampinspection.finding.reply.view', $rampInspectionReply->rampInspectionFinding->id) }}"
                                class="btn bg-gradient-success" role="button" aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3'
                            action="{{ route('auditee.rampinspection.finding.reply.update', $rampInspectionReply->id) }}"
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
                                <!-- Reply -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Reply</label>
                                        <input type="text" name="reply" class="form-control"
                                            value="{{ old('reply', $rampInspectionReply->reply ?? '') }}">
                                        @error('reply')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Reply By -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Reply By</label>
                                        <input type="text" name="reply_by" class="form-control"
                                            value="{{ old('reply_by', $rampInspectionReply->reply_by ?? '') }}">
                                        @error('reply_by')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Remarks -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Remarks</label>
                                        <textarea name="remarks" class="form-control" rows="1">{{ old('remarks', $rampInspectionReply->remarks ?? '') }}</textarea>
                                        @error('remarks')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Remarks By -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Remarks By</label>
                                        <input type="text" name="remarks_by" class="form-control"
                                            value="{{ old('remarks_by', $rampInspectionReply->remarks_by ?? '') }}">
                                        @error('remarks_by')
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
                                                {{ old('status', $rampInspectionReply->status) != 'Close' ? 'selected' : '' }}>
                                                Open
                                            </option>
                                            <option value="Close"
                                                {{ old('status', $rampInspectionReply->status) == 'Close' ? 'selected' : '' }}>
                                                Close
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Atatchment -->
                                <div class="col-md-6 px-3">
                                    <div class="align-self-center my-4">
                                        <input type="file" name="attachment" class="btn btn-sm bg-gradient-secondary">
                                        @error('attachment')
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
