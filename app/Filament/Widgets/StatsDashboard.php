<?php

namespace App\Filament\Widgets;

use App\Models\SuratModel;
use App\Models\PengaduanModel;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsDashboard extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $suratMasuk = SuratModel::count();
        $reqSuratMasuk = SuratModel::where('user_id', '!=', 1)->count();
        $pengaduan = PengaduanModel::count();

        return [
            Stat::make('Surat Masuk', value: $suratMasuk)
                ->description('Total surat masuk')
                ->color('success'),
            Stat::make('Request Surat', value: $reqSuratMasuk)
                ->description('Total surat masuk yang diminta user')
                ->color('warning'),
            Stat::make('Pengaduan', value: $pengaduan)
                ->description('Total pengaduan yang masuk')
                ->color('danger'),

        ];
    }
}
