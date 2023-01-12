<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Invoice_tp extends Controller
{
    function index(Request $r)
    {

        $tgl1 = $r->tgl1 ?? date('Y-m-01');
        $tgl2 =  $r->tgl2 ?? date('Y-m-t');

        $data = [
            'title' => 'Data Invoice Therapy & Paket',
            'dt_pasien' => DB::table('dt_pasien')->get(),
            'invoice_tp' => DB::select("SELECT a.pembayaran, a.id_invoice_therapy, a.tgl, a.no_order, b.nama_pasien, a.member_id, c.saldo
            FROM invoice_therapy AS a
            LEFT JOIN dt_pasien AS b ON b.member_id = a.member_id
            LEFT JOIN (
            SELECT a.id_paket, SUM(a.debit - a.kredit) AS saldo, a.no_order
            FROM saldo_therapy AS a
            GROUP BY a.no_order, a.id_paket
            HAVING SUM(a.debit - a.kredit) = 1
            ) AS c ON c.no_order = a.no_order
            WHERE a.tgl BETWEEN '$tgl1' AND '$tgl2'
            ORDER BY a.id_invoice_therapy DESC"),
            'paket' => DB::table('dt_paket')->get(),
            'therapist' => DB::table('dt_therapy')->get(),

        ];
        return view('invoice_tp.index', $data);
    }

    public function tambah_paket(Request $r)
    {
        $data = [
            'title' => 'paket',
            'count' => $r->count,
            'paket' => DB::table('dt_paket')->get(),
            'therapist' => DB::table('dt_therapy')->get(),

        ];
        return view('invoice_tp.tambah', $data);
    }

    public function get_paket(Request $r)
    {
        $paket = DB::table('dt_paket')->where('id_paket', $r->id_paket)->first();

        echo $paket->harga;
    }

    public function save_tp(Request $r)
    {
        $tgl = $r->tgl;
        $member_id = $r->member_id;

        $invoice = DB::selectOne("SELECT max(a.urutan) as urutan FROM invoice_therapy as a");

        if (empty($invoice->urutan)) {
            $no_order = 1001;
        } else {
            $no_order = $invoice->urutan + 1;
        }

        $data =  [
            'tgl' => $tgl,
            'no_order' => 'HK-' . $no_order,
            'urutan' => $no_order,
            'member_id' => $member_id,
            'pembayaran' => $r->pembayaran,
            'rupiah' => 0,
            'admin' => Auth::user()->name
        ];
        DB::table('invoice_therapy')->insert($data);

        $id_therapist = $r->id_therapist;
        $id_paket = $r->id_paket;
        $debit = $r->jumlah;
        $total_rp = $r->total_rp;

        for ($x = 0; $x < count($id_therapist); $x++) {
            $data = [
                'id_therapist' => $id_therapist[$x],
                'id_paket' => $id_paket[$x],
                'debit' => $debit[$x],
                'total_rp' => $total_rp[$x],
                'no_order' => 'HK-' . $no_order,
                'tgl' => $tgl,
                'member_id' => $member_id,
            ];
            DB::table('saldo_therapy')->insert($data);
        }

        return redirect()->route('invoice_tp')->with('sukses', 'Berhasil tambah pertanyaan');
    }

    public function view_paket(Request $r)
    {
        $no_order =  $r->no_order;

        $data = [
            'invoice_tp' => DB::select("SELECT a.id_paket, b.nama_paket, c.nama_therapy, sum(a.debit) as debit, sum(a.kredit) as kredit, a.total_rp, a.no_order
            FROM saldo_therapy as a 
            LEFT JOIN dt_paket as b on b.id_paket = a.id_paket
            LEFT JOIN dt_therapy AS c ON c.id_therapy = a.id_therapist
            WHERE a.no_order = '$no_order'
            GROUP BY a.no_order, a.id_paket"),
        ];
        return view('invoice_tp.view', $data);
    }
    public function view_paket2(Request $r)
    {
        $no_order =  $r->no_order;
        $id_paket =  $r->id_paket;

        $data = [
            'invoice_tp' => DB::select("SELECT a.tgl, b.nama_paket, a.id_paket, c.nama_therapy, a.debit, a.kredit, a.total_rp, a.no_order
            FROM saldo_therapy as a 
            LEFT JOIN dt_paket as b on b.id_paket = a.id_paket
            LEFT JOIN dt_therapy AS c ON c.id_therapy = a.id_therapist
            WHERE a.no_order = '$no_order' AND a.id_paket = '$id_paket'
            GROUP BY a.id_saldo_therapy"),

            'no_order' => $no_order,
            'paket' => DB::table('dt_paket')->where('id_paket', $id_paket)->first()
        ];
        return view('invoice_tp.view2', $data);
    }

    public function cetak_invoice_tp(Request $r)
    {
        $id_invoice_therapy = $r->id_invoice_therapy;

        $invoice =  DB::selectOne("SELECT a.id_invoice_therapy, a.tgl, a.no_order, b.nama_pasien, a.member_id
        FROM invoice_therapy AS a
        LEFT JOIN dt_pasien AS b ON b.member_id = a.member_id
        WHERE a.id_invoice_therapy = '$id_invoice_therapy'");

        $paket = DB::select("SELECT a.id_paket, b.nama_paket, c.nama_therapy, a.debit, a.kredit, a.total_rp, a.no_order
        FROM saldo_therapy as a 
        LEFT JOIN dt_paket as b on b.id_paket = a.id_paket
        LEFT JOIN dt_therapy AS c ON c.id_therapy = a.id_therapist
        WHERE a.no_order = '$invoice->no_order'
        GROUP BY a.no_order, a.id_paket");

        $data = [
            'title' => 'Invoice',
            'invoice' => $invoice,
            'paket' => $paket,
            'alamat' => DB::table('h1')->where('id_h1', '12')->first(),
            'email' => DB::table('h1')->where('id_h1', '14')->first()
        ];
        return view('invoice_tp.cetak_invoice', $data);
    }

    public function hapus_invoice_tp(Request $r)
    {
        $id = $r->id_invoice_therapy;
        $member = DB::table('invoice_therapy')->where('no_order', $id)->first()->member_id;

        DB::table('invoice_therapy')->where('no_order', $id)->delete();
        DB::table('saldo_therapy')->where('no_order', $id)->delete();
        // DB::table('invoice_kunjungan')->where('member_id', $member)->delete();
        return redirect()->route('invoice_tp')->with('sukses', 'Berhasil hapus invoice');
    }
}
