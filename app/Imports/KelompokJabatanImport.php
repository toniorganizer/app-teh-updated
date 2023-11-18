<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class KelompokJabatanImport implements WithMultipleSheets
{


    private $data1;
    private $data2;

    public function sheets(): array
    {
        return [
            'Sheet1' => new FirstSheetImportKJ($this->data1, $this->data2),
            'Sheet2' => new SecondSheetImportKJ($this->data1, $this->data2),
            'Sheet3' => new ThirdSheetImportKJ($this->data1, $this->data2),
            'Sheet4' => new FourSheetImportKJ($this->data1, $this->data2),
            'Sheet5' => new FiveSheetImportKJ($this->data1, $this->data2),
            'Sheet6' => new SixSheetImportKJ($this->data1, $this->data2),
            'Sheet7' => new SevenSheetImportKJ($this->data1, $this->data2),
            'Sheet8' => new EightSheetImportKJ($this->data1, $this->data2),
        ];
    }

}
