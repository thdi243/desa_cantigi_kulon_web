<?php

namespace App\Filament\Widgets;

use Flowframe\Trend\Trend;
use App\Models\PengaduanModel;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class PengaduanChart extends ChartWidget
{
    protected static ?string $heading = 'Pengaduan Per Bulan';
    protected static string $color = 'success';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Trend::model(PengaduanModel::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'title' => 'Surat Masuk Per Bulan',

            'datasets' => [
                [
                    'label' => 'Surat Masuk',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
