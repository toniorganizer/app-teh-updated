<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CetakLampiran implements WithMultipleSheets
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

        $sheets[] = new CetakLampiranIIIA($this->id);
        $sheets[] = new CetakLampiranIIIB($this->id);
        $sheets[] = new CetakLampiranIIIC($this->id);
        $sheets[] = new CetakLampiranIIID($this->id);
        $sheets[] = new CetakLampiranIIIE($this->id);
        $sheets[] = new CetakLampiranIIIF($this->id);
        $sheets[] = new CetakLampiranIIIG($this->id);
        $sheets[] = new CetakLampiranIIIH($this->id);

        return $sheets;
    }
}
