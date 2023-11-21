<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CetakLaporanVPusat implements WithMultipleSheets
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

        $sheets[] = new CetakLaporanVA($this->id);
        $sheets[] = new CetakLaporanVB($this->id);
        $sheets[] = new CetakLaporanVC($this->id);
        $sheets[] = new CetakLaporanVD($this->id);
        $sheets[] = new CetakLaporanVE($this->id);
        $sheets[] = new CetakLaporanVF($this->id);
        $sheets[] = new CetakLaporanVG($this->id);

        return $sheets;
    }
}
