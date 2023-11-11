<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CetakLaporanIIPusat implements WithMultipleSheets
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

        $sheets[] = new CetakLaporanIIA($this->id);
        $sheets[] = new CetakLaporanIIB($this->id);
        $sheets[] = new CetakLaporanIIC($this->id);
        $sheets[] = new CetakLaporanIID($this->id);
        $sheets[] = new CetakLaporanIIE($this->id);
        $sheets[] = new CetakLaporanIIF($this->id);
        $sheets[] = new CetakLaporanIIG($this->id);
        $sheets[] = new CetakLaporanIIH($this->id);
        $sheets[] = new CetakLaporanII9($this->id);

        return $sheets;
    }
}
