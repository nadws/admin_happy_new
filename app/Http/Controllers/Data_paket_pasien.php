<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Data_paket_pasien extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Data Paket Pasien',
            'data_paket_pasien' => DB::select("SELECT a.member_id, b.nama_pasien, c.saldo
            FROM invoice_therapy AS a
            LEFT JOIN dt_pasien AS b ON b.member_id = a.member_id
            LEFT JOIN (
            SELECT a.id_paket, SUM(a.debit - a.kredit) AS saldo, a.no_order
            FROM saldo_therapy AS a
            GROUP BY a.member_id, a.id_paket
            HAVING SUM(a.debit - a.kredit) = 1
            ) AS c ON c.no_order = a.no_order
            GROUP BY a.member_id"),
        ];
        return view('dt_paket_pasien.index', $data);
    }

    public function view_paket_pasien(Request $r)
    {
        $member_id =  $r->member_id;

        $data = [
            'invoice' => DB::select("SELECT a.id_saldo_therapy,a.id_paket, b.nama_paket, c.id_therapy,c.nama_therapy, sum(a.debit) as debit, sum(a.kredit) as kredit, a.total_rp, a.no_order, a.member_id
            FROM saldo_therapy as a 
            LEFT JOIN dt_paket as b on b.id_paket = a.id_paket
            LEFT JOIN dt_therapy AS c ON c.id_therapy = a.id_therapist
            WHERE a.member_id = '$member_id'
            GROUP BY a.id_paket"),
        ];
        return view('dt_paket_pasien.view', $data);
    }

    public function view_paket_pasien2(Request $r)
    {
        $member_id =  $r->member_id;
        $id_paket =  $r->id_paket;

        $data = [
            'invoice_tp' => DB::select("SELECT a.tgl, b.nama_paket, a.id_paket, c.nama_therapy, a.debit, a.kredit, a.total_rp, a.no_order
            FROM saldo_therapy as a 
            LEFT JOIN dt_paket as b on b.id_paket = a.id_paket
            LEFT JOIN dt_therapy AS c ON c.id_therapy = a.id_therapist
            WHERE a.member_id = '$member_id' AND a.id_paket = '$id_paket'
            GROUP BY a.id_saldo_therapy"),
            'member_id' => $member_id,
            'paket' => DB::table('dt_paket')->where('id_paket', $id_paket)->first()
        ];
        return view('dt_paket_pasien.view2', $data);
    }

    public function viewEditTerapi(Request $r)
    {
        $member_id =  $r->member_id;
        $id_paket =  $r->id_paket;
        $data = [
            'invoice' => DB::select("SELECT a.id_saldo_therapy,a.id_paket, b.nama_paket, c.nama_therapy, sum(a.debit) as debit, sum(a.kredit) as kredit, a.total_rp, a.no_order, a.member_id
            FROM saldo_therapy as a 
            LEFT JOIN dt_paket as b on b.id_paket = a.id_paket
            LEFT JOIN dt_therapy AS c ON c.id_therapy = a.id_therapist
            WHERE a.member_id = '$member_id'
            GROUP BY a.id_paket"),
            'data_tp' => DB::table('dt_therapy')->get(),
            'id_terapi' => $r->id_terapi,
            'id_saldo_therapy' => $r->id_saldo_therapy
        ];
        return view('dt_paket_pasien.viewEditTerapi', $data);
    }

    public function editPaketTerapi(Request $r)
    {
        DB::table('saldo_therapy')->where([['id_therapist', $r->id_terapi_sebelum],['kredit', 0]])->update([
            'id_therapist' => $r->id_terapi
        ]);
        $member = DB::table('saldo_therapy')->where('id_saldo_therapy',$r->id_saldo_terapi)->first()->member_id;
        echo $member;


    }
}
