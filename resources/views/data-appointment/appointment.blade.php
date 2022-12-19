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
                                    <th>Status</th>
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
                                            <span
                                                class="badge bg-{{ $n->status == 'paid' ? 'primary' : 'warning' }}">{{ $n->status == 'paid' ? "$n->status : " . strtoupper($n->pembayaran) : $n->status }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('cetak_invoice') }}" class="btn btn-primary btn-sm"><i
                                                    class="bi bi-printer"></i></a>
                                            <a href="#" data-bs-toggle="modal" id_invoice="{{ $n->id_invoice }}"
                                                data-bs-target="#pay"
                                                class="btn btn-primary btn-sm pay pay{{ $n->no_order }}"
                                                no_order="{{ $n->no_order }}"><i class="bi bi-credit-card"></i></a>

                                            @php
                                                $order = DB::table('tb_order')
                                                    ->where('no_order', $n->no_order)
                                                    ->first();
                                                
                                                $jawaban = DB::selectOne("SELECT a.* FROM jawaban4 as a where a.no_order = '$n->no_order' group by a.no_order");
                                            @endphp
                                            @if (empty($order->no_order))
                                            @else
                                                @if (empty($jawaban->no_order))
                                                    <a href="{{ route('kpertanyaan', ['no_order' => $n->no_order, 'member_id' => $n->member_id]) }}"
                                                        class="btn btn-warning btn-sm"><i
                                                            class="bi bi-file-earmark-check"></i></a>
                                                @else
                                                    <a href="{{ route('cetak', ['no_order' => $n->no_order, 'member_id' => $n->member_id]) }}"
                                                        class="btn btn-warning btn-sm"><i class="bi bi-printer"></i></a>
                                                @endif
                                            @endif


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
    <form action="{{ route('save_status') }}" method="post">
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
                    <input type="hidden" id="id_invoice" name="id_invoice">
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
                                    <th>Pembayaran</th>
                                    <th>
                                        <select name="pembayaran" id="" class="form-control choices">
                                            <option value="">- Pilih pembayaran -</option>
                                            <option value="CASH">CASH</option>
                                            <option value="BCA">BCA</option>
                                            <option value="MANDIRI">MANDIRI</option>
                                        </select>
                                    </th>
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

            $(document).on('click', '.pay', function() {
                var id_invoice = $(this).attr('id_invoice')
                $("#id_invoice").val(id_invoice);
            })
        });
    </script>
@endsection
