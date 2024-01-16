<?php

namespace App\Exports;

use App\Models\Laporan;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request as HttpRequest;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CetakLaporan implements WithDrawings, WithStyles, WithTitle, FromView, WithColumnWidths
{
    private $data1;
    private $data2;

    public function __construct($data1, $data2)
    {
        $this->data1 = $data1;
        $this->data2 = $data2;
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
            'A8:U18' => [
                'font' => ['name' => 'Tahoma', 'size' => 8, 'normal' => true],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Menambahkan solid garis tipis
                        'color' => ['rgb' => '000000'], // Mengatur warna garis (hitam dalam format RGB)
                    ]],
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
            'Q8:U11' => [
                'font' => ['bold' => true],
            ],
            'A14:U14' => [
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
            'A17:U17' => [
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
            'A8:U11' => [
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
            'R12:U18' => [
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
        'U' => 6,
    ];
}

    public function view(): View
    {
    
        if($this->data1 == 01 && $this->data2 == 06){
            $StartDateYear = date("Y") . "-" . $this->data1 . "-01";
            $endDateYear = date("Y") . "-" . $this->data2 . "-01";

            $todayStartSebelumnya = date("Y") . "-" . $this->data1 . "-01";
            $todayEndSebelumnya = date("Y") . "-" . $this->data1 . "-31";


            $startInformasiDateSebelumnya = date("Y-m-d",strtotime("-20 year", strtotime("-6 months", strtotime($todayStartSebelumnya))));
            $endInformasiDateSebelumnya = date("Y-m-d", strtotime("-1 months", strtotime($todayEndSebelumnya)));

            $startDateSebelumnya = date("Y-m-d", strtotime("-6 months", strtotime($todayStartSebelumnya))); 
            $endDateSebelumnya = date("Y-m-d", strtotime("-1 months", strtotime($todayEndSebelumnya))); 

            $title = 'LAPORAN IPK III/1 - IKHTISAR STATISTIK ANTAR KERJA PROPINSI SUMATERA BARAT';
            $semester = 'SEMESTER 1 : JANUARI S/D JUNI '. date("Y");

        }else{
            $StartDateYear = date("Y") . "-" . $this->data1 . "-01";
            $endDateYear = date("Y") . "-" . $this->data2 . "-01";

            $todayStartSebelumnya = date("Y") . "-" . $this->data1 . "-01";
            $todayEndSebelumnya = date("Y") . "-" . $this->data1 . "-31";

            $startDateSebelumnya = date("Y-m-d", strtotime("-6 months", strtotime($todayStartSebelumnya)));
            $endDateSebelumnya = date("Y-m-d", strtotime("-1 months", strtotime($todayEndSebelumnya))); 

            $startInformasiDateSebelumnya = date("Y-m-d",strtotime("-20 year", strtotime("-6 months", strtotime($todayStartSebelumnya))));
            $endInformasiDateSebelumnya = date("Y-m-d", strtotime("-1 months", strtotime($todayEndSebelumnya)));

            $title = 'LAPORAN IPK III/2 - IKHTISAR STATISTIK ANTAR KERJA PROPINSI SUMATERA BARAT';
            $semester = 'SEMESTER 2 : JULI S/D DESEMBER '. date("Y");
        }

        $jmlPSebelumnya = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Perempuan')
            ->where('status_ak1', 'Belum bekerja')
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
            ->count();

        $jmlLSebelumnya = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Laki-laki')
            ->where('status_ak1', 'Belum bekerja')
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
            ->count();

        $jmlNow = DB::table('pencari_kerjas')
            ->where('status_ak1', 'Belum bekerja')
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();
  
        $jmlSebelumnya = $jmlPSebelumnya + $jmlLSebelumnya;

        $jmlP_terdaftar = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Perempuan')
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();

        $jmlL_terdaftar = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Laki-laki')
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();
        
        $jmlP_ditempatkan = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Perempuan')
            ->where('deleted_at', null)
            ->where('status_ak1', 'Bekerja')
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();

        $jmlL_ditempatkan = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Laki-laki')
            ->where('deleted_at', null)
            ->where('status_ak1', 'Bekerja')
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();
        
        $jumlahPA = $jmlPSebelumnya + $jmlP_terdaftar;
        $jumlahLA = $jmlLSebelumnya + $jmlL_terdaftar;
        // dd($jumlahPA);
        $jumlahA = $jumlahPA + $jumlahLA;
        $jmlDitempatkkan = $jmlL_ditempatkan + $jmlP_ditempatkan;

        $jml_terdaftar = DB::table('pencari_kerjas')
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();
        
        $deleteUserNowL = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Laki-laki')
            ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])->count();

        $deleteUserNowP = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Perempuan')
            ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])->count();

        $deleteUserNow = $deleteUserNowL + $deleteUserNowP;
        $jumlahPB = $deleteUserNowP + $jmlP_ditempatkan;
        $jumlahLB = $deleteUserNowL + $jmlL_ditempatkan;
        $jumlahB = $jumlahPB + $jumlahLB;
        $jumlahMale5 = $jumlahLA - $jumlahLB;
        $jumlahFemale5 = $jumlahPA - $jumlahPB;
        $jumlahAkhirPekerja = $jumlahMale5 + $jumlahFemale5;

        $ageRanges = [
            [15, 19],
            [20, 29],
            [30, 44],
            [45, 54],
            [55, null]
        ];

        $genderAgeCounts = [];
    
        foreach ($ageRanges as $range) {
            $startAge = $range[0];
            $endAge = $range[1];
    
            $maleCount = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Laki-laki')
                ->where('deleted_at', null)
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();
    
            $femaleCount = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Perempuan')
                ->where('deleted_at', null)
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();
                
                // dd($femaleCount);
            $maleCountDelete = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Laki-laki')
                ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->count();
    
            $femaleCountDelete = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Perempuan')
                ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->count();
            
            $maleCountDitempatkan = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Laki-laki')
                ->where('status_ak1', 'Bekerja')
                ->where('deleted_at', null)
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();
    
            $femaleCountDitempatkan = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Perempuan')
                ->where('status_ak1', 'Bekerja')
                ->where('deleted_at', null)
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();
            
            $maleCountSebelumnya = DB::table('pencari_kerjas')
                ->where('status_ak1', 'Belum Bekerja')
                ->where('jenis_kelamin', 'Laki-laki')
                ->where('deleted_at', null)
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
                ->count();
    
            $femaleCountSebelumnya = DB::table('pencari_kerjas')
            ->where('status_ak1', 'Belum Bekerja')
            ->where('jenis_kelamin', 'Perempuan')
            ->where('deleted_at', null)
            ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
            ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
            ->count();

            $maleCountTerdaftar = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Laki-laki')
                ->where('deleted_at', null)
                ->whereBetween('umur', [$startAge, $endAge])
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();
    
            $femaleCountTerdaftar = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Perempuan')
                ->where('deleted_at', null)
                ->whereBetween('umur', [$startAge, $endAge])
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();

            $jumlahMaleA =  $maleCountSebelumnya + $maleCount;
            $jumlahFemaleA =  $femaleCountSebelumnya + $femaleCount;
            $jumlahMaleB =  $maleCountDelete + $maleCountDitempatkan;
            $jumlahFemaleB =  $femaleCountDelete + $femaleCountDitempatkan;
            $jumlahMale = $jumlahMaleA - $jumlahMaleB;
            $jumlahFemale = $jumlahFemaleA - $jumlahFemaleB;
    
            $genderAgeCounts[] = [
                'start' => $StartDateYear,
                'end' => $endDateYear,
                'start_age' => $startAge,
                'end_age' => $endAge ?: '+',
                'male_count' => $maleCount,
                'female_count' => $femaleCount,
                'male_count_delete' => $maleCountDelete,
                'female_count_delete' => $femaleCountDelete,
                'male_count_ditempatkan' => $maleCountDitempatkan,
                'female_count_ditempatkan' => $femaleCountDitempatkan,
                'male_count_sebelumnya' => $maleCountSebelumnya,
                'female_count_sebelumnya' => $femaleCountSebelumnya,
                'male_count_terdaftar' => $maleCountTerdaftar,
                'female_count_terdaftar' => $femaleCountTerdaftar,
                'jumlahMaleA' => $jumlahMaleA,
                'jumlahFemaleA' => $jumlahFemaleA,
                'jumlahMaleB' => $jumlahMaleB,
                'jumlahFemaleB' => $jumlahFemaleB,
                'jumlahMale' => $jumlahMale,
                'jumlahFemale' => $jumlahFemale,
            ];
        }

        // dd($genderAgeCounts);

        $data = Laporan::get();

        // laporan informasi lowongan
        $maleCountInformasiBelum = DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Laki-laki')
                ->where(function ($query) {
                    $query->where('status_lowongan', 0)
                        ->orWhere('status_lowongan', 1);
                })
                ->Where('deleted_at', null)
                ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
                ->count();
        
        $femaleCountInformasiBelum = DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Perempuan')
                ->where(function ($query) {
                    $query->where('status_lowongan', 0)
                        ->orWhere('status_lowongan', 1);
                })
                ->where('deleted_at', null)
                ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
                ->count();

        $malefemaleCountInformasiBelum = DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Laki-laki/Perempuan')
                ->where(function ($query) {
                    $query->where('status_lowongan', 0)
                        ->orWhere('status_lowongan', 1);
                })
                ->where('deleted_at', null)
                ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
                ->count();
        
            $maleCountInformasiTerdaftar =  DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Laki-laki')
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();
        
        $femaleCountInformasiTerdaftar = DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Perempuan')
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();

        $malefemaleCountInformasiTerdaftar = DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Laki-laki/Perempuan')
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();

        $jumlahInformasibelumlalu = $maleCountInformasiBelum + $femaleCountInformasiBelum + $malefemaleCountInformasiBelum;
        $jumlahInformasiterdaftarnow = $maleCountInformasiTerdaftar + $femaleCountInformasiTerdaftar + $malefemaleCountInformasiTerdaftar;

        $jumlahInformasiMaleA = $maleCountInformasiBelum + $maleCountInformasiTerdaftar;
        $jumlahInformasiFemaleA = $femaleCountInformasiBelum + $femaleCountInformasiTerdaftar;
        $jumlahInformasiMaleFemaleA = $malefemaleCountInformasiBelum + $malefemaleCountInformasiTerdaftar;

        $jumlahInformasiA = $jumlahInformasiMaleA + $jumlahInformasiFemaleA + $jumlahInformasiMaleFemaleA;

        $informasiTerpenuhiMale = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Laki-laki')
            ->where('status_lowongan', 2)
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();
        
        $informasiTerpenuhiFemale = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Perempuan')
            ->where('status_lowongan', 2)
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();

        $informasiTerpenuhiMaleFemale = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Laki-laki/Perempuan')
            ->where('status_lowongan', 2)
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();

        $informasiMaleDelete = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Laki-laki')
            ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])
            ->count();

        $informasiFemaleDelete = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Perempuan')
            ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])
            ->count();

        $informasiMaleFemaleDelete = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Laki-laki/Perempuan')
            ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])
            ->count();
  
        $jumlahInformasiTerpenuhi = $informasiTerpenuhiMale + $informasiTerpenuhiFemale + $informasiTerpenuhiMaleFemale;
        $jumlahInformasiDelete = $informasiMaleDelete + $informasiFemaleDelete + $informasiMaleFemaleDelete;

        $jumlahInformasiMaleB = $informasiTerpenuhiMale + $informasiMaleDelete;
        $jumlahInformasiFemaleB = $informasiTerpenuhiFemale + $informasiFemaleDelete;
        $jumlahInformasiMaleFemaleB = $informasiTerpenuhiMaleFemale + $informasiMaleFemaleDelete;

        $jumlahInformasiB = $jumlahInformasiMaleB + $jumlahInformasiFemaleB + $jumlahInformasiMaleFemaleB;

        $jumlahInformasiMale = $jumlahInformasiMaleA - $jumlahInformasiMaleB;
        $jumlahInformasiFemale = $jumlahInformasiFemaleA - $jumlahInformasiFemaleB;
        $jumlahInformasiMaleFemale = $jumlahInformasiMaleFemaleA - $jumlahInformasiMaleFemaleB;

        $jumlahInformasi = $jumlahInformasiMale + $jumlahInformasiFemale + $jumlahInformasiMaleFemale;
    
        return view('dashboard.admin.cetak-laporan-semester', [
            'genderAgeCounts' => $genderAgeCounts,
            'jmlPSebelumnya' => $jmlPSebelumnya,
            'jmlLSebelumnya' => $jmlLSebelumnya,
            'jmlNow' => $jmlNow,
            'deleteUserNowL' => $deleteUserNowL,
            'deleteUserNowP' => $deleteUserNowP,
            'deleteUserNow' => $deleteUserNow,
            'jmlSebelumnya' => $jmlSebelumnya,
            'jmlP_terdaftar' => $jmlP_terdaftar,
            'jmlL_terdaftar' => $jmlL_terdaftar,
            'jmlP_ditempatkan' => $jmlP_ditempatkan,
            'jmlL_ditempatkan' => $jmlL_ditempatkan,
            'jmlDitempatkan' => $jmlDitempatkkan,
            'jml_terdaftar' => $jml_terdaftar,
            'jumlahPA' => $jumlahPA,
            'jumlahLA' => $jumlahLA,
            'jumlahPB' => $jumlahPB,
            'jumlahLB' => $jumlahLB,
            'jumlahA' => $jumlahA,
            'jumlahB' => $jumlahB,
            'jumlahMale5' => $jumlahMale5,
            'jumlahFemale5' => $jumlahFemale5,
            'jumlahAkhirPekerja' => $jumlahAkhirPekerja,
            'laporan' => $data,
            'male_informasi_belum' => $maleCountInformasiBelum,
            'female_informasi_belum' => $femaleCountInformasiBelum,
            'male_female_informasi_belum' => $malefemaleCountInformasiBelum,
            'jumlah_informasi_belum_lalu' => $jumlahInformasibelumlalu,
            'male_informasi_terdaftar' => $maleCountInformasiTerdaftar,
            'female_informasi_terdaftar' => $femaleCountInformasiTerdaftar,
            'male_female_informasi_terdaftar' => $malefemaleCountInformasiTerdaftar,
            'jumlah_informasi_terdaftar_now' => $jumlahInformasiterdaftarnow,
            'jumlah_informasi_male_a' => $jumlahInformasiMaleA,
            'jumlah_informasi_female_a' => $jumlahInformasiFemaleA,
            'jumlah_informasi_male_female_a' => $jumlahInformasiMaleFemaleA,
            'jumlah_informasi_a' => $jumlahInformasiA,
            'informasi_terpenuhi_male' => $informasiTerpenuhiMale,
            'informasi_terpenuhi_female' => $informasiTerpenuhiFemale,
            'informasi_terpenuhi_male_female' => $informasiTerpenuhiMaleFemale,
            'jumlah_informasi_terpenuhi' => $jumlahInformasiTerpenuhi,
            'informasi_male_delete' => $informasiMaleDelete,
            'informasi_female_delete' => $informasiFemaleDelete,
            'informasi_male_female_delete' => $informasiMaleFemaleDelete,
            'jumlah_informasi_delete' => $jumlahInformasiDelete,
            'jumlah_informasi_male_b' => $jumlahInformasiMaleB,
            'jumlah_informasi_female_b' => $jumlahInformasiFemaleB,
            'jumlah_informasi_male_female_b' => $jumlahInformasiMaleFemaleB,
            'jumlah_informasi_b' => $jumlahInformasiB,
            'jumlah_informasi_male' => $jumlahInformasiMale,
            'jumlah_informasi_female' => $jumlahInformasiFemale,
            'jumlah_informasi_male_female' => $jumlahInformasiMaleFemale,
            'jumlah_informasi' => $jumlahInformasi,
            'title' => $title,
            'semester' => $semester
            ]);
    }

    public function title(): string
    {
        // Judul yang ingin Anda atur untuk lembar Excel
        $bulan1 = $this->data1;
        $bulan2 = $this->data2;
        if($bulan1 == 01 && $bulan2 == 06){
            return 'IPK-III-1-Semester 1';
        }else{
            return 'IPK-III-1-Semester 2';
        }
    }
}
