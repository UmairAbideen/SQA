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
                            <h6 class="text-white text-capitalize ps-3">Create Aircraft Inspection Reply</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('auditee.rampinspection.finding.reply.view', $rampInspectionFinding->id) }}"
                                class="btn bg-gradient-success" role="button" aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('auditee.rampinspection.finding.reply.create') }}"
                            method="post" enctype="multipart/form-data">
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

                                <!-- Remarks -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Remarks</label>
                                        <textarea name="remarks" class="form-control" rows="1">{{ old('remarks') }}</textarea>
                                        @error('remarks')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="align-self-center my-4">
                                        <input type="file" name="attachment" class="btn btn-sm bg-gradient-secondary">
                                        @error('attachment')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Hidden Field-->
                                <div class="col-md-6 px-3">
                                    <input type="hidden" name="finding_id" value="{{ $rampInspectionFinding->id }}">
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
