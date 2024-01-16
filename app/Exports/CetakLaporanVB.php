<?php

namespace App\Exports;

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

class CetakLaporanVB implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
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
            'A8:L64' => [
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
            'B50:L50' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C50:L50' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A50' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B50' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],  
            'A51:B51' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C51:L51' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A51:B51' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            

            // Default Aturan  
            'A8:A64' => [
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
        $semester = DataLowonganJabatan::where('id_disnaker', $this->id)->first();
        if(is_null($semester)){
            $semester = DataLowonganJabatan::where('type','Laporan')->first();
        }else{
            $semester = DataLowonganJabatan::where('id_disnaker', $this->id)->where('type','Laporan')->first();
        }
        if($disnaker->status_lembaga == 0){
            $title = 'LAPORAN IPK III/5 - LOWONGAN DIRINCI MENURUT GOL.JABATAN PROPINSI SUMATERA BARAT';
        }elseif($semester->type == 'Lampiran'){
            $title = 'TABEL 4. 1';
        }else{
            $title = 'LAPORAN IPK III/5 - LOWONGAN DIRINCI MENURUT GOL.JABATAN KAB/KOTA' . strtoupper(substr($disnaker->nama_lembaga, 18));
        }
        $start = 2146;
        $end = 3131;
        $id_kadis = DataLowonganJabatan::where('id_disnaker', $this->id)->where('type', 'Laporan')->first();

        if(is_null($id_kadis)){
            $data = DB::table('data_lowongan_jabatans')->join('pemangku_kepentingans', 'pemangku_kepentingans.id_disnaker_kab','=','data_lowongan_jabatans.id_disnaker')->where('email_lembaga', $this->id)->where('type','Laporan')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('nmr', [$start, $end])
                        ->orWhere('nmr', '02')
                        ->orWhere('nmr', '3');
            })
            ->get();
        }else{
            $data = DB::table('data_lowongan_jabatans')
            ->where('id_disnaker', $this->id)->where('type','Laporan')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('nmr', [$start, $end])
                        ->orWhere('nmr', '02')
                        ->orWhere('nmr', '3');
            })
            ->get();
        }


        $results = DB::table('data_lowongan_jabatans')->join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_lowongan_jabatans.id_disnaker')->where('role_acc', 1)
        ->select('judul_lj', 'nmr', 'akhir_l_lj', 'akhir_p_lj')->where('type','Laporan')
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('nmr', [$start, $end])
                    ->orWhere('nmr', '02')
                    ->orWhere('nmr', '3');
        })
        ->selectRaw('CASE WHEN judul_lj = "Sub Total" THEN sisa_l_lj ELSE SUM(sisa_l_lj) END AS sisa_l')
        ->selectRaw('CASE WHEN judul_lj = "Sub Total" THEN sisa_p_lj ELSE SUM(sisa_p_lj) END AS sisa_p')
        ->selectRaw('CASE WHEN judul_lj = "Sub Total" THEN terdaftar_l_lj ELSE SUM(terdaftar_l_lj) END AS terdaftar_l')
        ->selectRaw('CASE WHEN judul_lj = "Sub Total" THEN terdaftar_p_lj ELSE SUM(terdaftar_p_lj) END AS terdaftar_p')
        ->selectRaw('CASE WHEN judul_lj = "Sub Total" THEN penempatan_l_lj ELSE SUM(penempatan_l_lj) END AS penempatan_l')
        ->selectRaw('CASE WHEN judul_lj = "Sub Total" THEN penempatan_p_lj ELSE SUM(penempatan_p_lj) END AS penempatan_p')
        ->selectRaw('CASE WHEN judul_lj = "Sub Total" THEN hapus_l_lj ELSE SUM(hapus_l_lj) END AS hapus_l')
        ->selectRaw('CASE WHEN judul_lj = "Sub Total" THEN hapus_p_lj ELSE SUM(hapus_p_lj) END AS hapus_p')
        ->groupBy('judul_lj', 'nmr', 'akhir_l_lj', 'akhir_p_lj')
        ->oldest('id')
        ->get();

        return view('dashboard.admin.cetak-laporan-iii-v')->with([
            'data' => $data,
            'title' => $title,
            'semester' => $semester,
            'disnaker' => $disnaker,
            'laporan' => $results
        ]);
    }

    public function title(): string
    {
        return 'Sheet2';
    }
}
