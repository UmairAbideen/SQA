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
        <div class="row">
            <div class="col-12 pt-4">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Users Table</h6>
                        </div>
                    </div>

                    <div class="d-flex ms-2 pt-2">
                        <div class="p-2 pe-3 pt-4">
                            <a href="{{ route('admin.users.export') }}" class="btn bg-gradient-success" role="button"
                                aria-pressed="true">Export</a>
                        </div>
                        <form action="{{ route('admin.users.import') }}" method="post" enctype="multipart/form-data"
                            class="d-flex">
                            @csrf
                            <div class="align-self-center p-2 pt-4">
                                <input type="file" name="excel_file" class="btn btn-sm bg-gradient-secondary" required>
                            </div>
                            <div class="pe-3 pt-4">
                                <input type="submit" value="Import Excel" class="btn bg-gradient-success">
                            </div>
                        </form>
                        <div class="ms-auto p-2 pe-3 pt-4">
                            <a href="{{ route('admin.users.usersform') }}" class="btn bg-gradient-success" role="button"
                                aria-pressed="true">+
                                Add New</a>
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

                    <div class="card-body ps-3 pe-2 pb-5 pt-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            S. No.
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Name</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9 ps-2">
                                            Email</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Organization</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            SES No.</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Role</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Department</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Designation</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Approval</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Status</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions</th>
                                </thead>

                                <tbody>
                                    @foreach ($users as $item)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->username }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->email }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->org }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->ses_no }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->role }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->department }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->designation }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($item->approval))
                                                    Pending
                                                @else
                                                    {{ $item->approval }}
                                                @endif
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($item->status))
                                                    Pending
                                                @else
                                                    {{ $item->status }}
                                                @endif
                                            </td>


                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div>
                                                        <a href="{{ route('admin.users.single', $item->id) }}"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0" role="button"
                                                            aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="view">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">visibility</span>
                                                        </a>
                                                    </div>


                                                    <div>
                                                        <a href="{{ route('admin.users.edit', $item->id) }}"
                                                            class="btn bg-transparent btn-sm btn-tooltip m-0" role="button"
                                                            aria-pressed="true" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="update">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">update</span>
                                                        </a>
                                                    </div>


                                                    <div>
                                                        <button type="button" class="btn bg-transparent btn-sm m-0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-delete-{{ $item->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="delete">
                                                            <span class="material-icons"
                                                                style="font-size: 1.5rem;">delete</span>
                                                        </button>

                                                        <!-- Modal Structure -->
                                                        <div class="modal fade" id="modal-delete-{{ $item->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="modal-delete-{{ $item->id }}"
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
                                                                    <div class="modal-body">
                                                                        <p>Do you want to remove the user?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <!-- Yes Button with Tooltip -->
                                                                        <a href="{{ route('admin.users.delete', $item->id) }}"
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
    </div>
@endsection
