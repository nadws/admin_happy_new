@extends('theme.app')
@section('content')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $title }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Import </a> <p class="text-danger"></p></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                @foreach ($menu as $m)
                    
                <div class="col-6 col-lg-2 col-md-6">
                    <a href="{{route('exportUser')}}">
                        <div class="card">
                            <div class="card-body" style="height: 130px" >
                                <div class="row ">
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                        <i class="fa-solid fa-user fa-2x"></i>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                        <h6 class="text-muted font-semibold text-center">
                                           Tb User
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <center>
                                    <a href="{{route('exportUser')}}" class="btn btn-info export1" id="export1">import</a>
                                    <button class="btn btn-info save_loading1" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                </center>

                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>
        </section>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $('.save_loading1').hide();
        $(document).on('click', '#export1', function() {
            //   event.preventDefault();

            $('#export1').hide();
            $('.save_loading1').show();

        });
    });
</script>
@endsection