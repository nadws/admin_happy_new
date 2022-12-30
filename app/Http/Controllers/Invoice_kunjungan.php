<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Invoice_kunjungan extends Controller
{
    function index(Request $r)
    {
        if (empty($r->tgl1)) {
            $tgl1 = date('Y-m-01');
            $tgl2 = date('Y-m-t');
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 =  $r->tgl2;
        }
        $data = [
            'title' => 'Data Invoive Kunjungan',
            'dt_pasien' => DB::table('dt_pasien')->get(),
            'invoice_kunjungan' => DB::select("SELECT a.id_invoice_kunjungan, a.tgl, a.no_order, b.nama_pasien, a.member_id
            FROM invoice_kunjungan AS a
            LEFT JOIN dt_pasien AS b ON b.member_id = a.member_id
            WHERE a.tgl BETWEEN '$tgl1' AND '$tgl2'
            ORDER BY a.id_invoice_kunjungan DESC"),
            'paket' => DB::table('dt_paket')->get(),
            'therapist' => DB::table('dt_therapy')->get(),

        ];
        return view('invoice_kunjungan.index', $data);
    }

    // public function get_paket(Request $r)
    // {
    //     $paket = DB::table('invoice_therapy')->where('member_id', $r->member_id)->get();

    //     echo "<option value=''>--Pilih No Order--</option>";
    //     foreach ($paket as $k) {
    //         echo "<option value='" . $k->no_order . "'>" . $k->no_order . "</option>";
    //     }
    // }

    public function data_paket_kunjungan(Request $r)
    {
        $member_id = $r->member_id;
        $data = [
            'invoice_kunjungan' => DB::select("SELECT a.id_paket, a.id_therapist,  b.nama_paket, c.nama_therapy, sum(a.debit) as debit, sum(a.kredit) as kredit, a.total_rp, a.no_order
            FROM saldo_therapy as a 
            LEFT JOIN dt_paket as b on b.id_paket = a.id_paket
            LEFT JOIN dt_therapy AS c ON c.id_therapy = a.id_therapist
            WHERE a.member_id = '$member_id'
            GROUP BY a.id_paket"),
        ];
        return view('invoice_kunjungan.dt_paket', $data);
    }

    public function save_invoice_kunjungan(Request $r)
    {
        $tgl = $r->tgl;
        $member_id = $r->member_id;
        $invoice = DB::selectOne("SELECT max(a.urutan) as urutan FROM invoice_kunjungan as a");

        if (empty($invoice->urutan)) {
            $no_order = 1001;
        } else {
            $no_order = $invoice->urutan + 1;
        }

        $data =  [
            'tgl' => $tgl,
            'no_order' => 'Hk-' . $no_order,
            'member_id' => $member_id
        ];
        DB::table('invoice_kunjungan')->insert($data);

        $id_therapist = $r->id_therapist;
        $id_paket = $r->id_paket;
        $kredit = $r->kredit;

        for ($x = 0; $x < count($id_therapist); $x++) {
            $data = [
                'id_therapist' => $id_therapist[$x],
                'id_paket' => $id_paket[$x],
                'kredit' => $kredit[$x],
                'no_order' => 'Hk-' . $no_order,
                'tgl' => $tgl,
                'member_id' => $member_id
            ];
            DB::table('saldo_therapy')->insert($data);
        }

        return redirect()->route('invoice_kunjungan')->with('sukses', 'Berhasil tambah pertanyaan');
    }
}
