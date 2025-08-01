<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.Layout.common-head')
</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('admin.Layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('admin.Layout.header')

        @yield('main-content')

        @include('admin.Layout.footer')

    </main>

    @include('admin.Layout.common-end')
</body>

</html>
