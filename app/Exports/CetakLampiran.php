<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CetakLampiran implements WithMultipleSheets
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

        $sheets[] = new CetakLampiranIIIA($this->id, $this->lambang);
        $sheets[] = new CetakLampiranIIIB($this->id, $this->lambang);
        $sheets[] = new CetakLampiranIIIC($this->id, $this->lambang);
        $sheets[] = new CetakLampiranIIID($this->id, $this->lambang);
        $sheets[] = new CetakLampiranIIIE($this->id, $this->lambang);
        $sheets[] = new CetakLampiranIIIF($this->id, $this->lambang);
        $sheets[] = new CetakLampiranIIIG($this->id, $this->lambang);
        $sheets[] = new CetakLampiranIIIH($this->id, $this->lambang);

        return $sheets;
    }
}
