<?php

namespace App\Filament\Resources\SuratResource\Pages;

use App\Filament\Resources\SuratResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSurat extends CreateRecord
{
    protected static string $resource = SuratResource::class;
    protected static ?string $title = 'Tambah Surat';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
