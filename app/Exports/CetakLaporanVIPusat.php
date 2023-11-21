<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CetakLaporanVIPusat implements WithMultipleSheets
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

        $sheets[] = new CetakLaporanVIA($this->id);
        $sheets[] = new CetakLaporanVIB($this->id);
        $sheets[] = new CetakLaporanVIC($this->id);
        $sheets[] = new CetakLaporanVID($this->id);

        return $sheets;
    }
}
