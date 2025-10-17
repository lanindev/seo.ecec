<?php

namespace App\Filament\Resources\CaseShowcaseResource\Pages;

use App\Filament\Resources\CaseShowcaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaseShowcases extends ListRecords
{
    protected static string $resource = CaseShowcaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
