<?php

namespace App\Filament\Resources\SuratResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\SuratResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Components\Tab;

class ListSurats extends ListRecords
{
    protected static string $resource = SuratResource::class;
    protected static ?string $title = 'Daftar Surat';

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'pending' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'pending')),
            'approved' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'approved')),
            'rejected' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'rejected')),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // protected function getTableQuery(): Builder
    // {
    //     $query = parent::getTableQuery();

    //     // Filter berdasarkan user yang sedang login
    //     if (Auth::user()->id == 1) {
    //         return $query;
    //     } else {
    //         return $query->where('user_id', 1);
    //     }
    // }
}
