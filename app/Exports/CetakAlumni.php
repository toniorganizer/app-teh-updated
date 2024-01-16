<?php

namespace App\Exports;

use App\Models\BursaKerja;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CetakAlumni implements WithStyles, WithTitle, FromView, WithColumnWidths
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'B2' => [
                // Mengatur jenis huruf (font) untuk baris pertama (baris judul kolom)
                'font' => ['name' => 'Tahoma', 'size' => 11, 'bold' => true],
            ],
            'B2:B3' => [
                // Mengatur jenis huruf (font) untuk sel B2 sampai B5
                'font' => ['name' => 'Tahoma', 'size' => 9, 'normal' => true],
            ],
            'A6:G20' => [
                'font' => ['name' => 'Tahoma', 'size' => 8, 'normal' => true],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Menambahkan solid garis tipis
                        'color' => ['rgb' => '000000'], // Mengatur warna garis (hitam dalam format RGB)
                    ]],
            ],
            'A6:G6' => [
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
            'A7:A20' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 25,
            'C' => 25,
            'D' => 30,
            'E' => 25,
            'F' => 25,
            'G' => 25,
        ];
    }

    public function view(): View
    {
        $id_sekolah = BursaKerja::where('email_sekolah', $this->id)->first();
        
        $title = 'DATA ALUMNI ' . strtoupper($id_sekolah->nama_sekolah);
        $alamat = $id_sekolah->alamat_sekolah;
        $telepon = $id_sekolah->telepon_sekolah;
       
        $data = BursaKerja::join('alumnis', 'alumnis.bkk_id','=','bursa_kerjas.id_bkk')->join('users','users.email','=','alumnis.pencari_kerja_id')->join('pencari_kerjas', 'pencari_kerjas.email_pk','=','alumnis.pencari_kerja_id')->where('email_sekolah', $this->id)->get();

        return view('dashboard.bkk.cetak-alumni')->with([
            'data' => $data,
            'title' => $title,
            'alamat' => $alamat,
            'telepon' => $telepon
        ]);
    }

    public function title(): string
    {
        return 'Sheet1';
    }
}
