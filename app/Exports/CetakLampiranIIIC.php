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
    private $lambang;

    public function __construct($id, $lambang)
    {
        $this->id = $id;
        $this->lambang = $lambang;
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setPath(public_path('storage/icon-lembaga/'. $this->lambang));
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
            'A8:L49' => [
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
            'B12:L13' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A14:L15' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A14:B15' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A15' => [
                'font' => [
                    'color' => ['rgb' => 'F2F2F2'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B18:L18' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'B18' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A26:B28' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A28:L28' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A35:L35' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A35:B35' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A42:L42' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A42:B42' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A49:L49' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A49:B49' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A49' => [
                'font' => [
                    'color' => ['rgb' => 'F2F2F2'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],

            // Default Aturan  
            'A8:A49' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B12:B49' => [
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
        $disnaker = PemangkuKepentingan::where('email_lembaga', $this->id)->first();
        $semester = DataJenisPendidikan::where('id_disnaker', $this->id)->where('type','Lampiran')->first();
        if($disnaker->status_lembaga == 0){
            $title = 'LAPORAN IPK III/1 - IKHTISAR STATISTIK ANTAR KERJA PROPINSI SUMATERA BARAT';
        }elseif($semester->type == 'Lampiran'){
            $title = 'TABEL. 9';
        }else{
            $title = 'LAPORAN IPK III/1 - IKHTISAR STATISTIK ANTAR KERJA KAB/KOTA' . strtoupper(substr($disnaker->nama_lembaga, 18));
        }
        $start = 1000;
        $end = 7600;
        $data = DB::table('data_jenis_pendidikans')
        ->where('id_disnaker', $this->id)->where('type','Lampiran')
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('nmr', [$start, $end])
                    ->orWhere('nmr', '4.9')
                    ->orWhere('nmr', '300');
        })
        ->get();

        $results = DB::table('data_jenis_pendidikans')
        ->select('judul', 'nmr', 'akhir_l', 'akhir_p')
        ->whereBetween('nmr', [$start, $end])->where('type','Lampiran')
        ->orWhere('nmr', '4.9')
        ->orWhere('nmr', '300')
        ->selectRaw('CASE WHEN judul = " TOTAL : SLTA /SMK /D.I/D.II " THEN sisa_l ELSE SUM(sisa_l) END AS sisa_l')
        ->selectRaw('CASE WHEN judul = " TOTAL : SLTA /SMK /D.I/D.II " THEN sisa_p ELSE SUM(sisa_p) END AS sisa_p')
        ->selectRaw('CASE WHEN judul = " TOTAL : SLTA /SMK /D.I/D.II " THEN terdaftar_l ELSE SUM(terdaftar_l) END AS terdaftar_l')
        ->selectRaw('CASE WHEN judul = " TOTAL : SLTA /SMK /D.I/D.II " THEN terdaftar_p ELSE SUM(terdaftar_p) END AS terdaftar_p')
        ->selectRaw('CASE WHEN judul = " TOTAL : SLTA /SMK /D.I/D.II " THEN penempatan_l ELSE SUM(penempatan_l) END AS penempatan_l')
        ->selectRaw('CASE WHEN judul = " TOTAL : SLTA /SMK /D.I/D.II " THEN penempatan_p ELSE SUM(penempatan_p) END AS penempatan_p')
        ->selectRaw('CASE WHEN judul = " TOTAL : SLTA /SMK /D.I/D.II " THEN hapus_l ELSE SUM(hapus_l) END AS hapus_l')
        ->selectRaw('CASE WHEN judul = " TOTAL : SLTA /SMK /D.I/D.II " THEN hapus_p ELSE SUM(hapus_p) END AS hapus_p')
        ->selectRaw('CASE WHEN judul = "JUMLAH     SMA" THEN sisa_l ELSE SUM(sisa_l) END AS sisa_l_sma')
        ->selectRaw('CASE WHEN judul = "JUMLAH     SMA" THEN sisa_p ELSE SUM(sisa_p) END AS sisa_p_sma')
        ->selectRaw('CASE WHEN judul = "JUMLAH     SMA" THEN terdaftar_l ELSE SUM(terdaftar_l) END AS terdaftar_l_sma')
        ->selectRaw('CASE WHEN judul = "JUMLAH     SMA" THEN terdaftar_p ELSE SUM(terdaftar_p) END AS terdaftar_p_sma')
        ->selectRaw('CASE WHEN judul = "JUMLAH     SMA" THEN penempatan_l ELSE SUM(penempatan_l) END AS penempatan_l_sma')
        ->selectRaw('CASE WHEN judul = "JUMLAH     SMA" THEN penempatan_p ELSE SUM(penempatan_p) END AS penempatan_p_sma')
        ->selectRaw('CASE WHEN judul = "JUMLAH     SMA" THEN hapus_l ELSE SUM(hapus_l) END AS hapus_l_sma')
        ->selectRaw('CASE WHEN judul = "JUMLAH     SMA" THEN hapus_p ELSE SUM(hapus_p) END AS hapus_p_sma')
        ->selectRaw('CASE WHEN judul = "JUMLAH    SMK " THEN sisa_l ELSE SUM(sisa_l) END AS sisa_l_smk')
        ->selectRaw('CASE WHEN judul = "JUMLAH    SMK " THEN sisa_p ELSE SUM(sisa_p) END AS sisa_p_smk')
        ->selectRaw('CASE WHEN judul = "JUMLAH    SMK " THEN terdaftar_l ELSE SUM(terdaftar_l) END AS terdaftar_l_smk')
        ->selectRaw('CASE WHEN judul = "JUMLAH    SMK " THEN terdaftar_p ELSE SUM(terdaftar_p) END AS terdaftar_p_smk')
        ->selectRaw('CASE WHEN judul = "JUMLAH    SMK " THEN penempatan_l ELSE SUM(penempatan_l) END AS penempatan_l_smk')
        ->selectRaw('CASE WHEN judul = "JUMLAH    SMK " THEN penempatan_p ELSE SUM(penempatan_p) END AS penempatan_p_smk')
        ->selectRaw('CASE WHEN judul = "JUMLAH    SMK " THEN hapus_l ELSE SUM(hapus_l) END AS hapus_l_smk')
        ->selectRaw('CASE WHEN judul = "JUMLAH    SMK " THEN hapus_p ELSE SUM(hapus_p) END AS hapus_p_smk')
        ->selectRaw('CASE WHEN judul = "DIPLOMA III/AKTA III/AKADEMI / " THEN sisa_l ELSE SUM(sisa_l) END AS sisa_l_d')
        ->selectRaw('CASE WHEN judul = "DIPLOMA III/AKTA III/AKADEMI / " THEN sisa_p ELSE SUM(sisa_p) END AS sisa_p_d')
        ->selectRaw('CASE WHEN judul = "DIPLOMA III/AKTA III/AKADEMI / " THEN terdaftar_l ELSE SUM(terdaftar_l) END AS terdaftar_l_d')
        ->selectRaw('CASE WHEN judul = "DIPLOMA III/AKTA III/AKADEMI / " THEN terdaftar_p ELSE SUM(terdaftar_p) END AS terdaftar_p_d')
        ->selectRaw('CASE WHEN judul = "DIPLOMA III/AKTA III/AKADEMI / " THEN penempatan_l ELSE SUM(penempatan_l) END AS penempatan_l_d')
        ->selectRaw('CASE WHEN judul = "DIPLOMA III/AKTA III/AKADEMI / " THEN penempatan_p ELSE SUM(penempatan_p) END AS penempatan_p_d')
        ->selectRaw('CASE WHEN judul = "DIPLOMA III/AKTA III/AKADEMI / " THEN hapus_l ELSE SUM(hapus_l) END AS hapus_l_d')
        ->selectRaw('CASE WHEN judul = "DIPLOMA III/AKTA III/AKADEMI / " THEN hapus_p ELSE SUM(hapus_p) END AS hapus_p_d')
        ->selectRaw('CASE WHEN judul = "SARJANA ( S1 )" THEN sisa_l ELSE SUM(sisa_l) END AS sisa_l_s')
        ->selectRaw('CASE WHEN judul = "SARJANA ( S1 )" THEN sisa_p ELSE SUM(sisa_p) END AS sisa_p_s')
        ->selectRaw('CASE WHEN judul = "SARJANA ( S1 )" THEN terdaftar_l ELSE SUM(terdaftar_l) END AS terdaftar_l_s')
        ->selectRaw('CASE WHEN judul = "SARJANA ( S1 )" THEN terdaftar_p ELSE SUM(terdaftar_p) END AS terdaftar_p_s')
        ->selectRaw('CASE WHEN judul = "SARJANA ( S1 )" THEN penempatan_l ELSE SUM(penempatan_l) END AS penempatan_l_s')
        ->selectRaw('CASE WHEN judul = "SARJANA ( S1 )" THEN penempatan_p ELSE SUM(penempatan_p) END AS penempatan_p_s')
        ->selectRaw('CASE WHEN judul = "SARJANA ( S1 )" THEN hapus_l ELSE SUM(hapus_l) END AS hapus_l_s')
        ->selectRaw('CASE WHEN judul = "SARJANA ( S1 )" THEN hapus_p ELSE SUM(hapus_p) END AS hapus_p_s')
        ->selectRaw('CASE WHEN judul = "PASCA SARJANA ( S2 )" THEN sisa_l ELSE SUM(sisa_l) END AS sisa_l_ss')
        ->selectRaw('CASE WHEN judul = "PASCA SARJANA ( S2 )" THEN sisa_p ELSE SUM(sisa_p) END AS sisa_p_ss')
        ->selectRaw('CASE WHEN judul = "PASCA SARJANA ( S2 )" THEN terdaftar_l ELSE SUM(terdaftar_l) END AS terdaftar_l_ss')
        ->selectRaw('CASE WHEN judul = "PASCA SARJANA ( S2 )" THEN terdaftar_p ELSE SUM(terdaftar_p) END AS terdaftar_p_ss')
        ->selectRaw('CASE WHEN judul = "PASCA SARJANA ( S2 )" THEN penempatan_l ELSE SUM(penempatan_l) END AS penempatan_l_ss')
        ->selectRaw('CASE WHEN judul = "PASCA SARJANA ( S2 )" THEN penempatan_p ELSE SUM(penempatan_p) END AS penempatan_p_ss')
        ->selectRaw('CASE WHEN judul = "PASCA SARJANA ( S2 )" THEN hapus_l ELSE SUM(hapus_l) END AS hapus_l_ss')
        ->selectRaw('CASE WHEN judul = "PASCA SARJANA ( S2 )" THEN hapus_p ELSE SUM(hapus_p) END AS hapus_p_ss')
        ->selectRaw('CASE WHEN judul = "JUMLAH TOTAL" THEN sisa_l ELSE SUM(sisa_l) END AS sisa_l_tot')
        ->selectRaw('CASE WHEN judul = "JUMLAH TOTAL" THEN sisa_p ELSE SUM(sisa_p) END AS sisa_p_tot')
        ->selectRaw('CASE WHEN judul = "JUMLAH TOTAL" THEN terdaftar_l ELSE SUM(terdaftar_l) END AS terdaftar_l_tot')
        ->selectRaw('CASE WHEN judul = "JUMLAH TOTAL" THEN terdaftar_p ELSE SUM(terdaftar_p) END AS terdaftar_p_tot')
        ->selectRaw('CASE WHEN judul = "JUMLAH TOTAL" THEN penempatan_l ELSE SUM(penempatan_l) END AS penempatan_l_tot')
        ->selectRaw('CASE WHEN judul = "JUMLAH TOTAL" THEN penempatan_p ELSE SUM(penempatan_p) END AS penempatan_p_tot')
        ->selectRaw('CASE WHEN judul = "JUMLAH TOTAL" THEN hapus_l ELSE SUM(hapus_l) END AS hapus_l_tot')
        ->selectRaw('CASE WHEN judul = "JUMLAH TOTAL" THEN hapus_p ELSE SUM(hapus_p) END AS hapus_p_tot')
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
