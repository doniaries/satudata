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
        $userOrganizationId = $user->organization_id;

        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->columns(2)
                    ->schema([
                        // Left Column
                        Forms\Components\Grid::make(1)
                            ->schema([
                                // Informasi Dasar Dataset
                                Forms\Components\Section::make('Informasi Dasar Dataset')
                                    ->schema([
                                        Forms\Components\TextInput::make('judul')
                                            ->label('Judul Dataset')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn(string $operation, $state, callable $set) =>
                                            $operation === 'create' ? $set('slug', Str::slug($state)) : null)
                                            ->columnSpanFull(),

                                        Forms\Components\Hidden::make('slug')
                                            ->disabled()
                                            ->dehydrated()
                                            ->required()
                                            ->unique(Dataset::class, 'slug', ignoreRecord: true),

                                        Forms\Components\Select::make('id_organization')
                                            ->label('Organisasi')
                                            ->relationship('organization', 'name')
                                            ->default($userOrganizationId)
                                            ->required()
                                            ->disabled(fn() => !$isSuperAdmin && !$isAdminSatuData)
                                            ->dehydrated()
                                            ->afterStateHydrated(function ($component) use ($userOrganizationId) {
                                                if (!$component->getState()) {
                                                    $component->state($userOrganizationId);
                                                }
                                            })
                                            ->helperText(fn() => (!$isSuperAdmin && !$isAdminSatuData)
                                                ? 'Organisasi Anda: ' . \App\Models\Organization::find($userOrganizationId)?->name
                                                : null)
                                            ->columnSpanFull(),

                                        Forms\Components\Textarea::make('deskripsi_dataset')
                                            ->label('Deskripsi')
                                            ->required()
                                            ->columnSpanFull()
                                            ->rows(3),
                                    ]),

                                // Informasi Teknis
                                Forms\Components\Section::make('Informasi Teknis')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\Select::make('satuan_id')
                                                    ->label('Satuan')
                                                    ->relationship('satuan', 'nama_satuan')
                                                    ->searchable()
                                                    ->preload()
                                                    ->createOptionForm([
                                                        Forms\Components\TextInput::make('nama_satuan')
                                                            ->required()
                                                            ->maxLength(255)
                                                            ->unique('satuans', 'nama_satuan'),
                                                    ]),

                                                Forms\Components\Select::make('ukuran_id')
                                                    ->label('Ukuran')
                                                    ->relationship('ukuran', 'nama_ukuran')
                                                    ->searchable()
                                                    ->preload()
                                                    ->createOptionForm([
                                                        Forms\Components\TextInput::make('nama_ukuran')
                                                            ->required()
                                                            ->maxLength(255)
                                                            ->unique('ukurans', 'nama_ukuran'),
                                                    ]),
                                            ]),

                                        Forms\Components\TextInput::make('frekuensi_pembaruan')
                                            ->label('Frekuensi Pembaruan')
                                            ->maxLength(255)
                                            ->helperText('Contoh: Harian, Mingguan, Bulanan, Tahunan')
                                            ->columnSpanFull(),

                                        Forms\Components\TextInput::make('dasar_rujukan_prioritas')
                                            ->label('Dasar Rujukan Prioritas')
                                            ->maxLength(255)
                                            ->columnSpanFull(),

                                        Forms\Components\TextInput::make('lisensi')
                                            ->label('Lisensi')
                                            ->default('CC BY-SA 4.0')
                                            ->maxLength(255)
                                            ->columnSpanFull(),

                                        Forms\Components\DatePicker::make('tanggal_rilis')
                                            ->label('Tanggal Rilis')
                                            ->required()
                                            ->default(now())
                                            ->columnSpanFull(),

                                        Forms\Components\Hidden::make('email_penulis_kontak')
                                            ->dehydrated()
                                            ->default($user->email),

                                        Forms\Components\Hidden::make('pemelihara_data')
                                            ->dehydrated()
                                            ->default($user->name),

                                        Forms\Components\Hidden::make('email_pemelihara_data')
                                            ->dehydrated()
                                            ->default($user->email),

                                        Forms\Components\Hidden::make('sumber_data')
                                            ->dehydrated()
                                            ->default($user->name),
                                    ]),
                            ])
                            ->columnSpan(1),


                        Forms\Components\Grid::make(1)
                            ->schema([
                                // Informasi Resource
                                Forms\Components\Section::make('Informasi Resource')
                                    ->schema([
                                        Forms\Components\TextInput::make('nama_resource')
                                            ->label('Nama Resource')
                                            ->required()
                                            ->maxLength(255)
                                            ->helperText('Nama file atau sumber data')
                                            ->columnSpanFull(),

                                        Forms\Components\Textarea::make('deskripsi_resource')
                                            ->label('Deskripsi Resource')
                                            ->columnSpanFull()
                                            ->rows(3),

                                        Forms\Components\FileUpload::make('file_path')
                                            ->label('File')
                                            ->directory('datasets')
                                            ->preserveFilenames()
                                            ->downloadable()
                                            ->openable()
                                            ->columnSpanFull(),

                                        Forms\Components\Select::make('format')
                                            ->label('Format File')
                                            ->options([
                                                'CSV' => 'CSV',
                                                'XLS' => 'Excel',
                                                'XLSX' => 'Excel (XLSX)',
                                                'PDF' => 'PDF',
                                                'JSON' => 'JSON',
                                                'API' => 'API',
                                                'Lainnya' => 'Lainnya',
                                            ])
                                            ->searchable()
                                            ->columnSpanFull(),

                                        Forms\Components\TextInput::make('ukuran_file')
                                            ->label('Ukuran File (bytes)')
                                            ->numeric()
                                            ->disabled()
                                            ->columnSpanFull(),

                                        Forms\Components\TextInput::make('url_kamus_data')
                                            ->label('URL Kamus Data')
                                            ->url()
                                            ->maxLength(255)
                                            ->columnSpanFull(),
                                    ]),

                                // Metadata Tambahan
                                Forms\Components\Section::make('Metadata Tambahan')
                                    ->schema([
                                        Forms\Components\KeyValue::make('metadata_tambahan')
                                            ->keyLabel('Kunci')
                                            ->valueLabel('Nilai')
                                            ->reorderable()
                                            ->columnSpanFull(),
                                    ]),

                                // Hidden Fields
                                Forms\Components\Hidden::make('created_by_user_id')
                                    ->default(fn() => $user->id),

                                Forms\Components\Hidden::make('updated_by_user_id')
                                    ->default(fn() => $user->id),

                                Forms\Components\Hidden::make('terakhir_diubah')
                                    ->default(now()),

                                Forms\Components\Hidden::make('jumlah_diunduh')
                                    ->default(0),
                            ])
                            ->columnSpan(1),
                        Forms\Components\Toggle::make('is_publik')
                            ->label('Publikasikan Dataset')
                            ->default(true)
                            ->helperText('Centang untuk mempublikasikan dataset')
                            ->columnSpanFull(),
                    ])
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Table columns here
            ])
            ->filters([
                // Table filters here
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
