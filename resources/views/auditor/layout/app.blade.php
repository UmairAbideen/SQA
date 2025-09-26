<!DOCTYPE html>
<html lang="en">

<head>
    @include('auditor.layout.common-head')
</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('auditor.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('auditor.layout.header')

        @yield('main-content')

        @include('auditor.layout.footer')

    </main>

    @include('auditor.layout.common-end')
</body>

</html>
