@extends('admin.layout.app')

@section('title')
    Users
@endsection

@section('page-name')
    Users
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
                            <h6 class="text-white text-capitalize ps-3">View User</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('admin.users.view') }}" class="btn bg-gradient-success" role="button"
                                aria-pressed="true">Go
                                Back</a>
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

                        <div class="card-body ps-3 pe-2 pb-3 pt-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                                Name</th>
                                            <th class="text-center text-secondary small font-weight-bolder opacity-9 ps-2">
                                                Email</th>
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
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $user->username }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $user->email }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $user->role }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $user->department }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $user->designation }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($user->approval))
                                                    Pending
                                                @else
                                                    {{ $user->approval }}
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($user->status))
                                                    Pending
                                                @else
                                                    {{ $user->status }}
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">

                                                    <form action="{{ route('admin.users.approve', $user->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @if ($user->approval === 'approved')
                                                            <input type="submit" value="Approve"
                                                                class="btn bg-gradient-success disabled btn-sm mb-0 ms-1 me-1">
                                                        @else
                                                            <input type="submit" value="Approve"
                                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1">
                                                        @endif
                                                    </form>

                                                    <form action="{{ route('admin.users.disapprove', $user->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @if ($user->approval === 'approved')
                                                            <input type="submit" value="Dis-Approve"
                                                                class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1">
                                                        @else
                                                            <input type="submit" value="Dis-Approve"
                                                                class="btn bg-gradient-secondary disabled btn-sm mb-0 ms-1 me-1">
                                                        @endif
                                                    </form>

                                                    <form action="{{ route('admin.users.active', $user->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @if ($user->status === 'active')
                                                            <input type="submit" value="active"
                                                                class="btn bg-gradient-success disabled btn-sm mb-0 ms-1 me-1">
                                                        @else
                                                            <input type="submit" value="active"
                                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1">
                                                        @endif
                                                    </form>

                                                    <form action="{{ route('admin.users.deactive', $user->id) }}"
                                                        method="post">
                                                        @csrf

                                                        @if ($user->status === 'deactive')
                                                            <input type="submit" value="De-Active"
                                                                class="btn bg-gradient-secondary disabled btn-sm mb-0 ms-1 me-1">
                                                        @else
                                                            <input type="submit" value="De-Active"
                                                                class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1">
                                                        @endif
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
