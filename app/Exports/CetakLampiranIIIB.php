<?php

namespace App\Exports;

use App\Models\DataGolonganUsaha;
use App\Models\Laporan;
use App\Models\DataPencariKerja;
use Illuminate\Support\Facades\DB;
use App\Models\DataJenisPendidikan;
use App\Models\DataLowonganJabatan;
use App\Models\DataLowonganPendidikan;
use App\Models\DataPencariPenerima;
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

class CetakLampiranIIIB implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
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
            'A8:J38' => [
                'font' => ['name' => 'Tahoma', 'size' => 8, 'normal' => true],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Menambahkan solid garis tipis
                        'color' => ['rgb' => '000000'], // Mengatur warna garis (hitam dalam format RGB)
                    ]],
            ],

            // Judul pada tabel 
            'A8:J10' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A8:J11' => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A11:J11' => [
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
            'C12:J12' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A12:B12' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'B16:B18' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'B18:J18' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A17:A25' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A30:B31' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],
            'A30:J30' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A30' => [
                'font' => [
                    'color' => ['rgb' => 'F2F2F2'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'C31:J31' => [
                'font' => [
                    'color' => ['rgb' => 'FFFFFF'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A38:J38' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F2F2F2'], // Mengatur latar belakang menjadi kuning
                ],
            ],
            'A38' => [
                'font' => [
                    'color' => ['rgb' => 'F2F2F2'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'A38:B38' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['bold' => true],
            ],

            // Default Aturan  
            'A8:A38' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B12:B38' => [
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
        $title = 'LAPORAN IPK III/8 - PENEMPATAN PENCARI KRJ MENURUT JEN. ANTAR KERJA PROPINSI SUMATERA BARAT';
        $disnaker = PemangkuKepentingan::where('email_lembaga', $this->id)->first();
        $semester = DataPencariPenerima::where('id_disnaker', $this->id)->where('type','Lampiran')->first();
        $start = 11;
        $end = 26;
        $data = DB::table('data_pencari_penerimas')
        ->where('id_disnaker', $this->id)->where('type','Lampiran')
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('nmr', [$start, $end])
                ->orWhere('nmr', '4.8')
                ->orWhere('nmr', 'I')->orWhere('nmr', 'II');
        })
        ->get();
            

        $results = DB::table('data_pencari_penerimas')
        ->select('judul', 'nmr', 'jmll', 'jmlp')
        ->whereBetween('nmr', [$start, $end])->where('type','Lampiran')
        ->orWhere('nmr', '4.8')
        ->orWhere('nmr', 'I')->orWhere('nmr', 'II')
        ->selectRaw('CASE WHEN judul = "SMK : JURUSAN" THEN akll ELSE SUM(akll) END AS akll_s')
        ->selectRaw('CASE WHEN judul = "SMK : JURUSAN" THEN aklp ELSE SUM(aklp) END AS aklp_s')
        ->selectRaw('CASE WHEN judul = "SMK : JURUSAN" THEN akadl ELSE SUM(akadl) END AS akadl_s')
        ->selectRaw('CASE WHEN judul = "SMK : JURUSAN" THEN akadp ELSE SUM(akadp) END AS akadp_s')
        ->selectRaw('CASE WHEN judul = "SMK : JURUSAN" THEN akanl ELSE SUM(akanl) END AS akanl_s')
        ->selectRaw('CASE WHEN judul = "SMK : JURUSAN" THEN akanp ELSE SUM(akanp) END AS akanp_s')
        ->selectRaw('CASE WHEN judul = "JUMLAH" THEN akll ELSE SUM(akll) END AS akll')
        ->selectRaw('CASE WHEN judul = "JUMLAH" THEN aklp ELSE SUM(aklp) END AS aklp')
        ->selectRaw('CASE WHEN judul = "JUMLAH" THEN akadl ELSE SUM(akadl) END AS akadl')
        ->selectRaw('CASE WHEN judul = "JUMLAH" THEN akadp ELSE SUM(akadp) END AS akadp')
        ->selectRaw('CASE WHEN judul = "JUMLAH" THEN akanl ELSE SUM(akanl) END AS akanl')
        ->selectRaw('CASE WHEN judul = "JUMLAH" THEN akanp ELSE SUM(akanp) END AS akanp')
        ->groupBy('judul', 'nmr', 'jmll', 'jmlp')
        ->oldest('id')
        ->get();


        return view('Dashboard.admin.cetak-laporan-iii-viii')->with([
            'data' => $data,
            'title' => $title,
            'semester' => $semester,
            'disnaker' => $disnaker,
            'laporan' => $results
        ]);
    }

    public function title(): string
    {
        return 'TBL4.8';
    }
}
