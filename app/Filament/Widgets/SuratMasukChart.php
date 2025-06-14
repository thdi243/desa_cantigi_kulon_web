<?php

namespace App\Filament\Widgets;

use App\Models\SuratModel;
use Flowframe\Trend\Trend;
use App\Models\PengaduanModel;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class SuratMasukChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Surat Masuk Per Bulan';

    protected function getData(): array
    {
        $dataSurat = Trend::model(SuratModel::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();


        return [
            'datasets' => [
                [
                    'label' => 'Surat Masuk',
                    'data' => $dataSurat->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $dataSurat->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
