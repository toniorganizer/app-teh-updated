<?php

namespace App\Imports;

use App\Models\JenisPendidikan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class FirstSheetImportJP implements ToModel, WithHeadingRow
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

            return new JenisPendidikan([
                'id_disnaker' => Auth::user()->email,
                'nmr' => $row[0],
                'tgl_1' => strtoupper($tgl1),
                'tgl_2' => strtoupper($tgl2),
                'judul' => $row[1],
                'sisa_l' => $row[2],
                'sisa_p' => $row[3],
                'terdaftar_l' => $row[4],
                'terdaftar_p' => $row[5],
                'penempatan_l' => $row[6],
                'penempatan_p' => $row[7],
                'hapus_l' => $row[8],
                'hapus_p' => $row[9],
                'akhir_l' => $row[10],
                'akhir_p' => $row[11],
            ]);
        
    }

    public function headingRow(): int
    {
        return 11;
    }

}
