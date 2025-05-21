<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Actions\SendToAction;
use App\Models\SuratModel;
use Filament\Tables\Table;
use App\Jobs\SendEmailSuratJob;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Split;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Support\Components\ViewComponent;
use Filament\Infolists\Components\Actions\Action;
use App\Filament\Resources\ReqSuratResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Actions\Exports\Downloaders\Contracts\Downloader;

class ReqSuratResource extends Resource
{
    protected static ?string $model = SuratModel::class;

    protected static ?string $navigationGroup = 'Surat';
    protected static ?string $navigationLabel = 'Surat Masuk';
    protected static ?string $label = 'Surat Masuk';
    protected static ?string $pluralLabel = 'Surat Masuk';
    protected static ?string $slug = 'req-surat';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $recordTitleAttribute = 'nomor_surat';
    protected static ?string $modelLabel = 'Surat Masuk';
    protected static ?string $pluralModelLabel = 'Surat Masuk';
    protected static ?string $modelIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroupLabel = 'Surat';
    protected static ?string $navigationSortLabel = 'Surat Masuk';
    protected static ?string $navigationGroupSortLabel = 'Surat Masuk';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationBadgeTooltip = 'Surat Masuk Pending';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pemohon')
                    ->schema([
                        TextInput::make('nomor_surat')
                            ->label('Nomor Surat')
                            ->required(),
                        DatePicker::make('tgl_surat')
                            ->label('Tanggal Surat')
                            ->required(),
                        TextInput::make('data_pemohon.nama_lengkap_pemohon')
                            ->label('Nama Pemohon')
                            ->required(),
                        TextInput::make('data_pemohon.nik_pemohon')
                            ->label('NIK Pemohon')
                            ->required(),
                        TextInput::make('data_pemohon.tempat_lahir_pemohon')
                            ->label('Tempat Lahir Pemohon')
                            ->required(),
                        DatePicker::make('data_pemohon.tgl_lahir_pemohon')
                            ->label('Tanggal Lahir')
                            ->required(),

                        Select::make('data_pemohon.jenis_kelamin_pemohon')
                            ->label('Jenis Kelamin')
                            ->required()
                            ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ])
                            ->native(false),
                        TextInput::make('data_pemohon.alamat_pemohon')
                            ->label('Alamat')
                            ->required(),
                        Select::make('data_pemohon.agama_pemohon')
                            ->label('Agama')
                            ->required()
                            ->options([
                                'islam' => 'Islam',
                                'kristen' => 'Kristen',
                                'budha' => 'Budha',
                                'katholik' => 'Katholik',
                                'konghucu' => 'Konghucu',
                                'hindu' => 'Hindu',
                            ])
                            ->native(false),
                        TextInput::make('data_pemohon.pekerjaan_pemohon')
                            ->label('Pekerjaan')
                            ->required(),
                        TextInput::make('data_pemohon.keperluan_pemohon')
                            ->label('Keperluan')
                            ->required(),
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->native(false),
                    ])
                    ->collapsible()
                    ->columns(2),
                Section::make('Informasi Surat')
                    ->schema(function ($get) {
                        $dataSurat = $get('data_surat') ?? [];
                        $fields = [];

                        // Iterating through data_surat field keys to create dynamic inputs
                        if (is_array($dataSurat)) {
                            foreach ($dataSurat as $key => $value) {
                                // Skip nested arrays/objects - handle them separately if needed
                                if (!is_array($value) && !is_object($value)) {
                                    // Convert key from snake_case to Title Case for label
                                    $label = ucwords(str_replace('_', ' ', $key));

                                    // Create appropriate input based on value type
                                    if (is_numeric($value)) {
                                        $fields[] = TextInput::make("data_surat.{$key}")
                                            ->label($label)
                                            ->numeric();
                                    } elseif (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
                                        // Likely a date field
                                        $fields[] = DatePicker::make("data_surat.{$key}")
                                            ->label($label);
                                    } else {
                                        $fields[] = TextInput::make("data_surat.{$key}")
                                            ->label($label);
                                    }
                                }
                            }
                        }

                        return $fields;
                    })
                    ->collapsible()
                    ->columns(2),
                // ])->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('nomor_surat')
                    ->label('Nomor Surat')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tgl_surat')
                    ->label('Tanggal Surat')
                    ->date()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subSuratType.nama_sub_surat')
                    ->label('Tipe Surat')
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('Nama Pemohon')
                    ->getStateUsing(function ($record) {
                        // Decode JSON jika masih dalam bentuk string
                        $dataPemohon = is_string($record->data_pemohon)
                            ? json_decode($record->data_pemohon, true)
                            : $record->data_pemohon;

                        return $dataPemohon['nama_lengkap_pemohon'] ?? '-';
                    }),
                TextColumn::make('status')
                    ->label('Status')
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    })
                    ->formatStateUsing(fn(string $state): string => ucfirst($state))
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListReqSurats::route('/'),
            'create' => Pages\CreateReqSurat::route('/create'),
            'edit' => Pages\EditReqSurat::route('/{record}/edit'),
            'view' => Pages\ViewReqSurat::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistSection::make('Informasi Pemohon')
                    ->schema([
                        Split::make([
                            Grid::make(2)
                                ->schema([
                                    Group::make([
                                        TextEntry::make('nomor_surat')
                                            ->label('Nomor Surat'),
                                        TextEntry::make('tgl_surat')
                                            ->label('Tanggal Surat')
                                            ->date(),
                                        TextEntry::make('data_pemohon.nama_lengkap_pemohon')
                                            ->label('Nama Pemohon'),
                                        TextEntry::make('data_pemohon.nik_pemohon')
                                            ->label('NIK Pemohon'),
                                        TextEntry::make('data_pemohon.tempat_lahir_pemohon')
                                            ->label('Tempat Lahir Pemohon'),
                                        TextEntry::make('data_pemohon.tgl_lahir_pemohon')
                                            ->label('Tanggal Lahir Pemohon')
                                            ->date(),
                                    ]),
                                    Group::make([
                                        TextEntry::make('data_pemohon.jenis_kelamin_pemohon')
                                            ->label('Jenis Kelamin Pemohon'),
                                        TextEntry::make('data_pemohon.agama_pemohon')
                                            ->label('Agama Pemohon'),
                                        TextEntry::make('data_pemohon.alamat_pemohon')
                                            ->label('Alamat Pemohon'),
                                        TextEntry::make('data_pemohon.pekerjaan_pemohon')
                                            ->label('Pekerjaan Pemohon'),
                                        TextEntry::make('data_pemohon.keperluan_pemohon')
                                            ->label('Keperluan Pemohon'),
                                        TextEntry::make('status')
                                            ->label('Status Pemohon')
                                            ->badge()
                                            ->color(fn(string $state): string => match ($state) {
                                                'pending' => 'warning',
                                                'approved' => 'success',
                                                'rejected' => 'danger',
                                                default => 'gray',
                                            }),
                                    ]),
                                ]),
                        ]),
                        Split::make([
                            Actions::make([
                                Action::make('lihat_surat')
                                    ->label('Lihat Template Surat')
                                    ->color('primary')
                                    ->icon('heroicon-o-document')
                                    ->modalHeading(function ($record) {
                                        return 'Surat: ' . ($record->nomor_surat ?? 'Draft');
                                    })
                                    ->modalContent(function ($record) {
                                        $subSuratTypeId = $record->sub_surat_type_id;

                                        $templateMapping = [
                                            1 => 'filament.resources.req_surat.templates.sk_domisili_masyarakat',
                                            2 => 'filament.resources.req_surat.templates.sk_wali_murid',
                                            3 => 'filament.resources.req_surat.templates.sk_penghasilan_ortu',
                                            // Add more mappings as needed
                                        ];

                                        $viewPath = $templateMapping[$subSuratTypeId] ?? 'filament.resources.req_surat.template_surat';

                                        return view($viewPath, [
                                            'record' => $record
                                        ]);
                                    })
                                    ->modalWidth('3xl'),
                            ])->columnSpanFull(),
                        ]),
                    ])->collapsible(),
                Actions::make([
                    Action::make('print')
                        ->label('Print Surat')
                        ->icon('heroicon-o-printer')
                        ->color('primary')
                        ->url(fn($record) => route('surat.print', $record->id))
                        ->openUrlInNewTab(),

                    Action::make('send_email')
                        ->label('Send Email')
                        ->icon('heroicon-o-paper-airplane')
                        ->color('success')
                        ->action(function ($record) {
                            try {
                                $user = User::findOrFail($record->user_id);

                                self::validateEmailSending($record);

                                SendEmailSuratJob::dispatch($record, $record->user_id);

                                Notification::make()
                                    ->title('Email Terkirim')
                                    ->body("Email untuk {$record->data_pemohon['nama_lengkap_pemohon']} berhasil dikirim.")
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

                ])->fullWidth(),
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        $pendingCount = static::getModel()::where('status', 'pending')->count();

        // Kembalikan jumlah sebagai string jika ada data pending
        return $pendingCount > 0 ? (string) $pendingCount : null;
    }

    /**
     * Validate if email can be sent
     * 
     * @param Surat $record
     * @throws \Exception
     */
    protected static function validateEmailSending($record)
    {
        $user = User::find($record->user_id);

        if (!$user || !$user->email) {
            throw new \Exception('Tidak ada email penerima yang tersedia.');
        }

        if ($record->status !== 'approved') {
            throw new \Exception('Surat belum dapat dikirim. Status harus "approved".');
        }
    }

    /**
     * Determine if email action should be visible
     * 
     * @param Surat $record
     * @return bool
     */
    protected static function canSendEmail($record)
    {
        // Check if user exists and has an email
        $user = User::find($record->user_id);

        return $user && $user->email && $record->status === 'approved';
    }
}
