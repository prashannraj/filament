<?php

namespace App\Filament\Resources\PhysicalCapableResource\Pages;

use App\Filament\Resources\PhysicalCapableResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPhysicalCapable extends EditRecord
{
    protected static string $resource = PhysicalCapableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
