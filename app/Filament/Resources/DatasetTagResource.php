<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DatasetTagResource\Pages;
use App\Filament\Resources\DatasetTagResource\RelationManagers;
use App\Models\DatasetTag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DatasetTagResource extends Resource
{
    protected static ?string $model = DatasetTag::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('dataset_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('tag_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('dataset_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tag_id')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListDatasetTags::route('/'),
            'create' => Pages\CreateDatasetTag::route('/create'),
            'edit' => Pages\EditDatasetTag::route('/{record}/edit'),
        ];
    }
}
