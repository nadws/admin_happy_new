<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('theme') }}/assets/css/main/app.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="{{ asset('theme') }}/assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('theme') }}/assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="{{ asset('theme') }}/assets/css/shared/iconly.css">
    @yield('styles')
</head>

<body>
    <div id="app">
        @include('theme.navbar')
        @yield('content')
        
    </div>
    <script src="{{ asset('theme') }}/assets/js/bootstrap.js"></script>
    <script src="{{ asset('theme') }}/assets/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="{{ asset('theme') }}/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('theme') }}/assets/js/pages/dashboard.js"></script>
    @yield('scripts')
</body>

</html>
