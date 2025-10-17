<?php

namespace App\Filament\Resources\SeoSectionResource\Pages;

use App\Filament\Resources\SeoSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSeoSections extends ListRecords
{
    protected static string $resource = SeoSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
