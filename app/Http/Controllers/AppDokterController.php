<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppDokterController extends Controller
{
    public function index(Request $r)
    {
        $tgl = $r->view_tgl ?? date('Y-m-d');

        $tb_app_dokter = DB::select("SELECT * FROM `tb_app_dokter` as a
        LEFT JOIN dt_dokter as b ON a.nama_t = b.id_dokter");

        $invoice = DB::select("SELECT * FROM `invoice` as a
        LEFT JOIN dt_pasien as b ON a.member_id = b.member_id
        WHERE a.status = 'paid'");

        $events = DB::select("SELECT * FROM tb_order as a
        LEFT JOIN tb_app_dokter as b ON a.id_terapis = b.id_terapis
        LEFT JOIN dt_dokter as c ON c.id_dokter = b.nama_t
        WHERE a.tanggal = '$tgl'");

        $datas = [];
        $event = [];

        // ada validasi jika id role 1 ada total duit
        foreach($tb_app_dokter as $app) {
            $d = [
                'id' => $app->id_terapis,
                'name' => $app->nm_dokter,
                'tzOffset' => $app->tzoffset,
            ];
            $datas[] = $d;
        }

        foreach($events as $e) {
            $d = [
                'name' =>  "$e->nm_dokter",
                'location' =>  $e->location,
                'start' =>  $e->start_t,
                'end' =>  $e->end_t,
                'url' => $e->status,
                'className' => $e->bayar
            ];
            $event[] = $d;
        }
   
        
        $data = [
            'title' => 'Appointment Dokter',
            'tgl' => $tgl,
            'invoice' => $invoice,
            'dokter' => DB::table('dt_dokter')->get(),
            'datas' => json_encode($datas),
            'event' => json_encode($event),
        ];
        return view('app.app-dokter.dokter',$data);
    }

    public function tambah_terapi(Request $r)
    {
        $invoice = DB::select("SELECT * FROM `invoice` as a
        LEFT JOIN dt_pasien as b ON a.member_id = b.member_id
        WHERE a.status = 'paid'");
        $data = [
            'invoice' => $invoice,
            'dokter' => DB::table('dt_dokter')->get(),
            'c' => $r->c
        ];
        return view('app.tambah_terapi', $data);
    }

    public function save_dokter_app(Request $r)
    {
        $id_costumer = $r->customer;
        $dokter = $r->dokter;
        $start = $r->jam;
        $now = date('Y-m-d');

        
       
        $gagal = 0;
        for ($i=0; $i < count($id_costumer); $i++) { 
            $no_order = DB::table('invoice')->where('id_invoice', $id_costumer[$i])->first()->no_order;
            $start2 = date('H:i:s', strtotime($start[$i]));
            // dd(Carbon::parse($start2));

            $end = date('H:i:s', strtotime('+2 Hours', strtotime($start2)));
            
            $ttl_jam = "2";
            $tgl = date('D M d Y ', strtotime($now));

            $start_t = $tgl.$start2.' GMT+0800 (Central Indonesia Time)';
            $end_t = $tgl.$end.' GMT+0800 (Central Indonesia Time)';
             
            $cek = DB::table('tb_order')->where([['start', $start[$i]], ['end', $end]])->first();
            if($cek) {
                return redirect()->route('app_dokter')->with('error', 'Appointment sudah ada');
            } else {
                $data = [
                    'nama_t'    => $dokter[$i],
                    'tanggal'   => $now,
                    'tzoffset'  => '-10 * 60',
                    'ttl_jam' => "2"
                ];
                DB::table('tb_app_dokter')->insert($data);
                $id_terapis = DB::selectOne("SELECT id_terapis FROM tb_app_dokter ORDER BY id_terapis 
                DESC LIMIT 1");
    
                $data = [
                    'id_terapis'    => $id_terapis->id_terapis,
                    'id_customer'     => $id_costumer[$i],
                    'location'      => $id_terapis->id_terapis,
                    'tanggal'       => $now,
                    'no_order'       => $no_order,
                    'start'         => $start[$i],
                    'start_t'         => $start_t,
                    'end'           => $end,
                    'end_t'           => $end_t,
                    'total'           => 0
                ];
                DB::table('tb_order')->insert($data);
            }

            
        }

        return redirect()->route('app_dokter')->with('sukses', 'sukses');
    }

    public function hapus_dokter_app(Request $r)
    {
        $dokter = $r->dokter;
        $tgl = date('Y-m-d');

        $cek = DB::table('tb_order')->where([['id_terapis', $dokter], ['tanggal', $tgl]]);
        if($cek) {
            return redirect()->route('app_dokter')->with('error', 'Ada dokter yang masih melakukan service');
        } else {
            DB::table('tb_app_dokter')->where([['nama_t', $dokter], ['tanggal', $tgl]])->delete();
        }
        return redirect()->route('app_dokter')->with('sukses', 'berhasil hapus appointment');
    }
}
