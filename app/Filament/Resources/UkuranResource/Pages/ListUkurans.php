<?php

namespace App\Filament\Resources\UkuranResource\Pages;

use App\Filament\Resources\UkuranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUkurans extends ListRecords
{
    protected static string $resource = UkuranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
