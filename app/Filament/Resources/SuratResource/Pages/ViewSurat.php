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

    // protected static string $view = 'filament.resources.surat-resource.pages.view-surat';

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\EditAction::make(),
    //     ];
    // }

    // Override method untuk custom view
    // public function view(): View
    // {
    //     return view('filament.resources.req-surat.view', [
    //         'record' => $this->record,
    //     ]);
    // }

    // public function getActions(): array
    // {
    //     return [
    //         // Approval Action
    //         Action::make('approve')
    //             ->label('Setujui Surat')
    //             ->color('success')
    //             ->icon('heroicon-o-check-circle')
    //             ->visible(fn($record) => $record->status === 'pending')
    //             ->action(fn() => $this->approveSurat()),

    //         // Action Group for Additional Options
    //         ActionGroup::make([
    //             // Send Email Action
    //             Action::make('send_email')
    //                 ->label('Kirim Email')
    //                 ->icon('heroicon-o-envelope')
    //                 ->form([
    //                     Textarea::make('email_message')
    //                         ->label('Pesan Tambahan')
    //                         ->placeholder('Tambahkan pesan tambahan untuk email (opsional)')
    //                         ->rows(3),
    //                 ])
    //                 ->action(fn(array $data) => $this->sendSuratEmail($data['email_message'] ?? '')),

    //             // Download PDF Action
    //             Action::make('download_pdf')
    //                 ->label('Download PDF')
    //                 ->icon('heroicon-o-document-download')
    //                 ->action(fn() => $this->downloadSuratPdf()),

    //             // Print Action (uses browser's print functionality)
    //             Action::make('print')
    //                 ->label('Cetak')
    //                 ->icon('heroicon-o-printer')
    //                 ->action(fn() => $this->printSurat()),
    //         ])->icon('heroicon-o-ellipsis-vertical')
    //     ];
    // }
}
