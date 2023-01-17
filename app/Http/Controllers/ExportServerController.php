<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ExportServerController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Export Data',
            'menu' => DB::table('tb_menu_dashboard')->whereNotIn('id', [8,9,10])->get()
        ];
        return view('export.export',$data);
    }

    public function exportPasien(Request $r)
    {
        $data  = DB::table('dt_pasien')->where('export', 'T')->get();

        $id_data = [];
        $datas = [];

        foreach($data as $n) {
            $id_data[] = $n->id_pasien;
            array_push($datas, [
                'id_pasien' => $n->id_pasien,
                'member_id' => $n->member_id,
                'nama_pasien' => $n->nama_pasien,
                'tgl_lahir' => $n->tgl_lahir,
                'no_hp' => $n->no_hp,
            ]);
        }
        $response = Http::acceptJson()->post('https://happykids.ptagafood.com/api/dt_pasien', $datas);

        DB::table('dt_pasien')->whereIn('id_pasien', $id_data)->update(['export' => 'Y']);
        
    }
}
