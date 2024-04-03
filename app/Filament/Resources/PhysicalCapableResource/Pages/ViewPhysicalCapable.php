<?php

namespace App\Filament\Resources\PhysicalCapableResource\Pages;

use App\Filament\Resources\PhysicalCapableResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPhysicalCapable extends ViewRecord
{
    protected static string $resource = PhysicalCapableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
