<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportServerController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Export Data'
        ];
        return view('export.export',$data);
    }
}
