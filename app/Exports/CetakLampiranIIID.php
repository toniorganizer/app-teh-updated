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

class CetakLampiranIIID implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
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
            'A8:L22' => [
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
            'A11:L11' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],

            // Konten
            'A22:L22' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A22:B22' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A22' => [
                'font' => [
                    'color' => ['rgb' => 'F2F2F2'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],

            // Default Aturan  
            'A8:A22' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B12:B22' => [
                'alignment' => [
                    'wrapText' => true,
                ]
            ], 
            'A8:B10' => [
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
        $title = 'LAPORAN IPK III/3 - PENCARI KERJA MENURUT GOL.JABATAN PROPINSI SUMATERA BARAT';
        $disnaker = PemangkuKepentingan::where('email_lembaga', $this->id)->first();
        $semester = DataKelompokJabatan::where('id_disnaker', $this->id)->where('type','Lampiran')->first();
        $start = 0;
        $end = 9;
        $data = DB::table('data_kelompok_jabatans')
        ->where('id_disnaker', $this->id)->where('type','Lampiran')
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('nmr', [$start, $end])
                    ->orWhere('nmr', '4.10');
        })
        ->get();

        $results = DB::table('data_kelompok_jabatans')
        ->select('judul_kj', 'nmr', 'akhir_l_kj', 'akhir_p_kj')
        ->where('type','Lampiran')
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('nmr', [$start, $end])
                    ->orWhere('nmr', '4.10');
        })
        ->selectRaw('CASE WHEN judul_kj = "JUMLAH" THEN sisa_l_kj ELSE SUM(sisa_l_kj) END AS sisa_l')
        ->selectRaw('CASE WHEN judul_kj = "JUMLAH" THEN sisa_p_kj ELSE SUM(sisa_p_kj) END AS sisa_p')
        ->selectRaw('CASE WHEN judul_kj = "JUMLAH" THEN terdaftar_l_kj ELSE SUM(terdaftar_l_kj) END AS terdaftar_l')
        ->selectRaw('CASE WHEN judul_kj = "JUMLAH" THEN terdaftar_p_kj ELSE SUM(terdaftar_p_kj) END AS terdaftar_p')
        ->selectRaw('CASE WHEN judul_kj = "JUMLAH" THEN penempatan_l_kj ELSE SUM(penempatan_l_kj) END AS penempatan_l')
        ->selectRaw('CASE WHEN judul_kj = "JUMLAH" THEN penempatan_p_kj ELSE SUM(penempatan_p_kj) END AS penempatan_p')
        ->selectRaw('CASE WHEN judul_kj = "JUMLAH" THEN hapus_l_kj ELSE SUM(hapus_l_kj) END AS hapus_l')
        ->selectRaw('CASE WHEN judul_kj = "JUMLAH" THEN hapus_p_kj ELSE SUM(hapus_p_kj) END AS hapus_p')
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
        return 'TBL4.10';
    }
}
