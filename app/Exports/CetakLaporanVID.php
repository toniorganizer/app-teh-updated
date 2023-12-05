<?php

namespace App\Exports;

use App\Models\DataGolonganUsaha;
use App\Models\Laporan;
use App\Models\DataPencariKerja;
use Illuminate\Support\Facades\DB;
use App\Models\DataJenisPendidikan;
use App\Models\DataLowonganJabatan;
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

class CetakLaporanVID implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
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
            'A8:L63' => [
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
            'A12:B12' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C12:L12' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A12:B12' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'B24:L24' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C24:L24' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A24' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B24' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A25:B25' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C25:L25' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A25:B25' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'B29:L29' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C29:L29' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A29' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B29' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A30:B30' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C30:L30' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A30:B30' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'B37:L37' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C37:L37' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A37' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B37' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A38:B38' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C38:L38' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A38:B38' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'B43:L43' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C43:L43' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A43' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B43' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A44:B44' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C44:L44' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A44:B44' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'B48:L48' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C48:L48' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A48' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B48' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A49:B49' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C49:L49' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A49:B49' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'B55:L55' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C55:L55' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A55' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B55' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A56:B56' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C56:L56' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A56:B56' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'B59:L59' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C59:L59' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A59' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B59' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A60:B60' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C60:L60' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A60:B60' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'B62:L62' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C62:L62' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A62' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B62' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A63:B63' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A63:B63' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A63' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B63' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],

            // Default Aturan  
            'A8:A63' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B12:B63' => [
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
        $semester = DataGolonganUsaha::where('id_disnaker', $this->id)->first();
        if(is_null($semester)){
            $semester = DataGolonganUsaha::where('type','Laporan')->first();
        }else{
            $semester = DataGolonganUsaha::where('id_disnaker', $this->id)->where('type','Laporan')->first();
        }
        if($disnaker->status_lembaga == 0){
            $title = 'LAPORAN IPK III/6-LOWONGAN DIRINCI MENURUT GOL.SEKTOR PROPINSI SUMATERA BARAT';
        }elseif($semester->type == 'Lampiran'){
            $title = 'TABEL 4. 1';
        }else{
            $title = 'LAPORAN IPK III/6-LOWONGAN DIRINCI MENURUT GOL.SEKTOR KAB/KOTA' . strtoupper(substr($disnaker->nama_lembaga, 18));
        }
        $start = 771;
        $end = 990;
        $id_kadis = DataGolonganUsaha::where('id_disnaker', $this->id)->where('type', 'Laporan')->first();

        if(is_null($id_kadis)){
            $data = DB::table('data_golongan_usahas')->join('pemangku_kepentingans', 'pemangku_kepentingans.id_disnaker_kab','=','data_golongan_usahas.id_disnaker')->where('email_lembaga', $this->id)->where('type','Laporan')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('nmr', [771, 990])
                    ->orWhere('nmr', '04')
                    ->orWhereIn('nmr', ['N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U']);
            })
            ->skip(5) 
            ->take(52)
            ->get();
        }else{
            $data = DB::table('data_golongan_usahas')
            ->where('id_disnaker', $this->id)->where('type','Laporan')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('nmr', [771, 990])
                    ->orWhere('nmr', '04')
                    ->orWhereIn('nmr', ['N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U']);
            })
            ->skip(5) 
            ->take(52)
            ->get();
        }
        
            

        $results = DB::table('data_golongan_usahas')->join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_golongan_usahas.id_disnaker')->where('role_acc', 1)
        ->select('judul_gu', 'nmr', 'akhir_l_gu', 'akhir_p_gu')->where('type','Laporan')
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('nmr', [771, 990])
                ->orWhere('nmr', '04')
                ->orWhereIn('nmr', ['N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U']);
        })
        ->selectRaw('CASE WHEN judul_gu = "Sub Total" THEN sisa_l_gu ELSE SUM(sisa_l_gu) END AS sisa_l')
        ->selectRaw('CASE WHEN judul_gu = "Sub Total" THEN sisa_p_gu ELSE SUM(sisa_p_gu) END AS sisa_p')
        ->selectRaw('CASE WHEN judul_gu = "Sub Total" THEN terdaftar_l_gu ELSE SUM(terdaftar_l_gu) END AS terdaftar_l')
        ->selectRaw('CASE WHEN judul_gu = "Sub Total" THEN terdaftar_p_gu ELSE SUM(terdaftar_p_gu) END AS terdaftar_p')
        ->selectRaw('CASE WHEN judul_gu = "Sub Total" THEN penempatan_l_gu ELSE SUM(penempatan_l_gu) END AS penempatan_l')
        ->selectRaw('CASE WHEN judul_gu = "Sub Total" THEN penempatan_p_gu ELSE SUM(penempatan_p_gu) END AS penempatan_p')
        ->selectRaw('CASE WHEN judul_gu = "Sub Total" THEN hapus_l_gu ELSE SUM(hapus_l_gu) END AS hapus_l')
        ->selectRaw('CASE WHEN judul_gu = "Sub Total" THEN hapus_p_gu ELSE SUM(hapus_p_gu) END AS hapus_p')
        ->selectRaw('CASE WHEN judul_gu = "TOTAL" THEN sisa_l_gu ELSE SUM(sisa_l_gu) END AS sisa_l_s')
        ->selectRaw('CASE WHEN judul_gu = "TOTAL" THEN sisa_p_gu ELSE SUM(sisa_p_gu) END AS sisa_p_s')
        ->selectRaw('CASE WHEN judul_gu = "TOTAL" THEN terdaftar_l_gu ELSE SUM(terdaftar_l_gu) END AS terdaftar_l_s')
        ->selectRaw('CASE WHEN judul_gu = "TOTAL" THEN terdaftar_p_gu ELSE SUM(terdaftar_p_gu) END AS terdaftar_p_s')
        ->selectRaw('CASE WHEN judul_gu = "TOTAL" THEN penempatan_l_gu ELSE SUM(penempatan_l_gu) END AS penempatan_l_s')
        ->selectRaw('CASE WHEN judul_gu = "TOTAL" THEN penempatan_p_gu ELSE SUM(penempatan_p_gu) END AS penempatan_p_s')
        ->selectRaw('CASE WHEN judul_gu = "TOTAL" THEN hapus_l_gu ELSE SUM(hapus_l_gu) END AS hapus_l_s')
        ->selectRaw('CASE WHEN judul_gu = "TOTAL" THEN hapus_p_gu ELSE SUM(hapus_p_gu) END AS hapus_p_s')
        ->groupBy('judul_gu', 'nmr', 'akhir_l_gu', 'akhir_p_gu')
        ->skip(5) 
        ->take(52)
        ->oldest('id')
        ->get();

        return view('Dashboard.admin.cetak-laporan-iii-vi')->with([
            'data' => $data,
            'title' => $title,
            'semester' => $semester,
            'disnaker' => $disnaker,
            'laporan' => $results
        ]);
    }

    public function title(): string
    {
        return 'Sheet4';
    }
}
