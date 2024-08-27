<!DOCTYPE html>
<html lang="en">
<head>
    @include('website.layout.head')
</head>
<body>
    <div class="content">
        @include('website.layout.nav')
        @yield('content')
        {{-- footer --}}
        @include('website.layout.footer')
    </div>
</body>
</html>
