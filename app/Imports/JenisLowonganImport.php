<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class JenisLowonganImport implements WithMultipleSheets
{
    private $data1;
    private $data2;

    public function sheets(): array
    {
        return [
            'Sheet1' => new FirstSheetImportLP($this->data1, $this->data2),
            'Sheet2' => new SecondSheetImportLP($this->data1, $this->data2),
            'Sheet3' => new ThirdSheetImportLP($this->data1, $this->data2),
            'Sheet10' => new FourSheetImportLP($this->data1, $this->data2),
            'Sheet11' => new FiveSheetImportLP($this->data1, $this->data2),
            'Sheet6' => new SixSheetImportLP($this->data1, $this->data2),
            'Sheet12' => new SevenSheetImportLP($this->data1, $this->data2),
            'Sheet13' => new EightSheetImportLP($this->data1, $this->data2),
            'Sheet14' => new NineSheetImportLP($this->data1, $this->data2),
        ];
    }

}
