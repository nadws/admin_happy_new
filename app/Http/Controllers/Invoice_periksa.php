<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Invoice_periksa extends Controller
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
            'title' => 'Data Invoive Periksa',
            'dt_pasien' => DB::table('dt_pasien')->get(),
            'invoice_periksa' => DB::select("SELECT a.pembayaran,a.id_invoice_periksa, a.status, a.tgl, a.no_order, b.nama_pasien, b.member_id , c.nm_dokter
            FROM invoice_periksa as a 
            left join dt_pasien as b on b.member_id = a.member_id 
            left join dt_dokter as c on c.id_dokter = a.id_dokter
            where a.tgl BETWEEN '$tgl1' and '$tgl2' order by a.id_invoice_periksa DESC"),
            'dokter' => DB::table('dt_dokter')->get()
        ];
        return view('invoice_periksa.index', $data);
    }

    public function save_invoice_periksa(Request $r)
    {
        $member_id = $r->member_id;
        $pembayaran = $r->pembayaran;
        $id_dokter = $r->id_dokter;
        $invoice = DB::selectOne("SELECT max(a.urutan) as urutan FROM invoice_periksa as a");

        if (empty($invoice->urutan)) {
            $no_order = 1001;
        } else {
            $no_order = $invoice->urutan + 1;
        }


        $data = [
            'no_order' => 'HK' . $no_order,
            'urutan' => $no_order,
            'member_id' => $member_id,
            'id_dokter' => $id_dokter,
            'tgl' => $r->tgl,
            'rupiah' => '200000',
            'pembayaran' => $pembayaran,
            'status' => 'paid'

        ];
        DB::table('invoice_periksa')->insert($data);


        return redirect()->route('inv_periksa')->with('sukses', 'Berhasil tambah pertanyaan');
    }

    public function hapus_invoice_periksa(Request $r)
    {
        DB::table('invoice_periksa')->where('id_invoice_periksa', $r->id_invoice_periksa)->delete();
        return redirect()->route('inv_periksa')->with('sukses', 'Berhasil tambah pertanyaan');
    }
}
