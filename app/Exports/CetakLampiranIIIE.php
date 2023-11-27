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

class CetakLampiranIIIE implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
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
            'A8:L40' => [
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
            'A12:B12' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C12:L12' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B39:L39' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C39:L39' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A39' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B39' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B40:L40' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C40:L40' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A40' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B40' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B40' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'B40' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],

            // Default Aturan  
            'A8:A40' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B12:B40' => [
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
        $semester = DataLowonganPendidikan::where('id_disnaker', $this->id)->where('type','Lampiran')->first();
        $start = 1000;
        $end = 7600;
        $data = DB::table('data_lowongan_pendidikans')
        ->where('id_disnaker', $this->id)->where('type','Lampiran')
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('nmr', [$start, $end])
                    ->orWhere('nmr', '09');
        })
        ->get();

        $results = DB::table('data_lowongan_pendidikans')
        ->select('judul_lp', 'nmr', 'akhir_l_lp', 'akhir_p_lp')
        ->whereBetween('nmr', [$start, $end])->where('type','Lampiran')
        ->orWhere('nmr', '09')
        ->selectRaw('CASE WHEN judul_lp = "PENDIDIKAN MENENGAH ATAS" THEN sisa_l_lp ELSE SUM(sisa_l_lp) END AS sisa_l')
        ->selectRaw('CASE WHEN judul_lp = "PENDIDIKAN MENENGAH ATAS" THEN sisa_p_lp ELSE SUM(sisa_p_lp) END AS sisa_p')
        ->selectRaw('CASE WHEN judul_lp = "PENDIDIKAN MENENGAH ATAS" THEN terdaftar_l_lp ELSE SUM(terdaftar_l_lp) END AS terdaftar_l')
        ->selectRaw('CASE WHEN judul_lp = "PENDIDIKAN MENENGAH ATAS" THEN terdaftar_p_lp ELSE SUM(terdaftar_p_lp) END AS terdaftar_p')
        ->selectRaw('CASE WHEN judul_lp = "PENDIDIKAN MENENGAH ATAS" THEN penempatan_l_lp ELSE SUM(penempatan_l_lp) END AS penempatan_l')
        ->selectRaw('CASE WHEN judul_lp = "PENDIDIKAN MENENGAH ATAS" THEN penempatan_p_lp ELSE SUM(penempatan_p_lp) END AS penempatan_p')
        ->selectRaw('CASE WHEN judul_lp = "PENDIDIKAN MENENGAH ATAS" THEN hapus_l_lp ELSE SUM(hapus_l_lp) END AS hapus_l')
        ->selectRaw('CASE WHEN judul_lp = "PENDIDIKAN MENENGAH ATAS" THEN hapus_p_lp ELSE SUM(hapus_p_lp) END AS hapus_p')
        ->selectRaw('CASE WHEN judul_lp = "SMK : JURUSAN ( TOTAL )" THEN sisa_l_lp ELSE SUM(sisa_l_lp) END AS sisa_l_smk')
        ->selectRaw('CASE WHEN judul_lp = "SMK : JURUSAN ( TOTAL )" THEN sisa_p_lp ELSE SUM(sisa_p_lp) END AS sisa_p_smk')
        ->selectRaw('CASE WHEN judul_lp = "SMK : JURUSAN ( TOTAL )" THEN terdaftar_l_lp ELSE SUM(terdaftar_l_lp) END AS terdaftar_l_smk')
        ->selectRaw('CASE WHEN judul_lp = "SMK : JURUSAN ( TOTAL )" THEN terdaftar_p_lp ELSE SUM(terdaftar_p_lp) END AS terdaftar_p_smk')
        ->selectRaw('CASE WHEN judul_lp = "SMK : JURUSAN ( TOTAL )" THEN penempatan_l_lp ELSE SUM(penempatan_l_lp) END AS penempatan_l_smk')
        ->selectRaw('CASE WHEN judul_lp = "SMK : JURUSAN ( TOTAL )" THEN penempatan_p_lp ELSE SUM(penempatan_p_lp) END AS penempatan_p_smk')
        ->selectRaw('CASE WHEN judul_lp = "SMK : JURUSAN ( TOTAL )" THEN hapus_l_lp ELSE SUM(hapus_l_lp) END AS hapus_l_smk')
        ->selectRaw('CASE WHEN judul_lp = "SMK : JURUSAN ( TOTAL )" THEN hapus_p_lp ELSE SUM(hapus_p_lp) END AS hapus_p_smk')
        ->selectRaw('CASE WHEN judul_lp = "DIPLOMA III/AKTA III/AKADEMI / SARJANA MUDA" THEN sisa_l_lp ELSE SUM(sisa_l_lp) END AS sisa_l_diplo')
        ->selectRaw('CASE WHEN judul_lp = "DIPLOMA III/AKTA III/AKADEMI / SARJANA MUDA" THEN sisa_p_lp ELSE SUM(sisa_p_lp) END AS sisa_p_diplo')
        ->selectRaw('CASE WHEN judul_lp = "DIPLOMA III/AKTA III/AKADEMI / SARJANA MUDA" THEN terdaftar_l_lp ELSE SUM(terdaftar_l_lp) END AS terdaftar_l_diplo')
        ->selectRaw('CASE WHEN judul_lp = "DIPLOMA III/AKTA III/AKADEMI / SARJANA MUDA" THEN terdaftar_p_lp ELSE SUM(terdaftar_p_lp) END AS terdaftar_p_diplo')
        ->selectRaw('CASE WHEN judul_lp = "DIPLOMA III/AKTA III/AKADEMI / SARJANA MUDA" THEN penempatan_l_lp ELSE SUM(penempatan_l_lp) END AS penempatan_l_diplo')
        ->selectRaw('CASE WHEN judul_lp = "DIPLOMA III/AKTA III/AKADEMI / SARJANA MUDA" THEN penempatan_p_lp ELSE SUM(penempatan_p_lp) END AS penempatan_p_diplo')
        ->selectRaw('CASE WHEN judul_lp = "DIPLOMA III/AKTA III/AKADEMI / SARJANA MUDA" THEN hapus_l_lp ELSE SUM(hapus_l_lp) END AS hapus_l_diplo')
        ->selectRaw('CASE WHEN judul_lp = "DIPLOMA III/AKTA III/AKADEMI / SARJANA MUDA" THEN hapus_p_lp ELSE SUM(hapus_p_lp) END AS hapus_p_diplo')
        ->selectRaw('CASE WHEN judul_lp = "SARJANA ( S1 )" THEN sisa_l_lp ELSE SUM(sisa_l_lp) END AS sisa_l_s')
        ->selectRaw('CASE WHEN judul_lp = "SARJANA ( S1 )" THEN sisa_p_lp ELSE SUM(sisa_p_lp) END AS sisa_p_s')
        ->selectRaw('CASE WHEN judul_lp = "SARJANA ( S1 )" THEN terdaftar_l_lp ELSE SUM(terdaftar_l_lp) END AS terdaftar_l_s')
        ->selectRaw('CASE WHEN judul_lp = "SARJANA ( S1 )" THEN terdaftar_p_lp ELSE SUM(terdaftar_p_lp) END AS terdaftar_p_s')
        ->selectRaw('CASE WHEN judul_lp = "SARJANA ( S1 )" THEN penempatan_l_lp ELSE SUM(penempatan_l_lp) END AS penempatan_l_s')
        ->selectRaw('CASE WHEN judul_lp = "SARJANA ( S1 )" THEN penempatan_p_lp ELSE SUM(penempatan_p_lp) END AS penempatan_p_s')
        ->selectRaw('CASE WHEN judul_lp = "SARJANA ( S1 )" THEN hapus_l_lp ELSE SUM(hapus_l_lp) END AS hapus_l_s')
        ->selectRaw('CASE WHEN judul_lp = "SARJANA ( S1 )" THEN hapus_p_lp ELSE SUM(hapus_p_lp) END AS hapus_p_s')
        ->selectRaw('CASE WHEN judul_lp = "PASCA SARJANA ( S2 )" THEN sisa_l_lp ELSE SUM(sisa_l_lp) END AS sisa_l_ss')
        ->selectRaw('CASE WHEN judul_lp = "PASCA SARJANA ( S2 )" THEN sisa_p_lp ELSE SUM(sisa_p_lp) END AS sisa_p_ss')
        ->selectRaw('CASE WHEN judul_lp = "PASCA SARJANA ( S2 )" THEN terdaftar_l_lp ELSE SUM(terdaftar_l_lp) END AS terdaftar_l_ss')
        ->selectRaw('CASE WHEN judul_lp = "PASCA SARJANA ( S2 )" THEN terdaftar_p_lp ELSE SUM(terdaftar_p_lp) END AS terdaftar_p_ss')
        ->selectRaw('CASE WHEN judul_lp = "PASCA SARJANA ( S2 )" THEN penempatan_l_lp ELSE SUM(penempatan_l_lp) END AS penempatan_l_ss')
        ->selectRaw('CASE WHEN judul_lp = "PASCA SARJANA ( S2 )" THEN penempatan_p_lp ELSE SUM(penempatan_p_lp) END AS penempatan_p_ss')
        ->selectRaw('CASE WHEN judul_lp = "PASCA SARJANA ( S2 )" THEN hapus_l_lp ELSE SUM(hapus_l_lp) END AS hapus_l_ss')
        ->selectRaw('CASE WHEN judul_lp = "PASCA SARJANA ( S2 )" THEN hapus_p_lp ELSE SUM(hapus_p_lp) END AS hapus_p_ss')
        ->selectRaw('CASE WHEN judul_lp = "JUMLAH TOTAL" THEN sisa_l_lp ELSE SUM(sisa_l_lp) END AS sisa_l_tot')
        ->selectRaw('CASE WHEN judul_lp = "JUMLAH TOTAL" THEN sisa_p_lp ELSE SUM(sisa_p_lp) END AS sisa_p_tot')
        ->selectRaw('CASE WHEN judul_lp = "JUMLAH TOTAL" THEN terdaftar_l_lp ELSE SUM(terdaftar_l_lp) END AS terdaftar_l_tot')
        ->selectRaw('CASE WHEN judul_lp = "JUMLAH TOTAL" THEN terdaftar_p_lp ELSE SUM(terdaftar_p_lp) END AS terdaftar_p_tot')
        ->selectRaw('CASE WHEN judul_lp = "JUMLAH TOTAL" THEN penempatan_l_lp ELSE SUM(penempatan_l_lp) END AS penempatan_l_tot')
        ->selectRaw('CASE WHEN judul_lp = "JUMLAH TOTAL" THEN penempatan_p_lp ELSE SUM(penempatan_p_lp) END AS penempatan_p_tot')
        ->selectRaw('CASE WHEN judul_lp = "JUMLAH TOTAL" THEN hapus_l_lp ELSE SUM(hapus_l_lp) END AS hapus_l_tot')
        ->selectRaw('CASE WHEN judul_lp = "JUMLAH TOTAL" THEN hapus_p_lp ELSE SUM(hapus_p_lp) END AS hapus_p_tot')
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
        return 'tbl4.11';
    }
}