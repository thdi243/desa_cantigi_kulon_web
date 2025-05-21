<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\SuratModel;
use Filament\Tables\Table;
use App\Models\FormSuratModel;
use Filament\Resources\Resource;
use App\Models\SubSuratTypeModel;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SuratResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SuratResource\RelationManagers;

class SuratResource extends Resource
{
    protected static ?string $model = SuratModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';
    protected static ?string $navigationGroup = 'Surat';
    protected static ?string $navigationLabel = 'Buat Surat';
    protected static ?string $label = 'Buat Surat';
    protected static ?string $pluralLabel = 'Buat Surat';
    protected static ?string $slug = 'buat-surat';
    protected static ?string $navigationBadgeTooltip = 'Surat Buatan Pending';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pemohon')
                    ->schema([
                        Forms\Components\Select::make('sub_surat_type_id')
                            ->label('Sub Surat Type')
                            ->options(function () {
                                return SubSuratTypeModel::all()->pluck('nama_sub_surat', 'id');  // Mengambil semua opsi Sub Surat Type
                            })
                            ->searchable()  // Menambahkan pencarian di dropdown
                            ->required()
                            ->reactive(),
                        Forms\Components\TextInput::make('nomor_surat')
                            ->label('Nomor Surat')
                            ->required(),
                        Forms\Components\DatePicker::make('tgl_surat')
                            ->label('Tanggal Surat')
                            ->required(),
                        Forms\Components\TextInput::make('data_pemohon.nama_lengkap_pemohon')
                            ->label('Nama Pemohon')
                            ->required(),
                        Forms\Components\TextInput::make('data_pemohon.nik_pemohon')
                            ->label('NIK Pemohon')
                            ->required(),
                        Forms\Components\TextInput::make('data_pemohon.tempat_lahir_pemohon')
                            ->label('Tempat Lahir Pemohon')
                            ->required(),
                        Forms\Components\DatePicker::make('data_pemohon.tgl_lahir_pemohon')
                            ->label('Tanggal Lahir')
                            ->required(),
                        Forms\Components\Select::make('data_pemohon.jenis_kelamin_pemohon')
                            ->label('Jenis Kelamin')
                            ->required()
                            ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ])
                            ->native(false),
                        Forms\Components\TextInput::make('data_pemohon.alamat_pemohon')
                            ->label('Alamat')
                            ->required(),
                        Forms\Components\Select::make('data_pemohon.agama_pemohon')
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
                        Forms\Components\TextInput::make('data_pemohon.pekerjaan_pemohon')
                            ->label('Pekerjaan')
                            ->required(),
                        Forms\Components\TextInput::make('data_pemohon.keperluan_pemohon')
                            ->label('Keperluan')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->native(false),
                    ])
                    ->collapsible()
                    ->columns(2),
                Forms\Components\Section::make('Isi Surat')
                    ->schema(function ($get) {
                        $subSuratTypeId = $get('sub_surat_type_id');

                        // Ambil field terkait dari FormSuratModel berdasarkan sub_surat_type_id
                        $formFields = FormSuratModel::where('form_id', $subSuratTypeId)->get();

                        $dynamicFields = [];

                        foreach ($formFields as $field) {
                            $fieldName = 'data_surat.' . $field->name;
                            $fieldLabel = $field->label;
                            $isRequired = $field->required;

                            switch ($field->type) {
                                case 'text':
                                    $dynamicFields[] =  Forms\Components\TextInput::make($fieldName)
                                        ->label($fieldLabel)
                                        ->required($isRequired);
                                    break;

                                case 'select':
                                    $options = json_decode($field->options, true);
                                    $dynamicFields[] =  Forms\Components\Select::make($fieldName)
                                        ->label($fieldLabel)
                                        ->options($options)
                                        ->required($isRequired);
                                    break;

                                case 'date':
                                    $dynamicFields[] =  Forms\Components\DatePicker::make($fieldName)
                                        ->label($fieldLabel)
                                        ->required($isRequired);
                                    break;

                                    // Tambahkan case lain sesuai dengan tipe field yang ada
                            }
                        }

                        return $dynamicFields;
                    })
                    ->collapsible()
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query->where('user_id', 1);
            })
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
                Tables\Columns\TextColumn::make('nomor_surat')
                    ->label('Nomor Surat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tgl_surat')
                    ->label('Tanggal Surat')
                    ->sortable()
                    ->date(),
                Tables\Columns\TextColumn::make('data_pemohon.nama_lengkap_pemohon')
                    ->label('Nama Pemohon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    })
                    ->formatStateUsing(fn(string $state): string => ucfirst($state))
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
                Action::make('print')
                    ->label('Print')
                    ->icon('heroicon-o-printer')
                    ->color('info')
                    ->url(fn($record) => route('surat.print', $record->id))
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListSurats::route('/'),
            'create' => Pages\CreateSurat::route('/create'),
            'view' => Pages\ViewSurat::route('/{record}'),
            'edit' => Pages\EditSurat::route('/{record}/edit'),
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
}
