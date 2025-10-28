@extends('auditor.layout.app')

@section('title')
    Aircraft Inspection Findings
@endsection

@section('page-name')
    Aircraft Inspection Findings
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
                            <h6 class="text-white text-capitalize ps-3">Update Aircraft Inspection Finding</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('auditor.rampinspection.finding.view', $rampInspection->id) }}"
                                class="btn bg-gradient-success" role="button" aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3'
                            action="{{ route('auditor.rampinspection.finding.update', $rampinspectionfinding->id) }}"
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
                                <!-- Code -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Code</label>
                                        <input type="text" name="code" class="form-control"
                                            value="{{ old('code', $rampinspectionfinding->code) }}">
                                        @error('code')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Category</label>
                                        <input type="text" name="category" class="form-control"
                                            value="{{ old('category', $rampinspectionfinding->category) }}">
                                        @error('category')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Finding -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Finding</label>
                                        <textarea name="finding" rows="1" cols="50" class="form-control">{{ old('finding', $rampinspectionfinding->finding) }}</textarea>
                                        @error('finding')
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
                                                {{ old('status', $rampinspectionfinding->status) != 'Close' ? 'selected' : '' }}>
                                                Open
                                            </option>
                                            <option value="Close"
                                                {{ old('status', $rampinspectionfinding->status) == 'Close' ? 'selected' : '' }}>
                                                Close
                                            </option>
                                        </select>
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
