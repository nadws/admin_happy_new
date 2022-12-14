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

    <link rel="stylesheet" href="{{ asset('theme') }}/assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/assets/css/pages/simple-datatables.css">
    <link rel="stylesheet" href="{{ asset('css') }}/iziToast.min.css">


    {{-- css select2 choices --}}
    <link rel="stylesheet" href="{{ asset('theme') }}/assets/extensions/choices.js/public/assets/styles/choices.css" />


    @yield('styles')
</head>

<body>
    <div id="app">
        @include('theme.navbar')
        @yield('content')

    </div>
    <script src="{{ asset('theme') }}/assets/js/bootstrap.js"></script>
    <script src="{{ asset('theme') }}/assets/js/app.js"></script>
    <script src="{{ asset('theme') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('js') }}/iziToast.min.js"></script>

    <!-- Need: Apexcharts -->
    <script src="{{ asset('theme') }}/assets/js/pages/dashboard.js"></script>
    <script src="{{ asset('theme') }}/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="{{ asset('theme') }}/assets/js/pages/simple-datatables.js"></script>
    {{-- <script src="{{ asset('theme') }}/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="{{ asset('theme') }}/assets/js/pages/form-element-select.js"></script> --}}

    {{-- choice select2 --}}
    {{-- <script src="{{ asset('theme') }}/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="{{ asset('theme') }}/assets/js/pages/form-element-select.js"></script> --}}

    @if (session()->has('sukses'))
        <script>
            $(document).ready(function() {
                iziToast.success({
                    title: 'Sukses !',
                    message: "{{ session()->get('sukses') }}",
                    position: 'topRight'
                });
            });
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            $(document).ready(function() {
                iziToast.error({
                    title: 'ERROR !',
                    message: "{{ session()->get('error') }}",
                    position: 'topRight'
                });
            });
        </script>
    @endif

    @yield('scripts')
</body>

</html>
