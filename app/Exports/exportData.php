<?php

namespace App\Exports;

use App\Models\InformasiLowongan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request as HttpRequest;
use Maatwebsite\Excel\Concerns\FromCollection;

class exportData implements WithHeadings, FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // protected $data;

    // public function __construct($data)
    // {
    //     $this->data = $data;
    // }

    // public function collection()
    // {
    //     return collect($this->data);
    // }

    public function view(): View
    {
        $data = InformasiLowongan::get();
        return view('Dashboard.admin.uji-cetak-laporan')->with([
            'data' => $data
        ]);
    }

    public function headings(): array
    {
        // Define the headings for your Excel file here
        return [
            'Column 1',
            'Column 2',
            // Add more headings as needed
        ];
    }
}
