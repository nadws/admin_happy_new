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
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <a href="#" id="sukses" class="btn icon icon-left btn-primary" style="float: right;"><i
                                class="bi bi-cloud-arrow-down-fill"></i>
                            Import</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Member ID</th>
                                    <th>No Order</th>
                                    <th>Nama Pasien</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($invoice as $n)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ date('d-m-Y', strtotime($n->tgl)) }}</td>
                                        <td>{{ $n->member_id }}</td>
                                        <td>{{ $n->no_order }}</td>
                                        <td>{{ $n->nama_pasien }}</td>
                                        <td>
                                            <a href="{{ route('cetak_invoice') }}" class="btn btn-success btn-sm"><i
                                                    class="bi bi-printer"></i></a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#pay"
                                                class="btn btn-info btn-sm pay pay{{ $n->no_order }}"
                                                no_order="{{ $n->no_order }}"><i class="bi bi-credit-card"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

    </div>

    {{-- form tambah --}}
    <form action="" method="post">
        @csrf
        <div class="modal fade text-left" id="pay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">
                            Pembayaran Screening
                        </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row text-center">
                            <h5>--Product--</h5>
                            <table width="100%" class="table">
                                <tr>
                                    <td style="text-align: left">Appointment</td>
                                    <td style="text-align: right">200,000</td>
                                </tr>
                            </table>
                            <table width="100%" class="table">
                                <tr>
                                    <th>Cash</th>
                                    <th><input type="text" class="form-control"></th>
                                </tr>

                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Save</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>
    {{-- form tambah --}}
    <div class="modal fade text-left" id="view_member" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div id="load_view_member"></div>


            </div>
        </div>
    </div>


    {{-- form edit --}}
    <div class="modal fade text-left" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Edit Form
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <label>Email: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Email Address" class="form-control" />
                        </div>
                        <label>Password: </label>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.pilihan').hide();
            $('.pilihan').attr('disabled', 'true');

            $(document).on('change', '.select-pilihan', function() {
                var id_pilihan = $(this).val();

                if (id_pilihan == '1') {
                    $('.input_manual').show();
                    $('.input_manual').removeAttr('disabled', 'true');
                    $('.dari_customer').hide();
                    $('.dari_customer').attr('disabled', 'true');
                } else {
                    $('.dari_customer').show();
                    $('.dari_customer').removeAttr('disabled', 'true');
                    $('.input_manual').hide();
                    $('.input_manual').attr('disabled', 'true');
                }
            })
        });
    </script>
@endsection
