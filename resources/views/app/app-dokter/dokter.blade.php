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
                    <div class="col-12 col-md-8 order-md-1 order-last">
                        <h3>{{ $title }} | Tanggal : {{ date('d-M-Y', strtotime($tgl)) }}</h3>
                    </div>
                    <div class="col-12 col-md-4 order-md-2 order-first">
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
                        <a style="margin-right: 5px;" href="#" data-bs-toggle="modal" data-bs-target="#view-tgl" class="btn icon icon-left btn-primary"><i
                                class="bi bi-calendar-check"></i>
                            View Tgl lain</a>
                        <a style="margin-right: 5px;" href="#" data-bs-toggle="modal" data-bs-target="#plus-appointment" class="btn icon btn-primary"><i
                            class="bi bi-plus"></i>
                            Appointment</a>
                    </div>
                    <div class="card-body">
                      <div id="sked2"></div>
                    </div>
                </div>
            </section>
        </div>

    </div>

    
    {{-- form view tanggal  --}}
    <form action="" method="post">
        @csrf
        <div class="modal fade text-left" id="view-tgl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">
                            View Tanggal
                        </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" name="view_tgl" class="form-control">
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
    {{-- form view tanggal  --}}

    {{-- plus app --}}
    <form action="" method="post">
        @csrf
        <div class="modal fade text-left" id="plus-appointment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">
                            Tambah Appointment
                        </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">Customer</label>
                                    <select name="customer" id="" class="form-control select2">
                                        <option value="">- Pilih Costumer -</option>
                                        @foreach ($invoice as $i)
                                            <option value="{{ $i->id_invoice }}">{{ $i->nama_pasien }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">Dokter</label>
                                    <input type="text" name="example" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Jam</label>
                                    <input type="time" name="example" class="form-control">
                                </div>
                            </div>
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
    {{-- end plus app --}}

@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        
        var locations = <?= $datas; ?>;
            var events = [
                {
                    name: 'Meeting',
                    location: '1',
                    start: today(10, 0),
                    end: today(11, 30)
                },
                {
                    name: 'Meeting with custom class',
                    location: '2',
                    start: yesterday(22, 0),
                    end: today(1, 30),
                    class: 'custom-class'
                },
                {
                    name: 'Meeting just after the previous one',
                    location: '2',
                    start: today(1, 45),
                    end: today(2, 45),
                    class: 'custom-class'
                },
                {
                    name: 'And another one...',
                    location: '2',
                    start: today(3, 10),
                    end: today(5, 30),
                    class: 'custom-class'
                },
                {
                    name: 'Disabled meeting',
                    location: '1',
                    start: yesterday(22, 15),
                    end: yesterday(23, 30),
                    disabled: true
                }
            ];
            // -------------------------- Helpers ------------------------------
            function today(hours, minutes) {
              var date = new Date();
              date.setHours(hours, minutes, 0, 0);
              return date;
            }

            function custom(hours, minutes) {
              var hour = document.getElementById("jam").value;
              var a = parseInt(hour);
              var date = today(hours, minutes);
              date.setTime(date.getTime() - a * 60 * 60 * 1000);
              return date;
            }

            function besok(hours, minutes) {
              var hour = document.getElementById("jam").value;
              var a = parseInt(hour);
              var date = today(hours, minutes);
              date.setTime(date.getTime() + a * 60 * 60 * 1000);
              return date;
            }

            function yesterday(hours, minutes) {
              var date = today(hours, minutes);
              date.setTime(date.getTime() - 24 * 60 * 60 * 1000);
              return date;
            }
            function tomorrow(hours, minutes) {
              var date = today(hours, minutes);
              date.setTime(date.getTime() + 24 * 60 * 60 * 1000);
              return date;
            }

        var sked2Config = {
                caption: 'Dokter',
                start: yesterday(23, 0),
                end: tomorrow(0, 0),
                showEventTime: true,
                showEventDuration: true,
                locations: locations.map(function(location) {
                    var newLocation = $.extend({}, location);
                    delete newLocation.tzOffset;
                    return newLocation;
                }),
                events: events.slice(),
                tzOffset: 0,
                sorting: true,
                orderBy: 'name',
            };
			var $sked2 = $.skedTape(sked2Config);
			$sked2.appendTo('#sked2').skedTape('render');
			//$sked2.skedTape('destroy');
            $sked2.skedTape(sked2Config);
    });
</script>
@endsection

