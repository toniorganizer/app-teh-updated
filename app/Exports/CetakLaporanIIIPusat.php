<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CetakLaporanIIIPusat implements WithMultipleSheets
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

        $sheets[] = new CetakLaporanIIIA($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIIIB($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIIIC($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIIID($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIIIE($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIIIF($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIIIG($this->id, $this->lambang);
        $sheets[] = new CetakLaporanIIIH($this->id, $this->lambang);

        return $sheets;
    }
}
