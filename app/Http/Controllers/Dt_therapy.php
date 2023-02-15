<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dt_therapy extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Data Therapist & Level',
            'therapist' => DB::table('dt_therapy as a')->join('dt_paket as b', 'a.id_paket', 'b.id_paket')->get(),
            'paket' => DB::table('dt_paket')->get()
        ];
        return view('therapy.index', $data);
    }

    public function tbh_therapy(Request $r)
    {
        $data = [
            'nama_therapy' => $r->nama_therapy,
            'id_paket' => $r->id_paket,
        ];
        DB::table('dt_therapy')->insert($data);

        return redirect()->route('tb_therapy')->with('sukses', 'sukses');
    }

    public function edit_terapi(Request $r)
    {
        DB::table('dt_therapy')->where('id_therapy', $r->id_therapy)->update([
            'nama_therapy' => $r->nama_therapy,
            'id_paket' => $r->id_paket,
        ]);
        return redirect()->route('tb_therapy')->with('sukses', 'sukses');
    }

    public function hps_terapi(Request $r)
    {
        DB::table('dt_therapy')->where('id_therapy', $r->id_therapy)->delete();
        return redirect()->route('tb_therapy')->with('sukses', 'sukses');
    }
}
