<?php

namespace App\Imports;

use App\Models\DataGolonganUsaha;
use App\Models\DataJenisPendidikan;
use App\Models\DataKabKota;
use App\Models\DataLowonganJabatan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class EightSheetImportLampiran implements ToModel, WithHeadingRow
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

            return new DataKabKota([
                'id_disnaker' => Auth::user()->email,
                'nmr' => $row['nmr'],
                'tgl_1' => strtoupper($tgl1),
                'tgl_2' => strtoupper($tgl2),
                'type' => 'Lampiran',
                'judul' => $row['kab'],
                'pktl' => $row['pktl'],
                'pktw' => $row['pktw'],
                'jpkt' => $row['jpkt'],
                'lktl' => $row['lktl'],
                'lktw' => $row['lktw'],
                'jlkt' => $row['jlkt'],
                'pkdl' => $row['pkdl'],
                'pkdw' => $row['pkdw'],
                'jpkd' => $row['jpkd'],
            ]);
        
    }

    public function headingRow(): int
    {
        return 11;
    }

}
