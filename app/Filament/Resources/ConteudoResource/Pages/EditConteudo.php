<?php

namespace App\Filament\Resources\ConteudoResource\Pages;

use App\Filament\Resources\ConteudoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConteudo extends EditRecord
{
    protected static string $resource = ConteudoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
