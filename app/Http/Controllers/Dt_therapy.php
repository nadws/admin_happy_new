<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dt_therapy extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Data Therapist',
            'therapist' => DB::table('dt_therapy')->orderBy('id_therapy', 'DESC')->get()
        ];
        return view('therapy.index', $data);
    }

    public function tbh_therapy(Request $r)
    {
        $data = ['nama_therapy' => $r->nama_therapy];
        DB::table('dt_therapy')->insert($data);

        return redirect()->route('tb_therapy')->with('sukses', 'sukses');
    }
}
