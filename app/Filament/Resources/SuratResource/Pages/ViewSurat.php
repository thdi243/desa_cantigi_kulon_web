<?php

namespace App\Filament\Resources\SuratResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\SuratResource;

class ViewSurat extends ViewRecord
{
    protected static string $resource = SuratResource::class;
}
