<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function importUser()
    {
        dd(1);
    }
}
