<?php

namespace App\Filament\Resources\AdvNumberResource\Pages;

use App\Filament\Resources\AdvNumberResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdvNumber extends EditRecord
{
    protected static string $resource = AdvNumberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
