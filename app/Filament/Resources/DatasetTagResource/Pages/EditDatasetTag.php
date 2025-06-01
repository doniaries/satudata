<?php

namespace App\Filament\Resources\DatasetTagResource\Pages;

use App\Filament\Resources\DatasetTagResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDatasetTag extends EditRecord
{
    protected static string $resource = DatasetTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
