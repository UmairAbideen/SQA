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
                            <h6 class="text-white text-capitalize ps-3">SES Training Record</h6>
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

                                {{-- Training Fields --}}
                                @php
                                    $fields = [
                                        'hf' => 'HF',
                                        'op' => 'OP',
                                        'cdccl' => 'CDC/CL',
                                        'tt' => 'TT',
                                        'sms' => 'SMS',
                                        'ewis' => 'EWIS',
                                        'al' => 'AL',
                                        'at_1' => 'AT 1',
                                        'at_2' => 'AT 2',
                                        'at_3' => 'AT 3',
                                        'at_4' => 'AT 4',
                                    ];
                                @endphp

                                @foreach ($fields as $key => $label)
                                    <div class="col-md-4 mb-3">
                                        <strong>{{ $label }}:</strong> {{ $record->$key ?? '-' }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
