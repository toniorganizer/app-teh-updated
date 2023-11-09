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
        ];
    }

}
