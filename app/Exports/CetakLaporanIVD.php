<?php

namespace App\Exports;

use App\Models\Laporan;
use App\Models\DataPencariKerja;
use Illuminate\Support\Facades\DB;
use App\Models\DataJenisPendidikan;
use App\Models\DataLowonganPendidikan;
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

class CetakLaporanIVD implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
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
            // Judul besar
            'C2:C3' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['name' => 'Tahoma', 'size' => 11, 'bold' => true],
            ],
            'C4:C6' => [
                // Mengatur jenis huruf (font) untuk sel B2 sampai B5
                'font' => ['name' => 'Tahoma', 'size' => 9, 'normal' => true],
            ],

            // Garis hitam tabel
            'A8:L72' => [
                'font' => ['name' => 'Tahoma', 'size' => 8, 'normal' => true],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Menambahkan solid garis tipis
                        'color' => ['rgb' => '000000'], // Mengatur warna garis (hitam dalam format RGB)
                    ]],
            ],

            // Judul pada tabel 
            'A8:L10' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A8:L11' => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],

            // Konten
            'B20:L20' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C20:L20' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A20' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B20' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A21:B21' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C21:L21' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B33:L33' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C33:L33' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A33' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B33' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A34:B34' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C34:L34' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B45:L45' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C45:L45' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A45' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B45' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A46:B46' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C46:L46' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],

            // Default Aturan  
            'A8:A72' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B12:B72' => [
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
            'B' => 28,
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
        $title = 'LAPORAN IPK III/4 - LOWONGAN DIRINCI MENURUT PENDIDIKAN PROPINSI SUMATERA BARAT';
        $disnaker = PemangkuKepentingan::where('email_lembaga', $this->id)->first();
        $semester = DataLowonganPendidikan::where('id_disnaker', $this->id)->first();
        $start = 5209;
        $end = 5532;
        $data = DB::table('data_lowongan_pendidikans')
        ->where('id_disnaker', $this->id)
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('nmr', [$start, $end])
                    ->orWhere('nmr', 04);
        })
        ->get();

        $results = DB::table('data_lowongan_pendidikans')
        ->select('judul_lp', 'nmr', 'akhir_l_lp', 'akhir_p_lp')
        ->whereBetween('nmr', [$start, $end])
        ->orWhere('nmr', 04)
        ->selectRaw('CASE WHEN judul_lp = "Sub Total" THEN sisa_l_lp ELSE SUM(sisa_l_lp) END AS sisa_l')
        ->selectRaw('CASE WHEN judul_lp = "Sub Total" THEN sisa_p_lp ELSE SUM(sisa_p_lp) END AS sisa_p')
        ->selectRaw('CASE WHEN judul_lp = "Sub Total" THEN terdaftar_l_lp ELSE SUM(terdaftar_l_lp) END AS terdaftar_l')
        ->selectRaw('CASE WHEN judul_lp = "Sub Total" THEN terdaftar_p_lp ELSE SUM(terdaftar_p_lp) END AS terdaftar_p')
        ->selectRaw('CASE WHEN judul_lp = "Sub Total" THEN penempatan_l_lp ELSE SUM(penempatan_l_lp) END AS penempatan_l')
        ->selectRaw('CASE WHEN judul_lp = "Sub Total" THEN penempatan_p_lp ELSE SUM(penempatan_p_lp) END AS penempatan_p')
        ->selectRaw('CASE WHEN judul_lp = "Sub Total" THEN hapus_l_lp ELSE SUM(hapus_l_lp) END AS hapus_l')
        ->selectRaw('CASE WHEN judul_lp = "Sub Total" THEN hapus_p_lp ELSE SUM(hapus_p_lp) END AS hapus_p')
        ->groupBy('judul_lp', 'nmr', 'akhir_l_lp', 'akhir_p_lp')
        ->oldest('id')
        ->get();

        return view('Dashboard.admin.cetak-laporan-iii-iv')->with([
            'data' => $data,
            'title' => $title,
            'semester' => $semester,
            'disnaker' => $disnaker,
            'laporan' => $results
        ]);
    }

    public function title(): string
    {
        return 'Sheet10';
    }
}