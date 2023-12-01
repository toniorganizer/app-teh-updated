<?php

namespace App\Exports;

use App\Imports\ThirdSheetImportGU;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CetakLaporanVIPusat implements WithMultipleSheets
{

    use Exportable;

    private $id;
    private $lambang;

    public function __construct($id, $lambang)
    {
        $this->id = $id;
        $this->lambang = $lambang;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {

        $sheets[] = new CetakLaporanVIA($this->id, $this->lambang);
        $sheets[] = new CetakLaporanVIB($this->id, $this->lambang);
        $sheets[] = new CetakLaporanVIC($this->id, $this->lambang);
        $sheets[] = new CetakLaporanVID($this->id, $this->lambang);

        return $sheets;
    }
}
