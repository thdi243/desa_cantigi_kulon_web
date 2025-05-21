<?php

namespace App\Filament\Widgets;

use App\Models\SuratModel;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        $suratMasuk = SuratModel::count();
        $reqSuratMasuk = SuratModel::where('user_id', '!=', 1)->count();

        return [
            Stat::make('Surat Masuk', value: $suratMasuk)
                ->description('Total surat masuk')
                ->color('success'),
            Stat::make('Request Surat', value: $reqSuratMasuk)
                ->description('Total surat masuk yang diminta user')
                ->color('warning'),

            Stat::make('Average time on page', '3:12'),
        ];
    }
}
