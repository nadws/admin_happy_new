<div class="row">
    <div class="col-lg-10">
        <table class="table table-hover">
            <tr>
                <th>Therapist</th>
                <th>Paket</th>
                <th>Jumlah</th>
                <th width="20%">Dipakai</th>
            </tr>
            @foreach ($invoice_kunjungan as $i)
            <tr>
                <td>
                    {{$i->nama_therapy}}
                    <input type="hidden" name="id_therapist[]" value="{{$i->id_therapist}}">
                </td>
                <td>
                    {{$i->nama_paket}}
                    <input type="hidden" name="id_paket[]" value="{{$i->id_paket}}">
                </td>
                <td>{{$i->debit - $i->kredit}}</td>
                <td><input type="number" name="kredit[]" style="text-align: right" class="form-control" value="0"></td>

            </tr>
            @endforeach
        </table>
    </div>

</div>