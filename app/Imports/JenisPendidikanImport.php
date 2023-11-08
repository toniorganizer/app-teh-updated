<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class JenisPendidikanImport implements WithMultipleSheets
{

    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            'Worksheet 1' => new FirstSheetImportJP(),
            'Worksheet 2' => new SecondSheetImportJP(),
        ];
    }

}
