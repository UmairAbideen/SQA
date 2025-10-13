<!DOCTYPE html>
<html lang="en">

<head>
    @include('director.layout.common-head')
</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('director.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('director.layout.header')

        @yield('main-content')

        @include('director.layout.footer')

    </main>

    @include('director.layout.common-end')
</body>

</html>
