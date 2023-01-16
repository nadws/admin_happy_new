<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExportTherapist extends Controller
{
    public function index($tgl1, $tgl2)
    {
        $terapi = DB::table('dt_therapy')->get();
        $spreadsheet = new Spreadsheet();
        foreach($terapi as $i => $r) {

            $detail = DB::select("SELECT a.nama_therapy,sum(b.debit) as debit,c.nama_paket FROM dt_therapy a
            LEFT JOIN saldo_therapy b ON a.id_therapy = b.id_therapist
            LEFT JOIN dt_paket c ON b.id_paket = c.id_paket
            WHERE  b.tgl BETWEEN '$tgl1' AND '$tgl2' AND b.debit != 0 AND a.id_therapy = '$r->id_therapy'
            GROUP BY c.id_paket;");

            $spreadsheet->createSheet();
            $spreadsheet->setActiveSheetIndex($i);
            $s = 'sheet'.$i;
            $s = $spreadsheet->getActiveSheet();
            $s->setTitle($r->nama_therapy);
            
            if(empty($detail)){
                $s
                ->setCellValue('A1', 'No')
                ->setCellValue('B1', 'Nama Paket')
                ->setCellValue('C1', 'Saldo');
            } else {
                $no = 1;
                $kolom = 2;

                $s
                ->setCellValue('A1', 'No')
                ->setCellValue('B1', 'Nama Paket')
                ->setCellValue('C1', 'Saldo');

                foreach($detail as $d) {
                    $s
                    ->setCellValue("A$kolom", $no++)
                    ->setCellValue("B$kolom", $d->nama_paket)
                    ->setCellValue("C$kolom", $d->debit);
                    $kolom++;
                }
                $s->getStyle("A1:C1")->getFont()->setBold( true );
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

                $bataskun = $kolom - 1;
                $s->getStyle('A1:C' . $bataskun)->applyFromArray($style);
            }

        }

        $namafile = "Data Therapist $tgl1 ~ $tgl2.xlsx";

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$namafile);
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');

    }
}
