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
    <link rel="stylesheet" href="{{ asset('css') }}/jquery.skedTape.css">


    @yield('styles')
</head>
@php
    // $warna1 = DB::table('h1')->where('id_h1', 16)->first()->isi;
    // $warna2 = DB::table('h1')->where('id_h1', 17)->first()->isi;
    $warna1 = DB::table('cms_konten')
        ->where('id', 1)
        ->first()->isi;
    $warna2 = DB::table('cms_konten')
        ->where('id', 2)
        ->first()->isi;
    $warna3 = DB::table('cms_konten')
        ->where('id', 3)
        ->first()->isi;
    $warna4 = DB::table('cms_konten')
        ->where('id', 4)
        ->first()->isi;
@endphp
<style>
    .sked-tape__caption {
        background-color: "{{ $warna2 }}";
        color: #fffff;
    }

    .select2 {
        width: 100% !important;

    }
</style>
<style>
    a {
        text-decoration: none;
    }

    #multi-step-form-container {
        margin-top: 2rem;
    }



    .d-none {
        display: none;
    }

    .form-step {
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 20px;
        padding: 3rem;
        background: #fff
    }

    .font-normal {
        font-weight: normal;
    }

    ul.form-stepper {
        counter-reset: section;
        margin-bottom: 3rem;
    }

    ul.form-stepper .form-stepper-circle {
        position: relative;
    }

    ul.form-stepper .form-stepper-circle span {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateY(-50%) translateX(-50%);
    }

    .form-stepper-horizontal {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    ul.form-stepper>li:not(:last-of-type) {
        margin-bottom: 0.625rem;
        -webkit-transition: margin-bottom 0.4s;
        -o-transition: margin-bottom 0.4s;
        transition: margin-bottom 0.4s;
    }

    .form-stepper-horizontal>li:not(:last-of-type) {
        margin-bottom: 0 !important;
    }

    .form-stepper-horizontal li {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: start;
        -webkit-transition: 0.5s;
        transition: 0.5s;
    }

    .form-stepper-horizontal li:not(:last-child):after {
        position: relative;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        height: 1px;
        content: "";
        top: 32%;
    }

    .form-stepper-horizontal li:after {
        background-color: #dee2e6;
    }

    .form-stepper-horizontal li.form-stepper-completed:after {
        background-color: #68B984;
    }

    .form-stepper-horizontal li:last-child {
        flex: unset;
    }

    ul.form-stepper li a .form-stepper-circle {
        display: inline-block;
        width: 40px;
        height: 40px;
        margin-right: 0;
        line-height: 1.7rem;
        text-align: center;
        background: rgba(0, 0, 0, 0.38);
        border-radius: 50%;
    }

    .form-stepper .form-stepper-active .form-stepper-circle {
        background-color: <?=$warna3 ?> !important;
        color: #fff;
    }

    .form-stepper .form-stepper-active .label {
        color: <?=$warna3 ?> !important;
    }

    .form-stepper .form-stepper-active .form-stepper-circle:hover {
        background-color: <?=$warna3 ?> !important;
        color: #fff !important;
    }

    .form-stepper .form-stepper-unfinished .form-stepper-circle {
        background-color: #f8f7ff;
    }

    .form-stepper .form-stepper-completed .form-stepper-circle {
        color: #fff;
        background-color: <?=$warna4 ?> !important;
    }

    .form-stepper .form-stepper-completed .label {
        color: <?=$warna4 ?> !important;
    }

    .form-stepper .form-stepper-completed .form-stepper-circle:hover {
        color: #fff !important;
        background-color: <?=$warna4 ?> !important;
    }

    .form-stepper .form-stepper-active span.text-muted {
        color: #fff !important;
    }

    .form-stepper .form-stepper-completed span.text-muted {
        color: #fff !important;
    }

    .form-stepper .label {
        font-size: 1rem;
        margin-top: 0.5rem;
    }

    .form-stepper a {
        cursor: default;
    }
</style>

<body style="background-color: {{ $warna2 }}">
    <div id="app">
        @include('theme.navbar')
        @yield('content')

    </div>

    <script src="{{ asset('theme') }}/assets/js/bootstrap.js"></script>
    <script src="{{ asset('theme') }}/assets/js/app.js"></script>
    <script src="{{ asset('theme') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('js') }}/iziToast.min.js"></script>
    <script src="{{ asset('js') }}/jquery.skedTape.js"></script>

    <!-- Need: Apexcharts -->
    <script src="{{ asset('theme') }}/assets/js/pages/dashboard.js"></script>
    <script src="{{ asset('theme') }}/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="{{ asset('theme') }}/assets/js/pages/simple-datatables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="{{ asset('theme') }}/assets/js/pages/form-element-select.js"></script> --}}

    {{-- choice select2 --}}
    {{-- <script src="{{ asset('theme') }}/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="{{ asset('theme') }}/assets/js/pages/form-element-select.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
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
        $(document).on('change', '#warna1', function() {
            $('.card').css('background-color', $(this).val())
            $('.card-header').css('background-color', $(this).val())
            $('.sidebar-wrapper').css('background-color', $(this).val())
        })
        $(document).on('change', '#warna2', function() {
            $('body').css('background-color', $(this).val())
        })
        $(document).on('change', '#warna3', function() {
            $('.sidebar-item.active>.sidebar-link').css('background-color', $(this).val())
            $('.btn-primary').css('--bs-btn-bg', $(this).val())
        })
        $(document).on('change', '#warna4', function() {
            $('.btn-warning').css('--bs-btn-bg', $(this).val())
        })
    </script>
    @yield('scripts')
</body>

</html>
