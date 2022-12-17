<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Happy Kids</title>

    <link rel="stylesheet" href="{{ asset('theme') }}/assets/css/main/app.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="{{ asset('theme') }}/assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('theme') }}/assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="{{ asset('theme') }}/assets/css/shared/iconly.css">

    <link rel="stylesheet" href="{{ asset('theme') }}/assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/assets/css/pages/simple-datatables.css">
    <link rel="stylesheet" href="{{ asset('css') }}/iziToast.min.css">
    @yield('styles')
</head>
@php
    // $warna1 = DB::table('h1')->where('id_h1', 16)->first()->isi;
    // $warna2 = DB::table('h1')->where('id_h1', 17)->first()->isi;
    $warna1 = DB::table('cms_konten')->where('id',1)->first()->isi;
    $warna2 = DB::table('cms_konten')->where('id',2)->first()->isi;
    $warna3 = DB::table('cms_konten')->where('id',3)->first()->isi;
    $warna4 = DB::table('cms_konten')->where('id',4)->first()->isi;
@endphp

<body style="background-color: {{$warna2}}">
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

    {{-- <script src="{{ asset('theme') }}/assets/js/pages/form-element-select.js"></script> --}}

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
    <script>
        $(document).on('change', '#warna1', function(){
            $('.card').css('background-color', $(this).val())
            $('.card-header').css('background-color', $(this).val())
            $('.sidebar-wrapper').css('background-color', $(this).val())
        })
        $(document).on('change', '#warna2', function(){
            $('body').css('background-color', $(this).val())
        })
        $(document).on('change', '#warna3', function(){
            $('.sidebar-item.active>.sidebar-link').css('background-color', $(this).val())
            $('.btn-primary').css('--bs-btn-bg', $(this).val())
        })
        $(document).on('change', '#warna4', function(){
            $('.btn-warning').css('--bs-btn-bg', $(this).val())
        })
    </script>
    @yield('scripts')
</body>

</html>
