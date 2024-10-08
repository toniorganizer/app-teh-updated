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

class CetakLaporanIIIC implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
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
            'A8:L62' => [
                'font' => ['name' => 'Tahoma', 'size' => 8, 'normal' => true],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Menambahkan solid garis tipis
                        'color' => ['rgb' => '000000'], // Mengatur warna garis (hitam dalam format RGB)
                    ]],
            ],
            
            'A8:L9' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'C10:L10' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'B11:L11' => [
                'font' => [
                    'color' => ['rgb' => 'F2F2F2'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            
            'A8:L10' => [
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

            'A8:A65' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],

            'B12:B65' => [
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
        $semester = DataKelompokJabatan::where('id_disnaker', $this->id)->first();
        if(is_null($semester)){
            $semester = DataKelompokJabatan::where('type','Laporan')->first();
        }else{
            $semester = DataKelompokJabatan::where('id_disnaker', $this->id)->where('type','Laporan')->first();
        }
        if($disnaker->status_lembaga == 0){
            $title = 'LAPORAN IPK III/3 - PENCARI KERJA MENURUT GOL.JABATAN PROPINSI SUMATERA BARAT';
        }elseif($semester->type == 'Lampiran'){
            $title = 'TABEL 4. 1';
        }else{
            $title = 'LAPORAN IPK III/3 - PENCARI KERJA MENURUT GOL.JABATAN KAB/KOTA' . strtoupper(substr($disnaker->nama_lembaga, 18));
        }
        $start = 3132;
        $end = 3460;
        $id_kadis = DataKelompokJabatan::where('id_disnaker', $this->id)->where('type', 'Laporan')->first();
        if(is_null($id_kadis)){
            $data = DB::table('data_kelompok_jabatans')->join('pemangku_kepentingans', 'pemangku_kepentingans.id_disnaker_kab','=','data_kelompok_jabatans.id_disnaker')
            ->where('email_lembaga', $this->id)->where('type','Laporan')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('nmr', [$start, $end]);
            })
            ->get();
        }else{
            $data = DB::table('data_kelompok_jabatans')
            ->where('id_disnaker', $this->id)->where('type','Laporan')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('nmr', [$start, $end]);
            })
            ->get();
        }

        $results = DB::table('data_kelompok_jabatans')->join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_kelompok_jabatans.id_disnaker')->where('role_acc', 1)
        ->select('judul_kj', 'nmr', 'akhir_l_kj', 'akhir_p_kj')
        ->whereBetween('nmr', [$start, $end])->where('type','Laporan')
        ->selectRaw('CASE WHEN judul_kj = "Sub Total" THEN sisa_l_kj ELSE SUM(sisa_l_kj) END AS sisa_l')
        ->selectRaw('CASE WHEN judul_kj = "Sub Total" THEN sisa_p_kj ELSE SUM(sisa_p_kj) END AS sisa_p')
        ->selectRaw('CASE WHEN judul_kj = "Sub Total" THEN terdaftar_l_kj ELSE SUM(terdaftar_l_kj) END AS terdaftar_l')
        ->selectRaw('CASE WHEN judul_kj = "Sub Total" THEN terdaftar_p_kj ELSE SUM(terdaftar_p_kj) END AS terdaftar_p')
        ->selectRaw('CASE WHEN judul_kj = "Sub Total" THEN penempatan_l_kj ELSE SUM(penempatan_l_kj) END AS penempatan_l')
        ->selectRaw('CASE WHEN judul_kj = "Sub Total" THEN penempatan_p_kj ELSE SUM(penempatan_p_kj) END AS penempatan_p')
        ->selectRaw('CASE WHEN judul_kj = "Sub Total" THEN hapus_l_kj ELSE SUM(hapus_l_kj) END AS hapus_l')
        ->selectRaw('CASE WHEN judul_kj = "Sub Total" THEN hapus_p_kj ELSE SUM(hapus_p_kj) END AS hapus_p')
        ->groupBy('judul_kj', 'nmr', 'akhir_l_kj', 'akhir_p_kj')
        ->oldest('id')
        ->get();

        return view('dashboard.admin.cetak-laporan-iii-iii')->with([
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
        return 'Sheet3';
    }
}
