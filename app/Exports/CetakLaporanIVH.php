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

class CetakLaporanIVH implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
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
            'A8:L68' => [
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
                    'color' => ['rgb' => 'FF0000'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C12:L12' => [
                'font' => [
                    'color' => ['rgb' => 'F2F2F2'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A12:L12' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A13:B13' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C13:L13' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B22:L22' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C22:L22' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A22' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B22' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A23:B23' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C23:L23' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B28:L28' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C28:L28' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A28' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B28' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A29:B29' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C29:L29' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
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
            'A41:B41' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C41:L41' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B46:L46' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C46:L46' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A46' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B46' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A47:B47' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C47:L47' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B68:L68' => [
                'font' => [
                    'color' => ['rgb' => '4472C4'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C68:L68' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A68' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B68' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],


            // Default Aturan  
            'A8:A68' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B12:B68' => [
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
        $semester = DataLowonganPendidikan::where('id_disnaker', $this->id)->first();
        if(is_null($semester)){
            $semester = DataLowonganPendidikan::where('type','Laporan')->first();
        }else{
            $semester = DataLowonganPendidikan::where('id_disnaker', $this->id)->where('type','Laporan')->first(); 
        }
        if($disnaker->status_lembaga == 0){
            $title = 'LAPORAN IPK III/4 - LOWONGAN DIRINCI MENURUT PENDIDIKAN PROPINSI SUMATERA BARAT';
        }elseif($semester->type == 'Lampiran'){
            $title = 'TABEL 4. 1';
        }else{
            $title = 'LAPORAN IPK III/4 - LOWONGAN DIRINCI MENURUT PENDIDIKAN KAB/KOTA' . strtoupper(substr($disnaker->nama_lembaga, 18));
        }
        $start = 7000;
        $end = 7599;
        $id_kadis = DataLowonganPendidikan::where('id_disnaker', $this->id)->where('type', 'Laporan')->first();

        if(is_null($id_kadis)){
            $data = DB::table('data_lowongan_pendidikans')->join('pemangku_kepentingans', 'pemangku_kepentingans.id_disnaker_kab','=','data_lowongan_pendidikans.id_disnaker')->where('email_lembaga', $this->id)->where('type','Laporan')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('nmr', [$start, $end])
                        ->orWhere('nmr', '08');
            })
            ->get();
        }else{
            $data = DB::table('data_lowongan_pendidikans')
            ->where('id_disnaker', $this->id)->where('type','Laporan')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('nmr', [$start, $end])
                        ->orWhere('nmr', '08');
            })
            ->get();
        }

        $results = DB::table('data_lowongan_pendidikans')->join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_lowongan_pendidikans.id_disnaker')->where('role_acc', 1)
        ->select('judul_lp', 'nmr', 'akhir_l_lp', 'akhir_p_lp')->where('type','Laporan')
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('nmr', [$start, $end])
                    ->orWhere('nmr', '08');
        })
        ->selectRaw('CASE WHEN judul_lp = "Sub Total" THEN sisa_l_lp ELSE SUM(sisa_l_lp) END AS sisa_l')
        ->selectRaw('CASE WHEN judul_lp = "Sub Total" THEN sisa_p_lp ELSE SUM(sisa_p_lp) END AS sisa_p')
        ->selectRaw('CASE WHEN judul_lp = "Sub Total" THEN terdaftar_l_lp ELSE SUM(terdaftar_l_lp) END AS terdaftar_l')
        ->selectRaw('CASE WHEN judul_lp = "Sub Total" THEN terdaftar_p_lp ELSE SUM(terdaftar_p_lp) END AS terdaftar_p')
        ->selectRaw('CASE WHEN judul_lp = "Sub Total" THEN penempatan_l_lp ELSE SUM(penempatan_l_lp) END AS penempatan_l')
        ->selectRaw('CASE WHEN judul_lp = "Sub Total" THEN penempatan_p_lp ELSE SUM(penempatan_p_lp) END AS penempatan_p')
        ->selectRaw('CASE WHEN judul_lp = "Sub Total" THEN hapus_l_lp ELSE SUM(hapus_l_lp) END AS hapus_l')
        ->selectRaw('CASE WHEN judul_lp = "Sub Total" THEN hapus_p_lp ELSE SUM(hapus_p_lp) END AS hapus_p')
        ->selectRaw('CASE WHEN judul_lp = "Total" THEN sisa_l_lp ELSE SUM(sisa_l_lp) END AS sisa_l_s')
        ->selectRaw('CASE WHEN judul_lp = "Total" THEN sisa_p_lp ELSE SUM(sisa_p_lp) END AS sisa_p_s')
        ->selectRaw('CASE WHEN judul_lp = "Total" THEN terdaftar_l_lp ELSE SUM(terdaftar_l_lp) END AS terdaftar_l_s')
        ->selectRaw('CASE WHEN judul_lp = "Total" THEN terdaftar_p_lp ELSE SUM(terdaftar_p_lp) END AS terdaftar_p_s')
        ->selectRaw('CASE WHEN judul_lp = "Total" THEN penempatan_l_lp ELSE SUM(penempatan_l_lp) END AS penempatan_l_s')
        ->selectRaw('CASE WHEN judul_lp = "Total" THEN penempatan_p_lp ELSE SUM(penempatan_p_lp) END AS penempatan_p_s')
        ->selectRaw('CASE WHEN judul_lp = "Total" THEN hapus_l_lp ELSE SUM(hapus_l_lp) END AS hapus_l_s')
        ->selectRaw('CASE WHEN judul_lp = "Total" THEN hapus_p_lp ELSE SUM(hapus_p_lp) END AS hapus_p_s')
        ->groupBy('judul_lp', 'nmr', 'akhir_l_lp', 'akhir_p_lp')
        ->oldest('id')
        ->get();

        return view('dashboard.admin.cetak-laporan-iii-iv')->with([
            'data' => $data,
            'title' => $title,
            'semester' => $semester,
            'disnaker' => $disnaker,
            'laporan' => $results
        ]);
    }

    public function title(): string
    {
        return 'Sheet13';
    }
}
