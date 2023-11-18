<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CetakLaporanIIIPusat implements WithMultipleSheets
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

        $sheets[] = new CetakLaporanIIIA($this->id);
        $sheets[] = new CetakLaporanIIIB($this->id);
        $sheets[] = new CetakLaporanIIIC($this->id);
        $sheets[] = new CetakLaporanIIID($this->id);
        $sheets[] = new CetakLaporanIIIE($this->id);
        $sheets[] = new CetakLaporanIIIF($this->id);
        $sheets[] = new CetakLaporanIIIG($this->id);
        $sheets[] = new CetakLaporanIIIH($this->id);

        return $sheets;
    }
}
