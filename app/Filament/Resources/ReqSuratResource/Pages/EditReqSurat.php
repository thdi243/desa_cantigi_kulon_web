<?php

namespace App\Filament\Resources\ReqSuratResource\Pages;

use App\Filament\Resources\ReqSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReqSurat extends EditRecord
{
    protected static string $resource = ReqSuratResource::class;
    protected static ?string $title = 'Edit Permohonan Surat';

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
