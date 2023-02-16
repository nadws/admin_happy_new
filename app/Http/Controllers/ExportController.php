<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Str;

class ExportController extends Controller
{
    public function exportScreening(Request $r)
    {
        $tgl1 = $r->tgl1;
        $tgl2 = $r->tgl2;

        $screening = DB::select("SELECT a.rupiah,a.pembayaran,a.id_invoice,a.tgl, a.no_order, b.nama_pasien, b.member_id, a.status FROM invoice as a left join dt_pasien as b on b.member_id = a.member_id where a.tgl between '$tgl1' and '$tgl2' order by a.id_invoice DESC");

        $spreadsheet = new Spreadsheet();


        $writer = new Xlsx($spreadsheet);
        $style = [
            'borders' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ],
            ],
        ];

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(0);

        $sheet2 = $spreadsheet->getActiveSheet();
        $sheet2->setTitle('Invoice Periksa');

        $periksa = DB::select("SELECT a.rupiah,a.id_dokter,a.pembayaran,a.id_invoice_periksa, a.status, a.tgl, a.no_order, b.nama_pasien, b.member_id , c.nm_dokter
        FROM invoice_periksa as a 
        left join dt_pasien as b on b.member_id = a.member_id 
        left join dt_dokter as c on c.id_dokter = a.id_dokter
        where a.tgl BETWEEN '$tgl1' and '$tgl2' order by a.id_invoice_periksa DESC");

        $sheet2
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Member ID')
            ->setCellValue('D1', 'No Order')
            ->setCellValue('E1', 'Dokter')
            ->setCellValue('F1', 'Nama Pasien')
            ->setCellValue('G1', 'Status')
            ->setCellValue('H1', 'Pembayaran')
            ->setCellValue('I1', 'Rupiah');
        $sheet2->getStyle("A1:I1")->getFont()->setBold(true);

        $kolper = 2;

        foreach ($periksa as $no => $d) {
            $sheet2->setCellValue("A$kolper", $no + 1)
                ->setCellValue("B$kolper", $d->tgl)
                ->setCellValue("C$kolper", $d->member_id)
                ->setCellValue("D$kolper", $d->no_order)
                ->setCellValue("E$kolper", $d->nm_dokter)
                ->setCellValue("F$kolper", $d->nama_pasien)
                ->setCellValue("G$kolper", $d->status)
                ->setCellValue("H$kolper", $d->pembayaran)
                ->setCellValue("I$kolper", $d->rupiah);

            $kolper++;
        }
        $batasper = $kolper - 1;
        $sheet2->getStyle('A1:I' . $batasper)->applyFromArray($style);

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(1);
        $sheet3 = $spreadsheet->getActiveSheet();
        $sheet3->setTitle('Invoice Registrasi');

        $regis = DB::select("SELECT a.pembayaran,a.id_registrasi,a.tgl,a.rupiah, a.no_order, b.nama_pasien, b.member_id, a.status FROM invoice_registrasi as a left join dt_pasien as b on b.member_id = a.member_id where a.tgl between '$tgl1' and '$tgl2' order by a.id_registrasi DESC");

        $sheet3
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Member ID')
            ->setCellValue('D1', 'No Order')
            ->setCellValue('E1', 'Nama Pasien')
            ->setCellValue('F1', 'Status')
            ->setCellValue('G1', 'Pembayaran')
            ->setCellValue('H1', 'Rupiah');
        $sheet3->getStyle("A1:H1")->getFont()->setBold(true);

        $kolreg = 2;
        foreach ($regis as $no => $r) {
            $sheet3
                ->setCellValue("A$kolreg", $no + 1)
                ->setCellValue("B$kolreg", $r->tgl)
                ->setCellValue("C$kolreg", $r->member_id)
                ->setCellValue("D$kolreg", $r->no_order)
                ->setCellValue("E$kolreg", $r->nama_pasien)
                ->setCellValue("F$kolreg", $r->status)
                ->setCellValue("G$kolreg", $r->pembayaran)
                ->setCellValue("H$kolreg", $r->rupiah);

            $kolreg++;
        }
        $batasreg = $kolreg - 1;
        $sheet3->getStyle('A1:H' . $batasreg)->applyFromArray($style);

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(2);
        $sheet4 = $spreadsheet->getActiveSheet();
        $sheet4->setTitle('Invoice Therapy & Paket');

        $tp = DB::select("SELECT a.no_order,a.tgl,a.member_id,b.nama_pasien,a.pembayaran,c.rupiah FROM invoice_therapy as a 
        LEFT JOIN dt_pasien as b ON a.member_id = b.member_id
        LEFT JOIN(
            SELECT a.no_order,SUM(a.total_rp) as rupiah FROM saldo_therapy as a GROUP BY a.no_order
        ) as c ON a.no_order = c.no_order WHERE a.tgl BETWEEN '$tgl1' AND '$tgl2' ORDER BY a.no_order DESC");

        $sheet4
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Member ID')
            ->setCellValue('D1', 'No Order')
            ->setCellValue('E1', 'Nama Pasien')
            ->setCellValue('F1', 'Status')
            ->setCellValue('G1', 'Pembayaran')
            ->setCellValue('H1', 'Rupiah');
        $sheet4->getStyle("A1:H1")->getFont()->setBold(true);

        $koltp = 2;
        foreach ($tp as $no => $r) {
            $sheet4
                ->setCellValue("A$koltp", $no + 1)
                ->setCellValue("B$koltp", $r->tgl)
                ->setCellValue("C$koltp", $r->member_id)
                ->setCellValue("D$koltp", $r->no_order)
                ->setCellValue("E$koltp", $r->nama_pasien)
                ->setCellValue("F$koltp", 'paid')
                ->setCellValue("G$koltp", $r->pembayaran)
                ->setCellValue("H$koltp", $r->rupiah);

            $koltp++;
        }
        $batastp = $koltp - 1;
        $sheet4->getStyle('A1:H' . $batastp)->applyFromArray($style);

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(3);
        $sheet5 = $spreadsheet->getActiveSheet();
        $sheet5->setTitle('Invoice Kunjungan');

        $kunjungan = DB::select("SELECT a.id_invoice_kunjungan, a.tgl, a.no_order, b.nama_pasien, a.member_id
        FROM invoice_kunjungan AS a
        LEFT JOIN dt_pasien AS b ON b.member_id = a.member_id
        WHERE a.tgl BETWEEN '$tgl1' AND '$tgl2'
        ORDER BY a.id_invoice_kunjungan DESC");

        $sheet5
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Member ID')
            ->setCellValue('D1', 'No Order')
            ->setCellValue('E1', 'Nama Pasien');
        $sheet5->getStyle("A1:E1")->getFont()->setBold(true);

        $kolkun = 2;
        foreach ($kunjungan as $no => $r) {
            $sheet5
                ->setCellValue("A$kolkun", $no + 1)
                ->setCellValue("B$kolkun", $r->tgl)
                ->setCellValue("C$kolkun", $r->member_id)
                ->setCellValue("D$kolkun", $r->no_order)
                ->setCellValue("E$kolkun", $r->nama_pasien);

            $kolkun++;
        }
        $bataskun = $kolkun - 1;
        $sheet5->getStyle('A1:E' . $bataskun)->applyFromArray($style);

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(4);
        $sheet6 = $spreadsheet->getActiveSheet();
        $sheet6->setTitle('Data Paket Pasien');

        $sheet6
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'Member ID')
            ->setCellValue('D1', 'Nama Theraphy')
            ->setCellValue('E1', 'Paket')
            ->setCellValue('F1', 'Jumlah')
            ->setCellValue('G1', 'Dipakai')
            ->setCellValue('H1', 'Sisa');

        $sheet6->getStyle("A1:H1")->getFont()->setBold(true);

        $dt_pasien = DB::table('dt_pasien')->get();
        $kolpas = 2;
        $nom = 1;
        foreach ($dt_pasien as $no => $r) {
            $detail = DB::select("SELECT a.id_paket, a.id_therapist,  b.nama_paket, c.nama_therapy, sum(a.debit) as debit, sum(a.kredit) as kredit, a.total_rp, a.no_order
            FROM saldo_therapy as a 
            LEFT JOIN dt_paket as b on b.id_paket = a.id_paket
            LEFT JOIN dt_therapy AS c ON c.id_therapy = a.id_therapist
            WHERE a.member_id = '$r->member_id'
            GROUP BY a.id_paket");

            if (!empty($detail)) {
                foreach ($detail as $n) {
                    $ttl = $n->debit - $n->kredit;
                    $sheet6
                        ->setCellValue("A$kolpas", $nom++)
                        ->setCellValue("B$kolpas", $r->nama_pasien)
                        ->setCellValue("C$kolpas", $r->member_id)
                        ->setCellValue("D$kolpas", $n->nama_therapy)
                        ->setCellValue("E$kolpas", $n->nama_paket)
                        ->setCellValue("F$kolpas", $n->debit)
                        ->setCellValue("G$kolpas", $n->kredit)
                        ->setCellValue("H$kolpas", $ttl);
                    $kolpas++;
                }
            }
        }

        $bataspas = $kolpas - 1;
        $sheet6->getStyle('A1:H' . $bataspas)->applyFromArray($style);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Invoice & Paket Pasien.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function exportPasien()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->createSheet();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Pasien');

        $pasien = DB::table('dt_pasien')->orderBy('member_id', 'ASC')->get();

        $sheet
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'ID Pasien')
            ->setCellValue('C1', 'Member ID')
            ->setCellValue('D1', 'Nama')
            ->setCellValue('E1', 'Alamat')
            ->setCellValue('F1', 'Tgl Lahir')
            ->setCellValue('G1', 'No HP');

        $sheet->getStyle("A1:G1")->getFont()->setBold(true);
        $sheet->getStyle("B1:C1")->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('d92121');

        $kol = 2;

        foreach ($pasien as $no => $d) {
            $sheet->setCellValue("A$kol", $no + 1)
                ->setCellValue("B$kol", $d->id_pasien)
                ->setCellValue("C$kol", $d->member_id)
                ->setCellValue("D$kol", $d->nama_pasien)
                ->setCellValue("E$kol", $d->alamat)
                ->setCellValue("F$kol", $d->tgl_lahir)
                ->setCellValue("G$kol", $d->no_hp);

            $kol++;
        }


        $style = [
            'borders' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ],
            ],
        ];
        $batas = count($pasien) + 1;
        $sheet->getStyle('A1:G' . $batas)->applyFromArray($style);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data Pasien.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function exportPaket()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->createSheet();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Pasien');

        $pasien = DB::table('dt_pasien')->orderBy('member_id', 'ASC')->get();

        $sheet
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Id Pasien')
            ->setCellValue('C1', 'Kode')
            ->setCellValue('D1', 'Nama')
            ->setCellValue('E1', 'Alamat')
            ->setCellValue('F1', 'Tgl Lahir')
            ->setCellValue('G1', 'No HP');
        $paket = DB::table('dt_paket')->get();

        foreach ($paket as $i => $p) {
            $s = $i;
            $abjad1 = chr(96 + ($i + 7 % 26) + $i + 1);
            $abjad2 = chr(96 + ($i + 8 % 26) + $s + 1);

            $sheet->setCellValue($abjad1 . '1', $p->nama_paket);
            $sheet->setCellValue($abjad2 . '1', 'terapis');
            $i++;
        }

        $sheet->getStyle("A1:G1")->getFont()->setBold(true);
        $sheet->getStyle("B1:C1")->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('d92121');

        // $kol = 2;

        // foreach ($pasien as $no => $d) {
        //     $sheet->setCellValue("A$kol", $no + 1)
        //         ->setCellValue("B$kol", $d->id_pasien)
        //         ->setCellValue("C$kol", $d->member_id)
        //         ->setCellValue("D$kol", $d->nama_pasien)
        //         ->setCellValue("E$kol", $d->alamat)
        //         ->setCellValue("F$kol", $d->tgl_lahir)
        //         ->setCellValue("G$kol", $d->no_hp);

        //     $kol++;
        // }

        $style = [
            'borders' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ],
            ],
        ];
        $batas = count($pasien) + 1;
        $sheet->getStyle('A1:G' . $batas)->applyFromArray($style);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data Pasien.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function importDataPasien(Request $r)
    {
        $file = $r->file('file');
        $fileDiterima = ['xls', 'xlsx'];
        $cek = in_array($file->getClientOriginalExtension(), $fileDiterima);
        if ($cek) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx;
            $spreadsheet = $reader->load($file);
            $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            $data = [];

            $numrow = 1;

            foreach ($sheet as $row) {
                if ($row['B'] == '' && $row['C'] == '') {
                    continue;
                }
                if ($numrow > 1) {
                    if ($row['B'] == '') {
                        DB::table('dt_pasien')->insert([
                            'member_id' => $row['C'],
                            'nama_pasien' => $row['D'],
                            'alamat' => $row['E'],
                            'tgl_lahir' => $row['F'],
                            'no_hp' => $row['G'],
                            'tgl' => date('Y-m-d'),
                        ]);
                    } else {
                        DB::table('dt_pasien')->where('id_pasien', $row['B'])->update([
                            'member_id' => $row['C'],
                            'nama_pasien' => $row['D'],
                            'alamat' => $row['E'],
                            'tgl_lahir' => $row['F'],
                            'no_hp' => $row['G'],
                            'tgl' => date('Y-m-d'),
                        ]);
                    }
                }
                $numrow++;
            }
            return redirect()->route('data_pasien')->with('sukses', 'Berhasil Import Data');
        } else {
            return redirect()->route('data_pasien')->with('error', 'File tidak didukung');
        }
    }

    public function importPaket(Request $r)
    {
        $file = $r->file('file');
        $fileDiterima = ['xls', 'xlsx'];
        $cek = in_array($file->getClientOriginalExtension(), $fileDiterima);
        if ($cek) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx;
            $spreadsheet = $reader->load($file);
            $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            $data = [];

            $numrow = 1;

            foreach ($sheet as $row) {
                if ($row['B'] == '' && $row['C'] == '') {
                    continue;
                }
                if ($numrow > 1) {
                    if ($row['B'] == '') {
                        DB::table('dt_pasien')->insert([
                            'member_id' => $row['C'],
                            'nama_pasien' => $row['D'],
                            'alamat' => $row['E'],
                            'tgl_lahir' => $row['F'],
                            'no_hp' => $row['G'],
                            'tgl' => date('Y-m-d'),
                        ]);

                        $paket = DB::table('dt_paket')->get();

                        foreach ($paket as $i => $p) {
                            $s = $i;
                            $abjad1 = chr(96 + ($i + 7 % 26) + $i + 1);
                            $abjad2 = chr(96 + ($i + 8 % 26) + $s + 1);
                            $abjad1 = Str::upper($abjad1);
                            $abjad2 = Str::upper($abjad2);
                            if($row[$abjad1] == '' && $row[$abjad2] == '') {
                            } else {
                                $invoice = DB::selectOne("SELECT max(a.urutan) as urutan FROM invoice_therapy as a");
                                $no_order = empty($invoice->urutan) ? 1001 : $invoice->urutan + 1;
    
                                DB::table('saldo_therapy')->insert([
                                    'no_order' => 'HK-' . $no_order,
                                    'id_paket' => $p->id_paket,
                                    'debit' => $row[$abjad1],
                                    'id_therapist' => $row[$abjad2],
                                    'kredit' => 0,
                                    'total_rp' => 0,
                                    'member_id' => $row['C'],
                                    'tgl' => date('Y-m-d'),
                                    'admin' => Auth::user()->name,
                                    'export' => 'T',
                                ]);
    
                                DB::table('invoice_therapy')->insert([
                                    'no_order' => 'HK-' . $no_order,
                                    'urutan' => $no_order,
                                    'pembayaran' => 'BCA',
                                    'rupiah' => 0,
                                    'member_id' => $row['C'],
                                    'tgl' => date('Y-m-d'),
                                    'admin' => Auth::user()->name,
                                    'export' => 'T',
                                ]);
                            }

                            $i++;
                        }
                    } else {
                        DB::table('dt_pasien')->where('id_pasien', $row['B'])->update([
                            'member_id' => $row['C'],
                            'nama_pasien' => $row['D'],
                            'alamat' => $row['E'],
                            'tgl_lahir' => $row['F'],
                            'no_hp' => $row['G'],
                            'tgl' => date('Y-m-d'),
                        ]);
                    }
                }
                $numrow++;
            }
            return redirect()->route('data_pasien')->with('sukses', 'Berhasil Import Data');
        } else {
            return redirect()->route('data_pasien')->with('error', 'File tidak didukung');
        }
    }
}
