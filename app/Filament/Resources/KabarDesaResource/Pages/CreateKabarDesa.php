<?php

namespace App\Filament\Resources\KabarDesaResource\Pages;

use App\Filament\Resources\KabarDesaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKabarDesa extends CreateRecord
{
    protected static string $resource = KabarDesaResource::class;
    protected static ?string $title = 'Tambah Kabar Desa';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
