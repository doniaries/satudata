<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DatasetResource\Pages;
use App\Filament\Resources\DatasetResource\RelationManagers;
use App\Models\Dataset;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use function Livewire\wrap;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DatasetResource extends Resource
{
    protected static ?string $model = Dataset::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $user = Auth::user();
        $isSuperAdmin = $user->hasRole('super_admin');
        $isAdminSatuData = $user->hasRole('admin_satudata');

        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        // Left Column - User Input Fields
                        Forms\Components\Grid::make(1)
                            ->schema([
                                Forms\Components\Section::make('Informasi Dataset')
                                    ->schema([
                                        // Main dataset fields
                                        Forms\Components\TextInput::make('judul')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn(string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                                        Forms\Components\Hidden::make('slug')
                                            ->disabled()
                                            ->dehydrated()
                                            ->required()
                                            ->unique(Dataset::class, 'slug', ignoreRecord: true),

                                        Forms\Components\Textarea::make('deskripsi_dataset')
                                            ->label('Deskripsi Dataset')
                                            ->required()
                                            ->columnSpanFull(),

                                        // Satuan with pluck for better performance
                                        // Satuan and Ukuran in one row
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                // Satuan field
                                                Forms\Components\Select::make('satuan_id')
                                                    ->label('Satuan')
                                                    ->options(fn() => \App\Models\Satuan::pluck('nama_satuan', 'id'))
                                                    ->createOptionForm([
                                                        Forms\Components\TextInput::make('nama_satuan')
                                                            ->label('Nama Satuan')
                                                            ->required()
                                                            ->maxLength(255)
                                                            ->unique('satuans', 'nama_satuan')
                                                            ->columnSpanFull(),
                                                    ])
                                                    ->createOptionAction(
                                                        fn(Forms\Components\Actions\Action $action) => $action
                                                            ->modalHeading('Tambah Satuan Baru')
                                                            ->modalDescription('Masukkan nama satuan baru')
                                                            ->modalSubmitActionLabel('Simpan')
                                                            ->modalWidth('sm')
                                                    )
                                                    ->createOptionUsing(function (array $data) {
                                                        $existingSatuan = \App\Models\Satuan::where('nama_satuan', $data['nama_satuan'])->first();
                                                        if ($existingSatuan) {
                                                            return $existingSatuan->id;
                                                        }
                                                        return \App\Models\Satuan::create($data)->id;
                                                    })
                                                    ->searchable()
                                                    ->preload()
                                                    ->required(),

                                                // Ukuran field
                                                Forms\Components\Select::make('ukuran_id')
                                                    ->label('Ukuran')
                                                    ->options(fn() => \App\Models\Ukuran::pluck('nama_ukuran', 'id'))
                                                    ->createOptionForm([
                                                        Forms\Components\TextInput::make('nama_ukuran')
                                                            ->label('Nama Ukuran')
                                                            ->required()
                                                            ->maxLength(255)
                                                            ->unique('ukurans', 'nama_ukuran')
                                                            ->columnSpanFull(),
                                                    ])
                                                    ->createOptionAction(
                                                        fn(Forms\Components\Actions\Action $action) => $action
                                                            ->modalHeading('Tambah Ukuran Baru')
                                                            ->modalDescription('Masukkan nama ukuran baru')
                                                            ->modalSubmitActionLabel('Simpan')
                                                            ->modalWidth('sm')
                                                    )
                                                    ->createOptionUsing(function (array $data) {
                                                        $existingUkuran = \App\Models\Ukuran::where('nama_ukuran', $data['nama_ukuran'])->first();
                                                        if ($existingUkuran) {
                                                            return $existingUkuran->id;
                                                        }
                                                        return \App\Models\Ukuran::create($data)->id;
                                                    })
                                                    ->searchable()
                                                    ->preload()
                                                    ->required(),
                                            ]),
                                        // Other input fields
                                        // Tags with multiple select and create option
                                        Forms\Components\Select::make('tags')
                                            ->label('Tag Dataset')
                                            ->relationship('tags', 'name')
                                            ->multiple()
                                            ->preload()
                                            ->searchable()
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nama Tag')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->unique('tags', 'name')
                                                    ->columnSpanFull(),
                                                Forms\Components\TextInput::make('slug')
                                                    ->label('Slug')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->unique('tags', 'slug')
                                                    ->dehydrateStateUsing(fn($state) => \Illuminate\Support\Str::slug($state))
                                                    ->columnSpanFull(),
                                            ])
                                            ->createOptionAction(
                                                fn(Forms\Components\Actions\Action $action) => $action
                                                    ->modalHeading('Tambah Tag Baru')
                                                    ->modalDescription('Masukkan nama tag baru')
                                                    ->modalSubmitActionLabel('Simpan')
                                                    ->modalWidth('sm')
                                            )
                                            ->required(),
                                        Forms\Components\TextInput::make('frekuensi_pembaruan')
                                            ->label('Frekuensi Pembaruan')
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('dasar_rujukan_prioritas')
                                            ->label('Dasar Rujukan Prioritas')
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('lisensi')
                                            ->label('Lisensi')
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('sumber_data')
                                            ->label('Sumber Data')
                                            ->maxLength(255),

                                        Forms\Components\DatePicker::make('tanggal_rilis')
                                            ->label('Tanggal Rilis')
                                            ->native(false)
                                            ->default(now())
                                            ->required(),

                                        Forms\Components\DateTimePicker::make('tahun_rilis')
                                            ->label('Tahun Rilis')
                                            ->default(now()->year),

                                    ])
                                    ->columns(1),
                            ])
                            ->columnSpan([
                                'lg' => 2,
                            ]),

                        // Right Column - Auto-filled Fields
                        Forms\Components\Grid::make(1)
                            ->schema([
                                Forms\Components\Section::make('Informasi Tambahan')
                                    ->schema([
                                        // Author information
                                        Forms\Components\TextInput::make('penulis_kontak')
                                            ->label('Penulis')
                                            ->default(fn() => auth()->user()?->name)
                                            ->required()
                                            ->maxLength(255)
                                            ->disabled()
                                            ->dehydrated(),

                                        Forms\Components\TextInput::make('email_penulis_kontak')
                                            ->label('Email Penulis')
                                            ->email()
                                            ->default(fn() => auth()->user()?->email)
                                            ->required()
                                            ->maxLength(255)
                                            ->disabled()
                                            ->dehydrated(),

                                        // Organization Info
                                        Forms\Components\TextInput::make('pemelihara_data')
                                            ->label('Pemelihara Data (Organisasi)')
                                            ->default(fn() => auth()->user()?->organization?->name)
                                            ->disabled()
                                            ->dehydrated(),

                                        Forms\Components\TextInput::make('email_pemelihara_data')
                                            ->label('Email Pemelihara')
                                            ->email()
                                            ->default(fn() => auth()->user()?->organization?->email)
                                            ->disabled()
                                            ->dehydrated(),

                                        // Audit trail display
                                        Forms\Components\TextInput::make('created_by_name')
                                            ->label('Dibuat oleh')
                                            ->default(fn() => auth()->user()?->name)
                                            ->disabled()
                                            ->dehydrated(),
                                        Forms\Components\TextInput::make('updated_by_name')
                                            ->label('Diedit terakhir')
                                            ->default(fn() => auth()->user()?->name)
                                            ->disabled()
                                            ->dehydrated(),

                                    ])
                                    ->columns(1),
                                // ->collapsible()
                                // ->collapsed(fn($operation) => $operation === 'create'),
                            ])
                            ->columnSpan([
                                'lg' => 1,
                            ]),
                    ])
                    ->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('organization.name')
                    ->label('Organisasi')
                    ->wrap()
                    ->sortable(),
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->wrap()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('slug')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('satuan.nama_satuan')
                    ->label('Satuan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ukuran.nama_ukuran')
                    ->label('Ukuran')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('frekuensi_pembaruan')
                    ->label('Pembaruan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dasar_rujukan_prioritas')
                    ->label('Dasar Rujukan Prioritas')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('lisensi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('penulis_kontak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_penulis_kontak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pemelihara_data')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_pemelihara_data')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sumber_data')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_rilis')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_modifikasi_metadata')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('cakupan_waktu_mulai')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cakupan_waktu_selesai')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_publik')
                    ->boolean(),
                Tables\Columns\TextColumn::make('jumlah_dilihat')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kepatuhan_standar_data')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url_kamus_data')
                    ->label('Kamus Data')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('createdBy.name')
                    ->label('Dibuat oleh')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updatedBy.name')
                    ->label('Diedit oleh')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListDatasets::route('/'),
            'create' => Pages\CreateDataset::route('/create'),
            'edit' => Pages\EditDataset::route('/{record}/edit'),
        ];
    }
}
