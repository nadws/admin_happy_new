
<table>
    <tr>
        <td>#</td>
        <td>Nama</td>
        <td>Member id</td>
        <td>nm terapi</td>
        <td>paket</td>
        <td>jumlah</td>
        <td>dipakai</td>
        <td>sisa</td>
    </tr>
    @foreach ($dt_pasien as $d)
        @php
            $detail = DB::select("SELECT a.id_paket, a.id_therapist,  b.nama_paket, c.nama_therapy, sum(a.debit) as debit, sum(a.kredit) as kredit, a.total_rp, a.no_order
            FROM saldo_therapy as a 
            LEFT JOIN dt_paket as b on b.id_paket = a.id_paket
            LEFT JOIN dt_therapy AS c ON c.id_therapy = a.id_therapist
            WHERE a.member_id = '$d->member_id'
            GROUP BY a.id_paket");
            
        @endphp
        <tr>
            <td>1</td>
            <td>{{ $d->nama_pasien }}</td>
            <td>{{ $d->member_id }}</td>
        </tr>
        @foreach ($detail as $r)
        @endforeach
    @endforeach
</table>