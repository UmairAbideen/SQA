<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">

        <nav aria-label="breadcrumb">
            <h6 class="font-weight-bolder mb-0">@yield('page-name')</h6>
        </nav>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

            <ul class="navbar-nav  justify-content-end ms-2 ms-md-auto pe-md-3 d-flex align-items-center">

                <li class="nav-item d-xl-none p-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>


                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('logout') }}" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-power-off me-sm-1"></i>
                        <span class="d-sm-inline d-none">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
