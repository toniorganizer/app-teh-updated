<?php

namespace App\Exports;

use App\Models\DataPencariKerja;
use App\Models\Laporan;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;

class CetakLaporanI implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
{

    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setPath(public_path('assets/img/sumbar.png'));
        $drawing->setHeight(95);
        $drawing->setCoordinates('B2');

        return $drawing;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'C2:C3' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['name' => 'Tahoma', 'size' => 11, 'bold' => true],
            ],
            'C4:C6' => [
                // Mengatur jenis huruf (font) untuk sel B2 sampai B5
                'font' => ['name' => 'Tahoma', 'size' => 9, 'normal' => true],
            ],
            'A8:T18' => [
                'font' => ['name' => 'Tahoma', 'size' => 8, 'normal' => true],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Menambahkan solid garis tipis
                        'color' => ['rgb' => '000000'], // Mengatur warna garis (hitam dalam format RGB)
                    ]],
            ],
            'Q14' => [
                'font' => [
                    'color' => ['rgb' => 'C5D9F1'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'Q17' => [
                'font' => [
                    'color' => ['rgb' => 'C5D9F1'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B8:B11' => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'C8:L8' => [
                'font' => ['bold' => true],
            ],
            'C10:O11' => [
                'font' => ['bold' => true],
            ],
            'Q8:T11' => [
                'font' => ['bold' => true],
            ],
            'A14:T14' => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'C5D9F1'], // Mengatur latar belakang menjadi kuning
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A17:T17' => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'C5D9F1'], // Mengatur latar belakang menjadi kuning
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A8:T11' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'C5D9F1'], // Mengatur latar belakang menjadi kuning
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B8:B18' => [
                'alignment' => [
                    'wrapText' => true,
                ]
            ],
            'Q8:Q18' => [
                'alignment' => [
                    'wrapText' => true,
                ]
            ], 
            'A8:A18'=> [
                'width' => 3,
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'C8:P18' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ], 
            'R12:T18' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B2' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 4,
            'B' => 25,
            'C' => 6,
            'D' => 6,
            'E' => 6,
            'F' => 6,
            'G' => 6,
            'H' => 6,
            'I' => 6,
            'J' => 6,
            'K' => 6,
            'L' => 6,
            'M' => 6,
            'N' => 6,
            'O' => 6,
            'P' => 6,
            'Q' => 25,
            'R' => 6,
            'S' => 6,
            'T' => 6,
        ];
    }

    public function view(): View
    {
        // dd($this->id)
        $title = 'LAPORAN IPK III/1 - IKHTISAR STATISTIK ANTAR KERJA PROPINSI SUMATERA BARAT';
        $semester = DataPencariKerja::where('id_disnaker', $this->id)->first();
        $data = DataPencariKerja::where('id_disnaker', $this->id)->get();
        return view('Dashboard.admin.cetak-laporan-iii-i')->with([
            'data' => $data,
            'title' => $title,
            'semester' => $semester
        ]);
    }

    public function title(): string
    {
        // Judul yang ingin Anda atur untuk lembar Excel
        return 'IPK III';
    }
}
