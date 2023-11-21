<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LowonganJabatanImport implements WithMultipleSheets
{


    private $data1;
    private $data2;

    public function sheets(): array
    {
        return [
            'Sheet1' => new FirstSheetImportLJ($this->data1, $this->data2),
            'Sheet2' => new SecondSheetImportLJ($this->data1, $this->data2),
            'Sheet3' => new ThirdSheetImportLJ($this->data1, $this->data2),
            'Sheet4' => new FourSheetImportLJ($this->data1, $this->data2),
            'Sheet5' => new FiveSheetImportLJ($this->data1, $this->data2),
            'Sheet6' => new SixSheetImportLJ($this->data1, $this->data2),
            'Sheet7' => new SevenSheetImportLJ($this->data1, $this->data2),
        ];
    }

}
