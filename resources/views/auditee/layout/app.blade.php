<!DOCTYPE html>
<html lang="en">

<head>
    @include('auditee.layout.common-head')
</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('auditee.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('auditee.layout.header')

        @yield('main-content')

        @include('auditee.layout.footer')

    </main>

    @include('auditee.layout.common-end')
</body>

</html>
