<?php

namespace App\Exports;

use App\Models\Laporan;
use App\Models\DataPencariKerja;
use Illuminate\Support\Facades\DB;
use App\Models\DataJenisPendidikan;
use App\Models\DataKelompokJabatan;
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

class CetakLaporanIIID implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
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
            'A8:L66' => [
                'font' => ['name' => 'Tahoma', 'size' => 8, 'normal' => true],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Menambahkan solid garis tipis
                        'color' => ['rgb' => '000000'], // Mengatur warna garis (hitam dalam format RGB)
                    ]],
            ],
            
            
            'A8:L9' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C10:L10' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'B11:L11' => [
                'font' => [
                    'color' => ['rgb' => 'F2F2F2'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            
            'A8:L10' => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A11:L11' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            
            'C18:L18' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            
            'A19:B19' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],

            'C42:L42' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],

            'A43:B43' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],

            'C66:L66' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],

            'A19:B19' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A43:B43' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            
            'A18' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C19:L19' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A42' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C43:L43' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A66' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            

            'A8:A66' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],

            'B12:B66' => [
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
        $semester = DataKelompokJabatan::where('id_disnaker', $this->id)->first();
        $start = 3471;
        $end = 5230;
        $data = DB::table('data_kelompok_jabatans')
        ->where('id_disnaker', $this->id)
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('nmr', [$start, $end])
                ->orWhere('nmr', '04')
                ->orWhere(function ($query) {
                    $query->whereIn('nmr', [4, 5])
                    ->whereNotIn('nmr', ['05']);
                });
        })
        ->get();


        // dd($data);

        $results = DB::table('data_kelompok_jabatans')
        ->select('judul_kj', 'nmr', 'akhir_l_kj', 'akhir_p_kj')
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('nmr', [$start, $end])
                ->orWhere('nmr', '04')
                ->orWhere(function ($query) {
                    $query->whereIn('nmr', [4, 5])
                    ->whereNotIn('nmr', ['05']);
                });
        })
        ->selectRaw('CASE WHEN judul_kj = "Sub Total" THEN sisa_l_kj ELSE SUM(sisa_l_kj) END AS sisa_l')
        ->selectRaw('CASE WHEN judul_kj = "Sub Total" THEN sisa_p_kj ELSE SUM(sisa_p_kj) END AS sisa_p')
        ->selectRaw('CASE WHEN judul_kj = "Sub Total" THEN terdaftar_l_kj ELSE SUM(terdaftar_l_kj) END AS terdaftar_l')
        ->selectRaw('CASE WHEN judul_kj = "Sub Total" THEN terdaftar_p_kj ELSE SUM(terdaftar_p_kj) END AS terdaftar_p')
        ->selectRaw('CASE WHEN judul_kj = "Sub Total" THEN penempatan_l_kj ELSE SUM(penempatan_l_kj) END AS penempatan_l')
        ->selectRaw('CASE WHEN judul_kj = "Sub Total" THEN penempatan_p_kj ELSE SUM(penempatan_p_kj) END AS penempatan_p')
        ->selectRaw('CASE WHEN judul_kj = "Sub Total" THEN hapus_l_kj ELSE SUM(hapus_l_kj) END AS hapus_l')
        ->selectRaw('CASE WHEN judul_kj = "Sub Total" THEN hapus_p_kj ELSE SUM(hapus_p_kj) END AS hapus_p')
        ->groupBy('judul_kj', 'nmr', 'akhir_l_kj', 'akhir_p_kj')
        ->oldest('id')
        ->get();

        return view('Dashboard.admin.cetak-laporan-iii-iii')->with([
            'data' => $data,
            'title' => $title,
            'semester' => $semester,
            'disnaker' => $disnaker,
            'laporan' => $results
        ]);
    }

    public function title(): string
    {
        // Judul yang ingin Anda atur untuk lembar Excel
        return 'Sheet4';
    }
}
