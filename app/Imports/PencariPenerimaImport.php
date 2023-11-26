<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\DataPencariPenerima;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PencariPenerimaImport implements ToModel, WithHeadingRow
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

            return new DataPencariPenerima([
                'id_disnaker' => Auth::user()->email,
                'nmr' => $row['nmr'],
                'type' => 'Laporan',
                'tgl_1' => strtoupper($tgl1),
                'tgl_2' => strtoupper($tgl2),
                'judul' => $row['judul'],
                'akll' => $row['akll'],
                'aklp' => $row['aklp'],
                'akadl' => $row['akadl'],
                'akadp' => $row['akadp'],
                'akanl' => $row['akanl'],
                'akanp' => $row['akanp'],
                'jmll' => $row['jmll'],
                'jmlp' => $row['jmlp'],
            ]);
        
    }

    public function headingRow(): int
    {
        return 11;
    }

}
