<?php

namespace App\Filament\Resources\KabarDesaResource\Pages;

use App\Filament\Resources\KabarDesaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Components\Tab;

class ListKabarDesas extends ListRecords
{
    protected static string $resource = KabarDesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'published' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'published')),
            'draft' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'draft')),
        ];
    }
}
