<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CetakLaporanIVPusat implements WithMultipleSheets
{

    use Exportable;

    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {

        $sheets[] = new CetakLaporanIVA($this->id);
        $sheets[] = new CetakLaporanIVB($this->id);
        $sheets[] = new CetakLaporanIVC($this->id);
        $sheets[] = new CetakLaporanIVD($this->id);
        $sheets[] = new CetakLaporanIVE($this->id);
        $sheets[] = new CetakLaporanIVF($this->id);
        $sheets[] = new CetakLaporanIVG($this->id);
        $sheets[] = new CetakLaporanIVH($this->id);
        $sheets[] = new CetakLaporanIV9($this->id);

        return $sheets;
    }
}
