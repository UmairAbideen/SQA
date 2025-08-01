@extends('admin.layout.app')

@section('title')
    Aircraft Inspection
@endsection

@section('page-name')
    Aircraft Inspection
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
                            <h6 class="text-white text-capitalize ps-3">Update Aircraft Inspection</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('admin.rampinspection.view') }}" class="btn bg-gradient-success" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('admin.rampinspection.update', $rampinspection->id) }}"
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
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Date</label>
                                        <input type="date" name="date" class="form-control"
                                            value="{{ $rampinspection->date }}">
                                        @error('date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Inspection Time</label>
                                        <input type="time" name="inspection_time" class="form-control"
                                            value="{{ $rampinspection->inspection_time }}">
                                        @error('inspection_time')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Aircraft Registration</label>
                                        <input type="text" name="aircraft_reg" class="form-control"
                                            value="{{ $rampinspection->aircraft_reg }}">
                                        @error('aircraft_reg')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Aircraft Type</label>
                                        <input type="text" name="aircraft_type" class="form-control"
                                            value="{{ $rampinspection->aircraft_type }}">
                                        @error('aircraft_type')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Arrival Station</label>
                                        <input type="text" name="arrival_station" class="form-control"
                                            value="{{ $rampinspection->arrival_station }}">
                                        @error('arrival_station')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Destination</label>
                                        <input type="text" name="destination" class="form-control"
                                            value="{{ $rampinspection->destination }}">
                                        @error('destination')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Flight Number</label>
                                        <input type="text" name="flight_no" class="form-control"
                                            value="{{ $rampinspection->flight_no }}">
                                        @error('flight_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Bay Number</label>
                                        <input type="text" name="bay_no" class="form-control"
                                            value="{{ $rampinspection->bay_no }}">
                                        @error('bay_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Inspection Reference Number</label>
                                        <input type="text" name="inspection_ref_no" class="form-control"
                                            value="{{ $rampinspection->inspection_ref_no }}">
                                        @error('inspection_ref_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Inspection Type</label>
                                        <input type="text" name="inspection_type" class="form-control"
                                            value="{{ $rampinspection->inspection_type }}">
                                        @error('inspection_type')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Inspector</label>
                                        <input type="text" name="inspector" class="form-control"
                                            value="{{ $rampinspection->inspector }}">
                                        @error('inspector')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Status</label>
                                        <input type="text" name="status" class="form-control"
                                            value="{{ $rampinspection->status }}">
                                        @error('status')
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
