<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataDokterController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Dokter'
        ];
        return view('data-dokter.data-dokter', $data);
    }
}
