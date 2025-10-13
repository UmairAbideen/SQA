@extends('auditee.layout.app')

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
                            <h6 class="text-white text-capitalize ps-3">Component Certifying Staff</h6>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end pe-3 pt-4">
                        <a href="{{ route('auditee.training.view') }}" class="btn bg-gradient-success" role="button"
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
                                    <strong>Component Rating:</strong> {{ $record->component_rating ?? '-' }}
                                </div>
                                <div class="col-md-4 mb-3">
                                    <strong>CMA No:</strong> {{ $record->cma_no ?? '-' }}
                                </div>
                                <div class="col-md-4 mb-3">
                                    <strong>Scope:</strong> {{ $record->scope ?? '-' }}
                                </div>
                                <div class="col-md-4 mb-3">
                                    <strong>Limitation:</strong> {{ $record->limitation ?? '-' }}
                                </div>
                            </div>

                            <div class="d-flex justify-content-start align-items-center">
                                <div>
                                    <a href="{{ route('auditee.component.print', $record->id) }}"
                                        class="btn bg-transparent btn-sm btn-tooltip m-0 ps-3 pt-4 pb-2" role="button"
                                        aria-pressed="true" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="Print PDF" target="_blank">
                                        <span class="material-icons" style="font-size: 1.5rem;">print</span>
                                    </a>
                                </div>

                                <div>
                                    <a href="{{ route('auditee.component.download', $record->id) }}"
                                        class="btn bg-transparent btn-sm btn-tooltip m-0 ps-3 pt-4 pb-2" role="button"
                                        aria-pressed="true" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="Download PDF">
                                        <span class="material-icons" style="font-size: 1.5rem;">download</span>
                                    </a>
                                </div>
                            </div> <!-- /.action buttons -->
                        </div> <!-- /.table-responsive -->
                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
