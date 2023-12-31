<?php

namespace App\Imports;

use App\Models\DataJenisPendidikan;
use App\Models\DataLowonganJabatan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class SixSheetImportLJ implements ToModel, WithHeadingRow
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

            return new DataLowonganJabatan([
                'id_disnaker' => Auth::user()->email,
                'nmr' => $row['nmr'],
                'tgl_1' => strtoupper($tgl1),
                'tgl_2' => strtoupper($tgl2),
                'judul_lj' => $row['judul'],
                'type' => 'Laporan',
                'sisa_l_lj' => $row['sisa_l'],
                'sisa_p_lj' => $row['sisa_p'],
                'terdaftar_l_lj' => $row['dftr_l'],
                'terdaftar_p_lj' => $row['dftr_p'],
                'penempatan_l_lj' => $row['tmpt_l'],
                'penempatan_p_lj' => $row['tmpt_p'],
                'hapus_l_lj' => $row['hps_l'],
                'hapus_p_lj' => $row['hps_p'],
                'akhir_l_lj' => $row['akhr_l'],
                'akhir_p_lj' => $row['akhr_p'],
            ]);
        
    }

    public function headingRow(): int
    {
        return 11;
    }

}
