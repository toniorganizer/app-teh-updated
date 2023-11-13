<?php

namespace App\Exports;

use App\Models\Laporan;

use App\Models\DataPencariKerja;
use Illuminate\Support\Facades\DB;
use App\Models\DataJenisPendidikan;
use App\Models\PemangkuKepentingan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class CetakLaporanIID implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
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
            'A8:L75' => [
                'font' => ['name' => 'Tahoma', 'size' => 8, 'normal' => true],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Menambahkan solid garis tipis
                        'color' => ['rgb' => '000000'], // Mengatur warna garis (hitam dalam format RGB)
                    ]],
            ],
            
            'A8:L10' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C25:L25' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C39:L39' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C51:L51' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A8:L11' => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B12:B74' => [
                'alignment' => [
                    'wrapText' => true,
                ]
            ], 
            'C8:L8' => [
                'alignment' => [
                    'wrapText' => true,
                ]
            ], 
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 25,
            'C' => 10,
            'D' => 10,
            'E' => 10,
            'F' => 10,
            'G' => 10,
            'H' => 10,
            'I' => 10,
            'J' => 10,
            'K' => 10,
            'L' => 10,
        ];
    }

    public function view(): View
    {
        $title = 'LAPORAN IPK III/1 - IKHTISAR STATISTIK ANTAR KERJA PROPINSI SUMATERA BARAT';
        $disnaker = PemangkuKepentingan::where('email_lembaga', $this->id)->first();
        $semester = DataJenisPendidikan::where('id_disnaker', $this->id)->first();
        $start = 5209;
        $end = 5528;
        $data = DB::table('data_jenis_pendidikans')
        ->whereBetween('nmr', [$start, $end])->orWhere('nmr', 04)->orWhere('nmr', [0,1,2,0110])
        ->get();
        
        return view('Dashboard.admin.cetak-laporan-iii-ii')->with([
            'data' => $data,
            'title' => $title,
            'semester' => $semester,
            'disnaker' => $disnaker,
        ]);
    }

    public function title(): string
    {
        // Judul yang ingin Anda atur untuk lembar Excel
        return 'Sheet4';
    }
}
