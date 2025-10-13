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
                            <h6 class="text-white text-capitalize ps-3">Training and Authorization</h6>
                        </div>
                    </div>

                    <div class="container-fluid pt-4 pb-0">
                        <div class="d-flex flex-wrap align-items-start justify-content-between">

                            <!-- Left: Centered Buttons Group -->
                            <div class="d-flex flex-grow-1 justify-content-center gap-2 flex-wrap ps-3">
                                <!-- Staff -->
                                <a class="btn bg-gradient-success btn-sm" href="{{ route('auditor.staff.form') }}">
                                    + Staff
                                </a>

                                <!-- SES Dropdown -->
                                <div class="dropdown">
                                    <a class="btn bg-gradient-success btn-sm px-4" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        + SES <i class="bi bi-caret-down-fill"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('auditor.aircraft.create') }}">Add
                                                Aircraft Certifying Staff</a></li>
                                        <li><a class="dropdown-item" href="{{ route('auditor.component.create') }}">Add
                                                Component Certifying Staff</a></li>
                                        <li><a class="dropdown-item" href="{{ route('auditor.quality.create') }}">Add
                                                Quality Auditor</a></li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('auditor.qualifiedmechanic.create') }}">Add Qualifying
                                                Mechanics</a></li>
                                        <li><a class="dropdown-item" href="{{ route('auditor.store_inspector.create') }}">Add
                                                Store Quality
                                                Inspector</a></li>
                                        <li><a class="dropdown-item" href="{{ route('auditor.standard_lab.create') }}">Add
                                                Standard Lab Personnel</a></li>
                                        <li><a class="dropdown-item" href="{{ route('auditor.training_ses.create') }}">Add
                                                Training Record - SES</a></li>
                                    </ul>
                                </div>

                                <!-- SA Dropdown -->
                                <div class="dropdown">
                                    <a class="btn bg-gradient-success btn-sm px-4" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        + SA <i class="bi bi-caret-down-fill"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('auditor.auditor.create') }}">Add
                                                Authorized Auditor</a></li>
                                        <li><a class="dropdown-item" href="{{ route('auditor.training_sa.create') }}">Add
                                                Training Record - SA</a></li>
                                    </ul>
                                </div>
                            </div>


                            <!-- Right: Import Button -->
                            <div class="pt-1 d-flex justify-content-center justify-content-md-end w-100 w-md-auto">
                                <button type="button" class="btn bg-gradient-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modal-import-staff" title="Import Staff & SES">
                                    Import Excel
                                </button>
                            </div>
                        </div>

                        <!-- Import Modal -->
                        <div class="modal fade" id="modal-import-staff" tabindex="-1" role="dialog"
                            aria-labelledby="modal-import-staff" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title font-weight-normal" id="modal-title-import">Import Excel
                                            Files</h6>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <p>Select Excel file to import:</p>

                                        <!-- Scrollable Container if needed -->
                                        <div class="overflow-auto" style="max-height: 60vh; padding-right: 5px;">

                                            <!-- Repeat for each table below -->

                                            @php
                                                $imports = [
                                                    ['label' => 'Staff', 'route' => 'auditor.staff.import'],
                                                    [
                                                        'label' => 'Aircraft Certifying Staff',
                                                        'route' => 'auditor.aircraft.import',
                                                    ],
                                                    [
                                                        'label' => 'Component Certifying Staff',
                                                        'route' => 'auditor.component.import',
                                                    ],
                                                    [
                                                        'label' => 'Quality Auditors',
                                                        'route' => 'auditor.quality.import',
                                                    ],
                                                    [
                                                        'label' => 'Qualifying Mechanics',
                                                        'route' => 'auditor.qm.import',
                                                    ],
                                                    [
                                                        'label' => 'Store Quality Inspectors',
                                                        'route' => 'auditor.storeinspector.import',
                                                    ],
                                                    [
                                                        'label' => 'Standard Lab Personnel',
                                                        'route' => 'auditor.standard_lab.import',
                                                    ],
                                                    [
                                                        'label' => 'Training Record SES',
                                                        'route' => 'auditor.training_ses.import',
                                                    ],
                                                    [
                                                        'label' => 'Authorized Auditors',
                                                        'route' => 'auditor.auditor.import',
                                                    ],
                                                    [
                                                        'label' => 'Training Record SA',
                                                        'route' => 'auditor.training_sa.import',
                                                    ],
                                                ];
                                            @endphp

                                            @foreach ($imports as $import)
                                                <form action="{{ route($import['route']) }}" method="post"
                                                    enctype="multipart/form-data" class="mb-3">
                                                    @csrf
                                                    <label
                                                        class="form-label mb-1"><strong>{{ $import['label'] }}</strong></label>
                                                    <div class="align-self-center p-2 pt-4">
                                                        <input type="file" name="excel_file"
                                                            class="btn btn-sm bg-gradient-secondary" required>
                                                        <button type="submit"
                                                            class="btn bg-gradient-success">Import</button>
                                                    </div>
                                                </form>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light btn-sm"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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

                    <div class="pt-3">
                        <h3 class="text-center text-secondary">Search Staff</h3>
                        <form method="GET" action="" class="row justify-content-center mb-4">

                            {{-- Name --}}
                            <div class="col-md-2 px-3">
                                <div class="input-group input-group-static mb-4">
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Name" value="{{ request('name') }}">
                                </div>
                            </div>

                            {{-- SES No --}}
                            <div class="col-md-2 px-3">
                                <div class="input-group input-group-static mb-4">
                                    <input type="text" name="ses_no" id="ses_no" class="form-control"
                                        placeholder="SES No" value="{{ request('ses_no') }}">
                                </div>
                            </div>

                            {{-- Org --}}
                            <div class="col-md-2 px-3">
                                <div class="input-group input-group-static mb-4">
                                    <select name="org" id="org" class="form-control ps-1"
                                        onchange="filterAuthTypes()">
                                        <option value="" {{ request('org') ? '' : 'selected' }}>Select Org</option>
                                        <option value="SA" {{ request('org') == 'SA' ? 'selected' : '' }}>SA</option>
                                        <option value="SES" {{ request('org') == 'SES' ? 'selected' : '' }}>SES
                                        </option>
                                    </select>
                                </div>
                            </div>

                            {{-- Auth Type --}}
                            <div class="col-md-2 px-3">
                                <div class="input-group input-group-static mb-4">
                                    <select name="auth_type" id="auth_type" class="form-control ps-1">
                                        <option value="">Select Authorization Type</option>
                                    </select>
                                </div>
                            </div>


                            {{-- Buttons --}}
                            <div class="col-12 d-flex justify-content-center gap-3">
                                <button type="submit" class="btn bg-gradient-success btn-sm">Search</button>
                                <a href="{{ url()->current() }}" class="btn bg-gradient-secondary btn-sm">Refresh</a>
                            </div>
                        </form>
                    </div>


                    <div class="card-body ps-3 pe-2 pb-5 pt-0">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">S No.
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Name
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Org.
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">SES No
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Auth
                                            Type
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Auth
                                            No
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Function
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Initial
                                            Issue Date</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allStaff as $staff)
                                        <tr>
                                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $staff->user->username ?? '-' }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $staff->user->org ?? '-' }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $staff->user->ses_no ?? '-' }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{-- Aircraft Certifying Staff --}}
                                                @if ($staff->aircraftCert && $staff->aircraftCert->id)
                                                    <div>
                                                        <a href="{{ route('auditor.training.acs.single', $staff->aircraftCert->id) }}"
                                                            class="text-primary text-decoration-underline">
                                                            Aircraft Certifying Staff
                                                        </a>
                                                    </div>
                                                @elseif($staff->auth_type == 'Aircraft Certifying Staff')
                                                    <div>
                                                        Aircraft Certifying Staff
                                                    </div>
                                                @endif

                                                {{-- Component Certifying Staff --}}
                                                @if ($staff->componentCert && $staff->componentCert->id)
                                                    <div>
                                                        <a href="{{ route('auditor.training.ccs.single', $staff->componentCert->id) }}"
                                                            class="text-primary text-decoration-underline">
                                                            Component Certifying Staff
                                                        </a>
                                                    </div>
                                                @elseif($staff->auth_type == 'Component Certifying Staff')
                                                    <div>
                                                        Component Certifying Staff
                                                    </div>
                                                @endif

                                                {{-- Quality Auditor --}}
                                                @if ($staff->qualityAuditor && $staff->qualityAuditor->id)
                                                    <div>
                                                        <a href="{{ route('auditor.training.quality.single', $staff->qualityAuditor->id) }}"
                                                            class="text-primary text-decoration-underline">
                                                            Quality Auditor
                                                        </a>
                                                    </div>
                                                @elseif($staff->auth_type == 'Quality Auditor')
                                                    <div>
                                                        Quality Auditor
                                                    </div>
                                                @endif

                                                {{-- Qualifying Mechanics --}}
                                                @if ($staff->qualifyingMechanic && $staff->qualifyingMechanic->id)
                                                    <div>
                                                        <a href="{{ route('auditor.training.qm.single', $staff->qualifyingMechanic->id) }}"
                                                            class="text-primary text-decoration-underline">
                                                            Qualifying Mechanics
                                                        </a>
                                                    </div>
                                                @elseif($staff->auth_type == 'Qualifying Mechanics')
                                                    <div>
                                                        Qualifying Mechanics
                                                    </div>
                                                @endif

                                                {{-- Store Quality Inspector  --}}
                                                @if ($staff->storeInspector && $staff->storeInspector->id)
                                                    <div>
                                                        <a href="{{ route('auditor.training.store_inspector.single', $staff->storeInspector->id) }}"
                                                            class="text-primary text-decoration-underline">
                                                            Store Quality Inspector
                                                        </a>
                                                    </div>
                                                @elseif($staff->auth_type == 'Store Quality Inspector')
                                                    <div>
                                                        Store Quality Inspector
                                                    </div>
                                                @endif

                                                {{-- Authorized Standard Lab Personnel  --}}
                                                @if ($staff->labPersonnel && $staff->labPersonnel->id)
                                                    <div>
                                                        <a href="{{ route('auditor.training.standard_lab.single', $staff->labPersonnel->id) }}"
                                                            class="text-primary text-decoration-underline">
                                                            Authorized Standard Lab Personnel
                                                        </a>
                                                    </div>
                                                @elseif($staff->auth_type == 'Authorized Standard Lab Personnel')
                                                    <div>
                                                        Authorized Standard Lab Personnel
                                                    </div>
                                                @endif

                                                {{-- Training Record - SES --}}
                                                @if ($staff->trainingSes && $staff->trainingSes->id)
                                                    <div>
                                                        <a href="{{ route('auditor.training.training_ses.single', $staff->trainingSes->id) }}"
                                                            class="text-primary text-decoration-underline">
                                                            Training Record - SES
                                                        </a>
                                                    </div>
                                                @elseif($staff->auth_type == 'Training Record - SES')
                                                    <div>
                                                        TRAINING RECORD - SES
                                                    </div>
                                                @endif

                                                {{-- Authorized Auditor --}}
                                                @if ($staff->auditor && $staff->auditor->id)
                                                    <div>
                                                        <a href="{{ route('auditor.auditor.single', $staff->auditor->id) }}"
                                                            class="text-primary text-decoration-underline">
                                                            Authorized Auditor
                                                        </a>
                                                    </div>
                                                @elseif($staff->auth_type == 'Authorized Auditor')
                                                    <div>
                                                        Authorized Auditor
                                                    </div>
                                                @endif

                                                {{-- Training Record - SA --}}
                                                @if ($staff->trainingSa && $staff->trainingSa->id)
                                                    <div>
                                                        <a href="{{ route('auditor.training_sa.single', $staff->trainingSa->id) }}"
                                                            class="text-primary text-decoration-underline">
                                                            Training Record - SA
                                                        </a>
                                                    </div>
                                                @elseif($staff->auth_type == 'Training Record - SA')
                                                    <div>
                                                        TRAINING RECORD - SA
                                                    </div>
                                                @endif
                                            </td>



                                            <td class="align-middle text-center text-sm">{{ $staff->auth_no }}</td>
                                            <td class="align-middle text-center text-sm">{{ $staff->function ?? '-' }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $staff->ini_issue_date ? \Carbon\Carbon::parse($staff->ini_issue_date)->format('d/m/Y') : '-' }}
                                            </td>
                                            <td class="align-middle text-center text-sm">


                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ route('auditor.staff.edit', $staff->id) }}"
                                                        class="btn bg-transparent btn-sm btn-tooltip m-0" role="button"
                                                        data-bs-toggle="tooltip" title="Edit">
                                                        <span class="material-icons"
                                                            style="font-size: 1.5rem;">edit</span>
                                                    </a>

                                                    <div>
                                                        <button type="button" class="btn bg-transparent btn-sm m-0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-delete-{{ $staff->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="delete">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">delete</span>
                                                        </button>

                                                        <!-- Modal Structure -->
                                                        <div class="modal fade" id="modal-delete-{{ $staff->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="modal-delete-{{ $staff->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h6 class="modal-title font-weight-normal"
                                                                            id="modal-title-default">User Deletion</h6>
                                                                        <button type="button" class="btn-close text-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body  text-break">
                                                                        <p>Do you want to remove this
                                                                            authorization
                                                                            for <br><strong>{{ $staff->user->username }}</strong>?
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <!-- Yes Button with Tooltip -->
                                                                        <a href="{{ route('auditor.staff.delete', $staff->id) }}"
                                                                            class="btn btn-secondary btn-sm mb-0 ms-1 me-1"
                                                                            role="button" aria-pressed="true"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="top"
                                                                            title="Confirm deletion">Yes</a>

                                                                        <!-- No Button inside Modal -->
                                                                        <button type="button"
                                                                            class="btn btn-light btn-sm mb-0 ms-1 me-1"
                                                                            data-bs-dismiss="modal"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="top"
                                                                            title="Cancel deletion">No</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "responsive": true,
                });
            });

            $(document).ready(function() {
                var table = $('#myTable').DataTable();

                // Add Bootstrap spacing classes
                $('#myTable_length').addClass('mt-0 mb-2 ms-2'); // entries
                $('#myTable_filter').addClass('mt-0 mb-2 me-2'); // Search box
                $('#myTable_paginate').addClass('mt-3 me-2'); // Pagination
                $('#myTable_info').addClass('mt-3 ms-3'); // Info text
            });


            const authTypes = {
                'SA': [
                    'Authorized Auditor',
                    'Training Record - SA'
                ],
                'SES': [
                    'Aircraft Certifying Staff',
                    'Component Certifying Staff',
                    'Quality Auditor',
                    'Qualifying Mechanics',
                    'Store Quality Inspector',
                    'Authorized Standard Lab Personnel',
                    'Training Record - SES'
                ]
            };

            function filterAuthTypes() {
                const org = document.getElementById('org').value;
                const authSelect = document.getElementById('auth_type');
                const selectedValue = "{{ request('auth_type') }}";

                // Clear previous options
                authSelect.innerHTML = '<option value="">Select Authorization Type</option>';

                if (authTypes[org]) {
                    authTypes[org].forEach(type => {
                        const option = document.createElement('option');
                        option.value = type;
                        option.text = type;
                        if (type === selectedValue) option.selected = true;
                        authSelect.appendChild(option);
                    });
                }
            }

            // Initialize on page load
            document.addEventListener('DOMContentLoaded', filterAuthTypes);
        </script>
    </div>
@endsection
