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

class CetakLampiranIIIC implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
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
            'A8:L64' => [
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
            'A11:L11' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C15:L15' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C20:L20' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A12:B12' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A16:B16' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A21:B21' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A26:B26' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'B29:B29' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A33:B34' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A38:B39' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A60:B60' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'C25:L25' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C28:L28' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C32:L32' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C37:L37' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C59:L59' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C64:L64' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C38:L39' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C60:L60' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C29:L29' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A15' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C12:L13' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C16:L16' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C21:L22' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C26:L26' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C33:L34' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A20' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A25' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A28' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A32' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A37' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A59' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A64' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A8:L11' => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A8:A63' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B12:B64' => [
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
        $semester = DataJenisPendidikan::where('id_disnaker', $this->id)->where('type','Lampiran')->first();
        $start = 1000;
        $end = 7600;
        $data = DB::table('data_jenis_pendidikans')
        ->where('id_disnaker', $this->id)->where('type','Lampiran')
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('nmr', [$start, $end])
                    ->orWhere('nmr', '4.9');
        })
        ->get();

        $results = DB::table('data_jenis_pendidikans')
        ->select('judul', 'nmr', 'akhir_l', 'akhir_p')
        ->whereBetween('nmr', [$start, $end])->where('type','Lampiran')
        ->orWhere('nmr', '4.9')
        ->selectRaw('CASE WHEN judul = " TOTAL : SLTA /SMK /D.I/D.II " THEN sisa_l ELSE SUM(sisa_l) END AS sisa_l')
        ->selectRaw('CASE WHEN judul = " TOTAL : SLTA /SMK /D.I/D.II " THEN sisa_p ELSE SUM(sisa_p) END AS sisa_p')
        ->selectRaw('CASE WHEN judul = " TOTAL : SLTA /SMK /D.I/D.II " THEN terdaftar_l ELSE SUM(terdaftar_l) END AS terdaftar_l')
        ->selectRaw('CASE WHEN judul = " TOTAL : SLTA /SMK /D.I/D.II " THEN terdaftar_p ELSE SUM(terdaftar_p) END AS terdaftar_p')
        ->selectRaw('CASE WHEN judul = " TOTAL : SLTA /SMK /D.I/D.II " THEN penempatan_l ELSE SUM(penempatan_l) END AS penempatan_l')
        ->selectRaw('CASE WHEN judul = " TOTAL : SLTA /SMK /D.I/D.II " THEN penempatan_p ELSE SUM(penempatan_p) END AS penempatan_p')
        ->selectRaw('CASE WHEN judul = " TOTAL : SLTA /SMK /D.I/D.II " THEN hapus_l ELSE SUM(hapus_l) END AS hapus_l')
        ->selectRaw('CASE WHEN judul = " TOTAL : SLTA /SMK /D.I/D.II " THEN hapus_p ELSE SUM(hapus_p) END AS hapus_p')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH     SMA" THEN sisa_l ELSE SUM(sisa_l) END AS sisa_l_sma')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH     SMA" THEN sisa_p ELSE SUM(sisa_p) END AS sisa_p_sma')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH     SMA" THEN terdaftar_l ELSE SUM(terdaftar_l) END AS terdaftar_l_sma')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH     SMA" THEN terdaftar_p ELSE SUM(terdaftar_p) END AS terdaftar_p_sma')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH     SMA" THEN penempatan_l ELSE SUM(penempatan_l) END AS penempatan_l_sma')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH     SMA" THEN penempatan_p ELSE SUM(penempatan_p) END AS penempatan_p_sma')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH     SMA" THEN hapus_l ELSE SUM(hapus_l) END AS hapus_l_sma')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH     SMA" THEN hapus_p ELSE SUM(hapus_p) END AS hapus_p_sma')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH    SMK " THEN sisa_l ELSE SUM(sisa_l) END AS sisa_l_smk')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH    SMK " THEN sisa_p ELSE SUM(sisa_p) END AS sisa_p_smk')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH    SMK " THEN terdaftar_l ELSE SUM(terdaftar_l) END AS terdaftar_l_smk')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH    SMK " THEN terdaftar_p ELSE SUM(terdaftar_p) END AS terdaftar_p_smk')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH    SMK " THEN penempatan_l ELSE SUM(penempatan_l) END AS penempatan_l_smk')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH    SMK " THEN penempatan_p ELSE SUM(penempatan_p) END AS penempatan_p_smk')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH    SMK " THEN hapus_l ELSE SUM(hapus_l) END AS hapus_l_smk')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH    SMK " THEN hapus_p ELSE SUM(hapus_p) END AS hapus_p_smk')
        ->selectRaw('CASE WHEN judul = " TOTAL :DIPLOMA III/AKTA III/AKADEMI / " THEN sisa_l ELSE SUM(sisa_l) END AS sisa_l_d')
        ->selectRaw('CASE WHEN judul = " TOTAL :DIPLOMA III/AKTA III/AKADEMI / " THEN sisa_p ELSE SUM(sisa_p) END AS sisa_p_d')
        ->selectRaw('CASE WHEN judul = " TOTAL :DIPLOMA III/AKTA III/AKADEMI / " THEN terdaftar_l ELSE SUM(terdaftar_l) END AS terdaftar_l_d')
        ->selectRaw('CASE WHEN judul = " TOTAL :DIPLOMA III/AKTA III/AKADEMI / " THEN terdaftar_p ELSE SUM(terdaftar_p) END AS terdaftar_p_d')
        ->selectRaw('CASE WHEN judul = " TOTAL :DIPLOMA III/AKTA III/AKADEMI / " THEN penempatan_l ELSE SUM(penempatan_l) END AS penempatan_l_d')
        ->selectRaw('CASE WHEN judul = " TOTAL :DIPLOMA III/AKTA III/AKADEMI / " THEN penempatan_p ELSE SUM(penempatan_p) END AS penempatan_p_d')
        ->selectRaw('CASE WHEN judul = " TOTAL :DIPLOMA III/AKTA III/AKADEMI / " THEN hapus_l ELSE SUM(hapus_l) END AS hapus_l_d')
        ->selectRaw('CASE WHEN judul = " TOTAL :DIPLOMA III/AKTA III/AKADEMI / " THEN hapus_p ELSE SUM(hapus_p) END AS hapus_p_d')
        ->selectRaw('CASE WHEN judul = " TOTAL :SARJANA ( S1 )" THEN sisa_l ELSE SUM(sisa_l) END AS sisa_l_s')
        ->selectRaw('CASE WHEN judul = " TOTAL :SARJANA ( S1 )" THEN sisa_p ELSE SUM(sisa_p) END AS sisa_p_s')
        ->selectRaw('CASE WHEN judul = " TOTAL :SARJANA ( S1 )" THEN terdaftar_l ELSE SUM(terdaftar_l) END AS terdaftar_l_s')
        ->selectRaw('CASE WHEN judul = " TOTAL :SARJANA ( S1 )" THEN terdaftar_p ELSE SUM(terdaftar_p) END AS terdaftar_p_s')
        ->selectRaw('CASE WHEN judul = " TOTAL :SARJANA ( S1 )" THEN penempatan_l ELSE SUM(penempatan_l) END AS penempatan_l_s')
        ->selectRaw('CASE WHEN judul = " TOTAL :SARJANA ( S1 )" THEN penempatan_p ELSE SUM(penempatan_p) END AS penempatan_p_s')
        ->selectRaw('CASE WHEN judul = " TOTAL :SARJANA ( S1 )" THEN hapus_l ELSE SUM(hapus_l) END AS hapus_l_s')
        ->selectRaw('CASE WHEN judul = " TOTAL :SARJANA ( S1 )" THEN hapus_p ELSE SUM(hapus_p) END AS hapus_p_s')
        ->selectRaw('CASE WHEN judul = " TOTAL :PASCA SARJANA ( S2 )" THEN sisa_l ELSE SUM(sisa_l) END AS sisa_l_ss')
        ->selectRaw('CASE WHEN judul = " TOTAL :PASCA SARJANA ( S2 )" THEN sisa_p ELSE SUM(sisa_p) END AS sisa_p_ss')
        ->selectRaw('CASE WHEN judul = " TOTAL :PASCA SARJANA ( S2 )" THEN terdaftar_l ELSE SUM(terdaftar_l) END AS terdaftar_l_ss')
        ->selectRaw('CASE WHEN judul = " TOTAL :PASCA SARJANA ( S2 )" THEN terdaftar_p ELSE SUM(terdaftar_p) END AS terdaftar_p_ss')
        ->selectRaw('CASE WHEN judul = " TOTAL :PASCA SARJANA ( S2 )" THEN penempatan_l ELSE SUM(penempatan_l) END AS penempatan_l_ss')
        ->selectRaw('CASE WHEN judul = " TOTAL :PASCA SARJANA ( S2 )" THEN penempatan_p ELSE SUM(penempatan_p) END AS penempatan_p_ss')
        ->selectRaw('CASE WHEN judul = " TOTAL :PASCA SARJANA ( S2 )" THEN hapus_l ELSE SUM(hapus_l) END AS hapus_l_ss')
        ->selectRaw('CASE WHEN judul = " TOTAL :PASCA SARJANA ( S2 )" THEN hapus_p ELSE SUM(hapus_p) END AS hapus_p_ss')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH TOTAL" THEN sisa_l ELSE SUM(sisa_l) END AS sisa_l_tot')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH TOTAL" THEN sisa_p ELSE SUM(sisa_p) END AS sisa_p_tot')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH TOTAL" THEN terdaftar_l ELSE SUM(terdaftar_l) END AS terdaftar_l_tot')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH TOTAL" THEN terdaftar_p ELSE SUM(terdaftar_p) END AS terdaftar_p_tot')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH TOTAL" THEN penempatan_l ELSE SUM(penempatan_l) END AS penempatan_l_tot')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH TOTAL" THEN penempatan_p ELSE SUM(penempatan_p) END AS penempatan_p_tot')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH TOTAL" THEN hapus_l ELSE SUM(hapus_l) END AS hapus_l_tot')
        ->selectRaw('CASE WHEN judul = " TOTAL :JUMLAH TOTAL" THEN hapus_p ELSE SUM(hapus_p) END AS hapus_p_tot')
        ->groupBy('judul', 'nmr', 'akhir_l', 'akhir_p')
        ->oldest('id')
        ->get();

        return view('Dashboard.admin.cetak-laporan-iii-ii')->with([
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
        return 'TBL4.9';
    }
}
