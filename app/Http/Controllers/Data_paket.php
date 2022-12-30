<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Data_paket extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Data Paket',
            'paket' => DB::table('dt_paket')->get(),
        ];

        return view('paket.data_paket', $data);
    }

    public function save_paket(Request $r)
    {
        $nama_paket = $r->nama_paket;
        $harga = $r->harga;

        $data = [
            'nama_paket' => $nama_paket,
            'harga' => $harga,
        ];

        DB::table('dt_paket')->insert($data);
        return redirect()->route('dt_paket')->with('sukses', 'Berhasil disimpan');
    }

    public function get_edit_paket(Request $r)
    {
        $data = [
            'title' => 'Data Paket',
            'paket' => DB::table('dt_paket')->where('id_paket', $r->id_paket)->first(),
        ];

        return view('paket.edit', $data);
    }

    public function edit_paket(Request $r)
    {
        $nama_paket = $r->nama_paket;
        $harga = $r->harga;

        $data = [
            'nama_paket' => $nama_paket,
            'harga' => $harga,
        ];

        DB::table('dt_paket')->where('id_paket', $r->id_paket)->update($data);
        return redirect()->route('dt_paket')->with('sukses', 'Berhasil disimpan');
    }

    public function delete_paket(Request $r)
    {
        DB::table('dt_paket')->where('id_paket', $r->id_paket)->delete();
        return redirect()->route('dt_paket')->with('sukses', 'Berhasil dihapus');
    }
}
