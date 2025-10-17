<?php

namespace App\Filament\Resources\SeoSectionResource\SeoSectionManager;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;

class CasesManager extends SeoSectionManager
{
    public static function getId(): string
    {
        return 'cases';
    }

    public function formSchema(): array
    {

        return [
            Grid::make(2)->schema([
                Textarea::make('data.title')
                    ->label(__('admin.home_section.banner.title'))
                    ->rows(2)
                    ->required()
                    ->maxLength(20),

                Textarea::make('data.subtitle')
                    ->label(__('admin.home_section.banner.subtitle'))
                    ->rows(2)
                    ->required()
                    ->maxLength(50),
            ]),
        ];
    }
}
