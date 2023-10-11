<?php

namespace App\Charts;

use App\Models\InformasiLowongan;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonhtlyJobArea
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {

        $bidang = InformasiLowongan::distinct('bidang')->pluck('bidang')->toArray();

        $data = [];

        foreach ($bidang as $b) {
            $count = InformasiLowongan::where('bidang', 'like', '%' . $b . '%')->count();
            $data[$b] = $count;
        }

        $labels = array_keys($data);
        $values = array_values($data);

        return $this->chart->areaChart()
            ->setTitle('Tren Informasi Pasar Kerja')
            ->setSubtitle('Provinsi Sumatera Barat')
            ->addData('Jumlah', $values)
            ->setXAxis($labels);
    }
}
