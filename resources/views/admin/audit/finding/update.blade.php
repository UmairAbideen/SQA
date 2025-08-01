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
                            <h6 class="text-white text-capitalize ps-3">Update Audit Finding</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('admin.audit.finding.view', $audit->id) }}" class="btn bg-gradient-success"
                                role="button" aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('admin.audit.finding.update', $finding->id) }}" method="post" enctype="multipart/form-data">
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
                                <!-- Rule Reference -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Rule Reference</label>
                                        <input type="text" name="rule_reference" class="form-control"
                                            value="{{ old('rule_reference', $finding->rule_reference) }}">
                                        @error('rule_reference')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Finding -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Finding</label>
                                        <textarea name="finding" class="form-control" rows="1" cols="50">{{ old('finding', $finding->finding) }}</textarea>
                                        @error('finding')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Target Date -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Target Date</label>
                                        <input type="date" name="target_dates" class="form-control"
                                            value="{{ old('target_dates', $finding->target_dates) }}">
                                        @error('target_dates')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Finding Number -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Finding Number</label>
                                        <input type="text" name="finding_number" class="form-control"
                                            value="{{ old('finding_number', $finding->finding_number) }}">
                                        @error('finding_number')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Finding Level -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Finding Level</label>
                                        <input type="text" name="finding_level" class="form-control"
                                            value="{{ old('finding_level', $finding->finding_level) }}">
                                        @error('finding_level')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Repeated Finding -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Repeated Finding</label>
                                        <select name="repeated_finding" class="form-control">
                                            <option value="" disabled>Select an option</option>
                                            <option value="Yes"
                                                {{ old('repeated_finding', $finding->repeated_finding) == 'Yes' ? 'selected' : '' }}>
                                                Yes</option>
                                            <option value="No"
                                                {{ old('repeated_finding', $finding->repeated_finding) == 'No' ? 'selected' : '' }}>
                                                No</option>
                                        </select>
                                        @error('repeated_finding')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nature of Finding -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Nature of Finding</label>
                                        <input type="text" name="nature_of_finding" class="form-control"
                                            value="{{ old('nature_of_finding', $finding->nature_of_finding) }}">
                                        @error('nature_of_finding')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Validity Date -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Validity Date</label>
                                        <input type="date" name="validity_date" class="form-control"
                                            value="{{ old('validity_date', $finding->validity_date) }}">
                                        @error('validity_date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Auditor -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Auditor</label>
                                        <input type="text" name="auditor" class="form-control"
                                            value="{{ old('auditor', $finding->auditor) }}">
                                        @error('auditor')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Status</label>
                                        <input type="text" name="status" class="form-control"
                                            value="{{ old('status', $finding->status) }}">
                                        @error('status')
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
