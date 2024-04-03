<?php

namespace App\Filament\Resources\PhysicalCapableResource\Pages;

use App\Filament\Resources\PhysicalCapableResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPhysicalCapables extends ListRecords
{
    protected static string $resource = PhysicalCapableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
