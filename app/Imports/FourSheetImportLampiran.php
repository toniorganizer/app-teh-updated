<?php

namespace App\Imports;

use App\Models\DataJenisPendidikan;
use App\Models\DataKelompokJabatan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class FourSheetImportLampiran implements ToModel, WithHeadingRow
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
                'judul_kj' => $row['judul'],
                'type' => 'Lampiran',
                'sisa_l_kj' => $row['sisa_l'],
                'sisa_p_kj' => $row['sisa_p'],
                'terdaftar_l_kj' => $row['dftr_l'],
                'terdaftar_p_kj' => $row['dftr_p'],
                'penempatan_l_kj' => $row['tmpt_l'],
                'penempatan_p_kj' => $row['tmpt_p'],
                'hapus_l_kj' => $row['hps_l'],
                'hapus_p_kj' => $row['hps_p'],
                'akhir_l_kj' => $row['akhr_l'],
                'akhir_p_kj' => $row['akhr_p'],
            ]);
        
    }

    public function headingRow(): int
    {
        return 11;
    }

}
