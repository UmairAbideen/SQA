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
                            <h6 class="text-white text-capitalize ps-3">Training Record SA</h6>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end pe-3 pt-4">
                        <a href="{{ route('admin.training.view') }}" class="btn bg-gradient-success" role="button"
                            aria-pressed="true">Go Back</a>
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

                    <div class="card-body ps-3 pe-2 pb-5 pt-4">
                        <div class="table-responsive p-0">
                            <div class="row px-3">
                                <div class="col-md-4 mb-3">
                                    <strong>Name:</strong> {{ $record->staff->user->username ?? '-' }}
                                </div>
                                <div class="col-md-4 mb-3">
                                    <strong>SES No:</strong> {{ $record->staff->user->ses_no ?? '-' }}
                                </div>
                                <div class="col-md-4 mb-3">
                                    <strong>Org:</strong> {{ $record->staff->user->org ?? '-' }}
                                </div>
                            </div>

                            <div class="row px-3">
                                @php
                                    use Carbon\Carbon;

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
                                        'ramp_insp' => 'Ramp Inspector',
                                        'engine_health' => 'Engine Health',
                                        'hf' => 'Human Factors',
                                        'sms' => 'SMS',
                                        'ewis' => 'EWIS',
                                    ];
                                @endphp

                                @foreach ($fields as $field => $label)
                                    <div class="col-md-4 mb-2">
                                        <strong>{{ $label }}:</strong>
                                        @if (!empty($record->$field))
                                            {{ \Carbon\Carbon::parse($record->$field)->format('d F Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                @endforeach
                            </div>


                            <div class="d-flex justify-content-start align-items-center">
                                <div>
                                    <a href="{{ route('admin.training_sa.edit', $record->id) }}"
                                        class="btn bg-transparent btn-sm btn-tooltip m-0 ps-3 pt-4 pb-2" role="button"
                                        data-bs-toggle="tooltip" title="Edit">
                                        <span class="material-icons" style="font-size: 1.5rem;">edit</span>
                                    </a>
                                </div>

                                <div class="ps-1 pt-4 pb-3">
                                    <a href="#" class="btn bg-transparent btn-sm m-0 pt-2" data-bs-toggle="modal"
                                        data-bs-target="#modal-delete-{{ $record->id }}" title="Delete Record">
                                        <span class="material-icons" style="font-size: 1.2rem;">delete</span>
                                    </a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-delete-{{ $record->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="modal-delete-{{ $record->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title font-weight-normal">Delete Training Record</h6>
                                                    <button type="button" class="btn-close text-dark"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete this Training Record SA entry?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('admin.training_sa.delete', $record->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1">
                                                            Yes
                                                        </button>
                                                    </form>

                                                    <button type="button" class="btn btn-light btn-sm mb-0 ms-1 me-1"
                                                        data-bs-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- modal end -->
                                </div>
                            </div> <!-- action buttons end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
