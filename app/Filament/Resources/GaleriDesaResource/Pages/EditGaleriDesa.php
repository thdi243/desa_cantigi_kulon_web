<?php

namespace App\Filament\Resources\GaleriDesaResource\Pages;

use App\Filament\Resources\GaleriDesaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGaleriDesa extends EditRecord
{
    protected static string $resource = GaleriDesaResource::class;
    protected static ?string $title = 'Edit Galeri Desa';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
