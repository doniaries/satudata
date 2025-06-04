<?php

namespace App\Filament\Resources\TentangResource\Pages;

use App\Filament\Resources\TentangResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTentang extends CreateRecord
{
    protected static string $resource = TentangResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
