@extends('director.layout.app')

@section('title')
    Training and Authorization
@endsection

@section('page-name')
    Training and Authorization akjsldjkh
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
                            <h6 class="text-white text-capitalize ps-3">Update Audit</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('director.training.view') }}" class="btn bg-gradient-success" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('director.staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
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
                                {{-- User Info (Readonly) --}}
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Name</label>
                                        <input type="text" class="form-control" value="{{ $staff->user->username }}"
                                            disabled>
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>SES No</label>
                                        <input type="text" class="form-control" value="{{ $staff->user->ses_no }}"
                                            disabled>
                                    </div>
                                </div>

                                {{-- Editable Fields --}}
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Authorization Type</label>
                                        <select name="auth_type" id="auth_type" class="form-control">
                                            <!-- Options populated via JavaScript -->
                                        </select>
                                        @error('auth_type')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Hidden input to store org type -->
                                <input type="hidden" id="org_type" value="{{ $staff->user->org }}">
                                <input type="hidden" id="selected_auth" value="{{ old('auth_type', $staff->auth_type) }}">


                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Authorization No</label>
                                        <input type="text" name="auth_no" class="form-control"
                                            value="{{ old('auth_no', $staff->auth_no) }}">
                                        @error('auth_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Function</label>
                                        <input type="text" name="function" class="form-control"
                                            value="{{ old('function', $staff->function) }}">
                                        @error('function')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Initial Issue Date</label>
                                        <input type="date" name="ini_issue_date" class="form-control"
                                            value="{{ old('ini_issue_date', $staff->ini_issue_date) }}">
                                        @error('ini_issue_date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <input type="file" name="user_image" class="btn btn-sm bg-gradient-secondary">
                                        @error('user_image')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Show current image preview --}}
                                    @if ($staff->user_image)
                                        <div class="mt-2">
                                            <p class="small text-muted mb-1">Current Image:</p>
                                            <img src="{{ asset('storage/' . $staff->user_image) }}" alt="User Image"
                                                class="img-thumbnail" style="width:120px; height:auto; border-radius:4px;">
                                        </div>
                                    @endif
                                </div>

                                {{-- Submit --}}
                                <div class="mt-3 px-3">
                                    <button type="submit" class="btn bg-gradient-success">Update</button>
                                    <a href="{{ route('director.training.view') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const authSelect = document.getElementById('auth_type');
            const orgType = document.getElementById('org_type').value?.trim().toUpperCase();
            const selectedAuth = document.getElementById('selected_auth').value;

            const authOptions = {
                'SES': [
                    'Aircraft Certifying Staff',
                    'Component Certifying Staff',
                    'Quality Auditor',
                    'Qualifying Mechanics',
                    'Store Quality Inspector',
                    'Authorized Standard Lab Personnel',
                    'Training Record - SES'
                ],
                'SA': [
                    'Authorized Auditor',
                    'Training Record - SA'
                ]
            };

            const options = authOptions[orgType] || [];

            options.forEach(auth => {
                const opt = document.createElement('option');
                opt.value = auth;
                opt.textContent = auth;
                if (auth === selectedAuth) {
                    opt.selected = true;
                }
                authSelect.appendChild(opt);
            });
        });
    </script>
@endsection
