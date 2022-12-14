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
            'title' => 'Data Invoive',
            'dt_pasien' => DB::table('dt_pasien')->get(),
            'invoice' => DB::select("SELECT a.tgl, a.no_order, b.nama_pasien, b.member_id FROM invoice as a left join dt_pasien as b on b.member_id = a.member_id where a.tgl between '$tgl1' and '$tgl2' order by a.id_invoice DESC")
        ];
        return view('data-appointment.appointment', $data);
    }

    public function save_invoice(Request $r)
    {
        $member_id = rand(1, 999999999999);
        $nm_pasien = $r->nm_pasien;
        $no_order = Str::random(10);
        $id_member = $r->id_customer;

        if (empty($nm_pasien)) {
            $data = [
                'no_order' => $no_order,
                'member_id' => $id_member,
                'tgl' => $r->tgl,
                'rupiah' => '100000'
            ];
            DB::table('invoice2')->insert($data);
        } else {
            $data = [
                'nama_pasien' => $nm_pasien,
                'member_id' => $member_id,
            ];
            DB::table('dt_pasien')->insert($data);
            $data = [
                'no_order' => $no_order,
                'member_id' => $member_id,
                'tgl' => $r->tgl,
                'rupiah' => '100000'
            ];
            DB::table('invoice2')->insert($data);
        }

        return redirect()->route('invoice')->with('sukses', 'Berhasil tambah pertanyaan');
    }

    public function cetak_invoice(Request $r)
    {


        return view('data-appointment.cetak_invoice');
    }
}
