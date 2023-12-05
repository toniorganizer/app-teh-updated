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

class CetakLampiranIIIG implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
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
            'A8:L33' => [
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
            'A33:L33' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A33:B33' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A33' => [
                'font' => [
                    'color' => ['rgb' => 'F2F2F2'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],

            // Default Aturan  
            'A8:A33' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B12:B33' => [
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
            $semester = DataGolonganUsaha::where('type','Lampiran')->first();
        }else{
            $semester = DataGolonganUsaha::where('id_disnaker', $this->id)->where('type','Lampiran')->first();
        }
        if($disnaker->status_lembaga == 0){
            $title = 'LAPORAN IPK III/1 - IKHTISAR STATISTIK ANTAR KERJA PROPINSI SUMATERA BARAT';
        }elseif($semester->type == 'Lampiran'){
            $title = 'TABEL. 13';
        }else{
            $title = 'LAPORAN IPK III/1 - IKHTISAR STATISTIK ANTAR KERJA KAB/KOTA' . strtoupper(substr($disnaker->nama_lembaga, 18));
        }
        $start = 'A';
        $end = 'U';
        $id_kadis = DataGolonganUsaha::where('id_disnaker', $this->id)->where('type', 'Lampiran')->first();
        if(is_null($id_kadis)){
            $data = DB::table('data_golongan_usahas')->join('pemangku_kepentingans', 'pemangku_kepentingans.id_disnaker_kab','=','data_golongan_usahas.id_disnaker')->where('email_lembaga', $this->id)->where('type','Lampiran')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('nmr', [$start, $end])
                        ->orWhere('nmr', '4.13');
            })
            ->get();
        }else{
            $data = DB::table('data_golongan_usahas')
            ->where('id_disnaker', $this->id)->where('type','Lampiran')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('nmr', [$start, $end])
                        ->orWhere('nmr', '4.13');
            })
            ->get();
        }


        $results = DB::table('data_golongan_usahas')->join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_golongan_usahas.id_disnaker')->where('role_acc', 1)
        ->select('judul_gu', 'nmr', 'akhir_l_gu', 'akhir_p_gu')->where('type','Lampiran')
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('nmr', [$start, $end])
                    ->orWhere('nmr', '4.13');
        })
        ->selectRaw('CASE WHEN judul_gu = "JUMLAH TOTAL" THEN sisa_l_gu ELSE SUM(sisa_l_gu) END AS sisa_l')
        ->selectRaw('CASE WHEN judul_gu = "JUMLAH TOTAL" THEN sisa_p_gu ELSE SUM(sisa_p_gu) END AS sisa_p')
        ->selectRaw('CASE WHEN judul_gu = "JUMLAH TOTAL" THEN terdaftar_l_gu ELSE SUM(terdaftar_l_gu) END AS terdaftar_l')
        ->selectRaw('CASE WHEN judul_gu = "JUMLAH TOTAL" THEN terdaftar_p_gu ELSE SUM(terdaftar_p_gu) END AS terdaftar_p')
        ->selectRaw('CASE WHEN judul_gu = "JUMLAH TOTAL" THEN penempatan_l_gu ELSE SUM(penempatan_l_gu) END AS penempatan_l')
        ->selectRaw('CASE WHEN judul_gu = "JUMLAH TOTAL" THEN penempatan_p_gu ELSE SUM(penempatan_p_gu) END AS penempatan_p')
        ->selectRaw('CASE WHEN judul_gu = "JUMLAH TOTAL" THEN hapus_l_gu ELSE SUM(hapus_l_gu) END AS hapus_l')
        ->selectRaw('CASE WHEN judul_gu = "JUMLAH TOTAL" THEN hapus_p_gu ELSE SUM(hapus_p_gu) END AS hapus_p')
        ->groupBy('judul_gu', 'nmr', 'akhir_l_gu', 'akhir_p_gu')
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
        return 'TBL4.13';
    }
}
