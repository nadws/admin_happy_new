<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'title' => 'Data Invoice Kunjungan',
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

        $no_order = empty($invoice->urutan) ? 1001 : $invoice->urutan + 1;
        
        $id_therapist = $r->id_therapist;
        $id_paket = $r->id_paket;
        $kredit = $r->kredit;
        $kosong = true;

        foreach($kredit as $k) {
            if($k != 0) {
                $kosong = false;
            }
        }

        if($kosong) {
            return redirect()->back()->with('error', 'Data kosong semua');
        } 
        
        for ($x = 0; $x < count($id_therapist); $x++) {
            $data = [
                'id_therapist' => $id_therapist[$x],
                'id_paket' => $id_paket[$x],
                'kredit' => $kredit[$x],
                'no_order' => 'Hk-' . $no_order,
                'tgl' => $tgl,
                'member_id' => $member_id,
                'admin' => Auth::user()->name
            ];
            DB::table('saldo_therapy')->insert($data);
        }

        $data =  [
            'tgl' => $tgl,
            'no_order' => 'Hk-' . $no_order,
            'member_id' => $member_id,
            'urutan' => $no_order,
            'admin' => Auth::user()->name
        ];
        DB::table('invoice_kunjungan')->insert($data);

        return redirect()->route('invoice_kunjungan')->with('sukses', 'Berhasil tambah pertanyaan');
    }

    public function hapus_invoice_kunjungan(Request $r){
        $no_order = $r->no_order;
        DB::table('invoice_kunjungan')->where('no_order', $no_order)->delete();
        DB::table('saldo_therapy')->where([['no_order', $no_order],['debit', 0]])->delete();
        
        return redirect()->route('invoice_kunjungan')->with('sukses', 'Berhasil hapus pertanyaan');
    }

    public function detailSaldo(Request $r)
    {
        $member_id = $r->member_id;
        $no_order = $r->no_order;
        $nama = DB::table('dt_pasien')->where('member_id', $member_id)->first()->nama_pasien;
        $data = [
            'invoice_kunjungan' => DB::select("SELECT a.debit,a.kredit,a.no_order,c.nama_therapy,b.nama_paket FROM `saldo_therapy` as a
            LEFT JOIN dt_paket as b on b.id_paket = a.id_paket
            LEFT JOIN dt_therapy AS c ON c.id_therapy = a.id_therapist
            WHERE a.no_order = '$no_order' AND a.kredit != 0"),
            'nama' => $nama
        ];
        return view('invoice_kunjungan.detailSaldo', $data);
    }
}
