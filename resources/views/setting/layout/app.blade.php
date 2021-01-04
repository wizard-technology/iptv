<!DOCTYPE html>
<html lang="en">
    @include('setting.layout.head')

<body class="">
    <div class="wrapper">
        @include('setting.layout.sidebar')
        <div class="main-panel">
            <!-- Navbar -->
        @include('setting.layout.nav')
            @yield('content')
        </div>
    </div>
    @include('setting.layout.script')

</body>

</html>