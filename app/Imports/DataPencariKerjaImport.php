<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\DataPencariKerja;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataPencariKerjaImport implements ToModel, WithHeadingRow
{

    private $data1;
    private $data2;

    public function __construct($data1, $data2)
    {
        $this->data1 = $data1;
        $this->data2 = $data2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {

        $todayStartSebelumnya = $this->data1;
        $todayEndSebelumnya = $this->data2;
        
        $tanggalMulai = Carbon::parse($todayStartSebelumnya)->locale('id');
        $tanggalAkhir = Carbon::parse($todayEndSebelumnya)->locale('id');
        
        $tgl1 = $tanggalMulai->isoFormat('D MMMM Y');
        $tgl2 = $tanggalAkhir->isoFormat('D MMMM Y');

        return new DataPencariKerja([
            'id_disnaker' => Auth::user()->email,
            'tgl_1' => strtoupper($tgl1),
            'tgl_2' => strtoupper($tgl2),
            'pencari_kerja' => $row['judul1'],
            '15_L' => $row['u2'],
            '15_P' => $row['u3'],
            '20_L' => $row['u4'],
            '20_P' => $row['u5'],
            '30_L' => $row['u6'],
            '30_P' => $row['u7'],
            '45_L' => $row['u8'],
            '45_P' => $row['u9'],
            '55_L' => $row['u10'],
            '55_P' => $row['u11'],
            'lowongan' => $row['lowongan1'],
            'lowongan_L' => $row['l2'],
            'lowongan_P' => $row['l3']
        ]);
    }

    public function headingRow(): int
    {
        return 11;
    }

    // public function model(array $row)
    // {
    //     return new DataPencariKerja([
    //         'id_disnaker' => $row[0],
    //         'tgl_1' => $row[1],
    //         'tgl_2' => $row[2],
    //         'pencari_kerja' => $row[3],
    //         '15_L' => $row[4],
    //         '15_P' => $row[5],
    //         '20_L' => $row[6],
    //         '20_P' => $row[7],
    //         '30_L' => $row[8],
    //         '30_P' => $row[9],
    //         '45_L' => $row[10],
    //         '45_P' => $row[11],
    //         '55_L' => $row[12],
    //         '55_P' => $row[13],
    //         'lowongan' => $row[14],
    //         'lowongan_L' => $row[15],
    //         'lowongan_P' => $row[16]
    //     ]);
    // }
}
