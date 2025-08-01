@extends('admin.layout.app')

@section('title')
    Users
@endsection

@section('page-name')
    User Management
@endsection

@section('active-link-users')
    active bg-gradient-success
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row pt-4">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Update User</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('admin.users.view') }}" class="btn bg-gradient-success" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('admin.users.update', $user->id) }}" method="post">
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
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Name</label>
                                        <input type="text" name="username" class="form-control"
                                            value="{{ old('username', $user->username) }}">
                                        @error('username')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ old('email', $user->email) }}">
                                        @error('email')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control"
                                            value="{{ old('password', $user->password) }}">
                                        @error('password')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Organization</label>
                                        <input type="text" name="org" class="form-control"
                                            value="{{ old('org', $user->org ?? '') }}">
                                        @error('org')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>SES No</label>
                                        <input type="text" name="ses_no" class="form-control"
                                            value="{{ old('ses_no', $user->ses_no ?? '') }}">
                                        @error('ses_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label class="ms-0">Department</label>
                                        <input type="text" name="department" class="form-control"
                                            value="{{ old('department', $user->department) }}">
                                        @error('department')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Designation</label>
                                        <input type="text" name="designation" class="form-control"
                                            value="{{ old('designation', $user->designation) }}">
                                        @error('designation')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label class="ms-0">Role</label>
                                        <select class="form-control ps-1" name="role">
                                            <option value="QA Chief"
                                                {{ old('role', $user->role) == 'QA Chief' ? 'selected' : '' }}>QA Chief
                                            </option>
                                            <option value="QA Staff"
                                                {{ old('role', $user->role) == 'QA Staff' ? 'selected' : '' }}>QA Staff
                                            </option>
                                            <option value="HOD"
                                                {{ old('role', $user->role) == 'HOD' ? 'selected' : '' }}>HOD
                                            </option>
                                            <option value="DS"
                                                {{ old('role', $user->role) == 'DS' ? 'selected' : '' }}>DS
                                            </option>
                                        </select>
                                        @error('role')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-3">
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
