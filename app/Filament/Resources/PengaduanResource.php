<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Infolists;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PengaduanModel;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use App\Jobs\SendEmailPengaduanJob;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Actions\Action;
use App\Filament\Resources\PengaduanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PengaduanResource\RelationManagers;

class PengaduanResource extends Resource
{
    protected static ?string $model = PengaduanModel::class;

    protected static ?string $navigationGroup = 'Pengaduan';
    protected static ?string $navigationLabel = 'Pengaduan';
    protected static ?string $label = 'Pengaduan';
    protected static ?string $pluralLabel = 'Pengaduan';
    protected static ?string $slug = 'pengaduan';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $modelLabel = 'Pengaduan';
    protected static ?string $pluralModelLabel = 'Pengaduan';
    protected static ?string $navigationGroupLabel = 'Pengaduan';
    protected static ?string $navigationSortLabel = 'Pengaduan';
    protected static ?string $navigationGroupIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationBadgeTooltip = 'Pengaduan Pending';
    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
                TextInput::make('nik')
                    ->label('NIK')
                    ->required(),
                TextInput::make('category')
                    ->label('Category')
                    ->required(),
                TextInput::make('description')
                    ->label('Description')
                    ->required(),
                TextInput::make('location')
                    ->label('Location')
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'process' => 'Process',
                        'finished' => 'Finished',
                    ])
                    ->native(false)
                    ->required(),
                FileUpload::make('photo')
                    ->label('Photo')
                    ->image()
                    ->directory('photos')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->wrap()
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('location')
                    ->label('Lokasi')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime()
                    ->since()
                    ->searchable()
                    ->sortable()
                    ->dateTimeTooltip(),
                TextColumn::make('status')
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'process' => 'success',
                        'finished' => 'info',
                    })
                    ->searchable(),
                ImageColumn::make('photo')
                    ->label('Foto')
                    ->getStateUsing(function ($record) {
                        return $record->photo
                            ? asset('storage/' . $record->photo)
                            : null;
                    })
                    ->height(50),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengaduans::route('/'),
            'create' => Pages\CreatePengaduan::route('/create'),
            'edit' => Pages\EditPengaduan::route('/{record}/edit'),
            // 'view' => Pages\ViewPengaduan::route('/{record}'),
            'view-pengaduan' => Pages\ViewPengaduan::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        $pendingCount = static::getModel()::where('status', 'pending')->count();

        // Kembalikan jumlah sebagai string jika ada data pending
        return $pendingCount > 0 ? (string) $pendingCount : null;
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Pemohon')
                    ->schema([
                        TextEntry::make('name')->label('Nama'),
                        TextEntry::make('nik')->label('NIK'),
                        TextEntry::make('category')->label('Kategori'),
                        TextEntry::make('description')->label('Deskripsi'),
                        TextEntry::make('location')->label('Lokasi'),
                        TextEntry::make('status')
                            ->label('Status')
                            ->color(fn(string $state): string => match ($state) {
                                'pending' => 'warning',
                                'process' => 'success',
                                'finished' => 'info',
                                default => 'gray',
                            })
                            ->badge(),
                        TextEntry::make('photo')
                            ->label('Foto')
                            ->formatStateUsing(function ($state) {
                                return $state
                                    ? '<img src="' . asset('storage/' . $state) . '" alt="Foto" style="max-height: 100px;">'
                                    : 'Tidak ada foto';
                            })
                            ->html(),
                    ])->collapsible()->columns(2),
                Actions::make([
                    Action::make('send_email')
                        ->label('Send Email')
                        ->icon('heroicon-o-paper-airplane')
                        ->color('success')
                        ->action(function ($record) {
                            try {
                                self::validateEmailSending($record);

                                SendEmailPengaduanJob::dispatch($record, $record->user_id);

                                Notification::make()
                                    ->title('Email Terkirim')
                                    ->body("Email untuk {$record->name} berhasil dikirim.")
                                    ->success()
                                    ->send();
                            } catch (\Exception $e) {
                                Log::error('Email Sending Error', [
                                    'surat_id' => $record->id,
                                    'user_id' => $record->user_id,
                                    'error' => $e->getMessage(),
                                ]);

                                Notification::make()
                                    ->title('Gagal Mengirim Email')
                                    ->body($e->getMessage())
                                    ->danger()
                                    ->send();
                            }
                        }),
                ]),
            ]);
    }

    public static function validateEmailSending($record)
    {
        $user = User::find($record->user_id);

        if (!$user || !$user->email) {
            throw new \Exception('Tidak ada email penerima yang tersedia.');
        }

        if ($record->status !== 'process') {
            throw new \Exception('Surat belum dapat dikirim. Status harus "process".');
        }
    }
}
