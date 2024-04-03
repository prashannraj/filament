<?php

namespace App\Filament\Resources\AdvNumberResource\Pages;

use App\Filament\Resources\AdvNumberResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAdvNumber extends ViewRecord
{
    protected static string $resource = AdvNumberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
