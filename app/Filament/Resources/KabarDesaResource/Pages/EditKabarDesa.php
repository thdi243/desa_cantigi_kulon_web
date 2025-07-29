<?php

namespace App\Filament\Resources\KabarDesaResource\Pages;

use App\Filament\Resources\KabarDesaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKabarDesa extends EditRecord
{
    protected static string $resource = KabarDesaResource::class;
    protected static ?string $title = 'Edit Kabar Desa';

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
