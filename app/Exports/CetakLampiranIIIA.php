<?php

namespace App\Exports;

use App\Models\DataPencariKerja;
use App\Models\Laporan;
use App\Models\PemangkuKepentingan;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;

class CetakLampiranIIIA implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
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
            'C2:C3' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['name' => 'Tahoma', 'size' => 11, 'bold' => true],
            ],
            'C4:C6' => [
                // Mengatur jenis huruf (font) untuk sel B2 sampai B5
                'font' => ['name' => 'Tahoma', 'size' => 9, 'normal' => true],
            ],
            'A8:T18' => [
                'font' => ['name' => 'Tahoma', 'size' => 8, 'normal' => true],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Menambahkan solid garis tipis
                        'color' => ['rgb' => '000000'], // Mengatur warna garis (hitam dalam format RGB)
                    ]],
            ],
            'Q14' => [
                'font' => [
                    'color' => ['rgb' => 'C5D9F1'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'Q17' => [
                'font' => [
                    'color' => ['rgb' => 'C5D9F1'], // Mengatur warna huruf menjadi merah (misalnya)
                ],
            ],
            'B8:B11' => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'C8:L8' => [
                'font' => ['bold' => true],
            ],
            'C10:O11' => [
                'font' => ['bold' => true],
            ],
            'Q8:T11' => [
                'font' => ['bold' => true],
            ],
            'A14:T14' => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'C5D9F1'], // Mengatur latar belakang menjadi kuning
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A17:T17' => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'C5D9F1'], // Mengatur latar belakang menjadi kuning
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A8:T11' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'C5D9F1'], // Mengatur latar belakang menjadi kuning
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B8:B18' => [
                'alignment' => [
                    'wrapText' => true,
                ]
            ],
            'Q8:Q18' => [
                'alignment' => [
                    'wrapText' => true,
                ]
            ], 
            'A8:A18'=> [
                'width' => 3,
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'C8:P18' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ], 
            'R12:T18' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'B2' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 4,
            'B' => 25,
            'C' => 6,
            'D' => 6,
            'E' => 6,
            'F' => 6,
            'G' => 6,
            'H' => 6,
            'I' => 6,
            'J' => 6,
            'K' => 6,
            'L' => 6,
            'M' => 6,
            'N' => 6,
            'O' => 6,
            'P' => 6,
            'Q' => 25,
            'R' => 6,
            'S' => 6,
            'T' => 6,
        ];
    }

    public function view(): View
    {
        // dd($this->id)
        $title = 'LAPORAN IPK III/1 - IKHTISAR STATISTIK ANTAR KERJA PROPINSI SUMATERA BARAT';
        $disnaker = PemangkuKepentingan::where('email_lembaga', $this->id)->first();
        $semester = DataPencariKerja::where('id_disnaker', $this->id)->where('type','Lampiran')->first();
        $data = DataPencariKerja::where('id_disnaker', $this->id)->where('type','Lampiran')->get();
        // dd($disnaker->email_lembaga);

        // Cetak data pada id disnaker provinsi
        $pencari_kerja1 = DataPencariKerja::where('nmr', 1)->where('type','Lampiran')->first();
        $pencari_kerja2 = DataPencariKerja::where('nmr', 2)->where('type','Lampiran')->first();
        $pencari_kerjaA = DataPencariKerja::where('nmr', 'A.')->where('type','Lampiran')->first();
        $pencari_kerja3 = DataPencariKerja::where('nmr', 3)->where('type','Lampiran')->first();
        $pencari_kerja4 = DataPencariKerja::where('nmr', 4)->where('type','Lampiran')->first();
        $pencari_kerjaB = DataPencariKerja::where('nmr', 'B.')->where('type','Lampiran')->first();
        $pencari_kerja5 = DataPencariKerja::where('nmr', 5)->where('type','Lampiran')->first();

        // dd($pencari_kerja1->L);

        $jumlahL151 = DataPencariKerja::where('nmr', 1)->where('type','Lampiran')->sum('15_L');
        $jumlahL152 = DataPencariKerja::where('nmr', 2)->where('type','Lampiran')->sum('15_L');
        $jumlahL153 = DataPencariKerja::where('nmr', 3)->where('type','Lampiran')->sum('15_L');
        $jumlahL154 = DataPencariKerja::where('nmr', 4)->where('type','Lampiran')->sum('15_L');
        $jumlahP151 = DataPencariKerja::where('nmr', 1)->where('type','Lampiran')->sum('15_P');
        $jumlahP152 = DataPencariKerja::where('nmr', 2)->where('type','Lampiran')->sum('15_P');
        $jumlahP153 = DataPencariKerja::where('nmr', 3)->where('type','Lampiran')->sum('15_P');
        $jumlahP154 = DataPencariKerja::where('nmr', 4)->where('type','Lampiran')->sum('15_P');
        $jumlahLowonganL1 = DataPencariKerja::where('nmr', 1)->where('type','Lampiran')->sum('lowongan_L');
        $jumlahLowonganP1 = DataPencariKerja::where('nmr', 1)->where('type','Lampiran')->sum('lowongan_P');

        $jumlahL201 = DataPencariKerja::where('nmr', 1)->where('type','Lampiran')->sum('20_L');
        $jumlahL202 = DataPencariKerja::where('nmr', 2)->where('type','Lampiran')->sum('20_L');
        $jumlahL203 = DataPencariKerja::where('nmr', 3)->where('type','Lampiran')->sum('20_L');
        $jumlahL204 = DataPencariKerja::where('nmr', 4)->where('type','Lampiran')->sum('20_L');
        $jumlahP201 = DataPencariKerja::where('nmr', 1)->where('type','Lampiran')->sum('20_P');
        $jumlahP202 = DataPencariKerja::where('nmr', 2)->where('type','Lampiran')->sum('20_P');
        $jumlahP203 = DataPencariKerja::where('nmr', 3)->where('type','Lampiran')->sum('20_P');
        $jumlahP204 = DataPencariKerja::where('nmr', 4)->where('type','Lampiran')->sum('20_P');
        $jumlahLowonganL2 = DataPencariKerja::where('nmr', 2)->where('type','Lampiran')->sum('lowongan_L');
        $jumlahLowonganP2 = DataPencariKerja::where('nmr', 2)->where('type','Lampiran')->sum('lowongan_P');

        $jumlahL301 = DataPencariKerja::where('nmr', 1)->where('type','Lampiran')->sum('30_L');
        $jumlahL302 = DataPencariKerja::where('nmr', 2)->where('type','Lampiran')->sum('30_L');
        $jumlahL303 = DataPencariKerja::where('nmr', 3)->where('type','Lampiran')->sum('30_L');
        $jumlahL304 = DataPencariKerja::where('nmr', 4)->where('type','Lampiran')->sum('30_L');
        $jumlahP301 = DataPencariKerja::where('nmr', 1)->where('type','Lampiran')->sum('30_P');
        $jumlahP302 = DataPencariKerja::where('nmr', 2)->where('type','Lampiran')->sum('30_P');
        $jumlahP303 = DataPencariKerja::where('nmr', 3)->where('type','Lampiran')->sum('30_P');
        $jumlahP304 = DataPencariKerja::where('nmr', 4)->where('type','Lampiran')->sum('30_P');
        $jumlahLowonganL3 = DataPencariKerja::where('nmr', 3)->where('type','Lampiran')->sum('lowongan_L');
        $jumlahLowonganP3 = DataPencariKerja::where('nmr', 3)->where('type','Lampiran')->sum('lowongan_P');

        $jumlahL451 = DataPencariKerja::where('nmr', 1)->where('type','Lampiran')->sum('45_L');
        $jumlahL452 = DataPencariKerja::where('nmr', 2)->where('type','Lampiran')->sum('45_L');
        $jumlahL453 = DataPencariKerja::where('nmr', 3)->where('type','Lampiran')->sum('45_L');
        $jumlahL454 = DataPencariKerja::where('nmr', 4)->where('type','Lampiran')->sum('45_L');
        $jumlahP451 = DataPencariKerja::where('nmr', 1)->where('type','Lampiran')->sum('45_P');
        $jumlahP452 = DataPencariKerja::where('nmr', 2)->where('type','Lampiran')->sum('45_P');
        $jumlahP453 = DataPencariKerja::where('nmr', 3)->where('type','Lampiran')->sum('45_P');
        $jumlahP454 = DataPencariKerja::where('nmr', 4)->where('type','Lampiran')->sum('45_P');
        $jumlahLowonganL4 = DataPencariKerja::where('nmr', 4)->where('type','Lampiran')->sum('lowongan_L');
        $jumlahLowonganP4 = DataPencariKerja::where('nmr', 4)->where('type','Lampiran')->sum('lowongan_P');

        $jumlahL551 = DataPencariKerja::where('nmr', 1)->where('type','Lampiran')->sum('55_L');
        $jumlahL552 = DataPencariKerja::where('nmr', 2)->where('type','Lampiran')->sum('55_L');
        $jumlahL553 = DataPencariKerja::where('nmr', 3)->where('type','Lampiran')->sum('55_L');
        $jumlahL554 = DataPencariKerja::where('nmr', 4)->where('type','Lampiran')->sum('55_L');
        $jumlahP551 = DataPencariKerja::where('nmr', 1)->where('type','Lampiran')->sum('55_P');
        $jumlahP552 = DataPencariKerja::where('nmr', 2)->where('type','Lampiran')->sum('55_P');
        $jumlahP553 = DataPencariKerja::where('nmr', 3)->where('type','Lampiran')->sum('55_P');
        $jumlahP554 = DataPencariKerja::where('nmr', 4)->where('type','Lampiran')->sum('55_P');

        return view('Dashboard.admin.cetak-laporan-iii-i')->with([
            'data' => $data,
            'title' => $title,
            'semester' => $semester,
            'disnaker' => $disnaker,
            'jumlahL151' => $jumlahL151,
            'jumlahL152' => $jumlahL152,
            'jumlahL153' => $jumlahL153,
            'jumlahL154' => $jumlahL154,
            'jumlahP151' => $jumlahP151,
            'jumlahP152' => $jumlahP152,
            'jumlahP153' => $jumlahP153,
            'jumlahP154' => $jumlahP154,
            'jumlahLowonganL1' => $jumlahLowonganL1,
            'jumlahLowonganP1' => $jumlahLowonganP1,
            'jumlahL201' => $jumlahL201,
            'jumlahL202' => $jumlahL202,
            'jumlahL203' => $jumlahL203,
            'jumlahL204' => $jumlahL204,
            'jumlahP201' => $jumlahP201,
            'jumlahP202' => $jumlahP202,
            'jumlahP203' => $jumlahP203,
            'jumlahP204' => $jumlahP204,
            'jumlahLowonganL2' => $jumlahLowonganL2,
            'jumlahLowonganP2' => $jumlahLowonganP2,
            'jumlahL301' => $jumlahL301,
            'jumlahL302' => $jumlahL302,
            'jumlahL303' => $jumlahL303,
            'jumlahL304' => $jumlahL304,
            'jumlahP301' => $jumlahP301,
            'jumlahP302' => $jumlahP302,
            'jumlahP303' => $jumlahP303,
            'jumlahP304' => $jumlahP304,
            'jumlahLowonganL3' => $jumlahLowonganL3,
            'jumlahLowonganP3' => $jumlahLowonganP3,
            'jumlahL451' => $jumlahL451,
            'jumlahL452' => $jumlahL452,
            'jumlahL453' => $jumlahL453,
            'jumlahL454' => $jumlahL454,
            'jumlahP451' => $jumlahP451,
            'jumlahP452' => $jumlahP452,
            'jumlahP453' => $jumlahP453,
            'jumlahP454' => $jumlahP454,
            'jumlahLowonganL4' => $jumlahLowonganL4,
            'jumlahLowonganP4' => $jumlahLowonganP4,
            'jumlahL551' => $jumlahL551,
            'jumlahL552' => $jumlahL552,
            'jumlahL553' => $jumlahL553,
            'jumlahL554' => $jumlahL554,
            'jumlahP551' => $jumlahP551,
            'jumlahP552' => $jumlahP552,
            'jumlahP553' => $jumlahP553,
            'jumlahP554' => $jumlahP554,
            'pencari_kerja1' => $pencari_kerja1,
            'pencari_kerja2' => $pencari_kerja2,
            'pencari_kerja3' => $pencari_kerja3,
            'pencari_kerja4' => $pencari_kerja4,
            'pencari_kerja5' => $pencari_kerja5,
            'pencari_kerjaA' => $pencari_kerjaA,
            'pencari_kerjaB' => $pencari_kerjaB
        ]);
    }

    public function title(): string
    {
        // Judul yang ingin Anda atur untuk lembar Excel
        return 'TBL4.1';
    }
}
