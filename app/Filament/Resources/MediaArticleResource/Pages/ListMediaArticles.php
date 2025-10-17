<?php

namespace App\Filament\Resources\MediaArticleResource\Pages;

use App\Filament\Resources\MediaArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediaArticles extends ListRecords
{
    protected static string $resource = MediaArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
