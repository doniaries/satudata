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
                Forms\Components\Hidden::make('id_organization')
                    ->default(fn() => auth()->user()->organization_id)
                    ->dehydrated(),
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state));
                    })
                    ->maxLength(255),
                Forms\Components\Hidden::make('slug')
                    ->disabled()
                    ->dehydrated(),
                Forms\Components\Textarea::make('deskripsi_dataset')
                    ->required()
                    ->columnSpanFull(),
                // Field satuan
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
                        // Check if satuan with same name already exists
                        $existingSatuan = \App\Models\Satuan::where('nama_satuan', $data['nama_satuan'])->first();
                        
                        if ($existingSatuan) {
                            return $existingSatuan->id;
                        }
                        
                        return \App\Models\Satuan::create($data)->id;
                    })
                    ->searchable()
                    ->preload()
                    ->required(),

                // Field ukuran
                Forms\Components\Select::make('ukuran_id')
                    ->label('Ukuran')
                    ->unique(ignoreRecord: true)
                    ->options(fn() => \App\Models\Ukuran::pluck('nama_ukuran', 'id'))
                    ->searchable()
                    ->preload()
                    ->required(),

                // Tags with pluck for better performance
                Forms\Components\CheckboxList::make('tags')
                    ->options(fn() => \App\Models\Tag::pluck('name', 'id'))
                    ->columns(2)
                    ->label('Tag Dataset')
                    ->required(),
                Forms\Components\TextInput::make('frekuensi_pembaruan')
                    ->maxLength(255),
                Forms\Components\TextInput::make('dasar_rujukan_prioritas')
                    ->maxLength(255),
                Forms\Components\TextInput::make('lisensi')
                    ->maxLength(255),
                Forms\Components\TextInput::make('penulis_kontak')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email_penulis_kontak')
                    ->email()
                    ->maxLength(255),
                Forms\Components\Placeholder::make('created_by_name')
                    ->label('Dibuat oleh')
                    ->content(fn($record) => $record?->createdBy?->name ?? '-'),
                Forms\Components\Placeholder::make('updated_by_name')
                    ->label('Diedit oleh')
                    ->content(fn($record) => $record?->updatedBy?->name ?? '-'),
                Forms\Components\TextInput::make('pemelihara_data')
                    ->label('Pemelihara Data (Organisasi)')
                    ->default(fn() => auth()->user()?->organization?->name)
                    ->disabled(), // or ->readonly()
                Forms\Components\TextInput::make('email_pemelihara_data')
                    ->email()
                    ->default(fn() => auth()->user()?->organization?->email)
                    ->disabled(), // or ->readonly()
                Forms\Components\TextInput::make('sumber_data')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_rilis')
                    ->native(false)
                    ->default(now())
                    ->displayFormat('d F Y'),
                Forms\Components\DatePicker::make('tanggal_modifikasi_metadata')
                    ->native(false)
                    ->default(now())
                    ->displayFormat('d F Y'),
                // Forms\Components\TextInput::make('cakupan_waktu_mulai')
                //     ->maxLength(255),
                // Forms\Components\TextInput::make('cakupan_waktu_selesai')
                //     ->maxLength(255),

                // Forms\Components\TextInput::make('jumlah_dilihat')
                //     ->required()
                //     ->numeric()
                //     ->default(0),
                Forms\Components\TextInput::make('metadata_tambahan'),
                Forms\Components\TextInput::make('kepatuhan_standar_data')
                    ->maxLength(255),
                Forms\Components\TextInput::make('url_kamus_data')
                    ->maxLength(255),
                Forms\Components\Placeholder::make('created_by_name')
                    ->label('Dibuat oleh')
                    ->content(fn($record) => $record?->createdBy?->name ?? '-'),

                Forms\Components\Placeholder::make('updated_by_name')
                    ->label('Diedit oleh')
                    ->content(fn($record) => $record?->updatedBy?->name ?? '-'),
                Forms\Components\Toggle::make('is_publik')
                    ->required(),

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
