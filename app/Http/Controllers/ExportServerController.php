<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;


class ExportServerController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Export Data',
            'pasien' => DB::table('dt_pasien')->where('export', 'T')->count(),
            'inv' => DB::table('invoice_periksa')->where('export', 'T')->count(),
            'menu' => DB::table('tb_menu_dashboard')->whereNotIn('id', [8, 9, 10])->get()
        ];
        return view('export.export', $data);
    }

    public function exportPasien()
    {
        $client = new Client([
            'base_uri' => 'https://adm.klinikhappykids.com/api/pasPasien',
            'headers' => [
                'X-API-KEY' => '@Takemor.',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);
        $datas  = DB::table('dt_pasien')->where('export', 'T')->get();
        $wadah = [];
        $id_data = [];
        foreach ($datas as $d) {
            $id_data[] = $d->id_pasien;
            array_push($wadah, [
                'id_pasien' => $d->id_pasien,
                'member_id' => $d->member_id,
                'nama_pasien' => $d->nama_pasien,
                'alamat' => $d->alamat,
                'tgl_lahir' => $d->tgl_lahir,
                'no_hp' => $d->no_hp,
                'tgl' => $d->tgl,
                'kartu' => $d->kartu,
                'administrasi' => $d->administrasi,
                'no_order' => $d->no_order,

            ]);
        }

        $response = $client->post('pasPasien', [
            'json' => $wadah
        ]);
        $data = json_decode((string) $response->getBody(), true);

        if ($response->getStatusCode() === 201) {
            // dd($data['message']);
            DB::table('dt_pasien')->whereIn('id_pasien', $id_data)->update(['export' => 'Y']);
            return redirect()->route('exportServer')->with('sukses', 'Data berhasil di export');
        } else {
            echo 'Failed to create user';
        }
    }

    public function exportInv()
    {
        // get server endpoint
        $client = new Client([
            'base_uri' => 'https://adm.klinikhappykids.com/api/invoice',
            'headers' => [
                'X-API-KEY' => '@Takemor.',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);

        // invoice periksa
        $datasPeriksa  = DB::table('invoice_periksa')->where('export', 'T')->get();
        $datasJson = [];
        $id_dataPeriksa = [];
        foreach ($datasPeriksa as $d) {
            $id_dataPeriksa[] = $d->id_invoice_periksa;
            array_push($datasJson, [
                'id_invoice_periksa' => $d->id_invoice_periksa,
                'member_id' => $d->member_id,
                'tgl' => $d->tgl,
                'no_order' => $d->no_order,
                'urutan' => $d->urutan,
                'id_dokter' => $d->id_dokter,
                'pembayaran' => $d->pembayaran,
                'status' => $d->status,
                'rupiah' => $d->rupiah,
                'admin' => $d->admin,
                'jenis' => $d->jenis,
                'ket' => $d->ket,

            ]);
        }
        // ----------------------

        // invoice registrasi
        $datasRegistrasi  = DB::table('invoice_registrasi')->where('export', 'T')->get();
        $dataPushRegistrasi = [];
        $id_dataRegistrasi = [];
        foreach ($datasRegistrasi as $d) {
            $id_dataRegistrasi[] = $d->id_registrasi;
            array_push($dataPushRegistrasi, [
                'id_registrasi' => $d->id_registrasi,
                'tgl' => $d->tgl,
                'no_order' => $d->no_order,
                'urutan' => $d->urutan,
                'member_id' => $d->member_id,
                'rupiah' => $d->rupiah,
                'status' => $d->status,
                'pembayaran' => $d->pembayaran,
                'admin' => $d->admin,
                'id_paket' => $d->id_paket,
            ]);
        }
        // -----------------------
        
        // invoice saldo terapi
        $datasSaldo  = DB::table('saldo_therapy')->where('export', 'T')->get();
        $dataPushSaldo = [];
        $id_dataSaldo = [];
        foreach ($datasSaldo as $d) {
            $id_dataSaldo[] = $d->id_saldo_therapy;
            array_push($dataPushSaldo, [
                'id_saldo_therapy' => $d->id_saldo_therapy,
                'no_order' => $d->no_order,
                'debit' => $d->debit,
                'kredit' => $d->kredit,
                'tgl' => $d->tgl,
                'admin' => $d->admin,
                'id_paket' => $d->id_paket,
                'id_therapist' => $d->id_therapist,
                'total_rp' => $d->total_rp,
                'member_id' => $d->member_id,
            ]);
        }
        // -----------------------

        // invoice kunjungan
        $datasKunjungan  = DB::table('invoice_kunjungan')->where('export', 'T')->get();
        $dataPushKunjungan = [];
        $id_dataKunjungan = [];
        foreach ($datasKunjungan as $d) {
            $id_dataKunjungan[] = $d->id_invoice_kunjungan;
            array_push($dataPushKunjungan, [
                'id_invoice_kunjungan' => $d->id_invoice_kunjungan,
                'tgl' => $d->tgl,
                'no_order' => $d->no_order,
                'urutan' => $d->urutan,
                'member_id' => $d->member_id,
                'admin' => $d->admin,
            ]);
        }
       
        // -----------------------

        // invoice terapi
        $datasTerapi  = DB::table('invoice_therapy')->where('export', 'T')->get();
        $dataPushTerapi = [];
        $id_dataTerapi = [];
        foreach ($datasTerapi as $d) {
            $id_dataTerapi[] = $d->id_invoice_therapy;
            array_push($dataPushTerapi, [
                'id_invoice_therapy' => $d->id_invoice_therapy,
                'tgl' => $d->tgl,
                'no_order' => $d->no_order,
                'urutan' => $d->urutan,
                'member_id' => $d->member_id,
                'pembayaran' => $d->pembayaran,
                'rupiah' => $d->rupiah,
                'admin' => $d->admin,
            ]);
        }
        // -----------------------

        // kirim ke server
        $response = $client->post('invoice', [
            'json' => [
                'periksa' => $datasJson,
                'registrasi' => $dataPushRegistrasi,
                'saldo' => $dataPushSaldo,
                'kunjungan' => $dataPushKunjungan,
                'terapi' => $dataPushTerapi,
            ],
        ]);
        
        $data = json_decode((string) $response->getBody(), true);
        
        if ($response->getStatusCode() === 201) {
            DB::table('invoice_periksa')->whereIn('id_invoice_periksa', $id_dataPeriksa)->update(['export' => 'Y']);
            DB::table('invoice_registrasi')->whereIn('id_registrasi', $id_dataRegistrasi)->update(['export' => 'Y']);
            DB::table('saldo_therapy')->whereIn('id_saldo_therapy', $id_dataSaldo)->update(['export' => 'Y']);
            DB::table('invoice_kunjungan')->whereIn('id_invoice_kunjungan', $id_dataKunjungan)->update(['export' => 'Y']);
            DB::table('invoice_therapy')->whereIn('id_invoice_therapy', $id_dataTerapi)->update(['export' => 'Y']);

            return redirect()->route('exportServer')->with('sukses', 'Data berhasil di export');
        } else {
            return redirect()->route('exportServer')->with('error', $data['message']);
        }
    }
}
