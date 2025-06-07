<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Team;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TeamResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TeamResource\RelationManagers;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationLabel = 'OPD';

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static bool $isScopedToTenant = false;


    public static function shouldRegister(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }

    // public static function getNavigationGroup(): ?string
    // {
    //     return __('filament-shield::filament-shield.nav.group');
    // }

    public static function getNavigationGroup(): ?string
    {
        return 'Pengaturan'; // Ubah ke group Settings
    }

    public static function getNavigationSort(): ?int
    {
        return 4; // Angka untuk menentukan urutan menu
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
            ])
            ->filters([
                //
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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }

    // public static function getNavigationBadge(): ?string
    // {
    //     $user = auth()->user();

    //     // Gunakan metode hasRole dari Spatie Permission
    //     if ($user && $user->hasAnyRole(['super_admin'])) {
    //         return static::getModel()::count();
    //     }

    //     // Pastikan user dan teams ada
    //     $teamId = $user?->teams->first()?->id;

    //     if (!$teamId) {
    //         return null;
    //     }

    //     return static::getModel()::query()
    //         ->whereHas('team', function ($query) use ($teamId) {
    //             $query->where('id', $teamId);
    //         })
    //         ->count();
    // }


    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() < 5 ? 'warning' : 'danger';
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Jumlah OPD';
    }
}