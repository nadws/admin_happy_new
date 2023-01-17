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
            'therapist' => DB::select("SELECT * FROM dt_therapy as a left join level_therapist as b on b.id_level_therapist =  a.id_level"),
            'level' => DB::table('level_therapist')->get()
        ];
        return view('therapy.index', $data);
    }

    public function tbh_therapy(Request $r)
    {
        $data = ['nama_therapy' => $r->nama_therapy];
        DB::table('dt_therapy')->insert($data);

        return redirect()->route('tb_therapy')->with('sukses', 'sukses');
    }

    public function edit_terapi(Request $r)
    {
        DB::table('dt_therapy')->where('id_therapy', $r->id_therapy)->update(['nama_therapy' => $r->nama_therapy]);
        return redirect()->route('tb_therapy')->with('sukses', 'sukses');
    }
}
