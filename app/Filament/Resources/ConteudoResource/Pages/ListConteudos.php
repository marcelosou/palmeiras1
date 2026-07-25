<?php

namespace App\Filament\Resources\ConteudoResource\Pages;

use App\Filament\Resources\ConteudoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConteudos extends ListRecords
{
    protected static string $resource = ConteudoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
