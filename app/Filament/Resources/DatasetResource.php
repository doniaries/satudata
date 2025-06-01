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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

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
                Forms\Components\Select::make('id_organization')
                    ->label('Organisasi Produsen Data') // Label untuk field
                    ->relationship('organization', 'name') // Relasi ke model Organization, menampilkan kolom 'name'
                    ->searchable() // Memungkinkan pencarian pada opsi select
                    ->preload() // Memuat opsi saat halaman dimuat
                    ->required() // Field ini wajib diisi
                    // Logika untuk menentukan apakah field bisa diedit atau tidak
                    ->disabled(function () use ($isSuperAdmin, $isAdminSatuData) {
                        // Jika bukan super_admin ATAU admin_satudata, maka field di-disable
                        return !$isSuperAdmin && !$isAdminSatuData;
                    })
                    // Logika untuk menentukan nilai default
                    ->default(function () use ($user, $isSuperAdmin, $isAdminSatuData) {
                        // Jika user adalah super_admin atau admin_satudata, mereka bisa memilih, jadi tidak ada default spesifik di sini
                        // kecuali Anda ingin menentukan default lain untuk mereka (misalnya organisasi pertama).
                        // Untuk user biasa, defaultnya adalah organisasi mereka.
                        if (!$isSuperAdmin && !$isAdminSatuData) {
                            return $user?->id_organization; // Mengambil id_organization dari user yang login
                        }
                        return null; // Tidak ada default untuk admin, biarkan mereka memilih
                    }),

                // ->helperText(function () use ($isSuperAdmin, $isAdminSatuData) {
                //     if (!$isSuperAdmin && !$isAdminSatuData) {
                //         return 'Organisasi otomatis diisi berdasarkan akun Anda.';
                //     }
                //     return 'Pilih organisasi produsen data.';
                // }),
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi_dataset')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('satuan')
                    ->maxLength(255),
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
                Forms\Components\TextInput::make('pemelihara_data')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email_pemelihara_data')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('sumber_data')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_rilis'),
                Forms\Components\DatePicker::make('tanggal_modifikasi_metadata'),
                Forms\Components\TextInput::make('cakupan_waktu_mulai')
                    ->maxLength(255),
                Forms\Components\TextInput::make('cakupan_waktu_selesai')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_publik')
                    ->required(),
                Forms\Components\TextInput::make('jumlah_dilihat')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('metadata_tambahan'),
                Forms\Components\TextInput::make('kepatuhan_standar_data')
                    ->maxLength(255),
                Forms\Components\TextInput::make('url_kamus_data')
                    ->maxLength(255),
                Forms\Components\TextInput::make('created_by_user_id')
                    ->numeric(),
                Forms\Components\TextInput::make('updated_by_user_id')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('organization.name')
                    // ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('satuan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('frekuensi_pembaruan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dasar_rujukan_prioritas')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lisensi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('penulis_kontak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_penulis_kontak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pemelihara_data')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_pemelihara_data')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sumber_data')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_rilis')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_modifikasi_metadata')
                    ->date()
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_by_user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_by_user_id')
                    ->numeric()
                    ->sortable(),
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
