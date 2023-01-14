<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ImportServerController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Import',
            'menu' => DB::table('tb_menu_dashboard')->whereNotIn('id', [8,9,10])->get()
        ];
        return view('import.import',$data);
    }

    public function importUser(Request $r)
    {
        $user = Http::get("https://happykids.ptagafood.com/api/users");
        $dt_user = json_decode($user, TRUE);
        $pesan = 'error';
        if(!empty($dt_user)) {
            DB::table('users')->truncate();
            foreach ($dt_user['users'] as $v) {
                $data = [
                    'id' => $v['id'],
                    'name' => $v['name'],
                    'email' => $v['email'],
                    'password' => $v['password'],
                    'created_at' => $v['created_at'],
                    'updated_at' => $v['updated_at'],
                    'role' => $v['role'],
                    'verifikasi' => $v['verifikasi'],
                ];
                DB::table('users')->insert($data);
            }
            $pesan = 'sukses';
        }
        return redirect()->route('importServer')->with($pesan, 'Import dari server');
    }

    public function importDokter()
    {
        $user = Http::get("https://happykids.ptagafood.com/api/dokter");
        $dt_user = json_decode($user, TRUE);
        $pesan = 'error';
        if(!empty($dt_user)){
            DB::table('dt_dokter')->truncate();
            DB::table('dt_therapy')->truncate();
            
            foreach ($dt_user['dokter'] as $v) {
                $data = [
                    'id_dokter' => $v['id_dokter'],
                    'nm_dokter' => $v['nm_dokter'],
                ];
                DB::table('dt_dokter')->insert($data);
            }
            foreach ($dt_user['therapist'] as $v) {
                $data = [
                    'id_therapy' => $v['id_therapy'],
                    'nama_therapy' => $v['nama_therapy'],
                ];
                DB::table('dt_therapy')->insert($data);
            }
            $pesan = 'sukses';
        }
        return redirect()->route('importServer')->with($pesan, "Import dari server");
    }

    public function importPasien()
    {
        $user = Http::get("https://happykids.ptagafood.com/api/pasien");
        $dt_user = json_decode($user, TRUE);
        $pesan = 'error';
        if(!empty($dt_user)){
            DB::table('dt_pasien')->truncate();
            
            foreach ($dt_user['pasien'] as $v) {
                $data = [
                    'id_pasien' => $v['id_pasien'],
                    'member_id' => $v['member_id'],
                    'nama_pasien' => $v['nama_pasien'],
                    'tgl_lahir' => $v['tgl_lahir'],
                    'no_hp' => $v['no_hp'],
                ];
                DB::table('dt_pasien')->insert($data);
            }

            $pesan = 'sukses';
        }
        return redirect()->route('importServer')->with($pesan, "Import dari server");
    }

    public function importPaket()
    {
        $user = Http::get("https://happykids.ptagafood.com/api/paket");
        $dt_user = json_decode($user, TRUE);
        $pesan = 'error';
        if(!empty($dt_user)){
            DB::table('dt_paket')->truncate();
            
            foreach ($dt_user['paket'] as $v) {
                $data = [
                    'id_paket' => $v['id_paket'],
                    'nama_paket' => $v['nama_paket'],
                    'harga' => $v['harga'],
                ];
                DB::table('dt_paket')->insert($data);
            }

            $pesan = 'sukses';
        }
        return redirect()->route('importServer')->with($pesan, "Import dari server");
    }

    public function importNominal()
    {
        $user = Http::get("https://happykids.ptagafood.com/api/nominal");
        $dt_user = json_decode($user, TRUE);
        $pesan = 'error';
        if(!empty($dt_user)){
            DB::table('tb_nominal')->truncate();
            
            foreach ($dt_user['nominal'] as $v) {
                $data = [
                    'id_nominal' => $v['id_nominal'],
                    'nominal' => $v['nominal'],
                    'jenis' => $v['jenis'],
                ];
                DB::table('tb_nominal')->insert($data);
            }

            $pesan = 'sukses';
        }
        return redirect()->route('importServer')->with($pesan, "Import dari server");
    }
}
