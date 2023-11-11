<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class JenisPendidikanImport implements WithMultipleSheets
{


    private $data1;
    private $data2;

    public function sheets(): array
    {
        return [
            'Sheet1' => new FirstSheetImportJP($this->data1, $this->data2),
            'Sheet2' => new SecondSheetImportJP($this->data1, $this->data2),
            'Sheet3' => new ThirdSheetImportJP($this->data1, $this->data2),
            'Sheet4' => new FourSheetImportJP($this->data1, $this->data2),
            'Sheet5' => new FiveSheetImportJP($this->data1, $this->data2),
            'Sheet6' => new SixSheetImportJP($this->data1, $this->data2),
            'Sheet7' => new SevenSheetImportJP($this->data1, $this->data2),
            'Sheet8' => new EightSheetImportJP($this->data1, $this->data2),
            'Sheet9' => new NineSheetImportJP($this->data1, $this->data2),
        ];
    }

}
