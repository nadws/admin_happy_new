<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryTherapistController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'History Paket'
        ];
        return view('history.history',$data);
    }
}
