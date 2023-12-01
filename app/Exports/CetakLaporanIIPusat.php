<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CetakLaporanIIPusat implements WithMultipleSheets
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

        $sheets[] = new CetakLaporanIIA($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIIB($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIIC($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIID($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIIE($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIIF($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIIG($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIIH($this->id, $this->lambang);
        $sheets[] = new CetakLaporanII9($this->id, $this->lambang);

        return $sheets;
    }
}
