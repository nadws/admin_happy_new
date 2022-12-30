<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Invoice extends Controller
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
            'title' => 'Data Invoice Screening',
            'dt_pasien' => DB::table('dt_pasien')->get(),
            'invoice' => DB::select("SELECT a.pembayaran,a.id_invoice,a.tgl, a.no_order, b.nama_pasien, b.member_id, a.status FROM invoice as a left join dt_pasien as b on b.member_id = a.member_id where a.tgl between '$tgl1' and '$tgl2' order by a.id_invoice DESC")
        ];
        return view('data-appointment.appointment', $data);
    }

    public function save_invoice(Request $r)
    {
        $member_id = $r->member_id;
        $pembayaran = $r->pembayaran;
        $keluhan = $r->keluhan;
        $invoice = DB::selectOne("SELECT max(a.urutan) as urutan FROM invoice as a");

        if (empty($invoice->urutan)) {
            $no_order = 1001;
        } else {
            $no_order = $invoice->urutan + 1;
        }


        $data = [
            'no_order' => 'HK' . $no_order,
            'urutan' => $no_order,
            'member_id' => $member_id,
            'tgl' => $r->tgl,
            'rupiah' => '200000',
            'pembayaran' => $pembayaran,
            'status' => 'paid'

        ];
        DB::table('invoice')->insert($data);


        return redirect()->route('invoice')->with('sukses', 'Berhasil tambah pertanyaan');
    }

    public function cetak_invoice(Request $r)
    {
        $data = [
            'invoice' => DB::table('invoice')->where('id_invoice', $r->id_invoice)->first(),
            'alamat' => DB::table('h1')->where('id_h1', '12')->first()
        ];
        return view('data-appointment.cetak_invoice', $data);
    }

    public function save_status(Request $r)
    {
        DB::table('invoice')->where('id_invoice', $r->id_invoice)->update(['pembayaran' => $r->pembayaran, 'status' => 'paid']);
        return redirect()->route('invoice')->with('sukses', 'Berhasil paid appointment');
    }

    public function hapus_invoice(Request $r)
    {
        DB::table('invoice')->where('id_invoice', $r->id_invoice)->delete();
        return redirect()->route('invoice')->with('sukses', 'Berhasil tambah pertanyaan');
    }
}
