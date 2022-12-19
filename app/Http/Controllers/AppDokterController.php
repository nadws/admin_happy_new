<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppDokterController extends Controller
{
    public function index(Request $r)
    {
        $tb_app_dokter = DB::select("SELECT * FROM tb_app_dokter");
        $invoice = DB::select("SELECT * FROM `invoice` as a
        LEFT JOIN dt_pasien as b ON a.member_id = b.member_id
        WHERE a.status = 'paid'");
        $datas = [];
        // ada validasi jika id role 1 ada total duit
        foreach($tb_app_dokter as $app) {
            $d = [
                'id' => $app->id_terapis,
                'name' => $app->nama_t,
                'tzOffset' => $app->tzoffset,
            ];
            $datas[] = $d;
        }
   
        $tgl = $r->view_tgl ?? date('Y-m-d');
        $data = [
            'title' => 'Appointment Dokter',
            'tgl' => $tgl,
            'invoice' => $invoice,
            'datas' => json_encode($datas),
        ];
        return view('app.app-dokter.dokter',$data);
    }
}
