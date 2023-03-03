<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Cetak Invoice</title>

    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <div class="col-6 ">
                <div class="float-start">
                    <img src="{{ asset('images-upload/logo.png') }}" width="120" height="120" alt="">
                </div>
            </div>
            <div class="col-6 mt-4">
                <div class="float-end">
                    Invoice #: {{$invoice2->no_order}}
                    <br />
                    Created: {{ date('F d, Y',strtotime($invoice2->tgl)) }}<br />
                </div>
            </div>
            <div class="col-6 mt-4">
                <div class="float-start">
                    Happy Kids<br />
                    {{$alamat->isi}}
                    <br>
                    <br>
                </div>

            </div>
            <div class="col-lg-12">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{$invoice2->nama_pasien}}</td>
                    </tr>
                    <tr>
                        <td>No Rekam Medis</td>
                        <td>:</td>
                        <td>{{$invoice2->member_id}}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{$invoice2->alamat}}</td>
                    </tr>
                    <tr>
                        <td>No Telp</td>
                        <td>:</td>
                        <td>{{$invoice2->no_hp}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12 mt-2">
                <table class="table table-sm">
                    <tr class="table-active">
                        <th>Payment Method</th>
                        <th style="text-align: right">Check #</th>
                    </tr>
                    @php
                    $total = 0;
                    @endphp
                    @foreach ($invoice as $a)
                    @php
                    $total += $a->rupiah;
                    @endphp
                    <tr>
                        <td>{{$a->nm_jenis}}</td>
                        <td align="right">Rp. {{ number_format($a->rupiah,0)}}</td>
                    </tr>

                    @endforeach

                    <tr>
                        <td>Administrasi</td>
                        <td align="right">Rp. {{ number_format($invoice3->nominal,0)}}</td>
                    </tr>

                    <tr>
                        <th style="text-align: center">Terbilang</th>
                        <th style="text-align: right"> Rp.{{number_format($total + $invoice3->nominal,0)}} </th>
                    </tr>


                </table>
                <br>
                <br>
                <br>
            </div>
            <div class="col-8 ">

            </div>
            <style>
                .ttd {
                    text-align: center
                }
            </style>
            <div class="col-4">
                <h5 class="ttd">Ttd + Stempel</h5>
                <br>
                <br>
                <br>
                <br>
                <h5 class="ttd fw-bold">( Ivana Agustin )</h5>
            </div>

        </div>


    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>


<script>
    window.print()
</script>

</html>