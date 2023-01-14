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

    public function exportUser(Request $r)
    {
        $user = Http::get("https://happykids.ptagafood.com/api/users");
        $dt_user = json_decode($user, TRUE);
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
    }
}
