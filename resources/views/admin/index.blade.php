<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layout.head')
</head>
<body>
    <div class="container-scroller">
        @include('admin.layout.nav')
        <div class="container-fluid page-body-wrapper">
            @include('admin.layout.right-sidebar')
            @include('admin.layout.sidebar')
            @yield('content')
        </div>
        @include('admin.layout.footer')
    </div>
</body>
</html>
