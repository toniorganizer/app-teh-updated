<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CetakLaporanIVPusat implements WithMultipleSheets
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

        $sheets[] = new CetakLaporanIVA($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIVB($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIVC($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIVD($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIVE($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIVF($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIVG($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIVH($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIV9($this->id, $this->lambang);

        return $sheets;
    }
}
