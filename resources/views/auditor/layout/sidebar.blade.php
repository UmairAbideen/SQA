<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
    id="sidenav-main">

    <div class="sidenav-header d-flex justify-content-center mb-2">
        <a class="navbar-brand m-0" href="" target="_blank">
            <img src="/assets/img/logo-2.png" class="navbar-brand-img" alt="main_logo">
        </a>
    </div>

    <hr class="horizontal light mt-0 mb-3">

    <div class="collapse navbar-collapse w-auto d-flex flex-column justify-content-between" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white @yield('active-link-manuals')" href="{{ route('auditor.dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="nav-link-text ms-1">Manuals</span>
                    </div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white @yield('active-link-ramp')" href="{{ route('auditor.rampinspection.view') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="nav-link-text ms-1">Aircraft Inspection</span>
                    </div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white @yield('active-link-audit')" href="{{ route('auditor.audit.view') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="nav-link-text ms-1">Audit</span>
                    </div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white @yield('active-link-training')" href="{{ route('auditor.training.view') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="nav-link-text ms-1">Training and Authorization</span>
                    </div>
                </a>
            </li>
        </ul>

        <!-- Bottom user info -->
        @auth
            <div class="mt-auto px-3 pb-3 text-white" style="font-size: 0.9rem;">
                <p class="mb-0">Name: {{ Auth::user()->username }}</p>
                <p class="mb-0">Role: {{ Auth::user()->role }}</p>
                <p class="mb-0">Organization: {{ Auth::user()->org }}</p>
                <p class="mb-0">Designation: {{ Auth::user()->designation }}</p>
                <p class="mb-0">Department: {{ Auth::user()->department }}</p>

            </div>
        @endauth
    </div>

</aside>
