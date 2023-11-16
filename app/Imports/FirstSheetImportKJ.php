<?php

namespace App\Imports;

use App\Models\DataJenisPendidikan;
use App\Models\DataKelompokJabatan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class FirstSheetImportKJ implements ToModel, WithHeadingRow
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

            return new DataKelompokJabatan([
                'id_disnaker' => Auth::user()->email,
                'nmr' => $row['nmr'],
                'tgl_1' => strtoupper($tgl1),
                'tgl_2' => strtoupper($tgl2),
                'judul_kj' => $row['judul_kj'],
                'sisa_l_kj' => $row['sisa_l_kj'],
                'sisa_p_kj' => $row['sisa_p_kj'],
                'terdaftar_l_kj' => $row['terdaftar_l_kj'],
                'terdaftar_p_kj' => $row['terdaftar_p_kj'],
                'penempatan_l_kj' => $row['penempatan_l_kj'],
                'penempatan_p_kj' => $row['penempatan_p_kj'],
                'hapus_l_kj' => $row['hapus_l_kj'],
                'hapus_p_kj' => $row['hapus_p_kj'],
                'akhir_l_kj' => $row['akhir_l_kj'],
                'akhir_p_kj' => $row['akhir_p_kj'],
            ]);
        
    }

    public function headingRow(): int
    {
        return 11;
    }

}
