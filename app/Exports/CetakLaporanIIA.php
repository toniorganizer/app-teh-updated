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

class CetakLaporanIIA implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
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
        $disnaker = PemangkuKepentingan::where('email_lembaga', $this->id)->first();
        $semester = DataJenisPendidikan::where('id_disnaker', $this->id)->first();
        if(is_null($semester)){
            $semester = DataJenisPendidikan::where('type','Laporan')->first();
        }else{
            $semester = DataJenisPendidikan::where('id_disnaker', $this->id)->where('type','Laporan')->first();
        }
        if($disnaker->status_lembaga == 0){
            $title = 'LAPORAN IPK III/2 - IKHTISAR STATISTIK ANTAR KERJA PROPINSI SUMATERA BARAT';
        }elseif($semester->type == 'Lampiran'){
            $title = 'TABEL 4. 1';
        }else{
            $title = 'LAPORAN IPK III/2 - IKHTISAR STATISTIK ANTAR KERJA KAB/KOTA' . strtoupper(substr($disnaker->nama_lembaga, 18));
        }

        $start = 1000;
        $end = 3203;

        $id_kadis = DataJenisPendidikan::where('id_disnaker', $this->id)->where('type', 'Laporan')->first();
        if(is_null($id_kadis)){
            $data = DB::table('data_jenis_pendidikans')->join('pemangku_kepentingans', 'pemangku_kepentingans.id_disnaker_kab','=','data_jenis_pendidikans.id_disnaker')
            ->where('email_lembaga', $this->id)->where('type','Laporan')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('nmr', [$start, $end])
                        ->orWhere('nmr', 01)
                        ->orWhere('nmr', 3801)->orWhere('nmr', 3802);
            })
            ->get();
        }else{
            $data = DB::table('data_jenis_pendidikans')
            ->where('id_disnaker', $this->id)->where('type','Laporan')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('nmr', [$start, $end])
                        ->orWhere('nmr', 01)
                        ->orWhere('nmr', 3801)->orWhere('nmr', 3802);
            })
            ->get();
        }

        $results = DB::table('data_jenis_pendidikans')->join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_jenis_pendidikans.id_disnaker')->where('role_acc', 1)
        ->select('judul', 'nmr', 'akhir_l', 'akhir_p', 'type')
        ->whereBetween('nmr', [$start, $end])->where('type','Laporan')
        ->orWhere('nmr', 01)->orWhere('nmr', 3801)->orWhere('nmr', 3802)
        ->selectRaw('CASE WHEN judul = "Sub Total" THEN sisa_l ELSE SUM(sisa_l) END AS sisa_l')
        ->selectRaw('CASE WHEN judul = "Sub Total" THEN sisa_p ELSE SUM(sisa_p) END AS sisa_p')
        ->selectRaw('CASE WHEN judul = "Sub Total" THEN terdaftar_l ELSE SUM(terdaftar_l) END AS terdaftar_l')
        ->selectRaw('CASE WHEN judul = "Sub Total" THEN terdaftar_p ELSE SUM(terdaftar_p) END AS terdaftar_p')
        ->selectRaw('CASE WHEN judul = "Sub Total" THEN penempatan_l ELSE SUM(penempatan_l) END AS penempatan_l')
        ->selectRaw('CASE WHEN judul = "Sub Total" THEN penempatan_p ELSE SUM(penempatan_p) END AS penempatan_p')
        ->selectRaw('CASE WHEN judul = "Sub Total" THEN hapus_l ELSE SUM(hapus_l) END AS hapus_l')
        ->selectRaw('CASE WHEN judul = "Sub Total" THEN hapus_p ELSE SUM(hapus_p) END AS hapus_p')
        ->selectRaw('CASE WHEN judul = "0" THEN sisa_l ELSE SUM(sisa_l) END AS sisa_l_s')
        ->selectRaw('CASE WHEN judul = "0" THEN sisa_p ELSE SUM(sisa_p) END AS sisa_p_s')
        ->selectRaw('CASE WHEN judul = "0" THEN terdaftar_l ELSE SUM(terdaftar_l) END AS terdaftar_l_s')
        ->selectRaw('CASE WHEN judul = "0" THEN terdaftar_p ELSE SUM(terdaftar_p) END AS terdaftar_p_s')
        ->selectRaw('CASE WHEN judul = "0" THEN penempatan_l ELSE SUM(penempatan_l) END AS penempatan_l_s')
        ->selectRaw('CASE WHEN judul = "0" THEN penempatan_p ELSE SUM(penempatan_p) END AS penempatan_p_s')
        ->selectRaw('CASE WHEN judul = "0" THEN hapus_l ELSE SUM(hapus_l) END AS hapus_l_s')
        ->selectRaw('CASE WHEN judul = "0" THEN hapus_p ELSE SUM(hapus_p) END AS hapus_p_s')
        ->groupBy('judul', 'nmr', 'akhir_l', 'akhir_p', 'type')
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
        return 'Sheet1';
    }
}
