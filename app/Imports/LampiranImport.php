<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LampiranImport implements WithMultipleSheets
{


    private $data1;
    private $data2;

    public function sheets(): array
    {
        return [
            'TBL4.1' => new FirstSheetImportLampiran($this->data1, $this->data2),
            'TBL4.8' => new SecondSheetImportLampiran($this->data1, $this->data2),
            'TBL4.9' => new ThirdSheetImportLampiran($this->data1, $this->data2),
            'TBL4.10' => new FourSheetImportLampiran($this->data1, $this->data2),
            'TBL4.11' => new FiveSheetImportLampiran($this->data1, $this->data2),
            'TBL4.12' => new SixSheetImportLampiran($this->data1, $this->data2),
            'TBL4.13' => new SevenSheetImportLampiran($this->data1, $this->data2),
            'TBL4.14' => new EightSheetImportLampiran($this->data1, $this->data2),
        ];
    }

}
