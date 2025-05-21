<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\KabarDesa;
use Filament\Tables\Table;
use App\Models\KabarDesaModel;
use Filament\Resources\Resource;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KabarDesaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KabarDesaResource\RelationManagers;

class KabarDesaResource extends Resource
{
    protected static ?string $model = KabarDesaModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Informasi Desa';
    protected static ?string $navigationLabel = 'Kabar Desa';
    protected static ?string $recordTitleAttribute = 'judul';
    protected static ?string $slug = 'kabar-desa';
    protected static ?string $label = 'Kabar Desa';
    protected static ?string $pluralLabel = 'Kabar Desa';
    protected static ?string $modelLabel = 'Kabar Desa';
    protected static ?string $pluralModelLabel = 'Kabar Desa';
    protected static ?string $navigationGroupLabel = 'Informasi Desa';
    protected static ?string $navigationGroupIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationSortLabel = 'Kabar Desa';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationBadgeTooltip = 'Kabar Desa Draft';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ringkasan')
                    ->label('Ringkasan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('isi')
                    ->label('Isi')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->required()
                    ->native(false),
                Forms\Components\DatePicker::make('tgl_publish')
                    ->label('Tanggal Publish')
                    ->nullable()
                    ->default(now()),
                Forms\Components\Select::make('kategori_id')
                    ->relationship('kategori', 'nama_kategori')
                    ->label('Kategori')
                    ->required()
                    ->native(false),
                Forms\Components\FileUpload::make('gambar')
                    ->label('Gambar')
                    ->image()
                    ->directory('kabar_desa')
                    ->nullable()
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
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('ringkasan')
                //     ->label('Ringkasan')
                //     ->limit(50)
                //     ->searchable()
                //     ->toggleable(),
                Tables\Columns\TextColumn::make('isi')
                    ->label('Isi')
                    ->limit(50)
                    ->toggleable(),
                ImageColumn::make('gambar')
                    ->label('Gambar'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'info',
                        'published' => 'success',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_publish')
                    ->label('Tanggal Publish')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListKabarDesas::route('/'),
            'create' => Pages\CreateKabarDesa::route('/create'),
            'edit' => Pages\EditKabarDesa::route('/{record}/edit'),
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
        $pendingCount = static::getModel()::where('status', 'draft')->count();

        // Kembalikan jumlah sebagai string jika ada data pending
        return $pendingCount > 0 ? (string) $pendingCount : null;
    }
}
