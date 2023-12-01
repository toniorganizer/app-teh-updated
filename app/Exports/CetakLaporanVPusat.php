<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CetakLaporanVPusat implements WithMultipleSheets
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

        $sheets[] = new CetakLaporanVA($this->id, $this->lambang);
        $sheets[] = new CetakLaporanVB($this->id, $this->lambang);
        $sheets[] = new CetakLaporanVC($this->id, $this->lambang);
        $sheets[] = new CetakLaporanVD($this->id, $this->lambang);
        $sheets[] = new CetakLaporanVE($this->id, $this->lambang);
        $sheets[] = new CetakLaporanVF($this->id, $this->lambang);
        $sheets[] = new CetakLaporanVG($this->id, $this->lambang);

        return $sheets;
    }
}
