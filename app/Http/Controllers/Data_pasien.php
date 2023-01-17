<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Data_pasien extends Controller
{
    public function index(Request $r)
    {
        $member_id = DB::selectOne("SELECT max(member_id) as member_id FROM `dt_pasien` ORDER BY member_id ASC;");
        $data = [
            'title' => 'Data Pasien',
            'pasien' => DB::table('dt_pasien')->orderBy('member_id', 'DESC')->get(),
            'member_id' => empty($member_id) ? '50001' : $member_id->member_id,
        ];

        return view('pasien.data_pasien', $data);
    }

    public function save_pasien(Request $r)
    {
        $member_id = $r->member_id;
        $tgl_lahir = $r->tgl_lahir;
        $nama = $r->nama;
        $no_telpon = $r->no_telpon;
        $cek = DB::table('dt_pasien')->where('member_id', $member_id)->first();
        

        
        if($cek){
            if($r->page == 'screening') {
                echo 'gagal';
            } else {
                return redirect()->route('data_pasien')->with('error', 'Member ID sudah ada');
            }
        }
        $data = [
            'member_id' => $member_id,
            'nama_pasien' => $nama,
            'tgl_lahir' => $tgl_lahir,
            'no_hp' => $no_telpon,
            'tgl' => date('Y-m-d'),
        ];

        DB::table('dt_pasien')->insert($data);
        if($r->page == 'screening') {
            echo 'sukses';
        } else {
            return redirect()->route('data_pasien')->with('sukses', 'Berhasil disimpan');
        }

    }

    public function delete_pasien(Request $r)
    {
        DB::table('dt_pasien')->where('id_pasien', $r->id_pasien)->delete();
        return redirect()->route('data_pasien')->with('sukses', 'Berhasil dihapus');
    }

    public function get_edit_pasien(Request $r)
    {
        $data = [
            'title' => 'Data Pasien',
            'pasien' => DB::table('dt_pasien')->where('id_pasien', $r->id_pasien)->first(),
        ];

        return view('pasien.edit', $data);
    }

    public function edit_pasien(Request $r)
    {
        $member_id = $r->member_id;
        $tgl_lahir = $r->tgl_lahir;
        $nama = $r->nama;
        $no_telpon = $r->no_telpon;

        $data = [
            'member_id' => $member_id,
            'nama_pasien' => $nama,
            'tgl_lahir' => $tgl_lahir,
            'no_hp' => $no_telpon,
            'export' => 'T'
        ];

        DB::table('dt_pasien')->where('id_pasien', $r->id_pasien)->update($data);
        return redirect()->route('data_pasien')->with('sukses', 'Berhasil disimpan');

    }

    public function get_pasien(Request $r)
    {
        $pasien = DB::table('dt_pasien')->where('member_id', $r->member_id)->first();

        echo $pasien->nama_pasien;
    }
}
