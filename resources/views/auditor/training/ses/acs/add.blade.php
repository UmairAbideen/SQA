@extends('auditor.layout.app')

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
                            <a href="{{ route('auditor.training.view') }}" class="btn bg-gradient-success" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class="px-3" action="{{ route('auditor.aircraft.store') }}" method="POST">
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
                                {{-- Staff Name --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Staff</label>
                                        <select name="staff_id" class="form-control">
                                            <option value="">-- Select Staff --</option>
                                            @foreach ($staff as $s)
                                                <option value="{{ $s->id }}">
                                                    {{ $s->user->username ?? 'N/A' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('staff_id')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- AML No --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>AML No</label>
                                        <input type="text" name="aml_no" class="form-control"
                                            value="{{ old('aml_no') }}">
                                        @error('aml_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Aircraft --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Aircraft</label>
                                        <input type="text" name="aircraft" class="form-control"
                                            value="{{ old('aircraft') }}">
                                        @error('aircraft')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Category --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Category</label>
                                        <input type="text" name="cat" class="form-control"
                                            value="{{ old('cat') }}">
                                        @error('cat')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Scope --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Scope</label>
                                        <textarea name="scope" rows="1" class="form-control">{{ old('scope') }}</textarea>
                                        @error('scope')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                {{-- Privileges --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Privileges</label>
                                        <textarea name="privileges" rows="1" class="form-control">{{ old('privileges') }}</textarea>
                                        @error('privileges')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- AML Expiry --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>AML Expiry</label>
                                        <input type="date" name="aml_expiry" class="form-control"
                                            value="{{ old('aml_expiry') }}">
                                        @error('aml_expiry')
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
@endsection
