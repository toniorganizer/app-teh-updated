<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GolonganUsahaImport implements WithMultipleSheets
{
    private $data1;
    private $data2;

    public function sheets(): array
    {
        return [
            'Sheet1' => new FirstSheetImportGU($this->data1, $this->data2),
            'Sheet2' => new SecondSheetImportGU($this->data1, $this->data2),
            'Sheet3' => new ThirdSheetImportGU($this->data1, $this->data2),
            'Sheet4' => new FourSheetImportGU($this->data1, $this->data2),
        ];
    }

}
