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
                            <h6 class="text-white text-capitalize ps-3">Add Staff</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('admin.training.view') }}" class="btn bg-gradient-success" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class="px-3" action="{{ route('admin.staff.create') }}" method="POST">
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
                                {{-- Name Dropdown --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Name</label>
                                        <select name="user_id" id="user_id" class="form-control">
                                            <option value="">-- Select User --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" data-ses="{{ $user->ses_no }}"
                                                    data-org="{{ $user->org }}">
                                                    {{ $user->username }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- SES No (Auto-filled, disabled) --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>SES No</label>
                                        <input type="text" id="ses_no" class="form-control" disabled>
                                    </div>
                                </div>


                                {{-- Organization (Auto-filled, disabled) --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Organization</label>
                                        <input type="text" id="org" class="form-control" disabled>
                                    </div>
                                </div>

                                {{-- Auth Type --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Auth Type</label>
                                        <select name="auth_type" id="auth_type" class="form-control">
                                            <option value="">-- Select Authorization --</option>
                                            {{-- Options will be populated via JS --}}
                                        </select>
                                        @error('auth_type')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                {{-- Auth No --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Auth No</label>
                                        <input type="text" name="auth_no" class="form-control"
                                            value="{{ old('auth_no') }}">
                                        @error('auth_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Function --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Function</label>
                                        <input type="text" name="function" class="form-control"
                                            value="{{ old('function') }}">
                                        @error('function')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Initial Issue Date --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Initial Issue Date</label>
                                        <input type="date" name="ini_issue_date" class="form-control"
                                            value="{{ old('ini_issue_date') }}">
                                        @error('ini_issue_date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Submit --}}
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

    {{-- JavaScript to update SES No --}}
    <script>
        document.getElementById('user_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const sesNo = selectedOption.getAttribute('data-ses');
            const org = selectedOption.getAttribute('data-org');

            document.getElementById('ses_no').value = sesNo || '';
            document.getElementById('org').value = org || '';
        });

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

        document.getElementById('user_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const sesNo = selectedOption.getAttribute('data-ses');
            const org = selectedOption.getAttribute('data-org');

            document.getElementById('ses_no').value = sesNo || '';
            document.getElementById('org').value = org || '';

            // Update auth_type dropdown
            const authSelect = document.getElementById('auth_type');
            authSelect.innerHTML = '<option value="">-- Select Authorization --</option>';

            if (org && authOptions[org]) {
                authOptions[org].forEach(function(auth) {
                    const option = document.createElement('option');
                    option.value = auth;
                    option.text = auth;
                    authSelect.appendChild(option);
                });
            }
        });
    </script>
@endsection
