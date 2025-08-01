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
                            <h6 class="text-white text-capitalize ps-3">Add Component Certifying Staff</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('admin.training.view') }}" class="btn bg-gradient-success" role="button"
                                aria-pressed="true">Go Back</a>
                        </div>

                        <form class="px-3" action="{{ route('admin.component.store') }}" method="POST">
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
                                {{-- Staff --}}
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

                                {{-- Component Rating --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Component Rating</label>
                                        <input type="text" name="component_rating" class="form-control"
                                            value="{{ old('component_rating') }}">
                                        @error('component_rating')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- CMA No --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>CMA No</label>
                                        <input type="text" name="cma_no" class="form-control"
                                            value="{{ old('cma_no') }}">
                                        @error('cma_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Scope --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Scope</label>
                                        <textarea name="scope" rows="2" class="form-control">{{ old('scope') }}</textarea>
                                        @error('scope')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Limitation --}}
                                <div class="col-md-4 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Limitation</label>
                                        <textarea name="limitation" rows="2" class="form-control">{{ old('limitation') }}</textarea>
                                        @error('limitation')
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
