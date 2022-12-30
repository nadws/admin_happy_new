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
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Member ID</th>
                                        <th>Nama Pasien</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($data_paket_pasien as $n)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $n->member_id }}</td>
                                        <td>{{ $n->nama_pasien }}</td>
                                        <td>
                                            <span class="badge bg-{{ $n->saldo == NULL ? 'success' : 'danger' }}">
                                                {{ $n->saldo == NULL ? 'Ok' : 'Paket mau habis' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#view"
                                                class="btn btn-primary btn-sm view" member_id="{{$n->member_id}}"><i
                                                    class="bi bi-folder-check"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

</div>

<div class="modal fade text-left" id="view">
    <div class="modal-dialog  modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">
                    Data Paket
                </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="view_paket"></div>
            </div>
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>

<style>
    .modal-lg-max2 {
        max-width: 700px;
    }
</style>
<div class="modal fade text-left" id="view2">
    <div class="modal-dialog   modal-lg-max2" role="document">
        <div class="modal-content">
            <div id="view_paket2"></div>
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>





@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '.view', function() {
                var member_id = $(this).attr('member_id')
                $.ajax({
                    url: "{{ route('view_paket_pasien') }}?member_id=" + member_id,
                    type: "Get",
                    success: function(data) {
                        $('#view_paket').html(data);
                    }
                });
        });
        $(document).on('click', '.view2', function() {
                var member_id = $(this).attr('member_id');
                var id_paket = $(this).attr('id_paket');
                
                $.ajax({
                    url: "{{ route('view_paket_pasien2') }}?member_id=" + member_id + "&id_paket=" + id_paket,
                    type: "Get",
                    success: function(data) {
                        $('#view_paket2').html(data);
                        $('#view2').modal('show'); 
                    }
                });
            });

    });
</script>
@endsection