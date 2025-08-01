@extends('admin.layout.app')

@section('title')
    Training and Authorization
@endsection

@section('page-name')
    Training and Authorization
@endsection

@section('active-link-training')
    active bg-gradient-success
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12 pt-4">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Update Training Record - SA</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('admin.training_sa.single', $record->id) }}" class="btn bg-gradient-success" role="button"
                                aria-pressed="true">Go Back</a>
                        </div>

                        <form class="px-3" action="{{ route('admin.training_sa.update', $record->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @if (session('status'))
                                <div class="alert alert-secondary alert-dismissible text-white fade show" role="alert">
                                    <small>{{ session('status') }}</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="row">
                                {{-- Read-only Staff Info --}}
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Name</label>
                                        <input type="text" class="form-control"
                                            value="{{ $record->staff->user->username ?? '' }}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>SES No</label>
                                        <input type="text" class="form-control"
                                            value="{{ $record->staff->user->ses_no ?? '' }}" disabled>
                                    </div>
                                </div>

                                {{-- Editable Training SA Fields --}}
                                @php
                                    $fields = [
                                        'pcca_regulation' => 'PCCA Regulation',
                                        'mcm' => 'MCM',
                                        'amp' => 'AMP',
                                        'reliability' => 'Reliability',
                                        'ad_sb' => 'AD/SB',
                                        'maintenance' => 'Maintenance',
                                        'record_keeping' => 'Record Keeping',
                                        'quality_monitoring' => 'Quality Monitoring',
                                        'level1_training' => 'Level 1 Training',
                                        'fuel_tank' => 'Fuel Tank Safety',
                                        'quality_auditor' => 'Quality Auditor',
                                        'ramp_insp' => 'Ramp Inspection',
                                        'engine_health' => 'Engine Health Monitoring',
                                        'hf' => 'Human Factors (HF)',
                                        'sms' => 'Safety Management System (SMS)',
                                        'ewis' => 'EWIS',
                                    ];
                                @endphp

                                @foreach ($fields as $field => $label)
                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>{{ $label }}</label>
                                            <input type="date" name="{{ $field }}" class="form-control"
                                                value="{{ old($field, $record->$field) }}">
                                            @error($field)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Submit --}}
                                <div class="mt-3 px-3">
                                    <button type="submit" class="btn bg-gradient-success">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
