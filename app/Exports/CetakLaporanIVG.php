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

class CetakLaporanIVG implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
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
            'A8:L69' => [
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
            'B27:L27' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C27:L27' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A27' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B27' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A28:B28' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C28:L28' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B69:L69' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C69:L69' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A69' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B69' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],

            // Default Aturan  
            'A8:A69' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B12:B69' => [
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
        $disnaker = PemangkuKepentingan::where('email_lembaga', $this->id)->first();
        $semester = DataLowonganPendidikan::where('id_disnaker', $this->id)->where('type','Laporan')->first();
        if($disnaker->status_lembaga == 0){
            $title = 'LAPORAN IPK III/4 - LOWONGAN DIRINCI MENURUT PENDIDIKAN PROPINSI SUMATERA BARAT';
        }elseif($semester->type == 'Lampiran'){
            $title = 'TABEL 4. 1';
        }else{
            $title = 'LAPORAN IPK III/4 - LOWONGAN DIRINCI MENURUT PENDIDIKAN KAB/KOTA' . strtoupper(substr($disnaker->nama_lembaga, 18));
        }
        $start = 6515;
        $end = 6699;
        $data = DB::table('data_lowongan_pendidikans')
        ->where('id_disnaker', $this->id)->where('type','Laporan')
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('nmr', [$start, $end])
                    ->orWhere('nmr', 07);
        })
        ->get();

        $results = DB::table('data_lowongan_pendidikans')
        ->select('judul_lp', 'nmr', 'akhir_l_lp', 'akhir_p_lp')
        ->whereBetween('nmr', [$start, $end])->where('type','Laporan')
        ->orWhere('nmr', 07)
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
        return 'Sheet12';
    }
}
