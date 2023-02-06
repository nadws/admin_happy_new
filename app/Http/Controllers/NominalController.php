<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NominalController extends Controller
{
    public function index()
    {
        return redirect()->route('data_nominal',1);
    }

    public function data_nominal($tipe)
    {
        switch($tipe) {
            case '1':
                $title = "Screening";
                $jenis = 'inv_screening';
            case '2':
                $title = "Periksa";
                $jenis = 'inv_periksa';
            case '3':
                $title = "Registrasi";
                $jenis = 'inv_registrasi';
            case '4':
                $title = "Theraphy & Paket";
                $jenis = 'inv_tp';
            case '5':
                $title = "Kunjungan";
                $jenis = 'inv_kunjungan';
        }

        $data = [
            'title' => $title,
            'query' => DB::table('tb_nominal')->where('jenis', $jenis)->get(),
            'tipe' => $tipe
        ];
        return view('nominal.tb_nominal',$data);
    }

    public function tambah_nominal($tipe, Request $r)
    {

        switch($tipe) {
            case '1':
                $jenis = 'inv_screening';
            case '2':
                $jenis = 'inv_periksa';
            case '3':
                $jenis = 'inv_registrasi';
            case '4':
                $jenis = 'inv_tp';
            case '5':
                $jenis = 'inv_kunjungan';
        }

        DB::table('tb_nominal')->where('jenis', $jenis)->insert([
            'nominal' => $r->nominal,
            'jenis' => $jenis
        ]);

        return redirect()->route('data_nominal', $tipe)->with('sukses', 'Berhasil tambah nominal');
    }

    public function hapus_nominal($id,$tipe)
    {
        DB::table('tb_nominal')->where('id_nominal', $id)->delete();
        return redirect()->route('data_nominal', $tipe)->with('sukses', 'Berhasil hapus nominal');
    }

    public function edit_nominal(Request $r)
    {
        DB::table('tb_nominal')->where('id_nominal', $r->id_nominal)->update([
            'nominal' => $r->nominal
        ]);
        return redirect()->route('data_nominal', $r->tipe)->with('sukses', 'Berhasil edit nominal');
    }
}
