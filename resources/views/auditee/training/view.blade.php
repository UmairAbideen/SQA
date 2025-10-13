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
                            <h6 class="text-white text-capitalize ps-3">Training and Authorization</h6>
                        </div>
                    </div>


                    <div class="card-body ps-3 pe-2 pb-5 pt-5">
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
                                                        <a href="{{ route('auditee.training.acs.single', $staff->aircraftCert->id) }}"
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
                                                        <a href="{{ route('auditee.training.ccs.single', $staff->componentCert->id) }}"
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
                                                        <a href="{{ route('auditee.training.quality.single', $staff->qualityAuditor->id) }}"
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
                                                        <a href="{{ route('auditee.training.qm.single', $staff->qualifyingMechanic->id) }}"
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
                                                        <a href="{{ route('auditee.training.store_inspector.single', $staff->storeInspector->id) }}"
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
                                                        <a href="{{ route('auditee.training.standard_lab.single', $staff->labPersonnel->id) }}"
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
                                                        <a href="{{ route('auditee.training.training_ses.single', $staff->trainingSes->id) }}"
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
                                                        <a href="{{ route('auditee.auditor.single', $staff->auditor->id) }}"
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
                                                        <a href="{{ route('auditee.training_sa.single', $staff->trainingSa->id) }}"
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
